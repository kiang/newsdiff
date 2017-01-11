<?php

App::uses('AppController', 'Controller');
/*
 * pear install Math_Combinatorics
 */
require_once 'Math/Combinatorics.php';

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
                    'fields' => array('id', 'url', 'source'),
                    'Tag' => array(
                        'fields' => array('id', 'name'),
                    ),
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
            'group' => array('NewsInfo.news_id'),
            'limit' => 50,
            'order' => array('NewsInfo.time' => 'DESC'),
        );
        $this->set('items', $this->paginate($this->NewsInfo));
        $this->set('source', $source);
        $this->set('keywords', implode(' ', $keywords));
    }

    function admin_all($source = 0) {
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
                    'fields' => array('id', 'url', 'source'),
                ),
            ),
            'limit' => 50,
            'group' => array('NewsInfo.news_id'),
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

    function admin_report($print = false) {
        if ($print) {
            $this->layout = 'print';
        }
        if (!empty($this->request->query['dateBegin']) && !empty($this->request->query['dateEnd'])) {
            $timeBegin = strtotime($this->request->query['dateBegin'] . ' 00:00:00');
            $timeEnd = strtotime($this->request->query['dateEnd'] . ' 23:59:59');
            if ($timeEnd < $timeBegin) {
                $t = $timeBegin;
                $timeBegin = $timeEnd;
                $timeEnd = $t;
            }
            $tags = $this->NewsInfo->News->Tag->find('list');
            $items = $this->NewsInfo->News->find('all', array(
                'fields' => array(
                    'id', 'url', 'source', 'created_at',
                ),
                'conditions' => array(
                    'News.created_at >=' => $timeBegin,
                    'News.created_at <=' => $timeEnd,
                    'News.error_count' => 0,
                ),
                'contain' => array(
                    'NewsTag' => array(
                        'fields' => array('tag_id'),
                    ),
                ),
                'joins' => array(
                    array(
                        'table' => 'news_tags',
                        'alias' => 'Tag',
                        'type' => 'INNER',
                        'conditions' => array(
                            'News.id = Tag.news_id',
                        ),
                    ),
                ),
                'order' => array('News.created_at' => 'DESC'),
            ));
            $items = Set::combine($items, '{n}.News.id', '{n}');
            $tagMap = $tagMap2 = array();
            foreach ($items AS $item) {
                foreach ($item['NewsTag'] AS $newsTag) {
                    if (!isset($tagMap[$newsTag['tag_id']])) {
                        $tagMap[$newsTag['tag_id']] = array(
                            'tag_id' => $newsTag['tag_id'],
                            'count' => 0,
                            'news' => array(),
                        );
                    }
                    ++$tagMap[$newsTag['tag_id']]['count'];
                    $tagMap[$newsTag['tag_id']]['news'][$newsTag['news_id']] = $newsTag['news_id'];
                }
            }
            usort($tagMap, array('NewsInfosController', 'cmp'));
            $tagMap = Set::combine($tagMap, '{n}.tag_id', '{n}');

            $c = new Math_Combinatorics;
            $combinations = $c->combinations(array_keys($tagMap), 2);
            $grouped = array();
            foreach ($combinations AS $combination) {
                $tag1 = array_shift($combination);
                $tag2 = array_shift($combination);
                $result = array_intersect($tagMap[$tag1]['news'], $tagMap[$tag2]['news']);
                if (!empty($result)) {
                    $item = array(
                        'tags' => array($tag1, $tag2),
                        'news' => $result,
                    );
                    $tagMap2[] = $item;
                    foreach ($result AS $newsId) {
                        unset($tagMap[$tag1]['news'][$newsId]);
                        unset($tagMap[$tag2]['news'][$newsId]);
                    }
                }
            }

            $titles = $this->NewsInfo->find('list', array(
                'fields' => array('news_id', 'title'),
                'conditions' => array(
                    'news_id' => Set::extract('{n}.News.id', $items),
                ),
                'group' => array('news_id'),
                'order' => array('time' => 'DESC'),
            ));
            $this->set('items', $items);
            $this->set('tags', $tags);
            $this->set('titles', $titles);
            $this->set('tagMap', $tagMap);
            $this->set('tagMap2', $tagMap2);
        } else {
            $timeBegin = $timeEnd = time();
        }
        $this->set('isPrint', $print);
        $this->set('dateBegin', date('Y-m-d', $timeBegin));
        $this->set('dateEnd', date('Y-m-d', $timeEnd));
    }

    static function cmp($a, $b) {
        return ($a['count'] < $b['count']) ? +1 : -1;
    }

}
