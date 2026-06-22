<?php
if ( empty( $card_file ) ) return;

if ( is_numeric( $card_file ) ) {
	$attachment_id = (int) $card_file;
	$card_file = [
		'url'  => wp_get_attachment_url( $attachment_id ),
		'type' => strpos( get_post_mime_type( $attachment_id ), 'video/' ) === 0 ? 'video' : 'image',
	];
} elseif ( is_string( $card_file ) ) {
	$card_file = [
		'url'  => $card_file,
		'type' => preg_match( '/\.(mp4|mov|webm|ogv|avi)(\?.*)?$/i', $card_file ) ? 'video' : 'image',
	];
}

$is_video = isset( $card_file['type'] ) && $card_file['type'] === 'video';
$file_url = $card_file['url'] ?? '';
?>

<div class="community__slide">
	<div class="community__card<?php echo $is_video ? ' is-video' : ''; ?>"
	     <?php if ( $is_video ) : ?>data-video-url="<?php echo esc_url( $file_url ); ?>"<?php endif; ?>>

		<?php if ( $is_video ) : ?>
			<video class="community__card-media" src="<?php echo esc_url( $file_url ); ?>" muted preload="metadata" playsinline></video>
		<?php else : ?>
			<img class="community__card-media"
			     src="<?php echo esc_url( $file_url ); ?>"
			     alt="<?php echo esc_attr( $card_title ); ?>"
			     loading="lazy">
		<?php endif; ?>

		<div class="community__card-overlay">

			<?php if ( $is_video ) : ?>
				<div class="community__play-btn" aria-hidden="true">
					<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="26" cy="26" r="26" fill="rgba(255,255,255,0.88)"/>
						<path d="M21 17.5l15 8.5-15 8.5V17.5z" fill="#0d0d0d"/>
					</svg>
				</div>
			<?php endif; ?>

			<div class="community__card-footer">
				<svg class="community__ig-icon" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
					<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
					<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
				</svg>
				<?php if ( $card_title ) : ?>
					<p class="community__caption text-body-small"><?php echo esc_html( $card_title ); ?></p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>
