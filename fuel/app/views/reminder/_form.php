<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		
		<div class="form-group">
			<?php echo Form::label('Message', 'message', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('message', Input::post('message', isset($reminder) ? $reminder->message : ''), array('class' => 'col-md-8 from-control', 'rows' => 8, 'placeholder'=>'Message')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Time', 'time', array('class'=>'control-label')); ?>

				<?php echo Form::input('time', Input::post('time', isset($reminder) ? $reminder->time : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Time')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>