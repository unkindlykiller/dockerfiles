<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<head><?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes") . ( substr("includes",-1,1) != "/" ? "/" : "" ) . basename("includes") );?></head>
<body>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.header") . ( substr("page.header",-1,1) != "/" ? "/" : "" ) . basename("page.header") );?>
<div id="pluginadmindiv" class="page-pluginadmin container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <noscript>
                <p>You need to enable Javascript to change plugin loading order.</p>
            </noscript>

            <h1>Plugin administration</h1>
            <p>Drag and drop your plugin to change the order in which they'll be called. Uncheck enabled plugin to disable them and vice-versa.</p>

            <form action="?do=save_pluginadmin" method="POST">
                <section class="card">
                    <div class="card-title">Enabled plugins</div>
                    <?php if( count($enabledPlugins)==0 ){ ?>
                    <div class="card-body">
                        <p>No plugin enabled.</p>
                    </div>
                    <?php }else{ ?>
                    <ul id="list-plugin-enabled" class="list-sortable list-checkable">
                        <?php $counter1=-1; if( isset($enabledPlugins) && is_array($enabledPlugins) && sizeof($enabledPlugins) ) foreach( $enabledPlugins as $key1 => $value1 ){ $counter1++; ?>
                        <li class="list-item list-item-sortable" data-line="<?php echo $key1;?>" data-order="<?php echo $counter1;?>">
                            <input type="checkbox" class="filled-in" name="<?php echo $key1;?>" id="checkbox-<?php echo $key1;?>" checked>
                            <label for="checkbox-<?php echo $key1;?>"></label>
                            <input type="hidden" name="order_<?php echo $key1;?>" value="<?php echo $counter1;?>">
                            <div class="list-item-content">
                                <h3 class="list-item-label"><?php echo str_replace('_', ' ', $key1); ?></h3>
                                <div class="list-item-sublabel"><?php echo $value1["description"];?></div>
                            </div>
                            <div class="list-sortable-handle mdi mdi-menu"></div>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </section>

                <section class="card">
                    <div class="card-title">Disabled plugins</div>
                    <?php if( count($disabledPlugins)==0 ){ ?>
                    <div class="card-body">
                        <p>No plugin disabled.</p>
                    </div>
                    <?php }else{ ?>
                    <ul class="list-sortable list-checkable">
                        <?php $counter1=-1; if( isset($disabledPlugins) && is_array($disabledPlugins) && sizeof($disabledPlugins) ) foreach( $disabledPlugins as $key1 => $value1 ){ $counter1++; ?>
                        <li class="list-item list-item-sortable" data-line="<?php echo $key1;?>" data-order="<?php echo $counter1;?>">
                            <input type="checkbox" class="filled-in" id="checkbox-<?php echo $key1;?>" name="<?php echo $key1;?>">
                            <label for="checkbox-<?php echo $key1;?>"></label>
                            <div class="list-item-content">
                                <h3 class="list-item-label"><?php echo str_replace('_', ' ', $key1); ?></h3>
                                <div class="list-item-sublabel"><?php echo $value1["description"];?></div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </section>

                <div class="clearfix">
                    <button type="submit" class="button-raised button-primary pull-right">Save plugins</button>
                </div>
            </form>
            <hr class="darker">
            <form action="?do=save_pluginadmin" method="POST">
                <section class="card">
                    <div class="card-title">Plugin parameters</div>
                    <div class="card-body">
                    <?php if( count($enabledPlugins)==0 ){ ?>
                        <p>No plugin enabled.</p>
                    <?php }else{ ?>
                        <?php $count=$this->var['count']=0;?>
                        <?php $counter1=-1; if( isset($enabledPlugins) && is_array($enabledPlugins) && sizeof($enabledPlugins) ) foreach( $enabledPlugins as $key1 => $value1 ){ $counter1++; ?>
                            <?php if( count($value1["parameters"]) > 0 ){ ?>
                                <?php if( $count>0 ){ ?>
                                <hr>
                                <?php } ?>
                                <?php $count=$this->var['count']=$count+1;?>
                                <h2><?php echo str_replace('_', ' ', $key1); ?></h2>
                                <?php $counter2=-1; if( isset($value1["parameters"]) && is_array($value1["parameters"]) && sizeof($value1["parameters"]) ) foreach( $value1["parameters"] as $key2 => $value2 ){ $counter2++; ?>
                                <div class="row plugin-param">
                                    <div class="col-sm-4 plugin-param-key">
                                        <label for="<?php echo $key2;?>" <?php if( isset($value2["desc"]) ){ ?>title="<?php echo $value2["desc"];?>"<?php } ?>><?php echo str_replace('_', ' ', $key2); ?></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name="<?php echo $key2;?>" value="<?php echo $value2["value"];?>" id="<?php echo $key2;?>" <?php if( isset($value2["desc"]) ){ ?>placeholder="<?php echo $value2["desc"];?>"<?php } ?>>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <?php if( $count==0 ){ ?>
                        <p>No parameters found for enabled plugins.</p>
                        <?php } ?>
                    <?php } ?>
                    </div>
                    <div class="card-footer clearfix">
                        <button type="submit" name="parameters_form" class="button-raised button-primary pull-right">Save plugin parameters</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("page.footer") . ( substr("page.footer",-1,1) != "/" ? "/" : "" ) . basename("page.footer") );?>
</body>
</html>
