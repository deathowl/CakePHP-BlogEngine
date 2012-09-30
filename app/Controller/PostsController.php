<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view'); //Allow users, who are not logged in view the index and details page .
    }

    public function index() {
        $posts=$this->Post->find('all');
        for($i = 0; $i < count($posts); ++$i) {//eliminate all broken image links
            if(!file_exists(getcwd().$post['Post']['relative_path_to_image'])){ //We do not want broken image tags, do we?
                $posts[$i]['Post']['relative_path_to_image']='/img/imagenotfound.gif';
            }
        }
        $this->set('posts',$posts);
    }

    public function view($id) {
        $this->Post->id = $id;
        $post=$this->Post->read();
        if(!file_exists(getcwd().$post['Post']['relative_path_to_image'])){ //We do not want broken image tags, do we?
            $post['Post']['relative_path_to_image']='/img/imagenotfound.gif';
        }
        $this->set('post',$post );

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