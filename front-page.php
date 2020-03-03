<?php get_header('2');
/*
Template Name: トップページ
*/
?>
<div id="content">
<div id="main_posts">
<?php the_post_thumbnail('large'); ?>
</div>
<div id="wrapper" class="wrap pa30">
<div id="main">
<div class="main-inner">
<section id="top-cap">
<div class="about">
<h2 class="top-ttl2"><?php echo get_field('ttl');?></h2>
<p><?php echo get_field('txt');?></p>
</div>
<div class="top-ttl-wrap">
  <h3 class="top-ttl3">Eevaluation</h3>
  <p class="top-ttl3-sub">評価基準</p>
</div>

<div class="hyouka">
<ol>
    <li><?php echo get_field('evaluation_01',120);?></li>
    <li><?php echo get_field('evaluation_02',120);?></li>
    <li><?php echo get_field('evaluation_03',120);?></li>
    <li><?php echo get_field('evaluation_04',120);?></li>
    <li><?php echo get_field('evaluation_05',120);?></li>
</ol>
<p><?php echo get_field('eva_txt');?></p>
</div>
<div class="btn-arare">
<a href="<?php echo esc_url(home_url()); ?>/point/"><?php echo get_field('btn');?></a>
</div>
</section>
<div class="top-ttl-wrap">
<h3 class="top-ttl3">RANKING</h3>
<p class="top-ttl3-sub">チャットレディ求人ランキング</p>
</div>

<div class="lp-list">
<?php include_once __DIR__.'/lp-list.php';
if (function_exists('pagination')) {
// pagination($wp_query->max_num_pages);
} ?>
</div>
<section class="post-content" id="top-content">
<h3><?php echo get_field('seo_01_ttl');?></h3>
<p><?php echo get_field('seo_01_txt');?></p>
<h3><?php echo get_field('seo_02_ttl');?></h3>
<p><?php echo get_field('seo_02_txt');?></p>
<h3><?php echo get_field('seo_03_ttl');?></h3>
<p><?php echo get_field('seo_03_txt');?></p>
<h3><?php echo get_field('seo_04_ttl');?></h3>
<p><?php echo get_field('seo_04_txt');?></p>
<h3><?php echo get_field('seo_05_ttl');?></h3>
<p><?php echo get_field('seo_05_txt');?></p>
<h3><?php echo get_field('seo_06_ttl');?></h3>
<p><?php echo get_field('seo_06_txt');?></p>
<h3><?php echo get_field('seo_07_ttl');?></h3>
<p><?php echo get_field('seo_07_txt');?></p>
<h3><?php echo get_field('seo_08_ttl');?></h3>
<p><?php echo get_field('seo_08_txt');?></p>
<h3><?php echo get_field('seo_09_ttl');?></h3>
<p><?php echo get_field('seo_09_txt');?></p>
<h3><?php echo get_field('seo_10_ttl');?></h3>
<p><?php echo get_field('seo_10_txt');?></p>
</section>
</div>
</div>
<?php get_sidebar(); ?>
</div>

</div>
<?php get_footer();
