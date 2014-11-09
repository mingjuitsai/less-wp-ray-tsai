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
                          <section class="header-sec">
                            <span class="circle"></span><span class="circle"></span><span class="circle"></span>
                          </section>
                          <!-- If destop display video -->
                          <video id="<?php echo $video_id; ?>" class="the-content-video extend-box" poster="<?php echo $img; ?>" width="" height="auto">
                            <source src="<?php echo $file1; ?>" type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"' />
                            <source src="<?php echo $file2; ?>" type='video/webm;codecs="vp8, vorbis"' />
                            <source src="<?php echo $file3; ?>" type="video/ogg; codecs=theora,vorbis" />
                            <img class="the-content-img extend-box" src="<?php echo $img; ?>">
                          </video>
                      </div>                    
                      <?php endwhile; ?>
                  <?php endif; ?> <!-- video Repeater Field END -->
                </section>
              
              <div class="the-content-text extend-box">

                <section class="the-content-summary"><?php $summary = get_field('summary'); echo $summary; ?></section>
                <section class="the-content-desc"><?php the_content( 'Continue...' ); ?></section>
                <!-- cat list -->
                <ul class="list-cat">
                  <?php
                    echo get_the_category_list(); 
                  ?> 
                </ul>
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

<footer class="site-footer" role="contentinfo">
  <div class="site-info container">
    
  </div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

</body>
</html>