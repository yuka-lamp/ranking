<?php
class lamp_Admin_start
{
    protected static $key = 'lamp_option_start';
    protected static $theme_options = array();
    protected $title = '';
    public function __construct()
    {
        $this->title = 'マニュアル';
    }
    public function hooks()
    {
        add_action('admin_init', array( $this, 'mninit'));
        add_action('admin_menu', array( $this, 'add_page'));
    }
    public function mninit()
    {
        register_setting(self::$key, self::$key);
    }
    public function add_page()
    {
        $my = add_menu_page($this->title, $this->title, 'manage_options', self::$key, array($this, 'admin_page_display'), '', 0);
    }
    public function admin_head()
    {
    }
    public function admin_page_display()
    {
        ?>
<div class="wrap">
<div class="postbox">
<h3 class="hndle">テーマの設定方法</h3>
<div class="inside">
<p>ダッシュボードの項目に「テンプレート設定」という項目がございます。</p>
<p>そちらから、「ロゴ」「メインカラー」「SNS」「Googleアナリティクス」などの設定を行って下さい。</p>
</div>
</div>
<div class="postbox">
<h3 class="hndle">メニューの設定方法</h3>
<div class="inside">
<p>ダッシュボードの項目「外観」→「メニュー」から新規作成でメニュー作成して下さい。</p>
<p>作成が出来ましたら、「メニューの位置」の項目で「グローバルナビ」を選択しますとヘッダーとスマホメニューに、「プライマーナビ」を選択しますとフッターとスマホメニューで表示されます。</p>
</div>
</div>
<div class="postbox">
<h3 class="hndle">インストール推奨のプラグイン</h3>
<div class="inside">
<table class="form-table cmb_metabox">
<tr>
<td>
<h4>Google XML Sitemaps</h4>
<p>XMLサイトマップを自動生成を可能にするプラグインです。</p>
<p>サイトの更新を正しくGoogleに伝えるために必ずインストールしておきましょう。</p>
</td>
<td>
<h4>PS Auto Sitemap</h4>
<p>XMLサイトマップではなく、ユーザーに提供するhtmlサイトマップの自動生成プラグイン。</p>
<p>Googleガイドラインでは、ユーザーに向けたサイトマップの設置を推奨としていますのでインストールしておきましょう。</p>
</td>
</tr>
<tr>
<td>
<h4>Broken Link Checker</h4>
<p>記事や固定ページで記述した外部リンクがリンク可能かどうかをチェックするプラグインです。</p>
<p>リンク切れを起こしたリンクはSEOを下げてしまう可能性があります。</p>
</td>
<td>
<h4>TinyMCE Advanced</h4>
<p>記事や固定ページを編集する際に使用するビジュアルエディタの機能を大幅にグレードアップ。</p>
<p>機能のカスタマイズも可能ですので是非インストールしておきましょう。</p>
</td>
</tr>
</table>
</div>
</div>
</div>
<?php
    }
}
$lamp_Admin_start = new lamp_Admin_start();
$lamp_Admin_start->hooks();
function lamp_get_option_start($key = '')
{
    return cmb_get_option(lamp_Admin_start::key(), $key);
}
