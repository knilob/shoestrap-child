<?php
// disable XML-RPC PING
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
  unset( $methods['pingback.ping'] );
  return $methods;
} ;

// disable autocomplete
add_action('login_init', 'autocomplete_login_init');
function autocomplete_login_init()
{
  ob_start();
}

add_action('login_form', 'autocomplete_login_form');
function autocomplete_login_form()
{
  $content = ob_get_contents();
  ob_end_clean();
  $content = str_replace('id="user_pass"', 'id="user_pass" autocomplete="off"', $content);
  echo $content;
}

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
if ( strpos( $_SERVER['DOCUMENT_ROOT'], 'linkja' ) )  {
  add_action('wp_enqueue_scripts', 'shoestrap_child_load_local_less', 104);
  function shoestrap_child_load_local_less() {
    wp_enqueue_style( 'shoestrap_local_less', get_stylesheet_directory_uri() . '/assets/css/style.css', false, null );
  }
}

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

// lets get rid of weird brs and ps inside shortcodes
function parse_shortcode_content( $content ) {
    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );
    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );
    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );
    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    return $content;
}

// class Add_Shortcodes {
//   static $add_script;

//   static function init() {
//     add_shortcode('accordions', array(__CLASS__, 'accordion_open'));
//     add_shortcode('accordion', array(__CLASS__, 'accordion_section'));
//     add_action('init', array(__CLASS__, 'register_script'));
//     add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_style'));
//     add_action('wp_footer', array(__CLASS__, 'print_script'));
//   }

//   static function accordion_open($atts, $content = null) {
//     self::$add_script = true;

//     // actual shortcode handling here
//     $content = parse_shortcode_content( $content );
//     return "<ul class='accordion collapsible'>".do_shortcode($content)."</ul>";
//   }

//   static function accordion_section($atts, $content = null) {
//     extract( shortcode_atts( array(
//       'title' => 'no title entered',
//     ), $atts) );
//     $content = parse_shortcode_content($content);
//     return "<li><a href='#'>".$title."</a><div class='acitem'>".$content."</div></li>";
//   }

//   static function register_script() {
//     wp_register_script('accordion-script', get_stylesheet_directory_uri() . '/assets/js/accordion.js', array('jquery'), '1.0', true);
//     wp_register_style( 'accordion-style', get_stylesheet_directory_uri() . '/assets/css/accordion.css', array(), 1.0, 'all' );
//   }

//   static function enqueue_style() {
//     wp_enqueue_style('accordion-style');
//   }

//   static function print_script() {
//     if ( ! self::$add_script )
//       return;

//     wp_print_scripts('accordion-script');
//   }
// }

// Add_Shortcodes::init();

// accordion
function accordion_open_tag(  $atts, $content = null ) {
  wp_enqueue_script('accordion-script', get_stylesheet_directory_uri() . '/assets/js/accordion.js', array('jquery'), '1.0', true);
  $content = parse_shortcode_content( $content );

  return "<link rel='stylesheet' type='text/css' href='" . get_stylesheet_directory_uri() . "/assets/css/accordion.css' media='screen' /><ul class='accordion collapsible'>".do_shortcode($content)."</ul>";
}

function accordion_section(  $atts, $content = null ) {
  extract( shortcode_atts( array(
    'title' => 'no title entered',
  ), $atts) );
  $content = parse_shortcode_content($content);
  return "<li><a href='#'>".$title."<i class=\"el-icon-caret-down\"></i></a><div class='acitem'>".$content."</div></li>";
}

add_shortcode( 'accordions', 'accordion_open_tag' );
add_shortcode( 'accordion', 'accordion_section' );

// shortcode to add customfield info to post by using [field name=customfieldname] where you want unaltered code to appear
function field_func($atts) {
   global $post;
   $name = $atts['name'];
   if (empty($name)) return;
   return get_post_meta($post->ID, $name, true);
}
add_shortcode('field', 'field_func');

/**
 * Add Post Tags to Page Content Types.
 */
add_action( 'init', 'add_taxonomies_for_objects' );

function add_taxonomies_for_objects() {
  register_taxonomy_for_object_type( 'post_tag', 'page' );
}