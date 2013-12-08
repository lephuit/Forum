<h2>Listing <span class='muted'>Reminders</span></h2>
<br>

<?php if ($reminders): ?>

<?php if (\Auth::check()) : ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Message</th>
			<th>Time</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
  <?php else :?>
            <p> Welcome to reminders . Please login to access your reminders.</p>
  <?php endif; ?>          
<?php foreach ($reminders as $item): ?>		<tr>
 <?php if ($item->name == Auth::instance()->get_screen_name()) : ?>
			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->message; ?></td>
			<td><?php echo $item->time; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
                                           
						<?php echo Html::anchor('reminder/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('reminder/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('reminder/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
                <?php endif; ?>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Reminders.</p>

<?php endif; ?><p>
        <?php if (\Auth::check()){ echo Html::anchor('reminder/create', 'Add new Reminder', array('class' => 'btn btn-success'));} ?>

</p>
