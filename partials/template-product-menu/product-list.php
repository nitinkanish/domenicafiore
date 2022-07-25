<div class="container product-list">
  <div class="row">
    <?php
      // Products repeater
      if( have_rows('products') ):

        while ( have_rows('products') ) : the_row();
        $product_obj = get_sub_field('product');
        $product = wc_get_product( $product_obj );
        $product_url = get_permalink( $product_obj );
    ?>
      <div class="col-6 link-panel">
        <!-- Mobile Image -->
        <div class="link-image d-sm-none">
          <a href="<?php echo $product_url; ?>">
            <img src="<?php the_sub_field('product_image_mobile'); ?>" alt="<?php the_sub_field('link_title'); ?>">
          </a>
        </div>
        <!-- Title -->
        <h2><?php echo $product->get_title(); ?></h2>
        <!-- Desktop Image -->
        <div class="link-image desktop d-none d-sm-block">
          <a href="<?php echo $product_url; ?>">
            <img src="<?php the_sub_field('product_image_desktop'); ?>" alt="<?php the_sub_field('link_title'); ?>">
          </a>
        </div>
        <!-- Description -->
        <p class="d-none d-sm-block"><?php the_sub_field('product_description'); ?></p>
        <!-- Button -->
        <a class="btn btn-grey" href="<?php echo $product_url; ?>"><?php _e( 'Learn More', 'domenicafiore' ); ?></a>
      </div>
    <?php
        endwhile;

      else :
        // no rows found
      endif;
     ?>
  </div>
</div>
