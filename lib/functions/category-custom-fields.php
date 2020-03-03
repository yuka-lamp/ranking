<?php
add_action ('edit_category_form_fields', 'lamp_category_fields');
function lamp_category_fields($tag) {
$t_id = $tag->term_id;
$cat_meta = get_option("cat_$t_id");

$metarobots_array = ( isset($cat_meta['lamp_meta_robots']) ) ? $cat_meta['lamp_meta_robots'] : "";
$lamp_category_image = ( !isset($cat_meta['lamp_category_image']) || $cat_meta['lamp_category_image'] == '' ) ? "" :  $cat_meta['lamp_category_image'];
?>
<tr class="form-field">
<th><label for="lamp_meta_title">カテゴリーページタイトル</label></th>
<td><input type="text" name="Cat_meta[lamp_meta_title]" id="lamp_meta_title" size="25" value="<?php if( isset ( $cat_meta['lamp_meta_title'])) echo esc_html($cat_meta['lamp_meta_title'] ) ?>"></td>
</tr>
<tr class="form-field">
<th><label for="lamp_meta_keywords">カテゴリーページ用メタキーワード</label></th>
<td><input type="text" name="Cat_meta[lamp_meta_keywords]" id="lamp_meta_keywords" size="25" value="<?php if( isset ( $cat_meta['lamp_meta_keywords'])) echo esc_html($cat_meta['lamp_meta_keywords'] ) ?>"></td>

<tr class="form-field">
<th><label for="lamp_meta_robots">メタロボット</label></th>
<td>
<small>全てのチェックを外すと"index"となります。</small>
<ul>
<li>
<input type="hidden" name="Cat_meta[lamp_meta_robots][0]" value="">
<input class="cmb_option" type="checkbox" name="Cat_meta[lamp_meta_robots][0]" id="lamp_meta_robots1" value="noindex"  <?php echo (isset($metarobots_array) && is_array($metarobots_array) && in_array('noindex', $metarobots_array)) ? 'checked' : '';?>> <label for="lamp_meta_robots1">noindex</label>
</li>
<li>
<input type="hidden" name="Cat_meta[lamp_meta_robots][1]" value="">
<input class="cmb_option" type="checkbox" name="Cat_meta[lamp_meta_robots][1]" id="lamp_meta_robots2" value="nofollow" <?php echo (isset($metarobots_array) && is_array($metarobots_array) && in_array('nofollow', $metarobots_array)) ? 'checked' : '';?> > <label for="lamp_meta_robots2">nofollow</label>
</li>
</ul>
</td>
</tr>
<tr class="form-field">
<th><label for="lamp_meta_content">本文</label></th>
<td>
<?php $lamp_meta_content = isset($cat_meta['lamp_meta_content']) ? $cat_meta['lamp_meta_content'] : ''; ?>
<textarea name="Cat_meta[lamp_meta_content]" id="lamp_eta_content" rows="10"><?php echo $lamp_meta_content; ?></textarea>
</td>
</tr>

<?php
}

add_action ( 'edited_term', 'lamp_save_extra_category_fileds');
function lamp_save_extra_category_fileds( $term_id ) {
if ( isset( $_POST['Cat_meta'] ) ) {
$t_id = preg_replace('/[\x00-\x1f\x7f]/', '', $term_id);
$cat_meta = get_option("cat_".$t_id);
$cat_keys = array_keys($_POST['Cat_meta']);

foreach ( $cat_keys as $key ){
if ( isset($_POST['Cat_meta'][$key]) ){
$cat_meta[$key] = $_POST['Cat_meta'][$key];
}
}
update_option( "cat_".$t_id, $cat_meta );
}
}