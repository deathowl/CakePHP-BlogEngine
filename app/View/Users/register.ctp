<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Regisztrációs űrlap'); ?></legend>
	<?php
		echo $this->Form->input('username',array('label' => 'Felhasználónév'));
		echo $this->Form->input('password',array('label' => 'jelszó','type'=>'password'));
		echo $this->Form->input('role');
		echo $this->Form->hidden('result', array('value' => $captcha_result));
		echo $this->Form->input('captcha', array('label' => 'Ha nem vagy robot, add meg a választ, '.$captcha));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
