<?php
  $image_url = get_sub_field('olive_oil_club_image');
?>

<div class="container olive-oil-club">
  <div class="row">
    <div class="col-12">
      <h2><?php the_sub_field('olive_oil_club_headline'); ?></h2>
      <p><?php the_sub_field('olive_oil_club_copy'); ?></p>
      <img src="<?php echo $image_url['url']; ?>" alt="Olive Oil Club">
      <a class="btn btn-grey" href="<?php the_sub_field('olive_oil_club_link'); ?>"><?php _e( 'Learn More', 'domenicafiore' ); ?></a>
    </div>
  </div>
</div>
