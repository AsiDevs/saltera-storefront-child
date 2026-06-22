<div class="vision-card reveal" style="--reveal-delay: <?php echo esc_attr( min( $reveal_index * 0.12, 0.4 ) ); ?>s">
  <?php if ( ! empty( $icon['url'] ) ) : ?>
  <div class="vision-card__watermark" aria-hidden="true">
    <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="">
  </div>
  <?php endif; ?>
  <h2 class="vision-card__title">Our <em><?php echo esc_html( $title ); ?></em></h2>
  <p class="vision-card__desc"><?php echo wp_kses_post( $description ); ?></p>
</div>
