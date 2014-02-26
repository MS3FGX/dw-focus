<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
get_header(); ?>
    <div id="primary" class="site-content span9">
        <?php if ( have_posts() ) : ?>
        
            <?php if( is_active_sidebar( 'dw_focus_home' ) ) { ?>

                <?php dynamic_sidebar('dw_focus_home'); ?>
                
            <?php } else { ?>

                <div class="content-inner">
                    
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'archive' ); ?>
                    <?php endwhile; ?>
                </div>
                <?php dw_focus_pagenavi(); ?>
            <?php } ?>

        <?php else : ?>

            <?php get_template_part( 'no-results', 'archive' ); ?>

        <?php endif; ?>
        
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>