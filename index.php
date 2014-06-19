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
	/* Start Home loop
	/*-----------------------------------------------------------------------------------*/
	
	if( is_home() || is_archive() ) {
	
?>
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="post">
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
								        	$video_id = 'video-'.get_the_id();
								        ?>
								        <div class="wrap-vid">
											<section class="header-vid">
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
								<?php endif; ?>
							</section>
							<!-- Work Repeater Field END -->

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

					<article class="post">

						<h1 class="title"><?php the_title() ?></h1>
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
							<div class="category"><?php echo get_the_category_list(get_the_ID()); ?></div>
							<div class="tags"><?php echo get_the_tag_list( '| &nbsp;', '&nbsp;' ); ?></div>
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

<footer class="site-footer" role="contentinfo">
	<div class="site-info container">
		
	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

</body>
</html>
