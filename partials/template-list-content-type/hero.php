<?php

  if ( is_home() ) {
    $hero = get_field('hero', get_option('page_for_posts'));
  } else {
    $hero = get_field('hero');
  }

?>

<?php if ( !empty($hero['image']) ) : ?>
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
<?php endif; ?>

<?php if ( $hero['intro_text'] ) : ?>
<div class="container intro-text">
  <div class="row">
    <div class="col-12">
      <p><?php echo $hero['intro_text']; ?></p>
    </div>
  </div>
</div>
<?php endif; ?>
