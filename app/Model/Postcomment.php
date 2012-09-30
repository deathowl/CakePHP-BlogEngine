<?php
App::uses('AppModel', 'Model');
/**
 * Postcomment Model
 *
 * @property Post $Post
 * @property User $User
 */
class Postcomment extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'post_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Something wrong happened, Post_id cannot be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Something wrong happened, user_id cannot be empty',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'body' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Kérjük, add meg a kommented szövegét!',
				'allowEmpty' => false,
				'required' => true,
			),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
