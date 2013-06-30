<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>
            </div>
         </div>
     </div>

    <?php if( is_home() ) : ?>
        <!-- Bottom sidebar position -->
        <?php if( is_active_sidebar( 'dw_focus_bottom' ) ) : ?>
        <div id="bottom">
            <div class="container">
            <?php dynamic_sidebar('dw_focus_bottom'); ?>
            </div>
        </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Footer -->
    <footer id="colophon" class="site-footer dark" role="contentinfo">
        <div class="container">

            <div id="site-tools">
                <div class="row">
                    <div class="span9"><?php dw_breadcrumb(); ?></div>
                    <?php if( is_active_sidebar( 'dw_focus_footer_1' ) 
                        || is_active_sidebar( 'dw_focus_footer_2' ) 
                        || is_active_sidebar( 'dw_focus_footer_3' )  
                        || is_active_sidebar( 'dw_focus_footer_4' )  ) { ?>
                    <div class="span3"><a href="#" class="footer-toggle pull-right">Site index</a></div>
                    <?php } ?>
                </div>
            </div>

            <?php if( is_active_sidebar( 'dw_focus_footer_1' ) 
                        || is_active_sidebar( 'dw_focus_footer_2' ) 
                        || is_active_sidebar( 'dw_focus_footer_3' )  
                        || is_active_sidebar( 'dw_focus_footer_4' )  ) { ?>
            <div id="sidebar-footer" class="row-fluid">
                <?php if( is_active_sidebar('dw_focus_footer_1') ) { ?>
                <div id="sidebar-footer-1" class="span3">
                <?php dynamic_sidebar('dw_focus_footer_1'); ?>
                </div>
                <?php } ?>
                <?php if( is_active_sidebar('dw_focus_footer_2') ) { ?>
                <div id="sidebar-footer-2" class="span3">
                <?php dynamic_sidebar('dw_focus_footer_2'); ?>
                </div>
                <?php } ?>
                <?php if( is_active_sidebar('dw_focus_footer_3') ) { ?>
                <div id="sidebar-footer-3" class="span3">
                <?php dynamic_sidebar('dw_focus_footer_3'); ?>
                </div>
                <?php } ?>
                <?php if( is_active_sidebar('dw_focus_footer_4') ) { ?>
                <div id="sidebar-footer-4" class="span3">
                <?php dynamic_sidebar('dw_focus_footer_4'); ?>
                </div>
                <?php } ?>
            </div>

            <?php } ?>

            <div class="footer-shadown"></div>
        </div>

        <div id="site-info" class="container">
            <div class="clearfix">
                <div class="copyright">
			<p>Original theme by <a href="http://designwall.com" title="Design Wall">Design Wall</a>, modified for The Powerbase.
			<a title="DW Focus on GitHub" href="https://github.com/MS3FGX/dw-focus">Fork this theme on GitHub.</a></p>
			<p>Proudly powered by <a href="http://wordpress.org/" title="Semantic Personal Publishing Platform">WordPress</a></p>
                </div>
            </div>
        </div>
    </footer><!-- #colophon .site-footer -->
<a class="scroll-top" href="#masthead" title="<?php _e( 'Scroll to top', 'dw-focus' ); ?>"><?php _e( 'Top', 'dw-focus' ); ?></a>


<?php wp_footer(); ?>

</body>
</html>
