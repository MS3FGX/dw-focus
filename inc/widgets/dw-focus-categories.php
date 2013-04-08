<?php  

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class dw_focus_categories_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function dw_focus_categories_Widget() {
        $widget_ops = array( 'classname' => 'dw_focus_categories news-category', 'description' => __('Display News from Category', 'dw_focus') );
        $this->WP_Widget( 'dw_focus_news_by_category', 'DW Focus: Category', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract($args,EXTR_SKIP);
        $instance = wp_parse_args( $instance, 
            array( 
                'news-block-category-number'    =>  10,
                'news-block-style'              =>  'full',
                'news-block-category-first'     =>  0,
                'news-block-category-second'    =>  0,
                'news-block-category-third'     =>  0,
                'meta'                          =>  false,
                'cat'                          =>  false,
                'date'                          =>  false,
                'author'                          =>  false
            ) 
        );
        $number = $instance['news-block-category-number'] ? $instance['news-block-category-number'] : 5;

        if( 'full' == $instance['news-block-style'] ) {
            // Display categories width full width style
            $this->dw_focus_display_as_fullwidth($args, $number, $instance['news-block-category-first'], $instance);
        } else {

            echo $before_widget;
            echo '<div class="row-fluid grid3">';
            if( $instance['news-block-category-first'] ) {
                $this->dw_focus_template_1col($args, $number, $instance['news-block-category-first'], $instance);
            }
            if( $instance['news-block-category-second'] ) {
                $this->dw_focus_template_1col($args, $number, $instance['news-block-category-second'], $instance);
            }
            if( $instance['news-block-category-third'] ) {
                $this->dw_focus_template_1col($args, $number, $instance['news-block-category-third'], $instance);
            }
            echo '</div>';
            echo $after_widget;
        }
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
        // update logic goes here
        $new_instance['meta'] = $new_instance['meta'] ? true : false;
        $new_instance['date'] = $new_instance['date'] ? true : false;
        $new_instance['author'] = $new_instance['author'] ? true : false;
        $new_instance['cat'] = $new_instance['cat'] ? true : false;
        $updated_instance = $new_instance;

        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        $instance = wp_parse_args( $instance, 
            array( 
                'news-block-category-number'    =>  10,
                'news-block-style'              =>  'full',
                'news-block-category-first'     =>  0,
                'news-block-category-second'    =>  0,
                'news-block-category-third'     =>  0,
                'meta'                          =>  false,
                'cat'                          =>  false,
                'date'                          =>  false,
                'author'                          =>  false
            ) 
        );
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('news-block-category-number'); ?>"><?php _e('Number of post','dw_focus'); ?>
                <input type="text" name="<?php echo $this->get_field_name('news-block-category-number') ?>" id="<?php echo $this->get_field_id('news-block-category-number') ?>" class="widefat" value="<?php echo $instance['news-block-category-number'] ?>" >
            </label>
        </p>
        <!-- Meta info -->
        <div class="meta-info">
            <p>
                <label for="<?php echo $this->get_field_id('meta'); ?>" ><input type="checkbox" name="<?php echo $this->get_field_name('meta') ?>" id="<?php echo $this->get_field_id('meta'); ?>" <?php checked(true, $instance['meta']); ?> class="recent-post-meta-info" >&nbsp;&nbsp;<?php  _e('Show the meta infomation of post','dw-focus') ?> </label>
            </p>
            <p> --
                <label for="<?php echo $this->get_field_id('date'); ?>" ><input type="checkbox" <?php disabled( false,  $instance['meta'] ); ?> name="<?php echo $this->get_field_name('date') ?>" id="<?php echo $this->get_field_id('date'); ?>" <?php checked(true, $instance['date']); ?> class="submeta-info" >&nbsp;&nbsp;<?php  _e('Show the date of post','dw-focus') ?> </label>
            </p>
            <p> --
                <label for="<?php echo $this->get_field_id('author'); ?>" ><input type="checkbox" <?php disabled( false, $instance['meta'] ); ?> name="<?php echo $this->get_field_name('author') ?>" id="<?php echo $this->get_field_id('author'); ?>" <?php checked(true, $instance['author']); ?> class="submeta-info" >&nbsp;&nbsp;<?php  _e('Show the author info','dw-focus') ?> </label>
            </p>
            <p> --
                <label for="<?php echo $this->get_field_id('cat'); ?>" ><input type="checkbox" <?php disabled( false,  $instance['meta'] ); ?> name="<?php echo $this->get_field_name('cat') ?>" id="<?php echo $this->get_field_id('cat'); ?>" <?php checked(true, $instance['cat']); ?> class="submeta-info" >&nbsp;&nbsp;<?php  _e('Show the category info','dw-focus') ?> </label>
            </p>
        </div>
        <p><?php _e('Choose style for block category','dw_focus'); ?></p>
        <p><label><input <?php checked($instance['news-block-style'], 'full'); ?> type="radio" name="<?php echo $this->get_field_name('news-block-style') ?>" id="<?php echo $this->get_field_id('news-block-style') ?>" value="full" class="dw-focus-category-display-type"> <?php _e('full width','dw_focus') ?></label><br>
            <label> <input <?php checked($instance['news-block-style'], '3cols'); ?> type="radio" name="<?php echo $this->get_field_name('news-block-style') ?>" id="<?php echo $this->get_field_id('news-block-style') ?>" value="3cols" class="dw-focus-category-display-type"> <?php _e('3 cols','dw_focus') ?></label><br>
        </p>
        <?php 
            $class_extend = '';
            if( 'full' == $instance['news-block-style'] ){
                $class_extend = 'hide';
            }
        ?>
        <div class="categories_extend <?php echo $class_extend ?>">
        <?php echo '<strong> First Block </strong>'; ?>
        </div>
    <?php
        echo '<p>'.__('Select categories for showing content','dw_focus').'</p>';

        wp_dropdown_categories( array(
            'id'    => $this->get_field_id('news-block-category-first'),
            'name'    => $this->get_field_name('news-block-category-first'),
            'hide_empty' => 0,
            'selected'  =>  $instance['news-block-category-first'],
            'class' =>  'widefat',
            'hierarchical'  => true,
            'walker'    => new DW_Walker_CategoryDropdown()
        ) ); 

        echo '<div class="categories_extend '.$class_extend.'">';
        echo '<strong> Second Block </strong>';
        wp_dropdown_categories( array(
            'id'    => $this->get_field_id('news-block-category-second'),
            'name'    => $this->get_field_name('news-block-category-second'),
            'hide_empty' => 0,
            'selected'  =>  $instance['news-block-category-second'],
            'class' =>  'widefat',
            'hierarchical'  => true,
            'walker'    => new DW_Walker_CategoryDropdown()
        ) );
        echo '</div>';
        
        echo '<div class="categories_extend '.$class_extend.'">';
        echo '<strong> Third Block </strong>';
        wp_dropdown_categories( array(
            'id'    => $this->get_field_id('news-block-category-third'),
            'name'    => $this->get_field_name('news-block-category-third'),
            'hide_empty' => 0,
            'selected'  =>  $instance['news-block-category-third'],
            'class' =>  'widefat',
            'hierarchical'  => true,
            'walker'    => new DW_Walker_CategoryDropdown()
        ) );
        echo '</div>';
    }


    function dw_focus_display_as_fullwidth($args,$number, $category_id, $instance ){
        extract( $args, EXTR_SKIP );
        $category = get_category($category_id);
        if( empty($category) || is_wp_error($category) ) {
            $category_name = __('All','dw_focus');
        }else{
            $category_name = $category->name;
        }

        $category_link = get_category_link($category_id);
      //Get child categories
        $childs = get_categories(array(
            'hide_empty'    =>  0,
            'parent'        =>  $category_id
        ) );

        $catarr = array($category_id);
        echo $before_widget;
        $category_options = dw_get_category_option( $category_id );
        $color_class = '';
        if( $category_options['style'] ) {
            $color_class .= ' color-'.$category_options['style'];
        }
        echo "<h3 class='category-title {$color_class}'><a class='tab_title active' href='".get_category_link($category_id)."'>$category_name</a></h3>"; ?>

        
        <?php  if( !empty($childs) ){ ?>
         <ul class="child-category hidden-phone">
            <li><a href="" class="tab_title active" data-catid="<?php  echo $category_id; ?>" href="<?php echo $category_link ?>"><?php _e('All','dw_focus') ?></a></li>
            <?php foreach ($childs as $child) { ?>
                <li><a class='tab_title' data-catid="<?php  echo $child->term_id; ?>" href="<?php echo get_category_link($child->term_id) ?>"><?php echo $child->name ?></a></li>
            <?php 
                $catarr[] = $child->term_id;
            } ?>
        </ul> 
        <select name="child-category-select-box" id="child-category-for-category-<?php echo $category_id; ?>" class="child-category child-category-select visible-phone">
            <option value="<?php echo $category_id; ?>"><?php _e('-- All --','dw-focus'); ?></option>
            <?php foreach ($childs as $child) { ?>
                <option value="<?php echo $child->term_id; ?>" ><?php echo $child->name ?></option>
            <?php 
            } ?>
        </select>
        <?php } 
        
        foreach ($catarr as $catID) {
        
        $posts = new WP_Query( apply_filters( 'widget_dw_focus_categories_Widget', 
            array(
                'post_type'         =>  'post',
                'post_status'       =>  'publish',
                'cat'      =>  $catID,
                'posts_per_page'    =>  $number
            ) ) 
        );
        ?>
        <div class="row-fluid cat-<?php echo $catID;?> <?php echo ($catID==$category_id)?'active':''; ?>">
        <?php
        if( $posts->have_posts() ){

            $i = 0;
            if( $i == 0 ){ $posts->the_post(); $i++;
                $post_class = '';
                if(has_post_thumbnail()) $post_class = 'has-thumbnail';
            ?>
            <div class="span6">
                <article <?php post_class($post_class); ?>>
                    <?php if( has_post_thumbnail( get_the_ID() ) ) { ?>
                    <div class="entry-thumbnail">
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail('thumbnail'); ?></a>
                    </div>
                    <?php } ?>

                    <?php if( isset( $instance['meta'] ) && $instance['meta'] ) { ?>
                        <p class="entry-meta">
                        <?php 
                            if( isset( $instance['date'] ) && $instance['date'] ) { 
                                echo dw_focus_time_stamp( get_the_date() );
                            }
                        ?>
                        </p>
                    <?php } ?>


                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                    <div class="entry-content"><?php the_excerpt();  ?></div>
                </article>
            </div> 
            <?php }  ?>

            <div class="span6">
                <ul class="other-entry">
                <?php  
                    while( $posts->have_posts() ) { $posts->the_post();
                ?>
                    <li><h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2></li>
                <?php } ?>
                </ul>
            </div>
        <?php } else { 
                get_template_part( 'no-results' ); 
            } ?>
        </div>
        <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();
        }//end foreach cat 
         echo $after_widget;
    }

    function dw_focus_template_1col($args, $number, $category_id, $instance){
        extract( $args, EXTR_SKIP );
        $category = get_category($category_id);
        $category_link = get_category_link($category_id);

        $posts = new WP_Query( apply_filters('widget_dw_focus_categories_Widget', 
            array(
                'posts_per_page'        =>  $number,
                'cat'          =>  $category_id,
                'post_type'             =>  'post',
                'post_status'           =>  'publish'
            )
        ) );

        echo '<div class="span4">';

        $category_options = dw_get_category_option( $category_id );
        $color_class = '';
        if( $category_options['style'] ) {
            $color_class .= ' color-'.$category_options['style'];
        }
        echo "<h3 class='category-title {$color_class}'><a class='tab_title active' data-catid='$category_id' href='{$category_link}'>{$category->name}</a></h3>";
        
        if( $posts->have_posts() ){
            $i = 0;
            if( $i == 0 ){ $posts->the_post(); $i++;
            $class = 'first';
            if( has_post_thumbnail(get_the_ID()) ){
                $class .= ' has-thumbnail';
            }
        ?>
        <article <?php post_class($class); ?>>
            <?php if( has_post_thumbnail(get_the_ID()) ){ ?>
            <div class="entry-thumbnail">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                    <?php the_post_thumbnail('medium'); ?>
                </a>
            </div>
            <?php } ?>

            <?php if( isset( $instance['meta'] ) && $instance['meta'] ) { ?>
                <p class="entry-meta">
                <?php 
                    if( isset( $instance['date'] ) && $instance['date'] ) { 
                        echo dw_focus_time_stamp( get_the_date() );
                    }
                ?>
                </p>
            <?php } ?>


            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
            
            <div class="entry-content"><?php the_excerpt();  ?></div>
        </article>
        <?php } ?>

        <ul class="other-entry">
            <?php while ( $posts->have_posts() ) { $posts->the_post(); ?>
            <li><h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'dw_focus' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2></li>
            <?php } ?>
        </ul>

    <?php
        } else {
            get_template_part( 'no-results' );
        }

        echo '</div>';
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

       
    }
}

add_action( 'widgets_init', create_function( '', "register_widget('dw_focus_categories_Widget');" ) );
?>