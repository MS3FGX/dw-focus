<?php
/*
 * Single post metadata and sharing
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<div class="entry-meta">
			<?php dw_focus_get_category(); ?>
			<br>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if( has_post_thumbnail() && ! has_post_format('video') && ! has_post_format('audio') && ! has_post_format('gallery') ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(''); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'dw_focus' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<!-- Load in author info, tags, and sharing sidebar -->
	<?php dw_focus_post_actions(); ?> 

	<footer class="entry-meta entry-meta-bottom">
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<div class="author-info">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
			</div><!-- .author-avatar -->
			<div class="author-description">
                <h2><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h2>

                <p class="description"><?php the_author_meta( 'description' ); ?></p>
            </div><!-- .author-description -->
		</div><!-- .author-info -->
		<?php endif; ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
