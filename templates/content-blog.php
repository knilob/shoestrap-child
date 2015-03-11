<?php

global $ss_framework;

while ( have_posts() ) : the_post();
  $show_category = get_post_meta($post->ID, 'show_category', $single = true);
  do_action( 'shoestrap_entry_meta' );
  do_action( 'shoestrap_page_pre_content' );
   shoestrap_title_section();
endwhile;

if($show_category!='') {
  $args = array(
    'showposts' => 15,
    'category_name' => $show_category,
    'paged' => $paged,
    'post_type' => array( 'post',  'journalarticles' )
  );
} else {
  $args = array(
    'showposts' => 15,
    'paged' => $paged
  );
}
$posts_query = new WP_Query( $args );
while ($posts_query->have_posts()) : $posts_query->the_post();
  echo '<article class="category-post">';
  echo "<a href=\"" . get_the_permalink() . "\">";
  if (has_post_thumbnail()) {
    the_post_thumbnail(array(150,150), array("class" => "blogthumb left"));
  } else {
    echo '<img src="' . get_stylesheet_directory_uri() . '/assets/i/defaultpost.jpg" height="150" width="150" class="category-post__thumb left">';
  }
  echo '</a>';
  echo '<h3 id="post-' . get_the_ID() . '"><a href="' . get_the_permalink() . '" rel="bookmark" title="Permanent Link to ' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '</a></h3>';
  echo '<p>' . get_the_excerpt() . '...</p>';
  echo '<p class="category-post__credits"><small>Posted by <a href="' . get_author_posts_url( get_the_author_meta( 'ID' )) . '">' . get_the_author_meta( 'display_name' ) . '</a> on ' . get_the_time('l, F jS, Y') . ' in ' . get_the_category_list(', ') . get_the_tag_list(', ', ', ', '') . ' | ';
  edit_post_link('Edit', '', ' | ');
  echo ' ';
  comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;');
  echo '</small></p>';
  echo '</article>';
endwhile;
wp_reset_postdata();

  echo $ss_framework->clearfix();
  // shoestrap_meta( 'cats' );
  // shoestrap_meta( 'tags' );
  do_action( 'shoestrap_page_after_content' );

  wp_link_pages( array( 'before' => '<nav class="pagination">', 'after' => '</nav>' ) );