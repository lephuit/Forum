<?php echo Form::open(); ?>
<p>
    <?php echo Form::label('New Password', 'password'); ?>
    <?php echo Form::password('password',''); ?>
</p>
<div class="actions">
    <?php echo Form::submit(); ?>
</div>
<?php echo Form::close(); ?>
