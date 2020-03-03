jQuery(document).ready(function(H) {
  var G = ".post-php.post-type-post #titlediv,.post-new-php.post-type-post #titlediv";
  var K = ".post-php.post-type-post #titlewrap,.post-new-php.post-type-post #titlewrap";
  var I = ".post-php.post-type-post #edit-slug-box,.post-new-php.post-type-post #edit-slug-box";
  H(G).addClass("postbox");
  H(G).prepend('<h3 class="hndle">記事タイトル</h3>');
  H(K).after('<p class="inside"><span class="count_title count_wrap"></span><strong>文字</strong> ※全角28文字前後推奨</p>');
  H(I).after('<p class="inside" id="permalink_desc"><small>※記事のパーマリンク（URL）を設定します。半角英数字のみで。区切る場合は「-」を使いましょう。</small></p>');
  H(".misc-pub-section #timestamp").after(" or 予約投稿");
  var B = ".post-php.post-type-page #titlediv,.post-new-php.post-type-page #titlediv";
  var J = ".post-php.post-type-page #titlewrap,.post-new-php.post-type-page #titlewrap";
  var L = ".post-php.post-type-page #edit-slug-box,.post-new-php.post-type-page #edit-slug-box";
  H(B).addClass("postbox");
  H(B).prepend('<h3 class="hndle">固定ページタイトル</h3>');
  H(J).before('<p class="inside"><small>タイトルを入力して下さい。</small></p>');
  H(J).after('<p class="inside"><span class="count_title count_wrap"></span><strong>文字</strong> ※全角28文字以内推奨</p>');
  H(L).after('<p class="inside"><small>※記事のパーマリンク（URL）を設定します。分かりやすく簡潔なURLを設定しましょう。</small></p>');
  var z = ".post-php.post-type-lp #titlediv,.post-new-php.post-type-lp #titlediv";
  var N = ".post-php.post-type-lp #titlewrap,.post-new-php.post-type-lp #titlewrap";
  var v = ".post-php.post-type-lp #edit-slug-box,.post-new-php.post-type-lp #edit-slug-box";
  H(z).addClass("postbox");
  H(z).prepend('<h3 class="hndle">LPタイトル（キャッチコピー）</h3>');
  H(N).before('<p class="inside"><small>LPのタイトルを入力して下さい。ここに入力した内容がLPのキャッチコピーとして表示されます。</small></p>');
  H(v).after('<p class="inside"><small>※記事のパーマリンク（URL）を設定します。分かりやすく簡潔なURLを設定しましょう。</small></p>');
  var y = ".post-php.post-type-cta #titlediv,.post-new-php.post-type-cta #titlediv";
  var D = ".post-php.post-type-cta #titlewrap,.post-new-php.post-type-cta #titlewrap";
  var E = ".post-php.post-type-cta #edit-slug-box,.post-new-php.post-type-cta #edit-slug-box";
  H(y).addClass("postbox");
  H(y).prepend('<h3 class="hndle">CTAタイトル（キャッチコピー）</h3>');
  H(D).before('<p class="inside"><small>CTAのタイトルを入力して下さい。ここに入力された内容がCTAのキャッチコピーとして表示されます。</small></p>');
  H(E).remove();
  H("#title").bind("keydown keyup keypress change", function() {
    var a = H(this).val().length;
    H(".count_title").html(a)
  });
  H("#lamp_meta_description").bind("keydown keyup keypress change", function() {
    var a = H(this).val().length;
    H(".count_description").html(a)
  });
  var u = ".post-php.post-type-post ,.post-new-php.post-type-post";
  H(u).find("#postdivrich").after(H("#lamp_meta_tags"));
  H(u).find("#postdivrich").after(H("#postimagediv"));
  var A = ".post-php.post-type-page ,.post-new-php.post-type-page";
  H(A).find("#postdivrich").after(H("#lamp_meta_tags_page"));
  H(A).find("#postdivrich").after(H("#postimagediv"));
  var M = ".post-php.post-type-lp ,.post-new-php.post-type-lp";
  H(M).find("#postdivrich").before('<div id="editor-before" class="postbox"><h3 class="hndle">LPとは</h3><div class="inside"><small>「様々なネット広告やリンクをクリックした際に表示される、サイトを含むＷＥＢページ全般」を指す言葉で、LP、ランペ、などとも呼ばれています。</small></div></div>');
  H(M).find("#postimagediv").find("#set-post-thumbnail").before('<div class="inside"><small>ランディングページのメイン画像を設定しましょう。『画像をアップロード』ボタンを押して、画像を選んで下さい。<br></small></div>');
  H(M).find("#postdivrich").after(H("#postimagediv"));
  var x = ".post-php.post-type-cta,.post-new-php.post-type-cta";
  H(x).find("#postdivrich").before('<div id="editor-before" class="postbox"><h3 class="hndle">CTAとは</h3><div class="inside"><small>CTAとは、Call To Action(コール トゥ アクション)の略で、「行動喚起」と訳される。 Webサイトの訪問者を具体的な行動に誘導すること。</small></div></div>');
  H(x).find("#postimagediv").find("#set-post-thumbnail").before('<div class="hndle"><small>CTAのメイン画像を設定しましょう。『画像をアップロード』ボタンを押して、画像を選んで下さい。</div>');
  H(x).find("#postdivrich").after(H("#postimagediv"));
  H(".cmb_id_lamp_post_layout li").each(function(a) {
    H(this).attr("id", "layout-" + (a + 1))
  });
  var C = H(".cmb_id_lamp_post_layout");
  H("input", C).css({
    opacity: "0"
  }).each(function() {
    if (H(this).attr("checked") == "checked") {
      H(this).next().addClass("checked")
    }
  });
  H("label", C).click(function() {
    H(this).parent().parent().each(function() {
      H("label", this).removeClass("checked")
    });
    H(this).addClass("checked")
  });
  H(".cmb_id_post_layout li").each(function(a) {
    H(this).attr("id", "layout-" + (a + 1))
  });
  var w = H(".cmb_id_post_layout");
  H("input", w).css({
    opacity: "0"
  }).each(function() {
    if (H(this).attr("checked") == "checked") {
      H(this).next().addClass("checked")
    }
  });
  H("label", w).click(function() {
    H(this).parent().parent().each(function() {
      H("label", this).removeClass("checked")
    });
    H(this).addClass("checked")
  });
  if (H("#lamp_cta2:checked").val()) {
    H(".cmb_id_lamp_cta_select").css("display", "block");
    H(".cmb_id_lamp_cta_org_title").css("display", "none");
    H(".cmb_id_lamp_cta_org_image").css("display", "none");
    H(".cmb_id_lamp_cta_org_content").css("display", "none");
    H(".cmb_id_lamp_cta_org_button_text").css("display", "none");
    H(".cmb_id_lamp_cta_org_button_url").css("display", "none")
  } else {
    if (H("#lamp_cta3:checked").val()) {
      H(".cmb_id_lamp_cta_select").css("display", "none")
    } else {
      H(".cmb_id_lamp_cta_select").css("display", "none");
      H(".cmb_id_lamp_cta_org_title").css("display", "none");
      H(".cmb_id_lamp_cta_org_image").css("display", "none");
      H(".cmb_id_lamp_cta_org_content").css("display", "none");
      H(".cmb_id_lamp_cta_org_button_text").css("display", "none");
      H(".cmb_id_lamp_cta_org_button_url").css("display", "none");
      H("#lamp_cta1").attr("checked", "cheked")
    }
  }
  H("#lamp_cta1").click(function() {
    H("[name='lamp_cta']").removeAttr("checked");
    H(".cmb_id_lamp_cta_select").hide("fast");
    H(".cmb_id_lamp_cta_org_title").hide("fast");
    H(".cmb_id_lamp_cta_org_image").hide("fast");
    H(".cmb_id_lamp_cta_org_content").hide("fast");
    H(".cmb_id_lamp_cta_org_button_text").hide("fast");
    H(".cmb_id_lamp_cta_org_button_url").hide("fast");
    H(this).attr("checked", true)
  });
  H("#lamp_cta2").click(function() {
    H("[name='lamp_cta']").removeAttr("checked");
    H(".cmb_id_lamp_cta_select").show("fast");
    H(".cmb_id_lamp_cta_org_title").hide("fast");
    H(".cmb_id_lamp_cta_org_image").hide("fast");
    H(".cmb_id_lamp_cta_org_content").hide("fast");
    H(".cmb_id_lamp_cta_org_button_text").hide("fast");
    H(".cmb_id_lamp_cta_org_button_url").hide("fast");
    H(this).attr("checked", true)
  });
  H("#lamp_cta3").click(function() {
    H("[name='lamp_cta']").removeAttr("checked");
    H(".cmb_id_lamp_cta_select").hide("fast");
    H(".cmb_id_lamp_cta_org_title").show("fast");
    H(".cmb_id_lamp_cta_org_image").show("fast");
    H(".cmb_id_lamp_cta_org_content").show("fast");
    H(".cmb_id_lamp_cta_org_button_text").show("fast");
    H(".cmb_id_lamp_cta_org_button_url").show("fast");
    H(this).attr("checked", true)
  });
  if (H("#use_contents_intro:checked").val()) {
    H("#contents_intros").show("fast")
  }
  H("#use_contents_intro").click(function() {
    if (H(this).attr("checked") == "checked") {
      H("#contents_intros").show("fast")
    } else {
      H("#contents_intros").hide("fast")
    }
  });
  var F = H(".taxonomy-category");
  H("label[for=name]", F).text("カテゴリー名");
  H("label[for=slug]", F).text("パーマリンク");
  H("label[for=parent]", F).text("親カテゴリー");
  H("label[for=description]", F).text("ディスクリプション");
  if (H("#post_type").val() == "page") {
    if (H("#page_template").val() == "default") {
      H("#lp_form-hide").removeAttr("checked");
      H("#lp_form").hide("fast");
      H("#postcustom-hide").removeAttr("checked");
      H("#postcustom").hide("fast")
    } else {
      H("#lp_form-hide").attr("checked");
      H("#lp_form").show("fast");
      H("#meta_metabox-hide").removeAttr("checked");
      H("#meta_metabox").hide("fast");
      H("#cta_metabox-hide").removeAttr("checked");
      H("#cta_metabox").hide("fast");
      H("#lamp_post_asset-hide").removeAttr("checked");
      H("#lamp_post_asset").hide("fast")
    }
  } else {
    if (H("#post_type").val() == "post") {
      H("#lamp_post_asset-hide").removeAttr("checked");
      H("#lamp_post_asset").hide("fast");
      H("#commentsdiv-hide").removeAttr("checked");
      H("#commentsdiv").hide("fast");
      H("#postcustom-hide").removeAttr("checked");
      H("#postcustom").hide("fast")
    } else {}
  }
  H("[id=page_template]").change(function() {
    if (H("#page_template").val() == "default") {
      H("#lp_form-hide").removeAttr("checked");
      H("#lp_form").hide("fast");
      H("#meta_metabox-hide").attr("checked");
      H("#meta_metabox").show("fast");
      H("#cta_metabox-hide").attr("checked");
      H("#cta_metabox").show("fast")
    } else {
      H("#lp_form-hide").attr("checked");
      H("#lp_form").show("fast");
      H("#meta_metabox-hide").removeAttr("checked");
      H("#meta_metabox").hide("fast");
      H("#cta_metabox-hide").removeAttr("checked");
      H("#cta_metabox").hide("fast")
    }
  })
});