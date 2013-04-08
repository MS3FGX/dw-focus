<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>
	
	<?php if ( is_active_sidebar( 'dw_focus_sidebar' ) ) : ?>
    <div id="secondary" class="widget-area span3" role="complementary">
		<?php if( ! dynamic_sidebar('dw_focus_sidebar') ) { ?>
		<aside class="latest-news">
		    <h3 class="widget-title">Latest News</h3>
		    <article class="hentry">
		        <div class="entry-thumbnail"><img alt="" src="http://placehold.it/220x130" /></div>
		        <h2 class="entry-title">London Workshops Demystify The Guts of Personal Technology</h2>
		        <div class="entry-content">Morbi vulputate egestas sem, eu cursus ligula ullamcorper non. Curabitur tristique belit eu mauris venenatis egestas. Phasellus bibendum placerat metus, sed olestie magna semper eget. Sed sit amet dui felis, tempus porttitor justo.</div>
		    </article>
		    <ul class="other-entry">
		        <li><a href="#">A London Workshop Is Making Tech More Human with "Bespoke Devices"</a></li>
		        <li><a href="#">Is This the Dawning of the Age of the Co-op?</a></li>
		    </ul>
		</aside>
		<?php } ?>
	</div>
	<?php endif; ?>