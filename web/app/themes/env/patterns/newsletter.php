<?php

/**
 * Title: Newsletter
 * Slug: env/newsletter
 * Categories: custom/custom-patterns
 * Viewport Width: 1400
 * Inserter: yes
 */

?>

<!-- wp:group {"tagName":"section","align":"full","className":"env-newsletter env-dark","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}} -->
<section class="wp-block-group alignfull env-newsletter env-dark" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"className":"env-container env-newsletter__grid"} -->
	<div class="wp-block-group env-container env-newsletter__grid">
		<!-- wp:group {"className":"env-newsletter__content js-animation js-animation-up"} -->
		<div class="wp-block-group env-newsletter__content js-animation js-animation-up">
			<!-- wp:paragraph {"className":"env-kicker env-kicker--light"} -->
			<p class="env-kicker env-kicker--light">(05) — bądźmy w kontakcie</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"className":"env-section__title env-newsletter__title"} -->
			<h2 class="wp-block-heading env-section__title env-newsletter__title">newsletter.</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"env-newsletter__desc"} -->
			<p class="env-newsletter__desc">Raz na jakiś czas wysyłam wiedzę o web developmencie, narzędziach i praktykach. Zero spamu — możesz wypisać się w każdej chwili.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<form class="env-newsletter__form js-animation js-animation-up" novalidate>
			<input type="text" name="name" placeholder="imię" autocomplete="given-name" class="env-newsletter__input">
			<input type="email" name="email" placeholder="e-mail" required autocomplete="email" class="env-newsletter__input">
			<label class="env-newsletter__consent">
				<input type="checkbox" name="consent" class="nl-check" required>
				<span>Wyrażam zgodę na przetwarzanie moich danych osobowych w celu otrzymywania newslettera zgodnie z <a href="/polityka-prywatnosci/">polityką prywatności</a>.</span>
			</label>
			<button type="submit" class="env-newsletter__submit env-arrow">zapisz się</button>
			<p class="env-newsletter__msg" role="status" aria-live="polite"></p>
		</form>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
