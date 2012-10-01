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
			'order' => 'PostComment.created DESC'
		),
		'PostRating' => array(
			'className'     => 'PostRating',
			'foreignKey'    => 'post_id',
		)
	);

	public function getComments($id){
		$ssql='SELECT username,postcomments.created,body FROM `postcomments`,users WHERE postcomments.user_id=users.id and postcomments.post_id='.$id;
		return $this->query($ssql);
	}
	public function getOrderedList(){
		$ssql="SELECT round(avg(post_ratings.rating),1) as avgscore ,posts.id,posts.relative_path_to_image ,posts.title
		 FROM posts LEFT JOIN(post_ratings) ON(post_ratings.post_id=posts.id)
		 group by posts.id
		 order by avg(post_ratings.rating) desc";
		$ordered=$this->query($ssql);
		for($i=0;$i<count($ordered);++$i){
			$ordered[$i]['comments']=count($this->getComments($ordered[$i]['posts']['id']));
	}
		return $ordered;
	}


}