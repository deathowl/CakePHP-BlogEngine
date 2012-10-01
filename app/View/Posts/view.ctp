<div class="posts view">
  <?php if($isadmin) {?>
    <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Post'), array('action' => 'edit', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Post'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?> </li>
	</ul>
    </div>
    <?php } ?>
<center>
<h2><?php echo h($post['Post']['title']);?></h2>
	<dl>
		<?php echo $this->Html->image($post['Post']['relative_path_to_image'], array('alt' => $post['Post']['title']))?>
	</dl>
	<div>Pontszám :<?php if($post['PostRating']){
			echo $post['PostRating'][0]['avgscore'];
		    }else{
		    	echo 0;
		    }?>
	<?php if($user and $alreadyrated){
		$options = array('0','1','2','3','4','5');
	    echo $this->Form->create('PostRating',array('controller'=>'PostRatings','action' => 'add')); 
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user['id']));
	    echo $this->Form->input('post_id',array('type'=>'hidden','value'=>$post['Post']['id']));
		echo $this->Form->select('rating', $options,array('label'=>'Pontszám','value'=>'0'));
	    echo $this->Form->end(__('Értékelés elküldése!'));
	}
	?>
	</div>
	<h3> hozzászólások</h3>
	<?php foreach($comments as $comment){?>
	<div >
		<div style="padding:10px;"><?php echo $comment['users']['username'].' kommentje';?></div>
		<div style="padding:5px;"><?php echo $comment['postcomments']['body'];?></div>
		<div style="padding:10px;"><?php echo 'A komment dátuma :'.$comment['postcomments']['created']; ?></div>
	</div>
	<?php }?>
	<?php if($user!=NULL){
    echo $this->Form->create('Postcomment', array('action' => 'add')); 
	echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user['id']));
	echo $this->Form->input('post_id',array('type'=>'hidden','value'=>$post['Post']['id']));
	echo $this->Form->input('body',array('label' => 'Hozzászólok','type'=>'text'));
	echo $this->Form->end('Elküld');
	}
	else  {
	echo $this->Html->link('Lépj be, hogy hozzászólhass és értékelhesd a posztot!','/users/login');
	}?>
	</div>


</center>
</div>


