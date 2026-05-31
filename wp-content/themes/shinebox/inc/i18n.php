<?php
/**
 * Lightweight bilingual layer (English / Georgian).
 *
 * The theme ships all UI text here so the site is fully bilingual out of the
 * box — even before Polylang is configured. When Polylang IS active we defer
 * to its current language; otherwise we fall back to a ?lang= query param
 * stored in a cookie. Either way `shinebox_t()` returns the right string.
 *
 * @package ShineBox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Supported languages. First entry is the default.
 *
 * @return array<string,string> slug => native label
 */
function shinebox_langs() {
	return array(
		'en' => 'EN',
		'ka' => 'ქარ',
	);
}

/**
 * Display data for the language dropdown.
 *
 * @return array<string,array{native:string,flag:string}>
 */
function shinebox_lang_names() {
	return array(
		'en' => array( 'native' => 'English', 'flag' => '🇬🇧' ),
		'ka' => array( 'native' => 'ქართული', 'flag' => '🇬🇪' ),
	);
}

/**
 * Resolve the active language slug.
 *
 * @return string 'en' or 'ka'
 */
function shinebox_current_lang() {
	static $lang = null;
	if ( null !== $lang ) {
		return $lang;
	}

	$supported = array_keys( shinebox_langs() );

	// 1) Polylang, if installed and active.
	if ( function_exists( 'pll_current_language' ) ) {
		$pll = pll_current_language( 'slug' );
		if ( $pll && in_array( $pll, $supported, true ) ) {
			return $lang = $pll;
		}
	}

	// 2) Explicit ?lang= override (remembered in a cookie).
	if ( isset( $_GET['lang'] ) ) {
		$req = sanitize_key( wp_unslash( $_GET['lang'] ) );
		if ( in_array( $req, $supported, true ) ) {
			setcookie( 'shinebox_lang', $req, time() + YEAR_IN_SECONDS, '/' );
			return $lang = $req;
		}
	}

	// 3) Previously chosen language from the cookie.
	if ( isset( $_COOKIE['shinebox_lang'] ) ) {
		$cookie = sanitize_key( wp_unslash( $_COOKIE['shinebox_lang'] ) );
		if ( in_array( $cookie, $supported, true ) ) {
			return $lang = $cookie;
		}
	}

	// 4) Default.
	return $lang = $supported[0];
}

/**
 * Translate a key for the active language.
 *
 * @param string $key Translation key.
 * @return string
 */
function shinebox_t( $key ) {
	$dict = shinebox_dictionary();
	$lang = shinebox_current_lang();

	if ( isset( $dict[ $key ][ $lang ] ) ) {
		return $dict[ $key ][ $lang ];
	}
	if ( isset( $dict[ $key ]['en'] ) ) {
		return $dict[ $key ]['en'];
	}
	return $key;
}

/**
 * Echo helper for shinebox_t().
 *
 * @param string $key Translation key.
 */
function shinebox_e( $key ) {
	echo esc_html( shinebox_t( $key ) );
}

/**
 * Build a URL that switches the site to a given language.
 *
 * @param string $slug Target language slug.
 * @return string
 */
function shinebox_lang_url( $slug ) {
	// If Polylang is active, use its per-language home URLs.
	if ( function_exists( 'pll_home_url' ) ) {
		$url = pll_home_url( $slug );
		if ( $url ) {
			return $url;
		}
	}
	return esc_url( add_query_arg( 'lang', $slug, home_url( '/' ) ) );
}

/**
 * The full UI dictionary: key => [ en => ..., ka => ... ].
 *
 * @return array
 */
function shinebox_dictionary() {
	return array(
		// Brand / nav.
		'tagline'           => array(
			'en' => 'Mobile car polishing & detailing',
			'ka' => 'მობილური ავტო პოლირება და დეტეილინგი',
		),
		'nav_services'      => array( 'en' => 'Services', 'ka' => 'სერვისები' ),
		'nav_calculator'    => array( 'en' => 'Price calculator', 'ka' => 'ფასის კალკულატორი' ),
		'nav_gallery'       => array( 'en' => 'Gallery', 'ka' => 'გალერეა' ),
		'nav_reviews'       => array( 'en' => 'Reviews', 'ka' => 'შეფასებები' ),
		'nav_book'          => array( 'en' => 'Book now', 'ka' => 'დაჯავშნა' ),

		// Hero.
		'hero_title'        => array(
			'en' => 'We bring the shine to your driveway',
			'ka' => 'ბრწყინვალებას თქვენთან მივიტანთ',
		),
		'hero_subtitle'     => array(
			'en' => 'Professional mobile polishing & detailing across the city. We come to you — at home or at the office.',
			'ka' => 'პროფესიონალური მობილური პოლირება და დეტეილინგი ქალაქის მასშტაბით. ჩვენ თქვენთან მოვდივართ — სახლში ან ოფისში.',
		),
		'hero_cta'          => array( 'en' => 'Get a free quote', 'ka' => 'მიიღეთ უფასო შეფასება' ),
		'hero_cta_2'        => array( 'en' => 'View services', 'ka' => 'სერვისების ნახვა' ),

		// Services section.
		'services_title'    => array( 'en' => 'Our services', 'ka' => 'ჩვენი სერვისები' ),
		'services_subtitle' => array(
			'en' => 'Choose a single service or a full detailing package.',
			'ka' => 'აირჩიეთ ცალკეული სერვისი ან სრული დეტეილინგის პაკეტი.',
		),

		// Calculator.
		'calc_title'        => array( 'en' => 'Estimate your price', 'ka' => 'გამოთვალეთ ფასი' ),
		'calc_subtitle'     => array(
			'en' => 'Pick your vehicle type and the services you need.',
			'ka' => 'აირჩიეთ მანქანის ტიპი და სასურველი სერვისები.',
		),
		'calc_car_type'     => array( 'en' => 'Vehicle type', 'ka' => 'მანქანის ტიპი' ),
		'calc_services'     => array( 'en' => 'Services', 'ka' => 'სერვისები' ),
		'calc_total'        => array( 'en' => 'Estimated total', 'ka' => 'სავარაუდო ჯამი' ),
		'calc_from'         => array( 'en' => 'from', 'ka' => 'დან' ),
		'calc_pick_service' => array(
			'en' => 'Select at least one service',
			'ka' => 'აირჩიეთ მინიმუმ ერთი სერვისი',
		),
		'calc_note'         => array(
			'en' => 'Final price is confirmed after a quick look at your car.',
			'ka' => 'საბოლოო ფასი დგინდება მანქანის დათვალიერების შემდეგ.',
		),
		'calc_book'         => array( 'en' => 'Book this', 'ka' => 'დაჯავშნა' ),

		// Gallery.
		'gallery_title'     => array( 'en' => 'Before & after', 'ka' => 'მანამდე და შემდეგ' ),
		'gallery_subtitle'  => array(
			'en' => 'Real results from real cars.',
			'ka' => 'რეალური შედეგები რეალურ მანქანებზე.',
		),
		'gallery_before'    => array( 'en' => 'Before', 'ka' => 'მანამდე' ),
		'gallery_after'     => array( 'en' => 'After', 'ka' => 'შემდეგ' ),

		// Booking form.
		'book_title'        => array( 'en' => 'Book your detailing', 'ka' => 'დაჯავშნეთ დეტეილინგი' ),
		'book_subtitle'     => array(
			'en' => 'Leave a request and we will call you back to confirm the time.',
			'ka' => 'დატოვეთ განაცხადი და ჩვენ დაგირეკავთ დროის დასადასტურებლად.',
		),
		'form_name'         => array( 'en' => 'Your name', 'ka' => 'თქვენი სახელი' ),
		'form_phone'        => array( 'en' => 'Phone number', 'ka' => 'ტელეფონის ნომერი' ),
		'form_car'          => array( 'en' => 'Car make & model', 'ka' => 'მანქანის მარკა და მოდელი' ),
		'form_message'      => array( 'en' => 'Message (optional)', 'ka' => 'შეტყობინება (სურვილისამებრ)' ),
		'form_submit'       => array( 'en' => 'Send request', 'ka' => 'განაცხადის გაგზავნა' ),
		'form_or'           => array( 'en' => 'or message us on', 'ka' => 'ან მოგვწერეთ' ),
		'form_whatsapp'     => array( 'en' => 'WhatsApp', 'ka' => 'WhatsApp' ),
		'form_sending'      => array( 'en' => 'Sending…', 'ka' => 'იგზავნება…' ),
		'form_success'      => array(
			'en' => 'Thanks! We received your request and will call you shortly.',
			'ka' => 'მადლობა! მივიღეთ თქვენი განაცხადი და მალე დაგირეკავთ.',
		),
		'form_error'        => array(
			'en' => 'Something went wrong. Please try WhatsApp or call us.',
			'ka' => 'რაღაც შეცდომა მოხდა. სცადეთ WhatsApp ან დაგვირეკეთ.',
		),

		// Reviews.
		'reviews_title'     => array( 'en' => 'What clients say', 'ka' => 'რას ამბობენ კლიენტები' ),

		// Footer.
		'footer_follow'     => array( 'en' => 'Follow us', 'ka' => 'გამოგვყევით' ),
		'footer_rights'     => array( 'en' => 'All rights reserved.', 'ka' => 'ყველა უფლება დაცულია.' ),
	);
}
