<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to dw_focus_comment() which is
 * located in the functions.php file.
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */

	if ( post_password_required() )
		return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>
	
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _n( 'One Comment;', '%1$s Comments', get_comments_number(), 'dw_focus' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'dw_focus' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'dw_focus' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'dw_focus' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use dw_focus_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define dw_focus_comment() and that will be used instead.
				 * See dw_focus_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'dw_focus_comment' ) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'dw_focus' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'dw_focus' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'dw_focus' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>


	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() 
				&& post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'dw_focus' ); ?></p>
	<?php endif; ?>



	<?php 
	// Comment form
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
		'title_reply' => '' ,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<p class="comment-form-comment"> <textarea id="comment" placeholder="Your comment..." name="comment" rows="4" aria-required="true"></textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', array(

		'author' => '<div class="row-fluid"><p class="comment-form-author field">' . '<i class="icon-user"></i><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . '<label for="author">' . __( 'Your Name', 'domainreference' ) . '</label> ' .  ( $req ? '<span class="required">*</span>' : '' ) . '</p>',

		'email' => '<p class="comment-form-email field">' . '<i class="icon-envelope-alt"></i><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . '<label for="email">' . __( 'Your Email', 'domainreference' ) . '</label> ' .  ( $req ? '<span class="required">*</span>' : '' ) . '</p>',

		'url' => '<p class="comment-form-url field">' . '<i class="icon-link"></i><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' . '<label for="url">' . __( 'Website', 'domainreference' ) . '</label> ' .  ( $req ? '<span class="required">*</span>' : '' ) . '</p> </div>' ) )
	);

	comment_form($args); ?>

</div><!-- #comments .comments-area -->
