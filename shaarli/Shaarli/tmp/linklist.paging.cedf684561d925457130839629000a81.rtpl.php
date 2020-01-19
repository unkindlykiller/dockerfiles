<?php if(!class_exists('raintpl')){exit;}?><div class="linklist-paging">
  <div class="paging pure-g">
    <div class="linklist-filters pure-u-1-3">
      <?php if( $is_logged_in or !empty($action_plugin) ){ ?>

        <span class="linklist-filters-text pure-u-0 pure-u-lg-visible">
          <?php echo t( 'Filters' );?>

        </span>
        <?php if( $is_logged_in ){ ?>

        <a href="?visibility=private" title="<?php echo t( 'Only display private links' );?>"
           class="<?php if( $visibility==='private' ){ ?>filter-on<?php }else{ ?>filter-off<?php } ?>"
        ><i class="fa fa-user-secret"></i></a>
        <a href="?visibility=public" title="<?php echo t( 'Only display public links' );?>"
           class="<?php if( $visibility==='public' ){ ?>filter-on<?php }else{ ?>filter-off<?php } ?>"
        ><i class="fa fa-globe"></i></a>
        <?php } ?>

        <a href="?untaggedonly" title="<?php echo t( 'Filter untagged links' );?>"
           class=<?php if( $untaggedonly ){ ?>"filter-on"<?php }else{ ?>"filter-off"<?php } ?>

        ><i class="fa fa-tag"></i></a>
        <a href="#" title="<?php echo t( 'Select all' );?>"
           class="filter-off select-all-button"
        ><i class="fa fa-check-square-o"></i></a>
        <a href="#" class="filter-off fold-all pure-u-lg-0" title="<?php echo t( 'Fold all' );?>">
          <i class="fa fa-chevron-up"></i>
        </a>
        <?php $counter1=-1; if( isset($action_plugin) && is_array($action_plugin) && sizeof($action_plugin) ) foreach( $action_plugin as $key1 => $value1 ){ $counter1++; ?>

          <?php $value1["attr"]["class"]=$this->var['value']["attr"]["class"]=isset($value1["attr"]["class"]) ? $value1["attr"]["class"] : '';?>

          <?php $value1["attr"]["class"]=$this->var['value']["attr"]["class"]=!empty($value1["on"]) ? $value1["attr"]["class"] .' filter-on' : $value1["attr"]["class"] .' filter-off';?>

          <a
            <?php $counter2=-1; if( isset($value1["attr"]) && is_array($value1["attr"]) && sizeof($value1["attr"]) ) foreach( $value1["attr"] as $key2 => $value2 ){ $counter2++; ?>

              <?php echo $key2;?>="<?php echo $value2;?>"
            <?php } ?>>
            <?php echo $value1["html"];?>

          </a>
        <?php } ?>

      <?php } ?>

    </div>


    <div class="linklist-pages pure-u-1-3">
      <?php if( $next_page_url ){ ?>

        <a href="<?php echo $next_page_url;?>" class="paging_newer">
          <i class="fa fa-arrow-circle-left"></i>
        </a>
      <?php } ?>

      <?php if( $page_max>1 ){ ?><span class="strong"><?php echo $page_current;?> / <?php echo $page_max;?></span><?php } ?>

      <?php if( $previous_page_url ){ ?>

        <a href="<?php echo $previous_page_url;?>" class="paging_older">
          <i class="fa fa-arrow-circle-right"></i>
        </a>
      <?php } ?>


    </div>

    <div class="linksperpage pure-u-1-3">
      <div class="pure-u-0 pure-u-lg-visible"><?php echo t( 'Links per page' );?></div>
      <a href="?linksperpage=20">20</a>
      <a href="?linksperpage=50">50</a>
      <a href="?linksperpage=100">100</a>
      <form method="GET" class="pure-u-0 pure-u-lg-visible">
        <input type="text" name="linksperpage" placeholder="133">
      </form>
      <a href="#" class="filter-off fold-all pure-u-0 pure-u-lg-visible" title="<?php echo t( 'Fold all' );?>">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>
  </div>
</div>
