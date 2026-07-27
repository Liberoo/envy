<?php

/**
 * Title: Video Noise
 * Slug: env/video-noise
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 *
 * @package WordPress
 * @subpackage PressWind FSE
 * @since PressWind FSE 1.0
 */

// Resolve media URLs dynamically; hardcoded localhost URLs broke migration between environments.
$video_url = wp_get_attachment_url(69);
$logo_url  = wp_get_attachment_image_url(72, 'large');
$noise_url = wp_get_attachment_image_url(73, 'full');

?>

<!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"},"className":"video-noise-hero"} -->
<div class="wp-block-group video-noise-hero">
	<!-- wp:video {"id":69,"className":"hero-video"} -->
	<figure class="wp-block-video hero-video">
		<video
			autoplay
			loop
			muted
			src="<?php echo esc_url($video_url); ?>"
			playsinline></video>
	</figure>
	<!-- /wp:video -->

	<!-- wp:image {"id":72,"sizeSlug":"large","linkDestination":"none","align":"center","className":"hero-logo"} -->
	<figure class="wp-block-image aligncenter size-large hero-logo">
		<img
			src="<?php echo esc_url($logo_url); ?>"
			alt=""
			class="wp-image-72" />
	</figure>
	<!-- /wp:image -->

	<!-- wp:image {"id":73,"sizeSlug":"full","linkDestination":"none","className":"hero-noise"} -->
	<figure class="wp-block-image size-full hero-noise">
		<img
			src="<?php echo esc_url($noise_url); ?>"
			alt=""
			class="wp-image-73" />
	</figure>
	<!-- /wp:image -->

	<!-- wp:group {"layout":{"type":"constrained"},"className":"hero-content"} -->
	<div class="wp-block-group hero-content">
		<!-- wp:paragraph {"className":"hero-services"} -->
		<p class="hero-services">
			<strong>strony / sklepy internetowe</strong><br />
			<strong>aplikacje automatyzacje</strong><br />
			<strong>ux/ui</strong>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
