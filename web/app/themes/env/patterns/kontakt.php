<?php

/**
 * Title: Kontakt
 * Slug: env/kontakt
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 */

?>

<!-- wp:group {"tagName":"section","align":"full","className":"env-kontakt","anchor":"kontakt"} -->
<section class="wp-block-group alignfull env-kontakt" id="kontakt">
	<!-- wp:group {"className":"env-container"} -->
	<div class="wp-block-group env-container">
		<!-- wp:group {"className":"env-section__head"} -->
		<div class="wp-block-group env-section__head">
			<!-- wp:heading {"className":"env-section__title js-animation js-animation-up"} -->
			<h2 class="wp-block-heading env-section__title js-animation js-animation-up">kontakt.</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"env-kicker js-animation js-animation-up"} -->
			<p class="env-kicker js-animation js-animation-up">(04) — napisz do mnie</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"env-kontakt__grid"} -->
		<div class="wp-block-group env-kontakt__grid">
			<!-- wp:group {"className":"env-kontakt__form js-animation js-animation-up"} -->
			<div class="wp-block-group env-kontakt__form js-animation js-animation-up">
				<!-- wp:html -->
				<?php
					// wp:shortcode is not parsed in block templates,
					// so render the CF7 form directly from PHP.
				echo do_shortcode('[contact-form-7 id="9c82262" title="Kontakt"]');
				?>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"env-kontakt__aside js-animation js-animation-up"} -->
			<div class="wp-block-group env-kontakt__aside js-animation js-animation-up">
				<!-- wp:paragraph {"className":"env-kontakt__lead"} -->
				<p class="env-kontakt__lead">Jeśli chcesz się ze mną skontaktować, zapraszam do formularza lub bezpośrednio na mail:</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"env-kontakt__mail"} -->
				<p class="env-kontakt__mail"><a href="mailto:kontakt@kamiljamroz.pl">kontakt@kamiljamroz.pl</a></p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"env-kontakt__card"} -->
				<div class="wp-block-group env-kontakt__card">
					<!-- wp:paragraph {"className":"env-kontakt__card-name"} -->
					<p class="env-kontakt__card-name">Kamil Jamróz</p>
					<!-- /wp:paragraph -->
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
