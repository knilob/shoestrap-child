<?php
function my_custom_footer_override() {
  global $ss_framework;
  global $ss_settings;
 // Finding the number of active widget sidebars
 ?>
<footer class="content-info" role="contentinfo">
  <?php echo $ss_framework->open_container( 'div' ); ?>
    <div class="row">
      <?php shoestrap_footer_content_custom(); ?>
      <div class="col-md-4">
        <div class="social">
          <?php shoestrap_footer_social_links(); ?>
        </div>
        <p>
          <span><a href="http://www.vanderbilt.edu/wp-redirect<?php global $current_blog; $blog_path = $current_blog->path; echo $blog_path; ?>">©</a></span>
          <script type="text/javascript">date=new Date(); year=date.getFullYear(); document.write(year);</script>&nbsp;Vanderbilt University · <br><a href="http://web.vanderbilt.edu/">Site Development: University Web Communications</a>
        </p>
      </div>
    </div>
  <?php echo $ss_framework->close_container( 'div' ); ?>
</footer>
 <?php
}


function shoestrap_footer_content_custom() {
  // Finding the number of active widget sidebars
  $num_of_sidebars = 0;
  $base_class = 'col-md-';

  for ( $i=0; $i<5 ; $i++ ) {
    $sidebar = 'sidebar-footer-'.$i.'';
    if ( is_active_sidebar( $sidebar ) )
      $num_of_sidebars++;
  }

  // Showing the active sidebars
  for ( $i=0; $i<5 ; $i++ ) {
    $sidebar = 'sidebar-footer-' . $i;

    if ( is_active_sidebar( $sidebar ) ) {
      // Setting each column width accordingly
      $col_class = 8 / $num_of_sidebars;

    if($i == 1){$col_class = 8;}
    if($i == 2){$col_class = 4;}
    if($i == 3){$col_class = 2;}
    if($i == 4){$col_class = 2;}


      echo '<div class="' . $base_class . $col_class . '">';
      dynamic_sidebar( $sidebar );
      echo '</div>';
    }
  }

  // Showing extra features from /lib/modules/core.footer/functions.footer.php
  do_action( 'shoestrap_pre_footer' );
}
function shoestrap_footer_social_links() {
  global $ss_framework;
  global $ss_settings;
  global $ss_social;
  $networks = $ss_social->get_social_links();
  if ($ss_settings['vufootericons'] != '0') {
    echo "<h3>". $ss_settings['vufootertitle'] ."</h3>\n";
    echo "<ul>\n";
    foreach ( $networks as $network ) {
      // Check if the social network URL has been defined
      if ( isset( $network['url'] ) && ! empty( $network['url'] ) && strlen( $network['url'] ) > 7 ) {
        echo '<li class="' . $network['icon'] .'"><a href="' . $network['url'] . '" target="_blank" title="' . $network['fullname'] . '">'. $network['fullname'] .'</a></li>';
      }
    }
    echo "</ul>";
  }
}
add_action( 'shoestrap_footer_override', 'my_custom_footer_override' );
?>