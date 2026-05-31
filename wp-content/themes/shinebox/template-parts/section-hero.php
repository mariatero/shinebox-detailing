<?php
/**
 * Hero section.
 *
 * @package ShineBox
 */

$hero_img = get_template_directory_uri() . '/assets/img/hero.jpg';
?>
<section class="hero" id="hero">
	<div class="hero-photo" style="background-image:url('<?php echo esc_url( $hero_img ); ?>');" aria-hidden="true"></div>
	<div class="hero-overlay" aria-hidden="true"></div>
	<div class="hero-shine" aria-hidden="true"></div>

	<div class="container hero-inner">
		<div class="hero-copy">
			<p class="eyebrow"><?php shinebox_e( 'tagline' ); ?></p>
			<h1 class="hero-title"><?php shinebox_e( 'hero_title' ); ?></h1>
			<p class="hero-subtitle"><?php shinebox_e( 'hero_subtitle' ); ?></p>
			<div class="hero-cta">
				<a class="btn btn-primary" href="#book"><?php shinebox_e( 'hero_cta' ); ?></a>
				<a class="btn btn-ghost" href="#services"><?php shinebox_e( 'hero_cta_2' ); ?></a>
			</div>
		</div>
	</div>
</section>
