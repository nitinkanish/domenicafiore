<?php
  $page_id = woocommerce_get_page_id('shop');
  $hero_title = get_post_meta( $page_id, '_shop_hero_title', TRUE );
  $hero_image = get_post_meta( $page_id, '_shop_hero_image', TRUE );
?>
<div class="container-fluid hero">
  <div class="row">
    <div class="col-12 hero-image">
      <div class="image-container" style="background-image:url('<?php echo $hero_image ?>');"></div>
      <div class="text-container">
        <h1><?php echo $hero_title; ?></h1>
      </div>
      <?php if ( get_sub_field('show_concierge_link') ) { ?>
        <a class="hero-concierge-link" href="/concierge">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/concierge-link@2x.png" alt="Shop With Concierge">
        </a>
      <?php } ?>
    </div>
  </div>

  <div class="row intro-text-container">
    <div class="col-12">
      <p class="intro-text"><?php the_sub_field('intro_text'); ?></p>
    </div>
  </div>
</div>
