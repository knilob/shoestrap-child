<?php
if ( !function_exists( 'shoestrap_banner' ) ) :
/*
 * The Banner template
 */
function shoestrap_banner() {
  global $ss_settings;
  if ( $ss_settings['banner_toggle'] == 1 ) :
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

add_action( 'shoestrap_pre_top_bar', 'shoestrap_banner', 5 );

if ( !function_exists( 'shoestrap_banner_css' ) ) :
/*
 * The Banner template
 */
function shoestrap_banner_css() {
  global $ss_settings;
  $banner_bg = $ss_settings['banner_bg'];
  $style = '';
  $style .= '.vubanner h1 {background: ' . $banner_bg . '}';
  wp_add_inline_style( 'shoestrap_css', $style );
}
endif;
add_action( 'wp_enqueue_scripts', 'shoestrap_banner_css', 101 );

if ( !function_exists( 'shoestrap_banner_display' ) ) :
/*
 * The site banner.
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

