<?php
/**
 * Presse section.
 *
 * @package JocelyneBosschot
 */

$press_imgs = jb_press_images();
$kits       = jb_press_kits();
?>
<section class="presse-section" id="presse">
	<div class="section-inner">
		<p class="section-label reveal"><span data-lang="fr">Médias</span><span data-lang="en">Media</span></p>
		<h2 class="section-title reveal"><em>Presse</em></h2>
		<div class="presse-grid reveal">
			<?php foreach ( $press_imgs as $i => $src ) : ?>
				<img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( sprintf( __( 'Article de presse %d', 'jocelyne-bosschot' ), $i + 1 ) ); ?>" loading="lazy" data-lightbox>
			<?php endforeach; ?>
		</div>
		<h3 class="section-title reveal" style="font-size:1.5rem;margin-top:2.5rem"><span data-lang="fr">Dossiers de presse</span><span data-lang="en">Press kits</span></h3>
		<div class="dossiers reveal">
			<?php foreach ( $kits as $kit ) : ?>
				<a href="<?php echo esc_url( $kit['url'] ); ?>" target="_blank" rel="noopener" class="dossier-link">
					<strong><?php echo esc_html( $kit['title'] ); ?></strong>
					<span>
						<span data-lang="fr"><?php echo esc_html( $kit['sub_fr'] ); ?></span>
						<span data-lang="en"><?php echo esc_html( $kit['sub_en'] ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
