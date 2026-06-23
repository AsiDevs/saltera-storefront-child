<div class="vision-card reveal" style="--reveal-delay: <?php echo esc_attr( min( $reveal_index * 0.12, 0.4 ) ); ?>s">
  <?php if ( ! empty( $icon ) ) : ?>
  <div class="vision-card__watermark" aria-hidden="true">
    <img src="<?php echo esc_url( $icon ); ?>" alt="">
  </div>
  <?php endif; ?>
  <div class="text-title-x-large"><?php echo $title; ?></div>
  <p class="text-body-medium text-secondary"><?php echo $description; ?></p>
</div>
