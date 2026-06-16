<?php
  $title;
  $description;
  $buttons;
?>

<!-- hero-section -->
<div class="hero-section">
  <!-- <img class="hero-image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-section-bg.png" alt="Hero Image"> -->
  <div class="overlay"></div>
  <div class="hero-section-info section-container">
    <div class="hero-section-main">
      <div class="text-title-x-large"><?php echo $title; ?></div>
      <p class="text-body-medium"><?php echo $description; ?></p>
      <a href="/">
        <button class="shop-now-btn">SHOP NOW</button>
      </a>
    </div>
  </div>
</div>
<!-- end of hero-section -->