<?php
/**
 * Header template.
 *
 * @package JocelyneBosschot
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav role="navigation" aria-label="<?php esc_attr_e( 'Navigation principale', 'jocelyne-bosschot' ); ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">Jocelyne Bosschot</a>
	<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Menu', 'jocelyne-bosschot' ); ?>" aria-expanded="false"><span></span><span></span><span></span></button>
	<div class="links">
		<a href="#galeries"><span data-lang="fr">Galeries</span><span data-lang="en">Galleries</span></a>
		<a href="#boutique"><span data-lang="fr">Boutique</span><span data-lang="en">Shop</span></a>
		<a href="#demarche"><span data-lang="fr">Démarche</span><span data-lang="en">Approach</span></a>
		<a href="#parcours"><span data-lang="fr">Parcours</span><span data-lang="en">Career</span></a>
		<a href="#news"><span data-lang="fr">Expos</span><span data-lang="en">Exhibitions</span></a>
		<a href="#presse"><span data-lang="fr">Presse</span><span data-lang="en">Press</span></a>
		<a href="#contact">Contact</a>
		<button class="lang-btn" type="button" aria-label="<?php esc_attr_e( 'Change language', 'jocelyne-bosschot' ); ?>">EN</button>
	</div>
</nav>
