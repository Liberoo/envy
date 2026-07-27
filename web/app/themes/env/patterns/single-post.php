<?php

/**
 * Title: Wpis bloga — układ strony
 * Slug: env/single-post
 * Categories: custom/custom-patterns
 * Template Types: single, single-post
 * Viewport Width: 1400
 * Inserter: no
 */

?>

<!-- wp:template-part {"slug":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"env-post"} -->
<main class="wp-block-group alignfull env-post">
	<!-- wp:group {"className":"env-post__header"} -->
	<div class="wp-block-group env-post__header">
		<!-- wp:group {"className":"env-post__top js-animation js-animation-up"} -->
		<div class="wp-block-group env-post__top js-animation js-animation-up">
			<!-- wp:paragraph {"className":"env-post__back"} -->
			<p class="env-post__back"><a href="/blog/" data-env-blog>← wszystkie wpisy</a></p>
			<!-- /wp:paragraph -->

			<!-- wp:post-terms {"term":"category","className":"env-post__tag"} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:post-title {"level":1,"className":"env-post__title js-animation js-animation-up"} /-->

		<!-- wp:group {"className":"env-post__meta js-animation js-animation-up"} -->
		<div class="wp-block-group env-post__meta">
			<!-- wp:group {"className":"env-post__author"} -->
			<div class="wp-block-group env-post__author">
				<!-- wp:image {"id":142,"sizeSlug":"thumbnail","linkDestination":"none","className":"env-post__avatar"} -->
				<figure class="wp-block-image size-thumbnail env-post__avatar"><img src="http://localhost/envy/web/app/uploads/2025/09/474840391_1094733629067172_1364097709229915755_n-576x1024.webp" alt="Kamil Jamróz" class="wp-image-142"/></figure>
				<!-- /wp:image -->

				<!-- wp:paragraph {"className":"env-post__author-name"} -->
				<p class="env-post__author-name">Kamil Jamróz</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:post-date {"format":"j F Y","className":"env-post__date"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"env-post__feature js-animation js-animation-up"} -->
	<div class="wp-block-group env-post__feature js-animation js-animation-up">
		<!-- wp:post-featured-image {"aspectRatio":"16/9"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"env-post__content"} -->
	<div class="wp-block-group env-post__content">
		<!-- wp:post-content /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"env-post__authorbox"} -->
	<div class="wp-block-group env-post__authorbox">
		<!-- wp:image {"id":142,"sizeSlug":"thumbnail","linkDestination":"none","className":"env-post__avatar env-post__avatar--big"} -->
		<figure class="wp-block-image size-thumbnail env-post__avatar env-post__avatar--big"><img src="http://localhost/envy/web/app/uploads/2025/09/474840391_1094733629067172_1364097709229915755_n-576x1024.webp" alt="Kamil Jamróz" class="wp-image-142"/></figure>
		<!-- /wp:image -->

		<!-- wp:group {"className":"env-post__authorbox-text"} -->
		<div class="wp-block-group env-post__authorbox-text">
			<!-- wp:paragraph {"className":"env-post__authorbox-name"} -->
			<p class="env-post__authorbox-name">Kamil Jamróz</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"env-post__authorbox-bio"} -->
			<p class="env-post__authorbox-bio">Tworzę strony i sklepy internetowe oraz dzielę się wiedzą w tym zakresie.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

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
			<p class="env-related__all js-animation js-animation-up"><a class="env-arrow" href="/blog/" data-env-blog>wszystkie wpisy</a></p>
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

<!-- wp:template-part {"slug":"footer"} /-->
