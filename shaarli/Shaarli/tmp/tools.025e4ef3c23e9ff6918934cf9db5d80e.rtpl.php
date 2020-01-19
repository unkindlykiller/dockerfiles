<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head><?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?></head>
<body>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>
<div id="toolsdiv" class="page-tools container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <h1 class="card-header"><?php echo t( 'Settings' );?></h1>
                <div class="list-action list-big">
                    <a class="list-item ripple" href="?do=configure">
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <div class="round-image-container">
                                    <i class="mdi mdi-settings" title="<?php echo t( 'Configure your Shaarli' );?>"></i>
                                </div>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <div class="list-item-label"><?php echo t( 'Configure your Shaarli' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Change Title, timezone...' );?></div>
                            </div>
                        </div>
                    </a>
                    <?php if( !$openshaarli ){ ?>
                    <a class="list-item ripple" href="?do=changepasswd">
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <div class="round-image-container">
                                    <i class="mdi mdi-lock" title="<?php echo t( 'Change password' );?>"></i>
                                </div>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <div class="list-item-label"><?php echo t( 'Change password' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Change your password' );?></div>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                    <a class="list-item ripple" href="?do=pluginadmin">
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <div class="round-image-container">
                                    <i class="mdi mdi-puzzle" title="<?php echo t( 'Plugin administration' );?>"></i>
                                </div>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <div class="list-item-label"><?php echo t( 'Plugin administration' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Enable, disable and configure plugins' );?></div>
                            </div>
                        </div>
                    </a>
                    <a class="list-item ripple" href="?do=changetag">
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <div class="round-image-container">
                                    <i class="mdi mdi-tag-multiple" title="<?php echo t( 'Tags' );?>"></i>
                                </div>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <div class="list-item-label"><?php echo t( 'Tags' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Rename or delete a tag in all links' );?></div>
                            </div>
                        </div>
                    </a>
                    <a class="list-item ripple" href="?do=import">
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <div class="round-image-container">
                                    <i class="mdi mdi-file-import" title="<?php echo t( 'Import' );?>"></i>
                                </div>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <div class="list-item-label"><?php echo t( 'Import' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Import Netscape html bookmarks (as exported from Firefox, Chrome, Opera, delicious...)' );?></div>
                            </div>
                        </div>
                    </a>
                    <a class="list-item ripple" href="?do=export">
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <div class="round-image-container">
                                    <i class="mdi mdi-file-export" title="<?php echo t( 'Export' );?>"></i>
                                </div>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <div class="list-item-label"><?php echo t( 'Export' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Export Netscape html bookmarks (which can be imported in Firefox, Chrome, Opera, delicious...)' );?></div>
                            </div>
                        </div>
                    </a>
                    <a class="list-item ripple" href="?do=thumbs_update">
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <div class="round-image-container">
                                    <i class="mdi mdi-image" title="<?php echo t( 'Synchronize thumbnails' );?>"></i>
                                </div>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <div class="list-item-label"><?php echo t( 'Synchronize thumbnails' );?></div>
                                <div class="list-item-sublabel"><?php echo t( 'Downloads shaares thumbnails according to your settings' );?></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php if( isset($tools_plugin) ){ ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <hr class="darker"/>
            <h2 class="mtm">Plugin settings</h2>
            <?php $counter1=-1; if( isset($tools_plugin) && is_array($tools_plugin) && sizeof($tools_plugin) ) foreach( $tools_plugin as $key1 => $value1 ){ $counter1++; ?>
                <?php echo $value1;?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <hr class="darker"/>
            <h2 class="mtm">Bookmarklet</h2>
            <p>You can easily bookmark links from anywhere on the web via bookmarklets right below.</p>
            <p>They can be dragged and dropped among your browser's bookmarks. Then, you just have to click on them from your bookmarks menu.</p>
            <div class="row">
                <div class="col-xs-6 text-center">
                    <a class="bookmarklet" href="javascript:javascript:(function(){var%20url%20=%20location.href;var%20title%20=%20document.title%20||%20url;window.open('<?php echo $pageabsaddr;?>?post='%20+%20encodeURIComponent(url)+'&amp;title='%20+%20encodeURIComponent(title)+'&amp;description='%20+%20encodeURIComponent(document.getSelection())+'&amp;source=bookmarklet','_blank','menubar=no,height=720,width=600,toolbar=no,scrollbars=yes,status=no,dialog=1');})();">
                        <img src="tpl/material/dist/img/tools/star-circle.png" alt="Favicon" /> <?php echo t( 'Shaare link' );?>
                    </a>
                </div>
                <div class="col-xs-6 text-center">
                    <a class="bookmarklet" href="?private=1&post=">
                        <img src="tpl/material/dist/img/tools/star-circle.png" alt="Favicon" /> <?php echo t( 'Add Note' );?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <hr class="darker"/>
            <h2 class="mtm" id="firefox-api-title">Firefox Social API integration</h2>
            <p>Adds Shaarli to the <em>Share this page</em> button in Firefox.</p>
            <?php if( !$sslenabled ){ ?>
            <p class="highlight"><?php echo t( 'You need to browse your Shaarli over <strong>HTTPS</strong> to use this functionality.' );?></p>
            <?php } ?>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <button type="button" id="firefoxsocial" class="firefoxsocial button-raised button-firefox" <?php if( !$sslenabled ){ ?>disabled<?php } ?>>
                        Activate Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <hr class="darker"/>
            <h2 class="mtm" id="firefox-api-title"><?php echo t( '3rd party' );?></h2>
            <ul>
                <li>
                    <a href="https://addons.mozilla.org/fr/firefox/addon/shaarli/" title="Firefox <?php echo t( 'Plugin' );?>" class="large-icon-button ripple">
                        <i class="mdi mdi-firefox"></i>
                        Firefox <?php echo t( 'plugin' );?>
                    </a>
                </li>
                <li>
                    <a href="https://chrome.google.com/webstore/detail/shiny-shaarli/hajdfkmbdmadjmmpkkbbcnllepomekin" title="Chrome <?php echo t( 'Plugin' );?>" class="large-icon-button ripple">
                        <i class="mdi mdi-google-chrome"></i>
                        Chrome <?php echo t( 'plugin' );?>
                    </a>
                </li>
                <li>
                    <a href="https://play.google.com/store/apps/details?id=com.dimtion.shaarlier" title="Android Shaarlier" class="large-icon-button ripple">
                        <i class="mdi mdi-android"></i>
                        Shaarlier
                    </a>
                </li>
                <li>
                    <a href="https://stakali.toneiv.eu/" title="Android Stakali" class="large-icon-button ripple">
                        <i class="mdi mdi-android"></i>
                        Stakali
                    </a>
                </li>
                <li>
                    <a href="https://itunes.apple.com/app/ShaarliOS/id1027441388" class="large-icon-button ripple">
                        <i class="mdi mdi-apple-ios"></i>
                        iOS
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <?php $counter1=-1; if( isset($tools_plugin) && is_array($tools_plugin) && sizeof($tools_plugin) ) foreach( $tools_plugin as $key1 => $value1 ){ $counter1++; ?>
        <?php echo $value1;?>
    <?php } ?>
</div>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>
</body>
</html>
