<div id="side" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
<div class="side-inner">
<div class="side-widget-area">

<div id="views-2" class="widget_views side-widget">
<div class="side-widget-inner"><h4 class="side-title"><span class="side-title-inner">人気のチャットレディBEST10</span></h4>
<ul class="postviews">
<?php
$args = array('post_type' => 'lp','orderby' => 'date', 'order' => 'ASC');
$query = new WP_Query($args);
if($query->have_posts()):
$no = 1;
while ($query->have_posts()): $query->the_post();
$name = get_field('name'); ?>
<li class="pop-list">
<a href="<?php the_permalink(); ?>">
<div class="post-thumbnail">
<div class="img-inner">
<?php the_post_thumbnail('small_thumbnail', array('alt' => get_the_title(), 'class' => 'img-fit-cover')); ?>
</div>
</div>
<div class="bx-caption"><h2 class="ttl-main"><?php echo $name; ?></h2></div>
</a>
</li>
<?php endwhile; endif; ?>
</ul>
</div>
</div>
<div class="side-sns side-widget">
<ul>

<?php if(get_option('google_publisher')): ?>
<li class="btn-side-sns01 gp">
<a href="https://plus.google.com/<?php echo get_option('google_publisher'); ?>" target="blank">
<i class="fa fa-google-plus" aria-hidden="true"></i><span>Google+をフォロー</span>
</a>
</li>
<?php endif; ?>

<?php if(get_option('twitter_id')): ?>
<li class="btn-side-sns01 tw">
<a href="https://twitter.com/<?php echo get_option('twitter_id'); ?>" target="blank">
<i class="icon-twitter" aria-hidden="true"></i><span>twitterをフォロー</span>
</a>
</li>
<?php endif; ?>

<?php if(get_option('instagram')): ?>
<li class="btn-side-sns01 insta">
<a href="https://www.instagram.com/<?php echo get_option('instagram'); ?>" target="blank">
<i class="fa fa-instagram" aria-hidden="true"></i><span>Instagramをフォロー</span>
</a>
</li>
<?php endif; ?>

</ul>
</div>

</div><!-- //side-widget-area -->
</div>
</div><!-- /side -->