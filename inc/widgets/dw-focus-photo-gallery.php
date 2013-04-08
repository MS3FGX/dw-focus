<?php
/**
 *  Show a photo gallery from specify category
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class dw_focus_recent_flickr_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function dw_focus_recent_flickr_Widget() {
        $widget_ops = array( 'classname' => 'dw-focus-photo-gallery', 'description' => __('Include a gallery','dw_focus') );
        $this->WP_Widget( 'dw-focus-photo-gallery', __('DW Focus: Photo gallery','dw_focus'), $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $instance = wp_parse_args( (array) $instance, array( 
                'title' => htmlentities(__('<span class="title-blue">flick</span><span class="title-red">r</span> widget','dw_focus')), 
                'column' => 2, 
                'row' => 2 ) 
        );
        extract($instance);


        echo $before_widget;
        echo '<h2 class="widget-title">';
        echo html_entity_decode($title);
        echo '</h2>';

        $number = $column * $row;

        $args = array(
            'numberposts'       =>  $number,
            'cat__in'          =>  $category,
            'post_status'       =>  'publish'
        );
        $posts =  new WP_Query($args);
        if(  $posts->have_posts() ){
            echo '<ul class="dw-focus-photo-gallery clearfix">';
            $i = -1;
            while( $posts->have_posts() ) { $posts->the_post();
                
                if( ! has_post_thumbnail() ) { 
                    continue; 
                }

                $i++;  $class = '';
                if( $i == 0 || $i % 4 == 0){
                    $class .= ' first';
                } else if( $i == $number ){
                    $class .= ' last';
                }

                if( $i % 2 == 0 ){
                    $class .= ' even';
                } else {
                    $class .= ' odd';
                }

                echo '<li class="'.$class.'"><a title="'.get_the_title().'" href="'.get_permalink().'">';
                the_post_thumbnail('thumbnail');
                
                echo '</a></li>';
            }
            echo '</ul>';
        }

        echo $after_widget;
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {
        if ( current_user_can('unfiltered_html') )
            $new_instance['title'] =  $new_instance['title'];
        else
            $new_instance['title'] = trim( stripslashes( wp_filter_post_kses( addslashes($new_instance['title']) ) ) ); // wp_filter_post_kses() expects slashed
        return $new_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 
            'title' => __('Photo','dw_focus'), 
            'row' => 2, 
            'category'  => 0
            ) 
        );
        $title = esc_html($instance['title']);
        ?> 
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget titlte', 'dw_focus') ?></label>
        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" class="widefat" value="<?php echo trim( $instance['title'] ); ?>" >
        </p>

        <p><label for="<?php echo $this->get_field_id('row'); ?>"><?php  _e('Widget row','dw_focus'); ?></label>
        <input class="widefat" type="text" name="<?php echo $this->get_field_name('row'); ?>" id="<?php echo $this->get_field_id('row') ?>" value="<?php echo $instance['row'] ?>"  >   </p>

        <div class="categories-checklist-container">
            <p>
                <label for="<?php echo $this->get_field_id('category'); ?>">
                    <?php _e('Current categories: ','dw_focus') ?><span class="description">
                        <?php 
                            if( ! empty($instance['category']) && is_array($instance['category']) ) {
                                foreach ( $instance['category'] as $cat ) {
                                    $cat_obj = get_category( $cat );
                                    echo $cat_obj->name.', ';
                                } 
                            }
                        ?>
                    </span><br>
                    <span class="widefat category-pseudo-select">&nbsp;&nbsp;<?php _e('Select Categories','dw_focus') ?></span> 
                </label>
            </p>
            <ul class="categories-checklist">
                <?php 
                    $walker = new DW_Walker_Category_Checklist( $this->get_field_name('category') );

                    wp_category_checklist( 0, 0, $instance['category'], false, 
                                $walker, false );
                ?>
            </ul>
        </div>
    <?php
    }

    /**
     * Get all authors in your page
     * @return array return an array of value-pair( ID - Name ) of all author
     */
    function get_list_author(){
        $auhor = array();
        $users = get_users();
        foreach ($users as $user) {
            $author[$user->ID] = $user->user_login;
        }
        return $author;
    }
}
add_action( 'widgets_init', create_function( '', "register_widget('dw_focus_recent_flickr_Widget');" ) );

/** Walker for categories checklist */
class DW_Walker_Category_Checklist extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id'); //TODO: decouple this
    var $name = '';

    public function __construct( $name = '' ){
        $this->name = $name;
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el( &$output, $category, $depth, $args, $id = 0 ) {
        extract($args);
        
        if ( empty($taxonomy) )
            $taxonomy = 'category';
        if(  ! $this->name ) {
            if ( $taxonomy == 'category' )
                $name = 'post_category';
            else
                $name = 'tax_input['.$taxonomy.']';
        } else {
            $name = $this->name;
        }

        $class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
        $indent = str_repeat("&nbsp;&nbsp;", $depth*2);
        $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>$indent" . '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
    }

    function end_el( &$output, $category, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}
