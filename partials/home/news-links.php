<div class="container news-links">
  <div class="row">
    <div class="col-12">
      <h2 class="conqueror"><?php _e( 'News', 'domenicafiore' ); ?></h2>
    </div>
  </div>
  <!-- Links repeater -->
  <?php if( have_rows('links') ): ?>
    <div class="row">
      <?php
        while ( have_rows('links') ) : the_row();
      ?>
        <div class="col-sm-6 news-link-group">
          <div class="image-container">
            <a href="<?php the_sub_field('link_url'); ?>">
              <img class="img-fluid" src="<?php the_sub_field('link_image'); ?>" alt="<?php the_sub_field('link_headline'); ?>">
            </a>
          </div>
          <div class="text-container">
            <h3><?php the_sub_field('link_headline'); ?></h3>
            <p><?php the_sub_field('link_description'); ?></p>
            <a class="btn btn-grey" href="<?php the_sub_field('link_url'); ?>"><?php _e( 'Learn More', 'domenicafiore' ); ?></a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php
    else :
      // no rows found
    endif;
  ?>
</div>
