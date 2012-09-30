<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('AttemptController','Controller/Component');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	/*The default values for the components array are added here.
	  Since we work with OOP paradigm, all  derived classes will be able to access it.
	*/

    public $components = array(
        'Session',
        'AutoLogin',
        'Auth' => array(
        'loginRedirect' =>  array('controller' => 'posts', 'action'=>'index'),
        'logoutRedirect' => array('controller' => 'posts', 'action'=>'index')
         )
        );
    public function isAdministrator($user) {
    // Admin can access admin actions
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
    // Default deny
    return false;
    }

     public function beforeFilter() {
        //We set these 2 datas here, because they will be used in every rendered page.
        $this->set('user',$this->Auth->user());
        $this->set('isadmin',$this->Auth->user('role')==='admin');
        $this->AutoLogin->settings = array(
        // Model settings
        'model' => 'Member',
        'username' => 'username',
        'password' => 'password',
 
        // Controller settings
        'plugin' => '',
        'controller' => 'users',
        'loginAction' => 'login',
        'logoutAction' => 'logout',
 
        // Cookie settings
        'cookieName' => 'rememberMeWeblog',
        'expires' => '+1 month',
 
        // Process logic
        'active' => true,
        'redirect' => true,
        'requirePrompt' => true
        );
    }

}
