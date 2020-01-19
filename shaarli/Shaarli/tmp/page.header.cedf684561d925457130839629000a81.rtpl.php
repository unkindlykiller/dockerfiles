<?php if(!class_exists('raintpl')){exit;}?><div class="shaarli-menu pure-g" id="shaarli-menu">
  <div class="pure-u-lg-0 pure-u-1">
    <div class="pure-menu">
      <a href="<?php echo $titleLink;?>" class="pure-menu-link shaarli-title" id="shaarli-title-mobile">
        <img src="tpl/default/./img/icon.png" width="16" height="16" class="head-logo" alt="" />
        <?php echo $shaarlititle;?>

      </a>
      <a href="#" class="menu-toggle" id="menu-toggle"><s class="bar"></s><s class="bar"></s></a>
    </div>
  </div>
  <div class="pure-u-1">
    <div class="pure-menu menu-transform pure-menu-horizontal pure-g">
      <ul class="pure-menu-list pure-u-lg-5-6 pure-u-1">
        <li class="pure-menu-item pure-u-0 pure-u-lg-visible">
          <a href="<?php echo $titleLink;?>" class="pure-menu-link shaarli-title" id="shaarli-title-desktop">
            <img src="tpl/default/./img/icon.png" width="16" height="16" class="head-logo" alt="" />
            <?php echo $shaarlititle;?>

          </a>
        </li>
        <?php if( $is_logged_in || $openshaarli ){ ?>

          <li class="pure-menu-item">
            <a href="?do=addlink" class="pure-menu-link" id="shaarli-menu-shaare">
              <i class="fa fa-plus" ></i> <?php echo t( 'Shaare' );?>

            </a>
          </li>
          <li class="pure-menu-item" id="shaarli-menu-tools">
            <a href="?do=tools" class="pure-menu-link"><?php echo t( 'Tools' );?></a>
          </li>
        <?php } ?>

        <li class="pure-menu-item" id="shaarli-menu-tags">
          <a href="?do=tagcloud" class="pure-menu-link"><?php echo t( 'Tag cloud' );?></a>
        </li>
        <?php if( $thumbnails_enabled ){ ?>

          <li class="pure-menu-item" id="shaarli-menu-picwall">
            <a href="?do=picwall<?php echo $searchcrits;?>" class="pure-menu-link"><?php echo t( 'Picture wall' );?></a>
          </li>
        <?php } ?>

        <li class="pure-menu-item" id="shaarli-menu-daily">
          <a href="?do=daily" class="pure-menu-link"><?php echo t( 'Daily' );?></a>
        </li>
        <?php $counter1=-1; if( isset($plugins_header["buttons_toolbar"]) && is_array($plugins_header["buttons_toolbar"]) && sizeof($plugins_header["buttons_toolbar"]) ) foreach( $plugins_header["buttons_toolbar"] as $key1 => $value1 ){ $counter1++; ?>

          <li class="pure-menu-item shaarli-menu-plugin">
            <a
              <?php $value1["attr"]["class"]=$this->var['value']["attr"]["class"]=isset($value1["class"]) ? $value1["attr"]["class"] . ' pure-menu-link' : 'pure-menu-link';?>

              <?php $counter2=-1; if( isset($value1["attr"]) && is_array($value1["attr"]) && sizeof($value1["attr"]) ) foreach( $value1["attr"] as $key2 => $value2 ){ $counter2++; ?>

                <?php echo $key2;?>="<?php echo $value2;?>"
              <?php } ?>>
              <?php echo $value1["html"];?>

            </a>
          </li>
        <?php } ?>

        <li class="pure-menu-item pure-u-lg-0 shaarli-menu-mobile" id="shaarli-menu-mobile-rss">
            <a href="?do=<?php echo $feed_type;?><?php echo $searchcrits;?>" class="pure-menu-link"><?php echo t( 'RSS Feed' );?></a>
        </li>
        <?php if( $is_logged_in ){ ?>

          <li class="pure-menu-item pure-u-lg-0 shaarli-menu-mobile" id="shaarli-menu-mobile-logout">
            <a href="?do=logout" class="pure-menu-link"><?php echo t( 'Logout' );?></a>
          </li>
        <?php }else{ ?>

          <li class="pure-menu-item pure-u-lg-0 shaarli-menu-mobile" id="shaarli-menu-mobile-login">
            <a href="?do=login" class="pure-menu-link"><?php echo t( 'Login' );?></a>
          </li>
        <?php } ?>

      </ul>
      <div class="header-buttons pure-u-lg-1-6 pure-u-0 pure-u-lg-visible">
        <ul class="pure-menu-list">
          <li class="pure-menu-item" id="shaarli-menu-desktop-search">
            <a href="#" class="pure-menu-link subheader-opener"
               data-open-id="search"
               id="search-button" title="<?php echo t( 'Search' );?>">
              <i class="fa fa-search"></i>
            </a>
          </li>
          <li class="pure-menu-item" id="shaarli-menu-desktop-rss">
            <a href="?do=<?php echo $feed_type;?><?php echo $searchcrits;?>" class="pure-menu-link" title="<?php echo t( 'RSS Feed' );?>">
              <i class="fa fa-rss"></i>
            </a>
          </li>
          <?php if( !$is_logged_in ){ ?>

            <li class="pure-menu-item" id="shaarli-menu-desktop-login">
              <a href="?do=login" class="pure-menu-link"
                 data-open-id="header-login-form"
                 id="login-button" title="<?php echo t( 'Login' );?>">
                <i class="fa fa-user"></i>
              </a>
            </li>
          <?php }else{ ?>

            <li class="pure-menu-item" id="shaarli-menu-desktop-logout">
              <a href="?do=logout" class="pure-menu-link" title="<?php echo t( 'Logout' );?>">
                <i class="fa fa-sign-out"></i>
              </a>
            </li>
          <?php } ?>

        </ul>
      </div>
    </div>
  </div>
</div>

<div id="content" class="container">
  <div id="search" class="subheader-form searchform-block header-search">
    <form method="GET" class="pure-form searchform" name="searchform">
      <input type="text" tabindex="1" id="searchform_value" name="searchterm" placeholder="<?php echo t( 'Search text' );?>"
             <?php if( !empty($search_term) ){ ?>

             value="<?php echo $search_term;?>"
             <?php } ?>

      >
      <input type="text" tabindex="2" name="searchtags" id="tagfilter_value" placeholder="<?php echo t( 'Filter by tag' );?>"
             <?php if( !empty($search_tags) ){ ?>

             value="<?php echo $search_tags;?>"
             <?php } ?>

      autocomplete="off" data-multiple data-autofirst data-minChars="1"
      data-list="<?php $counter1=-1; if( isset($tags) && is_array($tags) && sizeof($tags) ) foreach( $tags as $key1 => $value1 ){ $counter1++; ?><?php echo $key1;?>, <?php } ?>"
      >
      <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
    </form>
  </div>
  <div id="actions" class="subheader-form">
    <div class="pure-g">
      <div class="pure-u-1">
        <a href="" id="actions-delete" class="button"><?php echo t( 'Delete' );?></a>
      </div>
    </div>
  </div>
  <?php if( !$is_logged_in ){ ?>

    <form method="post" name="loginform">
      <div class="subheader-form header-login-form" id="header-login-form">
        <input type="text" name="login" placeholder="<?php echo t( 'Username' );?>" tabindex="3">
        <input type="password" name="password" placeholder="<?php echo t( 'Password' );?>" tabindex="5">
        <div class="remember-me">
          <input type="checkbox" name="longlastingsession" id="longlastingsession" tabindex="6" checked>
          <label for="longlastingsession"><?php echo t( 'Remember me' );?></label>
        </div>
        <input type="hidden" name="token" value="<?php echo $token;?>">
        <input type="hidden" name="returnurl">
        <input type="submit" value="Login" tabindex="7">
      </div>
    </form>
  <?php } ?>

<?php if( !empty($newVersion) || !empty($versionError) ){ ?>

  <div class="pure-g new-version-message pure-alert pure-alert-warning pure-alert-closable">
    <div class="pure-u-2-24"></div>
    <?php if( $newVersion ){ ?>

      <div class="pure-u-20-24">
        Shaarli <?php echo $newVersion;?>

        <a href="https://github.com/shaarli/Shaarli/releases"><?php echo t( 'is available' );?></a>.
      </div>
    <?php } ?>

    <?php if( $versionError ){ ?>

      <div class="pure-u-20-24">
        <?php echo t( 'Error' );?>: <?php echo $versionError;?>

      </div>
    <?php } ?>

    <div class="pure-u-2-24">
      <i id="new-version-dismiss" class="fa fa-times pure-alert-close"></i>
    </div>
  </div>
<?php } ?>


<?php if( !empty($plugin_errors) && $is_logged_in ){ ?>

  <div class="pure-g new-version-message pure-alert pure-alert-error pure-alert-closable" id="shaarli-errors-alert">
    <div class="pure-u-2-24"></div>
    <div class="pure-u-20-24">
        <?php $counter1=-1; if( isset($plugin_errors) && is_array($plugin_errors) && sizeof($plugin_errors) ) foreach( $plugin_errors as $key1 => $value1 ){ $counter1++; ?>

            <p><?php echo $value1;?></p>
        <?php } ?>

    </div>
    <div class="pure-u-2-24">
      <i class="fa fa-times pure-alert-close"></i>
    </div>
  </div>
<?php } ?>


<?php if( !empty($global_warnings) && $is_logged_in ){ ?>

  <div class="pure-g pure-alert pure-alert-warning pure-alert-closable" id="shaarli-warnings-alert">
    <div class="pure-u-2-24"></div>
    <div class="pure-u-20-24">
      <?php $counter1=-1; if( isset($global_warnings) && is_array($global_warnings) && sizeof($global_warnings) ) foreach( $global_warnings as $key1 => $value1 ){ $counter1++; ?>

        <p><?php echo $value1;?></p>
      <?php } ?>

    </div>
    <div class="pure-u-2-24">
      <i class="fa fa-times pure-alert-close"></i>
    </div>
  </div>
<?php } ?>


  <div class="clear"></div>
