<?php
/**
 * Hero section with auto-rotating carousel.
 *
 * @package JocelyneBosschot
 */

$slides = jb_hero_slides();
?>
<header class="hero" id="accueil">
	<div class="hero-text">
		<h1 class="reveal">Jocelyne<br><em>Bosschot</em></h1>
		<p class="hero-sub reveal" style="transition-delay:0.1s">
			<span data-lang="fr">sculpture céramique</span>
			<span data-lang="en">ceramic sculpture</span>
		</p>
		<blockquote class="reveal" style="transition-delay:0.2s">
			<span data-lang="fr">« Le pli n'affecte pas seulement toutes les matières, il détermine et fait apparaître la forme, il en fait une forme d'expression. »</span>
			<span data-lang="en">"The fold does not only affect all materials, it determines and reveals form, making it a form of expression."</span>
			<cite>— Gilles Deleuze</cite>
		</blockquote>
		<a href="#galeries" class="hero-cta reveal" style="transition-delay:0.3s">
			<span data-lang="fr">Découvrir les œuvres</span>
			<span data-lang="en">Discover the work</span>
		</a>
	</div>
	<div class="hero-carousel reveal" style="transition-delay:0.15s">
		<?php foreach ( $slides as $i => $slide ) : ?>
			<img src="<?php echo esc_url( $slide['src'] ); ?>" alt="<?php echo esc_attr( $slide['alt'] ); ?>"<?php echo 0 === $i ? ' class="active"' : ''; ?><?php echo 0 === $i ? '' : ' loading="lazy"'; ?>>
		<?php endforeach; ?>
	</div>
</header>
