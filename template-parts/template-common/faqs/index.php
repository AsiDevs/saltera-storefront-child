<?php
  $title;
  $description;
  $faqs;
?>
<!-- faqs-section -->
<div class="faqs section-container full-padding">
  <?php include(get_stylesheet_directory() . "/template-parts/template-common/title-section/index.php"); ?>
  <div class="faqs-list">
    <?php foreach ($faqs as $faq) :
      $question = $faq['question'];
      $answer   = $faq['answer'];
      include(get_stylesheet_directory() . "/template-parts/template-common/faqs/single-faq.php");
    endforeach; ?>
  </div>
</div>
<!-- end-of-faqs-section -->
