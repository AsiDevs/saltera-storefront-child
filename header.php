<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Globals -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/global/globals.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/global/common.css">

<!-- Layout -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/navbar/navbar.css">


<!-- Common -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/hero/hero.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/faq/faq.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/features/features.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/product/product.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/image-with-text/image-with-text.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/footer/footer.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/common/vision-statement/vision-statement.css">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<?php
	$announcement = function_exists( 'get_field' ) ? get_field( 'announcement_text', 'option' ) : '';
	if ( $announcement ) : ?>
	<div class="announcement-bar" id="announcement-bar">
		<div class="announcement-bar__content">
			<p class="announcement-bar__text"><?php echo wp_kses_post( $announcement ); ?></p>
			<button class="announcement-bar__close" aria-label="Close announcement">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
					<line x1="2" y1="2" x2="14" y2="14"/>
					<line x1="14" y1="2" x2="2" y2="14"/>
				</svg>
			</button>
		</div>
	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header" role="banner">

		<div class="navbar section-container">

			<button class="navbar__toggle" aria-label="Open menu" aria-expanded="false">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
					<line x1="3" y1="6"  x2="21" y2="6"/>
					<line x1="3" y1="12" x2="21" y2="12"/>
					<line x1="3" y1="18" x2="21" y2="18"/>
				</svg>
			</button>

			<div class="navbar__logo">
				<?php the_custom_logo(); ?>
			</div>

			<nav class="navbar__nav" aria-label="Primary navigation">
				<?php wp_nav_menu([
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'navbar__menu',
					'fallback_cb'    => false,
				]); ?>
			</nav>

			<div class="navbar__icons">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="navbar__icon-link" aria-label="My account">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
						<circle cx="12" cy="8" r="4"/>
						<path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
					</svg>
				</a>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="navbar__icon-link navbar__cart-link" aria-label="Cart">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
						<path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
						<line x1="3" y1="6" x2="21" y2="6"/>
						<path d="M16 10a4 4 0 01-8 0"/>
					</svg>
					<?php if ( function_exists( 'WC' ) && WC()->cart && WC()->cart->get_cart_contents_count() > 0 ) : ?>
						<span class="navbar__cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
					<?php endif; ?>
				</a>
			</div>

		</div>

		<div class="navbar__mobile-nav" aria-hidden="true">
			<?php wp_nav_menu([
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'navbar__mobile-menu',
				'fallback_cb'    => false,
			]); ?>
		</div>

		<?php do_action( 'storefront_header' ); ?>

	</header><!-- #masthead -->



	<div id="content" class="site-content" tabindex="-1">
		<div class="">

		<?php
		do_action( 'storefront_content_top' );
