<?php


add_filter('ot_radio_images','dw_radio_images',10,2);

   function dw_radio_images($array, $field_id ){
    
    if($field_id=='dw_layout'){
          $array= array(
          
          array(
            'value'   => 'right-sidebar',
            'label'   => __( 'Right Sidebar', 'option-tree' ),
            'src'     => OT_URL . 'assets/images/layout/right-sidebar.png'
          ),
          array(
            'value'   => 'left-sidebar',
            'label'   => __( 'Left Sidebar', 'option-tree' ),
            'src'     => OT_URL . 'assets/images/layout/left-sidebar.png'
          )
        );
      }
      return $array;
   }


/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', '_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
        )
      ),
      'sidebar'       => '<p>Sidebar content goes here!</p>'
    ),
    'sections'        => array(
      array(
        'title'       => 'General',
        'id'          => 'general_default'
      ),
      array(
        'title'       => 'Mega Menu',
        'id'          => 'menu_settings'
      ),
      array(
        'title'       => 'Social Links',
        'id'          => 'social_default'
      ),
      array(
        'title'       => 'Category settings',
        'id'          => 'category_settings'
      ),
      array(
        'title'       => 'Blog settings',
        'id'          => 'blog_settings'
      )
    ),
    'settings'        => array(
      
      array(
        'label'       => 'Select default listing for category ',
        'id'          => 'cat_display',
        'type'        => 'radio',
        'desc'        => '',
        'choices'     => array(
       
           array(
            'label'       => 'List',
            'value'       => 'list'
          ),
          array(
            'label'       => 'Grid',
            'value'       => 'grid'
          )
        ),
        'std'         => 'list',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'category_settings'
      ),
      array(
        'label'       => 'Category Select',
        'id'          => 'dw_blog_cat',
        'type'        => 'category-select',
        'desc'        => 'Select category for your blog page',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_settings'
      ),
      array(
        'label'       => 'Select Post Navigation Technique',
        'id'          => 'dw_blog_navigation',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
       
           array(
            'label'       => 'Number',
            'value'       => 'number'
          ),
          array(
            'label'       => 'Load more button',
            'value'       => 'loadmore'
          )
        ),
        'std'         => 'number',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_settings'
      ),
      array(
        'label'       => 'Number of posts per page',
        'id'          => 'dw_blog_number_posts',
        'type'        => 'number',
        'desc'        => 'Blog pages show at most',
        'std'         => '6',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog_settings'
      ),
      array(
        'label'       => 'Facebook',
        'id'          => 'dw_facebook',
        'type'        => 'text',
        'desc'        => '',
        'std'         => 'http://facebook.com/pages/designwall',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social_default'
      ),
      array(
        'label'       => 'Twitter',
        'id'          => 'dw_twitter',
        'type'        => 'text',
        'desc'        => '',
        'std'         => 'http://twitter.com/wp.designwall',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social_default'
      ),
      array(
        'label'       => 'Google plus',
        'id'          => 'dw_gplus',
        'type'        => 'text',
        'desc'        => '',
        'std'         => 'http://twitter.com/designwall',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social_default'
      ),
      array(
        'label'       => 'Select layout',
        'id'          => 'dw_layout',
        'type'        => 'radio-image',
        'desc'        => '',
        'std'         => 'right-sidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
       ),
      // Menu settings
      array(
        'label'       => 'Select default listing for News on Menu',
        'id'          => 'dw_menu_display_type',
        'type'        => 'radio',
        'desc'        => '',
        'choices'     => array(
       
           array(
            'label'       => 'Display latest news Today',
            'value'       => 'today'
          ),
          array(
            'label'       => 'Display latest news of the Site',
            'value'       => 'latest'
          )
        ),
        'std'         => 'today',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'menu_settings'
      ),
      array(
        'label'       => 'Number of lastest news',
        'id'          => 'dw_menu_number_posts',
        'type'        => 'number',
        'desc'        => 'Max number of lastest news',
        'std'         => '15',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'menu_settings'
      ),//End menu settings
      array(
        'label'       => 'Select Post Navigation Technique',
        'id'          => 'nav_type',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
       
           array(
            'label'       => 'Number',
            'value'       => 'number'
          ),
          array(
            'label'       => 'Load more button',
            'value'       => 'loadmore'
          )
        ),
        'std'         => 'number',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Logo',
        'id'          => 'dw_logo_image',
        'type'        => 'upload',
        'desc'        => '',
        'std'         => get_template_directory_uri().'/assets/img/logo.png',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Enter scripts or code you would like output to wp_head():',
        'id'          => 'dw_header_script',
        'type'        => 'textarea-simple',
        'desc'        => 'The <code>wp_head()</code> hook executes immediately before the closing <code>&lt;&#47;head&gt;</code> tag in the document source.',
        'std'         => '',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),
      array(
        'label'       => 'Enter scripts or code you would like output to wp_footer():',
        'id'          => 'dw_footer_script',
        'type'        => 'textarea-simple',
        'desc'        => 'The <code>wp_footer()</code> hook executes immediately before the closing <code>&lt;&#47;body&gt;</code> tag in the document source.',
        'std'         => '',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
      ),

    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}