<?php 
global $listingpro_options;
				
				$gSiteKey = '';
				$gSiteKey = $listingpro_options['lp_recaptcha_site_key'];
				$enableCaptcha = lp_check_receptcha('lp_recaptcha_registration');		
				$enableCaptchaLogin = lp_check_receptcha('lp_recaptcha_login');	
				$privacy_policy = $listingpro_options['payment_terms_condition'];			


?>
<div class="login-form-popup lp-border-radius-8 login-form-popup-outer">
    <div class="login-form-pop-tabs clearfix">
        <ul>
            <li><a href="#" class="signInClick active">Sign In</a></li>
            <li><a href="#" class="signUpClick">Sign Up</a></li>
           
        </ul>
        <a class="md-close"><i class="fa fa-close"></i></a>
    </div>
    <div class="siginincontainer">
        <ul class="social-login list-style-none">
			<?php if ( is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) { ?>
                <li>
                    <a id="loginfacebook" class="facebook flaticon-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
                        <i class="fa fa-facebook"></i>
                        <span><?php esc_html_e('Login With Facebook','listingpro'); ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ( is_plugin_active( "nextend-twitter-connect/nextend-twitter-connect.php" ) ) { ?>
                <li>
                    <a id="logintwitter" class="twitter flaticon-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1&redirect='+window.location.href; return false;">
                        <i class="fa fa-twitter"></i>
                        <span><?php esc_html_e('Login With Twitter','listingpro'); ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ( is_plugin_active( "nextend-google-connect/nextend-google-connect.php" ) ) { ?>
                <li>
                    <a id="logingoogle" class="google flaticon-googleplus" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;">
                        <i class="fa fa-google-plus"></i>
                        <span><?php esc_html_e('Login With Google','listingpro'); ?></span>
                    </a>
                </li>
            <?php } ?>
            
        </ul>
		<div class="alterna text-center">
			<p><?php esc_html_e('Or','listingpro'); ?></p>
		</div>
        <form id="login" class="form-horizontal margin-top-30"  method="post">
            <p class="status"></p>
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="<?php esc_html_e('UserName/Email','listingpro'); ?>"/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="<?php esc_html_e('Password','listingpro'); ?>"/>
            </div>
           
                <?php
                if($enableCaptchaLogin==true){ ?>
					 <div class="form-group">
                    <?php if ( class_exists( 'cridio_Recaptcha' ) ){
                        if ( cridio_Recaptcha_Logic::is_recaptcha_enabled() ) {
                            echo  '<div id="recaptcha-'.get_the_ID().'" class="g-recaptcha" data-sitekey="'.$gSiteKey.'"></div>';
                        }
                    }?>
					</div>
               <?php  }

                ?>
            
            <div class="form-group">
                <div class="checkbox clearfix">
                    <input id="check1" type="checkbox" name="remember" value="yes">
                   
                    <a class="forgetPasswordClick pull-right" ><?php esc_html_e('Forgot Password','listingpro'); ?></a>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="<?php esc_html_e('Sign in','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" />
            </div>
            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
        </form>

    </div>
    <div class="siginupcontainer">
        <ul class="social-login list-style-none">
			 <?php if ( is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) { ?>
                <li>
                    <a id="loginfacebook" class="facebook flaticon-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
                        <i class="fa fa-facebook"></i>
                        <span><?php esc_html_e('Login With Facebook','listingpro'); ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ( is_plugin_active( "nextend-twitter-connect/nextend-twitter-connect.php" ) ) { ?>
                <li>
                    <a id="logintwitter" class="twitter flaticon-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1&redirect='+window.location.href; return false;">
                        <i class="fa fa-twitter"></i>
                        <span><?php esc_html_e('Login With Twitter','listingpro'); ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ( is_plugin_active( "nextend-google-connect/nextend-google-connect.php" ) ) { ?>
                <li>
                    <a id="logingoogle" class="google flaticon-googleplus" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;">
                        <i class="fa fa-google-plus"></i>
                        <span><?php esc_html_e('Login With Google','listingpro'); ?></span>
                    </a>
                </li>
            <?php } ?>
           
        </ul>
		<div class="alterna text-center">
			<p><?php esc_html_e('Or','listingpro'); ?></p>
		</div>
        <form id="register" class="form-horizontal margin-top-30"  method="post">
            <p class="status"></p>
            <div class="form-group">
               
                <input type="text" class="form-control" id="username2" name="username"  placeholder="<?php esc_html_e('User name *','listingpro'); ?>"/>
            </div>
            <div class="form-group">
                
                <input type="email" class="form-control" id="email" name="email" placeholder="<?php esc_html_e('Email','listingpro'); ?>"/>
            </div>
            
                <div class="form-group">
                   
                    <input type="password" class="form-control" id="upassword" name="upassword" placeholder="<?php esc_html_e('Password','listingpro'); ?>"/>
                </div>
            
           
                <div class="form-group">
                    <p class="margin-bottom-0"><?php esc_html_e('Password will be e-mailed to you.','listingpro'); ?></p>
                </div>
           
            
                <?php
                if($enableCaptcha==true){?>
					<div class="form-group">
                   <?php if ( class_exists( 'cridio_Recaptcha' ) ){
                        if ( cridio_Recaptcha_Logic::is_recaptcha_enabled() ) {
                            echo  '<div id="recaptcha-'.get_the_ID().'" class="g-recaptcha" data-sitekey="'.$gSiteKey.'"></div>';
                        }
                    }?>
					 </div>
               <?php }

                ?>
           
            <div class="form-group">
                <input type="submit" value="<?php esc_html_e('Register','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" />
            </div>
            <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
        </form>

    </div>
    <div class="forgetpasswordcontainer">
        <form class="form-horizontal margin-top-30" id="lp_forget_pass_form" action="#"  method="post">
            <p class="status"></p>
            <div class="form-group">
                <input type="email" name="user_login" class="form-control" id="email3" placeholder="<?php esc_html_e('Email','listingpro'); ?>"/>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="<?php esc_html_e('Get New Password','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" />
                <?php wp_nonce_field( 'ajax-forgetpass-nonce', 'security3' ); ?>
            </div>
        </form>
        <div class="pop-form-bottom">
            <div class="bottom-links">
                <a class="cancelClick" ><?php esc_html_e('Cancel','listingpro'); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="md-overlay"></div>