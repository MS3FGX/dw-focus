<?php  
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class dw_focus_top_posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'dw_focus_top_posts news-slider', 'description' => __( 'Display News as a Slider', 'dw_focus' ) );
        parent::__construct('dw_focus_news_slider', __( 'DW Focus: News Slider', 'dw_focus' ), $widget_ops);
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

        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;

        $interval = isset($instance['interval']) ? $instance['interval'] : 0;

        $r = new WP_Query( apply_filters( 'widget_posts_args', 
            array( 
                'posts_per_page'    => $number, 
                'no_found_rows'         => true, 
                'post_status'           => 'publish', 
                'ignore_sticky_posts'   => true,
                'cat'              => $instance['category'],
                'meta_query' => array(array('key' => '_thumbnail_id')) 
            ) ) );
        if ($r->have_posts()) :
            $i = 0; //Dectect first post
?>
        
        <?php echo $before_widget; ?>
            <div class="clearfix">
                <div id="top-stories-carousel-<?php echo $this->id; ?>" class="carousel slide" data-pause="hover" data-interval="<?php echo ($interval>0)?$interval*1000:'false'; ?>">
                    <div class="carousel-inner">
                        <?php  
                            $i = 0;
                            while ( $r->have_posts() ) {  $r->the_post();
                                $active = '';
                                if( $i == 0 ){ $active = 'active'; $i++; }
                        ?>
                        <div id="widget-post-<?php the_ID(); ?>" class="item <?php echo $active ?>">
                            <?php 
                                $class = '';
                                if( has_post_thumbnail(get_the_ID()) ) {
                                    $class .= 'has-thumbnail';
                                } 
                            ?>
                            <article <?php post_class($class); ?>>

                                <?php if( has_post_thumbnail(get_the_ID()) ){  ?>
                                <div class="entry-thumbnail">
                                    <?php 
                                        $category = get_the_category(); 
                                        if($category[0]){
                                        echo '<a class="entry-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                                        }
                                    ?>

                                    <?php the_post_thumbnail('slider-thumb');  ?>
                                </div>
                                <?php } ?>

                                <header class="entry-header">
                                    <div class="entry-header-inner">
                                    <?php if( isset( $instance['meta'] ) && $instance['meta'] ) { ?>
                                        <div class="entry-meta">
                                        <?php 
                                            if( isset( $instance['date'] ) && $instance['date'] ) { 
                                                echo dw_focus_time_stamp( get_the_date() );
                                            }
                                        ?>
                                        </div>
                                    <?php } ?>
                                    
                                    <h1 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                                        <?php the_title() ?></a>
                                    </h1>
                                    </div>
                                </header>
                            </article>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <a data-slide="prev" href="#top-stories-carousel-<?php echo $this->id; ?>" class="left carousel-control hidden-desktop"><i class="icon-chevron-left"></i></a>
                    <a data-slide="next" href="#top-stories-carousel-<?php echo $this->id; ?>" class="right carousel-control hidden-desktop"><i class="icon-chevron-right"></i></a>
                </div>
                <div class="carousel-list">
                    <?php 
                        if ( !empty( $title ) ) {
                            echo $before_title . $title . $after_title;
                        }
                    ?>
                    <ul class="other-entry">
                        <?php  
                            $i = 0;
                            while( $r->have_posts() ) { $r->the_post();
                                $active = '';
                                if( $i == 0 ){ $active = 'active'; }
                        ?>
                        <li class="<?php echo $active; ?>">
                            <h2><a data-slice="<?php echo $i; ?>" href="#top-store-<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
                        </li>
                        <?php $i++; } ?>
                    </ul>
                    <div class="carousel-nav"><ul></ul></div>
                </div>
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
        $instance['meta'] = isset($new_instance['meta']) ? true : false ;
        $instance['date'] = isset($new_instance['date']) ? true : false ;
        $instance['author'] = isset($new_instance['author']) ? true : false ;
        $instance['cat'] = isset($new_instance['cat']) ? true : false ;
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
        $meta = isset($instance['meta']) ? $instance['meta'] : 0;
        $date = isset($instance['date']) ? $instance['date'] : 0;
        $author = isset($instance['author']) ? $instance['author'] : 0;
        $cat = isset($instance['cat']) ? $instance['cat'] : 0;
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'dw_focus' ); ?></label>
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

        <!-- Meta info -->
        <div class="meta-info">
            <p>
                <label for="<?php echo $this->get_field_id('meta'); ?>" ><input type="checkbox" name="<?php echo $this->get_field_name('meta') ?>" id="<?php echo $this->get_field_id('meta'); ?>" <?php checked(true, $meta); ?> class="recent-post-meta-info" >&nbsp;&nbsp;<?php  _e('Show the meta infomation of post','dw-focus') ?> </label>
            </p>
            <p> --
                <label for="<?php echo $this->get_field_id('date'); ?>" ><input type="checkbox" <?php disabled( false,  $meta ); ?> name="<?php echo $this->get_field_name('date') ?>" id="<?php echo $this->get_field_id('date'); ?>" <?php checked(true, $date); ?> class="submeta-info" >&nbsp;&nbsp;<?php  _e('Show the date of post','dw-focus') ?> </label>
            </p>
            <p> --
                <label for="<?php echo $this->get_field_id('author'); ?>" ><input type="checkbox" <?php disabled( false,  $meta ); ?> name="<?php echo $this->get_field_name('author') ?>" id="<?php echo $this->get_field_id('author'); ?>" <?php checked(true, $author); ?> class="submeta-info" >&nbsp;&nbsp;<?php  _e('Show the author info','dw-focus') ?> </label>
            </p>
            <p> --
                <label for="<?php echo $this->get_field_id('cat'); ?>" ><input type="checkbox" <?php disabled( false,  $meta ); ?> name="<?php echo $this->get_field_name('cat') ?>" id="<?php echo $this->get_field_id('cat'); ?>" <?php checked(true, $cat); ?> class="submeta-info" >&nbsp;&nbsp;<?php  _e('Show the category info','dw-focus') ?> </label>
            </p>
        </div>
<?php
    }
}

add_action( 'widgets_init', create_function( '', "register_widget('dw_focus_top_posts');" ) );
?>