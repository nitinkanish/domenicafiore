<div class="container link-button-block">
  <div class="row">
    <div class="col-12">
      <h3><?php the_sub_field('link_block_title'); ?></h3>
      <?php if( have_rows('link_buttons') ): ?>
        <div class="link-button-container">
          <?php while ( have_rows('link_buttons') ) : the_row(); ?>
            <a class="btn btn-green" href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_button_label'); ?></a>
          <?php endwhile; ?>
        </div>
      <?php
        else :
          // no rows found
        endif;
      ?>
    </div>
  </div>
</div>
