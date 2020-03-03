<?php
$paged = get_query_var('paged') ? get_query_var('paged'): 1;
$args = array('post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged);
query_posts($args);
if (have_posts()):
while (have_posts()):
the_post();
$cat_name = get_the_category()[0]->name;
if ($cat_name == 'ピックアップ') {
  $cat_name = get_the_category()[1]->name;
}
?>
<article>
<a href="<?php the_permalink(); ?>">
<div class="post-thumbnail">
<div class="img-inner">
<?php the_post_thumbnail('small_thumbnail', array('alt' => get_the_title(), 'class' => 'img-fit-cover')); ?>
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
<?php endwhile; endif;