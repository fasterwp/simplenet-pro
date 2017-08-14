<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Simplenet Pro' );
define( 'CHILD_THEME_URL', 'http://simplenet.ro/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Poppins:400,700', array(), CHILD_THEME_VERSION );
	
	// Line awesome.
	wp_enqueue_style( 'line-awesome', 'https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css' );


	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

	wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'fa-before fa-navicon',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'fa-before fa-angle-down',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 400,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Register front-page-1 widget areas.
genesis_register_widget_area(
	array(
		'id'          => "front-page-1",
		'name'        => __( "Front Page 1", 'genesis-sample' ),
		'description' => __( "This is the front page 1 section.", 'genesis-sample' ),
	)
);
// Register front-page-2 widget areas.
genesis_register_widget_area(
	array(
		'id'          => "front-page-2",
		'name'        => __( "Front Page 2", 'genesis-sample' ),
		'description' => __( "This is the front page 2 section.", 'genesis-sample' ),
	)
);
// Register front-page-3 widget areas.
genesis_register_widget_area(
	array(
		'id'          => "front-page-3",
		'name'        => __( "Front Page 3", 'genesis-sample' ),
		'description' => __( "This is the front page 3 section.", 'genesis-sample' ),
	)
);
// Register front-page-4 widget areas.
genesis_register_widget_area(
	array(
		'id'          => "front-page-4",
		'name'        => __( "Front Page 4", 'genesis-sample' ),
		'description' => __( "This is the front page 4 section.", 'genesis-sample' ),
	)
);
// Register front-page-5 widget areas.
genesis_register_widget_area(
	array(
		'id'          => "front-page-5",
		'name'        => __( "Front Page 5", 'genesis-sample' ),
		'description' => __( "This is the front page 5 section.", 'genesis-sample' ),
	)
);
// Register front-page-6 widget areas.
genesis_register_widget_area(
	array(
		'id'          => "front-page-6",
		'name'        => __( "Front Page 6", 'genesis-sample' ),
		'description' => __( "This is the front page 6 section.", 'genesis-sample' ),
	)
);

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

// Function to add prism.css and prism.js to the site
function add_prism() {
// Register prism.css file
wp_register_style(
'prismCSS', // handle name for the style so we can register, de-register, etc.
get_stylesheet_directory_uri() . '/prism.css' // location of the prism.css file
);
// Register prism.js file
wp_register_script(
'prismJS', // handle name for the script so we can register, de-register, etc.
get_stylesheet_directory_uri() . '/js/prism.js' // location of the prism.js file
);
// Enqueue the registered style and script files
wp_enqueue_style('prismCSS');
wp_enqueue_script('prismJS');
}
add_action('wp_enqueue_scripts', 'add_prism');

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 */
 function widget_first_last_classes( $params ) {
	
		global $my_widget_num; // Global a counter array
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
	
		if( !$my_widget_num ) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}
	
		// if( !isset( $arr_registered_widgets[$this_id] ) || !is_array( $arr_registered_widgets[$this_id] ) ) { // Check if the current sidebar has no widgets
			// return $params; // No widgets in this sidebar... bail early.
		// }
	
		if( isset( $my_widget_num[$this_id] ) ) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}
	
		$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options
	
		if( $my_widget_num[$this_id] == 1 ) { // If this is the first widget
			$class .= 'widget-first ';
		} elseif( $my_widget_num[$this_id] == count( $arr_registered_widgets[$this_id] ) ) { // If this is the last widget
			$class .= 'widget-last ';
		}
	
		// $params[0]['before_widget'] = str_replace( 'class="', $class, $params[0]['before_widget'] ); // Insert our new classes into "before widget"
		$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1); // Insert our new classes into "before widget"
	
		return $params;
	
	}
	add_filter( 'dynamic_sidebar_params', 'widget_first_last_classes' );

	// Font Awesome Shortcodes

function addscFontAwesome($atts) {
	    extract(shortcode_atts(array(
	    'type'  => '',
	    'size' => '',
	    'rotate' => '',
	    'flip' => '',
	    'pull' => '',
	    'animated' => '',
	    'class' => '',
	  
	    ), $atts));
	 
	    $classes  = ($type) ? 'fa-'.$type. '' : 'fa-star';
	    $classes .= ($size) ? ' fa-'.$size.'' : '';
	    $classes .= ($rotate) ? ' fa-rotate-'.$rotate.'' : '';
	    $classes .= ($flip) ? ' fa-flip-'.$flip.'' : '';
	    $classes .= ($pull) ? ' pull-'.$pull.'' : '';
	    $classes .= ($animated) ? ' fa-spin' : '';
	    $classes .= ($class) ? ' '.$class : '';
	 
	    $theAwesomeFont = '<i class="fa '.esc_html($classes).'"></i>';
	      
	    return $theAwesomeFont;
	}
	  
add_shortcode('icon', 'addscFontAwesome');