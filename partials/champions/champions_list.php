<div class="container champions-list">
  <div class="row">
    <?php if( have_rows('champions') ): while ( have_rows('champions') ) : the_row(); ?>
      <div class="col champion">
        <a class="logo-link" href="<?php the_sub_field('url'); ?>" target="_blank">
          <div class="logo" style="background-image:url('<?php the_sub_field('logo'); ?>');"></div>
        </a>
        <a class="name-link" href="<?php the_sub_field('url'); ?>" target="_blank">
          <h3><?php the_sub_field('name'); ?></h3>
        </a>
      </div>
    <?php
      endwhile;
      else :
        // no rows found
      endif;
    ?>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
  </div>
</div>
