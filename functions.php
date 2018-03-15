<?php
/**
 * WPSnappy Theme.
 *
 * @package      WPSnappy
 * @link         https://www.wpsnappy.com/
 * @author       Tharindu Pramuditha
 * @license      GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Child theme (do not remove).
include_once( get_template_directory() . '/lib/init.php' );

// Define theme constants.
define( 'CHILD_THEME_NAME', 'WPSnappy' );
define( 'CHILD_THEME_URL', 'https://www.wpsnappy.com/' );
define( 'CHILD_THEME_VERSION', '1.0.4' );

// Set Localization (do not remove).
load_child_theme_textdomain( 'wpsnappy', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'wpsnappy' ) );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove header right sidebar.
unregister_sidebar( 'header-right' );

// Remove unused site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Enable shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Enable support for structural wraps.
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'menu-primary',
	'menu-secondary',
	'footer-widgets',
	'footer',
) );

// Enable support for Accessibility enhancements.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
) );

// Enable support for custom navigation menus.
add_theme_support( 'genesis-menus' , array(
	'primary'   => __( 'Primary Navigation', 'wpsnappy' ),
) );

// Enable support for viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Enable support for Genesis footer widgets.
add_theme_support( 'genesis-footer-widgets', 6 );

// Enable support for Gutenberge wide images.
add_theme_support( 'gutenberg', array(
	'wide-images' => true,
) );

// Enable support for default posts and comments RSS feed links.
add_theme_support( 'automatic-feed-links' );

// Enable support for HTML5 markup structure.
add_theme_support( 'html5', array(
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form',
) );

// Enable support for post thumbnails.
add_theme_support( 'post-thumbnails' );

// Enable support for selective refresh and Customizer edit icons.
add_theme_support( 'customize-selective-refresh-widgets' );

// Enable support for logo option in Customizer > Site Identity.
add_theme_support( 'custom-logo', array(
	'height'      => 60,
	'width'       => 240,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( '.site-title', '.site-description' ),
) );

// Display custom logo in site title area.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Change order of main stylesheet to override plugin styles.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_title_area', 'genesis_do_nav' );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after_header_wrap', 'genesis_do_subnav' );

// Reposition footer widgets inside site footer.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_before_footer_wrap', 'genesis_footer_widget_areas', 5 );

add_action( 'wp_enqueue_scripts', 'wpsnappy_scripts_styles', 99 );
/**
 * Enqueue theme scripts and styles.
 *
 * @return void
 */
function wpsnappy_scripts_styles() {

	// Google fonts.
	wp_enqueue_style( 'lato-font', '//fonts.googleapis.com/css?family=Lato:400,700', array(), CHILD_THEME_VERSION );

	// Font-awesome.
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

	// Check if debugging is enabled.
	$suffix = defined( SCRIPT_DEBUG ) && SCRIPT_DEBUG ? '' : 'min.';
	$folder = defined( SCRIPT_DEBUG ) && SCRIPT_DEBUG ? '' : 'min/';

	// Enqueue responsive menu script.
	wp_enqueue_script( 'wpsnappy', get_stylesheet_directory_uri() . '/assets/scripts/' . $folder . 'scripts.' . $suffix . 'js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Localize responsive menu script.
	wp_localize_script( 'wpsnappy', 'genesis_responsive_menu', array(
		'mainMenu'         => __( 'Menu', 'wpsnappy' ),
		'subMenu'          => __( 'Menu', 'wpsnappy' ),
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
		),
	) );
}

// Load miscellaneous functions.
include_once( get_stylesheet_directory() . '/includes/extras.php' );

// Load default settings.
include_once( get_stylesheet_directory() . '/includes/defaults.php' );

// Add Image Sizes.
add_image_size( 'featured-image', 700, 350, true );

// Customize the credits.
add_filter( 'genesis_footer_creds_text', 'wpsnappy_footer_creds_text' );
function wpsnappy_footer_creds_text() {
	echo '<div class="creds"><p>';
	echo 'Copyright &copy; ';
	echo date( 'Y' );
	echo ' <a target="_blank" href="/">WP Snappy</a>. Powered by <a target="_blank" href="https://www.wordpress.org">WordPress</a> and <a target="_blank" href="https://www.studiopress.com">Genesis</a>.</p>';
	echo '<p>Powered by <a target="_blank" href="/go/siteground/">Siteground</a> & <a target="_blank" href="https://aws.amazon.com/cloudfront/pricing/">Amazon CloudFront</a>.</p></div>';
}

// Reposition breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs', 9 );

// Add Google Analytics
add_action( 'wp_head', 'wpsnappy_google_analytics' );
function wpsnappy_google_analytics() {
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114126818-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	
	gtag('config', 'UA-114126818-1');
</script>
<?php
}

// Adding Schema to Hosting Pages
add_filter( 'wp_head', 'wpsnappy_hosting_schema' );
function wpsnappy_hosting_schema() {
	if ( ! is_singular( 'hosting' ) ) {
		return;
	}
	$hosting_provider = get_post_meta( get_the_ID(), '_wpsnappy_hosting_provider_name', true );
	$review_score     = get_post_meta( get_the_ID(), '_wpsnappy_hosting_review_total', true );
?>
<script type="application/ld+json">
{
"@context": "http://schema.org",
"@type": "Review",
"itemReviewed": "<?php echo $hosting_provider; ?> Review",
"reviewRating": {
	"@type": "Rating",
	"bestRating": "5",
	"worstRating": "1",
	"ratingValue": "<?php echo $review_score ?>"
},
"datePublished": "<?php echo get_the_modified_date( 'Y-m-d' ); ?>",
"author": "Tharindu Pramuditha"
}
</script>
<?php
}

// truncate Yoast SEO breadcrumb title
function shorten_yoast_breadcrumb_title( $link_info ) {
	$limit = 50;
	if ( strlen( $link_info['text'] ) > ( $limit ) ) {
		$link_info['text'] = substr( $link_info['text'], 0, $limit ) . '&hellip;';
	}

	return $link_info;
}
add_filter( 'wpseo_breadcrumb_single_link_info', 'shorten_yoast_breadcrumb_title', 10 );

// Register a new sidebar
genesis_register_sidebar( array(
	'id'          => 'hosting-sidebar',
	'name'        => 'Hosting Sidebar',
	'description' => 'Widget area for hosting CPT pages.',
) );

add_action( 'get_header', 'wpsnappy_change_hosting_sidebar' );
function wpsnappy_change_hosting_sidebar() {
	if ( is_singular('hosting')) {
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		
		add_action( 'genesis_sidebar', function() {
			dynamic_sidebar( 'hosting-sidebar' );
		} );
	}
}
