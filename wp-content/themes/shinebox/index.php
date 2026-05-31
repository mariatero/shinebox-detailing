<?php
/**
 * Fallback template.
 *
 * WordPress uses front-page.php for the home page; this exists so the theme
 * is valid for any other request.
 *
 * @package ShineBox
 */

get_header();
?>

<main id="main" class="site-main">
	<?php
	get_template_part( 'template-parts/section', 'hero' );
	get_template_part( 'template-parts/section', 'services' );
	get_template_part( 'template-parts/section', 'calculator' );
	get_template_part( 'template-parts/section', 'gallery' );
	get_template_part( 'template-parts/section', 'reviews' );
	get_template_part( 'template-parts/section', 'booking' );
	?>
</main>

<?php
get_footer();
