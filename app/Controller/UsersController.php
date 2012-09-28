<?php
// app/Controller/UsersController.php
class UsersController extends AppController {

     public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'posts', 'action' => 'index')
        )
    );


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'logout','listall','delete'); //remove delete after login works!
    }

    public function login() {
        if ($this->request->is('post')) {
          if ($this->Auth->login()) {
             $this->redirect($this->Auth->redirect());
          } else {
               $this->Session->setFlash(__('Invalid username or password, try again'));
          }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function listall() {//TODO: Filter rights, so only users with admin rights may list all users
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {//TODO: Filter rights, so only users with admin rights may view user detail page
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) { //It IS safe to save the request data
                //Because the form and Model validates the data. 
                $this->Session->setFlash(__('The user has been saved'));
                $this->Auth->Login($this->User);
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {//TODO: Filter rights, so only users with admin rights may edit users
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {//TODO: Filter rights, so only users with admin rights may delete user
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}