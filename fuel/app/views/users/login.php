

<div class="hero-unit">
	<?php echo Form::open(array('id' => 'login-form')); ?>	<fieldset>
		
	
		 
	
		<?php if (isset($login_error)): ?>
			<div class="error"><?php echo $login_error; ?></div>
		<?php endif; ?>
		
                        <div class="clearfix <?php if (Validation::instance()->error('username')) echo 'error'; ?>" style="margin-bottom:6px;">
			<label for="username">Username:</label>
			<div class="input">
				<?php if (Validation::instance()->error('username')): ?>
				<?php echo Form::input('username', Input::post('username'), array('class'=>'error')); ?>
				<span class="help-inline"><?php echo Validation::instance()->error('username')->get_message('You must provide a username.'); ?></span>
				<?php else: ?>
				<?php echo Form::input('username', Input::post('username')); ?>
				<?php endif; ?>
			</div>check
		</div>
		<div class="clearfix <?php if (Validation::instance()->error('password')) echo 'error'; ?>">
			<label for="password">Password:</label>
			<div class="input">
				<?php if (Validation::instance()->error('password')): ?>
				<?php echo Form::password('password'); ?>
				<span class="help-inline"><?php echo Validation::instance()->error('password')->get_message(':label cannot be blank'); ?></span>
				<?php else: ?>
				<?php echo Form::password('password'); ?>
				<?php endif; ?>
			</div>
		</div>		
				
		
		
			<div ><?php echo Form::submit(array('value'=>'Login', 'name'=>'submit', 'class'=>'btn primary')); ?></div>
		
	</fieldset>

	
	<?php echo Form::close(); ?>
</div>
