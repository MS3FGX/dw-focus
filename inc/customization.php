<?php  
function dw_focus_customize_register($wp_customize){

    $wp_customize->add_section( 'dw_focus_general_settings' , array(
        'title'      => __( 'General Settings', 'dw_focus' ),
        'priority'   => 10,
    ) );
    //Select Layout
    //  Logo Image
    $wp_customize->add_setting('option_tree[dw_layout]', array(
        'default'           => dw_get_option('dw_layout'),
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new dw_customize_layout_control($wp_customize, 'dw_layout', array(
        'label'      => __('Select Layout', 'dw_focus'),
        'section'    => 'dw_focus_general_settings',
        'settings'   => 'option_tree[dw_layout]',
        'type'       => 'radio',
        'choices'    => array(
            'right-sidebar'     => __( 'Right Sidebar', 'dw_focus' ),
            'left-sidebar'     => __( 'Left Sidebar', 'dw_focus' )
        ),
    )));


    //  Header script
    $wp_customize->add_setting('option_tree[dw_header_script]', array(
        'default'               => '',
        'capability'            => 'edit_theme_options',
        'type'                  => 'option',
 
    ));
 
    $wp_customize->add_control( new dw_customize_textarea($wp_customize, 'dw_header_script', array(
        'label'    => __('DW Focus header script', 'dw_focus'),
        'section'  => 'dw_focus_general_settings',
        'settings' => 'option_tree[dw_header_script]'
    )));

    //  Footer script
    $wp_customize->add_setting('option_tree[dw_footer_script]', array(
        'default'               => '',
        'capability'            => 'edit_theme_options',
        'type'                  => 'option',
 
    ));
 
    $wp_customize->add_control( new dw_customize_textarea($wp_customize, 'dw_footer_script', array(
        'label'    => __('DW Focus footer script', 'dw_focus'),
        'section'  => 'dw_focus_general_settings',
        'settings' => 'option_tree[dw_footer_script]'
    )));

    //New section
    //Site title & Tag line
     //  Logo Image
    $wp_customize->add_setting('option_tree[dw_logo_image]', array(
        'default'               => get_template_directory_uri().'/assets/img/logo.png',
        'capability'            => 'edit_theme_options',
        'type'                  => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dw_logo_image', array(
        'label'    => __('Logo', 'dw_focus'),
        'section'  => 'title_tagline',
        'settings' => 'option_tree[dw_logo_image]',
    )));

    //  Logo small image
    $wp_customize->add_setting('option_tree[dw_small_logo_image]', array(
        'default'               => get_template_directory_uri().'/assets/img/logo-small.png',
        'capability'            => 'edit_theme_options',
        'type'                  => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dw_small_logo_image', array(
        'label'    => __('Small logo', 'dw_focus'),
        'section'  => 'title_tagline',
        'settings' => 'option_tree[dw_small_logo_image]'
    )));

    // New section
    $wp_customize->add_setting('option_tree[nav_type]', array(
        'default'        => 'loadmore',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
    $wp_customize->add_control( 'dw_blog_navigation_select_box', array(
        'settings' => 'option_tree[nav_type]',
        'label'   => __( 'Post Navigation Technique', 'dw_focus'),
        'section' => 'nav',
        'type'    => 'select',
        'choices'    => array(
            'number'    => __('Number', 'dw_focus'),
            'loadmore'    => __('Load more button', 'dw_focus')
        ),
    ));

    // Select default listing for  News on Menu
    $wp_customize->add_setting('option_tree[dw_menu_display_type]', array(
        'default'        => dw_get_option('dw_menu_display_type'),
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
    $wp_customize->add_control( 'dw_mega_menu_listing_style', array(
        'settings' => 'option_tree[dw_menu_display_type]',
        'label'   => __( 'Plus Menu', 'dw_focus'),
        'section' => 'nav',
        'type'    => 'select',
        'choices'    => array(
            'today'     => __('Display latest news Today', 'dw_focus'),
            'latest'  => __('Display latest news of the Site', 'dw_focus')
        ),
    ));

    // Number of lastest news
    $wp_customize->add_setting('option_tree[dw_menu_number_posts]', array(
        'default'        => dw_get_option('dw_menu_number_posts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('dw_focus_number_latest_news', array(
        'label'      => __('Number of news', 'dw_focus'),
        'section'    => 'nav',
        'settings'   => 'option_tree[dw_menu_number_posts]',
    ));


    // New section
    $wp_customize->add_section('dw_category_settings', array(
        'title'    => __('Category settings', 'dw_focus'),
        'priority' => 123,
    ));

    $wp_customize->add_setting('option_tree[cat_display]', array(
        'default'           => 'grid',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new dw_customize_display_style_control($wp_customize, 'cat_display', array(
        'label'      => __('Default category display layout', 'dw_focus'),
        'section'    => 'dw_category_settings',
        'settings'   => 'option_tree[cat_display]',
        'type'       => 'radio',
        'choices'    => array(
            'list'     => __( 'List', 'dw_focus' ),
            'grid'     => __( 'Grid', 'dw_focus' )
        ),
    )));

    // New section
    $wp_customize->add_section('dw_social_link', array(
        'title'    => __('Social Links', 'themename'),
        'priority' => 124,
    ));

    //Login link
    $wp_customize->add_setting('option_tree[dw_loginlink]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));
 
    $wp_customize->add_control('enable_login_link', array(
        'default'        => true,
        'settings'  => 'option_tree[dw_loginlink]',
        'label'     => __('Enable login link'),
        'section'   => 'dw_social_link',
        'type'      => 'checkbox',
    ));

    //Feed link
    $wp_customize->add_setting('option_tree[dw_feedlink]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));
 
    $wp_customize->add_control('enable_feed_link', array(
        'default'        => true,
        'settings'  => 'option_tree[dw_feedlink]',
        'label'     => __('Enable feed link'),
        'section'   => 'dw_social_link',
        'type'      => 'checkbox',
    ));

    // Facebook social
    $wp_customize->add_setting('option_tree[dw_facebook]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('dw_social_facebook', array(
        'label'      => __('Facebook', 'dw_focus'),
        'section'    => 'dw_social_link',
        'settings'   => 'option_tree[dw_facebook]',
    ));
    // Twitter social
    $wp_customize->add_setting('option_tree[dw_twitter]', array(
        'default'        => dw_get_option('dw_twitter'),
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('dw_social_twitter', array(
        'label'      => __('Twitter', 'dw_focus'),
        'section'    => 'dw_social_link',
        'settings'   => 'option_tree[dw_twitter]',
    ));
    // Goole plus social
    $wp_customize->add_setting('option_tree[dw_gplus]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('dw_social_gplus', array(
        'label'      => __('Google Plus', 'dw_focus'),
        'section'    => 'dw_social_link',
        'settings'   => 'option_tree[dw_gplus]',
    ));
    // Linkedin social
    $wp_customize->add_setting('option_tree[dw_linkedin]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('dw_social_linkedin', array(
        'label'      => __('Linkedin', 'dw_focus'),
        'section'    => 'dw_social_link',
        'settings'   => 'option_tree[dw_linkedin]',
    ));


    // New section
    $wp_customize->add_section('dw_blog_settings', array(
        'title'    => __('Blog settings', 'dw_focus'),
        'priority' => 125,
    ));


    //Category select for blog page layout
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
 
    $wp_customize->add_setting('option_tree[dw_blog_cat]', array(
        'default'        => $default
    ));
    $wp_customize->add_control( 'dw_blog_cat_select_box', array(
        'settings' => 'option_tree[dw_blog_cat]',
        'label'   => __('Select Category', 'dw_focus'),
        'section'  => 'dw_blog_settings',
        'type'    => 'select',
        'choices' => $cats,
    ));

    //Number posts per page
    $wp_customize->add_setting('option_tree[dw_blog_number_posts]', array(
        'default'        => dw_get_option('dw_blog_number_posts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('dw_focus_blog_number_posts_per_page', array(
        'label'      => __('Number of posts per page', 'dw_focus'),
        'section'    => 'dw_blog_settings',
        'settings'   => 'option_tree[dw_blog_number_posts]',
    ));
}
 
add_action('customize_register', 'dw_focus_customize_register');



function dw_add_setting_fields(){

    register_setting( 'general', 'option_tree');
    add_settings_field( 'option_tree[dw_header_script]', __('Enter scripts or code you would like output to wp_head():','dw_focus'), 'nex_setting_field_header_script', 'general' );

    add_settings_field( 'option_tree[dw_footer_script]', __('Enter scripts or code you would like output to wp_footer():','dw_focus'), 'nex_setting_field_footer_script', 'general' );
}
add_action('admin_init', 'dw_add_setting_fields');

function nex_setting_field_header_script(){
?>
<textarea name="option_tree[dw_header_script]" id="dw-focus-option-header-script" cols="50" rows="10" class="large-text code"><?php echo dw_get_option( 'dw_header_script', false, true ); ?></textarea>
<p class="description"><?php _e('The <code>wp_head()</code> hook executes immediately before the closing <code>&lt;&#47;head&gt;</code> tag in the document source.','dw_focus') ?></p>  
<?php
}

function nex_setting_field_footer_script(){
?>
<textarea name="option_tree[dw_footer_script]" id="dw-focus-option-footer-script" cols="50" rows="10" class="large-text code"><?php echo dw_get_option( 'dw_footer_script', false, true ); ?></textarea>
<p class="description"><?php _e('The wp_footer() hook executes immediately before the closing </body> tag in the document source.','dw_focus') ?></p>  
<?php 
}

?>