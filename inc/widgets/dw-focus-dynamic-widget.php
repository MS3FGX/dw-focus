<?php  
class dw_focus_dynamic_Widget extends WP_Widget {

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;
        $this->dw_display_widgets_front($instance);
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
        // update logic goes here
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
        global $wp_registered_widgets;

        /** WordPress Administration Widgets API */
        $instance = wp_parse_args( $instance, array( 
            'widgets'    =>  '',
            'title'     =>  ''
        ) );
    ?>
    <input type="hidden" name="<?php echo $this->get_field_name('widgets') ?>" id="<?php echo $this->get_field_id('widgets') ?>" value="<?php echo $instance['widgets'] ?>" >
    <div style="display:none">
        <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo $instance['title'] ?>" class="widefat" >  
    </div>
    <div class="dw-focus-widget-extends" data-setting="<?php echo $this->get_field_id('widgets') ?>" >
        <div class="sidebar-description">
            <p class="description"><?php _e('Drag & Drop widget that will be become a tab.','dw_focus') ?></p>
        </div>

    <?php
        $widgets = explode(':dw-data:', $instance['widgets'] );
        if( !empty($widgets) && is_array($widgets) ){
            foreach ($widgets as $widget) {
                if( !empty( $widget ) ) {
                    $url = rawurldecode($widget);
                    parse_str($url,$s);
                    $this->dw_display_widgets($s);
                }
            }
        }
    ?>    
    </div>
    <?php
    }

    function dw_display_widgets($s){
        global $wp_registered_widget_updates;
        $instance = !empty($s['widget-'.$s['id_base']]) ? array_shift( $s['widget-'.$s['id_base']] ) : array();
        $widget = $wp_registered_widget_updates[$s['id_base']]['callback'][0];
        
        ?>  
        <div id="<?php echo esc_attr($s['widget-id']); ?>" class="widget">
        <div class="widget-top">
        <div class="widget-title-action">
            <a class="widget-action hide-if-no-js" href="#available-widgets"></a>
            <a class="widget-control-edit hide-if-js" href="<?php echo esc_url( add_query_arg( $query_arg ) ); ?>">
                <span class="edit"><?php _ex( 'Edit', 'widget' ); ?></span>
                <span class="add"><?php _ex( 'Add', 'widget' ); ?></span>
                <span class="screen-reader-text"><?php echo $widget->name; ?></span>
            </a>
        </div>
        <div class="widget-title"><h4><?php echo $widget->name; ?><span class="in-widget-title"></span></h4></div>
        </div>

        <div class="widget-inside">
        <div class="widget-content">
    <?php
        if( isset($s['id_base'] ) ){
            $widget->form($instance);
        } else
            echo "\t\t<p>" . __('There are no options for this widget.','dw_focus') . "</p>\n"; ?>
        </div>
        <input type="hidden" name="widget-id" class="widget-id" value="<?php echo esc_attr($s['widget-id']); ?>" />
        <input type="hidden" name="id_base" class="id_base" value="<?php echo esc_attr($s['id_base']); ?>" />

        <div class="widget-control-actions">
            <div class="alignleft">
            <a class="widget-control-remove" href="#remove"><?php _e('Delete','dw_focus'); ?></a> |
            <a class="widget-control-close" href="#close"><?php _e('Close','dw_focus'); ?></a>
            </div>
            <div class="alignright widget-control-noform">
                <?php submit_button( __( 'Save', 'dw_focus' ), 'button-primary widget-control-save right', 'savewidget', false, array( 'id' => 'widget-' . esc_attr( $s['widget-id'] ) . '-savewidget' ) ); ?>
                <span class="spinner"></span>
            </div>
            <br class="clear" />
        </div>
        </div>

        <div class="widget-description">
    <?php echo ( $widget_description = wp_widget_description($widget_id) ) ? "$widget_description\n" : "$widget_title\n"; ?>
        </div>
        </div>
        <?php
    }
}
