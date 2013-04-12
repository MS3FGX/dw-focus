<?php
/**
 * DW Focus functions and definitions
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */

/**
 * 	Define template path
 */
if( !defined('DW_TEMPLATE_PATH') ){
    define('DW_TEMPLATE_PATH', get_template_directory() .'/' );
}
if( !defined('DW_TEMPLATE_URI') ){
    define('DW_TEMPLATE_URI', get_template_directory_uri() . '/' );
}

require_once DW_TEMPLATE_PATH . 'inc/browsers.php';
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );

add_filter( 'ot_theme_options_icon_url', 'dw_theme_option_icon');

  function dw_theme_option_icon(){
     return get_template_directory_uri().'/assets/img/icon.png';
  }
 
/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );
 
/**
 * Required: include OptionTree.
 */
include_once( 'inc/options/ot-loader.php' );
/**
 * Theme Options
 */
//include_once( 'inc/options/assets/theme-mode/demo-theme-options.php' );
include_once( 'inc/options/theme-options.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since DW Focus 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'dw_focus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since DW Focus 1.0
 */
function dw_focus_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * 	Init widgets for theme
	 */
	require_once DW_TEMPLATE_PATH . 'inc/dw-focus-sidebar.php';
    require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-dynamic-widget.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-categories.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-recent-posts.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-twitter.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-slider.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-carousel.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-tabs.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-accordion.php';
	require_once DW_TEMPLATE_PATH.'inc/widgets/dw-focus-latest-headlines.php';
	require_once DW_TEMPLATE_PATH . 'inc/widgets/dw-focus-latest-comments.php';
    
    //Include new meta field for category taxonomy
    require_once DW_TEMPLATE_PATH . 'inc/category-meta.php';
    //Include mega menu
    require_once DW_TEMPLATE_PATH . 'inc/mega-menu.php';
    //Update counting for social share
    require_once DW_TEMPLATE_PATH . 'inc/social-sharing.php';
    //Add avatar to profile
    require_once DW_TEMPLATE_PATH . 'inc/simple-avatar.php';

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on DW Focus, use a find and replace
	 * to change 'dw_focus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'dw_focus', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Add DW Focus's custom image sizes.
	// Used for large feature (header) images.
	add_image_size( 'large', 640 , 360 , true );
	// Used for featured posts if a large-feature doesn't exist.
	add_image_size( 'medium', 230, 130 ,true );

	add_image_size( 'thumbnail', 110, 110 ,true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dw_focus' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array('audio', 'gallery' , 'video' ) );
}
endif; // dw_focus_setup
add_action( 'after_setup_theme', 'dw_focus_setup' );



if( ! function_exists('dw_focus_scripts') ) {
    //Enqueue scripts and styles for front-end
    function dw_focus_scripts() {
        wp_enqueue_style( 'dw_focus_template', get_template_directory_uri().'/assets/css/template.css' );
        wp_enqueue_style( 'dw_focus_responsive', get_template_directory_uri().'/assets/css/responsive.css' );

        if( is_archive() ) {
            $style = '';
            $options = dw_get_category_option(get_query_var( 'cat' ));
            $style = isset( $options['style'] ) && $options['style'] != 'none' ? $options['style'] : false;


            // If have parent and not have style, get style of parent
            if( ! $style ) {
                $cat = get_category( get_query_var( 'cat' ) );
                if( $cat->parent ) {
                    $options = dw_get_category_option( $cat->parent );
                    $style = isset( $options['style'] ) && $options['style'] != 'none' ? $options['style'] : false;
                }
            }

            if(  $style ) {
                $url = 'assets/colors/'.$style.'/style.css';
                if( file_exists(DW_TEMPLATE_PATH . $url) ) {
                    wp_enqueue_style( 'dw_focus_category_style', DW_TEMPLATE_URI . $url );
                }
            }
        }

        wp_enqueue_style( 'style', get_stylesheet_uri() );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }


        wp_enqueue_script('bootstrap', DW_TEMPLATE_URI . 'assets/js/bootstrap.min.js',array('jquery') );



        wp_enqueue_script('infinitescroll', DW_TEMPLATE_URI . 'assets/js/jquery.infinitescroll.min.js',array('jquery') );
        wp_enqueue_script('dw_focus', DW_TEMPLATE_URI . 'assets/js/custom.js',array('jquery','bootstrap') );

        wp_localize_script('dw_focus', 'dw_focus', array(
                'ajax_url'  =>  admin_url('admin-ajax.php'),
            ) );
        if( is_single() ){
            wp_enqueue_script( 'twitter-indent', '//platform.twitter.com/widgets.js' );
            wp_enqueue_script( 'single-social', DW_TEMPLATE_URI . 'assets/js/single-socials.js', array('jquery','bootstrap') );
            wp_localize_script('single-social', 'dw_focus', array(
                'ajax_url'  =>  admin_url('admin-ajax.php'),
            ) );
        } 

        //Swipe event
        wp_enqueue_script('mouse-move', DW_TEMPLATE_URI . 'assets/js/jquery.mouse.move.js',array('jquery') );
        wp_enqueue_script('swipe', DW_TEMPLATE_URI . 'assets/js/jquery.swipe.js',array('jquery','mouse-move') );

    }
    add_action( 'wp_enqueue_scripts', 'dw_focus_scripts' );
}



if( ! function_exists('dw_focus_admin_scripts' ) ){
    // Enqueue scripts and styles for back-end panel
    function dw_focus_admin_scripts() {
        global $pagenow;
        if( 'widgets.php' == $pagenow ){
            wp_enqueue_script('jquery');

            wp_enqueue_script('dw-focus-widgets', DW_TEMPLATE_URI .'assets/admin/js/widget.js', array('jquery','jquery-ui-datepicker','jquery-ui-sortable','jquery-ui-sortable', 'jquery-ui-draggable','jquery-ui-droppable','admin-widgets' ) );
            wp_enqueue_style('dw-focus-widgets', DW_TEMPLATE_URI .'assets/admin/css/admin-widget.css');
            wp_enqueue_style('dw-focus-jquery-ui', DW_TEMPLATE_URI .'assets/admin/css/jquery-ui.css');
        }
    }
    add_action( 'admin_enqueue_scripts', 'dw_focus_admin_scripts' );
}

if( ! function_exists('dw_focus_pagenavi') ) {
    /**
     * Create a pagination from query
     * @param  object_var $the_query WP_Query Object that including query
     * @return void      
     */
    function dw_focus_pagenavi( $the_query = false, $type = false ){
    	global $wp_query, $wp_rewrite;
        
    	$query = ($the_query) ? $the_query : $wp_query;
    	$max = $query->max_num_pages;
    	$current_page = max(1, get_query_var('paged')); 
    	$big=999999999; 
        if( ! $type ) {
            $type = ot_get_option('nav_type','number');
        }
    	if ( $max > 1 ) { ?>
    		
    			<?php if( $type != 'number' && ( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0') ===false || is_mobile() ) ): ?>
    			 <div class="navigation">
    				<div class="navigation-inner">
    					<?php next_posts_link( __( 'See More', 'dw_focus' ) ); ?>
    				</div>
    			  </div>
    			<?php else: 
    				echo "<div class='pagination'>";
    				echo paginate_links(array(  
    			      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),  
    			      'format' => '?paged=%#%',
    			      'current' => $current_page,  
    			      'total' => $max, 
    			      'type' => 'list',
    			      'prev_text' => __('<i class="icon-chevron-left"></i>'),
    			      'next_text' => __('<i class="icon-chevron-right"></i>'), 
    			    ));  
    			    echo "</div>";
    			 endif; ?>
    		
    	<?php }
    }
}


if( ! function_exists('dw_focus_next_posts_link_attributes') ) {
    /**
     * Add class for next link
     * @return string Class attributes
     */
    function dw_focus_next_posts_link_attributes() {
        return 'class="btn btn-large"';
    }
    add_filter('next_posts_link_attributes', 
                    'dw_focus_next_posts_link_attributes');
}

/**
 * Show human time diff for post date value
 * @param  string $from Creating date of the post
 * @return string       Time in human time
 */

if( ! function_exists('dw_focus_time_stamp') ) { 
    function dw_focus_time_stamp($from){
    	$cmt_date = $from;
    	$from = strtotime($from);
    	$format = get_option('date_format');

    	if ( empty($to) )
    	$to = time();
    	$diff = (int) abs($to - $from);

    	if($diff <= 1){
    		$since = '1 second';
    	} else if($diff <= 60 ){
    		$since = sprintf(_n('%s second', '%s seconds', $diff), $diff);
    	} else if ($diff <= 3600) {
    	$mins = round($diff / 60);

    	if ($mins <= 1) {
    		$mins = 1;
    	}
    	/* translators: min=minute */
    	$since = sprintf(_n('about %s min', '%s mins', $mins), $mins);
    	} else if ( ($diff <= 86400) && ($diff > 3600)) {
    		$hours = round($diff / 3600);
    	if ($hours <= 1) {
    		$hours = 1;
    	}
    	$since = sprintf(_n('about %s hour', '%s hours', $hours), $hours);
    	} elseif ($diff >= 86400 && $diff <= 86400*2 ) {
    		$days = round($diff / 86400);
    	if ($days <= 1) {
    		$days = 1;
    	}
    	$since = sprintf(_n('%s day', '%s days', $days), $days);
    	} else {
    		return date($format,$from);
    	}
    	return $since . ' ago';
    }
}

if( ! function_exists('dw_the_modified_time') ) { 
    function dw_the_modified_time( $d, $query = false ){
        global $wp_query;
        if( ! $query ) $query = $wp_query->query;

        $query['posts_per_page'] = 1;
        $query['order'] = 'DESC';
        $query['orderby'] = 'modified';
        
        $posts = new WP_Query( $query );

        if( $posts->have_posts() ) {
            while( $posts->have_posts() ) { $posts->the_post();
                the_modified_time($d);
            }
        }  
    }
}

if( ! function_exists('dw_breadcrumb') ) { 
	function dw_breadcrumb(){
		global $post;
	    echo '<ul class="breadcrumbs">';
		if (!is_front_page()) {
			echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="';
			echo home_url();
			echo '"><span itemprop="title">';
			bloginfo('name');
			echo "</span></a> </li> ";
			if ( is_category() || is_single() ) { 
				if ( single_cat_title("", false)!='') echo '<li>'.single_cat_title("", false).'</li>';
				
				if ( is_single() ) {
					$cat = get_the_category();
                    if( !empty( $cat ) ) {
                        echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.get_category_link($cat[0]->term_id).'"><span itemprop="title">'.$cat[0]->cat_name.'</span></a></li>';
                        echo "<li> ";
                        the_title();
                        echo "</li>";
                    }
				}
			} elseif ( is_page() && $post->post_parent ) { 

				$home = get_page_by_title('home');
				for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
					if (($home->ID) != ($post->ancestors[$i])) {
						echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="';
						echo get_permalink($post->ancestors[$i]); 
						echo '"><span itemprop="title">';
						echo get_the_title($post->ancestors[$i]);
						echo "</span></a> </li> ";
					}
				}
				echo the_title();
			} elseif (is_page()) { 
				echo "<li>".get_the_title()."</li>" ;
			} elseif (is_404()) {
				echo "<li>404</li>";
			}
			elseif(is_search()){
				echo "<li>Search</li>";
			}
			elseif(is_author()){
				global $wp_query;
				$author = $wp_query->get_queried_object();
				echo "<li>".$author->user_nicename."</li>";
			}
		} else {
			echo '<li>';
			bloginfo('name');
			echo '</li>';
		}
		echo '</ul>';
	}
}

/** Show author info, tags, and share options **/
if( ! function_exists('dw_focus_post_actions') ) :
	function dw_focus_post_actions() {

        $post_id = get_the_ID(); 
        $url = rawurlencode(get_permalink());
        $title = rawurlencode(get_the_title());
	$excerpt = get_the_excerpt();

	?>
		<div class="entry-action">
		<!-- Show author name/avatar -->
		<span class="author-name"><?php echo get_avatar(get_the_author_email(), '24'); ?>  <?php the_author(); ?></span>
		<br>
		<!-- Show date -->
		<?php
			$metadata = wp_get_attachment_metadata();
			printf( __( '<span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span>', 'dw_focus' ),
				esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ));
		?>

		<?php
	            $tags_list = get_the_tag_list( '', __( ', ', 'dw_focus' ) );
	            if ( $tags_list ) :
	        ?>
	    	<div class="tag-action">
		    	<span class="title-action"><?php _e('Tags','dw_focus') ?></span>
		        <span class="tags-links">
		            <?php printf( __( '%1$s', 'dw_focus' ), $tags_list ); ?>
		        </span>
	        </div>
	        <?php endif; // End if $tags_list ?>
		
		<br>
		
		<div class="social-action" data-nonce="<?php echo wp_create_nonce( '_dw_sharing_count_nonce' ) ?>">
			<span class="title-action"><?php _e('Share This','dw_focus') ?></span>
			<ul>
					<li id="twitter-share" class="twitter" data-post-id="<?php echo $post_id ?>" data-nonce="<?php echo wp_create_nonce( '_dw_focus_single_tweet_count_nonce' ); ?>"><i class="icon-twitter"></i><a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&amp;text=<?php echo $title; ?>"><?php _e('Twitter','dw_focus') ?></a></li>
					<li class="facebook"><i class="icon-facebook-sign"></i><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&amp;t=<?php echo $title; ?>" ><?php _e('Facebook','dw_focus') ?></a></li>
					<li class="google"><i class="icon-google-plus-sign"></i><a href="https://plus.google.com/share?url=<?php echo $url; ?>" ><?php _e('Google +','dw_focus') ?></a></li>
					<li class="linkedin"><i class="icon-linkedin-sign"></i><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url ?>&amp;title=<?php echo $title ?>&amp;summary=<?php echo $excerpt ?>"><?php _e('Linkedin','dw_focus') ?></a></li>
					<li class="email"><i class="icon-envelope-alt"></i><a href="mailto:?Subject=<?php echo $title; ?>&body=<?php echo $excerpt ?>%0A%0A<?php echo $url; ?>"><?php _e('Email this article', 'dw_focus' ); ?></a></li>

                    <?php if( ! is_handheld() ) { ?>
					<li class="print"><i class="icon-print"></i><a href="javascript:window.print();"><?php _e('Print this article','dw_focus'); ?></a></li>
                    <?php } ?>
				</ul>
			</div>
		</div>
	<?php }
endif;



if( ! function_exists('dw_focus_post_format_icons') ) :
	/**
	 * Display Post Format icon
	 */
	function dw_focus_post_format_icons($widget = false) {
		if( has_post_format( 'video' ) ) {
			$class = 'icon-facetime-video';
		} elseif( has_post_format( 'audio' ) ) {
			$class = 'icon-music';
		} elseif( has_post_format( 'gallery' ) ) {
			$class = 'icon-picture';
		} else {
			$class = 'icon-file-alt';
		}
		if( $widget ) {

			if( dw_focus_sidebar_has_widget( 'dw_focus_bottom', $widget->id ) ) { 
				$class .= ' icon-play';
			}
		}

		$icon = '<i class="icon-post-format '.$class.'"></i>';
		return $icon;
	}
endif;

if( ! function_exists('dw_focus_post_views') ) { 
    /**
     * Views count for a single post
     */
    function dw_focus_post_views() {
        if( is_single() ){
            global $post;
            $view = get_post_meta($post->ID, '_views', true);
            $view = $view ? $view+1 : 1;
            update_post_meta($post->ID, '_views', $view);

            echo '<meta property="og:title" content="'.get_the_title().'" />';
            echo '<meta property="og:url" content="'.get_permalink().'" />';
            if( has_post_thumbnail() ) {
                $thumb_id = get_post_thumbnail_id();
                $thumb = wp_get_attachment_thumb_url( $thumb_id );
                echo '<meta property="og:image" content="'.$thumb.'" />';   
            }
            echo '<meta property="og:description" content="'.get_the_excerpt().'"/>';
        }
    }
    add_action('wp_head', 'dw_focus_post_views');
}

/**
 *	Improve Search Results Page
 */

// Highlight search term
function search_excerpt_highlight() {
	$excerpt = get_the_excerpt();
	$keys = implode('|', explode(' ', get_search_query()));
	$excerpt = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $excerpt);
	echo '<p>' . $excerpt . '</p>';
}

function search_title_highlight() {
	$title = get_the_title();
	$keys = implode('|', explode(' ', get_search_query()));
	$title = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $title);
	echo $title;
}

// Exclude Pages from Search
function dw_exclude_pages_from_search() {
	global $wp_post_types;
	$wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'dw_exclude_pages_from_search');



if( ! function_exists('dw_gallery_shortcode') ) {
    /**
     * The Gallery shortcode.
     *
     * This implements the functionality of the Gallery Shortcode for displaying
     * WordPress images on a post.
     *
     * @since 1.0.0
     *
     * @param array $attr Attributes of the shortcode.
     * @return string HTML content to display gallery.
     */
    function dw_gallery_shortcode($attr) {
        $post = get_post();

        static $instance = 0;
        $instance++;

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }

        // Allow plugins/themes to override the default gallery template.
        $output = apply_filters('post_gallery', '', $attr);
        if ( $output != '' )
            return $output;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post->ID,
            'itemtag'    => 'li',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => ''
        ), $attr));

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }
        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';
        $size_class = sanitize_html_class( $size );

        $gid = rand(1,15);
        $carousel_div = "<div id='gallery-{$id}{$gid}' class='gallery carousel slide'> <div class='carousel-inner' data-interval='7000'>";
        $output .= apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $carousel_div );

        $i = 0;
        $thumbnails = array();
        foreach ( $attachments as $img_id => $attachment ) {
            $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($img_id, $size, false, false) : wp_get_attachment_link($img_id, $size, true, false);
            $full_url= wp_get_attachment_image_src( $img_id,'full');
            $thumb_url= wp_get_attachment_image_src( $img_id, $size );
            $thumbnails[] = $thumb_url;

            $output .= "<div class='item";
            if( $i == 0 ) {
                $output .= ' active';
                $i++;
            }
            $output .= "'>";
            $output .= "<img src='".$full_url[0]."' />";
            $output .= "</div>";
        }
        $output .= " </div>";

        $output .= '<div class="carousel-nav"><ul></ul></div>';

        //Carousel nav
        $output .= '<a class="carousel-control left" href="#gallery-'.$id.$gid.'" data-slide="prev"><i class="icon-chevron-left"></i></a>
        <a class="carousel-control right" href="#gallery-'.$id.$gid.'" data-slide="next"><i class="icon-chevron-right"></i></a>';
        $output .= "</div>";
        return $output;
    }
    remove_shortcode('gallery', 'gallery_shortcode');
    add_shortcode('gallery', 'dw_gallery_shortcode');
}

if( ! function_exists('dw_focus_add_layout_class') ) { 
    function dw_focus_add_layout_class($classes){
    	if( ! is_active_sidebar( 'dw_focus_home' ) 
                && is_page_template( 'Blog' ) ) {
        	$classes[] = 'template-blog';
        }
        $classes[] = ot_get_option('dw_layout');

        return $classes;
    }
    add_filter( 'body_class', 'dw_focus_add_layout_class' );
}   

if( ! function_exists('dw_focus_sidebar_has_widget') ) {
    /**
     * Check if the specify sidebar have widget 
     * @param  string $sidebar_name
     * @param  string $widget_id    widget html id
     * @return boolean
     */
    function dw_focus_sidebar_has_widget( $sidebar_name, $widget_id ){
        $sidebars_widgets = wp_get_sidebars_widgets();

        if( isset($sidebars_widgets[$sidebar_name]) ) {
            if( in_array($widget_id, $sidebars_widgets[$sidebar_name]) ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

// Create new size thumbnail
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'slider-thumb', 520, 400, true ); //(cropped)
}


// Add parent class for menu
if( ! function_exists('dw_focus_add_menu_parent_class') ) {
	add_filter( 'wp_nav_menu_objects', 'dw_focus_add_menu_parent_class' );
	function dw_focus_add_menu_parent_class( $items ) {
		
		$parents = array();
		foreach ( $items as $item ) {
			if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
				$parents[] = $item->menu_item_parent;
			}
		}
		
		foreach ( $items as $item ) {
			if ( in_array( $item->ID, $parents ) ) {
				$item->classes[] = 'menu-parent-item'; 
			}
		}
		
		return $items;    
	}
}

/*---------------------------------------------------------------------------*/
/*	Apply Website Setup
/*---------------------------------------------------------------------------*/
if( ! function_exists('dw_script_header') ) {
    //Apply logo style
    function dw_script_header() {
        $logo_custom_image = ot_get_option('dw_logo_image', get_template_directory_uri().'/assets/img/logo.png');
        echo ot_get_option('dw_header_script');
    ?>
    <style type="text/css">
        .site-header #branding a {
            display: block;
            background: url(<?php echo $logo_custom_image; ?>) no-repeat center;
            text-indent: -9999px;
        }
    </style>
    <?php 
    }
    add_action( 'wp_head', 'dw_script_header' );
}

if( ! function_exists('dw_script_footer') ){
    //Apply footer custom script
    function dw_script_footer() {
        echo  ot_get_option('dw_footer_script','');
    }
    add_action( 'wp_footer', 'dw_script_footer' );
}

/**
 * Get active state for category listing
 */
function dw_active( $selected, $current = true, $echo = true ){
	if ( (string) $selected === (string) $current )
		$result = "active";
	else
		$result = '';

	if ( $echo )
		echo $result;

	return $result;
}

if( ! function_exists('dw_cat_filter') ) {
    /**
     * Make filter for listing style of category
     * @param  string $list_type Type of listing style of category page
     * @return string Listing style
     */
    function dw_cat_filter($list_type) {
        if ( isset($_COOKIE["cat_listing"]) ){
            $list_type = htmlentities( $_COOKIE["cat_listing"] );
        }
        return $list_type;
    }
    add_filter('cat_display_filter', 'dw_cat_filter');
}
if( ! function_exists('dw_top15') ) {
    /**
     * Get latest news of today or numbers of recent posts for megamenu if dont have any post on today
     */
    function dw_top15(){
        $display_type = ot_get_option('dw_menu_display_type');
        if( ! $display_type ) {
            $display_type = 'today';
        }
        $max_number_posts = ot_get_option('dw_menu_number_posts');
        if( ! $max_number_posts ) {
            $max_number_posts = 15;
        }

        $post_array = array( 
                'posts_per_page'        => $max_number_posts, 
                'order'                 => 'DESC',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1
            );

        $is_news_today = false;
        if( $display_type == 'today' ) {
            $is_news_today = true;
            add_filter( 'posts_where', 'dw_top15_filter_where' );
            $r = new WP_Query( $post_array );
            remove_filter( 'posts_where', 'dw_top15_filter_where' );
            if( $r->post_count <= 0 ) {
                $is_news_today = false;
                $r = new WP_Query( $post_array );
            }
        } else {
            $r = new WP_Query( $post_array );
        }
        ?>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="number"><?php echo $r->post_count; ?></span>
            <span><?php echo $display_type == 'today' && $is_news_today ? __('New Articles today','dw_focus') : __('Must read articles','dw_focus'); ?> <i class="icon-caret-down"></i></span>
        </a>
        <?php

        if ($r->have_posts()) :
            $i=0;
            ?>
            <div class="top-news-inner">
                <ul class="dropdown-menu">
                    <div class="entry-meta"><?php echo  date( get_option( 'date_format' ) ); ?></div>

                    <div class="row-fluid">
                        <ul>
            <?php 

            while ($r->have_posts()) :
                $r->the_post();

                $class = '';

                if(has_post_thumbnail()) 
                    {$class .= 'has-thumbnail';}

                if($i % 3 == 0)
                    {$class .= ' first';}
            ?>
                <li class="<?php echo $class ?>">
                    <div class="topnews-thumbnail"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(40,40)) ?></a></div>
                    <div class="topnews-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?> </a></div>
                </li>
            <?php 
                $i++;
                endwhile;
            ?>  
                        </ul>
                    </div>
                </ul>
            </div>
            <?php 

            wp_reset_postdata();
       endif;
    }
}

if( ! function_exists('dw_top15_filter_where') ) {
    // Create a new filtering function that will add our where clause to the query
    function dw_top15_filter_where( $where = '' ) {
        $where .= " AND post_date >= '".date('Y-m-d', strtotime('now') )."'";
        return $where;
    }
}
