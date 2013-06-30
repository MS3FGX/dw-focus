<?php  
include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

class dw_customize_layout_control extends WP_Customize_Control {
    public function render_content(){
        if ( empty( $this->choices ) )
            return;

        $name = '_customize-radio-' . $this->id;

        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="select-layout-box">
            <label id="right-sidebar-setting"  class="right-sidebar-label <?php echo $this->value() == 'right-sidebar' ? 'active' : '' ?>">
                <i class="icon-right-sidebar"></i><br>
                <input type="radio" value="right-sidebar" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), 'right-sidebar' ); ?> />
                <small><?php _e('Right Sidebar','dw_focus') ?></small><br/>
            </label>
            <label id="left-sidebar-setting" class="left-sidebar-label <?php echo $this->value() == 'left-sidebar' ? 'active' : '' ?>">
                <i class="icon-left-sidebar"></i><br>
                <input type="radio" value="left-sidebar" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), 'left-sidebar' ); ?> />
                <small><?php _e('Left Sidebar','dw_focus') ?></small><br/>
            </label>
        </div> 
        <?php
    }
}

function dw_customize_css() {
    ?>
    <style type="text/css">
    .select-layout-box {
        position: relative;
        text-align: center;
        margin-top: 20px;

    }
    .select-layout-box:after{
        content: ".";
        display: block;
        clear: both;
        visibility: hidden;
        line-height: 0;
        height: 0;
    }

    .select-layout-box label {
        float: left;
        width: 50%;
    }
    .select-layout-box i {
        display: inline-block;
        width: 32px;
        height: 32px;
        cursor: pointer;
        margin: 0 10px;
        opacity: 0.5;
        border: 1px solid transparent;
        transition: all .6s;
        -o-transition: all .6s;
        -moz-transition: all .6s;
        -webkit-transition: all .6s;
    }
    .select-layout-box label:hover i {
        border-color: #aaa;
        transition: all .6s;
        -o-transition: all .6s;
        -moz-transition: all .6s;
        -webkit-transition: all .6s;
    }

    .select-layout-box label.active i{
        opacity: 1;
    }
    .select-layout-box label{
        font-weight: bold;
    }
    .select-layout-box .right-sidebar-label i {
        background: transparent url('<?php echo get_template_directory_uri(); ?>/assets/img/customize-rightsb.png') no-repeat;
    }

    .select-layout-box .left-sidebar-label i {
        background: transparent url('<?php echo get_template_directory_uri(); ?>/assets/img/customize-leftsb.png') no-repeat;
    }
    .select-layout-box .right-sidebar-label i {
        background: transparent url('<?php echo get_template_directory_uri(); ?>/assets/img/customize-rightsb.png') no-repeat;
    }

    .select-layout-box .display-style-list-label i {
        background: transparent url('<?php echo get_template_directory_uri(); ?>/assets/img/customize-list.png') no-repeat;
    }
    .select-layout-box .display-style-grid-label i {
        background: transparent url('<?php echo get_template_directory_uri(); ?>/assets/img/customize-grid.png') no-repeat;
    }

    .select-layout-box [type=radio] {
        display: none;
    }
    </style>
    <?php
}
add_action( 'customize_controls_print_styles', 'dw_customize_css');

function dw_customize_script(){
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Set cookie 
        function setCookie(c_name,value,exdays) {
            var exdate=new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
            document.cookie=c_name + "=" + c_value;
        }

        $('.select-layout-box label').on('click',function(event){
            var t = $(this);
            t.closest('.select-layout-box').find('label').each(function(){
                $(this).removeClass('active');
            });
            if( $(this).data('option') == 'category-layout' ) {
                setCookie('cat_listing',$(this).data('type'),365);
            }
            t.addClass('active');
        });
    });
    </script>
    <?php
}
add_action( 'customize_controls_print_scripts', 'dw_customize_script');

class dw_customize_textarea extends WP_Customize_Control {
    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea class="widefat" <?php $this->link(); ?> ><?php echo esc_attr( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}

class dw_customize_display_style_control extends WP_Customize_Control {
    public function render_content(){
        if ( empty( $this->choices ) )
            return;

        $name = '_customize-radio-' . $this->id;

        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="select-layout-box">
            <label data-option="category-layout" data-type="list" class="display-style-list-label <?php echo $this->value() == 'list' ? 'active' : '' ?>">
                <i class="icon-list-layout"></i><br>
                <input type="radio" value="list" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), 'list' ); ?> />
                <small><?php _e('List','dw_focus') ?></small><br/>
            </label>
            <label data-option="category-layout" data-type="grid" class="display-style-grid-label <?php echo $this->value() == 'grid' ? 'active' : '' ?>">
                <i class="icon-grid-layout"></i><br>
                <input type="radio" value="grid" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), 'grid' ); ?> />
                <small><?php _e('Grid','dw_focus') ?></small><br/>
            </label>
        </div> 
        <?php
    }
}

?>