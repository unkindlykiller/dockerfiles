<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head><?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?></head>
<body>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>

<?php $dateFormat=$this->var['dateFormat']=!empty($conf->get('config.MATERIAL_PHP_DATE_PATTERN')) ? $conf->get('config.MATERIAL_PHP_DATE_PATTERN') : '%c';?>
<?php $qrCodeDisabled=$this->var['qrCodeDisabled']=!empty($conf->get('config.MATERIAL_NO_QRCODE')) ? $conf->get('config.MATERIAL_NO_QRCODE') : false;?>

<div id="linklist" class="container">
    <?php $counter1=-1; if( isset($plugin_start_zone) && is_array($plugin_start_zone) && sizeof($plugin_start_zone) ) foreach( $plugin_start_zone as $key1 => $value1 ){ $counter1++; ?>
         <?php echo $value1;?>
    <?php } ?>

    <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("linklist.paging") . ( substr("linklist.paging",-1,1) != "/" ? "/" : "" ) . basename("linklist.paging") );?>

    <?php if( count($links)==0 ){ ?>
        <div class="text-center">
            <img src="tpl/material/dist/img/sad_star.png" alt="Nothing found" />
        </div>
        <div class="nothing-found">Sorry... We found nothing<?php if( !empty($search_term) ){ ?> for <strong><?php echo $search_term;?></strong><?php } ?><?php if( !empty($search_tags) ){ ?><?php $exploded_tags=$this->var['exploded_tags']=explode(' ', $search_tags);?> tagged <strong><?php $counter1=-1; if( isset($exploded_tags) && is_array($exploded_tags) && sizeof($exploded_tags) ) foreach( $exploded_tags as $key1 => $value1 ){ $counter1++; ?> <?php echo $value1;?><?php } ?></strong><?php } ?>.</div>
    <?php }elseif( !empty($search_term) or !empty($search_tags) or !empty($visibility) or $untaggedonly ){ ?>
        <div id="searchcriteria">
            <?php echo sprintf(t('%s result', '%s results', $result_count), $result_count); ?>
            <?php if( !empty($search_term) ){ ?> <?php echo t( 'for' );?> <strong><?php echo $search_term;?></strong><?php } ?>
            <?php if( !empty($search_tags) ){ ?><?php $exploded_tags=$this->var['exploded_tags']=explode(' ', $search_tags);?> <?php echo t( 'tagged' );?> <i>
            <?php $counter1=-1; if( isset($exploded_tags) && is_array($exploded_tags) && sizeof($exploded_tags) ) foreach( $exploded_tags as $key1 => $value1 ){ $counter1++; ?>
                <a href="?removetag=<?php echo $value1;?>" class="link-tag-filter" title="<?php echo t( 'Remove tag' );?>"><?php echo $value1;?>&nbsp;
                    <span class="remove">&#x2715;</span>
                </a>
            <?php } ?>
            </i>
            <?php } ?>
            <?php if( !empty($visibility) ){ ?>
                <?php echo t( 'with status' );?>
                <strong>
                    <?php echo t( $visibility );?>
                </strong>
            <?php } ?>
            <?php if( $untaggedonly ){ ?>
                <strong>
                    <?php echo t( 'without any tag' );?>
                </strong>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="links-list">

        
        <?php $strPrivate=$this->var['strPrivate']=t('Private');?>
        <?php $strEdit=$this->var['strEdit']=t('Edit');?>
        <?php $strDelete=$this->var['strDelete']=t('Delete');?>
        <?php $strFold=$this->var['strFold']=t('Fold');?>
        <?php $strEdited=$this->var['strEdited']=t('Edited: ');?>
        <?php $strPermalink=$this->var['strPermalink']=t('Permalink');?>
        <?php $strPermalinkLc=$this->var['strPermalinkLc']=t('permalink');?>
        <?php $strAddTag=$this->var['strAddTag']=t('Add tag');?>
        <?php $strToggleSticky=$this->var['strToggleSticky']=t('Toggle sticky');?>
        <?php $strSticky=$this->var['strSticky']=t('Sticky');?>
        

        <?php $counter1=-1; if( isset($links) && is_array($links) && sizeof($links) ) foreach( $links as $key1 => $value1 ){ $counter1++; ?>
            <div id="<?php echo $value1["id"];?>" class="link-outer<?php if( $value1["class"] ){ ?> <?php echo $value1["class"];?><?php } ?>">
                <div class="link-overlay"></div>
                <div class="link-inner">
                    <div class="link-header">
                        <div class="row">
                            <div class="col-sm-8">
                                <a class="link-title" href="<?php echo $value1["real_url"];?>">
                                    <?php if( strpos($value1["url"], $value1["shorturl"]) !== false ){ ?>
                                    <i class="mdi mdi-note"></i>
                                    <?php } ?>
                                    <?php echo $value1["title"];?>
                                </a>
                                <a href="<?php echo $value1["real_url"];?>" class="link-url"><span title="Real URL"><?php echo $value1["real_url"];?></span></a>
                            </div>
                            <div class="col-sm-4">
                                <div class="link-date">
                                    <?php if( !$hide_timestamps || $is_logged_in ){ ?>
                                        <span title="Permalink - <?php echo strftime($dateFormat, $value1["timestamp"]); ?>"><a href="?<?php echo $value1["shorturl"];?>" class="link-actual-date"><?php echo strftime($dateFormat, $value1["timestamp"]); ?></a></span>
                                    <?php }else{ ?>
                                        <span title="Short link here"><a href="?<?php echo $value1["shorturl"];?>">Permalink</a></span>
                                    <?php } ?>
                                    <?php $counter2=-1; if( isset($value1["link_plugin"]) && is_array($value1["link_plugin"]) && sizeof($value1["link_plugin"]) ) foreach( $value1["link_plugin"] as $key2 => $value2 ){ $counter2++; ?>
                                        <span class="link-plugin"><?php echo $value2;?></span>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="link-content">
                        <div>
                            <?php if( $thumbnails_enabled && !empty($value1["thumbnail"]) ){ ?>
                            <div class="thumb">
                                <a href="<?php echo $value1["real_url"];?>">
                                  
                                  <img data-src="<?php echo $value1["thumbnail"];?>" class="b-lazy"
                                    src="#"
                                    alt="thumbnail" width="<?php echo $thumbnails_width;?>" height="<?php echo $thumbnails_height;?>" />
                                  </a>
                            </div>
                            <?php } ?>
                            <?php if( $value1["description"] ){ ?>
                                <div class="link-description"><?php echo $value1["description"];?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="link-footer is-flex">
                        <div class="link-tag-list is-flex-grown">
                        <?php if( $value1["tags"] ){ ?>
                            <?php $counter2=-1; if( isset($value1["taglist"]) && is_array($value1["taglist"]) && sizeof($value1["taglist"]) ) foreach( $value1["taglist"] as $key2 => $value2 ){ $counter2++; ?>
                                <span class="link-tag" title="Find links with the same tag"><a href="?addtag=<?php echo urlencode( $value2 );?>"><?php echo $value2;?></a></span>
                            <?php } ?>
                        <?php } ?>
                        </div>
                        
                        <div class="link-actions is-flex-end">
                            <?php if( !$qrCodeDisabled ){ ?>
                                <a href="http://qrfree.kaywa.com/?l=1&amp;s=8&amp;d=<?php echo urlencode( $value1["real_url"] );?>" data-permalink="<?php echo urlencode( $value1["real_url"] );?>" title="Show link QR Code" class="qrcode"><i class="mdi mdi-qrcode"></i></a>
                            <?php } ?>
                            <?php if( $is_logged_in ){ ?>
                                <a href="?delete_link&amp;lf_linkdate=<?php echo $value1["id"];?>&amp;token=<?php echo $token;?>" title="<?php echo $strDelete;?>" class="button-delete"><i class="mdi mdi-delete"></i></a>
                                <a href="?edit_link=<?php echo $value1["id"];?>" title="<?php echo $strEdit;?>"><i class="mdi mdi-pencil"></i></a>
                                <a href="?do=pin&amp;id=<?php echo $value1["id"];?>&amp;token=<?php echo $token;?>" title="<?php echo $strToggleSticky;?>" <?php if( isset($value1["sticky"]) && $value1["sticky"] ){ ?>class="is-pinned"<?php } ?>><i class="mdi mdi-pin"></i></a>
                            <?php }else{ ?>
                                <?php if( isset($value1["sticky"]) && $value1["sticky"] ){ ?>
                                <span title="<?php echo $strSticky;?>"><i class="mdi mdi-pin"></i></span>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("linklist.paging") . ( substr("linklist.paging",-1,1) != "/" ? "/" : "" ) . basename("linklist.paging") );?>
    
    <?php $counter1=-1; if( isset($plugin_end_zone) && is_array($plugin_end_zone) && sizeof($plugin_end_zone) ) foreach( $plugin_end_zone as $key1 => $value1 ){ $counter1++; ?>
        <?php echo $value1;?>
    <?php } ?>
</div>

<?php if( !empty($linkcount) ){ ?>
<div class="container text-center link-counter">
    <em><?php echo $linkcount;?> link<?php if( $linkcount > 1 ){ ?>s<?php } ?><?php if( !empty($privateLinkcount) ){ ?>, including <?php echo $privateLinkcount;?> private<?php } ?></em>
</div>
<?php } ?>

    <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>
</body>
</html>
