<?php  
/**
 *  Add a poll for your site, result included in widget control (back-end)
 *  
 */

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class dw_focus_poll_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function dw_focus_poll_Widget() {
        $widget_ops = array( 'classname' => 'dw-focus-poll', 'description' => 'Add a poll for your site, result of this poll was included in widget control screen (back-end)' );
        $this->WP_Widget( 'dw-focus-poll', 'DW Focus: Poll', $widget_ops );

        add_action( 'init', array($this,'update_poll') );
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
            'title'      => '',
            'question'   => '',
            'choices'    => array(),
            'results'    => array(),
        ) );
        echo $before_widget;
        echo $before_title . $instance['title'] . $after_title;

        echo '<p>'.$instance['question'].'</p>';

        echo '<div class="dw-poll-choices"><form action="" method="post" name="dw-focus-poll-form" id="'.$this->id.'-form" >';
        wp_nonce_field( '_dw_focus_vote_for_poll_nonce' );
        echo '<input type="hidden" name="action" value="dw-focus-poll-vote" >';
        foreach ($instance['choices'] as $key => $choice ) {
            echo '<p><label for="'.$key.'"><input type="radio" name="'.$this->id.'" id="'.$key.'" value="'.$choice.'" >&nbsp;'.$choice.'</label></p>';
        }
        echo '<p><button type="submit">'.__('Vote','dw_focus').'</button></p>';
        echo '</form></div>';

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
        foreach ($new_instance['choices'] as $key => $choice ) {
            if( empty($choice) ) {
                unset($new_instance['choices'][$key]);
            }
        }
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
        $instance = wp_parse_args( (array) $instance, array( 
            'title'      => '',
            'question'   => '',
            'choices'    => array(),
            'results'    => array(),
        ) );

        echo '<div class="dw-focus-poll">';
        $vote_total = 0;
        foreach ( $instance['choices'] as $choice) {
            if( empty($choice) ) continue;
            $vote = 0;
            if( isset($instance['results'][$choice] ) 
                && $instance['results'][$choice] > 0 ) {
                $vote = $instance['results'][$choice];
                $vote_total += $vote;
            }
            ?>
            <input class="poll-result" type="hidden" name="<?php echo $this->get_field_name('results').'['.$choice.']' ?>" value="<?php echo $vote; ?>" >
            <?php
        }
        echo '<p>'.sprintf( __('This poll has <strong>%d</strong> %s' ),
            $vote_total,
            _n('vote','votes',$vote_total)
        ) . '</p>';

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title:','dw_focus') ?></label> 
            <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('question')  ?>"><?php _e('Question for poll ','dw_focus') ?></label>
            <input type="text" name="<?php echo $this->get_field_name('question') ?>" id="<?php echo $this->get_field_id('question') ?>" class="widefat" value="<?php echo $instance['question'] ?>">
        </p>
        <p><strong><?php _e('Making list of choices') ?></strong></p>
        <?php
        echo '<div class="poll-choices">';
        if( empty($instance['choices']) ) {
        ?>
        <p>
            <input type="text" name="<?php echo $this->get_field_name('choices') ?>[]" id="<?php echo $this->get_field_id('choices') ?>" class="widefat dw-focus-choice">
        </p>    
        <?php
        } else {
            foreach ($instance['choices'] as $key => $choice) {
                if( empty($choice) ) continue;
                $vote = 0;
                if( isset( $instance['results'][$choice] ) ){
                    $vote = $instance['results'][$choice]; 
                } 
            ?>
            <p>
                <input type="text" name="<?php echo $this->get_field_name('choices') ?>[]" id="<?php echo $this->get_field_id('choices') ?>-<?php echo $key; ?>" value="<?php echo $choice ?>" class="widefat dw-focus-choice">
                <span class="remove-link"><a href="javascript:void(0);" title="<?php _e('Remove this choice', 'dw_focus' ); ?>">&times;</a></span>
                <span class="vote-info">
                <strong class="vote-count"><?php echo $vote ?></strong><small class="vote-total">&nbsp;&#47;&nbsp;<?php echo $vote_total ?>&nbsp;<?php _e('Votes','dw_focus') ?></small></span>
            </p>
            <?php
            }
        
        }
        echo '</div>';
        echo '<p><a href="#" class="addmore-choice" title="'.__('Add new one of choice for poll','dw_focus').'">' . __('Add new choice','dw_focus').'</a></p>';
        echo '<p><button class="reset-results" type="button" title="'.__('Reset all results of this poll','dw_focus').'" >'.__('Reset','dw_focus').'</button></p>';
        echo '</div>';
    }


    function update_poll(){

        if( !isset($_POST['action']) 
                || $_POST['action'] != 'dw-focus-poll-vote' ) {
            return false;
        }
        if( !isset($_POST['_wpnonce']) || !wp_verify_nonce( $_POST['_wpnonce'], '_dw_focus_vote_for_poll_nonce' ) ) {
            return false;
        }

        if( !isset($_POST[$this->id]) || empty($_POST[$this->id]) ){
            return false;
        }

        $all_instances = $this->get_settings();

        if ( array_key_exists( $this->number, $all_instances ) ) {
            $instance = $all_instances[$this->number];

            // filters the widget's settings, return false to stop displaying the widget
            foreach ($instance['choices'] as $key => $choice) {
                if( !isset($instance['results'][$choice]) ) {
                    $instance['results'][$choice] = 0;
                }
                if( $_POST[$this->id] == $choice ) {
                    $instance['results'][$choice]++;
                }
            }
            $all_instances[$this->number] = $instance;
            $this->save_settings($all_instances);
        } else {
            return false;
        }
    }//End method update_poll
}

add_action( 'widgets_init', create_function( '', "register_widget( 'dw_focus_poll_Widget' );" ) );

?>