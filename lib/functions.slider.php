<?php
if ( !function_exists( 'shoestrap_slider' ) ) :
/*
 * The Banner template
 */
function shoestrap_banner() {
  global $ss_settings;
  if ( $ss_settings['slider_toggle'] == 1 ) :
  ?>
    <header>
      <a class="vubanner" href="<?php echo home_url(); ?>/">
        <h1>
          <?php if ( function_exists( 'shoestrap_banner_display' ) ) : ?>
            <?php shoestrap_banner_display(); ?>
          <?php endif; ?>
        </h1>
      </a>
    </header>
  <?php endif;
}
endif;

add_action( 'shoestrap_pre_main', 'shoestrap_slider', 5 );

if ( !function_exists( 'shoestrap_slider_display' ) ) :
/*
 * The site slider.
 * If no custom banner is uploaded, use the sitename
 */
function shoestrap_banner_display() {
  global $ss_settings;
  $banner  = $ss_settings['banner'];

  if ( !empty( $banner['url'] ) )
    echo '<img id="site-banner" src="' . $banner['url'] . '" alt="' . get_bloginfo( 'name' ) . '">';
  else
    echo '<span class="sitename">' . bloginfo( 'name' ) . '</span>';
}
endif;

