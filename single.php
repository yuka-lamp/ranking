<?php get_header('2'); ?>
<div id="content" class="pa30">
<div id="wrapper" class="wrap">
<div id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="main-inner">
<?php
if (have_posts()):
while (have_posts()): the_post();
global $post;
$cf = get_post_meta($post->ID);
$facebook_page_url = '';
$facebook_page_url = get_option('facebook_page_url');
$post_cat = ''; ?>
<article id="post-<?php the_id(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<header class="post-header">

<!-- アイキャッチ -->
<?php if(get_the_post_thumbnail()): ?>
<a href="<?php the_permalink(); ?>" itemprop="mainEntityOfPage">
<div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
<meta itemprop="url" content="<?php echo get_the_post_thumbnail_url(); ?>">
<meta itemprop="width" content="1200">
<meta itemprop="height" content="630">
<?php the_post_thumbnail(array(1200, 630, true), array('alt'=>trim(get_the_title()))); ?>
</div>
</a>
<?php endif; ?>

<!-- タイトル -->
<h1 class="post-title entry-title" itemprop="headline"><?php the_title(); ?></h1>

<!-- 記事記事データ -->
<div class="post-meta-area">
<ul class="post-meta list-inline">
<li class="cat-name"><i class="fa fa-folder"></i><?php
$category = get_the_category();
echo $category[0]->cat_name; ?></li>
<li class="date"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><time class="entry-date" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></time></li>
<li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i><time class="updated" itemprop="dateModified" datetime="<?php the_modified_date('Y-m-d') ?>"><?php the_modified_date('Y-m-d') ?></time></li>
<li class="vcard author" itemprop="author"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span class="fn"><?php the_author(); ?></span></li>
</ul>
</div>

<!-- snsシェア -->
<div class="post-sns">
<ul class="single-sns-top-box clearfix">
<li class="tw"><a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink() ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
<li class="fb"><a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
<li class="ln"><a href="http://line.me/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>" target="blank"><i class="icon-line"></i></a></li>
<li class="gp"><a href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
<li class="hb"><a href="http://b.hatena.ne.jp/entry/<?php the_permalink() ?>" target="blank"><i class="icon-hatena"></i></a></li>
<li class="pt"><a href="http://getpocket.com/edit?url=<?php the_permalink() ?>" target="blank"><i class="fa fa-get-pocket" aria-hidden="true"></i></a></li>
</ul>
</div>

</header>

<!-- 内容 -->
<section class="post-content" itemprop="text">
<?php the_content(); ?>
</section>

<!-- CTA -->
<div class="cta">
<?php echo lamp_get_cta($post->ID); ?>
</div>

<footer class="post-footer">
<div class="post-sns">
<ul class="single-sns-top-box clearfix">
<li class="tw"><a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink() ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
<li class="fb"><a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
<li class="ln"><a href="http://line.me/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>" target="blank"><i class="icon-line"></i></a></li>
<li class="gp"><a href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
<li class="hb"><a href="http://b.hatena.ne.jp/entry/<?php the_permalink() ?>" target="blank"><i class="icon-hatena"></i></a></li>
<li class="pt"><a href="http://getpocket.com/edit?url=<?php the_permalink() ?>" target="blank"><i class="fa fa-get-pocket" aria-hidden="true"></i></a></li>
</ul>
</div>
<ul class="post-footer-list">
<li class="cat"><i class="fa fa-folder"></i> <?php the_category(', '); ?></li>
<?php
$posttags = get_the_tags();
if($posttags){ ?>
<li class="tag"><i class="fa fa-tag"></i> <?php the_tags(''); ?></li>
<?php } ?>
</ul>
</footer>
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
<h2 class="ttl-02">この記事のライター</h2>
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
<h2 class="ttl-02">関連の記事</h2>
<?php include_once('related-entries.php'); ?>
</div>
<div class="posts-list pa30">
<h2 class="ttl-02">最新の記事</h2>
<?php include_once('new-posts.php'); ?>
</div>
</div><!-- /main-inner -->
</div><!-- /main -->
<?php get_sidebar(); ?>
</div><!-- /wrap -->
</div><!-- /content -->
<?php if(is_mobile()): ?>
<div id="sns_boxSp">
<ul class="footer_menu">
<li class="tw">
<a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink() ?>" target="_blank">
<i class="fa fa-twitter" aria-hidden="true"></i></a></li>
<li class="fb">
<a href="http://www.facebook.com/share.php?u=<?php echo("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
<li class="ln">
<a href="http://line.me/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>" target="blank"><i class="icon-line"></i></a></li>
<li class="page-top"><a href="#"><i class="fa fa-chevron-circle-up"></i></a></li>
</ul>
</div>
<?php endif; ?>
<?php get_footer();