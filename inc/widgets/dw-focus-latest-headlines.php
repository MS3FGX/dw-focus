<?php  
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class dw_focus_latest_headlines extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'dw_focus_headlines', 'description' => __( 'Display latest news as a headline scroll', 'dw_focus') );
        parent::__construct('dw_focus_news_headlines', __('DW Focus: Headlines', 'dw_focus' ), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_dw_focus_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'dw_focus' ) : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;
        $interval = isset($instance['interval']) ? $instance['interval'] : 5;
        $tax_query=array();
       
        $r = new WP_Query( apply_filters( 'widget_posts_args', 
            array( 
                'posts_per_page'    => $number, 
                'no_found_rows'         => true, 
                'post_status'           => 'publish', 
                'cat'              => $instance['category']       
            ) ) );

          if ($r->have_posts()) :
            $i = 0; //Dectect first post
?>
        
        <?php echo $before_widget; ?>
        <?php echo $before_title . $title . $after_title; ?>
        <div class="headlines" data-interval="<?php echo ($interval>0)?$interval*1000:'false'; ?>">
            <ul>
            <?php  
                $i = 0;
                while ( $r->have_posts() ) {
                    $r->the_post();
            ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="time_diff"><?php echo ' - ' . human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span></li>
            <?php } ?>     
            </ul>
        </div>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['interval'] = $new_instance['interval'];
        $instance['category'] = (int) $new_instance['category'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $interval = isset($instance['interval']) ? $instance['interval'] : 5;
        $category = isset($instance['category']) ? absint($instance['category']) : 0;
   
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dw_focus'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:','dw_focus'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        <p><label for="<?php echo $this->get_field_id('interval'); ?>"><?php _e('Interval time (0 for disabled):','dw_focus'); ?></label>
        <input id="<?php echo $this->get_field_id('interval'); ?>" name="<?php echo $this->get_field_name('interval'); ?>" type="text" value="<?php echo $interval; ?>" size="3" /></p>
        <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:','dw_focus'); ?></label><br>
            <?php wp_dropdown_categories(array(
                'show_option_all'   =>  'All categories',
                'hide_empty'        =>  0,
                'id'                =>  $this->get_field_id('category'),
                'name'              =>  $this->get_field_name('category'),
                'selected'          =>  $category,
                'class'             =>  'widefat',
                'hierarchical'         =>  true,
                'walker'            =>  new DW_Walker_CategoryDropdown()
            ) ); ?>
        </p>
         
<?php
    }
}

add_action( 'widgets_init', create_function( '', "register_widget('dw_focus_latest_headlines');" ) );
?>