<?php
App::uses('AppModel', 'Model');
/**
 * PostRating Model
 *
 * @property User $User
 * @property Post $Post
 */
class PostRating extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A felhasználó azonosító nem lehet üres :(',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'post_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A poszt azonosító nem lehet üres',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'rating' => array(
			'between' => array(
				'rule' => array('between'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
