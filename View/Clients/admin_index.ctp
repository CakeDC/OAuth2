<h2><?php echo __('Clients'); ?></h2>
<p>
	<?php echo $this->Html->link(__('Add'), array('action' => 'add')); ?>
</p>
<table>
	<tr>
		<th><?php $this->Paginator->sort('client_id'); ?></th>
		<th><?php $this->Paginator->sort('secret'); ?></th>
		<th><?php $this->Paginator->sort('redirect_uri'); ?></th>
	</tr>
	<?php if (!empty($clients)) : ?>
		<?php foreach($clients as $client) : ?>
			<tr>
				<td><?php echo $client['Oauth2Client']['client_id']; ?></td>
				<td><?php echo $client['Oauth2Client']['secret']; ?></td>
				<td><?php echo $client['Oauth2Client']['redirect_uri']; ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endif ?>
</table>