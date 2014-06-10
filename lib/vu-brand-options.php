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
	  'title'     => __( 'Vanderbilt Brandbar', 'shoestrap_child' ),
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

	$sidebarSection = array(
		'title'   => __( 'Right Sidebar', 'shoestrap-child' ),
		'icon'    => 'el-icon-chevron-right',
		'subsection' => true,
	);

	$sidebarFields[] = array(
		'title'		=> __( 'Enable VU News Feed', 'shoestrap_child' ),
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
		'title'		=> __( 'Enable VU Calendar Feed', 'shoestrap_child' ),
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

	$section['fields'] = $fields;

	$sidebarSection['fields'] = $sidebarFields;

	$section = apply_filters( 'shoestrap_vu_brand_options_modifier', $section );
	$sidebarSection = apply_filters( 'shoestrap_vu_brand_options_modifier', $sidebarSection );

	$sections[] = $section;
	$sections[] = $sidebarSection;
	return $sections;
}
endif;
