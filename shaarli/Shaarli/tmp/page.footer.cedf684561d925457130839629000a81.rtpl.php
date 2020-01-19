<?php if(!class_exists('raintpl')){exit;}?></div>

<div class="pure-g">
  <div class="pure-u-2-24"></div>
  <div id="footer" class="pure-u-20-24 footer-container">
    <strong><a href="https://github.com/shaarli/Shaarli">Shaarli</a></strong>
    <?php if( $is_logged_in===true ){ ?>

      <?php echo $version;?>

    <?php } ?>

    &middot;
    <?php echo t( 'The personal, minimalist, super-fast, database free, bookmarking service' );?> <?php echo t( 'by the Shaarli community' );?> &middot;
    <a href="doc/html/index.html" rel="nofollow"><?php echo t( 'Documentation' );?></a>
      <?php $counter1=-1; if( isset($plugins_footer["text"]) && is_array($plugins_footer["text"]) && sizeof($plugins_footer["text"]) ) foreach( $plugins_footer["text"] as $key1 => $value1 ){ $counter1++; ?>

          <?php echo $value1;?>

      <?php } ?>

  </div>
  <div class="pure-u-2-24"></div>
</div>

<input type="hidden" name="token" value="<?php echo $token;?>" id="token" />

<?php $counter1=-1; if( isset($plugins_footer["endofpage"]) && is_array($plugins_footer["endofpage"]) && sizeof($plugins_footer["endofpage"]) ) foreach( $plugins_footer["endofpage"] as $key1 => $value1 ){ $counter1++; ?>

    <?php echo $value1;?>

<?php } ?>


<?php $counter1=-1; if( isset($plugins_footer["js_files"]) && is_array($plugins_footer["js_files"]) && sizeof($plugins_footer["js_files"]) ) foreach( $plugins_footer["js_files"] as $key1 => $value1 ){ $counter1++; ?>

	<script src="<?php echo $value1;?>"></script>
<?php } ?>


<div id="js-translations" class="hidden">
  <span id="translation-fold"><?php echo t( 'Fold' );?></span>
  <span id="translation-fold-all"><?php echo t( 'Fold all' );?></span>
  <span id="translation-expand"><?php echo t( 'Expand' );?></span>
  <span id="translation-expand-all"><?php echo t( 'Expand all' );?></span>
  <span id="translation-delete-link"><?php echo t( 'Are you sure you want to delete this link?' );?></span>
  <span id="translation-shaarli-desc">
    <?php echo t( 'The personal, minimalist, super-fast, database free, bookmarking service' );?> <?php echo t( 'by the Shaarli community' );?>

  </span>
</div>

<script src="tpl/default/./js/shaarli.min.js?v=<?php echo $version_hash;?>"></script>
