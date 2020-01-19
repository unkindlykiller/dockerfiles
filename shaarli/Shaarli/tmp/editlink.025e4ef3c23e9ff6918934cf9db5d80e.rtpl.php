<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head>
    <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?>
</head>
<body
<?php if( $link["title"]=='' ){ ?>onload="document.linkform.lf_title.focus();"
<?php }elseif( $link["description"]=='' ){ ?>onload="document.linkform.lf_description.focus();"
<?php }else{ ?>onload="document.linkform.lf_tags.focus();"<?php } ?>
<?php if( !empty($_GET['source']) && $_GET['source']=='bookmarklet' ){ ?>class="from-bookmarklet"<?php } ?> >
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>
<div id="editlinkform" class="container page-edit">
    <div class="row" id="editlinkform-row">
        <div class="col-md-6 col-md-offset-3" id="editlinkform-col">
            <form method="POST" name="linkform" class="card">
                <input type="hidden" name="lf_linkdate" value="<?php echo $link["linkdate"];?>">
                <?php if( isset($link["id"]) ){ ?>
                   <input type="hidden" name="lf_id" value="<?php echo $link["id"];?>">
                <?php } ?>
                <input type="hidden" name="token" value="<?php echo $token;?>">
                <?php if( $http_referer ){ ?><input type="hidden" name="returnurl" value="<?php echo $http_referer;?>"><?php } ?>

                <div class="card-header">
                    <?php if( !$link_is_new ){ ?>Edit a link<?php }else{ ?>Add a new link<?php } ?>
                    <?php if( !$link_is_new ){ ?><span class="card-subheader"> - <?php echo t( 'created on' );?> <?php echo format_date( $link["created"] );?></span><?php } ?>
                    <button type="button" class="button-expand button-header visible-md visible-lg" title="Expand / reduce width"></button>
                </div>
                <div class="card-body">
                    <div class="form-entry">
                        <label for="lf_url"><?php echo t( 'URL' );?></label><br/>
                        <input type="text" name="lf_url" id="lf_url" value="<?php echo $link["url"];?>" placeholder="Type a url...">
                    </div>
                    <div class="form-entry">
                        <label for="lf_title"><?php echo t( 'Title' );?></label><br/>
                        <input type="text" name="lf_title" id="lf_title" value="<?php echo $link["title"];?>" placeholder="Title...">
                    </div>
                    <div class="form-entry">
                        <label for="lf_description"><?php echo t( 'Description' );?></label><br/>
                        <textarea name="lf_description" id="lf_description" placeholder="Describe the link..." rows="4"><?php echo $link["description"];?></textarea>
                    </div>
                    <div class="form-entry">
                        <label for="lf_tags"><?php echo t( 'Tags' );?></label><br/>
                        <input type="text" id="lf_tags" name="lf_tags" id="lf_tags" value="<?php echo $link["tags"];?>" class="lf_input"
                            data-list="<?php $counter1=-1; if( isset($tags) && is_array($tags) && sizeof($tags) ) foreach( $tags as $key1 => $value1 ){ $counter1++; ?><?php echo $key1;?>, <?php } ?>" data-multiple autocomplete="off" />
                    </div>
                    <?php if( isset($edit_link_plugin) ){ ?>
                    <div class="form-entry">
                        <?php $counter1=-1; if( isset($edit_link_plugin) && is_array($edit_link_plugin) && sizeof($edit_link_plugin) ) foreach( $edit_link_plugin as $key1 => $value1 ){ $counter1++; ?>
                             <?php echo $value1;?>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="form-entry">
                        <input type="checkbox" class="filled-in" <?php if( ($link_is_new && $default_private_links) || $link["private"] == true ){ ?>checked="checked"<?php } ?> name="lf_private" id="lf_private"/>
                        <label for="lf_private"><?php echo t( 'Private' );?></label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="save_edit" class="button-raised button-primary pull-right"><?php echo t( 'Save' );?></button>
                    <button type="submit" name="cancel_edit" class="button pull-right ripple-primary">Cancel</button>
                    <?php if( !$link_is_new ){ ?>
                        <a href="?delete_link&amp;lf_linkdate=<?php echo $link["id"];?>&amp;token=<?php echo $token;?>" 
                            name="delete_link" class="button-raised button-alert"><?php echo t( 'Delete' );?></a>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if( $source !== 'firefoxsocialapi' ){ ?>
    <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>
<?php } ?>
</body>
</html>
