<?php
$args = array('post_type' => 'lp','orderby' => 'date', 'order' => 'ASC');
$query = new WP_Query($args);
if($query->have_posts()):
$no = 1;
while ($query->have_posts()):
$query->the_post();
$name = get_field('name');
$intro = get_field('intro');
$price = get_field('price');
$shoot = get_field('shoot');
$costume = get_field('costume');
$interior = get_field('interior');
$freedom = get_field('freedom');
$graf = get_field('graf');
?>
<article>
<a href="<?php the_permalink(); ?>">
<div class="post-thumbnail">
<div class="img-inner">
<?php the_post_thumbnail('small_thumbnail', array('alt' => get_the_title(), 'class' => 'img-fit-cover')); ?>
</div>
</div>
<div class="bx-caption">
<h2 class="ttl-main"><?php echo $name; ?></h2>
<p><?php echo mb_substr(strip_tags($intro), 0, 40).'...'; ?></p>
<!-- <div class="ttl-post-category"><i class="fa fa-folder"></i> <?php echo $cat_name; ?></div> -->
<!-- <time class="date-main"><?php the_time('Y-m-d'); ?></time> -->
</div>
</a>
</article>
<?php endwhile; endif;