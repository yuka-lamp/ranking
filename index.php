<?php get_header('2'); ?>
<div id="content">
<div id="wrapper" class="wrap pa30">
<div id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="main-inner">
<?php if (!is_front_page()) { ?>
<h1 class="ttl-02"><?php lamp_title(); ?></h1>
<?php } ?>
<div class="posts-list">
<?php
if (have_posts()):
while (have_posts()): the_post(); ?>
<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<a href="<?php the_permalink(); ?>" rel="nofollow">
<div class="post-thumbnail">
<div class="img-inner">
<?php the_post_thumbnail('small_thumbnail', array('alt' => get_the_title(), 'class' => 'img-fit-cover')); ?>
</div>
</div>
<div class="bx-caption">
<time class="date-main" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></time>
<h2 class="ttl-main" itemprop="headline"><?php the_title(); ?></h2>
<p itemprop="text"><?php echo mb_substr(strip_tags($post->post_content),0,90).'...'; ?></p>
</div>
</a>
</article>
<?php
endwhile; else:
echo get_template_part('content', 'none');
endif;
if (function_exists("pagination")) {
    pagination($wp_query->max_num_pages);
}
?>
</div>
</div><!-- /main-inner -->
</div><!-- /main -->
<?php get_sidebar(); ?>
</div><!-- /wrap -->
</div><!-- /content -->
<?php get_footer();