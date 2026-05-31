<?php
/**
 * Pricing model for the calculator and the services section.
 *
 * Edit the numbers here to update prices everywhere (services list +
 * calculator stay in sync because they read from the same source).
 *
 * @package ShineBox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Vehicle types. `mult` is the price multiplier applied to every service.
 *
 * @return array
 */
function shinebox_car_types() {
	return array(
		array(
			'id'    => 'sedan',
			'label' => array( 'en' => 'Sedan / Hatchback', 'ka' => 'სედანი / ჰეჩბეკი' ),
			'mult'  => 1.0,
		),
		array(
			'id'    => 'crossover',
			'label' => array( 'en' => 'Crossover / SUV', 'ka' => 'კროსოვერი / SUV' ),
			'mult'  => 1.3,
		),
		array(
			'id'    => 'large',
			'label' => array( 'en' => 'Large SUV / Van', 'ka' => 'დიდი SUV / მინივენი' ),
			'mult'  => 1.6,
		),
	);
}

/**
 * Services with base prices (in GEL, for a Sedan).
 *
 * @return array
 */
function shinebox_services() {
	return array(
		array(
			'id'    => 'body_polish',
			'label' => array( 'en' => 'Body polishing', 'ka' => 'ძარის პოლირება' ),
			'desc'  => array(
				'en' => 'Restores gloss, removes swirls, scratches and haze.',
				'ka' => 'აღადგენს ბზინვარებას, აშორებს ნაკაწრებსა და მქრქალობას.',
			),
			'price' => 150,
		),
		array(
			'id'    => 'interior',
			'label' => array( 'en' => 'Interior cleaning', 'ka' => 'სალონის წმენდა' ),
			'desc'  => array(
				'en' => 'Deep clean of seats, panels, carpets and trim.',
				'ka' => 'სავარძლების, პანელების და ხალიჩების ღრმა წმენდა.',
			),
			'price' => 100,
		),
		array(
			'id'    => 'headlights',
			'label' => array( 'en' => 'Headlight restoration', 'ka' => 'ფარების აღდგენა' ),
			'desc'  => array(
				'en' => 'Removes yellowing and clouding for clear, bright lights.',
				'ka' => 'აშორებს გაყვითლებას და სიმღვრივეს — ფარები ისევ კაშკაშაა.',
			),
			'price' => 80,
		),
	);
}

/**
 * Look up a service definition by id.
 *
 * @param string $id Service id.
 * @return array|null
 */
function shinebox_service_by_id( $id ) {
	foreach ( shinebox_services() as $service ) {
		if ( $service['id'] === $id ) {
			return $service;
		}
	}
	return null;
}
