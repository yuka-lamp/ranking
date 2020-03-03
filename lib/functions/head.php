<?php
function lamp_title()
{
    if (is_front_page() || is_home()) {
        $title = apply_filters('lamp_title', get_bloginfo('name'));
    } elseif (is_category()) {
        global $post;
        $t_id = get_category(intval(get_query_var('cat')))->term_id;
        $cat_class = get_category($t_id);
        $cat_option = get_option('cat_'.$t_id);
        if (isset($cat_option['lamp_meta_title']) && $cat_option['lamp_meta_title'] !== '') {
            $title = apply_filters('lamp_title', $cat_option['lamp_meta_title']).' | '.apply_filters('lamp_title', get_bloginfo('name'));
        } else {
            $title = apply_filters('lamp_title', $cat_class->name).' | '.apply_filters('lamp_title', get_bloginfo('name'));
        }
    } elseif (is_date()) {
        if (is_day()) {
            $title  = get_query_var('year').'年';
            $title.= get_query_var('monthnum').'月';
            $title.= get_query_var('day').'日';
            $title  = apply_filters('lamp_title', $title);
        } elseif (is_month()) {
            $title  = get_query_var('year').'年';
            $title.= get_query_var('monthnum').'月';
            $title  = apply_filters('lamp_title', $title);
        } elseif (is_year()) {
            $title  = get_query_var('year').'年';
            $title  = apply_filters('lamp_title', $title);
        }
    } elseif (is_tag()) {
        $title = apply_filters('lamp_title', single_tag_title('', false));
    } elseif (is_archive()) {
        $title = apply_filters('lamp_title', wp_title(''));
    } elseif (is_search()) {
        $title = '「'.get_search_query().'」の検索結果';
    } elseif (is_page()) {
        $title = apply_filters('lamp_title', get_the_title()).' | '.apply_filters('lamp_title', get_bloginfo('name'));
    } else {
        $title = apply_filters('lamp_title', get_the_title()).'｜チャットレディ求人ランキング';
    }
    echo $title;
}
function get_lamp_title()
{
    if (is_category()) {
        global $post;
        $t_id = get_category(intval(get_query_var('cat')))->term_id;
        $cat_class = get_category($t_id);
        $cat_option = get_option('cat_'.$t_id);
        if (isset($cat_option['lamp_meta_title']) && $cat_option['lamp_meta_title'] !== '') {
            $title = $cat_option['lamp_meta_title'];
        } else {
            $title = $cat_class->name;
        }
    } else {
        $title = get_the_title();
    }
    return $title;
}
if (!function_exists('lamp_header_meta')) {
    add_action('wp_head', 'lamp_header_meta', 1);
    function lamp_header_meta()
    {
        global $post;
        global $term_id;
        $keyword = '';
        $description = '';
        $title = '';
        $type = '';
        $url = '';
        $image = '';
        remove_filter('term_description', 'wpautop');
        if (is_front_page() || is_home()) {
            $title = get_bloginfo('title');
            $type  = 'website';
            $description = get_bloginfo('description');
            $url =  home_url() .'/';
            $logo_image = get_option('logo_image');
            $def_image = get_option('def_image');
            if (isset($def_image)) {
                $image = $def_image;
            } else {
                $image = $logo_image;
            }
            $keyword = get_option('meta_keywords');
        } elseif (is_category()) {
            $t_id = get_category(intval(get_query_var('cat')))->term_id;
            $cat_class = get_category($t_id);
            $cat_option = get_option('cat_'.$t_id);
            if (is_array($cat_option)) {
                $cat_option = array_merge(array('lamp_meta_title' => '','lamp_meta_keywords' => ''), $cat_option);
            }
            if (isset($cat_option['lamp_meta_title']) && $cat_option['lamp_meta_title'] !== '') {
                $title = $cat_option['lamp_meta_title'];
            } else {
                $title = $cat_class->name;
            }
            $type = 'article';
            $description = esc_attr(category_description()) ;
            $url = get_category_link($t_id);
            if (isset($cat_option['lamp_category_image']) && $cat_option['lamp_category_image'] !== '') {
                $image = $cat_option['lamp_category_image'];
            } else {
                $image = get_option('def_image');
            }
            $keyword = $cat_option['lamp_meta_keywords'];
        } elseif (is_tag()) {
            $t_id = get_queried_object_id();
            $title = single_tag_title('', false);
            $type = 'article';
            $description = esc_attr(tag_description());
            $url = get_tag_link($t_id);
            $image = '';
            $keyword = '';
        } elseif (is_search()) {
            $title.= '「'.get_search_query().'」の検索結果';
        } else {
            if (isset($post)) {
                $post_meta = get_post_meta($post->ID);
                $title = get_the_title();
                $type  = 'article';
                $description = get_post_meta($post->ID, 'lamp_meta_description', true) ? get_post_meta($post->ID, 'lamp_meta_description', true) : get_the_excerpt();
                $url = get_permalink();
                if (has_post_thumbnail($post->ID)) {
                    $pre_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), true);
                    if (is_array($pre_image));
                    $image = (empty($pre_image)) ? "" : reset($pre_image);
                } else {
                    $image = get_option('def_image');
                }
                $keyword = isset($post_meta['lamp_meta_keywords'][0]) ? $post_meta['lamp_meta_keywords'][0] : '';
            }
        }
        $canonical = null;
        if (is_home() || is_front_page()) {
            $canonical = home_url();
        } elseif (is_category()) {
            $canonical = get_category_link(get_query_var('cat'));
        } elseif (is_tag()) {
            $canonical = get_tag_link(get_queried_object()->term_id);
        } elseif (is_search()) {
            $canonical = get_search_link();
        } elseif (is_page() || is_single()) {
            $canonical = get_permalink();
        } else {
            $canonical = home_url();
        }
        $meta = '';
        $meta = '<meta name="keywords" content="'.$keyword.'">'."\n";
        $meta.= '<meta name="description" content="'.$description.'">'."\n";
        $meta.= '<link rel="canonical" href="'.$canonical.'">'."\n";
        $robots = "";
        $set = "";
        if (is_front_page() || is_home()) {
            $set.= '';
        } elseif (is_category()) {
            if ((isset($cat_option['lamp_meta_robots'][0]) && $cat_option['lamp_meta_robots'][0] == 'noindex') && (isset($cat_option['lamp_meta_robots'][1]) && $cat_option['lamp_meta_robots'][1] == 'nofollow')) {
                $robots = 'noindex,nofollow';
            } elseif ((isset($cat_option['lamp_meta_robots'][0]) && $cat_option['lamp_meta_robots'][0] == 'noindex') && (isset($cat_option['lamp_meta_robots'][1]) && $cat_option['lamp_meta_robots'][1] == null)) {
                $robots = 'noindex';
            } elseif ((isset($cat_option['lamp_meta_robots'][0]) && $cat_option['lamp_meta_robots'][0] == null) && (isset($cat_option['lamp_meta_robots'][1]) && $cat_option['lamp_meta_robots'][1] == 'nofollow')) {
                $robots = 'nofollow';
            } else {
                $robots = 'index';
            }
            if (get_option('blog_public')) {
                $set.= '<meta name="robots" content="'.$robots.'">'."\n";
            }
        } else {
            if (isset($post)) {
                $post_meta = get_post_meta($post->ID);
                (isset($post_meta['lamp_meta_robots'])) ? $lamp_meta_robots_arr = unserialize($post_meta['lamp_meta_robots'][0]): '';
                if (isset($lamp_meta_robots_arr) && in_array("noindex", $lamp_meta_robots_arr) && in_array("nofollow", $lamp_meta_robots_arr)) {
                    $robots = 'noindex,nofollow';
                } elseif (isset($lamp_meta_robots_arr) && in_array("noindex", $lamp_meta_robots_arr)) {
                    $robots = 'noindex';
                } elseif (isset($lamp_meta_robots_arr) && in_array("nofollow", $lamp_meta_robots_arr)) {
                    $robots = 'nofollow';
                } else {
                    $robots = 'index';
                }
                if (get_option('blog_public')) {
                    $set.= '<meta name="robots" content="'.$robots.'">'."\n";
                }
            }
        }
        if (is_paged()) {
            $meta.= '<meta name="robots" content="noindex,nofollow">'."\n";
        } else {
            $meta.= $set;
        }
        $facebook_user_id =  get_option('facebook_user_id');
        if ($facebook_user_id || $facebook_user_id !== '') {
            $meta.= '<meta property="fb:admins" content="'.esc_html($facebook_user_id).'">'."\n";
        }
        $facebook_app_id =  get_option('facebook_app_id');
        if ($facebook_app_id || $facebook_app_id !== '') {
            $meta.= '<meta property="fb:app_id" content="'.esc_html($facebook_app_id).'">'."\n";
        }
        $meta.= '<meta property="og:title" content="'.esc_html($title).'">'."\n";
        $meta.= '<meta property="og:type" content="'.esc_html($type).'">'."\n";
        $meta.= '<meta property="og:description" content="'.esc_textarea($description).'">'."\n";
        $meta.= '<meta property="og:url" content="'.esc_url($url).'">'."\n";
        $meta.= '<meta property="og:image" content="'.esc_url($image).'">'."\n";
        $meta.= '<meta property="og:locale" content="ja_JP">'."\n";
        $meta.= '<meta property="og:site_name" content="'.esc_html(get_bloginfo('name')).'">'."\n";
        $meta.= '<link href="https://plus.google.com/'.esc_html(get_option('google_publisher')).'" rel="publisher">'."\n";
        $twitter_id = get_option("twitter_id");
        if ($twitter_id || $twitter_id) {
            $meta.='<meta content="summary" name="twitter:card">'."\n";
            $meta.= '<meta content="'.esc_html($twitter_id).'" name="twitter:site">'."\n\n";
        }
        echo $meta;
    }
}
add_action('wp_head', 'lamp_post_javascript4head', 888);
function lamp_post_javascript4head()
{
    global $post;
    if (!is_object($post)) {
        return;
    }
    $lamp_post_asset_js4head = get_post_meta($post->ID, 'lamp_post_asset_js4head', true);
    if (isset($lamp_post_asset_js4head) && is_array($lamp_post_asset_js4head)) {
        $reset_js = $lamp_post_asset_js4head;
        $js = reset($reset_js);
    } else {
        $js = $lamp_post_asset_js4head;
    }
    if ($js && $js !=='') {
        echo $js;
    }
}
add_action('wp_head', 'lamp_post_style', 888);
function lamp_post_style()
{
    global $post;
    if (!is_object($post)) {
        return;
    }
    if (is_array(get_post_meta($post->ID, 'lamp_post_asset_css'))) {
        $reset_css = get_post_meta($post->ID, 'lamp_post_asset_css');
        $css = reset($reset_css);
    } else {
        $css = get_post_meta($post->ID, 'lamp_post_asset_css');
    }
    if ($css && $css !=='') {
        ?>
    <style type="text/css">
      <?php echo $css; ?>
    </style>
  <?php
    }
}
add_action('wp_footer', 'lamp_post_javascript', 999);
function lamp_post_javascript()
{
    global $post;
    if (!is_object($post)) {
        return;
    }
    $lamp_post_asset_js = get_post_meta($post->ID, 'lamp_post_asset_js4head', true);
    echo $lamp_post_asset_js;
    if (isset($lamp_post_asset_js) && is_array($lamp_post_asset_js)) {
        $reset_js = $lamp_post_asset_js;
        $js = reset($reset_js);
    } else {
        $js = $lamp_post_asset_js;
    }
    if ($js && $js !=='') {
        echo $js;
    } else {
        echo '';
    }
}