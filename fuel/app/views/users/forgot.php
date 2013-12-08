<?php echo Form::open(); ?>
<h5> Please enter your email address to reset your password. </h5></br>
<p>
    <?php echo Form::label('Email address', 'email'); ?>
    <?php echo Form::input('email', Input::post('email', isset($comment) ? $comment->name : '')); ?>
</p>
<div class="actions">
    <?php echo Form::submit(); ?>
</div>
<?php echo Form::close(); ?>
