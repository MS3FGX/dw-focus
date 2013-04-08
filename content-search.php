<?php
/**
 * The template for displaying content on the search page.
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
    
    $class = '';
    if( has_post_thumbnail() ) {
        $class = 'has-thumbnail';
    }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="entry-thumbnail">
		<?php if( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
        	
        	<?php if ( has_post_format('Video') || has_post_format('Audio') || has_post_format('Gallery')) : ?>
                    <?php echo dw_focus_post_format_icons(); ?>    
            <?php endif ?>

            <?php the_post_thumbnail('thumbnail'); ?>
        </a>
        <?php endif; ?>
    </div>
	<div class="post-inner">
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php search_title_highlight(); ?></a></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php search_excerpt_highlight(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
