<?php
class Post extends AppModel {
	public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'relative_path_to_image' => array(
            'rule' => 'notEmpty'
        )
    );
	var $hasMany = array(
		'PostComment' => array(
			'className' => 'Postcomment',
			'foreignKey' => 'post_id',
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
			'foreignKey'    => 'post_id',
		)
	);


}