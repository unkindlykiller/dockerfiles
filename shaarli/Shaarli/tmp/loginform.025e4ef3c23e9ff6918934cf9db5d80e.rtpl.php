<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head><?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?></head>
<body
<?php if( $user_can_login ){ ?>
    <?php if( empty($username) ){ ?>
        onload="document.loginform.login.focus();"
    <?php }else{ ?>
        onload="document.loginform.password.focus();"
    <?php } ?>
<?php } ?>>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>

<div id="headerform" class="page-login container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php if( !$user_can_login ){ ?>
                <?php echo t( 'You have been banned after too many failed login attempts. Try again later.' );?>
            <?php }else{ ?>
                <form method="POST" name="loginform" class="card">
                    <div class="card-title"><?php echo t( 'Login' );?></div>
                    <div class="card-body">
                        <div class="form-entry">
                            <label for="login"><?php echo t( 'Username' );?></label><br/>
                            <input type="text" name="login" id="login" tabindex="1" <?php if( !empty($username) ){ ?>value="<?php echo $username;?>"<?php } ?>>
                        </div>
                        <div class="form-entry">
                            <label for="password"><?php echo t( 'Password' );?></label><br/>
                            <input type="password" name="password" id="password" tabindex="2" >
                        </div>
                        <div class="form-entry">
                            <input type="checkbox" class="filled-in" name="longlastingsession" id="longlastingsession" tabindex="3"
                            <?php if( $remember_user_default ){ ?>checked="checked"<?php } ?>>
                            <label for="longlastingsession"><?php echo t( 'Stay signed in (Do not check on public computers)' );?></label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="button-raised button-primary pull-right" tabindex="4"><?php echo t( 'Login' );?></button>
                        <input type="hidden" name="token" value="<?php echo $token;?>">
                        <?php if( $returnurl ){ ?><input type="hidden" name="returnurl" value="<?php echo $returnurl;?>"><?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>
</body>
</html>
