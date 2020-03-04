<!DOCTYPE HTML>
<html lang="ja" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8">
<title<?php bloginfo( 'name' ); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Kosugi+Maru|M+PLUS+Rounded+1c:400,700&display=swap" rel="stylesheet">
<?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KX784DS');</script>
<!-- End Google Tag Manager -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lib/css/jquery.fit-sidebar.css">
<style media="screen">body{}.link-btn,.post-cta .post-cta-btn a,#header-gnav-area-2{background-color:<?php echo get_option('main_color'); ?>}.breadcrumb li i,.ttl-post-category i,.cat-name span i,.post-footer-list i,.post-meta .fa-folder{color:<?php echo get_option('main_color'); ?>}</style>
<?php if(is_single() && is_mobile()): ?>
<style media="screen">#footer{margin-bottom:40px}</style>
<?php endif; ?>
<?php if(is_singular('lp')): ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lp.css">
<?php endif; ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131209403-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131209403-2');
</script>
<style>
  .top-ttl-wrap, .footer-01 {background: <?php echo get_theme_mod( 'color_bg', '#000'); ?>;}
  .side-widget .side-title, .top-ttl2 span, .post-content h2, .btn-arare a, #gnav-ul {background: <?php echo get_theme_mod( 'color_main', '#000'); ?>;}
  #header {border-top: solid 3px <?php echo get_theme_mod( 'color_main', '#000'); ?>;}
  #header #logo h1 span  {color: <?php echo get_theme_mod( 'color_main', '#000'); ?>;}
  .post-content h4 {border-left: 2px solid <?php echo get_theme_mod( 'color_main', '#000'); ?>;}
  .post-content h3 {border-bottom: dotted 2px <?php echo get_theme_mod( 'color_main', '#000'); ?>;}
</style>

</head>
<body <?php body_class();?> itemschope="itemscope" itemtype="http://schema.org/WebPage">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KX784DS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php echo get_option('analytics_tracking_code');
lamp_show_facebook_block(); ?>
<header id="header" class="header-2" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
<div class="wrap clearfix">
<!-- ヘッダーフォームエリア -->
<div id="search-nav-btn">
<a><i class="fa fa-search" aria-hidden="true"></i></a>
</div>
<div id="head-form">
<div class="head-form-wrap">
<div class="tagcloud">
<p class="head-form-ttl">おすすめタグ</p>
<?php wp_tag_cloud('number=10&orderby=count'); ?>
</div>
</div>
</div>
<?php
$logo_image = get_option('logo_image');
$logo_inner = '<img src="'. get_option('logo_image') .'" alt="チャットレディ求人ランキング">'; ?>
<div id="logo" itemprop="headline">
<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
</div>
<div id="header-right" class="clearfix">
<?php if (has_nav_menu('footer_nav')) { ?>
<div id="header-fnav-area">
<p id="header-fnav-btn"><a href="#"><?php echo get_option('footer_menu_title'); ?><br><i class="fa fa-angle-down"></i></a></p>
<nav id="header-fnav" role="navigation" itemscope="itemscope" itemtype="http://scheme.org/SiteNavigationElement">
<?php
wp_nav_menu(
array(
'theme_location'  => 'footer_nav',
'menu_class'      => 'clearfix',
'menu_id'         => 'fnav-h-ul',
'container'       => 'div',
'container_id'    => 'fnav-h-container',
'container_class' => 'fnav-h-container'
)
); ?>
</nav>
</div>
<?php } ?>
</div>
<?php if (has_nav_menu('global_nav') || has_nav_menu('footer_nav')) { ?>
<div id="header-nav-btn">
<a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
</div>
<?php } ?>
<!-- ヘッダーボタンエリア -->
<div id="head-button">
<ul>
<!-- <li><a href="#" target="_blank">ここにリンク</a></li> -->
</ul>
</div>
</div>
</header>

<?php if (has_nav_menu('global_nav')) { ?>
<div id="header-gnav-area-2">
<nav id="gnav" role="navigation" itemscope="itemscope" itemtype="http://scheme.org/SiteNavigationElement">
<?php
wp_nav_menu(
array(
'theme_location'  => 'global_nav',
'menu_class'      => 'clearfix',
'menu_id'         => 'gnav-ul',
'container'       => 'div',
'container_id'    => 'gnav-container',
'container_class' => 'gnav-container'
)
); ?>
</nav>
</div>
<?php } ?>
<nav id="gnav-sp">
<div class="about-logo">
<a class="nav-close"><i class="fa fa-times" aria-hidden="true"></i></a>
</div>
<div id="header-cont-content">
<h4>Menu</h4>
<?php
wp_nav_menu(
array(
'theme_location'  => 'global_nav',
'menu_class'      => 'clearfix',
'menu_id'         => 'gnav-ul-sp',
'container'       => 'div',
'container_id'    => 'gnav-container-sp',
'container_class' => 'gnav-container'
)
);
?>
</div>
<div id="header-cont-page">
<h4>当サイトについて</h4>
<?php if (has_nav_menu('footer_nav')) {
wp_nav_menu(
array(
'theme_location'  => 'footer_nav',
'menu_class'      => '',
'menu_id'         => 'fnav',
'container'       => 'nav',
'items_wrap'      => '<ul>%3$s</ul>'
)
);
}
?>
</div>
<!-- <div class="header-sns">
<?php footer_social_buttons(); ?>
</div> -->
<div class="head-close-box"><a class="nav-close">閉じる×</a></div>
</nav>
<?php if (!(is_home() || is_front_page())) { ?>
<div class="breadcrumb-area">
<div class="wrap">
<?php lamp_breadcrumb(); ?>
</div>
</div>
<?php }
