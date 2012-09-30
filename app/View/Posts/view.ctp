<div class="posts view">
<center>
<h2><?php echo h($post['Post']['title']);?></h2>
	<dl>
		<?php echo $this->Html->image($post['Post']['relative_path_to_image'], array('alt' => $post['Post']['title']))?>
	</dl>
</center>
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
