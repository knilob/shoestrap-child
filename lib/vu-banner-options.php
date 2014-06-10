<?php

/*
 * The banner core options for the Shoestrap theme
 */

add_filter( 'redux/options/' . SHOESTRAP_OPT_NAME . '/sections', 'shoestrap_banner_options', 16 );


if ( !function_exists( 'shoestrap_banner_options' ) ) :
function shoestrap_banner_options( $sections ) {

  // Branding Options
  $section = array(
    'title' => __( 'VU Banner', 'shoestrap_child' ),
    'icon'  => 'el-icon-website'
  );

  $url = admin_url( 'widgets.php' );


  $fields[] = array(
    'title'       => __( 'Display the Banner.', 'shoestrap_child' ),
    'desc'        => 'Turn this ON to display the banner. Default: OFF',
    'id'          => 'banner_toggle',
    'customizer'  => array(),
    'default'     => 0,
    'type'        => 'switch',
    // 'required'    => array('advanced_toggle','=',array('1'))
  );


  $fields[] = array(
    'title'       => __( 'Banner Background Color', 'shoestrap_child' ),
    'desc'        => 'Select the background color for your banner. Default: #EEEEEE.',
    'id'          => 'banner_bg',
    'default'     => '#EEEEEE',
    'customizer'  => array(),
    'transparent' => false,
    'type'        => 'color'
    //'required'    => array('header_toggle','=',array('1')),
  );

   $fields[] = array(
    'title'       => __( 'Banner', 'shoestrap_child' ),
    'desc'        => 'Upload a banner image using the media uploader, or define the URL directly.',
    'id'          => 'banner',
    'default'     => '',
    'type'        => 'media',
    'customizer'  => array(),
  );



  $section['fields'] = $fields;

  $section = apply_filters( 'shoestrap_banner_options_modifier', $section );

  $sections[] = $section;
  return $sections;

}
endif;


include_once( dirname( __FILE__ ) . '/functions.banner.php' );