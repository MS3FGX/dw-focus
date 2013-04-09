<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
	<header id="masthead" class="site-header" role="banner">
	    <div class="container">
	    	<div id="header">
	    		<div class="row">
	           		<div id="branding" class="span3 visible-desktop">
		                <h1>
		                	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		                		<?php bloginfo( 'name' ); ?>
		                	</a>
		                </h1>
		            </div>
		            <?php if( is_active_sidebar( 'dw_focus_header' ) ) { ?>
		            <div id="sidebar-header" class="span9">
		            	<div class="row">
		            		<?php dynamic_sidebar('dw_focus_header'); ?>
		            	</div>
		            </div>
		            <?php } ?>
		        </div>
	        </div>
	        <?php 
	        	if( !is_handheld() ) :
			        $max_number_posts = ot_get_option('dw_menu_number_posts');
			        if( ! $max_number_posts ) {
			            $max_number_posts = 15;
			        }
			        if( $max_number_posts > 0 ) {
	        ?>
		            <div class="btn-group top-news">
				    	<?php dw_top15(); ?>
				    </div>
			<?php  
					} 
				endif; 
			?>

		    <div class="wrap-navigation">
		        <nav id="site-navigation" class="main-navigation navbar" role="navigation">
		            <div class="navbar-inner">
						<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse"  type="button">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<button class="collapse-search hidden-desktop" data-target=".search-collapse" data-toggle="collapse" >
							<i class="icon-search"></i>
						</button>

						<a class="small-logo hidden-desktop" rel="home" title="The Powerbase" href="<?php echo esc_url( home_url( '/' ) ); ?>">The Powerbase</a>

						<?php  
							// Social links
							$facebook = ot_get_option('dw_facebook');
							$twitter = ot_get_option('dw_twitter');
							$gplus = ot_get_option('dw_gplus');
						?>
<!-- Social hover -->
<ul class="social-links visible-desktop">
<?php if( $facebook ) { ?>
<li class="facebook"><a target="_blank" href="<?php echo $facebook; ?>" title="<?php _e('Facebook','dw-focus') ?>"><i class="icon-facebook"></i></a></li>
<?php } ?>

<?php if( $gplus ) { ?>
<li class="gplus"><a target="_blank" href="<?php echo $gplus; ?>" title="<?php _e('Google Plus','dw-focus') ?>"><i class="icon-google-plus"></i></a></li>
<?php } ?>

<?php if( $twitter ) { ?>
<li class="twitter"><a target="_blank" href="<?php echo $twitter;  ?>" title="<?php _e('Twitter','dw-focus') ?>"><i class="icon-twitter"></i></a></li>
<?php } ?>

<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('RSS','dw-focus') ?>"><i class="icon-rss"></i></a></li>

<!-- <li class="login"><a href="<?php echo wp_login_url( get_permalink() ); ?>" title="<?php _e('Login','dw-focus') ?>"><i class="icon-user"></i></a> -->
</ul>
<!-- End social hover -->
						<div class="search-collapse collapse">
							<?php get_search_form( $echo = true ); ?>
						</div>

						<div class="nav-collapse collapse">
							<?php
							  $params = array(
							  	    'theme_location'  => 'primary',
									'container'       => '',
									'menu_class'      => 'nav',
									'depth'           => 2,
									'fallback_cb'    => 'link_to_menu_editor'
							  	);

							  if (!is_handheld()) {
							  	$params['walker']  = new DW_Mega_Walker();
							  }else{
							  	$params['walker']	=	new DW_Mega_Walker_Mobile();
							  }
								wp_nav_menu($params);
							?>
						</div>	
		            </div>
		        </nav>

		        <div id="under-navigation" class="clearfix under-navigation">
		        	<div class="row-fluid">
		        		<?php $offset = ''; ?>
		        		<?php if( is_active_sidebar( 'dw_focus_under_navigation' ) ) { ?>
		        		<!-- Under navigation positions ( breadcrum, twitter widgets) -->
			        	<div class="span9">
							<?php dynamic_sidebar('dw_focus_under_navigation'); ?>
						</div>
						<?php } else { $offset = 'offset9';  }?>

						<div class="span3 <?php echo $offset; ?>"><?php get_search_form(); ?></div>
					</div>
			    </div>
		    </div>
	    </div>
	</header> <!-- End header -->

	<div id="main">
         <div class="container">
             <div class="row">
