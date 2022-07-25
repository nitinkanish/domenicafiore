<?php
  // **Sort awards by show**

  $sorted_award_shows = new stdClass();

  // Iterate through Award Shows post type
  while ( $award_shows_query->have_posts() ) : $award_shows_query->the_post();

    $award_show_name        = get_the_title();
    $award_show_ID          = 'award_show_' . get_the_ID();
    $award_show_year        = get_post_meta( get_the_ID(), 'year', true );
    $award_show_url         = get_post_meta( get_the_ID(), 'website', true );
    $award_show_description = get_the_content();
    $show_year_class        = 'year_' . $award_show_year;
    $awards_repeater        = get_post_meta( get_the_ID(), 'awards', true );
    $award_images_repeater  = get_post_meta( get_the_ID(), 'award_images', true );


    // Build year classes
    if ( !isset( $sorted_award_shows->$show_year_class ) ) {
      $sorted_award_shows->$show_year_class = new stdClass();
      $sorted_award_shows->$show_year_class->year = $award_show_year;
      $sorted_award_shows->$show_year_class->award_shows = new stdClass();
    }
    // Add award shows as sub-class of year
    $sorted_award_shows->$show_year_class->award_shows->$award_show_ID = new stdClass();
    $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->name = $award_show_name;
    $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->year = $award_show_year;
    $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->description = $award_show_description;

    // Add awards as sub-class of award shows
    $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->awards = new stdClass();
    if ( $awards_repeater ) {
      for ( $i=0; $i<$awards_repeater; $i++ ) {
        $award_ID = 'award_' . get_the_ID() . '_' . $i;
        $olio_name = get_post_meta( get_the_ID(), 'awards_' . $i . '_olio_name', true );
        $award_name = get_post_meta( get_the_ID(), 'awards_' . $i . '_award_name', true );


        $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->awards->$award_ID = new stdClass();
        $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->awards->$award_ID->olio_name = $olio_name;
        $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->awards->$award_ID->award_name = $award_name;
      }
    }

    // Add award images as sub-class of award shows
    $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->award_images = new stdClass();
    if ( $award_images_repeater > 0 ) {
      for ( $i=0; $i<$award_images_repeater; $i++ ) {
        $image_ID  = 'image_' . get_the_ID() . '_' . $i;
        $attachment_ID = get_post_meta( get_the_ID(), 'award_images_' . $i . '_image', true );
        $url = wp_get_attachment_image_src( $attachment_ID, 'full' );

        $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->award_images->$image_ID = new stdClass();
        $sorted_award_shows->$show_year_class->award_shows->$award_show_ID->award_images->$image_ID->url = $url;
      }
    }
  endwhile;
?>
