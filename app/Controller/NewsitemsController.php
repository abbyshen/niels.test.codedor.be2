<?php

// File: /app/Controller/NewsitemsController.php
class NewsitemsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $controllers = array('Flash','User');

    public function index() {
         $this->set('newsitems', $this->Newsitem->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid newsitem'));
        }

        $newsitem = $this->Newsitem->findById($id);
        if (!$newsitem) {
            throw new NotFoundException(__('Invalid newsitem'));
        }
        $this->set('newsitem', $newsitem);
    }
    
    public function add(){
        if ($this->request->is('post')) {
            //$this->Newsitem->create();
            $this->request->data['Newsitem']['user_id'] = $this->Auth->user('id');
            if ($this->Newsitem->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your newsitem.'));
        }
    }
    
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid newsitem'));
        }

        $newsitem = $this->Newsitem->findById($id);
        if (!$newsitem) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Newsitem->id = $id;
            if ($this->Newsitem->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your newsitem.'));
        }

        if (!$this->request->data) {
            $this->request->data = $newsitem;
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Newsitem->delete($id)) {
            $this->Flash->success(__('The newsitem with id: %s has been deleted.', h($id)));
        } else {
            $this->Flash->error(__('The newsitem with id: %s could not be deleted.', h($id)));
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function isAuthorized($user) {
        return parent::isAuthorized($user);
    }
}