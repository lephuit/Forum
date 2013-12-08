<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title ><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<style>
		body { margin: 40px; }
	</style>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js" type="text/javascript"></script> 
        
        
</head>
<body>
   
        <h1><?echo $header?></h1>
     
	<div class="container">
		<div class="col-md-12">
			<h1><?php echo $title; ?></h1>
			<hr>
         
           <?php if (Session::get_flash('success')): ?>
                                   <div class="alert alert-success">
                                           <strong>Success</strong>
                                           <p>
                                           <?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                                           </p>
                                   </div>
           <?php endif; ?>
           <?php if (Session::get_flash('error')): ?>
                                   <div class="alert alert-error">
                                           <strong>Error</strong>
                                           <p>
                                           <?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                                           </p>
                                   </div>
           <?php endif; ?>
                           </div>
                           <div class="col-md-12">
           <?php echo $content; ?>
                           </div>
                           <?php echo $footer; ?> 
	</div>
</body>
</html>
