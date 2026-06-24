<?php
if ( empty( $product ) ) return;

$product_id = $product->ID;
$wc_product = function_exists( 'wc_get_product' ) ? wc_get_product( $product_id ) : null;
if ( ! $wc_product ) return;

$image_url    = get_the_post_thumbnail_url( $product_id, 'large' ) ?: '';
$title        = get_the_title( $product_id );
$short_desc   = $wc_product->get_short_description();
$price_html   = $wc_product->get_price_html();
$avg_rating   = $wc_product->get_average_rating();
$review_count = $wc_product->get_review_count();
$koko_info    = function_exists( 'get_field' ) ? get_field( 'koko_payment_info', $product_id ) : '';

$size_attr_key = null;
foreach ( $wc_product->get_attributes() as $key => $attr ) {
	if ( $attr->get_variation() ) {
		$size_attr_key = $key;
		break;
	}
}

$variations_data = [];
$any_variation   = null;
if ( $wc_product->is_type( 'variable' ) && $size_attr_key ) {
	foreach ( $wc_product->get_available_variations() as $v ) {
		$slug = $v['attributes'][ 'attribute_' . $size_attr_key ] ?? '';
		if ( $slug === '' ) {
			if ( ! $any_variation ) {
				$any_variation = [
					'id'         => $v['variation_id'],
					'price'      => (float) $v['display_price'],
					'price_html' => $v['price_html'],
				];
			}
			continue;
		}
		$variations_data[ $slug ] = [
			'id'         => $v['variation_id'],
			'price'      => (float) $v['display_price'],
			'price_html' => $v['price_html'],
		];
	}
}

$size_options = [];
if ( $size_attr_key ) {
	$is_variable = $wc_product->is_type( 'variable' );
	$attr_obj    = $wc_product->get_attributes()[ $size_attr_key ];
	if ( $attr_obj->is_taxonomy() ) {
		$terms = wc_get_product_terms( $product_id, $size_attr_key, [ 'fields' => 'all' ] );
		foreach ( $terms as $term ) {
			if ( ! isset( $variations_data[ $term->slug ] ) && $any_variation ) {
				$variations_data[ $term->slug ] = $any_variation;
			}
			$size_options[] = [
				'label'    => $term->name,
				'slug'     => $term->slug,
				'disabled' => $is_variable && ! isset( $variations_data[ $term->slug ] ),
			];
		}
	} else {
		foreach ( $attr_obj->get_options() as $option ) {
			$slug = sanitize_title( $option );
			if ( ! isset( $variations_data[ $slug ] ) && $any_variation ) {
				$variations_data[ $slug ] = $any_variation;
			}
			$size_options[] = [
				'label'    => $option,
				'slug'     => $slug,
				'disabled' => $is_variable && ! isset( $variations_data[ $slug ] ),
			];
		}
	}
}
$first_active_slug = null;
foreach ( $size_options as $opt ) {
	if ( ! $opt['disabled'] ) {
		$first_active_slug = $opt['slug'];
		break;
	}
}

if ( ! empty( $variations_data ) ) {
	$first_v            = reset( $variations_data );
	$initial_unit_price = $first_v['price'];
	$initial_price_html = $first_v['price_html'];
	if ( $first_active_slug && isset( $variations_data[ $first_active_slug ] ) ) {
		$initial_unit_price = $variations_data[ $first_active_slug ]['price'];
		$initial_price_html = $variations_data[ $first_active_slug ]['price_html'];
	}
} else {
	$initial_unit_price = $wc_product->get_price();
	$initial_price_html = $price_html;
}

$first_variation_id = $first_active_slug ? ( $variations_data[ $first_active_slug ]['id'] ?? null ) : null;
$cart_target        = $first_variation_id ?: $product_id;
$add_to_cart_url    = add_query_arg( 'add-to-cart', $cart_target, home_url( '/' ) );
$buy_now_url        = add_query_arg( [ 'add-to-cart' => $cart_target, 'buy_now' => 1 ], home_url( '/' ) );

$full_stars  = $avg_rating ? (int) floor( floatval( $avg_rating ) ) : 0;
$empty_stars = 5 - $full_stars;
?>

<!-- single-product-section-section -->
<div class="<?php echo $has_bg ? 'bg-offwhite' : 'bg-white'; ?>">
	<div class="single-product-section section-container full-padding">
	
		<div class="single-product-section__image">
			<?php if ( $image_url ) : ?>
				<img src="<?php echo esc_url( $image_url ); ?>"
					 alt="<?php echo esc_attr( wp_strip_all_tags( $title ) ); ?>">
			<?php endif; ?>
		</div>
	
		<div class="single-product-section__info">
	
			<h2 class="single-product-section__title text-title-x-large">
				<?php echo wp_kses_post( $title ); ?>
			</h2>
	
			<?php if ( $avg_rating ) : ?>
			<div class="single-product-section__rating">
				<span class="single-product-section__rating-score text-body-small medium"><?php echo esc_html( $avg_rating ); ?></span>
				<span class="single-product-section__stars" aria-label="<?php echo esc_attr( $avg_rating ); ?> out of 5 stars">
					<?php for ( $i = 0; $i < $full_stars; $i++ ) : ?>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="#E5A716" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
					<?php endfor; ?>
					<?php for ( $i = 0; $i < $empty_stars; $i++ ) : ?>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E5A716" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
					<?php endfor; ?>
				</span>
				<?php if ( $review_count ) : ?>
					<span class="single-product-section__rating-count text-body-small">
						<?php echo esc_html( number_format( $review_count ) ); ?> <?php esc_html_e( 'ratings', 'storefront-child' ); ?>
					</span>
				<?php endif; ?>
			</div>
			<?php endif; ?>
	
			<?php if ( $short_desc ) : ?>
				<div class="single-product-section__description text-body-medium text-base">
					<?php echo wp_kses_post( $short_desc ); ?>
				</div>
			<?php endif; ?>
	
			<hr class="single-product-section__divider">
	
			<?php if ( ! empty( $size_options ) ) : ?>
			<div class="single-product-section__variants">
				<span class="single-product-section__variants-label text-body-small medium">
					<?php esc_html_e( 'Size', 'storefront-child' ); ?>
				</span>
				<div class="single-product-section__variant-pills">
					<?php
					$first_active_done = false;
					foreach ( $size_options as $opt ) :
						if ( $opt['disabled'] ) {
							$pill_class = ' is-disabled';
						} elseif ( ! $first_active_done ) {
							$pill_class        = ' is-active';
							$first_active_done = true;
						} else {
							$pill_class = '';
						}
					?>
						<button class="single-product-section__variant-pill<?php echo $pill_class; ?>"
								data-variant="<?php echo esc_attr( $opt['slug'] ); ?>"
								<?php echo $opt['disabled'] ? 'disabled' : ''; ?>>
							<?php echo esc_html( $opt['label'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
	
			<?php if ( $koko_info ) : ?>
				<p class="single-product-section__koko text-body-small">
					<?php echo wp_kses_post( $koko_info ); ?>
				</p>
			<?php endif; ?>
	
			<div class="single-product-section__purchase">
				<div class="single-product-section__qty">
					<button class="single-product-section__qty-btn" id="qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'storefront-child' ); ?>">&#8722;</button>
					<span class="single-product-section__qty-value text-body-base medium" id="qty-value">1</span>
					<button class="single-product-section__qty-btn" id="qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'storefront-child' ); ?>">+</button>
				</div>
				<div class="single-product-section__price text-title-large" data-unit-price="<?php echo esc_attr( $initial_unit_price ); ?>">
					<?php echo $initial_price_html; ?>
				</div>
			</div>
	
			<div class="single-product-section__actions"
				 data-product-id="<?php echo esc_attr( $product_id ); ?>"
				 data-base-buy-now="<?php echo esc_url( $buy_now_url ); ?>"
				 data-base-add-to-cart="<?php echo esc_url( $add_to_cart_url ); ?>"
				 data-variations="<?php echo esc_attr( wp_json_encode( $variations_data ) ); ?>">
				<?php
					$label           = __( 'Buy Now', 'storefront-child' );
					$link            = $buy_now_url;
					$variant         = 'primary';
					$open_in_new_tab = false;
					include( get_stylesheet_directory() . '/template-parts/template-common/button/index.php' );
				?>
				<?php
					$label           = __( 'Add to Cart', 'storefront-child' );
					$link            = $add_to_cart_url;
					$variant         = 'secondary';
					$open_in_new_tab = false;
					include( get_stylesheet_directory() . '/template-parts/template-common/button/index.php' );
				?>
			</div>
	
		</div>
	
	</div>
</div>
<!-- end-of-single-product-section-section -->
