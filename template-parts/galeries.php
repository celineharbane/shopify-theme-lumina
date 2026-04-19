<?php
/**
 * Galeries section — tabbed collections.
 *
 * @package JocelyneBosschot
 */

$galleries = jb_galleries();
$tab_keys  = array_keys( $galleries );
$first_key = reset( $tab_keys );
?>
<section class="galeries-section" id="galeries">
	<div class="section-inner">
		<p class="section-label reveal">Collections</p>
		<h2 class="section-title reveal"><span data-lang="fr">Les <em>Galeries</em></span><span data-lang="en">The <em>Galleries</em></span></h2>

		<div class="gallery-tabs reveal">
			<?php foreach ( $galleries as $key => $gallery ) : ?>
				<button class="gallery-tab<?php echo $key === $first_key ? ' active' : ''; ?>" data-tab="<?php echo esc_attr( $key ); ?>" type="button">
					<span data-lang="fr"><?php echo esc_html( $gallery['label_fr'] ); ?></span>
					<span data-lang="en"><?php echo esc_html( $gallery['label_en'] ); ?></span>
				</button>
			<?php endforeach; ?>
		</div>

		<?php foreach ( $galleries as $key => $gallery ) : ?>
			<div class="gallery-collection<?php echo $key === $first_key ? ' active' : ''; ?>" data-collection="<?php echo esc_attr( $key ); ?>">
				<p class="gallery-collection-desc">
					<span data-lang="fr"><?php echo esc_html( $gallery['desc_fr'] ); ?></span>
					<span data-lang="en"><?php echo esc_html( $gallery['desc_en'] ); ?></span>
				</p>
				<div class="gallery-grid">
					<?php foreach ( $gallery['items'] as $item ) : ?>
						<div class="gallery-card" data-lightbox>
							<img src="<?php echo esc_url( $item['src'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
							<div class="gallery-card-info">
								<h4><?php echo esc_html( $item['title'] ); ?></h4>
								<p><?php echo esc_html( $item['sub'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
