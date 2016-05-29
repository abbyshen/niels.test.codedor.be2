<?php

// File: /app/Controller/MenusController.php
class MenusController extends AppController {
    public $helpers = array('Html', 'Form');
    public $controllers = array('Flash');

    public function index() {
        $menus = $this->paginate();
        if ($this->request->is('requested')) {
            return $menus;
        }
        $this->set('menus', $menus);
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid menu'));
        }

        $menu = $this->Menu->findById($id);
        if (!$menu) {
            throw new NotFoundException(__('Invalid menu'));
        }
        $this->set('menu', $menu);
    }
    
    public function add(){
        $this->set('Cats', $this->Menu->find('all'));
        if ($this->request->is('post')) {
            $this->Menu->create();
            if ($this->Menu->save($this->request->data)) {
                $this->Flash->success(__('Your menuitem has been added.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your menuitem.'));
        }else{echo $this->request->is('menu');}
    }
    
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid menu'));
        }

        $menu = $this->Menu->findById($id);
        if (!$menu) {
            throw new NotFoundException(__('Invalid menu'));
        }

        if ($this->request->is(array('menu', 'put'))) {
            $this->Menu->id = $id;
            if ($this->Menu->save($this->request->data)) {
                $this->Flash->success(__('Your menuitem has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your menuitem.'));
        }

        if (!$this->request->data) {
            $this->request->data = $menu;
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Menu->delete($id)) {
            $this->Flash->success(__('The menuitem with id: %s has been deleted.', h($id)));
        } else {
            $this->Flash->error(__('The menuitem with id: %s could not be deleted.', h($id)));
        }

        return $this->redirect(array('action' => 'index'));
    }
    
    public function isAuthorized($user) {
        if (in_array($this->action, array('edit', 'add', 'delete'))) {
            if ($user['role']==='admin') {
                return true;
            }else {
                $this->Flash->error(__("you can't create, delete or edit it."));
                return $this->redirect(array('action' => 'index'));
            }
        }

        return parent::isAuthorized($user);
    }
}