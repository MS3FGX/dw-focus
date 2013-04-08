<?php
/**
 * The Template for displaying all single posts.
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */



get_header(); ?>

    <div id="primary" class="site-content span9">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'dw_focus' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
		
	<?php endwhile; // end of the loop. ?>
	<?php comments_template( '', true ); ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>