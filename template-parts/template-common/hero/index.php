<?php $image; $title; $description; $buttons; ?>

<!-- hero-section -->
<div class="hero-section">
  <div class="hero-info section-container">
    <div class="hero-main">
      <div class="text-title-x-large reveal" style="--reveal-delay: 0.1s"><?php echo $title; ?></div>
      <p class="text-body-medium reveal" style="--reveal-delay: 0.25s"><?php echo $description; ?></p>
      <?php if (!empty($buttons)) : ?>
        <div class="hero-buttons">
          <?php $btn_index = 0; foreach ($buttons as $btn) :
            $label            = $btn['label'];
            $link             = $btn['link'];
            $variant          = $btn['variant'];
            $open_in_new_tab  = $btn['open_in_new_tab'];
            $btn_reveal_delay = round(0.4 + $btn_index * 0.15, 2);
            include(get_stylesheet_directory() . "/template-parts/template-common/button/index.php");
            $btn_index++;
          endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="hero-image">
    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(wp_strip_all_tags($title)); ?>">
  </div>
</div>
<!-- end of hero-section -->
