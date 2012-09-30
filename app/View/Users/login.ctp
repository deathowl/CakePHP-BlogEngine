<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('jelentkezz be!'); ?></legend>
    <?php
        echo $this->Form->input('username',array('label'=>'felhasználónév'));
        echo $this->Form->input('password', array('type' => 'password', 'label' => 'jelszó'));
        echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => 'Maradjak bejelentkezve!'));

    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>