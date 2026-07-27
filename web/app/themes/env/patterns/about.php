<?php

/**
 * Title: O mnie
 * Slug: env/about
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 */

$about_image_id  = 383;
$about_image_url = wp_get_attachment_image_url($about_image_id, 'full');

?>

<!-- wp:group {"tagName":"section","align":"full","className":"env-about","style":{"spacing":{"margin":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}} -->
<section class="wp-block-group alignfull env-about" style="margin-top:var(--wp--preset--spacing--70);margin-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"className":"env-container"} -->
	<div class="wp-block-group env-container">
		<!-- wp:group {"className":"env-section__head"} -->
		<div class="wp-block-group env-section__head">
			<!-- wp:heading {"className":"env-section__title js-animation js-animation-up"} -->
			<h2 class="wp-block-heading env-section__title js-animation js-animation-up">o mnie.</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"env-kicker js-animation js-animation-up"} -->
			<p class="env-kicker js-animation js-animation-up">(01) — kim jestem</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"env-about__grid"} -->
		<div class="wp-block-group env-about__grid">
			<!-- wp:group {"className":"env-about__media env-sweep js-animation"} -->
			<div class="wp-block-group env-about__media env-sweep js-animation">
				<!-- wp:image {"id":<?php echo (int) $about_image_id; ?>,"sizeSlug":"full","className":"env-about__photo"} -->
				<figure class="wp-block-image size-full env-about__photo"><img src="<?php echo esc_url($about_image_url); ?>" alt="Kamil Jamróz — portret" class="wp-image-<?php echo (int) $about_image_id; ?>"/></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"env-about__content js-animation js-animation-up"} -->
			<div class="wp-block-group env-about__content js-animation js-animation-up">
				<!-- wp:paragraph {"className":"env-about__name"} -->
				<p class="env-about__name"><span class="env-about__name-first">Kamil</span> <span class="env-about__name-last">Jamróz</span></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"env-about__lead"} -->
				<p class="env-about__lead">Nazywam się Kamil i od ponad trzech lat tworzę strony internetowe, sklepy e-commerce oraz aplikacje webowe.</p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"env-about__cols"} -->
				<div class="wp-block-group env-about__cols">
					<!-- wp:group {"className":"env-about__col"} -->
					<div class="wp-block-group env-about__col">
						<!-- wp:paragraph {"className":"env-about__label"} -->
						<p class="env-about__label">codziennie</p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"env-about__desc"} -->
						<p class="env-about__desc">Pracuję w software house, gdzie realizuję duże projekty dla wymagających klientów.</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"env-about__col"} -->
					<div class="wp-block-group env-about__col">
						<!-- wp:paragraph {"className":"env-about__label"} -->
						<p class="env-about__label">podejście</p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"className":"env-about__desc"} -->
						<p class="env-about__desc">Lubię wykorzystywać nowoczesne narzędzia pojawiające się na rynku.</p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
