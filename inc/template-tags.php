<?php

function df_post_meta() {
	$date = get_the_date('j M Y');
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'domenicafiore' ), '<span class="author vcard">' . esc_html( get_the_author() ) . '</span>'
	);
	$categories_list = get_the_category_list( esc_html__( ', ', 'domenicafiore' ) );

  echo '<div class="left"><span class="category">' . $categories_list . '</span> / <span class="byline"> ' . $byline . '</span></div><div class="right"><span class="date">' . $date . '</span></div>';
}


// function understrap_posted_on() {
// 	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
// 	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
// 		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
// 	}
// 	$time_string = sprintf( $time_string,
// 		esc_attr( get_the_date( 'c' ) ),
// 		esc_html( get_the_date() ),
// 		esc_attr( get_the_modified_date( 'c' ) ),
// 		esc_html( get_the_modified_date() )
// 	);
//   $date = get_the_date('j M Y');
//   /* translators: used between list items, there is a space after the comma */
//   $categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
//
//   if ( $categories_list && understrap_categorized_blog() ) {
//     // printf( '<span class="cat-links"></span>', $categories_list ); // WPCS: XSS OK.
//   }
// 	$posted_on = sprintf(
// 		esc_html_x( 'Posted on %s', 'post date', 'understrap' ),
// 		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
// 	);
// 	$byline = sprintf(
// 		esc_html_x( 'by %s', 'post author', 'understrap' ),
// 		'<span class="author vcard">' . esc_html( get_the_author() ) . '</span>'
// 	);
//
//   echo '<div class="left"><span class="category">' . $categories_list . '</span> / <span class="byline"> ' . $byline . '</span></div><div class="right"><span class="date">' . $date . '</span></div>'; // WPCS: XSS OK.
//
// 	// echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
// }

?>
