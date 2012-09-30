<div class="posts index">

	<?php
	foreach ($posts as $post): ?>
	<tr>
	<center>
	<h2><?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id'])); ?></h2>
	<dl>
		<?php echo $this->Html->image($post['Post']['relative_path_to_image'], array('alt' => $post['Post']['title'],
			'url' => array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])
		))?>
		<div>Hozzászólások száma: <?php echo ($post['PostComment'][0]['amount']);?></div>
		<div>Pontszám :<?php echo $post['PostRating'][0]['avgscore'];?></div>
	</dl>
		<?php if($isadmin){ ?>
		<td class="actions">
			<?php echo $this->Html->link(__('Részletek'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Szerkesztés'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Form->postLink(__('Törlés'), array('action' => 'delete', $post['Post']['id']), null, __('Biztos, hogy törlöd # %s?', $post['Post']['id'])); ?>
		</td>
		<?php } ?>
	</tr>
</center>
<?php endforeach; ?>
	</table>
</div>
<?php if($isadmin){ ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Új Poszt'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php } ?>
