<?php
/**
 * Template Name: Blog
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */

get_header(); ?>
    <div id="primary" class="site-content span9">
        <div class="content-bar row-fluid">
            <h1 class="page-title">
                <?php _e( 'You Are In: <span>Blog</span>', 'dw-focus' ); ?>
            </h1>
        </div>
        <?php 
            $no_results = '';
            if( ! have_posts() ) {
                $no_results = 'no-results';
            }

        ?>
        <div class="content-inner <?php echo $no_results ?>">
        <?php

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $query = 'offset=0&paged='.$paged;

            $cat_option = ot_get_option('dw_blog_cat');

            if( $cat_option && term_exists( (int) $cat_option, 'category' ) ) {
                $query .= '&cat='.$cat_option;
            } else {
                $cat_name = 'Blog';
                if( term_exists( $cat_name, 'category' ) ) {
                    $query .= '&category_name='.$cat_name;
                }
            }

            $number_posts = ot_get_option('dw_blog_number_posts');
            if( $number_posts ) {
                $query .= '&posts_per_page='.$number_posts;
            }
            
            $blogs = new WP_Query($query);
            if ( $blogs->have_posts() ) : 
        ?>
            <?php while ( $blogs->have_posts() ) : $blogs->the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
            <?php endwhile; ?>
        <?php else : ?>

            <?php get_template_part( 'no-results', 'archive' ); ?>

        <?php endif; ?>
        </div>
        <?php 
            dw_focus_pagenavi($blogs, ot_get_option('dw_blog_navigation', 'number') );
        ?>
    </div>
<?php get_sidebar( 'blog' ); ?>
<?php get_footer(); ?>