<?php
/**
 * Template name: Login Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

get_header(); 
if(!is_user_logged_in()){
?>
			<!--==================================Section Open=================================-->
	<section>
		
		<div class="lp-section-row aliceblue">
			<div class="lp-section-content-container-one">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="login-form-popup lp-border-radius-8">
								<div class="siginincontainer">
									<h1 class="text-center"><?php esc_html_e('Sign in','listingpro'); ?></h1>
									<form id="login" class="form-horizontal margin-top-30"  method="post">
										<p class="status"></p>
										<div class="form-group">
											<label for="username"><?php esc_html_e('Username or Email Address *','listingpro'); ?></label>
											<input type="text" class="form-control" id="username" name="username" />
										</div>
										<div class="form-group">
											<label for="password"><?php esc_html_e('Password *','listingpro'); ?></label>
											<input type="password" class="form-control" id="password" name="password" />
										</div>
										<div class="form-group">
											<div class="checkbox pad-bottom-10">
												<input id="check1" type="checkbox" name="remember" value="price-on-call">
												<label for="check1"><?php esc_html_e('Keep me signed in','listingpro'); ?></label>
											</div>
										</div>
										
										<div class="form-group">
											<input type="submit" value="<?php esc_html_e('Sign in','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" /> 
										</div>
										<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
									</form>	
									<div class="pop-form-bottom">
										<div class="bottom-links">
											<a  class="signUpClick"><?php esc_html_e('Not a member? Sign up','listingpro'); ?></a>
											<a  class="forgetPasswordClick pull-right" ><?php esc_html_e('Forgot Password?','listingpro'); ?></a>
										</div>
										<p class="margin-top-15"><?php esc_html_e('Connect with your Social Network','listingpro'); ?></p>
										<ul class="social-login list-style-none">
											<?php if ( is_plugin_active( "nextend-google-connect/nextend-google-connect.php" ) ) { ?>
												<li>
													<a id="logingoogle" class="google flaticon-googleplus" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;">
														<i class="fa fa-google-plus"></i>
														<span><?php esc_html_e('Google','listingpro'); ?></span>
													</a>
												</li>
											<?php } ?>
											<?php if ( is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) { ?>
											<li>
												<a id="loginfacebook" class="facebook flaticon-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
													<i class="fa fa-facebook"></i>
													<span><?php esc_html_e('Facebook','listingpro'); ?></span>
												</a>
											</li>
											<?php } ?>
											<?php if ( is_plugin_active( "nextend-twitter-connect/nextend-twitter-connect.php" ) ) { ?>
												<li>
													<a id="logintwitter" class="twitter flaticon-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1&redirect='+window.location.href; return false;">
														<i class="fa fa-twitter"></i>
														<span><?php esc_html_e('Twitter','listingpro'); ?></span>
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								<a class="md-close"><i class="fa fa-close"></i></a>
								</div>
								<div class="siginupcontainer">
									<h1 class="text-center"><?php esc_html_e('Sign Up','listingpro'); ?></h1>
									<form id="register" class="form-horizontal margin-top-30"  method="post">
									<p class="status"></p>
										<div class="form-group">
											<label for="username"><?php esc_html_e('Username *','listingpro'); ?></label>
											<input type="text" class="form-control" id="username2" name="username" />
										</div>
										<div class="form-group">
											<label for="password"><?php esc_html_e('Email Address *','listingpro'); ?></label>
											<input type="email" class="form-control" id="email" name="email" />
										</div>
										<div class="form-group">
											<p><?php esc_html_e('Password will be e-mailed to you.','listingpro'); ?></p>
										</div>
										<div class="form-group">
											<input type="submit" value="<?php esc_html_e('Register','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" /> 
										</div>
										<?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
									</form>	
									<div class="pop-form-bottom">
										<div class="bottom-links">
											<a class="signInClick" ><?php esc_html_e('Already have an account? Sign in','listingpro'); ?></a>
											<a class="forgetPasswordClick pull-right" ><?php esc_html_e('Forgot Password?','listingpro'); ?></a>
										</div>
										<p class="margin-top-15"><?php esc_html_e('Connect with your Social Network','listingpro'); ?></p>
										<ul class="social-login list-style-none">
											<?php if ( is_plugin_active( "nextend-google-connect/nextend-google-connect.php" ) ) { ?>
												<li>
													<a id="logingoogle" class="google flaticon-googleplus" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;">
														<i class="fa fa-google-plus"></i>
														<span><?php esc_html_e('Google','listingpro'); ?></span>
													</a>
												</li>
											<?php } ?>
											<?php if ( is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) { ?>
											<li>
												<a id="loginfacebook" class="facebook flaticon-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
													<i class="fa fa-facebook"></i>
													<span><?php esc_html_e('Facebook','listingpro'); ?></span>
												</a>
											</li>
											<?php } ?>
											<?php if ( is_plugin_active( "nextend-twitter-connect/nextend-twitter-connect.php" ) ) { ?>
												<li>
													<a id="logintwitter" class="twitter flaticon-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1&redirect='+window.location.href; return false;">
														<i class="fa fa-twitter"></i>
														<span><?php esc_html_e('Twitter','listingpro'); ?></span>
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								<a class="md-close"><i class="fa fa-close"></i></a>
								</div>
								<div class="forgetpasswordcontainer">
									<h1 class="text-center"><?php esc_html_e('Forgotten Password','listingpro'); ?></h1>
									<form class="form-horizontal margin-top-30"  method="post">
										<div class="form-group">
											<label for="password"><?php esc_html_e('Email Address *','listingpro'); ?></label>
											<input type="email" class="form-control" id="email2" />
										</div>
										<div class="form-group">
											<input type="submit" value="<?php esc_html_e('Get New Password','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" /> 
										</div>
									</form>	
									<div class="pop-form-bottom">
										<div class="bottom-links">
											<a class="cancelClick" ><?php esc_html_e('Cancel','listingpro'); ?></a>
										</div>
									</div>
								<a class="md-close"><i class="fa fa-close"></i></a>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div><!-- ../section-row -->
	
	</section>
	<!--==================================Section Close=================================-->
	
			
<?php 
}else{
	wp_redirect(esc_url(home_url('/')));
	exit();
}
get_footer();
?>