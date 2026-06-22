<div class="single-feature reveal" style="--reveal-delay: <?php echo esc_attr( min( $reveal_index * 0.1, 0.4 ) ); ?>s">
  <div class="single-feature__icon">
    <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>">
  </div>
  <h3 class="single-feature__title text-title-base"><?php echo $title; ?></h3>
  <p class="single-feature__description text-body-small text-secondary"><?php echo $description; ?></p>
</div>
