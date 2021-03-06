<?php
if ( ! function_exists( 'wpstarter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wpstarter_setup() {
		// Add support for translation
		load_theme_textdomain( 'wpstarter', get_template_directory() . '/languages' );

		// Support: <title> in <head></head>
		add_theme_support( 'title-tag' );

		// Support: Post Thumbnail
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// Register menus
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'wpstarter' ),
				'footer' => __( 'Footer Menu', 'wpstarter' ),
				'social' => __( 'Social Links Menu', 'wpstarter' )
			)
		);

		// Switch search form, comments and comment form to valid HTML5 output
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Support: Custom Logo
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'assets/css/editor.min.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'wpstarter_setup' );

/**
 * Register sidebar
 */

function wpstarter_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'wpstarter' ),
			'id'            => 'footer-sidebar',
			'description'   => __( 'Add widgets here to appear in your footer.', 'wpstarter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wpstarter_widgets_init' );

/**
 * Register global assets
 */

function wpstarter_scripts() {

	$site_url = site_url();
	$path = '';

	if (strpos($site_url, 'localhost') !== false) {
		$path = '.min';
	}

	// Register main styles and scripts
	wp_enqueue_style( 'wpstarter-style', get_template_directory_uri() . '/assets/css/main' . $path . '.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'blocks', get_template_directory_uri() . '/assets/css/blocks' . $path . '.css', array(), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'wpstarter-scripts', get_theme_file_uri( '/assets/js/main' . $path . '.js' ), array('jquery'), wp_get_theme()->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpstarter_scripts' );

/**
 * Register Blocks and Editor in backend and frontend
 */
function wpstarter_editor_customizer_styles() {

	$site_url = site_url();
	$path = '';

	if (strpos($site_url, 'localhost') !== false) {
		$path = '.min';
	}

	// Addition style for blocks
	wp_enqueue_style( 'blocks-editor', get_theme_file_uri( '/assets/css/editor.min.css' ), false, wp_get_theme()->get( 'Version' ), 'all' );
	wp_enqueue_script(
		'blocks',
		get_theme_file_uri( '/assets/js/blocks' . $path . '.js' ),
		[ 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n' ],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'wpstarter_editor_customizer_styles' );

function wpstarter_block_scripts() {
	$site_url = site_url();
	$path = '';

	if (strpos($site_url, 'localhost') !== false) {
		$path = '.min';
	}

	wp_enqueue_style(
		'blocks-style',
		get_theme_file_uri( '/assets/css/blocks' . $path . '.css' ),
		[ 'wp-blocks' ],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_assets', 'wpstarter_block_scripts' );

/**
 * Add font awesome 5
 */
function wpstarter_load_fonts() { ?>
	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<?php }
add_action('wp_head', 'wpstarter_load_fonts');
