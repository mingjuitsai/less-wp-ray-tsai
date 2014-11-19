<?php
/*
  Template Name: Projects Template
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <!-- Header -->
    <?php get_header(); ?>
  <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>


<?php
  /*-----------------------------------------------------------------------------------*/
  /* Start header
  /*-----------------------------------------------------------------------------------*/
?>
<header id="masthead" class="site-header" role="banner">
  <div class="container header-wrap">
    
    <div id="brand">
      <section class="site-title">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <?php bloginfo( 'name' ); ?></a> 
        
      </section>
    </div><!-- /brand -->

    <!-- <div class="desc">
      <?php //echo get_bloginfo( 'description' ); ?>
    </div> -->
  
    <nav role="navigation" class="site-navigation main-navigation">
      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    </nav><!-- .site-navigation .main-navigation -->
    
  </div><!--/container -->
    
</header><!-- #masthead .site-header -->

<div class="container main-content">

  <div id="primary">
    <div id="content" role="main">

    <!-- Page Title -->
    <h2 class="title-page">
      <?php single_post_title();?>
    </h2>

<?php
  /*-----------------------------------------------------------------------------------*/
  /* Start Blog ( Post ) loop
  /*-----------------------------------------------------------------------------------*/
  
?>
      <?php $args = array(
          'post_type'=> 'post',
          'order'    => 'DESC',
        );
        query_posts( $args ); 
      ?>
      <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>
          

          <!-- 
            If not Project formats don't output anything 
          -->
          <?php $format = get_post_format( get_the_ID() ); ?>
          <?php if ( $format == 'video' ) : ?>


          <article class="post project">

              <h3 class="title">
                <a target="_blank" href="<?php $object_url = get_field('object_url'); echo $object_url; ?>" title="<?php the_title(); ?>">
                  <?php the_title() ?>
                </a>
              </h3>
              
            <div class="the-content clearfix">
              <!-- 
                Work Repeater Field 
              -->
                <section class="the-content-work extend-box">
                  <?php if( have_rows('repeater_video') ): ?>
                      <?php while( have_rows('repeater_video') ): the_row(); ?>
                          <?php 
                            $file1 = get_sub_field('object_file_mp4');
                            $file2 = get_sub_field('object_file_webm');
                            $file3 = get_sub_field('object_file_ogg');
                            $img  = get_sub_field('object_img'); 
                            $video_id = 'video-'.get_the_ID();
                          ?>
                        <div class="wrap-sec">

                          <div class="header-sec">
                            <span class="circle"></span><span class="circle"></span><span class="circle"></span>
                          </div>
                          <!-- If desktop display video -->
                          <?php if($file1||$file2||$file3): ?>
                            <video id="<?php echo $video_id; ?>" class="the-content-video extend-box" poster="<?php echo $img; ?>">
                              <?php if($file1): ?>
                                <source src="<?php echo $file1; ?>" type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"' />
                              <?php endif; ?>
                              <?php if($file2): ?>
                                <source src="<?php echo $file2; ?>" type='video/webm;codecs="vp8, vorbis"' />
                              <?php endif; ?>
                              <?php if($file3): ?>
                                <source src="<?php echo $file3; ?>" type="video/ogg; codecs=theora,vorbis" />
                              <?php endif; ?>
                            </video>
                          <?php else : ?>
                            <img class="the-content-img extend-box" src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
                          <?php endif; ?>

                      </div>                    
                      <?php endwhile; ?>
                  <?php endif; ?> <!-- video Repeater Field END -->
                </section>
              
              <div class="the-content-text extend-box">

                <div class="the-content-summary"> <?php  if ( has_excerpt() ) { the_excerpt(); } ?> </div>
                <div class="the-content-desc"><?php the_content( 'More' ); ?></div>
                <!-- tags list -->
                <div class="list-block list-tags">
                  <?php
                    echo get_the_tag_list(); 
                  ?> 
                </div>
              </div>

              <?php wp_link_pages(); ?>
            </div><!-- the-content -->

          </article>

        <?php endif; ?> <!-- if post format END -->

        <?php endwhile; ?>
        
        <!-- pagintation -->
        <div id="pagination" class="clearfix">
          <div class="past-page"><?php previous_posts_link( 'Newer &raquo;' ); ?></div>
          <div class="next-page"><?php next_posts_link( ' &laquo; Older' ); ?></div>
        </div><!-- pagination -->


      <?php else : ?>
        
        <article class="post error">
          <h1 class="404">Nothing posted yet</h1>
        </article>

      <?php endif; ?>


    </div><!-- #content .site-content -->
  </div><!-- #primary .content-area -->

</div><!-- / container-->

<?php
  /*-----------------------------------------------------------------------------------*/
  /* Start Footer
  /*-----------------------------------------------------------------------------------*/
?>

<?php get_footer(); ?>

<?php wp_footer(); ?>

</body>
</html>
