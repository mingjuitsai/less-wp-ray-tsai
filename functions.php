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

add_theme_support( 'post-thumbnails' );

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

	// add jQeury
	wp_deregister_script('jquery');
	wp_register_script('raytsai-jquery', "//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js",array(), LESS_VERSION, true);
	wp_enqueue_script('raytsai-jquery');
	// plugin js 
	wp_enqueue_script( 'less-plugin', get_template_directory_uri() . '/js/plugin.js?defer', array(), LESS_VERSION, true );
	// add theme scripts
	wp_enqueue_script( 'less', get_template_directory_uri() . '/js/theme.min.js?defer', array(), LESS_VERSION, true );	
}

function wp_enqueue_footer() {

	// font awesome
	wp_enqueue_style( 'fontawesome-style','//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), '1.0.0', 'all' );
	// theme styles
	wp_enqueue_style( 'less-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
}

add_action( 'wp_enqueue_scripts', 'less_scripts' );
add_action( 'wp_footer', 'wp_enqueue_footer', 5 );

/*
  defer javascript loading
*/
//Adapted from https://gist.github.com/toscho/1584783
add_filter( 'clean_url', function( $url ) {
    if ( FALSE === strpos( $url, '.js?defer' ) ) // avoid conflict 
    { // not our file
        return $url;
    }
    // Must be a ', not "!
    return "$url' defer='defer";
}, 11, 1 );

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
/*
	Remove read more anchor tag
*/
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

/*
	Add TypeKit Code
*/
function add_typekit() { ?> 

<script async type="text/javascript" src="//use.typekit.net/gpb5ban.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php }

add_action('wp_footer', 'add_typekit', 100);

/*
	Add Google analytics code 
*/
function add_googleanalytics() { ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56611378-1', 'auto');
  ga('send', 'pageview');
</script>
<?php }

add_action('wp_footer', 'add_googleanalytics', 100);