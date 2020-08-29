<?php function mytheme_setup() {

    // （Ｃ）のCSSを有効化
    add_theme_support('wp-block-styles');

    // 縦横比を維持したレスポンシブを有効化
    add_theme_support('responsive-embeds');

    // （Ｅ）のCSSを有効化＆エディタに読み込み
    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');

    //ページのタイトルを有効化
    add_theme_support('title-tag');

    //link,style,script有効化
    add_theme_support('html5', array('style',
            'script'
        ));

    //アイキャッチ
    add_theme_support('post-thumbnails');

    //全幅
    add_theme_support('align-wide');

    //メニューのロケーションを登録
    register_nav_menus(array ('primary'=> 'ナビゲーション'
        ));

}

add_action('after_setup_theme', 'mytheme_setup');




function mytheme_enqueue() {

    //Dashicons読み込み
    wp_enqueue_style('dashicons'
    );

    // （Ｄ）テーマのCSSを読み込み
    wp_enqueue_style('mytheme-style',
        get_stylesheet_uri(),
        array(),
        filemtime(get_theme_file_path('style.css')));

    //icomoon読み込み
    wp_enqueue_style('icon-style', get_stylesheet_directory_uri() . '/icomoon/style.css');

}

add_action('wp_enqueue_scripts', 'mytheme_enqueue');



function mytheme_widgets() {

    //ウィジェット
    register_sidebar(array('id'=> 'sidebar-1',
            'name'=> 'フッターメニュー',
            'before_widget'=> '<section id="%1$s" class="widget %2$s">',
            'after_widget'=> '</section>'
        ));
}

add_action('widgets_init', 'mytheme_widgets');


// Search

/*【出力カスタマイズ】検索結果のタイトルをカスタマイズ */
function wp_search_title($search_title) {
    if(is_search()) {
        $search_title='「'.get_search_query().'」の検索結果';
    }

    return $search_title;
}

add_filter('wp_title', 'wp_search_title');


/*【出力カスタマイズ】検索対象をカスタム投稿タイプで絞り込む */
function my_pre_get_posts($query) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('post', 'page', 'blog'));
    }
}

add_action('pre_get_posts', 'my_pre_get_posts');


//スマートフォン表示

function is_mobile() {
    $useragents=array('iPhone', // iPhone
        'iPod', // iPod touch
        '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate' // Other iPhone browser
    );
    $pattern='/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


// IE11対応
function mytheme_ie() {
    global $is_IE;

    if ($is_IE) {

        // css-var-polyfill.jsを読み込み
        wp_enqueue_script('mytheme-css-var-polyfill',
            get_theme_file_uri('ie/css-var-polyfill.js'),
            array(),
            null,
            true);

        // ofi.min.jsを読み込み
        wp_enqueue_script('mytheme-ofi',
            get_theme_file_uri('ie/ofi.min.js'),
            array(),
            null,
            true);

        wp_add_inline_script('mytheme-ofi',
            'jQuery(function($){ objectFitImages() });'
        );

        wp_add_inline_style('mytheme-style',
            'img {font-family: "object-fit: cover";}'
        );

        // mainに対応
        wp_add_inline_style('mytheme-style',
            'main {display: block;}'
        );

    }
}

add_action('wp_enqueue_scripts', 'mytheme_ie');


// ブロックスタイル
register_block_style('core/image',
    array('name'=> 'mycard',
        'label'=> 'カード型',
        'inline_style'=> '.is-style-mycard {
padding: 10px;
        border: none;
        box-shadow: 0 10px 60px rgba(0, 0, 0, 0.05);
    }

    '
));

register_block_style('core/heading',
    array(
		'name'=> 'mybar2',
        'label'=> '基本色のアンダーバー',
		'inline_style'=> 
		'.is-style-mybar2 {
			position: relative;
			display: inline-block;
			
			}
			.is-style-mybar2::before {
				content: "";
				position: absolute;
	
				bottom: -10px;
				display: inline-block;
				width: 100px;
				height: 1px;
				left: 0%;
				-webkit-transform: translateX(0%);
				transform: translateX(0%);
				background-color: #e9c547;
	
			
    }',
)
);

register_block_style('core/heading',
    array('name'=> 'mybar',
        'label'=> '基本色のバー',
        'inline_style'=> '.is-style-mybar {
	border-left: solid 10px #e9c547;
        padding-left: 14px;
    }

    '
));


