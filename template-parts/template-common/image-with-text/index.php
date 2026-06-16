<?php $title; $description; $content; ?>

<!-- image-with-text-section -->
<div class="image-with-text section-container full-padding">
  <?php include(get_stylesheet_directory() . "/template-parts/template-common/title-section/index.php"); ?>
  <div class="iwt-list">
    <?php foreach ($content as $item) :
      $image_first_on_desktop = $item['image_first_on_desktop'];
      $title                  = $item['title'];
      $description            = $item['description'];
      $image                  = $item['image'];
      include(get_stylesheet_directory() . "/template-parts/template-common/image-with-text/single-content.php");
    endforeach; ?>
  </div>
</div>
<!-- end-of-image-with-text-section -->
