<?php

/**
 * Title: Przeczytaj też (powiązane wpisy)
 * Slug: env/related-posts
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 */

?>

<!-- wp:group {"tagName":"section","align":"full","className":"env-blog env-dark env-related"} -->
<section class="wp-block-group alignfull env-blog env-dark env-related">
	<!-- wp:group {"className":"env-container"} -->
	<div class="wp-block-group env-container">
		<!-- wp:group {"className":"env-section__head"} -->
		<div class="wp-block-group env-section__head">
			<!-- wp:heading {"className":"env-section__title env-related__title js-animation js-animation-up"} -->
			<h2 class="wp-block-heading env-section__title env-related__title js-animation js-animation-up">przeczytaj też.</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"env-related__all js-animation js-animation-up"} -->
			<p class="env-related__all js-animation js-animation-up"><a class="env-arrow" href="/blog/">wszystkie wpisy</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:query {"queryId":33,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"exclude_current":true},"namespace":"advanced-query-loop","className":"env-related__query"} -->
		<div class="wp-block-query env-related__query">
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

					<!-- wp:post-excerpt {"className":"env-blog__excerpt","excerptLength":16,"showMoreOnNewLine":false} /-->

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
