<?php $hero = get_field('hero'); ?>

<div class="container-fluid hero">
  <div class="row">
    <div class="col-12 hero-image">
      <div class="image-container" style="background-image:url('<?php echo $hero['image']; ?>');"></div>
      <div class="text-container">
        <h1><?php echo $hero['title']; ?></h1>
      </div>
    </div>
  </div>
</div>
