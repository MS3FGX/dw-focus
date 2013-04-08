<?php
/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since DW Focus 1.0
 */
function dw_focus_widgets_init() {
    
    
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'dw_focus' ),
        'id' => 'dw_focus_sidebar',
        'description'   =>  __('Use to display widgets in secondary column','dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Category Sidebar', 'dw_focus' ),
        'id' => 'dw_focus_category_sidebar',
        'description'   =>  __('Use to display widgets in Category','dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Single Post Sidebar', 'dw_focus' ),
        'id' => 'dw_focus_single_post_sidebar',
        'description'   =>  __('Use to display widgets in Single Post','dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Home Content', 'dw_focus' ),
        'id' => 'dw_focus_home',
        'description'   =>  __('Use to display widgets in primary column of home','dw_focus'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="category-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Blog Sidebar', 'dw_focus' ),
        'id' => 'dw_focus_blog_sidebar',
        'description'   =>  __('Use to display widgets in Blog','dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Header', 'dw_focus' ),
        'id' => 'dw_focus_header',
        'description'   =>  __('Use to display widgets in header', 'dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s span3">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Under Navigation', 'dw_focus' ),
        'id' => 'dw_focus_under_navigation',
        'description'   =>  __('Use to display widgets under navigation', 'dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Bottom', 'dw_focus' ),
        'id' => 'dw_focus_bottom',
        'description'   =>  __('Use to display widgets under main content', 'dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Sidebar 1', 'dw_focus' ),
        'id' => 'dw_focus_footer_1',
        'description'   =>  __('Use to display widgets in footer', 'dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Sidebar 2', 'dw_focus' ),
        'id' => 'dw_focus_footer_2',
        'description'   =>  __('Use to display widgets in footer', 'dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Sidebar 3', 'dw_focus' ),
        'id' => 'dw_focus_footer_3',
        'description'   =>  __('Use to display widgets in footer', 'dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Sidebar 4', 'dw_focus' ),
        'id' => 'dw_focus_footer_4',
        'description'   =>  __('Use to display widgets in footer', 'dw_focus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    
}
add_action( 'widgets_init', 'dw_focus_widgets_init' );


/**
 * Create HTML dropdown list of Categories.
 *
 * @package WordPress
 * @since 2.1.0
 * @uses Walker
 */
class DW_Walker_CategoryDropdown extends Walker {
    /**
     * @see Walker::$tree_type
     * @since 2.1.0
     * @var string
     */
    var $tree_type = 'category';

    /**
     * @see Walker::$db_fields
     * @since 2.1.0
     * @todo Decouple this
     * @var array
     */
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    /**
     * @see Walker::start_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $category Category data object.
     * @param int $depth Depth of category. Used for padding.
     * @param array $args Uses 'selected' and 'show_count' keys, if they exist.
     */
    function start_el( &$output, $category, $depth, $args, $id = 0 ) {
        $pad = str_repeat('&#8211;', $depth * 2);

        $cat_name = apply_filters('list_cats', $category->name, $category);
        $output .= "\t<option class=\"level-$depth\" value=\"".$category->term_id."\"";
        if ( $category->term_id == $args['selected'] )
            $output .= ' selected="selected"';
        $output .= '>';
        $output .= $pad.$cat_name;
        if ( $args['show_count'] )
            $output .= '&nbsp;&nbsp;('. $category->count .')';
        $output .= "</option>\n";
    }
}


?>