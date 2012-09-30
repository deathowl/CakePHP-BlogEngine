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
}