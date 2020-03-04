<?php
add_filter('body_class', 'lamp_body_post_layout');
function lamp_body_post_layout($classes)
{
    global $post;
    $post_layout = "";
    if (is_front_page() || is_home() || is_category() || is_archive() || is_search()) {
        $post_layout = get_option('post_layout');
    } elseif (is_single() || is_page() || is_page_template('page-lp.php')) {
        $cf = get_post_meta($post->ID);
        if (isset($cf['lamp_post_layout']) && $cf['lamp_post_layout'] !== '') {
            if (is_array($cf['lamp_post_layout'])) {
                $post_layout = reset($cf['lamp_post_layout']);
            } else {
                $post_layout = $cf['lamp_post_layout'];
            }
        } else {
            $post_layout = get_option('post_layout');
        }
    }
    $classes[] = esc_attr($post_layout);
    return $classes;
}
add_filter('body_class', 'lamp_color_scheme');
function lamp_color_scheme($classes)
{
    $color_scheme = get_option('color_scheme');
    $classes[] = $color_scheme;
    return $classes;
}
function lamp_show_facebook_block()
{
    $facebook_block = '';
    $facebook_app_id = esc_html(get_option('facebook_app_id'));
    $facebook_block=<<<EOF
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.8&appId={$facebook_app_id}";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
EOF;
    echo $facebook_block;
}
add_action('wp_footer', 'lamp_show_google_plus_block');
function lamp_show_google_plus_block()
{
    $google_block = '';
    $google_block =<<<EOF
<script src="https://apis.google.com/js/platform.js" async defer>
{lang: 'ja'}
</script>
EOF;
    echo $google_block;
}
if (!function_exists('lamp_breadcrumb')) {
    function lamp_breadcrumb()
    {
        global $post;
        $post_type = get_post_type($post);
        $bc  = '<ol class="breadcrumb clearfix">';
        $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.home_url().'" itemprop="url"><i class="fa fa-home"></i> <span itemprop="title">神戸のチャットレディランキング</span></a> / </li>';
        if (is_home()) {
            $bc .= '<li><i class="fa fa-list-alt"></i> 最新記事一覧</li>';
        } elseif (is_search()) {
            $bc .= '<li><i class="fa fa-search"></i> 「'.get_search_query().'」の検索結果</li>';
        } elseif (is_404()) {
            $bc .= '<li><i class="fa fa-question-circle"></i> ページが見つかりませんでした</li>';
        } elseif (is_date()) {
            $bc .= '<li><i class="fa fa-clock-o"></i> ';
            if (is_day()) {
                $bc .= get_query_var('year').'年 ';
                $bc .= get_query_var('monthnum').'月 ';
                $bc .= get_query_var('day').'日';
            } elseif (is_month()) {
                $bc .= get_query_var('year').'年 ';
                $bc .= get_query_var('monthnum').'月 ';
            } elseif (is_year()) {
                $bc .= get_query_var('year').'年 ';
            }
            $bc .= '</li>';
        } elseif (is_post_type_archive()) {
            $bc .= '<li><i class="fa fa-folder"></i> '.post_type_archive_title('', false).'</li>';
        } elseif (is_category()) {
            $cat = get_queried_object();
            if ($cat -> parent != 0) {
                $ancs = array_reverse(get_ancestors($cat->cat_ID, 'category'));
                foreach ($ancs as $anc) {
                    $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_category_link($anc).'" itemprop="url"><i class="fa fa-folder"></i> <span itemprop="title">'.get_cat_name($anc).'</span></a> / </li>';
                }
            }
            $bc .= '<li><i class="fa fa-folder"></i> '.$cat->cat_name.'</li>';
        } elseif (is_tag()) {
            $bc .= '<li><i class="fa fa-tag"></i> '.single_tag_title("", false).'</li>';
        } elseif (is_author()) {
            $bc .= '<li><i class="fa fa-user"></i> '.get_the_author_meta('display_name').'</li>';
        } elseif (is_attachment()) {
            if ($post->post_parent != 0) {
                $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_permalink($post->post_parent).'" itemprop="url"><i class="fa fa-file-text"></i> <span itemprop="title">'.get_the_title($post->post_parent).'</span></a> / </li>';
            }
            $bc .= '<li><i class="fa fa-picture-o"></i> '.$post->post_title.'</li>';
        } elseif (is_singular('post')) {
            $cats = get_the_category($post->ID);
            $cat = $cats[0];
            if ($cat->parent != 0) {
                $ancs = array_reverse(get_ancestors($cat->cat_ID, 'category'));
                foreach ($ancs as $anc) {
                    $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_category_link($anc).'" itemprop="url"><i class="fa fa-folder"></i> <span itemprop="title">'.get_cat_name($anc).'</span></a> / </li>';
                }
            }
            $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_category_link($cat->cat_ID).'" itemprop="url"><i class="fa fa-folder"></i> <span itemprop="title">'.$cat->cat_name.'</span></a> / </li>';
            $bc .= '<li><i class="fa fa-file-text"></i> '.$post->post_title.'</li>';
        } elseif (is_singular('page')) {
            if ($post->post_parent != 0) {
                $ancs = array_reverse($post->ancestors);
                foreach ($ancs as $anc) {
                    $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_permalink($anc).'" itemprop="url"><i class="fa fa-file"></i> <span itemprop="title">'.get_the_title($anc).'</span></a> /';
                }
            }
            $bc .= '<li><i class="fa fa-file"></i> '.$post->post_title.'</li>';
        } elseif (is_singular($post_type)) {
            $obj = get_post_type_object($post_type);
            if ($obj->has_archive == true) {
                $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_post_type_archive_link($post_type).'" itemprop="url"><i class="fa fa-pencil-square-o"></i> <span itemprop="title">'.get_post_type_object($post_type)->label.'</span></a> / </li>';
            }
            $bc .= '<li><i class="fa fa-file"></i> '.$post->post_title.'</li>';
        } else {
            $bc .= '<li><i class="fa fa-file"></i> '.$post->post_title.'</li>';
        }
        $bc .= '</ol>';
        echo $bc;
    }
}
function lamp_layout_main()
{
    global $post;
    if (!is_object($post)) {
        return;
    }
    $cf = get_post_meta($post->ID);
    $main_layout = '';
    $post_layout = '';
    if (isset($cf['lamp_post_layout'])) {
        if (is_array($cf['lamp_post_layout'])) {
            $post_layout = reset($cf['lamp_post_layout']);
        } else {
            $post_layout = $cf['lamp_post_layout'];
        }
    }
    $post_layout = get_option('post_layout');
    if (is_single() || is_page()) {
        if ("right-content" == $post_layout) {
            $main_layout = "col-md-8  col-md-push-4";
        } elseif ("one-column" == $post_layout) {
            $main_layout = "col-md-10 col-md-offset-1";
        } else {
            $main_layout = "col-md-8";
        }
    } elseif ("right-content" == $post_layout) {
        $main_layout = "col-md-8  col-md-push-4";
    } elseif ("one-column" == $post_layout) {
        $main_layout = "col-md-10 col-md-offset-1";
    } else {
        $main_layout = "col-md-8";
    }
    echo 'class="'.esc_attr($main_layout).'"';
}
function lamp_layout_side()
{
    global $post;
    if (!is_object($post)) {
        return;
    }
    $cf = get_post_meta($post->ID);
    $post_layout = '';
    if (isset($cf['lamp_post_layout'])) {
        if (is_array($cf['lamp_post_layout'])) {
            $post_layout = reset($cf['lamp_post_layout']);
        } else {
            $post_layout = $cf['lamp_post_layout'];
        }
    }
    $lamp_option = get_option('lamp_option');
    if (is_single() || is_page()) {
        if ("right-content" == $post_layout) {
            $side_layout = "col-md-4 col-md-pull-8";
        } elseif ("one-column" == $post_layout) {
            $side_layout = "display-none";
        } else {
            $side_layout = "col-md-4";
        }
    } elseif ("right-content" == $lamp_option['post_layout']) {
        $side_layout = "col-md-4 col-md-pull-8";
    } elseif ("one-column" == $lamp_option['post_layout']) {
        $side_layout = "display-none";
    } else {
        $side_layout = "col-md-4";
    }
    echo 'class="'.esc_attr($side_layout).'"';
}
function lamp_layout_side_lp()
{
    global $post;
    $cf = get_post_meta($post->ID);
    $post_layout = "";
    if (isset($cf['lamp_post_layout'])) {
        if (is_array($cf['lamp_post_layout'])) {
            $post_layout = reset($cf['lamp_post_layout']);
        } else {
            $post_layout = $cf['lamp_post_layout'];
        }
    }
    if ("right-content" == $post_layout) {
        $side_layout = "col-md-4 col-md-pull-8";
    } elseif ("one-column" == $post_layout) {
        $side_layout = "display-none";
    } else {
        $side_layout = "col-md-4";
    }
    echo 'class="'.esc_attr($side_layout).'"';
}
function lamp_get_cta($pid = "")
{
    global $post;
    $check_cta = '';
    $lamp_cta = get_post_meta($post->ID, 'lamp_cta', true);
    if (is_array($lamp_cta)) {
        extract($lamp_cta);
    }
    if ('none' == $check_cta || '' == $check_cta) {
        return false;
    } elseif ($check_cta == 'custompost') {
        $cp_id =  $cta_select;
        $lamp_cta = get_post_meta($cp_id, 'lamp_cta', true);
        extract($lamp_cta);
        $customposts = get_post($cp_id);
        $lamp_cta['title'] = ($customposts->post_title);
        $lamp_cta['content'] = nl2br($customposts->post_content);
        $lamp_cta['button_text'] = ($select_button);
        $lamp_cta['button_url'] = esc_url($select_button_url);
        $thumbnail_id = get_post_thumbnail_id($cp_id);
        $image = wp_get_attachment_image_src($thumbnail_id, 'medium');
        $src = $image[0];
        $width = $image[1];
        $height = $image[2];
        $lamp_cta['image'] = '<img src="'.$src.'" alt="'.$lamp_cta['title'].'" width="'.$width.'" height="'.$height.'">';
    } elseif ($check_cta == 'pageorg') {
        $cta_title = ($org_title);
        $lamp_cta['title'] = esc_html($cta_title);
        $lamp_cta['content'] = $org_content;
        $lamp_cta['image'] = '<img src="' . esc_url($org_image) . '">';
        $lamp_cta['button_text'] = ($org_button_text);
        $lamp_cta['button_url'] = esc_url($org_button_url);
    }
    if (isset($lamp_cta['title']) && $lamp_cta['title'] !== '' && isset($lamp_cta['content']) && $lamp_cta['content'] !== ''  && isset($lamp_cta['image']) && $lamp_cta['image'] !== '<img src="">') {
        lamp_make_cta_block($lamp_cta);
    }
}
function lamp_make_cta_block($lamp_cta)
{
    $title = '';
    $cta_content = '';
    $title = (isset($lamp_cta['title']) && $lamp_cta['title'] !== '') ? $lamp_cta['title'] : "";
    $cta_content = (isset($lamp_cta['content']) && $lamp_cta['content'] !== '') ? $lamp_cta['content'] : "";
    $button_text = (isset($lamp_cta['button_text']) && $lamp_cta['button_text'] !== '') ? $lamp_cta['button_text'] : "";
    $button_url = (isset($lamp_cta['button_url']) && $lamp_cta['button_url'] !== '') ? $lamp_cta['button_url'] : "";
    $image = (isset($lamp_cta['image']) && $lamp_cta['image'] !== '') ? $lamp_cta['image'] : "";
    $source_html=<<<eof
<!-- CTA BLOCK -->
<div class="post-cta">
<h4 class="cta-post-title">{$title}</h4>
<div class="post-cta-inner">
<div class="cta-post-content clearfix">
<div class="post-cta-cont">
<div class="post-cta-img">{$image}</div>
{$cta_content}
<br clear="both">
<p class="post-cta-btn"><a class="button" href="{$button_url}">{$button_text}</a></p>
</div>
</div>
</div>
</div>
<!-- END OF CTA BLOCK -->
eof;
    echo $source_html;
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
add_filter('post_class', 'lamp_firstpost');
function lamp_firstpost($class)
{
    global $post, $posts;
    if (is_home() && !is_paged() && ($post == $posts[0]) ||
is_category() && !is_paged() && ($post == $posts[0]) ||
is_archive() && !is_paged() && ($post == $posts[0]) ||
is_tag() && !is_paged() && ($post == $posts[0])) {
        $class[] = 'firstpost';
    }
    return $class;
}
function is_lamp_firstpost()
{
    global $wp_query;
    return ($wp_query->current_post === 0);
}
function lamp_get_nav_menu_name()
{
    global $wpdb;
    $sql = "SELECT distinct(A.name) FROM (" . $wpdb->prefix . "terms A left join " . $xpdb->prefix . "term_relationships B on A.term_id = B.term_taxonomy_id) left join xeory_posts C ON B.object_id = C.ID WHERE post_type = 'nav_menu_item';";
    $results = $wpdb->get_results($sql);
    $menu_title = lamp_object2array($results);
    echo $menu_title[0]['name'];
}
function lamp_object2array($data)
{
    if (is_object($data)) {
        $data = (array)$data;
    }
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $key1 = (string)$key;
            $key2 = preg_replace('/\W/', ':', $key1);
            if (is_object($value) or is_array($value)) {
                $data[$key2] = lamp_object2array($value);
            } else {
                $data[$key2] = (string)$value;
            }
            if ($key1 != $key2) {
                unset($data[$key1]);
            }
        }
    }
    return $data;
}
function lamp_category_title()
{
    global $post;
    $t_id = get_category(intval(get_query_var('cat')))->term_id;
    $cat_class = get_category($t_id);
    $cat_option = get_option('cat_'.$t_id);
    if (isset($cat_option['lamp_meta_title']) && $cat_option['lamp_meta_title'] !== '') {
        $category_title = $cat_option['lamp_meta_title'];
    } else {
        $category_title = $cat_class->name;
    }
    echo esc_html($category_title);
}
function lamp_category_description()
{
    global $post;
    $t_id = get_category(intval(get_query_var('cat')))->term_id;
    $cat_class = get_category($t_id);
    $cat_option = get_option('cat_'.$t_id);
    if (is_array($cat_option)) {
        $cat_option = array_merge(array('cont'=>''), $cat_option);
    }
    if (isset($cat_option['lamp_meta_content'])) {
        $content = apply_filters('the_content', stripslashes($cat_option['lamp_meta_content']), 10);
        if (!empty($content)) {
            echo '<div class="cat-content-area">'.$content.'</div>';
        }
    }
}
function lamp_excerpt($length)
{
    global $post;
    $content = mb_substr(strip_tags($post->post_excerpt), 0, $length);
    if (!$content) {
        $content =  $post->post_content;
        $content =  strip_shortcodes($content);
        $content =  strip_tags($content);
        $content =  str_replace("&nbsp;", "", $content);
        $content =  html_entity_decode($content, ENT_QUOTES, "UTF-8");
        $content =  mb_substr($content, 0, $length);
    }
    return $content;
}
