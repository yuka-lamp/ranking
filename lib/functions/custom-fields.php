<?php
add_action('save_post', 'lamp_my_box_save');
function lamp_my_box_save($post_id)
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    (isset($_POST['lamp_meta_keywords'])) ? update_post_meta($post->ID, 'lamp_meta_keywords', $_POST['lamp_meta_keywords']) : "";
    (isset($_POST['lamp_meta_description'])) ? update_post_meta($post->ID, 'lamp_meta_description', str_replace(array("\r\n","\r","\n"), '', $_POST['lamp_meta_description'])) : "";
    (isset($_POST['lamp_meta_robots'])) ? update_post_meta($post->ID, 'lamp_meta_robots', $_POST['lamp_meta_robots']) : "";
    (isset($_POST['lamp_post_asset_js4head'])) ? update_post_meta($post->ID, 'lamp_post_asset_js4head', $_POST['lamp_post_asset_js4head']) : "";
    (isset($_POST['lamp_post_asset_css'])) ? update_post_meta($post->ID, 'lamp_post_asset_css', $_POST['lamp_post_asset_css']) : "";
    (isset($_POST['lamp_post_asset_js'])) ? update_post_meta($post->ID, 'lamp_post_asset_js', $_POST['lamp_post_asset_js']) : "";
    (isset($_POST['lamp_cta'])) ? update_post_meta($post->ID, 'lamp_cta', $_POST['lamp_cta']) : "";
    (isset($_POST['lamp_checklists'])) ? update_post_meta($post->ID, 'lamp_checklists', $_POST['lamp_checklists']) : "";
    (isset($_POST['frm'])) ? update_post_meta($post->ID, 'frm', $_POST['frm']) : "";
    (isset($_POST['lamp_include_rss'])) ? update_post_meta($post->ID, 'lamp_include_rss', $_POST['lamp_include_rss']) : "";
    (isset($_POST['lamp_cta_select_button'])) ? update_post_meta($post->ID, 'lamp_cta_select_button', $_POST['lamp_cta_select_button']) : "";
    (isset($_POST['lamp_cta_select_button_url'])) ? update_post_meta($post->ID, 'lamp_cta_select_button_url', $_POST['lamp_cta_select_button_url']) : "";
    (isset($_POST['lamp_cta_select_button_cvtag'])) ? update_post_meta($post->ID, 'lamp_cta_select_button_cvtag', $_POST['lamp_cta_select_button_cvtag']) : "";
}

add_action('add_meta_boxes', 'add_lamp_meta_tags');
function add_lamp_meta_tags()
{
    add_meta_box('lamp_meta_tags', 'メタタグの設定', 'lamp_meta_tags', 'post', 'normal', 'high');
    add_meta_box('lamp_meta_tags', 'メタタグの設定', 'lamp_meta_tags', 'lp', 'normal', 'high');
}
function lamp_meta_tags()
{
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
    $metarobots_array = array();
    $metarobots_array = get_post_meta($post->ID, 'lamp_meta_robots', true); ?>
<h4>メタディスクリプション</h4>
<textarea name="lamp_meta_description" id="lamp_meta_description" cols="60" rows="4"><?php echo get_post_meta($post->ID, 'lamp_meta_description', true); ?></textarea><br>
<span class="count_description"></span>文字 <small>※全角80文字以内推奨</small>
<h4>メタキーワード</h4>
<input type="text" class="regular-text" name="lamp_meta_keywords" id="lamp_meta_keywords" value="<?php echo get_post_meta($post->ID, 'lamp_meta_keywords', true); ?>">
<h4>メタロボット</h4>
<ul>
<li>
<input type="hidden" name="lamp_meta_robots[]" value="">
<label for="lamp_meta_robots1"><input class="cmb_option" type="checkbox" name="lamp_meta_robots[]" id="lamp_meta_robots1" value="noindex"  <?php echo (is_array($metarobots_array) && in_array('noindex', $metarobots_array)) ? 'checked' : ''; ?>> noindex</label>
</li>
<li>
<input type="hidden" name="lamp_meta_robots[]" value="">
<label for="lamp_meta_robots2"><input class="cmb_option" type="checkbox" name="lamp_meta_robots[]" id="lamp_meta_robots2" value="nofollow" <?php echo (is_array($metarobots_array) && in_array('nofollow', $metarobots_array)) ? 'checked' : ''; ?> > nofollow</label>
</li>
</ul>
<?php
}

add_action('add_meta_boxes', 'add_lamp_meta_tags_page');
function add_lamp_meta_tags_page()
{
    add_meta_box('lamp_meta_tags_page', 'メタタグの設定', 'lamp_meta_tags_page', 'page', 'normal', 'high');
}
function lamp_meta_tags_page()
{
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
    $metarobots_array = array();
    $metarobots_array = get_post_meta($post->ID, 'lamp_meta_robots', true); ?>
<h4>メタディスクリプション</h4>
<p>
<small>この記事の要約を書きます。本文を書いた後に入力しても構いません。</small>
</p>
<textarea name="lamp_meta_description" id="lamp_meta_description" cols="60" rows="4"><?php echo get_post_meta($post->ID, 'lamp_meta_description', true); ?></textarea><br>
<span class="count_description"></span>文字 <small>※全角80文字以内推奨</small>
<h4>メタキーワード</h4>
<p>
<small>この記事で対策するキーワードを入力します。</small>
</p>
<input type="text" class="regular-text" name="lamp_meta_keywords" id="lamp_meta_keywords" value="<?php echo get_post_meta($post->ID, 'lamp_meta_keywords', true); ?>">
<h4>メタロボット</h4>
<small>ページのnoindexやnofollowの設定を行います。</small>
<ul>
<li>
<input type="hidden" name="lamp_meta_robots[]" value="">
<label for="lamp_meta_robots1"><input class="cmb_option" type="checkbox" name="lamp_meta_robots[]" id="lamp_meta_robots1" value="noindex"  <?php echo (is_array($metarobots_array) && in_array('noindex', $metarobots_array)) ? 'checked' : ''; ?>> noindex</label>
</li>
<li>
<input type="hidden" name="lamp_meta_robots[]" value="">
<label for="lamp_meta_robots2"><input class="cmb_option" type="checkbox" name="lamp_meta_robots[]" id="lamp_meta_robots2" value="nofollow" <?php echo (is_array($metarobots_array) && in_array('nofollow', $metarobots_array)) ? 'checked' : ''; ?> > nofollow</label>
</li>
</ul>
<?php
}

add_action('add_meta_boxes', 'add_lamp_post_asset');
function add_lamp_post_asset()
{
    add_meta_box('lamp_post_asset', 'ページ固有のJavascript/CSS', 'lamp_post_asset', 'post', 'normal', 'low');
    add_meta_box('lamp_post_asset', 'ページ固有のJavascript/CSS', 'lamp_post_asset', 'page', 'normal', 'low');
}
function lamp_post_asset()
{
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce'); ?>
<h4>JavaScript</h4>
<p><small>&lt;/head>タグ直前に書かれます。</small></p>
<pre><textarea name="lamp_post_asset_js4head" id="lamp_post_asset_js4head" cols="100" rows="10" class="cmb_textarea_code"><?php echo get_post_meta($post->ID, 'lamp_post_asset_js4head', true); ?></textarea></pre>
<h4>CSS</h4>
<p><small>&lt;/head>タグ直前に書かれます。</small></p>
<pre><textarea name="lamp_post_asset_css" id="lamp_post_asset_css" cols="100" rows="10" class="cmb_textarea_code"><?php echo get_post_meta($post->ID, 'lamp_post_asset_css', true); ?></textarea></pre>
<h4>JavaScript</h4>
<p><small>&lt;/body>タグ直前に書かれます。</small></p>
<pre><textarea name="lamp_post_asset_js" id="lamp_post_asset_js" cols="100" rows="10" class="cmb_textarea_code"><?php echo get_post_meta($post->ID, 'lamp_post_asset_js', true); ?></textarea></pre>
<?php
}

add_action('add_meta_boxes', 'add_lamp_cta_button');
function add_lamp_cta_button()
{
    add_meta_box('lamp_cta_button', 'CTAで使用するボタンの設定', 'lamp_cta_button', 'cta', 'normal', 'low');
}
function lamp_cta_button()
{
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
    $lamp_cta = get_post_meta($post->ID, 'lamp_cta', true);
    $check_cta = "";
    $select_button = "";
    $select_button_url = "";
    if (is_array($lamp_cta)) {
        extract($lamp_cta);
    } ?>
<h4>ボタンに表示されるテキスト</h4>
<input type="text" name="lamp_cta[select_button]" id="lamp_cta_select_button" value="<?php echo esc_html($select_button); ?>">
<h4>ボタンをクリックしたときのリンク先URL</h4>
<input type="text" name="lamp_cta[select_button_url]" id="lamp_cta_select_button_url" value="<?php echo esc_url($select_button_url); ?>">
<?php
}

add_action('add_meta_boxes', 'add_lamp_cta');
function add_lamp_cta()
{
    add_meta_box('ctameta_box', 'CTA設定', 'lamp_post_cta', 'post', 'normal', 'low');
}
function lamp_post_cta()
{
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce_cta');
    $saved_lamp_cta = "";
    $saved_lamp_cta = get_post_meta($post->ID, 'lamp_cta', true); ?>
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
<?php
    $lamp_cta = get_post_meta($post->ID, 'lamp_cta', true);
    $check_cta = "";
    $cta_select = "";
    $org_title = "";
    $org_image = "";
    $org_content = "";
    $org_button_text = "";
    $org_button_url = "";
    if (is_array($lamp_cta)) {
        extract($lamp_cta);
    } ?>
<table class="form-table cmb_metabox">
<tr>
<td>
<small>記事直下に表示するCTAを選択して下さい。</small>
<ul>
<li class="cmb_option"><input type="radio" name="lamp_cta[check_cta]" id="lamp_cta1" value="none" <?php checked($check_cta, "none"); ?>>
<label for="lamp_cta1">表示しない</label>
</li>
<li class="cmb_option"><input type="radio" name="lamp_cta[check_cta]" id="lamp_cta2" value="custompost" <?php checked($check_cta, "custompost"); ?>>
<label for="lamp_cta2">既に作成してあるCTAの中から選ぶ</label>
</li>
<li class="cmb_option">
<input type="radio" name="lamp_cta[check_cta]" id="lamp_cta3" value="pageorg" <?php checked($check_cta, "pageorg"); ?>>
<label for="lamp_cta3">このページ独自のCTAを作る</label>
</li>
</ul>
<p class="cmb_metabox_description"></p>
</td>
</tr>
<tr class="cmb-type-cta_select cmb_id_lamp_cta_select">
<td>
<h4>既に作成してあるCTAの中から選ぶ</h4>
<p><small>管理画面メニュー「CTA」で作成した物を下記より選んで下さい。</small></p>
<?php lamp_cmb_render_cta_select('lamp_cta[cta_select]', $cta_select); ?><br><br>
</td>
</tr>
<tr class="cmb-type-cta_select cmb_id_lamp_cta_org_title">
<td>
<h4>ページ独自のCTAタイトル</h4>
<input type="text" class="regular-text" name="lamp_cta[org_title]" id="lamp_cta_org_title" value="<?php echo esc_html($org_title); ?>">
</td>
</tr>
<tr class="cmb-type-cta_select cmb_id_lamp_cta_org_image">
<td>
<h4>画像</h4>
<input type="text" id="lamp_cta_org_image" name="lamp_cta[org_image]" class="regular-text" value="<?php echo esc_url($org_image); ?>">
<a class="media-upload" href="JavaScript:void(0);" rel="lamp_cta_org_image">
<input class="cmb_upload_button button" type="button" value="画像をアップロードする">
</a>
</td>
</tr>
<tr class="cmb-type-cta_select cmb_id_lamp_cta_org_content">
<td>
<h4>ページ独自のCTAコンテンツ</h4>
<?php wp_editor($org_content, 'lamp_cta_org_content', array('media_buttons'=>true, 'textarea_name'=>'lamp_cta[org_content]','textarea_rows'=>10,'tiny_mce'=>true, 'tinymce_adv' => array( 'width' => '600'))); ?>
</td>
</tr>
<tr class="cmb-type-cta_select cmb_id_lamp_cta_org_button_text">
<td>
<h4>ボタンに表示されるテキスト</h4>
<input type="text" class="regular-text" name="lamp_cta[org_button_text]" id="lamp_cta_org_button_text" value="<?php echo esc_html($org_button_text); ?>">
</td>
</tr>
<tr class="cmb-type-cta_select cmb_id_lamp_cta_org_button_url">
<td>
<h4>ボタンをクリックしたときのリンク先URL</h4>
<input type="text" class="regular-text" name="lamp_cta[org_button_url]" id="lamp_cta_org_button_url" value="<?php echo esc_url($org_button_url); ?>">
</td>
</tr>
</table>
<?php
}

add_filter('lamp_cmb_render_cta_select', 'lamp_cmb_render_cta_select', 10, 2);
function lamp_cmb_render_cta_select($field, $meta)
{
    $args = array(
      'post_type' => 'cta',
      'showposts' => -1
    );
    $the_query = new WP_Query($args);
    $cta_loop = '<select name="'.$field.'">';
    foreach ($the_query->posts as $cta) {
        $selected = selected($cta->ID, $meta, false);
        $cta_loop .= '<option value="'.$cta->ID.'"'.$selected.'>'.esc_html($cta->post_title).'</option>';
    }
    $cta_loop .= '</select>';
    wp_reset_postdata();
    echo $cta_loop;
}

add_filter('cmb_show_on', 'lamp_metabox_show_on_template', 10, 2);
function lamp_metabox_show_on_template($display, $meta_box)
{
    if ('template' !== $meta_box['show_on']['key']) {
        return $display;
    }
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
    } elseif (isset($_POST['post_ID'])) {
        $post_id = $_POST['post_ID'];
    }
    if (!isset($post_id)) {
        return false;
    }
    $template_name = get_page_template_slug($post_id);
    $template_name = substr($template_name, 0, -4);
    $meta_box['show_on']['value'] = !is_array($meta_box['show_on']['value']) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];
    if ($template_name == '') {
        return true;
    } else {
        return in_array($template_name, $meta_box['show_on']['value']);
    }
}

add_action('add_meta_boxes', 'add_lamp_checklists');
function add_lamp_checklists()
{
    add_meta_box('lamp_checklists', '記事チェックポイント', 'lamp_checklists', 'post', 'side', 'low');
}

function lamp_checklists()
{
    global $post;
    $checklists = array();
    $checklists = get_post_meta($post->ID, 'lamp_checklists', true); ?>

<input type="hidden" name="lamp_checklists[]" value="">
<table class="form-table cmb_metabox">
<tr class="cmb-type-multicheck cmb_id_lamp_checklists">
<label style="display:none;" for="lamp_checklists">チェックリスト</label>
<td>
<ul>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists1" value="check01" <?php echo (is_array($checklists) && in_array("check01", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists1">文字数は守れていますか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists2" value="check02" <?php echo (is_array($checklists) && in_array("check02", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists2">誤字脱字のチェックはしましたか？（プレビュー画面で最終確認すること）</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists3" value="check03" <?php echo (is_array($checklists) && in_array("check03", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists3">見出しの使い方は正しいですか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists4" value="check04" <?php echo (is_array($checklists) && in_array("check04", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists4">見出しに訴求は含まれていますか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists5" value="check05" <?php echo (is_array($checklists) && in_array("check05", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists5">メインキーワードは文字数に対して10%以上含まれていますか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists6" value="check06" <?php echo (is_array($checklists) && in_array("check06", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists6">サブキーワードは文字数に対して7%以上含まれていますか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists7" value="check07" <?php echo (is_array($checklists) && in_array("check07", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists7">文末に同じ言葉が続いていませんか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists8" value="check08" <?php echo (is_array($checklists) && in_array("check08", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists8">メタディスクリプションは書き終わりましたか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists9" value="check09" <?php echo (is_array($checklists) && in_array("check09", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists9">画像の引用があった場合、「出典は」明記していますか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists10" value="check10" <?php echo (is_array($checklists) && in_array("check10", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists10">文章の引用があった場合、「引用」は明記していますか？</label>
</li>
<li><input class="cmb_option" type="checkbox" name="lamp_checklists[]" id="lamp_checklists11" value="check11" <?php echo (is_array($checklists) && in_array("check11", $checklists))? "checked='checked'":""; ?>>
<label for="lamp_checklists11">この記事は面白いですか？</label>
</li>
</ul>
<span class="cmb_metabox_description"></span>
</td>
</tr>
</table>
<?php
}