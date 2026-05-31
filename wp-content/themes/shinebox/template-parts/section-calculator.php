<?php
/**
 * Price calculator section. The options are rendered server-side from the
 * pricing model; main.js wires up the live total.
 *
 * @package ShineBox
 */

$lang      = shinebox_current_lang();
$car_types = shinebox_car_types();
$services  = shinebox_services();
?>
<section class="section section-alt" id="calculator">
	<div class="container">
		<header class="section-head">
			<h2><?php shinebox_e( 'calc_title' ); ?></h2>
			<p class="muted"><?php shinebox_e( 'calc_subtitle' ); ?></p>
		</header>

		<div class="calculator" id="calc">
			<div class="calc-fields">
				<fieldset class="calc-block">
					<legend><?php shinebox_e( 'calc_car_type' ); ?></legend>
					<div class="calc-options calc-cartypes">
						<?php foreach ( $car_types as $i => $type ) : ?>
							<label class="option-pill">
								<input
									type="radio"
									name="sb-cartype"
									value="<?php echo esc_attr( $type['id'] ); ?>"
									data-mult="<?php echo esc_attr( $type['mult'] ); ?>"
									<?php checked( 0, $i ); ?>
								>
								<span><?php echo esc_html( $type['label'][ $lang ] ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</fieldset>

				<fieldset class="calc-block">
					<legend><?php shinebox_e( 'calc_services' ); ?></legend>
					<div class="calc-options calc-services">
						<?php foreach ( $services as $service ) : ?>
							<label class="option-row">
								<input
									type="checkbox"
									name="sb-service"
									value="<?php echo esc_attr( $service['id'] ); ?>"
									data-price="<?php echo esc_attr( $service['price'] ); ?>"
									data-label="<?php echo esc_attr( $service['label'][ $lang ] ); ?>"
								>
								<span class="option-label"><?php echo esc_html( $service['label'][ $lang ] ); ?></span>
								<span class="option-price"><?php echo esc_html( number_format_i18n( $service['price'] ) ); ?> ₾</span>
							</label>
						<?php endforeach; ?>
					</div>
				</fieldset>
			</div>

			<aside class="calc-summary" aria-live="polite">
				<p class="summary-label"><?php shinebox_e( 'calc_total' ); ?></p>
				<p class="summary-total"><span id="calc-total">0</span> ₾</p>
				<p class="summary-note muted" id="calc-hint"><?php shinebox_e( 'calc_pick_service' ); ?></p>
				<p class="summary-note muted"><?php shinebox_e( 'calc_note' ); ?></p>
				<a class="btn btn-primary" id="calc-book-btn" href="#book"><?php shinebox_e( 'calc_book' ); ?></a>
			</aside>
		</div>
	</div>
</section>
