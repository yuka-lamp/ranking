<?php
add_action('init', 'lamp_cta_custom_post_type');
function lamp_cta_custom_post_type()
{
    $labels = array(
    'name'                => 'CTA',
    'singular_name'       => 'CTA',
    'add_new_item'        => '新しいCTAを追加',
    'add_new'             => '新規追加',
    'new_item'            => '新しいCTA',
    'view_item'           => 'CTAを表示',
    'not_found'           => 'CTAはありません',
    'not_found_in_trash'  => 'ゴミ箱にCTAはありません。',
    'search_items'        => 'CTAを検索',
  );
    $args = array(
    'labels'              => $labels,
    'public'              => true,
    'show_ui'             => true,
    'query_var'           => true,
    'hierarchical'        => false,
    'menu_position'       => 5,
    'has_archive'         => false,
    'supports'            => array(
      'title',
      'editor',
      'thumbnail',
      'page-attributes'
      )
  );
    register_post_type('cta', $args);
    flush_rewrite_rules(false);
}
add_action('init', 'lamp_lp_custom_post_type');
function lamp_lp_custom_post_type()
{
    $labels = array(
    'name'                => 'チャットレディ',
    'singular_name'       => 'チャットレディ',
    'add_new_item'        => '新しいチャットレディを追加',
    'add_new'             => '新規追加',
    'new_item'            => '新しいチャットレディ',
    'view_item'           => 'チャットレディを表示',
    'not_found'           => 'チャットレディはありません',
    'not_found_in_trash'  => 'ゴミ箱にチャットレディはありません。',
    'search_items'        => 'チャットレディを検索',
  );
    $args = array(
    'labels'              => $labels,
    'public'              => true,
    'show_ui'             => true,
    'query_var'           => true,
    'hierarchical'        => false,
    'menu_position'       => 5,
    'has_archive'         => false,
    'capability_type'     => 'page',
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'page-attributes'
      )
  );
    register_post_type('lp', $args);
    flush_rewrite_rules(false);
}
