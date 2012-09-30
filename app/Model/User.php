<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $name = 'User';
    
    public function beforeSave($options = array()) { //CakePHP takes care of password hashing, so it's stored in a safe way :-)
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    //validate the user data..
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')), //Differenciate 2 user groups.
                //Will be used by our so called authentication routines.
                // Of course new users are registered as plain users. Only admins can add new admins
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

        var $hasMany = array(
        'PostComment' => array(
            'className' => 'Postcomment',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => 'PostComment.created DESC',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'PostRating' => array(
            'className'     => 'PostRating',
            'foreignKey'    => 'user_id',
        )
    );
}