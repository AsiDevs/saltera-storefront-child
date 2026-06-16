<?php $image; $title; $description; $buttons; ?>

<!-- hero-section -->
<div class="hero-section">
  <div class="hero-info section-container">
    <div class="hero-main">
      <div class="text-title-x-large"><?php echo $title; ?></div>
      <p class="text-body-medium"><?php echo $description; ?></p>
      <?php if (!empty($buttons)) : ?>
        <div class="hero-buttons">
          <?php foreach ($buttons as $btn) :
            $label           = $btn['label'];
            $link            = $btn['link'];
            $variant         = $btn['variant'];
            $open_in_new_tab = $btn['open_in_new_tab'];
            include(get_stylesheet_directory() . "/template-parts/template-common/button/index.php");
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
