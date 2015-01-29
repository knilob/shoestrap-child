<?php

if ( ! has_action( 'shoestrap_content_page_override' ) ) {
	ss_get_template_part( 'templates/content', 'blog' );
} else {
	do_action( 'shoestrap_content_page_override' );
}
