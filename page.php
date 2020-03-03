<?php get_header('2'); ?>
<div id="content">
<div id="wrapper" class="wrap pa30">
<div id="main" role="main" itemprop="mainContentOfPage">
<div class="main-inner">
<?php
if (have_posts()):
while (have_posts()): the_post(); ?>
<?php $cf = get_post_meta($post->ID); ?>
<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
<header class="post-header">
<h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
</header>
<?php if (get_the_post_thumbnail()) : ?>
<div class="post-thumbnail">
<?php the_post_thumbnail(array(1200,630), true); ?>
</div>
<?php endif; ?>
<?php if (is_page('point')): ?>
<section id="point" itemprop="text">
<?php the_content(); ?>
</section>
<?php else: ?>
<section itemprop="text">
<?php the_content(); ?>
</section>
<?php endif; ?>
<?php lamp_get_cta($post->ID); ?>
</article>
<?php
endwhile;
else :
?>
<p>投稿が見つかりません。</p>
<?php endif; ?>
</div><!-- /main-inner -->
</div><!-- /main -->
<?php get_sidebar(); ?>
</div><!-- /wrap -->
</div><!-- /content -->
<?php get_footer();