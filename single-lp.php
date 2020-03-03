<?php get_header('2'); ?>
<div id="content" class="pa30">
<div id="wrapper" class="wrap">
<div id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="main-inner">
<?php
if (have_posts()):
while (have_posts()): the_post();
global $post;
$facebook_page_url = get_option('facebook_page_url');
$name = get_field('name');
$site_url = get_field('url');
$intro = get_field('intro');
$price = get_field('price');
$shoot = get_field('shoot');
$costume = get_field('costume');
$interior = get_field('interior');
$freedom = get_field('freedom');
?>
<article id="post-<?php the_id(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<header class="post-header">
<!-- アイキャッチ -->
<?php if(get_the_post_thumbnail()): ?>
<a href="<?php echo $site_url; ?>" target="_blank" rel="nofollow" itemprop="mainEntityOfPage">
<div id="lp-thumbnail" class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
<meta itemprop="url" content="<?php echo get_the_post_thumbnail_url(); ?>">
<meta itemprop="width" content="1200">
<meta itemprop="height" content="630">
<?php the_post_thumbnail(array(1200, 630, true), array('alt'=>trim(get_the_title()), 'class' => 'img-fit-cover')); ?>
</div>
</a>
<?php endif; ?>
<!-- タイトル -->
<a href="<?php echo $site_url; ?>" target="_blank" rel="nofollow">
<h1 class="post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
</a>
</header>

<!-- 内容 -->
<section class="post-content" itemprop="text">
<div class="top-ttl-wrap">
<h3 class="top-ttl3">Eevaluation</h3>
<p class="top-ttl3-sub">評価</p>
</div>

<div class="">
  <table>
    <tr>
      <th><?php echo get_field('evaluation_01',120);?></th>
      <td><?php echo get_field('score1');?></td>
    </tr>
    <tr>
      <th><?php echo get_field('evaluation_02',120);?></th>
      <td><?php echo get_field('score2');?></td>
    </tr>
    <tr>
      <th><?php echo get_field('evaluation_03',120);?></th>
      <td><?php echo get_field('score3');?></td>
    </tr>
    <tr>
      <th><?php echo get_field('evaluation_04',120);?></th>
      <td><?php echo get_field('score4');?></td>
    </tr>
    <tr>
      <th><?php echo get_field('evaluation_05',120);?></th>
      <td><?php echo get_field('score5');?></td>
    </tr>
  </table>
</div>

<div class="hyouka"><?php echo $intro; ?></div>
<div class="url btn-arare">
<a href="<?php echo $site_url; ?>" target="_blank" rel="nofollow">公式サイトを見る</a>
</div>
<?php the_content(); ?>
</section>
<?php
if(is_active_sidebar('under_post_area')){ ?>
<div class="post-share">
<?php dynamic_sidebar('under_post_area'); ?>
</div>
<?php }
$logo_image = get_option('logo_image');
$avatar = get_user_meta($post->post_author, 'original_avatar', true);
if ($avatar == '') {
  $avatar = get_template_directory_uri().'/lib/images/user.png';
} ?>
<!-- <section class="publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
<h2 class="ttl-02">サイト運営者</h2>
<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
<span itemprop="url" content="<?php echo $avatar; ?>">
<img src="<?php echo $avatar; ?>" alt="著者" class="ph-avatar">
</span>
</span>
<span itemprop="name"><?php the_author(); ?></span>
</section> -->
</article>
<?php
endwhile;
else: ?>
<p>投稿が見つかりません。</p>
<?php endif; ?>
<div class="posts-list pa30">
<h2 class="ttl-02">他のチャットレディ求人サイト</h2>
<?php include_once('related-entries.php'); ?>
</div>
</div><!-- /main-inner -->
</div><!-- /main -->
<?php get_sidebar(); ?>
</div><!-- /wrap -->
</div><!-- /content -->

<?php get_footer();
