<?php if( have_rows('menu') ): ?>
<div class="container sub-category-links">
  <div class="row">
    <?php
      while ( have_rows('menu') ) : the_row();
    ?>
    <div class="col-6 col-sm-4 link-column">
      <a class="thumbnail-title-container" href="<?php the_sub_field('link_url'); ?>">
        <div class="image-container" style="background-image:url('<?php the_sub_field('link_image'); ?>');"></div>
        <h2><?php the_sub_field('link_title'); ?></h2>
      </a>
    </div>
    <?php endwhile; ?>
  </div>
</div>
<?php
  else :
    // no rows found
  endif;
?>
