<?php
require_once('lib/admin/init.php');
require_once('lib/admin/manual.php');
require_once('lib/functions/asset.php');
require_once('lib/functions/head.php');
require_once('lib/functions/custom-post.php');
require_once('lib/functions/lamp-functions.php');
require_once('lib/functions/setting.php');
require_once('lib/functions/custom-fields.php');
require_once('lib/functions/category-custom-fields.php');
require_once('lib/functions/widget.php');
require_once('lib/functions/postviews.php');
require_once('lib/functions/shortcodes.php');
require_once('lib/functions/social_btn.php');
require_once('lib/functions/show_avatar.php');
require_once('lib/functions/rss.php');


//管理画面のカスタマイズにテーマカラーの設定セクションを追加
function theme_customizer_extension($wp_customize) {
  $wp_customize->add_setting( 'color_main', array(
 'default' => 'red',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_main', array(
 'label' => 'メインカラー',
 'section' => 'colors',
 'settings' => 'color_main',
 'priority' => 20,
  )));
  $wp_customize->add_setting( 'color_sub', array(
 'default' => 'red',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_sub', array(
 'label' => 'サブカラー',
 'section' => 'colors',
 'settings' => 'color_sub',
 'priority' => 20,
  )));
  $wp_customize->add_setting( 'color_bg', array(
 'default' => 'red',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_bg', array(
 'label' => '背景色',
 'section' => 'colors',
 'settings' => 'color_bg',
 'priority' => 20,
  )));
}
add_action('customize_register', 'theme_customizer_extension');
?>

<style>
  .top-ttl-wrap, .footer-01 {
    background: <?php echo get_theme_mod( 'color_bg', '#000'); ?>;
  }
  .side-widget .side-title, .top-ttl2 span, .post-content h2, .btn-arare a, #gnav-ul {
    background: <?php echo get_theme_mod( 'color_main', '#000'); ?>;
  }
  #header {
    border-top: solid 3px <?php echo get_theme_mod( 'color_main', '#000'); ?>;
  }
  #header #logo h1 span  {
    color: <?php echo get_theme_mod( 'color_main', '#000'); ?>;
  }
  .post-content h4 {
    border-left: 2px solid <?php echo get_theme_mod( 'color_main', '#000'); ?>;
  }
  .post-content h3 {
    border-bottom: dotted 2px <?php echo get_theme_mod( 'color_sub', '#000'); ?>;
  }
</style>
