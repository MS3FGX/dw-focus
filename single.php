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

		<?php get_template_part( 'content', 'single' ); ?>
		

	<?php endwhile; // end of the loop. ?>

	<?php
		$tags = wp_get_post_tags( get_the_ID() );
		
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>3, // Number of related posts to display.
			'ignore_sticky_posts'=>1
			);
			$my_query = new WP_Query( $args );

			if( $my_query->have_posts() ) { ?>
				<div class="related-post">
					<h3><?php _e('Related posts','dw_focus') ?></h3>
					<div class="row-fluid">
						<div class="content-inner">
						<?php
							while( $my_query->have_posts() ) {
								$my_query->the_post();
								get_template_part('content', 'related-post'); 
							 }
						?>			
						</div>
					</div>
				</div>
	<?php 
			} 
		}
	?>	
		
	<?php  while ( have_posts() ) { the_post(); ?>
		<?php comments_template( '', true ); ?>
	<?php } ?>
	</div>
					
<?php get_sidebar( 'single' ); ?>
<?php get_footer(); ?>