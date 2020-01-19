<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head><?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?></head>
<body onload="document.configform.title.focus();">
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>
<div class="container page-configure">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="#" name="configform" id="configform" class="card">
                <input type="hidden" name="token" value="<?php echo $token;?>"/>
                <div class="card-title">Configuration</div>
                <div class="card-body">
                    <div class="form-entry">
                        <label for="title">Shaarli <?php echo t( 'title' );?></label>
                        <input type="text" name="title" id="title" size="50" value="<?php echo $title;?>" />
                    </div>
                    <div class="form-entry">
                        <label for="titleLink"><?php echo t( 'Home link' );?></label>
                        <input type="text" name="titleLink" id="titleLink" size="50" value="<?php echo $titleLink;?>">
                        <div class="sublabel">(default value is: ?)</div>
                    </div>
                    <div class="form-entry">
                        <label for="theme"><?php echo t( 'Theme' );?></label>
                        <select name="theme" id="theme">
                        <?php $counter1=-1; if( isset($theme_available) && is_array($theme_available) && sizeof($theme_available) ) foreach( $theme_available as $key1 => $value1 ){ $counter1++; ?>
                            <option value="<?php echo $value1;?>" <?php if( $value1===$theme ){ ?>selected<?php } ?>>
                                <?php echo ucfirst( $value1 );?>
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-entry">
                        <label for="language"><?php echo t( 'Language' );?></label>
                        <select name="language" id="language">
                        <?php $counter1=-1; if( isset($languages) && is_array($languages) && sizeof($languages) ) foreach( $languages as $key1 => $value1 ){ $counter1++; ?>
                            <option value="<?php echo $key1;?>" <?php if( $key1===$language ){ ?>selected<?php } ?>>
                                <?php echo ucfirst( $value1 );?>
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-entry">
                        <label for="continent"><?php echo t( 'Timezone' );?></label>
                        <div class="row">
                            <div class="col-sm-6" id="timezone-continent">
                                <select name="continent" id="continent">
                                    <?php $counter1=-1; if( isset($continents) && is_array($continents) && sizeof($continents) ) foreach( $continents as $key1 => $value1 ){ $counter1++; ?>
                                        <?php if( $key1 !== 'selected' ){ ?>
                                            <option value="<?php echo $value1;?>" <?php if( $continents["selected"] === $value1 ){ ?>selected<?php } ?>>
                                                <?php echo $value1;?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6" id="timezone-city">
                                <select name="city" id="city">
                                    <?php $counter1=-1; if( isset($cities) && is_array($cities) && sizeof($cities) ) foreach( $cities as $key1 => $value1 ){ $counter1++; ?>
                                        <?php if( $key1 !== 'selected' ){ ?>
                                            <option value="<?php echo $value1["city"];?>" <?php if( $cities["selected"] === $value1["city"] ){ ?>selected<?php } ?> data-continent="<?php echo $value1["continent"];?>">
                                                <?php echo $value1["city"];?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="list-side-right">
                    <div class="list-body">
                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-label"><?php echo t( 'Disable session cookie hijacking protection' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Check this if you get disconnected or if your IP address changes often' );?></div>
                            </div>
                            <div class="list-item-side">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" name="disablesessionprotection" id="disablesessionprotection" <?php if( $session_protection_disabled ){ ?>checked<?php } ?>/>
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-label"><?php echo t( 'Private links by default' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'All new links are private by default' );?></div>
                            </div>
                            <div class="list-item-side">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" name="privateLinkByDefault" id="privateLinkByDefault" <?php if( $private_links_default ){ ?>checked<?php } ?>/>
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-label">Switch the RSS feed URLs between full URLs and shortlinks</div>
                                <div class="list-item-sublabel">Enabling it will show a permalink in the description, and the feed item will be linked to the absolute URL. Disabling it swaps this behaviour around (permalink in title and link in description).</div>
                            </div>
                            <div class="list-item-side">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" name="enableRssPermalinks" id="enableRssPermalinks" <?php if( $enable_rss_permalinks ){ ?>checked<?php } ?>/>
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-label"><?php echo t( 'Hide public links' );?></div>
                                <div class="list-item-sublabel">Will not show any link if the user is not logged in. Do NOT enable this if you want to make your Shaarli public.</div>
                            </div>
                            <div class="list-item-side">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" name="hidePublicLinks" id="hidePublicLinks" <?php if( $hide_public_links ){ ?>checked<?php } ?>/>
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-label"><?php echo t( 'Check updates' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Notify me when a new release is ready' );?></div>
                            </div>
                            <div class="list-item-side">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" name="updateCheck" id="updateCheck" <?php if( $enable_update_check ){ ?>checked<?php } ?>/>
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-label"><?php echo t( 'Enable thumbnails' );?></div>
                                <div class="list-item-sublabel">
                                    <?php if( ! $gd_enabled ){ ?>
                                        <?php echo t( 'You need to enable the extension <code>php-gd</code> to use thumbnails.' );?>
                                    <?php }elseif( $thumbnails_enabled ){ ?>
                                        <a href="?do=thumbs_update"><?php echo t( 'Synchronize thumbnails' );?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="list-item-side">
                                <select name="enableThumbnails" id="enableThumbnails" class="align">
                                    <option value="all" <?php if( $thumbnails_mode=='all' ){ ?>selected<?php } ?>>
                                        <?php echo t( 'All' );?>
                                    </option>
                                    <option value="common" <?php if( $thumbnails_mode=='common' ){ ?>selected<?php } ?>>
                                        <?php echo t( 'Only common media hosts' );?>
                                    </option>
                                    <option value="none" <?php if( $thumbnails_mode=='none' ){ ?>selected<?php } ?>>
                                        <?php echo t( 'None' );?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-label"><?php echo t( 'Enable REST API' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Allow third party software to use Shaarli such as mobile application' );?></div>
                            </div>
                            <div class="list-item-side">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" name="enableApi" id="enableApi" <?php if( $api_enabled ){ ?>checked<?php } ?>/>
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="list">
                    <div class="list-item">
                        <div class="form-entry">
                            <label for="apiSecret"><?php echo t( 'API secret' );?></label>
                            <input type="text" name="apiSecret" id="apiSecret" size="50" value="<?php echo $api_secret;?>" placeholder="Type a random string..." />
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" name="Save" class="button-raised button-primary pull-right"><?php echo t( 'Save' );?> config</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>
</body>
</html>
