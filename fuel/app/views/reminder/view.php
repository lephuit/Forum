<h2>Viewing <span class='muted'>#<?php echo $reminder->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $reminder->name; ?></p>
<p>
	<strong>Message:</strong>
	<?php echo $reminder->message; ?></p>
<p>
	<strong>Time:</strong>
	<?php echo $reminder->time; ?></p>






<?php echo Html::anchor('reminder/edit/'.$reminder->id, 'Edit'); ?> |
<?php echo Html::anchor('reminder', 'Back'); ?>