<?php
if ( empty( $community ) ) return;
?>

<!-- community-section -->
<div class="<?php echo $has_bg ? 'bg-offwhite' : 'bg-white'; ?>">
	<div class="community section-container full-padding">
		<?php include( get_stylesheet_directory() . '/template-parts/template-common/title-section/index.php' ); ?>
		<div class="community__slider-wrapper">
			<div class="community__slider hide-scrollbar" id="communitySlider">
				<?php $reveal_index = 0; foreach ( $community as $com ) :
					$card_title = $com['text'] ?? '';
					$card_file  = $com['file'] ?? null;
					include( get_stylesheet_directory() . '/template-parts/template-common/community/single-card.php' );
					$reveal_index++;
				endforeach; ?>
			</div>
		</div>

		<div class="community__controls">
			<div class="community__progress-track">
				<div class="community__progress-bar" id="communityProgressBar"></div>
			</div>
			<div class="community__nav">
				<button class="community__nav-btn" id="communityPrev" aria-label="<?php esc_attr_e( 'Previous', 'storefront-child' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
				</button>
				<button class="community__nav-btn is-next" id="communityNext" aria-label="<?php esc_attr_e( 'Next', 'storefront-child' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- end-of-community-section -->

<div class="community-modal" id="communityModal" aria-hidden="true">
	<div class="community-modal__overlay" id="communityModalOverlay"></div>
	<div class="community-modal__content">
		<button class="community-modal__close" id="communityModalClose" aria-label="<?php esc_attr_e( 'Close', 'storefront-child' ); ?>">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
		</button>
		<video id="communityModalVideo" controls playsinline></video>
	</div>
</div>
