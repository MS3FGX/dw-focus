<?php
/**
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>

<?php
    $class = '';

    if( has_post_thumbnail() && ! has_post_format('video') && ! has_post_format('audio') && ! has_post_format('gallery') ) {
        
        $class .= ' has-thumbnail';
    }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <?php echo dw_focus_post_format_icons(); ?>
    <?php if( has_post_thumbnail() && ! has_post_format('video') && ! has_post_format('audio') && ! has_post_format('gallery') ) : ?>
    <div class="entry-thumbnail">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
            <?php the_post_thumbnail('large'); ?>
        </a>
    </div>
    <?php endif; ?>
    <div class="post-inner">
        <header class="entry-header">
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

            <div class="entry-meta entry-meta-top">
                <span><?php echo dw_focus_time_stamp( get_the_date('c')); ?></span>

                <span class="author">by <?php the_author_posts_link(); ?> </span>
                
                <span class="comments-link">
                    <span>with</span>
                    <?php comments_popup_link( '<span class="leave-reply">' . __( '0 comment ', 'dw-focus' ) . '</span>', __( '1 comment', 'dw-focus' ), __( '% comments', 'dw-focus' ),'', __( 'comment off', 'dw-focus' ) ); 
                    ?>
                </span>
            </div>

        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
                global $more;
                $more = 0;
            ?>
            <?php the_content(''); ?>
        </div><!-- .entry-content -->

        <footer class="entry-meta entry-meta-bottom">
            <?php
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list( '', __( ', ', 'dw_focus' ) );
                if ( $tags_list ) :
            ?>
            <span class="tags-links">
                <?php printf( __( 'Tags: %1$s', 'dw_focus' ), $tags_list ); ?>
            </span>
            <?php endif; // End if $tags_list ?>
        </footer>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
