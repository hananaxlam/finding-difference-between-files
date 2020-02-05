<?php get_header();?>
	<?php 
	/* The loop starts here. */
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); 
			$author_avatar_url = get_user_meta(get_the_author_meta( 'ID' ), "listingpro_author_img_url", true); 
			$avatar ='';
			if(!empty($author_avatar_url)) {
				$avatar =  $author_avatar_url;

			} else { 			
				$avatar_url = listingpro_get_avatar_url (get_the_author_meta( 'ID' ), $size = '51' );
				$avatar =  $avatar_url;

			}
            global $listingpro_options;
            $blog_detail_template   =   $listingpro_options['blog_single_template'];
            $blog_sidebar_style   =   $listingpro_options['blog_sidebar_style'];
            $blog_detail_class      =   '12';

            if( $blog_detail_template == 'left_sidebar' || $blog_detail_template == 'right_sidebar' )
            {
                $blog_detail_class      =   '8';
            }

            $lp_page_banner =   get_post_meta( $post->ID, 'lp_listingpro_options', true );

            if( !empty( $lp_page_banner ) && array_key_exists( 'lp_post_banner', $lp_page_banner ) ){
                $lp_page_banner =   $lp_page_banner['lp_post_banner'];
            }
            else
            {
                $lp_page_banner =   get_the_post_thumbnail_url( $post->ID, 'full' );
            }
			?>
	<!--==================================Single Banner =================================-->
	<div class="blog-single-page" style="background-image:url(<?php echo $lp_page_banner; ?>);">
		<div class="blog-heading-inner-container text-center">
			
			<div class="lp-blog-user-thumb">
				<img class="avatar"  src="<?php echo $avatar; ?>" alt="author Image" />
			</div>
			<h1 class="padding-bottom-15"><?php echo get_the_title(); ?></h1>
			<?php if (function_exists('listingpro_breadcrumbs')) listingpro_breadcrumbs(); ?>
			
			<ul class="lp-blog-grid-author ">
				<li>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
						<i class="fa fa-user"></i>
						<span><?php the_author(); ?></span>
					</a>
				</li>
				<li>
					<i class="fa fa-calendar"></i>
					<span><?php the_date(get_option('date_format')); ?></span>
				</li>
			</ul><!-- ../lp-blog-grid-author -->
		</div>
		<div class="page-header-overlay"></div>
	</div><!-- ..-->	
	<!--==================================Section Open=================================-->
	<section class="aliceblue">
		<div class="container page-container-second page-container-second-blog">
			<div class="row">
                <div class="blog-single-inner-container lp-border lp-border-radius-8 <?php echo $blog_detail_template; ?>">
                    <?php
                    if( $blog_detail_template == 'left_sidebar' )
                    {
                        if( $blog_sidebar_style == 'sidebar_style1' ){
                        echo '<div class="col-md-4"><div class="sidebar-style1">';
                            get_sidebar();
                        echo '</div></div>';
						}else{
							 echo '<div class="col-md-4"><div class="sidebar-style2">';
							get_sidebar();
							echo '</div></div>';
							
						}
                    }
                    ?>
                    <div class="col-md-<?php echo $blog_detail_class; ?>">
						<div class="blog-content-outer-container">
							<div class="blog-content popup-gallery">
								<?php the_content(); ?>
							</div>
							<div class="blog-meta clearfix">
								<div class="blog-tags pull-left">
									<ul>
										<li><i class="fa fa-tag"></i></li>

										<?php
										$posttags = get_the_tags();
										if ($posttags) {
											foreach($posttags as $tag) {
												echo '&nbsp;<li><a href="' .get_tag_link($tag->term_id). '">#' .$tag->name. '</a></li>';
											}
										}
										?>
									</ul>
								</div>
								<div class="blog-social pull-right">
									<ul class="social-icons blog-social">
										<li>
											<a href="http://www.facebook.com/share.php?u=<?php echo esc_url(get_the_permalink()); ?>&title=<?php echo get_the_title(); ?>"><!-- Facebook icon by Icons8 -->
												<?php echo listingpro_icons('facebook'); ?>
											</a>
										</li>
										<li>
											<a href="https://plus.google.com/share?url=<?php echo esc_url(get_the_permalink()); ?>"><!-- Google Plus icon by Icons8 -->
												<?php echo listingpro_icons('google'); ?>
											</a>
										</li>
										<li>
											<a href="http://twitter.com/home?status=<?php echo esc_html(get_the_title()); ?>+<?php echo esc_url(get_the_permalink()); ?>"><!-- Twitter icon by Icons8 -->
												<?php echo listingpro_icons('twitter'); ?>
											</a>
										</li>
										<li>
											<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_the_permalink()); ?>&title=<?php echo get_the_title(); ?>&source=<?php echo esc_url(home_url('/')); ?>"><!-- LinkedIn icon by Icons8 -->
												<?php echo listingpro_icons('linkedin'); ?>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<?php
							echo  next_posts_link();
							echo  previous_posts_link();
							comments_template();
							?>

						</div>
                    </div>
                    <?php
                    if( $blog_detail_template == 'right_sidebar' )
                    {
						if( $blog_sidebar_style == 'sidebar_style1' ){
                        echo '<div class="col-md-4"><div class="sidebar-style1">';
                            get_sidebar();
                        echo '</div></div>';
						}else{
							 echo '<div class="col-md-4"><div class="sidebar-style2">';
							get_sidebar();
							echo '</div></div>';
							
						}
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>
	</section>
	<!--==================================Section Close=================================-->
	<?php 
		} // end while
	} // end if
	?>
<?php get_footer();?>