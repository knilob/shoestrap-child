<?php
function my_custom_single_override() {
  if (has_action('shoestrap_content_single_plugin_override')) {
    do_action('shoestrap_content_single_plugin_override');
  }
}

add_action( 'shoestrap_content_single_override', 'my_custom_single_override' );
?>