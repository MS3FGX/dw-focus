<?php
/*
 * The template for displaying the content of related post on the single page.
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row-fluid'); ?>>
    <?php if( has_post_thumbnail() ) : ?>
    <div class="entry-thumbnail">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
            <?php if ( has_post_format('Video') || has_post_format('Audio') || has_post_format('Gallery')) : ?>
                <?php echo dw_focus_post_format_icons(); ?>    
            <?php endif ?>

            <?php the_post_thumbnail('medium'); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="post-inner">
        <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
        </header>
    </div>
</article>