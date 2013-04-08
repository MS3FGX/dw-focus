<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */

if ( ! function_exists( 'dw_focus_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since DW Focus 1.0
 */
function dw_focus_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'dw_focus' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'dw_focus' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'dw_focus' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'dw_focus' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'dw_focus' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // dw_focus_content_nav

if ( ! function_exists( 'dw_focus_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since DW Focus 1.0
 */
function dw_focus_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'dw_focus' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'dw_focus' ), ' ' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s </cite>',
						get_comment_author_link()
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a> said:',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( ' %1$s', 'dw_focus' ), dw_focus_time_stamp( get_comment_time() ) )
					);
					
				?>
				<?php edit_comment_link( __( 'Edit', 'dw_focus' ) ); ?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'dw_focus' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'dw_focus' ), 'after' => ' <span><i class="icon-comment"></i></span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
			break;
	endswitch;
}
endif; // ends check for dw_focus_comment()

if ( ! function_exists( 'dw_focus_posted_on' ) ) :
// Return date of post
function dw_focus_posted_on() {
	printf( __( '<time class="entry-date" datetime="%3$s" pubdate>%4$s</time>', 'dw_focus' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		dw_focus_time_stamp( get_the_date('c') )
	);
}
endif;

if ( ! function_exists( 'dw_focus_get_category' ) ) :
// Show big category buttons
function dw_focus_get_category() {the_category();}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since DW Focus 1.0
 */
function dw_focus_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so dw_focus_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so dw_focus_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in dw_focus_categorized_blog
 *
 * @since DW Focus 1.0
 */
function dw_focus_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'dw_focus_category_transient_flusher' );
add_action( 'save_post', 'dw_focus_category_transient_flusher' );

add_filter( 'the_category', 'add_nofollow_cat' );  
function add_nofollow_cat( $text ) { 
	$text = str_replace('rel="category tag"', 'rel="tag"', $text); 
	$text = str_replace('rel="category"', 'rel="tag"', $text);
	return $text; 
}


if( ! function_exists('dw_focus_category_list_add_color_class') ) {
	/**
	 * Add color class for category meta tag of single page
	 * @param  string $thelist   HTML of category list 
	 * @param  string $separator seperator of each category 
	 * @param  object $parents   
	 * @return string          New html of category list 
	 */
	function dw_focus_category_list_add_color_class( $thelist){
		if( is_single() ) {
			preg_match_all('/(<li)><a[^>]*>(.*)<\/a><\/li>/i', $thelist, $matches, PREG_SET_ORDER );
			foreach ($matches as $tag ) {		
				// Get category by name
				$category = get_term_by( 'name', $tag[2], 'category' );

		        $options = dw_get_category_option( $category->term_id );
		        $class = '';
		        if( $options['style'] && $options['style'] != 'none' ) {
		        	$class = 'color-'.$options['style'];
		        	$li = str_replace( 
		        			$tag[1], $tag[1].' class="'.$class.'"', 
		        			$tag[0]
		        		);
					$thelist = str_replace( $tag[0], $li, $thelist );
		        }
			}
		}
		return $thelist;
	}
	//add_filter( 'the_category', 'dw_focus_category_list_add_color_class' );
}
