<?php
/**
 * Site header.
 *
 * @package ShineBox
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="top">
	<div class="container header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="brand-mark">✦</span>
			<span class="brand-name">ShineBox</span>
		</a>

		<nav class="main-nav" aria-label="Primary">
			<a href="#services"><?php shinebox_e( 'nav_services' ); ?></a>
			<a href="#calculator"><?php shinebox_e( 'nav_calculator' ); ?></a>
			<a href="#gallery"><?php shinebox_e( 'nav_gallery' ); ?></a>
			<a href="#reviews"><?php shinebox_e( 'nav_reviews' ); ?></a>
		</nav>

		<div class="header-actions">
			<?php
			$current = shinebox_current_lang();
			$names   = shinebox_lang_names();
			?>
			<div class="lang-switch" data-lang-switch>
				<button
					type="button"
					class="lang-current"
					aria-haspopup="listbox"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'Change language', 'shinebox' ); ?>"
				>
					<span class="lang-flag"><?php echo esc_html( $names[ $current ]['flag'] ); ?></span>
					<span class="lang-code"><?php echo esc_html( shinebox_langs()[ $current ] ); ?></span>
					<svg class="lang-caret" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</button>
				<ul class="lang-menu" role="listbox">
					<?php foreach ( shinebox_langs() as $slug => $label ) : ?>
						<li role="option" aria-selected="<?php echo ( $slug === $current ) ? 'true' : 'false'; ?>">
							<a
								class="lang-item<?php echo ( $slug === $current ) ? ' is-active' : ''; ?>"
								href="<?php echo esc_url( shinebox_lang_url( $slug ) ); ?>"
							>
								<span class="lang-flag"><?php echo esc_html( $names[ $slug ]['flag'] ); ?></span>
								<span><?php echo esc_html( $names[ $slug ]['native'] ); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<a class="btn btn-primary btn-sm" href="#book"><?php shinebox_e( 'nav_book' ); ?></a>
			<button class="nav-toggle" aria-label="Menu" aria-expanded="false">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>
