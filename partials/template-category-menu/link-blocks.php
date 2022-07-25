<div class="container link-blocks">
  <div class="row">
    <?php
      // check if the repeater field has rows of data
      if( have_rows('link_block') ):

      // loop through the rows of data
        while ( have_rows('link_block') ) : the_row();
        $link_image = get_sub_field('link_image');
    ?>
      <div class="col-12 col-sm-6 link-panel">
        <div class="panel-content">
          <h2 class="conqueror"><?php the_sub_field('link_title'); ?></h2>
          <p><?php the_sub_field('link_text'); ?></p>
        </div>
        <div class="link-image">
          <a href="<?php the_sub_field('link_url'); ?>">
            <img src="<?php the_sub_field('link_image'); ?>" alt="<?php the_sub_field('link_title'); ?>">
          </a>
        </div>
        <a class="btn btn-grey" href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_button_label'); ?></a>
      </div>
    <?php
        endwhile;

      else :
        // no rows found
      endif;
     ?>
  </div>
</div>
