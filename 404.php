<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top: 0 !important;">
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

<body <?php body_class(); ?>>
	<header id="masthead" class="site-header" role="banner">
	    <div class="container">
	    	<div id="header">
	    		<div class="row">
	           		<div id="branding" class="span3">
		                <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		            </div>
		            <div id="sidebar-header" class="span9">
		            	<div class="row"><?php dynamic_sidebar('dw_focus_header'); ?></div>
		            </div>
		        </div>
	        </div>

	        <nav id="site-navigation" class="main-navigation navbar navbar-inverse" role="navigation">
	            <div class="navbar-inner">
	            <?php
	            	wp_nav_menu(array(
	            	'theme_location'  => 'primary',
	            	'container'       => '',
	            	'menu_class'      => 'nav',
	            	'depth'           => 1) );
	            ?>
	            </div>
	        </nav>
	        <div id="under-navigation" class="clearfix">
				<?php dynamic_sidebar('dw_focus_under_navigation'); ?>
		    </div>
	    </div>
	</header>
	
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article id="post-0" class="post error404 not-found">
				<div class="entry-content">
					<h2><?php _e('404!','dw_focus') ?></h2>
					<p><?php _e( 'The page you were looking for is not here', 'dw_focus' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

			<nav class="main-navigation" role="navigation">
	            <div class="navbar-inner">
	            <?php _e('Maybe you are interested in:','dw_focus') ?>
	            <?php
	            	wp_nav_menu(array(
	            	'theme_location'  => 'primary',
	            	'container'       => '',
	            	'menu_class'      => 'nav',
	            	'depth'           => 1) );
	            ?>
	            </div>
	        </nav>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
</body>