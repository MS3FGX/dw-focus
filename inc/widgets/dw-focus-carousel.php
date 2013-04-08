<?php  
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class dw_focus_videos extends WP_Widget {

    function __construct() {
        
        $widget_ops = array('classname' => 'dw_focus_videos', 'description' => __( "Display News as a Carousel",'dw_focus') );
        parent::__construct('dw_focus_news_carousel', __('DW Focus: News Carousel','dw_focus'), $widget_ops);
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

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts','dw_focus') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;
        $interval = isset($instance['interval']) ? $instance['interval'] : 0;
        $tax_query=array();
        if(!empty($instance['post-format'])){
             $tax_query= array(
                            array(
                              'taxonomy' => 'post_format',
                             'field'    => 'slug',
                             'terms'    => array( 'post-format-'.$instance['post-format']),
                             'operator' => 'IN'
                            )
                          );
             }
        $r = new WP_Query( apply_filters( 'widget_posts_args', 
            array( 
                'posts_per_page'    => $number, 
                'no_found_rows'         => true, 
                'post_status'           => 'publish', 
                'ignore_sticky_posts'   => true,
                'category__in'              => $instance['category'],
                'tax_query' => $tax_query
            ) ) );

        
        

        if( is_mobile() || is_kindle() || is_samsung_galaxy_tab() || is_nexus() ){
            $col = 1; $row = 1;
            $size = 'large';
        } else {
            $col = 4; $row = 4;
            $size = 'medium';
        }

        if ($r->have_posts()) :
            $i = 0; //Dectect first post
?>
        
        <?php echo $before_widget; ?>
        <?php echo $before_title . $title . $after_title; ?>
        <div id="videos" class="carousel slide" data-pause="hover" data-interval="<?php echo ($interval>0)?$interval*1000:'false'; ?>">
            <div class="carousel-inner">
                <div class="active item">
                    <div class="row-fluid">
            <?php  
                $i = 0;
                while ( $r->have_posts() ) { $r->the_post();
            ?>

                    <?php
                        if( $i != 0 && $i % $col == 0 ) { 
                    ?>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row-fluid">
                    <?php } ?>
                            <?php  
                                $class = 'span3';
                                if( has_post_thumbnail( get_the_ID() ) ) {
                                    $class .= ' has-thumbnail';
                                }
                            ?>
                            <article <?php post_class($class); ?>>
                                <?php if( has_post_thumbnail(get_the_ID()) ) { ?>
                                <div class="entry-thumbnail">
                                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                                        <?php echo dw_focus_post_format_icons($this); ?>
                                        <?php the_post_thumbnail($size); ?>
                                    </a>
                                </div>
                                <?php } ?>
                                <h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php the_title(); ?></a></h2>
                                <div class="entry-meta">
                                    <time datetime="<?php echo get_post_time('c') ?>" class="entry-date"><?php echo get_post_time('d.m.Y') ?></time>
                                </div>
                            </article>
            <?php 
                    $i++;
                } ?>
                    </div>
                </div>
            </div>

            <a class="carousel-control left" href="#videos" data-slide="prev"><i class="icon-chevron-left"></i></a>
            <a class="carousel-control right" href="#videos" data-slide="next"><i class="icon-chevron-right"></i></a>
            <div class="carousel-nav"><ul></ul></div>
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
        $instance['post-format'] =  $new_instance['post-format'];
         
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
        $interval = isset($instance['interval']) ? $instance['interval'] : 0;
        $category = isset($instance['category']) ? absint($instance['category']) : 0;
        $post_format = isset($instance['post-format']) ? $instance['post-format'] : '';
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dw_focus'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:','dw_focus'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
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
         <p><label for="<?php echo $this->get_field_id('post-format'); ?>"><?php _e('Post Format:','dw_focus'); ?></label><br>
           <select class="widefat" name="<?php echo $this->get_field_name('post-format') ?>" id="<?php echo $this->get_field_id('post-format')  ?>">
                <option <?php selected($post_format, '') ?> value="">All</option>
                <option <?php selected($post_format, 'video') ?> value="video">Video</option>
                <option <?php selected($post_format, 'gallery') ?> value="gallery">Gallery</option>
                <option <?php selected($post_format, 'audio') ?> value="audio">Audio</option>
              
            </select>   
        </p>
<?php
    }
}

add_action( 'widgets_init', create_function( '', "register_widget('dw_focus_videos');" ) );
?>