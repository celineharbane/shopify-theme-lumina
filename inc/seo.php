<?php
/**
 * SEO / GEO meta + JSON-LD schema.org injection.
 *
 * @package JocelyneBosschot
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jb_seo_meta() {
	if ( ! is_front_page() ) {
		return;
	}

	$site_url  = trailingslashit( home_url( '/' ) );
	$og_image  = 'https://cdn.sanity.io/images/ss2h95ey/production/b3fd5894f7a7b1394172e8afa277ea9938da6d95-1928x1920.jpg';
	?>
<meta name="description" content="Jocelyne Bosschot, artiste sculpteur céramique à Saint-Laurent-du-Var (06700). Sculptures en grès et porcelaine, Colonnes Totem, Danse du Feu, Arbre de Vie. Concours International de Limoges, Biennale de Corée.">
<meta name="keywords" content="Jocelyne Bosschot, sculpteur céramique, Saint-Laurent-du-Var, Alpes-Maritimes, porcelaine Limoges, grès, Colonnes Totem, Danse du Feu, art contemporain, 06700, Vallauris, Nice, PACA">
<meta name="author" content="Jocelyne Bosschot">
<meta name="robots" content="index, follow">
<link rel="canonical" href="<?php echo esc_url( $site_url ); ?>">
<link rel="alternate" hreflang="fr" href="<?php echo esc_url( $site_url ); ?>">
<link rel="alternate" hreflang="en" href="<?php echo esc_url( $site_url . 'en/' ); ?>">
<meta property="og:title" content="Jocelyne Bosschot — Sculpture Céramique">
<meta property="og:description" content="Artiste sculpteur céramique. Pièces uniques en grès et porcelaine. Saint-Laurent-du-Var.">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo esc_url( $site_url ); ?>">
<meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
<meta property="og:locale" content="fr_FR">
<meta property="og:locale:alternate" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<meta name="geo.region" content="FR-06">
<meta name="geo.placename" content="Saint-Laurent-du-Var">
<meta name="geo.position" content="43.6607;7.1886">
<meta name="ICBM" content="43.6607, 7.1886">
<?php
	$schema = array(
		'@context'       => 'https://schema.org',
		'@type'          => 'LocalBusiness',
		'additionalType' => 'https://schema.org/Artist',
		'name'           => 'Jocelyne Bosschot — Sculpture Céramique',
		'description'    => "Artiste sculpteur céramique à Saint-Laurent-du-Var. Sculptures en grès et porcelaine, Colonnes Totem en porcelaine de Limoges, expositions internationales.",
		'url'            => home_url( '/' ),
		'email'          => 'contact@jocelynebosschot.com',
		'address'        => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Saint-Laurent-du-Var',
			'addressRegion'   => "Provence-Alpes-Côte d'Azur",
			'postalCode'      => '06700',
			'addressCountry'  => 'FR',
		),
		'geo'            => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => '43.6607',
			'longitude' => '7.1886',
		),
		'makesOffer'     => array(
			array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Product', 'name' => 'Sculptures céramique pièces uniques' ) ),
			array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Colonnes Totem — porcelaine de Limoges' ) ),
			array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => "Décoration d'intérieur — luminaires, sculptures" ) ),
		),
		'award'          => array(
			'Concours International de Porcelaine de Limoges 2009',
			"Biennale Internationale CeraMIX, Corée 2011 — Diplôme d'Honneur",
			'Triennale de Céramique, Pays-Bas 2015',
			"Terra Rossa, Ateliers d'Art de France 2017",
		),
	);
	?>
<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
<?php
}
add_action( 'wp_head', 'jb_seo_meta', 1 );
