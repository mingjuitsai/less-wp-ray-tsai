<?php

// Define the version as a constant so we can easily replace it throughout the theme
define( 'LESS_VERSION', 1.1 );

/*-----------------------------------------------------------------------------------*/
/* Add Rss to Head
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*
* Enable support for Post Formats.
* See http://codex.wordpress.org/Post_Formats
*/
add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'quote', 'link', 'audio', 'quote' ) );

/*-----------------------------------------------------------------------------------*/
/* register main menu
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'less' ),
	)
);

/*-----------------------------------------------------------------------------------*/
/* Enque Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function less_scripts()  { 
	// font awesome
	wp_enqueue_style( 'fontawesome-style','//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', '10001', 'all' );
	// theme styles
	wp_enqueue_style( 'less-style', get_template_directory_uri() . '/style.css', '10000', 'all' );
	// add jQeury
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", true, null);
	wp_enqueue_script('jquery');
	// add fitvid
	wp_enqueue_script( 'less-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), LESS_VERSION, true );
	// plugin js 
	wp_enqueue_script( 'less-plugin', get_template_directory_uri() . '/js/plugin.js', array(), LESS_VERSION, true );
	// add theme scripts
	wp_enqueue_script( 'less', get_template_directory_uri() . '/js/theme.min.js', array(), LESS_VERSION, true );
	
	
}
add_action( 'wp_enqueue_scripts', 'less_scripts' );

/* video shortcode 
// Add Shortcode
function rtvideo( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'autoplay' => '',
			'loop' => '',
			'controls' => '',
			'width' => '',
			'height' => '',
			'mp4' => '',
			'ogg' => '',
			'poster' => '',
		), $atts )
	);
	// Code
	if ($autoplay){$autoplay='autoplay';}else{$autoplay='';}
	if ($loop){$loop='loop';}else{$loop='';}
	if ($controls){$controls='controls';}else{$controls='';}
return 
	'<video poster="'.$poster.'" width="'.$width.'" height="'.$height.'" '.$autoplay.' '.$loop.' '.$controls.'>
	  <source src="'.$mp4.'" type="video/mp4">
	  <source src="'.$ogg.'" type="video/ogg">
	  <img class="img_vidfallback" src="'.$poster.'">
	</video>';
}
add_shortcode( 'rtvideo', 'rtvideo' );
*/
/*
	Remove Title on List
*/
function wp_list_categories_remove_title_attributes($output) {
    $output = preg_replace('` title="(.+)"`', '', $output);
    return $output;
}
add_filter('wp_list_categories', 'wp_list_categories_remove_title_attributes');