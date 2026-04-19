<?php
/**
 * Parcours & distinctions section.
 *
 * @package JocelyneBosschot
 */

$timeline = jb_timeline();
?>
<section class="parcours-section" id="parcours">
	<div class="section-inner">
		<p class="section-label reveal"><span data-lang="fr">Biographie</span><span data-lang="en">Biography</span></p>
		<h2 class="section-title reveal"><span data-lang="fr">Parcours & <em>Distinctions</em></span><span data-lang="en">Career & <em>Awards</em></span></h2>
		<p class="section-desc reveal">
			<span data-lang="fr">Sélectionnée en 2009 au Concours International de Porcelaine de Limoges, en 2011 au Concours International de Corée CeraMIX, Jocelyne Bosschot s'affirme dans ses créations. Ses Colonnes Totem, réalisées en résidence à la Manufacture de Limoges, allient tradition et avant-garde.</span>
			<span data-lang="en">Selected in 2009 for the International Porcelain Competition in Limoges, in 2011 for the International CeraMIX Competition in Korea, Jocelyne Bosschot asserts herself through her creations. Her Totem Columns, created in residence at the Limoges Manufacture, combine tradition and avant-garde.</span>
		</p>
		<ol class="timeline reveal">
			<?php foreach ( $timeline as $event ) : ?>
				<li>
					<span class="year"><?php echo esc_html( $event['year'] ); ?></span>
					<h3>
						<?php if ( $event['title_fr'] === $event['title_en'] ) : ?>
							<?php echo esc_html( $event['title_fr'] ); ?>
						<?php else : ?>
							<span data-lang="fr"><?php echo esc_html( $event['title_fr'] ); ?></span>
							<span data-lang="en"><?php echo esc_html( $event['title_en'] ); ?></span>
						<?php endif; ?>
					</h3>
					<p>
						<span data-lang="fr"><?php echo esc_html( $event['desc_fr'] ); ?></span>
						<span data-lang="en"><?php echo esc_html( $event['desc_en'] ); ?></span>
					</p>
				</li>
			<?php endforeach; ?>
		</ol>
		<div class="diploma-card reveal">
			<img src="https://jbosschot.vercel.app/images/DIPOME_D_HONNEUR.JPEG" alt="Diplôme d'Honneur 2011" loading="lazy">
			<div class="info">
				<strong>Diploma of Honor</strong>
				<span>Gyeonggi CeraMIX Biennale &mdash; <span data-lang="fr">Corée</span><span data-lang="en">Korea</span>, 2011</span>
			</div>
		</div>
	</div>
</section>
