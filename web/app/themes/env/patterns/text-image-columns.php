<?php
/**
 * Title: Text Image Columns
 * Slug: env/text-image-columns
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 *
 * @package WordPress
 * @subpackage PressWind FSE
 * @since PressWind FSE 1.0
 */

?>

<!-- wp:group {"className":"wrapper cntainer cols""layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group wrapper container cols">

	<!-- wp:group {"className":"cols-left"} -->
	<div class="wp-block-group col col--text cols-left">
		<!-- wp:paragraph  -->
		<p>Tekst</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"cols-right"} -->
	<div class="wp-block-group  cols-right">
		<!-- wp:image {"url":"https://via.placeholder.com/800x600","linkDestination":"none"} -->
		<figure class="wp-block-image"><img src="https://via.placeholder.com/800x600" alt=""/></figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->