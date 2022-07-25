<?php
  $hero_image = get_sub_field('hero_image');
?>

<div class="container-fluid hero">
  <div class="row">
    <div class="col-12 hero-image">
      <div class="image-container" style="background-image:url('<?php echo $hero_image ?>');"></div>
      <div class="text-container">
        <h1><?php the_sub_field('hero_title'); ?></h1>
      </div>
    </div>
  </div>
</div>
