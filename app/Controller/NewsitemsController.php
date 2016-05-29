<?php

// File: /app/Controller/NewsitemsController.php
class NewsitemsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $controllers = array('Flash','User');
    
    /*  --------------------------------------------------------------------------------------------------------------
    -                                       BASE FUNCTIONS                                                       -
    --------------------------------------------------------------------------------------------------------------    */

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
            $this->Newsitem->create();
            if(!empty($this->data)){
                //Check if image has been uploaded
                $this->addfile();
            }
            if ($this->Newsitem->save($this->request->data)) {
                $this->Flash->success(__('newsitem has been saved succesfull.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Unable to add newsitem.'));
            }    
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
    
    /*  --------------------------------------------------------------------------------------------------------------
    -                                     CUSTOM FUNCTIONS                                                       -
    --------------------------------------------------------------------------------------------------------------    */
    
    public function addfile(){
        if(!empty($this->data['Newsitem']['file']['name'])){
            $file = $this->data['Newsitem']['file']; //put the data into a var for easy use
            $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'png', 'pdf', 'gif'); //set allowed extensions

            //only process if the extension is valid
            if(in_array($ext, $arr_ext)){
                //do the actual uploading of the file. First arg is the name, second arg is
                //where we are putting it, app/img folder
                move_uploaded_file(($file['tmp_name']), 'img/newsfiles/' . $file['name']);
                //prepare the filename for database entry
                $this->request->data['Newsitem']['file']='newsfiles/'.$file['name'];
            }
        }
    }
}