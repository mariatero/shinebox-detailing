<?php
/**
 * Gallery section — before/after slider cards.
 *
 * Replace the placeholder <div class="ba-img"> blocks with real <img> tags
 * (or wire them to a WP gallery / ACF field) once photos are available.
 *
 * @package ShineBox
 */

// Each card uses one photo in both panes; the "before" pane is dulled via CSS
// to simulate the pre-detailing state. Swap these for real before/after pairs
// (different files) whenever the owner has them.
$img = get_template_directory_uri() . '/assets/img/';
$items = array(
	array( 'before' => $img . 'car2.jpg', 'after' => $img . 'car2.jpg' ),
	array( 'before' => $img . 'car1.jpg', 'after' => $img . 'car1.jpg' ),
	array( 'before' => $img . 'car3.jpg', 'after' => $img . 'car3.jpg' ),
);
?>
<section class="section" id="gallery">
	<div class="container">
		<header class="section-head">
			<h2><?php shinebox_e( 'gallery_title' ); ?></h2>
			<p class="muted"><?php shinebox_e( 'gallery_subtitle' ); ?></p>
		</header>

		<div class="gallery-grid">
			<?php foreach ( $items as $item ) : ?>
				<figure class="ba-card" data-pos="50">
					<div class="ba-pane ba-after">
						<?php if ( $item['after'] ) : ?>
							<img src="<?php echo esc_url( $item['after'] ); ?>" alt="">
						<?php else : ?>
							<div class="ba-img ba-img-after" aria-hidden="true"></div>
						<?php endif; ?>
						<span class="ba-tag ba-tag-after"><?php shinebox_e( 'gallery_after' ); ?></span>
					</div>
					<div class="ba-pane ba-before">
						<?php if ( $item['before'] ) : ?>
							<img src="<?php echo esc_url( $item['before'] ); ?>" alt="">
						<?php else : ?>
							<div class="ba-img ba-img-before" aria-hidden="true"></div>
						<?php endif; ?>
						<span class="ba-tag ba-tag-before"><?php shinebox_e( 'gallery_before' ); ?></span>
					</div>
					<input class="ba-range" type="range" min="0" max="100" value="50" aria-label="Before / after">
					<span class="ba-handle" aria-hidden="true"></span>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
