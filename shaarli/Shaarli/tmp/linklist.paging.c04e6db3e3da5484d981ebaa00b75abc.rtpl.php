<?php if(!class_exists('raintpl')){exit;}?><?php if( $page_max > 1 ){ ?>
<div class="paging clearfix">
    <div class="row">
        <div class="col-xs-3 col-sm-2 text-left"><?php if( $previous_page_url ){ ?><a href="<?php echo $previous_page_url;?>" class="paging-older" title="Older"><i class="mdi mdi-arrow-left"></i></a><?php } ?></div>
        <div class="paging-current col-xs-6 col-sm-8 text-center">p<span class="hidden-xs">age</span> <?php echo $page_current;?> / <?php echo $page_max;?></div>
        <div class="col-xs-3 col-sm-2 text-right"><?php if( $next_page_url ){ ?><a href="<?php echo $next_page_url;?>" class="paging-newer" title="Newer"><i class="mdi mdi-arrow-right"></i></a><?php } ?></div>
    </div>
    <div>
        <?php $counter1=-1; if( isset($action_plugin) && is_array($action_plugin) && sizeof($action_plugin) ) foreach( $action_plugin as $key1 => $value1 ){ $counter1++; ?>
            <div class="paging_privatelinks">
                <a
                    <?php $counter2=-1; if( isset($value1["attr"]) && is_array($value1["attr"]) && sizeof($value1["attr"]) ) foreach( $value1["attr"] as $key2 => $value2 ){ $counter2++; ?>
                        <?php echo $key2;?>="<?php echo $value2;?>"
                    <?php } ?>>
                    <?php echo $value1["html"];?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<?php } ?>