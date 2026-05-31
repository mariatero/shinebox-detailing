<?php
/**
 * Services section — rendered from the shared pricing model.
 *
 * @package ShineBox
 */

$lang     = shinebox_current_lang();
$services = shinebox_services();
?>
<section class="section" id="services">
	<div class="container">
		<header class="section-head">
			<h2><?php shinebox_e( 'services_title' ); ?></h2>
			<p class="muted"><?php shinebox_e( 'services_subtitle' ); ?></p>
		</header>

		<div class="cards">
			<?php foreach ( $services as $service ) : ?>
				<article class="card service-card<?php echo 'full' === $service['id'] ? ' is-featured' : ''; ?>">
					<h3><?php echo esc_html( $service['label'][ $lang ] ); ?></h3>
					<p class="muted"><?php echo esc_html( $service['desc'][ $lang ] ); ?></p>
					<p class="price">
						<span class="price-from"><?php shinebox_e( 'calc_from' ); ?></span>
						<span class="price-value"><?php echo esc_html( number_format_i18n( $service['price'] ) ); ?> ₾</span>
					</p>
					<a class="btn btn-ghost btn-sm" href="#calculator"><?php shinebox_e( 'nav_calculator' ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
