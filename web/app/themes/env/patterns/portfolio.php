<?php

/**
 * Title: Portfolio
 * Slug: env/portfolio
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 */

?>

<!-- wp:group {"tagName":"section","align":"full","className":"env-portfolio","anchor":"portfolio","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|70"}}}} -->
<section class="wp-block-group alignfull env-portfolio" id="portfolio" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"className":"env-container"} -->
	<div class="wp-block-group env-container">
		<!-- wp:group {"className":"env-section__head"} -->
		<div class="wp-block-group env-section__head">
			<!-- wp:heading {"className":"env-section__title js-animation js-animation-up"} -->
			<h2 class="wp-block-heading env-section__title js-animation js-animation-up">portfolio.</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"env-kicker js-animation js-animation-up"} -->
			<p class="env-kicker js-animation js-animation-up">(02) — wybrane projekty</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:query {"queryId":21,"query":{"perPage":4,"pages":0,"offset":0,"postType":"portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"env-portfolio__query js-animation js-animation-up"} -->
		<div class="wp-block-query env-portfolio__query js-animation js-animation-up">
			<!-- wp:post-template {"className":"env-count env-count--rows env-portfolio__list"} -->
				<!-- wp:group {"className":"env-portfolio__row env-arrow-hover"} -->
				<div class="wp-block-group env-portfolio__row env-arrow-hover">
					<!-- wp:post-featured-image {"className":"env-portfolio__peek"} /-->

					<!-- wp:post-title {"level":3,"isLink":true,"className":"env-portfolio__title"} /-->

					<!-- wp:post-terms {"term":"portfolio_type","className":"env-portfolio__cat"} /-->

					<!-- wp:paragraph {"className":"env-arrow env-portfolio__arrow"} -->
					<p class="env-arrow env-portfolio__arrow"></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
