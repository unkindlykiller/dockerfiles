<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?>

</head>
<body>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>

<?php if( !$user_can_login ){ ?>

<div class="pure-g pure-alert pure-alert-error pure-alert-closable center">
  <div class="pure-u-2-24"></div>
  <div class="pure-u-20-24">
    <?php echo t( 'You have been banned after too many failed login attempts. Try again later.' );?>

  </div>
  <div class="pure-u-2-24">
    <i class="fa fa-times pure-alert-close"></i>
  </div>
</div>
<?php }else{ ?>

  <div class="pure-g">
    <div class="pure-u-lg-1-3 pure-u-1-24"></div>
    <div id="login-form" class="page-form page-form-light pure-u-lg-1-3 pure-u-22-24 login-form-container">
      <form method="post" name="loginform">
        <h2 class="window-title"><?php echo t( 'Login' );?></h2>
        <div>
          <input type="text" name="login" placeholder="<?php echo t( 'Username' );?>"
             <?php if( !empty($username) ){ ?>value="<?php echo $username;?>"<?php } ?> class="autofocus" tabindex="20">
        </div>
        <div>
          <input type="password" name="password" placeholder="<?php echo t( 'Password' );?>" class="autofocus" tabindex="21">
        </div>
        <div class="remember-me">
          <input type="checkbox" name="longlastingsession" id="longlastingsessionform"
             <?php if( $remember_user_default ){ ?>checked="checked"<?php } ?>

             tabindex="22">
          <label for="longlastingsessionform"><?php echo t( 'Remember me' );?></label>
        </div>
        <div>
          <input type="submit" value="<?php echo t( 'Login' );?>" class="bigbutton" tabindex="23">
        </div>
        <input type="hidden" name="token" value="<?php echo $token;?>">
        <?php if( $returnurl ){ ?><input type="hidden" name="returnurl" value="<?php echo $returnurl;?>"><?php } ?>

      </form>
    </div>
    <div class="pure-u-lg-1-3 pure-u-1-8"></div>
  </div>
<?php } ?>


<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>

</body>
</html>

