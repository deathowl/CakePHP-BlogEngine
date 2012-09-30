<div class="posts view">
<center>
<h2><?php echo h($post['Post']['title']);?></h2>
	<dl>
		<?php echo $this->Html->image($post['Post']['relative_path_to_image'], array('alt' => $post['Post']['title']))?>
	</dl>
	<h3> Comments</h3>
	<div>
	<?php foreach($post['PostComment'] as $comment){?></div>
	<div><?php var_dump($comment['body']); ?></div>
	<?php }?>
	<?php echo $this->Form->create('Postcomment', array('action' => 'add')); 
	echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user['id']));
	echo $this->Form->input('post_id',array('type'=>'hidden','value'=>$post['Post']['id']));
	echo $this->Form->input('body',array('label' => 'Hozzászólok','type'=>'text'));
	echo $this->Form->end('Elküld'); ?>
	</div>

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
</center>
</div>


