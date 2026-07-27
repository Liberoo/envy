<?php

/**
 * Title: Mockup Desktop
 * Slug: env/mockup-desktop
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 */

$frame_id  = 781; // iMac 27" Silver
$frame_url = wp_get_attachment_image_url($frame_id, 'full');

?>

<!-- wp:group {"className":"mockup-desktop"} -->
<div class="wp-block-group mockup-desktop">
	<!-- wp:group {"className":"mockup-desktop__inner"} -->
	<div class="wp-block-group mockup-desktop__inner">
		<!-- wp:image {"id":<?php echo (int) $frame_id; ?>,"sizeSlug":"full","className":"mockup-frame"} -->
		<figure class="wp-block-image size-full mockup-frame"><img src="<?php echo esc_url($frame_url); ?>" alt="" class="wp-image-<?php echo (int) $frame_id; ?>"/></figure>
		<!-- /wp:image -->

		<!-- wp:group {"className":"mockup-parent"} -->
		<div class="wp-block-group mockup-parent">
			<!-- wp:image {"sizeSlug":"full","className":"mockup-website"} -->
			<figure class="wp-block-image size-full mockup-website"><img alt="Zrzut ekranu strony projektu"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
