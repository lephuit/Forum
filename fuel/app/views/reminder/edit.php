<h2>Editing <span class='muted'>Reminder</span></h2>
<br>

<?php echo render('reminder/_form'); ?>
<p>
	<?php echo Html::anchor('reminder/view/'.$reminder->id, 'View'); ?> |
	<?php echo Html::anchor('reminder', 'Back'); ?></p>
