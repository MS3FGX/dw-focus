<?php  
class dw_focus_accordion_Widget extends dw_focus_dynamic_Widget {
    /**
     * Constructor
     *
     * @return void
     **/
    function dw_focus_accordion_Widget() {
        $widget_ops = array( 'classname' => 'dw_focus_accordion news-accordion', 'description' => __('Display widgets inside an accordion','dw_focus') );
        $this->WP_Widget( 'dw_focus_accordions', 'DW Focus: Accordion', $widget_ops );
    }


    function dw_display_widgets_front($instance){
        global $wp_registered_widget_updates;
        wp_parse_args($instance, array(
          'widgets' => array()
        ));

        $widgets = explode(':dw-data:', $instance['widgets'] );
        if( !empty($widgets) && is_array($widgets) ) {
          echo '<div class="accordion" id="accordion-'.$this->id.'">';

          $collapse = ''; $i = 0;
          foreach ($widgets as $widget) {
            $collapse = ( $i == 0 ) ? 'active' : 'collapsed';

            if( !empty( $widget ) ) {
              $url = rawurldecode($widget);
              parse_str($url,$s);
              $instance = !empty($s['widget-'.$s['id_base']]) ? array_shift( $s['widget-'.$s['id_base']] ) : array();

              $widget = $this->dw_get_widgets( $s['id_base'], $i );
              // $widget = isset($wp_registered_widget_updates[$s['id_base']]) ? $wp_registered_widget_updates[$s['id_base']]['callback'][0] : false;

              if( isset($s['id_base'] ) && $widget ){ ?>
                <?php $widget_options = $widget->widget_options; ?>
                <div class="accordion-group">
                  <div class="accordion-heading"><a class="accordion-toggle <?php echo $collapse ?>" data-toggle="collapse" data-parent="#accordion-<?php echo $this->id ?>" href="#<?php echo $this->id ?>-<?php echo $s['widget-id'] ?>"><?php echo ( isset($instance['title']) ) ? $instance['title'] : $widget->name; ?></a></div>
                  <div id="<?php echo $this->id ?>-<?php echo $s['widget-id'] ?>" class="<?php echo 'widget_'.$s['widget-id'].' ' ?> accordion-body collapse <?php echo $collapse == 'active' ? 'in' : ''; ?> <?php echo $widget_options['classname'] ?>">
                    <div class="accordion-inner">
                    <?php  
                    $default_args = array( 
                        'before_widget' => '', 
                        'after_widget' => '', 
                        'before_title' => '<h3 class="widget-title">', 
                        'after_title' => '</h3>' 
                    );
                    $widget->widget($default_args,$instance);
                    ?>
                    </div>
                  </div>
                </div>
              <?php
              }
            }
            $i++;
          }

          echo '</div>';
        }
      }
}

add_action( 'widgets_init', create_function( '', "register_widget('dw_focus_accordion_Widget');" ) );
?>