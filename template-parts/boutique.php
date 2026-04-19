<?php
/**
 * Boutique section.
 *
 * @package JocelyneBosschot
 */

$items = jb_shop_items();
?>
<section class="boutique-section" id="boutique">
	<div class="section-inner">
		<p class="section-label reveal"><span data-lang="fr">Acquérir une œuvre</span><span data-lang="en">Acquire a work</span></p>
		<h2 class="section-title reveal"><span data-lang="fr">La <em>Boutique</em></span><span data-lang="en">The <em>Shop</em></span></h2>
		<div class="boutique-grid">
			<?php foreach ( $items as $i => $item ) :
				$delay = ( $i % 3 ) * 0.08; ?>
				<div class="boutique-card reveal"<?php echo $delay ? ' style="transition-delay:' . esc_attr( number_format( $delay, 2 ) ) . 's"' : ''; ?>>
					<img src="<?php echo esc_url( $item['src'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy">
					<div class="boutique-card-body">
						<h4><?php echo esc_html( $item['title'] ); ?></h4>
						<p class="material"><?php echo esc_html( $item['material'] ); ?></p>
						<?php if ( ! empty( $item['dims'] ) ) : ?>
							<p class="dims"><?php echo esc_html( $item['dims'] ); ?></p>
						<?php endif; ?>
						<p class="price">
							<?php if ( 'on_request' === $item['price'] ) : ?>
								<span data-lang="fr">Prix sur demande</span><span data-lang="en">Price on request</span>
							<?php else : ?>
								<?php echo esc_html( $item['price'] ); ?>
							<?php endif; ?>
						</p>
						<a href="#contact" class="btn-contact"><span data-lang="fr">Contacter</span><span data-lang="en">Contact</span></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
