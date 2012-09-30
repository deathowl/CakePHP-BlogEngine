<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
      public $name = 'Users';
     public $components =
      array('MathCaptcha'=>
                        array(  'timer' => 3,
                                'tabsafe' => true
                              )
            );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register','login');
    }


    public function login() {
        if ($this->request->is('post')) {    
            if ($this->Auth->login()) {
                     $this->redirect($this->Auth->redirect());
            } else {
                    $this->Session->setFlash(__('Érvénytelen felhasználónév vagy jelszó'));
                }
            }
        
    }

    public function _autoLogin($user) {
        var_dump($user);
        exit();
    }

    public function logout() {
        if($this->Auth->logout()){
            $this->redirect('/');
        }

    }

    public function index() {
    // Filter rights, so only users with admin rights may list all users
    if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {//TODO: Filter rights, so only users with admin rights may view user detail page
        if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Nincs ilyen user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function register() {
        $this->set('captcha', $this->MathCaptcha->getCaptcha());
        $this->set('captcha_result', $this->MathCaptcha->getResult());
        if ($this->request->is('post')) {
            $data=$this->request->data;
            $data['User']['role']='user'; //Here, we copy the data into a new variable, becauese we do not want to be use hidden
            //fields on the register form. It's a security hole. We create an ad function instead, where admin adds users, and there captcha is not needed
            $this->User->create();
            if ($this->MathCaptcha->validate(
                                    array($data['User']['captcha'],
                                    $data['User']['result'])
                                    )
            ) 
             {
                if ($this->User->save($data)) { //It IS safe to save the request data
                    //Because the form and Model validates the data. 
                    $this->Session->setFlash(__('Sikeres regisztráció!'));
                    $this->Auth->login(); //Autologin the user after registration. Yes, Cake's auth controller is this smart :-)
                    $this->redirect('/');
                } else {
                    $this->Session->setFlash(__('Hiba történt, próbáld újra!.'));
                }
            }else{
                $this->Session->setFlash('Robot-e vagy?');
            }
        }
    }


    public function add() {
        // Filter rights, so only users with admin rights may add users
         if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
        if ($this->request->is('post')) {
            $data=$this->request->data;
            //admin can add other admins too, so here we will not set the role to user with hand.            
            $this->User->create();
                if ($this->User->save($data)) { //It IS safe to save the request data
                    //Because the form and Model validates the data. 
                    $this->Session->setFlash(__('A felhasználó hozzáadva'));
                    $this->Auth->login(); //Autologin the user after registration. Yes, Cake's auth controller is this smart :-)
                    $this->redirect('/');
                } else {
                    $this->Session->setFlash(__('Hiba történt, próbáld újra'));
                }
        }
    }


    public function edit($id = null) {
    // Filter rights, so only users with admin rights may edit users
         if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Nincs ilyen user!'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Sikeres mentés'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Hiba történt, próbáld újra'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
    //Filter rights, so only users with admin rights may delete user
         if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Nincs ilyen user!'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('A felhasználó törölve'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('A törlés nem sikerült'));
        $this->redirect(array('action' => 'index'));
    }
}