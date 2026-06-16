<?php $label; $link; $variant; $open_in_new_tab; ?>
<a href="<?php echo esc_url($link); ?>"
   class="btn btn-<?php echo esc_attr(strtolower($variant)); ?>"
   <?php echo !empty($open_in_new_tab) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
  <?php echo esc_html($label); ?>
</a>
