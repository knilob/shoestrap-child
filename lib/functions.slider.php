<?php
if ( !function_exists( 'shoestrap_slider' ) ) :
/*
 * The Banner template
 */
function shoestrap_slider() {
  global $ss_settings;
  if ( is_home() && $ss_settings['slider-toggle'] == 1 ) :
  ?>
    <div class="slider">
      <?php if ( function_exists( 'shoestrap_slider_display' ) ) : ?>
        <?php shoestrap_slider_display(); ?>
      <?php endif; ?>
    </div>
  <?php
  endif;
}
endif;

add_action( 'shoestrap_pre_wpcontent', 'shoestrap_slider', 5 );

if ( !function_exists( 'shoestrap_slider_display' ) ) :
/*
 * The site slider.
 * If no custom banner is uploaded, use the sitename
 */
function shoestrap_slider_display() {
  global $ss_settings;
  if ($ss_settings['slide-images'] != "") {
    foreach ($ss_settings['slide-images'] as $slide) {
      echo "<div>";
      if ($slide['url'] != "") {
        echo '<a href="'.$slide['url'].'">';
      }
      echo '<img src="'.$slide['image'].'" title="'.$slide['title'].'" alt="'.$slide['title'].'">';
      if ($slide['url'] != "") {
        echo '</a>';
      }
      echo "</div>";
    }
  }
}
endif;

