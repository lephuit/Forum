<div class="topbar">
  <div class="fill">
    <div class="container">
      
      <ul class="nav">
        <li class="active" ><? Html::anchor('reminder', 'Home')?></li>
      </ul>
      <?php if (Auth::instance()->check()){ ?>
      <ul class="nav secondary-nav">
        <li class="menu dropdown" data-dropdown="dropdown">
            <p class="pull-right" >  <a href="reminder" class="menu"><?php echo Auth::instance()->get_screen_name() ?></a>
           
                
            	
                <?php echo'|'; echo Html::anchor('users/logout', 'Logout') ?></p>
            
        </li>
      </ul>
      <?php } else { ?>
      <p  class="pull-right"><?= Html::anchor('users/register', 'Signup')?> or <?= Html::anchor('users/login', 'Login')?></p>
      <?php } ?>
    </div>
  </div>
</div>
