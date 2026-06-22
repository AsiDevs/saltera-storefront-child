<?php ?>
<div class="faq reveal" style="--reveal-delay: <?php echo esc_attr( min( $reveal_index * 0.08, 0.32 ) ); ?>s">
  <button class="faq-header" aria-expanded="false">
    <span class="faq-question"><?php echo $question; ?></span>
    <span class="faq-icon" aria-hidden="true"></span>
  </button>
  <div class="faq-body-outer">
    <div class="faq-body">
      <p class="faq-answer"><?php echo $answer; ?></p>
    </div>
  </div>
</div>
