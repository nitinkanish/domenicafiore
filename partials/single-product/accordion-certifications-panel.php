<?php
  $index = get_row_index();
?>

<div class="card certifications">
  <div class="card-header" id="heading_<?php echo $index; ?>">
      <h5 class="mb-0">
        <button class="btn btn-accordion" data-toggle="collapse" data-target="#collapse_<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $index; ?>">
          <span class="text"><?php _e( 'Certifications', 'domenicafiore' ); ?></span>
          <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
        </button>
      </h5>
    </div>

    <div id="collapse_<?php echo $index; ?>" class="df-accordion-collapse collapse" aria-labelledby="heading_<?php echo $index; ?>" data-parent="#product_accordion">
      <div class="card-body">
        <div class="certifications-container">
          <?php while ( have_rows('certifications') ) : the_row(); ?>
            <div class="certifications-row">
              <div class="logo">
                <img class="img-fluid" src="<?php the_sub_field('logo'); ?>" alt="">
              </div>
              <div class="description">
                <p><?php the_sub_field('description'); ?></p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
</div>
