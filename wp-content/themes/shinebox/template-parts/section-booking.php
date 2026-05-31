<?php
/**
 * Booking section — request form (email via AJAX) + WhatsApp shortcut.
 *
 * @package ShineBox
 */

?>
<section class="section section-book" id="book">
	<div class="container">
		<header class="section-head">
			<h2><?php shinebox_e( 'book_title' ); ?></h2>
			<p class="muted"><?php shinebox_e( 'book_subtitle' ); ?></p>
		</header>

		<div class="book-wrap">
			<form class="book-form" id="booking-form" novalidate>
				<div class="field">
					<label for="bf-name"><?php shinebox_e( 'form_name' ); ?></label>
					<input type="text" id="bf-name" name="name" required>
				</div>
				<div class="field">
					<label for="bf-phone"><?php shinebox_e( 'form_phone' ); ?></label>
					<input type="tel" id="bf-phone" name="phone" required>
				</div>
				<div class="field">
					<label for="bf-car"><?php shinebox_e( 'form_car' ); ?></label>
					<input type="text" id="bf-car" name="car">
				</div>
				<div class="field">
					<label for="bf-message"><?php shinebox_e( 'form_message' ); ?></label>
					<textarea id="bf-message" name="message" rows="3"></textarea>
				</div>

				<button type="submit" class="btn btn-primary btn-block"><?php shinebox_e( 'form_submit' ); ?></button>
				<p class="form-status" id="form-status" role="status" aria-live="polite"></p>

				<p class="form-alt muted">
					<?php shinebox_e( 'form_or' ); ?>
					<a href="<?php echo esc_url( shinebox_whatsapp_url( shinebox_t( 'book_title' ) ) ); ?>" target="_blank" rel="noopener"><?php shinebox_e( 'form_whatsapp' ); ?></a>
				</p>
			</form>
		</div>
	</div>
</section>
