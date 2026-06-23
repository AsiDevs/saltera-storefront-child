<?php
/*
 * WooCommerce single product page override.
 */

get_header();

while ( have_posts() ) :
	the_post();

	$product = get_post();
	include( get_stylesheet_directory() . '/template-parts/template-common/product/single.php' );

	$title       = get_field( 'iwt_title' );
	$description = get_field( 'iwt_description' );
	$content     = get_field( 'content' );
	include( get_stylesheet_directory() . '/template-parts/template-common/image-with-text/index.php' );

	$title       = get_field( 'features_title' );
	$description = get_field( 'features_description' );
	$features    = get_field( 'features' );
	include( get_stylesheet_directory() . '/template-parts/template-common/features/index.php' );

	$title       = get_field( 'faq_title' );
	$description = get_field( 'faq_description' );
	$faqs        = get_field( 'faqs_list' );
	include( get_stylesheet_directory() . '/template-parts/template-common/faqs/index.php' );

	$product = wc_get_product( get_the_ID() );

endwhile;

get_footer();
