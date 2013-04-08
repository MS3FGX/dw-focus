<?php  

if( ! function_exists('dw_category_generate_html_add_form_fields') ) { 
    /**
     * Generate html for DW Focus option in edit tag page
     * @return void
     */
    function dw_category_generate_html_add_form_fields(){ 
    ?>
    <div class="form-field">
        <label for="tag-style"><?php _e('Category Style','dw_focus') ?></label>
        <select name="tag-style" id="">
            <option value="none"><?php _e('none','dw_focus') ?></option>
            <?php  
            if ($handle = opendir(DW_TEMPLATE_PATH . 'assets/colors/') ) {
                /* This is the correct way to loop over the directory. */
                while (false !== ($entry = readdir($handle))) {
                    if( $entry == '.' || '..' == $entry ) {
                        continue;
                    }
                    if( is_dir(DW_TEMPLATE_PATH . 'assets/colors/'.$entry) ) {
                        echo '<option value="'.$entry.'">'.$entry.'</option>';
                    }
                }

                closedir($handle);
            }
            ?>
        </select>
        <p class="description"><?php _e('Change style for this category','dw_focus'); ?></p>
    </div>
    <?php
    }
    add_action( 'category_add_form_fields', 
        'dw_category_generate_html_add_form_fields' );
}

if( ! function_exists('dw_category_generate_html_edit_form_fields') ) { 
    /**
     * Generate html for dw_focus category option in edit tag page
     * @return void
     */
    function dw_category_generate_html_edit_form_fields($tag){
        $options = dw_get_category_option($tag->term_id);
    ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="tag-style">
                    <?php _e('Category Style','dw_focus') ?>
                </label>
            </th>
            <td>
                <select name="tag-style" id="tag-style">
                    <option <?php selected( $options['style'], 'none' ); ?> value="none"><?php _e('none','dwqa'); ?></option>
                    <?php  
                    if ($handle = opendir(DW_TEMPLATE_PATH . 'assets/colors/') ) {
                        /* This is the correct way to loop over the directory. */
                        while (false !== ($entry = readdir($handle))) {
                            if( $entry == '.' || '..' == $entry ) {
                                continue;
                            }
                            if( is_dir(DW_TEMPLATE_PATH . 'assets/colors/'.$entry) ) {
                                echo '<option '.selected( $options['style'], $entry,false ).' value="'.$entry.'">'.$entry.'</option>';
                            }
                        }

                        closedir($handle);
                    }
                    ?>
                </select>
                <br>
                <span class="description">
                    <?php _e('Change style for this category','dw_focus'); ?>
                </span>
            </td>
        </tr>
    <?php
    }
    add_action( 'category_edit_form_fields', 
        'dw_category_generate_html_edit_form_fields' );
}  

if( ! function_exists('dw_enqueue_thickbox_for_edit_tag_page') ) { 
    //Init upload thickbox script
    function dw_enqueue_thickbox_for_edit_tag_page(){
        global $pagenow;

        if( 'edit-tags.php' == $pagenow ) {
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');


            wp_register_script('dw-category-upload', DW_TEMPLATE_URI.'assets/admin/js/edit-tags.js', array('jquery','media-upload','thickbox') );

            wp_enqueue_script('dw-category-upload');
        }
    }
    add_action( 'admin_print_scripts', 'dw_enqueue_thickbox_for_edit_tag_page' );
 }   

 if( ! function_exists('dw_enqueue_style_thickbox_for_edit_tag_page') ) { 
    //Init upload thickbox Style
     function dw_enqueue_style_thickbox_for_edit_tag_page(){
        wp_enqueue_style('thickbox');
     }
     add_action( 'admin_print_styles',
        'dw_enqueue_style_thickbox_for_edit_tag_page' );
 }  


if( ! function_exists('dw_save_category_option') ) { 
    /**
     * Save category options
     * @param  int $category_id ID of category what was saved
     * @return void 
     */
    function dw_save_category_option($category_id){
        $category_options = array();
        if( isset($_POST['tag-style']) ) {
            $category_options['style'] = $_POST['tag-style'];

        }
        if( ! empty($category_options) ) {
            update_option( 'dw_category_option_'.$category_id,
                                $category_options );
        }
    }
    add_action( 'create_category', 'dw_save_category_option' );
    add_action( 'edit_category', 'dw_save_category_option' );
}   

if( ! function_exists('dw_get_category_option') ) { 
    /**
     * Get dw options of category
     * @param  int $category_id ID of category
     * @return array              An array of category options
     */
    function dw_get_category_option($category_id){
        return get_option(  'dw_category_option_'.$category_id, array(
                'style'         => 'none',
                'logo'          => '',
                'background'    => ''
            ) );
    }
}   

function dw_special_category_menu_class( $classes, $item )
{
    if( 'category' == $item->object ) {
        $options = dw_get_category_option( $item->object_id );
        $classes[] = 'color-'.$options['style'];
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'dw_special_category_menu_class', 10, 2 );

function dw_category_color_class($classes) {
    if( is_archive() ) {
        $classes[] = 'color-category';
    }
    return $classes;
}
add_filter('post_class', 'dw_category_color_class');
add_filter('body_class', 'dw_category_color_class');

?>