<?php

App::uses('AppController', 'Controller');

/**
 * Tags Controller
 *
 * @property Tag $Tag
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class TagsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'Flash');

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Tag->recursive = 0;
        $this->set('items', $this->Paginator->paginate());
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Tag->create();
            if ($this->Tag->save($this->request->data)) {
                $this->Flash->success(__('The tag has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The tag could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Tag->id = $id;
        if (!$this->Tag->exists()) {
            throw new NotFoundException(__('Invalid tag'));
        }
        if ($this->Tag->delete()) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
