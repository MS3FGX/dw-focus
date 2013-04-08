<?php
/**
 * The template for displaying category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */

get_header(); ?>
    <div id="primary" class="site-content span9">
    	<div class="content-bar row-fluid">
            <h1 class="page-title">
                <?php if ( is_day() ) : ?>
                    <?php printf( __( 'Daily Archives: %s', 'dw-focus' ), '<span>' . get_the_date() . '</span>' ); ?>
                <?php elseif ( is_month() ) : ?>
                    <?php printf( __( 'Monthly Archives: %s', 'dw-focus' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'dw-focus' ) ) . '</span>' ); ?>
                <?php elseif ( is_year() ) : ?>
                    <?php
                        printf( __( 'Category Archives: %s', 'dw-focus' ), '<span>' . single_cat_title( '', false ) . '</span>' );
                    ?>
                 <?php elseif ( is_tag() ) : ?>
                    <?php
                        printf( __( 'Tag Archives: %s', 'dw-focus' ), '<span>' . single_tag_title( '', false ) . '</span>' );
                    ?>
                <?php else : ?>
                    <?php _e( 'Blog Archives', 'dw-focus' ); ?>
                <?php endif; ?>
            </h1>

            <div class="post-layout">
                <a class="layout-list active" href="#"><i class="icon-th-list"></i></a>
                <a class="layout-grid" href="#"><i class="icon-th"></i></a>
            </div>
        </div>
        <?php 
            $no_results = '';
            if( ! have_posts() ) {
                $no_results = 'no-results';
            }

        ?>
        <div class="content-inner <?php echo $no_results ?>">
		<?php if ( have_posts() ) : ?>
            <?php global $archive_i; $archive_i = 1 ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content', 'archive'); ?>
                <?php $archive_i++; ?>
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
<?php get_sidebar( 'archive' ); ?>
<?php get_footer(); ?>