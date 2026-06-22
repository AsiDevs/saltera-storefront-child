<div class="vision-statement section-container full-padding">
  <div class="vision-statement__grid">
    <?php $reveal_index = 0; if ( is_array( $info ) && ! empty( $info ) ) : foreach ( $info as $item ) :
      $title       = $item['title']       ?? '';
      $description = $item['description'] ?? '';
      $icon        = $item['icon']        ?? null;
      include( get_stylesheet_directory() . '/template-parts/template-common/vision-statement/single-item.php' );
      $reveal_index++;
    endforeach; endif; ?>
  </div>
</div>
