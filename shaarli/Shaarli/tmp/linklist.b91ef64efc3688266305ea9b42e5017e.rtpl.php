<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?>

</head>
<body>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>


<div class="linkcount pure-u-0 pure-u-lg-visible">
  <?php if( !empty($linkcount) ){ ?>

  <span class="strong"><?php echo $linkcount;?></span> <?php echo t('shaare', 'shaares', $linkcount); ?>

  <?php if( $privateLinkcount>0 ){ ?>

  <br><span class="strong"><?php echo $privateLinkcount;?></span> <?php echo t('private link', 'private links', $privateLinkcount); ?>

  <?php } ?>

  <?php } ?>

</div>

<input type="hidden" name="token" value="<?php echo $token;?>">
<div id="search-linklist" class="searchform-block search-linklist">

  <form method="GET" class="pure-form searchform" name="searchform">
    <input type="text" tabindex="1" name="searchterm" class="searchterm" placeholder="<?php echo t( 'Search text' );?>"
           <?php if( !empty($search_term) ){ ?>

           value="<?php echo $search_term;?>"
           <?php } ?>

    >
    <input type="text" tabindex="2" name="searchtags" class="searchtags" placeholder="<?php echo t( 'Filter by tag' );?>"
           <?php if( !empty($search_tags) ){ ?>

           value="<?php echo $search_tags;?>"
           <?php } ?>

    autocomplete="off" data-multiple data-autofirst data-minChars="1"
    data-list="<?php $counter1=-1; if( isset($tags) && is_array($tags) && sizeof($tags) ) foreach( $tags as $key1 => $value1 ){ $counter1++; ?><?php echo $key1;?>, <?php } ?>"
    >
    <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
  </form>
</div>

<?php $counter1=-1; if( isset($plugins_header["fields_toolbar"]) && is_array($plugins_header["fields_toolbar"]) && sizeof($plugins_header["fields_toolbar"]) ) foreach( $plugins_header["fields_toolbar"] as $key1 => $value1 ){ $counter1++; ?>

  <form
    <?php $counter2=-1; if( isset($value1["attr"]) && is_array($value1["attr"]) && sizeof($value1["attr"]) ) foreach( $value1["attr"] as $key2 => $value2 ){ $counter2++; ?>

      <?php echo $key2;?>="<?php echo $value2;?>"
    <?php } ?>>
    <div class="toolbar-plugin pure-u-lg-1">
      <?php $counter2=-1; if( isset($value1["inputs"]) && is_array($value1["inputs"]) && sizeof($value1["inputs"]) ) foreach( $value1["inputs"] as $key2 => $value2 ){ $counter2++; ?>

        <input
          <?php $counter3=-1; if( isset($value2) && is_array($value2) && sizeof($value2) ) foreach( $value2 as $key3 => $value3 ){ $counter3++; ?>

          <?php echo $key3;?>="<?php echo $value3;?>"
          <?php } ?>>
      <?php } ?>

    </div>
  </form>
<?php } ?>


<div id="linklist">
  <div id="link-count-block" class="pure-g">
    <div class="pure-u-lg-2-24 pure-u-1-24"></div>
    <div id="link-count-content" class="pure-u-lg-20-24 pure-u-22-24">
      <div class="linkcount pure-u-lg-0 center">
        <?php if( !empty($linkcount) ){ ?>

        <span class="strong"><?php echo $linkcount;?></span> <?php echo t('shaare', 'shaares', $linkcount); ?>

        <?php if( $privateLinkcount>0 ){ ?>

        &middot; <span class="strong"><?php echo $privateLinkcount;?></span> <?php echo t('private link', 'private links', $privateLinkcount); ?>

        <?php } ?>

        <?php } ?>

      </div>

      <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("linklist.paging") . ( substr("linklist.paging",-1,1) != "/" ? "/" : "" ) . basename("linklist.paging") );?>


      <div id="plugin_zone_start_linklist" class="plugin_zone">
        <?php $counter1=-1; if( isset($plugin_start_zone) && is_array($plugin_start_zone) && sizeof($plugin_start_zone) ) foreach( $plugin_start_zone as $key1 => $value1 ){ $counter1++; ?>

          <?php echo $value1;?>

        <?php } ?>

      </div>
    </div>
  </div>

  <?php if( count($links)==0 ){ ?>

    <div id="search-result-block" class="pure-g pure-alert pure-alert-error search-result">
      <div class="pure-u-2-24"></div>
      <div id="search-result-content" class="pure-u-20-24">
        <div id="searchcriteria"><?php echo t( 'Nothing found.' );?></div>
      </div>
    </div>
  <?php }elseif( !empty($search_term) or $search_tags !== '' or !empty($visibility) or $untaggedonly ){ ?>

    <div id="search-result-block" class="pure-g pure-alert pure-alert-success search-result">
      <div class="pure-u-2-24"></div>
      <div id="search-result-content" class="pure-u-20-24 search-result-main">
        <?php echo sprintf(t('%s result', '%s results', $result_count), $result_count); ?>

        <?php if( !empty($search_term) ){ ?>

          <?php echo t( 'for' );?> <em><strong><?php echo $search_term;?></strong></em>
        <?php } ?>

        <?php if( !empty($search_tags) ){ ?>

          <?php $exploded_tags=$this->var['exploded_tags']=explode(' ', $search_tags);?>

          <?php echo t( 'tagged' );?>

          <?php $counter1=-1; if( isset($exploded_tags) && is_array($exploded_tags) && sizeof($exploded_tags) ) foreach( $exploded_tags as $key1 => $value1 ){ $counter1++; ?>

              <span class="label label-tag" title="<?php echo t( 'Remove tag' );?>">
                <a href="?removetag=<?php echo urlencode($value1); ?>"><?php echo $value1;?><span class="remove"><i class="fa fa-times"></i></span></a>
              </span>
          <?php } ?>

        <?php } ?>

        <?php if( !empty($visibility) ){ ?>

          <?php echo t( 'with status' );?>

          <span class="label label-private">
            <?php echo t( $visibility );?>

          </span>
        <?php } ?>

        <?php if( $untaggedonly ){ ?>

          <span class="label label-private">
            <?php echo t( 'without any tag' );?>

          </span>
        <?php } ?>

      </div>
    </div>
  <?php } ?>


  <div id="linklist-loop-block" class="pure-g">
    <div class="pure-u-lg-2-24 pure-u-1-24"></div>
    <div id="linklist-loop-content" class="pure-u-lg-20-24 pure-u-22-24">
      
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

        <div class="anchor" id="<?php echo $value1["shorturl"];?>"></div>

        <div class="linklist-item linklist-item<?php if( $value1["class"] ){ ?> <?php echo $value1["class"];?><?php } ?>" data-id="<?php echo $value1["id"];?>">
          <div class="linklist-item-title">
            <?php if( $thumbnails_enabled && !empty($value1["thumbnail"]) ){ ?>

              <div class="linklist-item-thumbnail" style="width:<?php echo $thumbnails_width;?>px;height:<?php echo $thumbnails_height;?>px;">
                <div class="thumbnail">
                  <a href="<?php echo $value1["real_url"];?>">
                  
                  <img data-src="<?php echo $value1["thumbnail"];?>" class="b-lazy"
                    src=""
                    alt="thumbnail" width="<?php echo $thumbnails_width;?>" height="<?php echo $thumbnails_height;?>" />
                  </a>
                </div>
              </div>
            <?php } ?>


            <?php if( $is_logged_in ){ ?>

              <div class="linklist-item-editbuttons">
                <?php if( $value1["private"] ){ ?>

                  <span class="label label-private"><?php echo $strPrivate;?></span>
                <?php } ?>

              </div>
            <?php } ?>


            <h2>
              <a href="<?php echo $value1["real_url"];?>">
                <?php if( strpos($value1["url"], $value1["shorturl"]) === false ){ ?>

                  <i class="fa fa-external-link"></i>
                <?php }else{ ?>

                  <i class="fa fa-sticky-note"></i>
                <?php } ?>


                <span class="linklist-link"><?php echo $value1["title"];?></span>
              </a>
            </h2>
          </div>

          <?php if( $value1["description"] ){ ?>

            <div class="linklist-item-description">
              <?php echo $value1["description"];?>

            </div>
          <?php } ?>


          <div class="linklist-item-infos clear">
            <?php if( $value1["tags"] ){ ?>

              <div class="linklist-item-tags">
                <i class="fa fa-tags"></i>
                <?php $tag_counter=$this->var['tag_counter']=count($value1["taglist"]);?>

                <?php $counter2=-1; if( isset($value1["taglist"]) && is_array($value1["taglist"]) && sizeof($value1["taglist"]) ) foreach( $value1["taglist"] as $key2 => $value2 ){ $counter2++; ?>

                  <span class="label label-tag" title="<?php echo $strAddTag;?>">
                    <a href="?addtag=<?php echo urlencode( $value2 );?>"><?php echo $value2;?></a>
                  </span>
                  <?php if( $tag_counter - 1 != $counter2 ){ ?>&middot;<?php } ?>

                <?php } ?>

              </div>
            <?php } ?>


            <div class="linklist-item-infos-date-url-block pure-g">
              <div class="linklist-item-infos-dateblock pure-u-lg-7-12 pure-u-1">
                <?php if( $is_logged_in ){ ?>

                  <div class="linklist-item-infos-controls-group pure-u-0 pure-u-lg-visible">
                    <span class="linklist-item-infos-controls-item ctrl-checkbox">
                      <input type="checkbox" class="link-checkbox" value="<?php echo $value1["id"];?>">
                    </span>
                    <span class="linklist-item-infos-controls-item ctrl-edit">
                      <a href="?edit_link=<?php echo $value1["id"];?>" title="<?php echo $strEdit;?>"><i class="fa fa-pencil-square-o edit-link"></i></a>
                    </span>
                    <span class="linklist-item-infos-controls-item ctrl-delete">
                      <a href="?delete_link&amp;lf_linkdate=<?php echo $value1["id"];?>&amp;token=<?php echo $token;?>"
                         title="<?php echo $strDelete;?>" class="delete-link pure-u-0 pure-u-lg-visible confirm-delete">
                        <i class="fa fa-trash"></i>
                      </a>
                    </span>
                    <span class="linklist-item-infos-controls-item ctrl-pin">
                      <a href="?do=pin&amp;id=<?php echo $value1["id"];?>&amp;token=<?php echo $token;?>"
                         title="<?php echo $strToggleSticky;?>" class="pin-link <?php if( $value1["sticky"] ){ ?>pinned-link<?php } ?> pure-u-0 pure-u-lg-visible">
                        <i class="fa fa-thumb-tack"></i>
                      </a>
                    </span>
                  </div>
                <?php }else{ ?>

                  <?php if( $value1["sticky"] ){ ?>

                    <div class="linklist-item-infos-controls-group pure-u-0 pure-u-lg-visible">
                      <span class="linklist-item-infos-controls-item ctrl-pin">
                        <span title="<?php echo $strSticky;?>" class="pin-link pinned-link pure-u-0 pure-u-lg-visible">
                          <i class="fa fa-thumb-tack"></i>
                        </span>
                      </span>
                    </div>
                  <?php } ?>

                <?php } ?>

                <a href="?<?php echo $value1["shorturl"];?>" title="<?php echo $strPermalink;?>">
                  <?php if( !$hide_timestamps || $is_logged_in ){ ?>

                    <?php $updated=$this->var['updated']=$value1["updated_timestamp"] ? $strEdited. format_date($value1["updated"]) : $strPermalink;?>

                    <span class="linkdate" title="<?php echo $updated;?>">
                      <i class="fa fa-clock-o"></i>
                      <?php echo format_date( $value1["created"] );?>

                      <?php if( $value1["updated_timestamp"] ){ ?>*<?php } ?>

                      &middot;
                    </span>
                  <?php } ?>

                  <?php echo $strPermalinkLc;?>

                </a>

                <div class="pure-u-0 pure-u-lg-visible">
                  <?php if( isset($value1["link_plugin"]) ){ ?>

                    &middot;
                    <?php $link_plugin_counter=$this->var['link_plugin_counter']=count($value1["link_plugin"]);?>

                    <?php $counter2=-1; if( isset($value1["link_plugin"]) && is_array($value1["link_plugin"]) && sizeof($value1["link_plugin"]) ) foreach( $value1["link_plugin"] as $key2 => $value2 ){ $counter2++; ?>

                      <?php echo $value2;?>

                      <?php if( $link_plugin_counter - 1 != $counter2 ){ ?>&middot;<?php } ?>

                    <?php } ?>

                  <?php } ?>

                </div>
              </div><div
                
                class="linklist-item-infos-url pure-u-lg-5-12 pure-u-1">
                <a href="<?php echo $value1["real_url"];?>" title="<?php echo $value1["title"];?>">
                  <i class="fa fa-link"></i> <?php echo $value1["url"];?>

                </a>
                <div class="linklist-item-buttons pure-u-0 pure-u-lg-visible">
                  <a href="#" title="<?php echo $strFold;?>" class="fold-button"><i class="fa fa-chevron-up"></i></a>
                </div>
              </div>
              <div class="mobile-buttons pure-u-1 pure-u-lg-0">
                <?php if( isset($value1["link_plugin"]) ){ ?>

                  <?php $link_plugin_counter=$this->var['link_plugin_counter']=count($value1["link_plugin"]);?>

                  <?php $counter2=-1; if( isset($value1["link_plugin"]) && is_array($value1["link_plugin"]) && sizeof($value1["link_plugin"]) ) foreach( $value1["link_plugin"] as $key2 => $value2 ){ $counter2++; ?>

                    <?php echo $value2;?>

                    <?php if( $link_plugin_counter - 1 != $counter2 ){ ?>&middot;<?php } ?>

                  <?php } ?>

                <?php } ?>

                <?php if( $is_logged_in ){ ?>

                  &middot;
                  <a href="?delete_link&amp;lf_linkdate=<?php echo $value1["id"];?>&amp;token=<?php echo $token;?>"
                     title="<?php echo $strDelete;?>" class="delete-link confirm-delete">
                    <i class="fa fa-trash"></i>
                  </a>
                  &middot;
                  <a href="?edit_link=<?php echo $value1["id"];?>" title="<?php echo $strEdit;?>"><i class="fa fa-pencil-square-o edit-link"></i></a>
                <?php } ?>

              </div>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</div>

  <div id="plugin_zone_end_linklist" class="plugin_zone">
    <?php $counter1=-1; if( isset($plugin_end_zone) && is_array($plugin_end_zone) && sizeof($plugin_end_zone) ) foreach( $plugin_end_zone as $key1 => $value1 ){ $counter1++; ?>

    <?php echo $value1;?>

    <?php } ?>

  </div>

<div id="linklist-paging-bottom-block" class="pure-g">
  <div class="pure-u-lg-2-24 pure-u-1-24"></div>
  <div id="linklist-paging-bottom-content" class="pure-u-lg-20-24 pure-u-22-24">
    <?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("linklist.paging") . ( substr("linklist.paging",-1,1) != "/" ? "/" : "" ) . basename("linklist.paging") );?>

  </div>
</div>

<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>

<script src="tpl/default/js/thumbnails.min.js?v=<?php echo $version_hash;?>"></script>
</body>
</html>
