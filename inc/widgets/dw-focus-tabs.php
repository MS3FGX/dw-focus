<?php  
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class dw_focus_tabs_Widget extends dw_focus_dynamic_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function dw_focus_tabs_Widget() {
        $widget_ops = array( 'classname' => 'dw_focus_tabs news-tab', 'description' => __('Display widgets inside a tab','dw_focus') );
        $this->WP_Widget( 'dw_focus_tabs', 'DW Focus: Tabs', $widget_ops );
    }

    function dw_display_widgets_front($instance){
        global $wp_registered_widget_updates;
        wp_parse_args($instance, array(
          'widgets' => array()
        ));
        
        $widgets = explode(':dw-data:', $instance['widgets'] );
        if( !empty($widgets) && is_array($widgets) ){ ?>
          <div class="nav-tab-select-wrap">
            <select name="nav-tabs-<?php echo $this->id ?>" class="nav-tabs-by-select visible-phone" >
              <?php
                $i = 0;
                foreach ($widgets as $widget ) {
                  $selected = '';
                  if( $i == 0 ){ $active='selected="selected"'; }
                  $i++;
                  if( !empty( $widget ) ) {
                    $url = rawurldecode($widget);
                    parse_str($url,$s);
                    $instance = !empty($s['widget-'.$s['id_base']]) ? array_shift( $s['widget-'.$s['id_base']] ) : array();

                    $widget = $this->dw_get_widgets( $s['id_base'], $i );
                    // $widget = isset( $wp_registered_widget_updates[$s['id_base']] ) ? $wp_registered_widget_updates[$s['id_base']]['callback'][0] : false;

                    if( $widget ) {
                      $widget_title = isset($instance['title']) ? $instance['title'] : $widget->name;
                      echo '<option data-target="#'.$s['widget-id'].'" '.$selected.' value="#'.$s['widget-id'].'" >'.strtoupper( $widget_title ).'</option>';
                    }
                  }
                }
              ?>
            </select>
          </div>
          <ul class="nav nav-tabs hidden-phone" id="nav-tabs-<?php echo $this->id ?>">
          <?php
          $i = 0;
          foreach ($widgets as $widget ) {
            $active = '';
            if( $i == 0 ){ $active='active'; } 
            $i++;
            if( !empty( $widget ) ) {
              $url = rawurldecode($widget);
              parse_str($widget,$s);
              $instance = !empty($s['widget-'.$s['id_base']]) ? array_shift( $s['widget-'.$s['id_base']] ) : array();

              $widget = $this->dw_get_widgets( $s['id_base'], $i );
              // $widget = isset( $wp_registered_widget_updates[$s['id_base']] ) ? $wp_registered_widget_updates[$s['id_base']]['callback'][0] : false;
              if( $widget ) {
                $widget_title = isset($instance['title']) ? $instance['title'] : $widget->name;
                echo '<li class="'.$active.'"><a href="#'.$s['widget-id'].'" data-toggle="tab">'.$widget_title.'</a></li>';
              }
            }
          }
          ?>
          </ul>
          <div class="tab-content">
            <?php
              $i=0;
              foreach ($widgets as $widget) {
                $active = '';
                if( $i == 0 ) { $active='active'; }
                 $i++;
                  if( !empty( $widget ) ) {
                    $url = rawurldecode($widget);
                    parse_str($widget,$s);
                    $instance = isset($s['widget-'.$s['id_base']]) ? array_shift( $s['widget-'.$s['id_base']] ) : array();

                    $widget = $this->dw_get_widgets( $s['id_base'], $i );
                    // $widget = isset( $wp_registered_widget_updates[$s['id_base']] ) ? $wp_registered_widget_updates[$s['id_base']]['callback'][0] : false;

                    if( isset($s['id_base'] ) && $widget ) {
                      $widget_options = $widget->widget_options; 
                    ?>
                      <div class="tab-pane <?php echo 'widget_'.$s['widget-id'].' '.$widget_options['classname'] ?> <?php echo $active ?>" id="<?php echo $s['widget-id'] ?>">
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
                    <?php
                    }
                  }
                }
              } 
            ?>
          </div>
      <?php
      }
}

add_action( 'widgets_init', create_function( '', "register_widget('dw_focus_tabs_Widget');" ) );

?>