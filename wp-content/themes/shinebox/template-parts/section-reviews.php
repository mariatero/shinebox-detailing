<?php
/**
 * Reviews section.
 *
 * Edit the $reviews array to manage testimonials. Each one carries an
 * en/ka version so the copy switches with the rest of the site.
 *
 * @package ShineBox
 */

$lang = shinebox_current_lang();

$reviews = array(
	array(
		'name' => 'Giorgi M.',
		'stars' => 5,
		'text' => array(
			'en' => 'They came to my office and made my black sedan look brand new. Zero swirls under the sun now.',
			'ka' => 'ჩემს ოფისთან მოვიდნენ და ჩემი შავი სედანი ახალივით გახადეს. მზეზე აღარც ერთი ნაკაწრი ჩანს.',
		),
	),
	array(
		'name' => 'Nino K.',
		'stars' => 5,
		'text' => array(
			'en' => 'Booked the full package for our SUV. Interior smells fresh and the ceramic coating is amazing.',
			'ka' => 'სრული პაკეტი ავიღეთ ჩვენი SUV-სთვის. სალონი ახალ სუნს ასდის და კერამიკული დაფარვა შესანიშნავია.',
		),
	),
	array(
		'name' => 'Luka T.',
		'stars' => 5,
		'text' => array(
			'en' => 'Super convenient — they did everything in my driveway. Fair price, great result.',
			'ka' => 'ძალიან მოსახერხებელია — ყველაფერი ჩემს ეზოში გააკეთეს. ფასი სამართლიანია, შედეგი მშვენიერი.',
		),
	),
);
?>
<section class="section section-alt" id="reviews">
	<div class="container">
		<header class="section-head">
			<h2><?php shinebox_e( 'reviews_title' ); ?></h2>
		</header>

		<div class="cards">
			<?php foreach ( $reviews as $review ) : ?>
				<article class="card review-card">
					<div class="stars" aria-label="<?php echo esc_attr( $review['stars'] . '/5' ); ?>">
						<?php echo str_repeat( '★', (int) $review['stars'] ); // phpcs:ignore ?>
					</div>
					<p class="review-text">“<?php echo esc_html( $review['text'][ $lang ] ); ?>”</p>
					<p class="review-name"><?php echo esc_html( $review['name'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
