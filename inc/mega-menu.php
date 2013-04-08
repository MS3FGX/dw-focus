<?php
/**
 * Custom walker for mega menu
 * 
 * @package DW Focus
 * @since DW Focus 1.0
 */


class DW_Mega_Walker extends Walker_Nav_Menu
{
    private $in_sub_menu = 0;
    private $is_category_menu = 0;

	function start_lvl( &$output, $depth = 0, $args = array() ) {

        $output .= '<i class="sub-menu-collapse icon-chevron-down hidden-desktop"></i>';
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
		
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

        // Detect first child of submenu then add class active
        if( $depth == 1 ) {
            if( ! $this->in_sub_menu ) {
                $classes[] = 'active'; 
                $this->in_sub_menu = 1;
            }
        }
        if( $depth == 0 ) {
            $this->in_sub_menu = 0;
        }// End addition of active class for first item 

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) .' '. $depth . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$args = (object) $args;
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if( $depth == 0 && $item->object == 'category' ) {
            $output .= "<div class=\"sub-mega-wrap\">\n";
		}
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if($depth==0 &&  $item->object == 'category'){
			$output .= "<div class='subcat'>";
			
		for ($i=0; $i<count($item->children);$i++) {
			$child = $item->children[$i];
			$output .="<div class='".(($i===0)?'active':'')."' id='mn-latest-".$child->ID."'>";
			//$output .="<h5>".$child->title."</h5>";
			$output .="<ul id='mn-latest-".$child->ID."'>";
				if($child->object == 'category'){


			        $r = new WP_Query( apply_filters( 'widget_posts_args', 
			            array( 
			                'posts_per_page'    => 5, 
			                'no_found_rows'         => true, 
			                'post_status'           => 'publish', 
			                'cat'              =>      $child->object_id
			            ) ) );

			          if ($r->have_posts()) :
			          		while ( $r->have_posts() ) {
				                    $r->the_post();
							$output.= "<li ";
							if( has_post_thumbnail()) {
							 $output.= "class='has-thumbnail' ";
							}
							$output.= "><div class='subcat-thumbnail'><a href='".get_permalink()."' title='".get_the_title()."'>".get_the_post_thumbnail( get_the_ID(), array(40,40))."</a></div><div class='subcat-title'><a href='".get_permalink()."' title='".get_the_title()."'> ".get_the_title()."</a><span> - ". human_time_diff( get_the_time('U'), current_time('timestamp') ) ." ago </span></div></li>";
					            } 
					        // Reset the global $the_post as this query will have stomped on it
					        wp_reset_postdata();

				        endif;

				}
			  $output .= "</ul>";
			  $output .= "<a href='".$child->url."' title='".$child->attr_title."'>View all</a>";
			  $output .= "</div>";
			}
			
			$output .= "</div> \n</div>\n";
		}
		else{

		}
		$output .= "</li>\n";
	}


}
/**
 *  Walker Custom for mobile device
 */
class DW_Mega_Walker_Mobile extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<i class="sub-menu-collapse icon-chevron-down hidden-desktop"></i>';
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
}

add_filter( 'wp_nav_menu_objects', 'add_menu_child_items' );
function add_menu_child_items( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		$item->children = array();
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
	
			foreach ( $items as $citem ) {
				if ( $citem->menu_item_parent && $citem->menu_item_parent == $item->ID ) {
					$item->children[] = $citem;
				}
			}
		}
	}
	
	return $items;    
}


/**
 * Menu fallback. Link to the menu editor if that is useful.
 *
 * @param  array $args
 * @return string
 */
function link_to_menu_editor( $args )
{
    if ( ! current_user_can( 'manage_options' ) )
    {
        return;
    }

    // see wp-includes/nav-menu-template.php for available arguments
    extract( $args );

    $link = $link_before
        . '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>'
        . $link_after;

    // We have a list
    if ( FALSE !== stripos( $items_wrap, '<ul' )
        or FALSE !== stripos( $items_wrap, '<ol' )
    )
    {
        $link = "<li>$link</li>";
    }

    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) )
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ( $echo )
    {
        echo $output;
    }

    return $output;
}