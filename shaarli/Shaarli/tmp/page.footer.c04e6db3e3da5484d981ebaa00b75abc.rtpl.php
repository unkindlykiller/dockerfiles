<?php if(!class_exists('raintpl')){exit;}?><div id="footer" class="container">
    <div>
        <b><a href="https://github.com/shaarli/Shaarli">Shaarli</a></b>
        <?php if( isLoggedIn() ){ ?> v<?php echo $version;?><?php } ?>
         - <?php echo t( 'The personal, minimalist, super-fast, database free, bookmarking service' );?> <?php echo t( 'by the Shaarli community' );?>
        <?php if( isLoggedIn() ){ ?> - <a href="doc/html/index.html">Help</a><?php } ?>
         - Theme by <a href="https://github.com/kalvn">kalvn</a>
    </div>
    <div>
        <?php $counter1=-1; if( isset($plugins_footer["text"]) && is_array($plugins_footer["text"]) && sizeof($plugins_footer["text"]) ) foreach( $plugins_footer["text"] as $key1 => $value1 ){ $counter1++; ?>
            <?php echo $value1;?>
        <?php } ?>
    </div>
    <?php $counter1=-1; if( isset($plugins_footer["endofpage"]) && is_array($plugins_footer["endofpage"]) && sizeof($plugins_footer["endofpage"]) ) foreach( $plugins_footer["endofpage"] as $key1 => $value1 ){ $counter1++; ?>
        <?php echo $value1;?>
    <?php } ?>
    <?php if( $newVersion ){ ?>
        <div id="newversion"><span id="version_id">&#x25CF;</span> Shaarli <?php echo $newVersion;?> <a href="https://github.com/shaarli/Shaarli/releases"><?php echo t( 'is available' );?></a>.</div>
    <?php } ?>
    <?php if( isset($versionError) && $versionError ){ ?>
    <div id="newversion">
        Error: <?php echo $versionError;?>
    </div>
    <?php } ?>

    <input type="hidden" name="token" value="<?php echo $token;?>" id="token" />
</div>
<script src="tpl/material/./dist/scripts.min.js?v=<?php echo $version_hash;?>"></script>
<?php $counter1=-1; if( isset($plugins_footer["js_files"]) && is_array($plugins_footer["js_files"]) && sizeof($plugins_footer["js_files"]) ) foreach( $plugins_footer["js_files"] as $key1 => $value1 ){ $counter1++; ?>
     <script src="<?php echo $value1;?>?v=<?php echo $version_hash;?>"></script>
<?php } ?>
