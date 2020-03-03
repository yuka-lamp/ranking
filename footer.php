<footer id="footer">
<div class="footer-01">
<div class="wrap">
<div class="footer-content-area gr6">
<div class="footer-cont-content">
<h4>メニュー</h4>
<?php
wp_nav_menu(
array(
'theme_location'  => 'global_nav',
'menu_class'      => 'clearfix',
'menu_id'         => 'footer-gnav-ul',
'container'       => 'div',
'container_id'    => 'footer-gnav-container',
'container_class' => 'gnav-container'
)
); ?>
</div>

<!-- <div id="footer-tag-area" class="footer-cont-content">
<h4>おすすめのタグ</h4>
<div class="tagcloud">
<?php wp_tag_cloud('number=10&orderby=count'); ?>
</div>
</div> -->
</div>

<div class="footer-content-area gr6">
<div id="footer-page-area" class="footer-cont-content">
<h4>当サイトについて</h4>
<?php if (has_nav_menu('footer_nav')) {
wp_nav_menu(
array(
'theme_location'  => 'footer_nav',
'menu_class'      => '',
'menu_id'         => 'fnav',
'container'       => 'nav',
'items_wrap'      => '<ul>%3$s</ul>'
)
);
}
?>
</div>
</div>

</div><!-- /wrap -->
</div><!-- /footer-01 -->

<div class="footer-02">
<div class="inline"><p class="footer-copy">
© Copyright <?php echo date('Y'); ?> <a href="http://kyoto-oiran.net/">大阪のチャットレディ求人人気ランキング</a>. All rights reserved.
</p></div>
<!-- <div id="footer-cont-sns">
<?php footer_social_buttons(); ?>
</div> -->
</div><!-- /footer-02 -->
</footer>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/lib/js/jquery.MyThumbnail.js" charset="utf-8"></script>
<script src="<?php echo get_template_directory_uri(); ?>/lib/js/jquery.fit-sidebar.js" charset="utf-8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js" charset="utf-8"></script>
<script type="text/javascript">
(function($){

// 記事シェア
$("#sns_boxSp").hide();
  $(window).on("scroll", function() {
    if ($(this).scrollTop() > 100) {
        $('#sns_boxSp').fadeIn();
    } else {
        $('#sns_boxSp').fadeOut();
    }
  });

// sp-nav
  $('#header-nav-btn a').on('click',function() {
    $(this).toggleClass('action');
    $('#gnav-sp').toggleClass('action');
  });
  $('.nav-close').on('click',function() {
    $(this).toggleClass('action');
    $('#gnav-sp').toggleClass('action');
  });

// 記事検索
  $(function(){
    $('#search-nav-btn a').click(function(){
      $('#head-form').slideToggle();
      $('body').append('<p class="dummy"></p>');
    });
    $('body').on('click touchend', '.dummy', function() {
      $('#head-form').slideUp();
      $('p.dummy').remove();
      return false;
    });
  });

// サイドバー
  $('#side .side-inner').fitSidebar({
    wrapper : '#wrapper',responsiveWidth : 991
  });
})(jQuery);
</script>
</body>
</html>
