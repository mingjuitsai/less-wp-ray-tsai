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
    <?php if( !is_front_page() ): ?>
      <h2 class="title-page">
        <?php 
          if( is_single( $post )) {
            $author_id = $post->post_author; 
            echo "written by ".get_the_author_meta('display_name', $author_id);
          } else if ( single_post_title( "",false ) ) {
            single_post_title();
          } else {
            wp_title();
          }
        ?>
      </h2>

    <?php endif; ?>

<?php
  /*-----------------------------------------------------------------------------------*/
  /* Start Home loop
  /*-----------------------------------------------------------------------------------*/
  
  if( is_home() || is_archive() ) {
  
?>
      <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

          <article class="post blog">
              <h3 class="title">
                <a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php the_title() ?>
                </a>
              </h3>
              
            <div class="the-content clearfix">

              <!-- 
                Work Repeater Field 
              -->
              <?php $format = get_post_format( get_the_id() ); ?>
              


                <section class="the-content-work extend-box">


                  <?php if ( $format == 'video' ) : ?>

                    <?php if( have_rows('repeater_video') ): ?>
                        <?php while( have_rows('repeater_video') ): the_row(); ?>
                          <?php 
                            $file1 = get_sub_field('object_file_mp4');
                            $file2 = get_sub_field('object_file_webm');
                            $file3 = get_sub_field('object_file_ogg');
                            $img  = get_sub_field('object_img');
                            $video_id = 'video-'.get_the_id();
                          ?>

                          <!-- If desktop display video -->
                          <video id="<?php echo $video_id; ?>" class="the-content-video extend-box" poster="<?php echo $img; ?>" width="" height="auto">
                            <source src="<?php echo $file1; ?>" type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"' />
                            <source src="<?php echo $file2; ?>" type='video/webm;codecs="vp8, vorbis"' />
                            <source src="<?php echo $file3; ?>" type="video/ogg; codecs=theora,vorbis" />
                            <img class="the-content-img extend-box" src="<?php echo $img; ?>">
                          </video>
                                       
                        <?php endwhile; ?>
                    <?php endif; ?> <!-- Work Repeater Field END -->
                  

                  <?php else : ?>

                    <a href="<?php the_permalink() ?>">
                      <?php the_post_thumbnail( $size, $attr ); ?>
                    </a>

                  <?php endif; ?> <!-- if format END -->
                  
                
                </section>


              <div class="the-content-text extend-box">
                
                <h5 class="date">
                  <?php the_date(); ?>
                </h5>
                <section class="the-content-summary"> <?php  if ( has_excerpt() ) { the_excerpt(); } ?> </section>
                <section class="the-content-desc"><?php the_content( 'More' ); ?></section>
                <!-- cat list -->
                <ul class="list-block list-tags">
                  <?php
                    echo get_the_tag_list(); 
                  ?> 
                </ul>
              </div>


              <?php wp_link_pages(); ?>
            </div><!-- the-content -->

          </article>

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

    
  <?php } //end is_home(); ?>

<?php
  /*-----------------------------------------------------------------------------------*/
  /* Start Single loop
  /*-----------------------------------------------------------------------------------*/
  
  if( is_single() ) {
?>
      <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

          <article class="post single-post">

            <h3 class="title"><?php the_title() ?></h3>
            <div class="post-meta">
              <?php if( comments_open() ) : ?>
                <span class="comments-link">
                  <?php comments_popup_link( __( 'Comment', 'less' ), __( '1 Comment', 'less' ), __( '% Comments', 'less' ) ); ?>
                </span>
              <?php endif; ?>
            
            </div><!--/post-meta -->
            
            <div class="the-content">
              <?php the_content( 'Continue...' ); ?>
              
              <?php wp_link_pages(); ?>
            </div><!-- the-content -->
            
            <div class="meta clearfix">
              <ul class="list-block list-cats"><?php echo get_the_category_list(get_the_ID()); ?></ul>
              <ul class="list-block list-tags"><?php echo get_the_tag_list(); ?></ul>
            </div><!-- Meta -->           
          </article>

        <?php endwhile; ?>
        
        <?php
          // If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || '0' != get_comments_number() )
            comments_template( '', true );
        ?>


      <?php else : ?>
        
        <article class="post error">
          <h1 class="404">Nothing posted yet</h1>
        </article>

      <?php endif; ?>
  <?php } //end is_single(); ?>
  
<?php
  /*-----------------------------------------------------------------------------------*/
  /* Start Page loop
  /*-----------------------------------------------------------------------------------*/
  
  if( is_page()) {
?>

      <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

          <article class="post">
            
            <!-- <h1 class="title"><?php the_title() ?></h1> -->
            <div class="the-content">
              <?php the_content(); ?>
              
              <?php wp_link_pages(); ?>
            </div><!-- the-content -->
            
          </article>

        <?php endwhile; ?>

      <?php else : ?>
        
        <article class="post error">
          <h1 class="404">Nothing posted yet</h1>
        </article>

      <?php endif; ?>

  <?php } // end is_page(); ?>

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
