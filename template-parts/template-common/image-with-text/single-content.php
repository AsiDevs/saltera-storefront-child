<div class="iwt-row<?php echo $image_first_on_desktop ? ' iwt-row--image-first' : ''; ?> reveal" style="--reveal-delay: <?php echo esc_attr( min( $reveal_index * 0.12, 0.4 ) ); ?>s">
  <div class="iwt-row__text">
    <h3 class="iwt-row__title text-title-base"><?php echo $title; ?></h3>
    <div class="iwt-row__description text-body-medium text-base"><?php echo $description; ?></div>
  </div>
  <div class="iwt-row__image">
    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
  </div>
</div>
