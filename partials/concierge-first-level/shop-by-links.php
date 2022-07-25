
<div class="container shop-by-links">
  <div class="row">
    <div class="col-12">
      <h3><?php the_sub_field('section_title') ?></h3>
    </div>
  </div>
  <?php if( have_rows('links') ): ?>
  <div class="row">
    <?php
      while ( have_rows('links') ) : the_row();
    ?>
    <div class="col-12 col-sm-4 link-column">
      <div class="row">
        <div class="col-6 col-sm-12 thumbnail-column">
          <a class="thumbnail-title-container" href="<?php the_sub_field('link_url'); ?>">
            <div class="image-container" style="background-image:url('<?php the_sub_field('link_image'); ?>');"></div>
            <h4><?php the_sub_field('link_title'); ?></h4>
          </a>
        </div>
        <div class="col-6 col-sm-12 text-column">
          <p><?php the_sub_field('link_text'); ?></p>
        </div>
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
