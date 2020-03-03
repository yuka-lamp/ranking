<!DOCTYPE HTML>
<html lang="ja" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8">
<title><?php lamp_title(); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KX784DS');</script>
<!-- End Google Tag Manager -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lib/css/jquery.fit-sidebar.css">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131209403-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131209403-2');
</script>
</head>
<body <?php body_class();?> itemschope="itemscope" itemtype="http://schema.org/WebPage">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KX784DS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php echo get_option('analytics_tracking_code');
lamp_show_facebook_block();
if (is_singular('lp')) { ?>
<div class="lp-wrap">
<header id="lp-header">
<h1 class="lp-title"><?php wp_title(''); ?></h1>
</header>
<?php } else { ?>
<header id="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
<div class="wrap clearfix">
<?php
$logo_image = get_option('logo_image');
$logo_text = get_option('logo_text');
if (!empty($logo_image) && get_option('toppage_logo_type') == 'logo_image') :
$logo_inner = '<img src="'. get_option('logo_image') .'" alt="'.get_bloginfo('name').'">'; else:
if (!empty($logo_text) && get_option('toppage_logo_type') == 'logo_text') :
$logo_inner = get_option('logo_text'); else:
$logo_inner = get_bloginfo('name');
endif;
$logo_inner_desc = '<p class="header-description">'.get_bloginfo('description').'</p>';
endif;
$logo_wrap = (is_front_page() || is_home()) ? 'h1' : 'p' ; ?>
<<?php echo $logo_wrap; ?> id="logo" itemprop="headline">
<a href="<?php echo home_url(); ?>"><?php echo $logo_inner; ?></a><br>
</<?php echo $logo_wrap; ?>>
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
<?php }
if (has_nav_menu('global_nav')) { ?>
<div id="header-gnav-area">
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
</div>
<?php if (has_nav_menu('global_nav') || has_nav_menu('footer_nav')) { ?>
<div id="header-nav-btn">
<a href="#"><i class="fa fa-align-justify"></i></a>
</div>
<?php
} ?>
</div>
</header>
<?php } ?>
<nav id="gnav-sp">
<div class="wrap">
<div class="grid-wrap">
<div id="header-cont-about" class="grid-3">
<?php if (has_nav_menu('footer_nav')) {
wp_nav_menu(
array(
'theme_location'  => 'footer_nav',
'menu_class'      => '',
'menu_id'         => 'fnav',
'container'       => 'nav',
'items_wrap'      => '<ul id="footer-nav" class="%2$s">%3$s</ul>'
)
);
}
?>
</div>
<div id="header-cont-content" class="grid-6">
<h4>メニュー</h4>
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
</div>
</div>
</nav>
<?php if (!(is_home() || is_front_page() || is_singular('lp'))) { ?>
<div class="breadcrumb-area"><div class="wrap"><?php lamp_breadcrumb(); ?></div></div>
<?php }
