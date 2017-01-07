<?php

App::uses('AppController', 'Controller');

class NewsInfosController extends AppController {

    public $name = 'NewsInfos';
    public $paginate = array();
    public $helpers = array('Olc');

    function admin_index() {
        $this->paginate['NewsInfo'] = array(
            'contain' => array(
                'News' => array(
                    'fields' => array('url', 'source'),
                ),
            ),
            'limit' => 50,
            'order' => array('NewsInfo.time' => 'DESC'),
        );
        $this->set('items', $this->paginate($this->NewsInfo));
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
