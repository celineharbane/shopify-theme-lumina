<?php
/**
 * News / expositions section.
 *
 * @package JocelyneBosschot
 */

$exhibitions = jb_exhibitions();
?>
<section class="news-section" id="news">
	<div class="section-inner">
		<p class="section-label reveal"><span data-lang="fr">Actualités</span><span data-lang="en">News</span></p>
		<h2 class="section-title reveal"><span data-lang="fr">Expositions & <em>Sélections</em></span><span data-lang="en">Exhibitions & <em>Selections</em></span></h2>
		<div class="expos-list">
			<?php foreach ( $exhibitions as $expo ) : ?>
				<article class="expo-item reveal" itemscope itemtype="https://schema.org/Event">
					<div class="expo-date"><?php echo esc_html( $expo['year'] ); ?></div>
					<div class="expo-info">
						<h3 itemprop="name">
							<?php if ( isset( $expo['name'] ) ) : ?>
								<?php echo esc_html( $expo['name'] ); ?>
							<?php else : ?>
								<span data-lang="fr"><?php echo esc_html( $expo['name_fr'] ); ?></span>
								<span data-lang="en"><?php echo esc_html( $expo['name_en'] ); ?></span>
							<?php endif; ?>
						</h3>
						<p itemprop="location">
							<span data-lang="fr"><?php echo esc_html( $expo['loc_fr'] ); ?></span>
							<span data-lang="en"><?php echo esc_html( $expo['loc_en'] ); ?></span>
						</p>
					</div>
					<span class="expo-status <?php echo esc_attr( $expo['status'] ); ?>"><?php echo esc_html( $expo['badge'] ); ?></span>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
