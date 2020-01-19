<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?>

</head>
<body>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>


<?php $ratioLabel=$this->var['ratioLabel']='5-12';?>

<?php $ratioLabelMobile=$this->var['ratioLabelMobile']='7-8';?>

<?php $ratioInput=$this->var['ratioInput']='7-12';?>

<?php $ratioInputMobile=$this->var['ratioInputMobile']='1-8';?>


<form method="POST" action="#" name="configform" id="configform">
  <div class="pure-g">
    <div class="pure-u-lg-1-8 pure-u-1-24"></div>
    <div class="pure-u-lg-3-4 pure-u-22-24 page-form page-form-complete">
      <h2 class="window-title"><?php echo t( 'Configure' );?></h2>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-1">
          <div class="form-label">
            <label for="title">
              <span class="label-name">Shaarli <?php echo t( 'title' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-7-12 pure-u-1">
          <div class="form-input">
            <input type="text" name="title" id="title" size="50" value="<?php echo $title;?>">
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-1">
          <div class="form-label">
            <label for="titleLink">
              <span class="label-name"><?php echo t( 'Home link' );?></span><br>
              <span class="label-desc"><?php echo t( 'Default value' );?>: ?</span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-1">
          <div class="form-input">
            <input type="text" name="titleLink" id="titleLink" size="50" value="<?php echo $titleLink;?>">
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-1">
          <div class="form-label">
            <label for="titleLink">
              <span class="label-name"><?php echo t( 'Theme' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-1">
          <div class="form-input">
            <select name="theme" id="theme" class="align">
              <?php $counter1=-1; if( isset($theme_available) && is_array($theme_available) && sizeof($theme_available) ) foreach( $theme_available as $key1 => $value1 ){ $counter1++; ?>

                <option value="<?php echo $value1;?>"
                  <?php if( $value1===$theme ){ ?>

                    selected="selected"
                  <?php } ?>

                >
                  <?php echo ucfirst( $value1 );?>

                </option>
              <?php } ?>

            </select>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-1">
          <div class="form-label">
            <label for="language">
              <span class="label-name"><?php echo t( 'Language' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-1">
          <div class="form-input">
            <select name="language" id="language" class="align">
              <?php $counter1=-1; if( isset($languages) && is_array($languages) && sizeof($languages) ) foreach( $languages as $key1 => $value1 ){ $counter1++; ?>

                <option value="<?php echo $key1;?>"
                      <?php if( $key1===$language ){ ?>

                      selected="selected"
                      <?php } ?>

                >
                  <?php echo $value1;?>

                </option>
              <?php } ?>

            </select>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-1 ">
          <div class="form-label">
            <label>
              <span class="label-name"><?php echo t( 'Timezone' );?></span><br>
              <span class="label-desc"><?php echo t( 'Continent' );?> &middot; <?php echo t( 'City' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-1 ">
          <div class="form-input">
            <div class="timezone">
              <select id="continent" name="continent">
                <?php $counter1=-1; if( isset($continents) && is_array($continents) && sizeof($continents) ) foreach( $continents as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $key1 !== 'selected' ){ ?>

                    <option value="<?php echo $value1;?>" <?php if( $continents["selected"] === $value1 ){ ?>selected<?php } ?>>
                      <?php echo $value1;?>

                    </option>
                  <?php } ?>

                <?php } ?>

              </select>
              <select id="city" name="city">
                <?php $counter1=-1; if( isset($cities) && is_array($cities) && sizeof($cities) ) foreach( $cities as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $key1 !== 'selected' ){ ?>

                    <option value="<?php echo $value1["city"];?>"
                            <?php if( $cities["selected"] === $value1["city"] ){ ?>selected<?php } ?>

                            data-continent="<?php echo $value1["continent"];?>">
                      <?php echo $value1["city"];?>

                    </option>
                  <?php } ?>

                <?php } ?>

              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-<?php echo $ratioLabelMobile;?> ">
          <div class="form-label">
            <label for="disablesessionprotection">
              <span class="label-name"><?php echo t( 'Disable session cookie hijacking protection' );?></span><br>
               <span class="label-desc">
                 <?php echo t( 'Check this if you get disconnected or if your IP address changes often' );?>

               </span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-<?php echo $ratioInputMobile;?> ">
          <div class="form-input">
            <input type="checkbox" name="disablesessionprotection" id="disablesessionprotection"
                   <?php if( $session_protection_disabled ){ ?>checked<?php } ?>>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-<?php echo $ratioLabelMobile;?> ">
          <div class="form-label">
            <label for="privateLinkByDefault">
              <span class="label-name"><?php echo t( 'Private links by default' );?></span><br>
              <span class="label-desc"><?php echo t( 'All new links are private by default' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-<?php echo $ratioInputMobile;?> ">
          <div class="form-input">
            <input type="checkbox" name="privateLinkByDefault" id="privateLinkByDefault"
                   <?php if( $private_links_default ){ ?>checked<?php } ?>/>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-<?php echo $ratioLabelMobile;?> ">
          <div class="form-label">
            <label for="enableRssPermalinks">
              <span class="label-name"><?php echo t( 'RSS direct links' );?></span><br>
              <span class="label-desc"><?php echo t( 'Check this to use direct URL instead of permalink in feeds' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-<?php echo $ratioInputMobile;?> ">
          <div class="form-input">
            <input type="checkbox" name="enableRssPermalinks" id="enableRssPermalinks"
                 <?php if( $enable_rss_permalinks ){ ?>checked<?php } ?>/>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-<?php echo $ratioLabelMobile;?>">
          <div class="form-label">
            <label for="hidePublicLinks">
              <span class="label-name"><?php echo t( 'Hide public links' );?></span><br>
              <span class="label-desc"><?php echo t( 'Do not show any links if the user is not logged in' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-<?php echo $ratioInputMobile;?>">
          <div class="form-input">
            <input type="checkbox" name="hidePublicLinks" id="hidePublicLinks"
                   <?php if( $hide_public_links ){ ?>checked<?php } ?>/>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-<?php echo $ratioLabelMobile;?>">
          <div class="form-label">
            <label for="hidePublicLinks">
              <span class="label-name"><?php echo t( 'Check updates' );?></span><br>
              <span class="label-desc"><?php echo t( 'Notify me when a new release is ready' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-<?php echo $ratioInputMobile;?>">
          <div class="form-input">
            <input type="checkbox" name="updateCheck" id="updateCheck"
                 <?php if( $enable_update_check ){ ?>checked<?php } ?>/>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-<?php echo $ratioLabelMobile;?>">
          <div class="form-label">
            <label for="enableApi">
              <span class="label-name"><?php echo t( 'Enable REST API' );?></span><br>
              <span class="label-desc"><?php echo t( 'Allow third party software to use Shaarli such as mobile application' );?></span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-<?php echo $ratioInputMobile;?>">
          <div class="form-input">
            <input type="checkbox" name="enableApi" id="enableApi"
                 <?php if( $api_enabled ){ ?>checked<?php } ?>/>
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-1">
          <div class="form-label">
            <label for="apiSecret">
              <span class="label-name"><?php echo t( 'API secret' );?></span><br>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-1">
          <div class="form-input">
            <input type="text" name="apiSecret" id="apiSecret" size="50" value="<?php echo $api_secret;?>">
          </div>
        </div>
      </div>
      <div class="pure-g">
        <div class="pure-u-lg-<?php echo $ratioLabel;?> pure-u-<?php echo $ratioLabelMobile;?>">
          <div class="form-label">
            <label for="enableThumbnails">
              <span class="label-name"><?php echo t( 'Enable thumbnails' );?></span><br>
              <span class="label-desc">
                <?php if( ! $gd_enabled ){ ?>

                  <?php echo t( 'You need to enable the extension <code>php-gd</code> to use thumbnails.' );?>

                <?php }elseif( $thumbnails_enabled ){ ?>

                  <a href="?do=thumbs_update"><?php echo t( 'Synchronize thumbnails' );?></a>
                <?php } ?>

              </span>
            </label>
          </div>
        </div>
        <div class="pure-u-lg-<?php echo $ratioInput;?> pure-u-<?php echo $ratioInputMobile;?>">
          <div class="form-input">
            <select name="enableThumbnails" id="enableThumbnails" class="align">
              <option value="all"    <?php if( $thumbnails_mode=='all' ){ ?>selected<?php } ?>>
                <?php echo t( 'All' );?>

              </option>
              <option value="common" <?php if( $thumbnails_mode=='common' ){ ?>selected<?php } ?>>
                <?php echo t( 'Only common media hosts' );?>

              </option>
              <option value="none"   <?php if( $thumbnails_mode=='none' ){ ?>selected<?php } ?>>
                <?php echo t( 'None' );?>

              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="center">
        <input type="submit" value="<?php echo t( 'Save' );?>" name="save">
      </div>
    </div>
  </div>
  <input type="hidden" name="token" value="<?php echo $token;?>">
</form>

<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>

</body>
</html>

