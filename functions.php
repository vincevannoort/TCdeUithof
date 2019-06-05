<?php 

/**
 * Assets
 */
function add_assets() {
  wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/dist/app.css' );
	wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/dist/app.js' );
} add_action( 'wp_enqueue_scripts', 'add_assets' );

/**
 * Add editor css
 */
function add_editor_css() {
	add_theme_support( 'editor-styles' );
	add_editor_style( get_stylesheet_directory_uri() . '/dist/app.css' );
}
add_action( 'after_setup_theme', 'add_editor_css' );

/**
 * Navigations
 */
function add_navigations() {
	register_nav_menus(array(
		'header_menu_right' => 'Header Menu Rechts',
		'header_menu_left' => 'Header Menu Links',
		'footer_menu' => 'Footer Menu',
		'footer_contact_menu' => 'Footer Contact Menu',
		'footer_privacy_menu' => 'Footer Privacy Menu',
	));
} add_action( 'after_setup_theme', 'add_navigations' );

/** 
 * Enable gutenberg for Events Manager
 */
define('EM_GUTENBERG', true);


/** 
 * Remove Private from page title
 */
function remove_private_prefix($title) {
	$title = str_replace('Privé: ', '', $title);
	return $title;
}
add_filter('the_title', 'remove_private_prefix');

/** 
 * ACF blocks
 */
add_action('acf/init', 'my_register_blocks');
function my_register_blocks() {

    // check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'partners',
            'title'             => __('Partners'),
            'render_template'   => 'views/blocks/partners.php',
        ));
    }
}

/** 
 * Post thumbnails
 */
add_theme_support( 'post-thumbnails' );

/** 
 * Has children
 */
function has_children($id) {
		if ($id == 0) return false;
    $children = get_pages( array( 'child_of' => $id ) );
    if( count( $children ) == 0 ) {
        return false;
    } else {
        return true;
    }
}