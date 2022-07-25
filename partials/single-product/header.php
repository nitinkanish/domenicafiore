<?php
  global $product;
  $header_image = get_field('header_image');
  $headline_colour = get_field('headline_colour');
?>

<div class="container-fluid header">
  <div class="row">
    <div class="col-12 hero-image">
      <div class="image-container" style="background-image:url('<?php echo $header_image ?>');"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="text-container">
        <h1 class="conqueror" <?php echo ( $headline_colour ) ? 'style="color:' . $headline_colour . '"' : 'style=""'; ?>><?php echo df_get_product_name( $product->get_ID() ); ?></h1>
        <h2 class="d-none d-sm-block"><?php the_field('page_headline'); ?></h2>
        <?php if ( $product->get_description() ) : ?>
        <div class="description">
          <?php echo $product->get_description(); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
