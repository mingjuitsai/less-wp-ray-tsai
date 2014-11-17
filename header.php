<?php
  $thumbnail; 
  if(get_the_post_thumbnail()) {
    $thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
  } else {
    $thumbnail = "http://ray-tsai.com/wp-content/uploads/2014/04/raytsaiprofile.jpg";
  }
?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta name="viewport" content="width=device-width" />
<meta property="og:title" content="<?php bloginfo('name'); ?> | <?php if( is_front_page() ) : echo bloginfo( 'description' ); endif; ?><?php wp_title( '', true,'right'); ?>"/>
<meta property="og:type" content="website" /> 
<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
<meta property="og:image" content="<?php echo $thumbnail; ?>" />
<meta property="og:description" content="Ray Tsai is a web designer and developer with passion for building minimal, meaningful, and usable web. He loves basketball and traveling." />
<title><?php bloginfo('name'); ?> | <?php if( is_front_page() ) : echo bloginfo( 'description' ); endif; ?><?php wp_title( '', true,'right'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
