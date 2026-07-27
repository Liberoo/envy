<?php

/**
 * Title: Blog
 * Slug: env/blog
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 */

?>

<!-- wp:group {"tagName":"section","align":"full","className":"env-blog env-dark","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}} -->
<section class="wp-block-group alignfull env-blog env-dark" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"className":"env-container"} -->
	<div class="wp-block-group env-container">
		<!-- wp:group {"className":"env-section__head env-blog__head"} -->
		<div class="wp-block-group env-section__head env-blog__head">
			<!-- wp:heading {"className":"env-section__title js-animation js-animation-up"} -->
			<h2 class="wp-block-heading env-section__title js-animation js-animation-up">blog.</h2>
			<!-- /wp:heading -->

			<!-- wp:group {"className":"env-blog__headside","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
			<div class="wp-block-group env-blog__headside">
				<!-- wp:paragraph {"className":"env-kicker env-kicker--light js-animation js-animation-up"} -->
				<p class="env-kicker env-kicker--light js-animation js-animation-up">(03) — ostatnie wpisy</p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"className":"env-blog__action js-animation js-animation-up"} -->
				<div class="wp-block-buttons env-blog__action js-animation js-animation-up">
					<!-- wp:button {"className":"is-style-mono"} -->
					<div class="wp-block-button is-style-mono"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">wszystkie wpisy</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:paragraph {"className":"env-blog__lead js-animation js-animation-up"} -->
		<p class="env-blog__lead js-animation js-animation-up">Dzielę się wiedzą o web developmencie, narzędziach i praktykach, których używam na co dzień.</p>
		<!-- /wp:paragraph -->

		<!-- wp:query {"queryId":22,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"className":"env-blog__query"} -->
		<div class="wp-block-query env-blog__query">
			<!-- wp:post-template {"className":"env-count env-blog__grid"} -->
				<!-- wp:group {"className":"env-count-item env-blog__card js-animation js-animation-up"} -->
				<div class="wp-block-group env-count-item env-blog__card js-animation js-animation-up">
					<!-- wp:group {"className":"env-blog__media"} -->
					<div class="wp-block-group env-blog__media">
						<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/11"} /-->

						<!-- wp:post-terms {"term":"category","className":"env-blog__tag"} /-->
					</div>
					<!-- /wp:group -->

					<!-- wp:post-title {"level":3,"isLink":true,"className":"env-blog__title"} /-->

					<!-- wp:post-excerpt {"className":"env-blog__excerpt","excerptLength":18,"showMoreOnNewLine":false} /-->

					<!-- wp:read-more {"content":"czytaj więcej","className":"env-arrow env-blog__more"} /-->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
