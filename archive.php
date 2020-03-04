<?php get_header('2');
if (is_category()) {
    $t_id = get_category(intval(get_query_var('cat')))->term_id;
    $cat_option = get_option('cat_'.$t_id);
    $children = "";
    if (isset($cat_option['lamp_category_image']) && $cat_option['lamp_category_image'] !== '') {
        $cat_image = $cat_option['lamp_category_image'];
    } else {
        $cat_image = get_option('def_image');
    }
    $args = array(
    'type'        => 'post',
    'child_of'    => $t_id,
    'orderby'     => 'id',
    'order'       => 'desc',
    'hide_empty'  => 0,
    'hierarchical'=> 1
    );
    $children = get_categories($args);
} ?>
<div id="content" class="pa30">
<div id="wrapper" class="wrap">
<div id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="main-inner">
<div class="category-list-txt">
<h2 class="ttl-single-cat"><?php single_cat_title(); ?></h2>
<?php if (is_category()) {
    lamp_category_description();
} ?>
</div>
<?php if (is_category() && $children): ?>
<h2 class="ttl-02">サブカテゴリーはこちら</h2>
<ul class="category-list-child">
<?php foreach($children as $category){
   echo '<li><a href="'.get_category_link($category->term_id).'" title="'.$category->name.'"'.'>'.$category->name.'</a></li>';
} ?>
</ul>
<?php endif; ?>
<h2 class="ttl-02"><?php single_cat_title(); ?>の記事一覧</h2>
<div class="posts-list">
<?php
if (have_posts()):
    while (have_posts()): the_post();
$cf = get_post_meta($post->ID);
$cat_name = get_the_category()[0]->name;
if ($cat_name == 'ピックアップ') {
  $cat_name = get_the_category()[1]->name;
}
?>
<article>
<a href="<?php the_permalink(); ?>">
<div class="post-thumbnail">
<div class="img-inner">
<?php the_post_thumbnail('loop_thumbnail', array('alt' => get_the_title(), 'class' => 'img-fit-cover')); ?>
</div>
</div>
<div class="bx-caption">
<h2 class="ttl-main"><?php the_title(); ?></h2>
<p><?php echo mb_substr(strip_tags($post->post_content), 0, 40).'...'; ?></p>
<div class="ttl-post-category"><i class="fa fa-folder"></i> <?php echo $cat_name; ?></div>
<time class="date-main"><?php the_time('Y-m-d'); ?></time>
</div>
</a>
</article>
<?php
endwhile;
else: ?>
<article id="post-404"class="cotent-none post" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<section itemprop="text">
<?php echo get_template_part('content', 'none'); ?>
</section>
</article>
<?php
endif; ?>
<?php if(is_mobile()): ?>
<div class="breadcrumb-area">
<div class="wrap">
<?php lamp_breadcrumb(); ?>
</div>
</div>
<?php endif; ?>
<?php if (function_exists("pagination")) {
    pagination($wp_query->max_num_pages);
} ?>
</div>
</div><!-- /main-inner -->
</div><!-- /main -->
<?php get_sidebar(); ?>
</div><!-- /wrap -->
</div><!-- /content -->
<?php get_footer();
