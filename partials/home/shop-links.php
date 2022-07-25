<div class="container shop-links">
  <div class="row">
    <div class="col-12">
      <h2 class="conqueror"><?php the_sub_field('headline'); ?></h2>
    </div>
  </div>

  <!-- Links repeater -->
  <?php if( have_rows('links') ): ?>
    <div class="row">
      <?php
        while ( have_rows('links') ) : the_row();
      ?>
        <div class="col-6 shop-link-group">
          <a href="<?php the_sub_field('shop_link_url'); ?>">
            <img src="<?php the_sub_field('shop_link_image'); ?>" alt="<?php the_sub_field('shop_link_title'); ?>">
          </a>
          <h3><?php the_sub_field('shop_link_title'); ?></h3>
          <p><?php the_sub_field('shop_link_text'); ?></p>
          <a class="btn btn-grey" href="<?php the_sub_field('shop_link_url'); ?>"><?php _e( 'SHOP', 'domenicafiore' ); ?></a>
        </div>
      <?php endwhile; ?>
    </div>
  <?php
    else :
      // no rows found
    endif;
  ?>
</div>
