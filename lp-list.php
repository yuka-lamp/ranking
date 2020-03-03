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
<h2><span><?php echo $no.'位　'.$name; ?></span></h2>
<a href="<?php echo get_field('url'); ?>" target="_blank" rel="nofollow">
<?php the_post_thumbnail('large', array('alt' => 'チャットレディ求人サイト「'.$name.'」')); ?>
</a>
<div class="studio-cap"><?php echo $intro; ?></div>
<div class="studio-point">
<?php if (get_field('point-1')) echo '<div class="studio-point-list"><img src="'.get_template_directory_uri().'/lib/images/arare/good.png" alt="花魁体験Point">'.get_field('point-1').'</div>'; ?>
<?php if (get_field('point-2')) echo '<div class="studio-point-list"><img src="'.get_template_directory_uri().'/lib/images/arare/good.png" alt="花魁体験Point">'.get_field('point-2').'</div>'; ?>
<?php if (get_field('point-3')) echo '<div class="studio-point-list"><img src="'.get_template_directory_uri().'/lib/images/arare/good.png" alt="花魁体験Point">'.get_field('point-3').'</div>'; ?>
</div>
<div class="btn-arare">
<a href="<?php the_permalink(); ?>">サイト詳細をみる</a>
</div>
</article>
<?php ++$no; endwhile; endif; wp_reset_postdata();