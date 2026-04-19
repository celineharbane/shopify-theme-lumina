<?php
/**
 * Fallback template — delegates to front-page sections for any request.
 *
 * @package JocelyneBosschot
 */

get_header();
get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/galeries' );
get_template_part( 'template-parts/boutique' );
get_template_part( 'template-parts/demarche' );
get_template_part( 'template-parts/parcours' );
get_template_part( 'template-parts/news' );
get_template_part( 'template-parts/presse' );
get_template_part( 'template-parts/contact' );
get_footer();
