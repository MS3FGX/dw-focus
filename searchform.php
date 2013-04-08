<?php
/**
 * The template for displaying search forms in dw focus
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>
	<form method="get" name="searchForm" class="searchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search &hellip;', 'dw_focus' ); ?>" />
		<input type="submit" class="submit" name="submit" value="<?php esc_attr_e( 'Search', 'dw_focus' ); ?>" />
	</form>
