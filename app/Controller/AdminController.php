<?php
App::uses('AppController', 'Controller');
/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class AdminController extends AppController { 
	//A really basic controller, only to be able to display the simple admin panel, after rights are filtered :)

	function index(){
		 if (!parent::isAdministrator($this->Auth->user())) {
            $this->redirect('/');
        }

	}


}
