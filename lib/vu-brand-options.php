<?php

/*
 * Child Theme Options
 *
 * Uncomment the line below (the one with the add_filter function)
 * to add the new section to the theme options panel.
 * You can learn more about fields here: https://github.com/ReduxFramework/ReduxFramework/wiki/Fields
 */

add_filter( 'redux/options/' . SHOESTRAP_OPT_NAME . '/sections', 'shoestrap_brandbar_options', 17 );

if ( !function_exists( 'shoestrap_brandbar_options' ) ) :
function shoestrap_brandbar_options( $sections ) {

	$section = array(
		'title' => __( 'VU Brand Options', 'shoestrap_child' ),
		'icon'  => 'el-icon-adjust-alt'
	);

	$fields[] = array(
	  'title'     => __( 'Choose Your Vanderbilt Brandbar', 'shoestrap_child' ),
	  'desc'      => 'Select the brand bar to use at the top of your website. Default: Vanderbilt',
	  'id'        => 'brandbar',
	  'type'      => 'select',
	  'options'		=> array (
	  	'vu' => 'Vanderbilt',
	  	'blair' => 'Blair',
			'cas' => 'CAS',
			'div' => 'Divinity',
			'eng' => 'Engineering',
			'grad' => 'Graduate',
			'law' => 'Law',
			'som' => 'Medicine',
			'son' => 'Nursing',
			'owen' => 'Owen',
			'peabody' => 'Peabody'
		),
		'default'   => 'vu'
	);
	$fields[] = array(
		'title'		=> __( 'Home Page Slider', 'shoestrap_child' ),
		'desc'		=> 'Enable this option to display an image slider on your homepage.',
		'id'			=> 'slider-toggle',
		'type'		=> 'switch',
		'default'	=> 'false'
	);
	$fields[] = array(
    'id'          => 'slide-images',
    'type'        => 'slides',
    'title'       => __('Home Page Slider Options', 'shoestrap_child'),
    'subtitle'    => __('You can add unlimited slides with drag and drop sorting.', 'shoestrap_child'),
    'placeholder' => array(
        'title'           => __('Add your slide title.', 'shoestrap_child'),
        'description'     => __('Add your description here.', 'shoestrap_child'),
        'url'             => __('Add a link for the slide.', 'shoestrap_child'),
	   )
	 );

	 // Branding Options
  $bannerSection = array(
    'title' => __( 'Graphic Header', 'shoestrap_child' ),
    'icon'    => 'el-icon-chevron-right',
		'subsection' => true,
  );

  $url = admin_url( 'widgets.php' );


  $bannerFields[] = array(
    'title'       => __( 'Graphical Banner', 'shoestrap_child' ),
    'desc'        => 'Turn this ON to display the banner. Default: OFF',
    'id'          => 'banner_toggle',
    'default'     => 0,
    'type'        => 'switch',
    // 'required'    => array('advanced_toggle','=',array('1'))
  );


  $bannerFields[] = array(
    'title'       => __( 'Banner Background Color', 'shoestrap_child' ),
    'desc'        => __( 'Select the background color for your banner. Default: #EEEEEE.', 'shoestrap_child'),
    'id'          => 'banner_bg',
    'default'     => '#EEEEEE',
    'validate'  	=> 'color',
    'transparent' => false,
    'type'        => 'color'
    //'required'    => array('header_toggle','=',array('1')),
  );

   $bannerFields[] = array(
    'title'       => __( 'Banner Image', 'shoestrap_child' ),
    'desc'        => 'Upload a banner image using the media uploader, or define the URL directly.',
    'id'          => 'banner',
    'default'     => '',
    'type'        => 'media',
  );

	$sidebarSection = array(
		'title'   => __( 'Right Sidebar', 'shoestrap-child' ),
		'icon'    => 'el-icon-chevron-right',
		'subsection' => true,
	);

	$sidebarFields[] = array(
		'title'		=> __( 'VU News Feed', 'shoestrap_child' ),
		'desc'		=> 'Select this option to display a news feed from RSS feed of your choosing in the sidebar on your site.',
		'id'			=> 'vunewsfeed',
		'type'		=> 'switch',
		'default'	=> '0'
	);

	$sidebarFields[] = array(
		'title'		=> __( 'News Feed Title', 'shoestrap_child' ),
		'desc'		=> 'Enter what will appear as the title of the news section in your sidebar (defaults to "Recent News")',
		'id'			=> 'vunewsfeedtitle',
		'type'		=> 'text',
		'default' => 'Recent News'
	);

	$sidebarFields[] = array(
		'title'		=> __( 'News Feed URL', 'shoestrap_child' ),
		'desc'		=> 'Enter the URL of the RSS feed in order to pull that information into the sidebar on your site.',
		'id'			=> 'vunewsfeedurl',
		'type'		=> 'text',
		'default'	=> ''
	);

	$sidebarFields[] = array(
		'title'		=> __( 'News Feed Items', 'shoestrap_child' ),
		'desc'		=> 'Enter the number of items from this RSS feed that you would like to display in the sidebar.',
		'id'			=> 'vunewsfeeditems',
		'type'		=> 'text',
		'default'	=> '5'
	);

	$sidebarFields[] = array(
		'title'		=> __( 'VU Calendar Feed', 'shoestrap_child' ),
		'desc'		=> 'Select this option to display a calendar feed from <a href="http://events.vanderbilt.edu">http://events.vanderbilt.edu</a> in the sidebar on your site.',
		'id'			=> 'vucalfeed',
		'type'		=> 'switch',
		'default'	=> '0'
	);

	$sidebarFields[] = array(
		'title'		=> __( 'Calendar Feed Title', 'shoestrap_child' ),
		'desc'		=> 'Enter what will appear as the title of the event section (defaults to "Upcoming Events")',
		'id'			=> 'vucaltitle',
		'type'		=> 'text',
		'default' => 'Upcoming Events'
	);

	$sidebarFields[] = array(
		'title'		=> __( 'VU Calendar Tag', 'shoestrap_child' ),
		'desc'		=> 'Enter the calendar feed tag in order to pull that information into the sidebar on your site. For example, entering "myvu" will pull in all events from <a href="http://events.vanderbilt.edu">http://events.vanderbilt.edu</a> tagged with "myvu".',
		'id'			=> 'vucaltag',
		'type'		=> 'text',
		'default'	=> 'myvu'
	);

	$footerSection = array(
		'title'   => __( 'Footer', 'shoestrap-child' ),
		'icon'    => 'el-icon-chevron-right',
		'subsection' => true,
	);

	$footerFields[] = array(
		'title' 	=> __( 'Display Social Media Icons in the Footer' ),
		'id' 			=> 'vufootericons',
		'type'		=> 'switch',
		'default'	=> '0'
	);

	$footerFields[] = array(
		'title' 	=> __( 'VU AnchorLink URL' ),
		'desc'		=> 'Enter your AnchorLink URL to display an AnchorLink icon in the footer beside the other social media links.',
		'id'			=> 'vuanchorlink',
		'type'		=> 'text',
		'default'	=> ''
	);

	$section['fields'] = $fields;
	$bannerSection['fields'] = $bannerFields;
	$sidebarSection['fields'] = $sidebarFields;
	$footerSection['fields'] = $footerFields;

	$section = apply_filters( 'shoestrap_vu_brand_options_modifier', $section );
	$bannerSection = apply_filters( 'shoestrap_vu_brand_options_modifier', $bannerSection );
	$sidebarSection = apply_filters( 'shoestrap_vu_brand_options_modifier', $sidebarSection );
	$footerSection = apply_filters( 'shoestrap_vu_brand_options_modifier', $footerSection );

	$sections[] = $section;
	$sections[] = $bannerSection;
	$sections[] = $sidebarSection;
	$sections[] = $footerSection;
	return $sections;
}
endif;

include_once( dirname( __FILE__ ) . '/functions.slider.php' );
include_once( dirname( __FILE__ ) . '/functions.banner.php' );