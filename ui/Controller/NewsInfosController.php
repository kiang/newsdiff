<?php

App::uses('AppController', 'Controller');

class NewsInfosController extends AppController {

    public $name = 'NewsInfos';
    public $paginate = array();
    public $helpers = array('Olc');

    function admin_index($source = 0) {
        $keywords = $conditions = array();
        if (isset($this->request->query['keyword'])) {
            $keywords = preg_split('/\\s+/', $this->request->query['keyword']);
            foreach ($keywords AS $k => $v) {
                if (empty($v)) {
                    unset($keywords[$k]);
                }
            }
            $keywords = array_unique($keywords);
            if (!empty($keywords)) {
                $conditions['AND'] = array();
                foreach ($keywords AS $keyword) {
                    $conditions['AND'][] = array('OR' => array(
                            'NewsInfo.title LIKE' => "%{$keyword}%",
                            'NewsInfo.body LIKE' => "%{$keyword}%",
                    ));
                }
            }
        }
        $source = intval($source);
        if ($source > 0) {
            $conditions['News.source'] = $source;
        }
        $this->paginate['NewsInfo'] = array(
            'conditions' => $conditions,
            'contain' => array(
                'News' => array(
                    'fields' => array('url', 'source'),
                ),
            ),
            'limit' => 50,
            'order' => array('NewsInfo.time' => 'DESC'),
        );
        $this->set('items', $this->paginate($this->NewsInfo));
        $this->set('source', $source);
        $this->set('keywords', implode(' ', $keywords));
    }

    function admin_tag($tagId = 0) {
        $tagId = intval($tagId);
        if ($tagId > 0) {
            $tag = $this->NewsInfo->News->Tag->find('first', array(
                'conditions' => array(
                    'Tag.id' => $tagId,
                ),
            ));
        }
        if (empty($tag)) {
            $this->redirect('/admin/tags');
        }
        $keywords = array();
        $conditions = array('NewsTag.tag_id' => $tagId);
        if (isset($this->request->query['keyword'])) {
            $keywords = preg_split('/\\s+/', $this->request->query['keyword']);
            foreach ($keywords AS $k => $v) {
                if (empty($v)) {
                    unset($keywords[$k]);
                }
            }
            $keywords = array_unique($keywords);
            if (!empty($keywords)) {
                $conditions['AND'] = array();
                foreach ($keywords AS $keyword) {
                    $conditions['AND'][] = array('OR' => array(
                            'NewsInfo.title LIKE' => "%{$keyword}%",
                            'NewsInfo.body LIKE' => "%{$keyword}%",
                    ));
                }
            }
        }
        $this->paginate['NewsInfo'] = array(
            'conditions' => $conditions,
            'contain' => array(
                'News' => array(
                    'fields' => array('url', 'source'),
                ),
            ),
            'joins' => array(
                array(
                    'table' => 'news_tags',
                    'alias' => 'NewsTag',
                    'type' => 'INNER',
                    'conditions' => array(
                        'NewsInfo.news_id = NewsTag.news_id',
                    ),
                ),
            ),
            'limit' => 50,
            'order' => array('NewsInfo.time' => 'DESC'),
        );
        $this->set('items', $this->paginate($this->NewsInfo));
        $this->set('tag', $tag);
        $this->set('keywords', implode(' ', $keywords));
        $this->set('url', array($tagId));
    }

    function admin_view($id = null) {
        if (!$id || !$this->data = $this->NewsInfo->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->NewsInfo->create();
            if ($this->NewsInfo->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->NewsInfo->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->NewsInfo->read(null, $id);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
        } else if ($this->NewsInfo->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

}
