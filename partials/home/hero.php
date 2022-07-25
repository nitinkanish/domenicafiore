<?php
  $hero_image = get_sub_field('hero_image');
?>

<div class="container-fluid hero">
  <div class="row">
    <div class="col-12 hero-image">
      <div class="image-container" style="background-image:url('<?php echo $hero_image ?>');"></div>
      <div class="text-container <?php the_sub_field('text_position') ?>">
        <h1><?php the_sub_field('hero_headline'); ?></h1>
        <p><?php the_sub_field('hero_copy'); ?></p>
        <!-- Note: Add btn-hero class to button for larger style -->
        <?php if ( get_sub_field('hero_link_button') ) : ?>
          <a class="btn btn-green btn-hero" href="<?php the_sub_field('hero_link_button') ?>"><?php the_sub_field('button_label') ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
