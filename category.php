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
            <h1 class="page-title"><?php
                printf( __( '%s articles', 'dw-focus' ), '<span>' . single_cat_title( '', false ) . '</span>' );
            ?></h1>
            
            <?php if ( have_posts() ) : ?>
            <div class="post-layout">
                <a class="layout-list <?php dw_active(apply_filters( 'cat_display_filter', ot_get_option('cat_display')),'list'); ?>" href="#"><i class="icon-th-list"></i></a>
                <a class="layout-grid <?php dw_active(apply_filters( 'cat_display_filter', ot_get_option('cat_display')),'grid'); ?>" href="#"><i class="icon-th"></i></a>
            </div>
            <?php endif; ?>
        </div>

        <div class="content-inner <?php echo 'layout-'.apply_filters( 'cat_display_filter', ot_get_option('cat_display')); ?>">
		<?php if ( have_posts() ) : ?>
            <?php global $archive_i; $archive_i = 1 ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content', 'archive'); ?>
                <?php $archive_i++; ?>
			<?php endwhile; ?>
		<?php endif; ?>
        </div>
        <?php 
            dw_focus_pagenavi();
            wp_reset_query();
        ?>
	</div>
<?php get_sidebar( 'archive' ); ?>
<?php get_footer(); ?>