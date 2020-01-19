<?php if(!class_exists('raintpl')){exit;}?><?php if( (!empty($_GET['source']) && $_GET['source'] == 'bookmarklet') || $source == 'firefoxsocialapi' ){ ?>
    
<?php }else{ ?>
    <div class="header-main container-fluid">
        <div class="row">
            <div class="col-lg-3 is-flex">
                <a href="?" class="header-brand ripple"><?php echo $shaarlititle;?></a>
                <a href="#" class="icon-unfold hidden-lg ripple" title="Show/hide menu"><i class="mdi mdi-chevron-down"></i></a>
            </div>
            <div class="col-lg-6 header-middle">
                        <button class="toolbar-link button-inverse ripple" id="button-search"><?php echo t( 'Search' );?></button>
            </div>
            <div class="col-lg-3">
                <div class="header-buttons">
                    <?php if( isset($plugins_header["buttons_toolbar"]) ||isset($plugins_header["fields_toolbar"]) ){ ?>
                        <div class="toolbar-button-container">
                            <button type="button" class="icon-header popup-trigger ripple" data-popup="popup-plugin" title="More">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div id="popup-plugin" class="popup popup-plugin hidden">
                                <div class="popup-title">Plugins<button class="popup-close"><i class="mdi mdi-close"></i></button></div>
                                <div class="popup-body">
                                    <?php $counter1=-1; if( isset($plugins_header["buttons_toolbar"]) && is_array($plugins_header["buttons_toolbar"]) && sizeof($plugins_header["buttons_toolbar"]) ) foreach( $plugins_header["buttons_toolbar"] as $key1 => $value1 ){ $counter1++; ?>
                                    <ul>
                                        <li>
                                            <a
                                                <?php $counter2=-1; if( isset($value1["attr"]) && is_array($value1["attr"]) && sizeof($value1["attr"]) ) foreach( $value1["attr"] as $key2 => $value2 ){ $counter2++; ?>
                                                    <?php echo $key2;?>="<?php echo $value2;?>"
                                                <?php } ?>>
                                                <?php echo $value1["html"];?>
                                            </a>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                    <?php $counter1=-1; if( isset($plugins_header["fields_toolbar"]) && is_array($plugins_header["fields_toolbar"]) && sizeof($plugins_header["fields_toolbar"]) ) foreach( $plugins_header["fields_toolbar"] as $key1 => $value1 ){ $counter1++; ?>
                                        <form class="popup-content-area" 
                                            <?php $counter2=-1; if( isset($value1["attr"]) && is_array($value1["attr"]) && sizeof($value1["attr"]) ) foreach( $value1["attr"] as $key2 => $value2 ){ $counter2++; ?>
                                                <?php echo $key2;?>="<?php echo $value2;?>"
                                            <?php } ?> >
                                            <?php $counter2=-1; if( isset($value1["inputs"]) && is_array($value1["inputs"]) && sizeof($value1["inputs"]) ) foreach( $value1["inputs"] as $key2 => $value2 ){ $counter2++; ?>
                                                <input
                                                    <?php $counter3=-1; if( isset($value2) && is_array($value2) && sizeof($value2) ) foreach( $value2 as $key3 => $value3 ){ $counter3++; ?>
                                                        <?php echo $key3;?>="<?php echo $value3;?>"
                                                    <?php } ?>>
                                            <?php } ?>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if( $is_logged_in ){ ?>
                        <a href="?do=logout" class="icon-header popup-trigger ripple" title="<?php echo t( 'Logout' );?>">
                            <i class="mdi mdi-logout"></i>
                        </a>
                        <a href="?do=tools" class="icon-header ripple" title="<?php echo t( 'Tools' );?>">
                            <i class="mdi mdi-settings"></i>
                        </a>
                    <?php }elseif( $openshaarli ){ ?>
                        <a href="?do=tools" class="icon-header ripple" title="<?php echo t( 'Tools' );?>">
                            <i class="mdi mdi-settings"></i>
                        </a>
                    <?php }else{ ?>
                        <a href="?do=login" class="icon-header popup-trigger ripple" title="<?php echo t( 'Login' );?>">
                            <i class="mdi mdi-account"></i>
                        </a>
                    <?php } ?>
                    <div class="toolbar-button-container">
                        <button type="button" class="icon-header popup-trigger ripple" data-popup="popup-rss" title="<?php echo t( 'RSS Feed' );?>">
                            <i class="mdi mdi-rss"></i>
                        </button>
                        <div id="popup-rss" class="popup popup-rss hidden">
                            <div class="popup-title"><?php echo t( 'RSS Feed' );?><button class="popup-close"><i class="mdi mdi-close"></i></button></div>
                            <div class="popup-body">
                                <ul>
                                    <li><a href="<?php echo $feedurl;?>?do=rss<?php echo $searchcrits;?>" class="ripple"><?php echo t( 'RSS Feed' );?></a></li>
                                    <?php if( $showatom ){ ?>
                                    <li><a href="<?php echo $feedurl;?>?do=atom<?php echo $searchcrits;?>" class="ripple">ATOM Feed</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo $feedurl;?>?do=dailyrss" class="ripple" title="1 RSS entry per day">Daily Feed</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php if( $is_logged_in ){ ?>
                    <div class="toolbar-button-container">
                        <button type="button" class="icon-header ripple batch-trigger" title="Select multiple links for deletion">
                            <i class="mdi mdi-checkbox-marked-outline"></i>
                        </button>
                    </div>
                    <?php } ?>
                    <div class="toolbar-button-container">
                        <button type="button" class="popup-trigger icon-header ripple" data-popup="popup-filter" title="<?php echo t( 'Filters' );?>">
                            <i class="mdi mdi-filter"></i>
                            <?php if( $visibility==='private' || $visibility==='public' || $untaggedonly ){ ?><div class="red-dot"></div><?php } ?>
                        </button>
                        <div id="popup-filter" class="popup popup-filter hidden">
                            <div class="popup-title"><?php echo t( 'Filters' );?><button class="popup-close"><i class="mdi mdi-close"></i></button></div>
                            <div class="popup-body">
                                <h2><?php echo t( 'Links per page' );?></h2>
                                <ul class="filters-links-per-page">
                                    <li><a href="?linksperpage=20" class="ripple">20 links</a></li>
                                    <li><a href="?linksperpage=50" class="ripple">50 links</a></li>
                                    <li><a href="?linksperpage=100" class="ripple">100 links</a></li>
                                </ul>
                                <form method="GET" class="popup-content-area">
                                    <input type="text" name="linksperpage" size="2" placeholder="Custom value..."/>
                                </form>

                                <h2><?php echo t( 'Display' );?></h2>
                                <div class="list-side-right">
                                    <div class="list-body">
                                        <?php if( $is_logged_in ){ ?>
                                        <div class="list-item">
                                            <div class="list-item-content">
                                                <div class="list-item-label"><?php echo t( 'Only display private links' );?></div>
                                            </div>
                                            <div class="list-item-side">
                                                <div class="switch">
                                                    <label data-url="?visibility=private">
                                                        <input type="checkbox" name="input-visibility-private" id="input-visibility-private" <?php if( $visibility==='private' ){ ?>checked<?php } ?>/>
                                                        <span class="lever"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item">
                                            <div class="list-item-content">
                                                <div class="list-item-label"><?php echo t( 'Only display public links' );?></div>
                                            </div>
                                            <div class="list-item-side">
                                                <div class="switch">
                                                    <label data-url="?visibility=public">
                                                        <input type="checkbox" name="input-visibility-public" id="input-visibility-public" <?php if( $visibility==='public' ){ ?>checked<?php } ?>/>
                                                        <span class="lever"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="list-item">
                                            <div class="list-item-content">
                                                <div class="list-item-label"><?php echo t( 'Filter untagged links' );?></div>
                                            </div>
                                            <div class="list-item-side">
                                                <div class="switch">
                                                    <label data-url="?untaggedonly">
                                                        <input type="checkbox" name="input-untaggedonly" id="input-untaggedonly" <?php if( $untaggedonly ){ ?>checked<?php } ?>/>
                                                        <span class="lever"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if( ($is_logged_in || $openshaarli) && !isset($_GET['edit_link']) && !isset($_GET['post']) && (!isset($_GET['do']) || !in_array($_GET['do'], array('addlink', 'changepasswd', 'configure', 'changetag', 'import', 'export'))) ){ ?>
        <a href="?do=addlink" class="button-floating ripple">
            <i class="icon-add-link mdi mdi-plus"></i>
        </a>
    <?php } ?>
    <form id="hidden-tag-form" class="hidden" method="GET" name="tagfilter">
        <input type="hidden" name="searchtags" id="tagfilter_value" value=""/>
    </form>

    <?php if( !empty($plugin_errors) && $is_logged_in ){ ?>
        <div class="errors">
            <ul class="container">
                <?php $counter1=-1; if( isset($plugin_errors) && is_array($plugin_errors) && sizeof($plugin_errors) ) foreach( $plugin_errors as $key1 => $value1 ){ $counter1++; ?>
                    <li><?php echo $value1;?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

    <?php if( !empty($global_warnings) && $is_logged_in ){ ?>
        <div class="warnings">
            <ul class="container">
                <?php $counter1=-1; if( isset($global_warnings) && is_array($global_warnings) && sizeof($global_warnings) ) foreach( $global_warnings as $key1 => $value1 ){ $counter1++; ?>
                    <li><?php echo $value1;?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
<?php } ?>

<div id="search-overlay" class="fullscreen hidden">
    <div class="content-fullscreen">
        <div class="container">
            <div class="mbl row">
                <form method="GET" id="form-search" class="col-md-8 col-md-offset-2">
                    <div class="search-field">
                        <input type="search" id="searchform_value" class="input-big" name="searchterm" 
                            value="<?php if( isset($search_type) ){ ?><?php if( $search_type=='fulltext' ){ ?><?php echo $search_crits;?><?php }elseif( $search_type=='tags' ){ ?><?php $counter1=-1; if( isset($search_crits) && is_array($search_crits) && sizeof($search_crits) ) foreach( $search_crits as $key1 => $value1 ){ $counter1++; ?><?php echo $value1;?> <?php } ?><?php }else{ ?><?php } ?><?php } ?>" 
                            placeholder="Search..." autocomplete="off" data-multiple data-minChars="1"
                            data-list="<?php $counter1=-1; if( isset($tags) && is_array($tags) && sizeof($tags) ) foreach( $tags as $key1 => $value1 ){ $counter1++; ?><?php echo $key1;?>, <?php } ?>" />    
                        <div class="search-overlay-actions">
                            <button type="button" id="button-filter" class="button-raised ripple ripple-primary">
                                <i class="visible-xs mdi mdi-tag-multiple"></i>
                                <span class="hidden-xs"><i class="mdi mdi-magnify"></i><?php echo t( 'tags' );?></span>
                            </button>    
                            <button type="submit" id="button-search" class="button-raised button-primary ripple">
                                <i class="mdi mdi-magnify"></i>
                                <span class="hidden-xs"><?php echo t( 'search' );?></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="overlay" class="overlay hidden"></div>
