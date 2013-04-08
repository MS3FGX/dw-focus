<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */

get_header(); ?>
    <div id="primary" class="site-content span9">
    	<div class="content-bar row-fluid">
            <h1 class="page-title">
               <?php printf( __( 'Search Results for: %s', 'dw_focus' ), '<span>' . get_search_query() . '</span>' ); ?>
            </h1>
        </div>
        <?php 
            $no_results = '';
            if( ! have_posts() ) {
                $no_results = ' no-results';
            }

        ?>
        <div class="content-inner<?php echo $no_results ?>">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content', 'search'); ?>
			<?php endwhile; ?>
		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>
        </div>
        <?php 
            dw_focus_pagenavi();
            wp_reset_query();
        ?>
	</div>
    
<?php get_sidebar( ) ?>
<?php get_footer(); ?>