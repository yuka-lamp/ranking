<?php
register_nav_menu('global_nav', 'グローバルナビ（ヘッダー領域下に表示）');
register_nav_menu('footer_nav', 'プライマリーナビ（ヘッダー・フッター領域に表示）');
add_filter('nav_menu_css_class', 'lamp_my_nav_menu_css_class', 10, 2);
function lamp_my_nav_menu_css_class($classes, $item)
{
    if ('page' == $item->object) {
        $page = get_page_by_title($item->title);
        $classes[] = $page->post_name;
    } elseif ('category' == $item->object) {
        $cat = get_category(get_cat_ID($item->title));
        $classes[] = $cat->slug;
    }
    return $classes;
}
add_theme_support('post-thumbnails', array( 'post', 'page', 'cta', 'lp' ));
set_post_thumbnail_size(304, 214);
add_theme_support('small_thumbnail');
add_theme_support('mid_thumbnail');
add_theme_support('big_thumbnail');
add_image_size('small_thumbnail', 300, 158);
add_image_size('mid_thumbnail', 800, 430, true);
add_image_size('big_thumbnail', 1200, 630, true);
add_image_size('loop_thumbnail', 800, 533, true);
register_sidebar(
  array(
    'name'          => 'サイドバー',
    'id'            => 'sidebar',
    'description'   => 'サイドバーに入るウィジェットエリアです。',
    'before_widget' => '<div id="%1$s" class="%2$s side-widget"><div class="side-widget-inner">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h4 class="side-title"><span class="side-title-inner">',
    'after_title'   => '</span></h4>'
  )
);
register_sidebar(
  array(
    'name' => '投稿記事下',
    'id' => 'under_post_area',
    'description' => '',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  )
);
function lamp_remove_more_jump_link($link)
{
    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"', $offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end-$offset);
    }
    return $link;
}
add_filter('the_content_more_link', 'lamp_remove_more_jump_link');add_filter('the_content', 'lamp_nofollow_more_link');
function lamp_nofollow_more_link($content)
{
    return preg_replace("@class=\"more-link\"@", "class=\"more-link\" rel=\"nofollow\"", $content);
}add_filter('user_contactmethods', 'lamp_my_user_meta', 10, 1);
function lamp_my_user_meta($lamp_user_info)
{
    $lamp_user_info['facebook'] = 'facebook';
    $lamp_user_info['googleplus'] = 'google+';
    return $lamp_user_info;
}add_action('user_edit_form_tag', 'lamp_add_enctype_attr2user_edit_form_tag');
function lamp_add_enctype_attr2user_edit_form_tag()
{
    echo ' enctype="multipart/form-data"';
}
add_action('show_password_fields', 'lamp_add_original_avatar_form');
function lamp_add_original_avatar_form($bool)
{
    global $profileuser;
    if (preg_match('/^(profile\.php|user-edit\.php)/', basename($_SERVER['REQUEST_URI']))) {
        ?>
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
<?php echo get_user_meta(1, 'original_avatar', true); ?>
<tr>
<th><label for="original_avatar">オリジナルアバター</label></th>
<td>
<input type="text" id="original_avatar" name="original_avatar" class="regular-text" value="<?php echo get_user_meta($profileuser->ID, 'original_avatar', true); ?>">
<a class="media-upload" href="JavaScript:void(0);" rel="original_avatar">
<input class="cmb_upload_button button" type="button" value="画像をアップロードする"></a>
</td>
</tr>
<?php
    }
    return $bool;
}add_action('profile_update', 'lamp_update_original_avatar', 10, 2);
function lamp_update_original_avatar($user_id, $old_user_data)
{
    if (isset($_POST['original_avatar']) && $old_user_data->original_avatar != $_POST['original_avatar']) {
        $original_avatar = sanitize_text_field($_POST['original_avatar']);
        $original_avatar = wp_filter_kses($original_avatar);
        $original_avatar = _wp_specialchars($original_avatar);
        update_user_meta($user_id, 'original_avatar', $original_avatar);
    }
}add_action('wp_dashboard_setup', 'lamp_my_custom_dashboard_widgets');
function lamp_my_custom_dashboard_widgets()
{
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_help_widget', '株式会社ランプからのお知らせ', 'lamp_dashboard_text');
}
function lamp_dashboard_text()
{
    echo '<iframe src="https://lamp.jp/addbox/" width="100%" height="300"></iframe>';
} if (!function_exists('pagination')) {
    function pagination($pages = '', $range = 4)
    {
        $showitems = ($range * 1)+1;
        global $paged;
        if (empty($paged)) {
            $paged = 1;
        }
        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }
        if (1 != $pages) {
            echo "<div class=\"pagination\">";
            if ($paged > 2 && $paged > $range+1 && $showitems < $pages) {
                echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
            }
            if ($paged > 1 && $showitems < $pages) {
                echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
            }
            for ($i=1; $i <= $pages; $i++) {
                if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
                    echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">" . $i . "</a>";
                }
            }
            if ($paged < $pages && $showitems < $pages) {
                echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
            }
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
                echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
            }
            echo "</div>\n";
        }
    }
}
add_filter('get_search_form', 'lamp_search_form');add_filter('get_search_form', 'lamp_search_form');
function lamp_search_form($form)
{
    $form = '<form role="search" method="get" id="searchform" action="'.home_url('/').'" >
  <div>
  <input type="text" value="' . get_search_query() . '" name="s" id="s">
  <button type="submit" id="searchsubmit"></button>
  </div>
  </form>';
    return $form;
}
add_action('pre_get_posts', 'lamp_customize_main_query');
if (!function_exists('lamp_customize_main_query')) {
    function lamp_customize_main_query($query)
    {
        if (is_admin() || ! $query->is_main_query()) {
            return;
        }
        if ($query->is_front_page() || $query->is_home()) {
            $query->set(
            'meta_query',
            array(
              array('key'=>'lamp_show_toppage_flag',
                         'compare' => 'NOT EXISTS'
              ),
              array('key'=>'lamp_show_toppage_flag',
                        'value'=>'none',
                        'compare'=>'!='
              ),
             'relation'=>'OR'
          )
        );
            $query->set('order', 'DESC');
        } elseif (is_singular()) {
        }
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            $query->set('post_type', 'post');
        }
    }
}
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function is_mobile()
{
    $useragents = array('iPhone','iPod','Android','dream','CUPCAKE','blackberry9500','blackberry9530','blackberry9520','blackberry9550','blackberry9800','webOS','incognito','webmate',);
    $pattern = '/'.implode('|', $useragents).'/i';

    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
function the_category_filter($thelist, $separator=', ')
{
    if (!defined('WP_ADMIN')) {
        $exclude = array('ピックアップ');
        $cats = explode($separator, $thelist);
        $newlist = array();
        foreach ($cats as $cat) {
            $catname = trim(strip_tags($cat));
            if (!in_array($catname, $exclude)) {
                $newlist[] = $cat;
            }
        }
        return implode($separator, $newlist);
    } else {
        return $thelist;
    }
}
add_filter('the_category', 'the_category_filter', 10, 2);

function custom_columns($columns)
{
    unset($columns['tag']);
    unset($columns['comments']);
    $columns['eyecatch'] = 'アイキャッチ';
    return $columns;
}
function add_custom_columns($column_name, $post_id)
{
    if ($column_name == 'eyecatch') {
        $thumb = get_the_post_thumbnail($post_id, array(120, 80));
        echo ($thumb) ? $thumb : __('None');
    }
}
add_filter('manage_posts_columns', 'custom_columns');
add_action('manage_posts_custom_column', 'add_custom_columns', 10, 2);


function add_editor_style_cb()
{
    add_editor_style();
}
add_action('admin_init', 'add_editor_style_cb');
add_filter('jetpack_enable_open_graph', '__return_false');
function remove_bar_menus($wp_admin_bar)
{
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('themes');
    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('new-media');
    $wp_admin_bar->remove_menu('new-link');
    $wp_admin_bar->remove_menu('new-page');
    $wp_admin_bar->remove_menu('new-user');
}
add_action('admin_bar_menu', 'remove_bar_menus', 201);
add_filter('rwmb_meta_boxes', 'check_list');
