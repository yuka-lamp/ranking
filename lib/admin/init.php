<?php
function load_admin_things()
{
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'load_admin_things');
add_action('admin_menu', 'initial_setting_menu');
function initial_setting_menu()
{
    add_menu_page('テンプレート設定', 'テンプレート設定', 'manage_options', 'initial_setting_menu', 'banner_options_page', '', 1);
    add_action('admin_init', 'register_lamp_setting', 'admin-head');
}
function register_lamp_setting()
{
    register_setting('lamp-initialize-group', 'blogname');
    register_setting('lamp-initialize-group', 'blogdescription');
    register_setting('lamp-initialize-group', 'meta_keywords');
    register_setting('lamp-initialize-group', 'banner_url');
    register_setting('lamp-initialize-group', 'banner_image');
    register_setting('lamp-initialize-group', 'blog_public');
    register_setting('lamp-initialize-group', 'main_color');
    register_setting('lamp-initialize-group', 'font_family');
    register_setting('lamp-initialize-group', 'permalink_structure');
    register_setting('lamp-initialize-group', 'toppage_logo_type');
    register_setting('lamp-initialize-group', 'logo_text');
    register_setting('lamp-initialize-group', 'logo_image');
    register_setting('lamp-initialize-group', 'analytics_tracking_code');
    register_setting('lamp-initialize-group', 'google_publisher');
    register_setting('lamp-initialize-group', 'facebook_user_id');
    register_setting('lamp-initialize-group', 'facebook_app_id');
    register_setting('lamp-initialize-group', 'facebook_page_url');
    register_setting('lamp-initialize-group', 'def_image');
    register_setting('lamp-initialize-group', 'twitter_id');
    register_setting('lamp-initialize-group', 'instagram');
    flush_rewrite_rules(true);
}
function banner_options_page()
{ ?>
<script type="text/javascript">
jQuery('document').ready(function(){
jQuery('.media-upload').each(function(){
var rel = jQuery(this).attr("rel");
jQuery(this).click(function(){
window.send_to_editor = function(html) {
html = '<a>' + html + '</a>';
imgurl = jQuery('img', html).attr('src');
jQuery('#'+rel).val(imgurl);
tb_remove();
}
formfield = jQuery('#'+rel).attr('name');
tb_show(null, 'media-upload.php?post_id=0&type=image&TB_iframe=true');
return false;
});
});
});
</script>
<div class="wrap">
<h2>テンプレート設定</h2>
<form method="post" action="options.php" enctype="multipart/form-data" encoding="multipart/form-data">
<?php
    settings_fields('lamp-initialize-group');
    do_settings_sections('lamp-initialize-group'); ?>
<div class="metabox-holder">
<div id="toppage_logo_setting" class="postbox ">
<h3 class="hndle"><span>ロゴ設定</span></h3>
<div class="inside">
<div class="main">
<?php
$toppage_logo_type = trim(get_option('toppage_logo_type'));
    if (isset($toppage_logo_type) && $toppage_logo_type !== '') {
        $toppage_logo_type = trim(get_option('toppage_logo_type'));
    } else {
        $toppage_logo_type = 'logo_text';
    } ?>
<label><input type="radio" name="toppage_logo_type" value="logo_text" <?php checked($toppage_logo_type, 'logo_text'); ?>checked >
<strong>テキストロゴ</strong></label>
<p><input type="text" id="logo_text" name="logo_text" class="regular-text" value="<?php echo get_option('logo_text'); ?>"></p>
<label><input type="radio" name="toppage_logo_type" value="logo_image"<?php checked($toppage_logo_type, 'logo_image'); ?> ><strong>画像ロゴ</strong></label>
<p><input type="text" id="logo_image" name="logo_image" class="regular-text" value="<?php echo get_option('logo_image'); ?>"><a class="media-upload" href="JavaScript:void(0);" rel="logo_image"><input class="cmb_upload_button button" type="button" value="画像をアップロードする"></a>
</p>
</div>
</div>
</div>

<div id="main_color_setting" class="postbox">
<h3 class="hndle"><span>メインカラー設定</span></h3>
<div class="inside">
<div class="main">
<div class="metabox-holder">
<p class="setting_description"><small>メニューのホバーカラー等に反映されます。クリックするとカラーピッカーが表示されます。</small></p>
<p><input type="color" id="main_color" name="main_color" class="regular-text" value="<?php echo get_option('main_color'); ?>"></p>
</div>
</div>
</div>
</div>

<div id="font_family_setting" class="postbox">
<h3 class="hndle"><span>フォント設定</span></h3>
<div class="inside">
<div class="main">
<div class="metabox-holder">
<p class="setting_description"><small>サイトのfont-familyを指定して下さい。※font-family{ この部分のみ(ダブルクォートは使えません) }</small></p>
<p><input type="text" id="font_family" name="font_family" class="regular-text" value="<?php echo get_option('font_family'); ?>"></p>
</div>
</div>
</div>
</div>

<div id="toppage_meta_setting" class="postbox">
<h3 class="hndle"><span>フロントページのメタタグの設定</span></h3>
<div class="inside">
<div class="main">
<h4>フロントページタイトル</h4>
<p><input type="text" id="blogname" class="regular-text" name="blogname" value="<?php echo get_option('blogname'); ?>"></p>
<h4>フロントページの説明（メタディスクリプション）</h4>
<textarea id="blogdescription" class="regular-text" name="blogdescription" rows="5" cols="60"><?php echo get_option('blogdescription'); ?></textarea>
<p class="setting_description"><small>全角80文字程度</small></p>
<h4>メタキーワード</h4>
<input type="text" id="meta_keywords" class="regular-text" name="meta_keywords" value="<?php echo get_option('meta_keywords'); ?>">
<p class="setting_description"><small>3キーワード以内推奨。複数の場合は「,」半角カンマで区切る。</small></p>
</div>
</div>
</div>
</div>
<div class="metabox-holder">
<div id="google_tools" class="postbox ">
<h3 class="hndle"><span>Googleアナリティクスの設定</span></h3>
<div class="inside">
<div class="main">
<textarea name="analytics_tracking_code" rows="10" cols="60" id="analytics_tracking_code" class="cmb_textarea_code"><?php echo get_option('analytics_tracking_code'); ?></textarea>
<p class="setting_description"><small>Googleアナリティクスのトラッキングコードを入力して下さい。</small></p>
</div>
</div>
</div>
</div>
<div class="metabox-holder">
<div id="facebook_connection" class="postbox ">
<h3 class="hndle"><span>Facebookとの連携</span></h3>
<div class="inside">
<div class="main">
<p class="setting_description">Facebookとの連携を行います。サイドバーやフッターなどにボタンが表示されます。</p>
<h4>FacebookユーザーIDの入力</h4>
<input type="text" id="facebook_user_id" class="regular-text" name="facebook_user_id" value="<?php echo get_option('facebook_user_id'); ?>">
<p class="setting_description"><small>FacebookのユーザーIDを入力してください。</small></p>
<h4>FacebookアプリケーションIDの入力</h4>
<input type="text" id="facebook_app_id" class="regular-text" name="facebook_app_id" value="<?php echo get_option('facebook_app_id'); ?>">
<p class="setting_description"><small>FacebookのアプリケーションIDを入力して下さい。</small></p>
<h4>Facebookページurl</h4>
<input type="text" id="facebook_page_url" class="regular-text" name="facebook_page_url" value="<?php echo get_option('facebook_page_url'); ?>">
<h4>デフォルト画像の設定</h4>
<input type="text" id="def_image" name="def_image" class="regular-text" value="<?php echo get_option('def_image'); ?>"><a class="media-upload" href="JavaScript:void(0);" rel="def_image"><input class="cmb_upload_button button" type="button" value="画像をアップロードする"></a>
<p class="setting_description"><small>サイトがシェアされた時に表示させたい画像を選択してアップロードボタンを押してください。サイトのフロントページや、その他アイキャッチ画像が設定されていないページがシェアされた時には、ここのアップロードした画像が、Facebook上で表示されるようになります。画像のサイズは、1200 px x 630 pxが最も綺麗に表示されます。</small></p>
</div>
</div>
</div>
</div>
<div class="metabox-holder">
<div id="google_connection" class="postbox ">
<h3 class="hndle"><span>Googleとの連携</span></h3>
<div class="inside">
<div class="main">
<h4>パブリッシャー</h4>
<input type="text" id="google_publisher" class="regular-text" name="google_publisher" value="<?php echo get_option('google_publisher'); ?>">
<p class="setting_description"><small>Google+にログインし左上にあるメニューを[ホーム → ページ]の順にクリックします。<br>
該当するページをクリックして、その際にアドレスバーに表示されている下記の数字部分をご入力ください。<br>
https://plus.google.com/b/000000000000000000000/dashboard/overview/</small></p>
</div>
</div>
</div>
</div>
<div class="metabox-holder">
<div id="twitter_connection" class="postbox ">
<h3 class="hndle"><span>Twitterとの連携</span></h3>
<div class="inside">
<div class="main">
<p class="setting_description">Twitterとの連携を行います。サイドバーやフッターなどにボタンが表示されます。</p>
<h4>Twitter ID</h4>
<p class="setting_description"><small>@マーク以降の英数字を入力して下さい。</small></p>
<input type="text" id="twitter_id" class="regular-text" name="twitter_id" value="<?php echo get_option('twitter_id'); ?>">
</div>
</div>
</div>
</div>
<div class="metabox-holder">
<div id="instagram_connection" class="postbox">
<h3 class="hndle"><span>Instagramとの連携</span></h3>
<div class="inside">
<div class="main">
<p class="setting_description">Instagramとの連携を行います。サイドバーやフッターなどにボタンが表示されます。</p>
<h4>Instagram ID</h4>
<input type="text" id="instagram" class="regular-text" name="instagram" value="<?php echo get_option('instagram'); ?>">
</div>
</div>
</div>
</div>
<div class="metabox-holder">
<div id="others" class="postbox ">
<h3 class="hndle"><span>その他の設定</span></h3>
<div class="inside">
<div class="main">
<h4>検索エンジンでの表示</h4>
<label for="blog_public"><input name="blog_public" type="checkbox" id="blog_public" value="0" <?php checked(get_option('blog_public'), 0); ?>>
検索エンジンがサイトをインデックスしないようにする</label>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {
jQuery('.permalink-structure input:radio').change(function() {
if ( 'custom' == this.value )
return;
jQuery('#permalink_structure').val( this.value );
});
jQuery('#permalink_structure').focus(function() {
jQuery("#custom_selection").attr('checked', 'checked');
});
});
//]]>
</script>
<?php
$permalink_structure = get_option('permalink_structure');
    $prefix = $blog_prefix = '';
    $structures = array(
0 => '',
1 => $prefix . '/%year%/%monthnum%/%day%/%postname%/',
2 => $prefix . '/%year%/%monthnum%/%postname%/',
3 => $prefix . '/' . _x('archives', 'sample permalink base') . '/%post_id%',
4 => $prefix . '/%postname%/',
); ?>
<h4><?php _e('Common Settings'); ?></h4>
<table class="form-table permalink-structure">
<tr>
<th><label><input name="selection" type="radio" value="" <?php checked('', $permalink_structure); ?>> <?php _e('Default'); ?></label></th>
<td><code><?php echo home_url(); ?>/?p=123</code></td>
</tr>
<tr>
<th><label><input name="selection" type="radio" value="<?php echo esc_attr($structures[1]); ?>" <?php checked($structures[1], $permalink_structure); ?>> <?php _e('Day and name'); ?></label></th>
<td><code><?php echo home_url() . $blog_prefix . $prefix . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . _x('sample-post', 'sample permalink structure') . '/'; ?></code></td>
</tr>
<tr>
<th><label><input name="selection" type="radio" value="<?php echo esc_attr($structures[2]); ?>" <?php checked($structures[2], $permalink_structure); ?>> <?php _e('Month and name'); ?></label></th>
<td><code><?php echo home_url() . $blog_prefix . $prefix . '/' . date('Y') . '/' . date('m') . '/' . _x('sample-post', 'sample permalink structure') . '/'; ?></code></td>
</tr>
<tr>
<th><label><input name="selection" type="radio" value="<?php echo esc_attr($structures[3]); ?>" <?php checked($structures[3], $permalink_structure); ?>> <?php _e('Numeric'); ?></label></th>
<td><code><?php echo home_url() . $blog_prefix . $prefix . '/' . _x('archives', 'sample permalink base') . '/123'; ?></code></td>
</tr>
<tr>
<th><label><input name="selection" type="radio" value="<?php echo esc_attr($structures[4]); ?>" <?php checked($structures[4], $permalink_structure); ?>> <?php _e('Post name'); ?></label></th>
<td><code><?php echo home_url() . $blog_prefix . $prefix . '/' . _x('sample-post', 'sample permalink structure') . '/'; ?></code></td>
</tr>
<tr>
<th>
<label><input name="selection" id="custom_selection" type="radio" value="custom" <?php checked(!in_array($permalink_structure, $structures)); ?>>
<?php _e('Custom Structure'); ?>
</label>
</th>
<td>
<code><?php echo home_url() . $blog_prefix; ?></code>
<input name="permalink_structure" id="permalink_structure" type="text" value="<?php echo esc_attr($permalink_structure); ?>" class="regular-text code">
</td>
</tr>
</table>
</div>
</div>
</div>
</div>
<?php submit_button(); ?>
</form>
</div>
<?php
}

// 投稿画面の項目を非表示にする
function remove_default_post_screen_metaboxes()
{
    if (!current_user_can('level_10')) {
        remove_meta_box('postcustom', 'post', 'normal');
        remove_meta_box('postexcerpt', 'post', 'normal');
        remove_meta_box('commentstatusdiv', 'post', 'normal');
        remove_meta_box('commentsdiv', 'post', 'normal');
        remove_meta_box('trackbacksdiv', 'post', 'normal');
        remove_meta_box('authordiv', 'post', 'normal');
        remove_meta_box('slugdiv', 'post', 'normal');
        remove_meta_box('revisionsdiv', 'post', 'normal');
    }
}
add_action('admin_menu', 'remove_default_post_screen_metaboxes');
