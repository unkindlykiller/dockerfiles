<?php if(!class_exists('raintpl')){exit;}?><title><?php echo $pagetitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<meta name="referrer" content="same-origin">
<link rel="alternate" type="application/rss+xml" href="<?php echo $feedurl;?>?do=rss<?php echo $searchcrits;?>" title="RSS Feed" />
<link rel="alternate" type="application/atom+xml" href="<?php echo $feedurl;?>?do=atom<?php echo $searchcrits;?>" title="ATOM Feed" />
<link rel="apple-touch-icon" sizes="57x57" href="tpl/material/./dist/img/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="tpl/material/./dist/img/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="tpl/material/./dist/img/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="tpl/material/./dist/img/favicons/apple-touch-icon-76x76.png">
<link rel="icon" type="image/png" href="tpl/material/./dist/img/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="tpl/material/./dist/img/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="tpl/material/./dist/img/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="tpl/material/./dist/img/favicons/manifest.json">
<link rel="shortcut icon" href="tpl/material/./dist/img/favicons/favicon.ico">
<link rel="search" type="application/opensearchdescription+xml" href="?do=opensearch" title="Shaarli search - <?php echo $shaarlititle;?>"/> 
<meta name="msapplication-TileColor" content="#603cba">
<meta name="msapplication-config" content="dist/img/favicons/browserconfig.xml">
<?php if( ! empty($links) && count($links) === 1 ){ ?>
  <?php $link=$this->var['link']=reset($links);?>
  <meta property="og:title" content="<?php echo $link["title"];?>" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="<?php if( !empty($index_url) ){ ?><?php echo $index_url;?><?php } ?>?<?php echo $link["shorturl"];?>" />
  <?php $ogDescription=$this->var['ogDescription']=isset($link["description_src"]) ? $link["description_src"] : $link["description"];?>
  <meta property="og:description" content="<?php echo mb_substr(strip_tags($ogDescription), 0, 300); ?>" />
  <?php if( $link["thumbnail"] ){ ?>
    <meta property="og:image" content="<?php if( !empty($index_url) ){ ?><?php echo $index_url;?><?php } ?><?php echo $link["thumbnail"];?>" />
  <?php } ?>
  <?php if( !$hide_timestamps || $is_logged_in ){ ?>
    <meta property="article:published_time" content="<?php echo $link["created"]->format(DateTime::ATOM);?>" />
    <?php if( !empty($link["updated"]) ){ ?>
      <meta property="article:modified_time" content="<?php echo $link["updated"]->format(DateTime::ATOM);?>" />
    <?php } ?>
  <?php } ?>
  <?php $counter1=-1; if( isset($link["taglist"]) && is_array($link["taglist"]) && sizeof($link["taglist"]) ) foreach( $link["taglist"] as $key1 => $value1 ){ $counter1++; ?>
    <meta property="article:tag" content="<?php echo $value1;?>" />
  <?php } ?>
<?php } ?>
<link type="text/css" rel="stylesheet" href="tpl/material/./dist/styles.min.css?v=<?php echo $version_hash;?>" />
<?php if( $conf->get('config.MATERIAL_COLOR') ){ ?>
<?php $themeColor=$this->var['themeColor']=$conf->get('config.MATERIAL_COLOR');?>
<meta name="theme-color" content="<?php echo $themeColor;?>">
<?php }else{ ?>
<meta name="theme-color" content="#2196f3">
<?php } ?>
<?php if( is_file('data/user.css') ){ ?><link type="text/css" rel="stylesheet" href="data/user.css" /><?php } ?>
<?php $counter1=-1; if( isset($plugins_includes["css_files"]) && is_array($plugins_includes["css_files"]) && sizeof($plugins_includes["css_files"]) ) foreach( $plugins_includes["css_files"] as $key1 => $value1 ){ $counter1++; ?>
<link type="text/css" rel="stylesheet" href="<?php echo $value1;?>?v=<?php echo $version_hash;?>"/>
<?php } ?>
<script>
var shaarli = {
    source: '<?php echo $source;?>',
    fromNow: <?php if( $conf->get('config.MATERIAL_DATE_FROMNOW') ){ ?>
        <?php echo $conf->get('config.MATERIAL_DATE_FROMNOW');?>
    <?php }else{ ?>
        0
    <?php } ?>,
    datePattern: '<?php echo $conf->get('config.MATERIAL_DATE_PATTERN');?>',
    isAuth: <?php if( isLoggedIn() ){ ?>true<?php }else{ ?>false<?php } ?>
};
</script>
<?php if( file_exists('tpl/material/extra.html') ){ ?>
<?php $tpl = new RainTpl;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("extra") . ( substr("extra",-1,1) != "/" ? "/" : "" ) . basename("extra") );?>
<?php } ?>
