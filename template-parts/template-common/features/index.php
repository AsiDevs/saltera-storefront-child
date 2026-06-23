<?php $title; $description; $features; $has_bg; ?>

<!-- features-section -->
<div class="<?php echo $has_bg ? 'bg-offwhite' : 'bg-white'; ?>">
  <div class="features">
    <div class="section-container full-padding">
      <?php include(get_stylesheet_directory() . "/template-parts/template-common/title-section/index.php"); ?>
      <div class="features-list">
        <?php $reveal_index = 0; foreach ($features as $feature) :
          $icon        = $feature['icon'];
          $title       = $feature['title'];
          $description = $feature['description'];
          include(get_stylesheet_directory() . "/template-parts/template-common/features/single-feature.php");
          $reveal_index++;
        endforeach; ?>
      </div>
    </div>
  </div>
</div>
<!-- end-of-features-section -->
