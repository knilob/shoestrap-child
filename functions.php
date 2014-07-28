<?php
if ( !defined( 'SHOESTRAP_OPT_NAME' ) )
  define( 'SHOESTRAP_OPT_NAME', 'shoestrap' );

// Include some admin options.
#require_once locate_template( 'lib/admin-options.php' );
#require_once locate_template( 'lib/vu-banner-options.php' );
require_once locate_template( 'lib/vu-brand-options.php' );
//load overrides
require_once locate_template( 'lib/overrides/sidebar.php' );
require_once locate_template( 'lib/overrides/footer.php' );

/*
 * Add a less file from our child theme to the parent theme's compiler.
 * This uses the 'shoestrap_compiler' filter that exists in the shoestrap compiler
 */
// add_filter( 'shoestrap_compiler', 'shoestrap_child_styles' );
// function shoestrap_child_styles( $bootstrap ) {
//   return $bootstrap . '
//   @import "' . get_stylesheet_directory() . '/assets/less/style.less";';
// }

/*
 * Changes the output of the compiled CSS.
 */
add_filter( 'shoestrap_compiler_output', 'shoestrap_child_hijack_compiler' );
function shoestrap_child_hijack_compiler( $css ) {
  // $css = str_replace( '', '', $css );
  return $css;
}

/*
 * Enqueue the style.css file.
 *
 * It is recommended to use a less file as per the shoestrap_child_styles() function above.
 *
 * To have styles compiled and added in the main stylesheet,
 * try using the shoestrap_child_styles() function instead,
 */
// Uncomment the line below to enqueue the stylesheet
// Use a priority greater than 100 to enqueue it after the main stylesheet
add_action('wp_enqueue_scripts', 'shoestrap_child_load_stylesheet', 101);
function shoestrap_child_load_stylesheet() {
  wp_enqueue_style( 'shoestrap_child_css', get_stylesheet_uri(), false, null );
}

/*
 * Enqueue the generated LESS styles locally for testing
 */
// if ( strpos( $_SERVER['DOCUMENT_ROOT'], 'linkja' ) )  {
//   add_action('wp_enqueue_scripts', 'shoestrap_child_load_local_less', 104);
//   function shoestrap_child_load_local_less() {
//     wp_enqueue_style( 'shoestrap_local_less', get_stylesheet_directory_uri() . '/assets/css/style.css', false, null );
//   }
// }

/* Override templates/top-bar */
function vu_override_top_bar_template() {
    return 'templates/vu-top-bar';
}
add_filter( 'shoestrap_top_bar_template', 'vu_override_top_bar_template' );

function shoestrap_load_slider() {
  global $ss_settings;
  if ( $ss_settings['slider-toggle'] == 1 ) {
    /**
     * Enqueue Slick Carousel Javascript
     */
    function shoestrap_slider_script() {
      wp_register_script( 'shoestrap_slider_js', get_stylesheet_directory_uri() . '/assets/bower_components/slick-carousel/slick/slick.min.js', false, null, true );
      wp_enqueue_script( 'shoestrap_slider_js' );
    }
    add_action( 'wp_enqueue_scripts', 'shoestrap_slider_script', 101 );
    /**
     * Enqueue Slick Carousel Styles
     */
    function shoestrap_slider_styles() {
      wp_enqueue_style( 'shoestrap_slider_css', get_stylesheet_directory_uri() . '/assets/bower_components/slick-carousel/slick/slick.css', false, null );
    }
    add_action( 'wp_enqueue_scripts', 'shoestrap_slider_styles', 100 ) ;

    /**
     * Our Slick Carousel script
     */
    function shoestrap_slider_trigger_script() { ?>
      <script>
      var $j = jQuery.noConflict();
      $j('.slider').slick({
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
        fade: true,
      });
      </script>
      <?php
    }
    add_action( 'wp_footer', 'shoestrap_slider_trigger_script', 200 );

  }
}
add_action( 'init', 'shoestrap_load_slider' );
