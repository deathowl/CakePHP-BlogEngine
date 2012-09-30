<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function beforeFilter() {
        $this->Auth->allow('index', 'view'); //Allow users, who are not logged in view the index and details page .
    }

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());

    }

    public function add() {
        //Filter rights, so only admin can add  a new post
         if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }

    public function edit($id = null) {
    //Only admins can edit posts
     if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
    $this->Post->id = $id;
    if ($this->request->is('get')) {
        $this->request->data = $this->Post->read();
    } else {
        if ($this->Post->save($this->request->data)) {
            $this->Session->setFlash('Your post has been updated.');
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Unable to update your post.');
        }
    }
    }
    public function delete($id) {
    //Only admins can delete posts
    echo "WAT?";
    exit();
     if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }
    if ($this->Post->delete($id)) {
        $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
        $this->redirect(array('action' => 'index'));
    }
}
  
}