<?php
function my_custom_sidebar_override() {
  global $ss_framework;
  global $ss_settings;
  $caltitle = $ss_settings['vucaltitle'];
  $caltag = $ss_settings['vucaltag'];
  $xslpath = get_bloginfo('stylesheet_directory')."/parse-vu-calendar.xsl";
  // Load the primary sidebar
  echo '<div class="sidebar secnav">';
  dynamic_sidebar( 'sidebar-primary' );
  if (has_action( 'shoestrap_sidebar_plugin_override')) {
    do_action( 'shoestrap_sidebar_plugin_override' );
  }
  if ( $ss_settings['vucalfeed'] == 1 ) :
?>
    <section class="vu-calendar well" role="contentinfo">
      <h3 class="widget-title"><?php echo $caltitle ?></h3>
      <ul>
      <?php
        $xp = new XsltProcessor();
        $xsl = new DomDocument;
        // XSL displays date, time and event title
        $xsl->load($xslpath);
        $xp->importStylesheet($xsl);
        $xml_doc = new DomDocument;
        // XML for group of events you want to display -
        $xml_doc->load('https://events.vanderbilt.edu/calendar/rss/set/3?xtags='.$caltag);
        if ($html = $xp->transformToXML($xml_doc)) {
          echo $html;
        }
        // else  { trigger_error('XSL transformation failed.', E_USER_ERROR); }
      ?>
      <li class="more"><a href="https://events.vanderbilt.edu/calendar/list?xtags=<?php echo $caltag;?>&tagname=<?php bloginfo('name'); ?> Events">View More Events &raquo;</a></li>
      </ul>
    </section>
<?php
  endif;
  if ($ss_settings['vuchildpages'] == 1) {
    $post = get_post();
    $hidethese = $ss_settings['vuhidepages'];
    if ($post->post_parent) {
      $children = wp_list_pages("title_li=&depth=1&sort_column=menu_order&child_of=".$post->post_parent."&echo=0&exclude=".$hidethese);
      $titlenamer = get_the_title($post->post_parent);
    } else {
      $children = wp_list_pages("title_li=&depth=1&sort_column=menu_order&child_of=".$post->ID."&echo=0&exclude=".$hidethese);
      $titlenamer = get_the_title($post->ID);
    }
    if ($children) :
?>
    <section class="vu-childpages well" role="contentinfo">
      <h3 class="widget-title"><?php echo $titlenamer ?></h3>
      <ul>
        <?php echo $children; ?>
      </ul>
    </section>
<?php
    endif;
  }
  if ( $ss_settings['vunewsfeed'] = 1 ) {
    $widget = 'WP_Widget_RSS';
    $instance = array(
      'title' => $ss_settings['vunewsfeedtitle'],
      'url'   => $ss_settings['vunewsfeedurl'],
      'items' => $ss_settings['vunewsfeeditems']
    );
    $args = array(
      'before_widget' => '<section class="well widget widget_vunewsfeed rssnews">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
    );
    the_widget( $widget, $instance, $args );
  }
  echo '</div>';
}

class Shoestrap_Custom_Sidebar {
  private $conditionals;
  private $templates;

  public $display = true;

  function __construct( $conditionals = array(), $templates = array() ) {
    $this->conditionals = $conditionals;
    $this->templates    = $templates;

    $conditionals = array_map( array( $this, 'check_conditional_tag' ), $this->conditionals );
    $templates    = array_map( array( $this, 'check_page_template' ), $this->templates );

    if ( in_array( true, $conditionals ) || in_array( true, $templates ) ) {
      $this->display = false;
    }
  }

  private function check_conditional_tag( $conditional_tag ) {
    if ( is_array( $conditional_tag ) ) {
      return $conditional_tag[0]( $conditional_tag[1] );
    } else {
      return $conditional_tag();
    }
  }

  private function check_page_template( $page_template ) {
    return is_page_template( $page_template );
  }
}

add_action( 'shoestrap_sidebar_override', 'my_custom_sidebar_override' );
?>