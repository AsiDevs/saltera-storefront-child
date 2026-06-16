<?php $title; $description; $features; ?>

<!-- features-section -->
<div class="features bg-offwhite">
  <div class="section-container full-padding">
    <?php include(get_stylesheet_directory() . "/template-parts/template-common/title-section/index.php"); ?>
    <div class="features-list">
      <?php foreach ($features as $feature) :
        $icon        = $feature['icon'];
        $title       = $feature['title'];
        $description = $feature['description'];
        include(get_stylesheet_directory() . "/template-parts/template-common/features/single-feature.php");
      endforeach; ?>
    </div>
  </div>
</div>
<!-- end-of-features-section -->
