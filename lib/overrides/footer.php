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
      <p>
        <span><a href="<?php echo wp_login_url(); ?>">©</a></span>
        <script type="text/javascript">date=new Date(); year=date.getFullYear(); document.write(year);</script>&nbsp;Vanderbilt University · <a href="http://web.vanderbilt.edu/">Site Development: University Web Communications</a>
      </p>
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
      $col_class = 12 / $num_of_sidebars;

    if($i == 1){$col_class = 2;}
    if($i == 2){$col_class = 4;}
    if($i == 3){$col_class = 4;}
    if($i == 4){$col_class = 2;}


      echo '<div class="' . $base_class . $col_class . '">';
      dynamic_sidebar( $sidebar );
      echo '</div>';
    }
  }

  // Showing extra features from /lib/modules/core.footer/functions.footer.php
  do_action( 'shoestrap_pre_footer' );
}
add_action( 'shoestrap_footer_override', 'my_custom_footer_override' );
?>