<?php
  $index = get_row_index();
?>

<div class="card">
  <div class="card-header" id="heading_<?php echo $index; ?>">
      <h5 class="mb-0">
        <button class="btn btn-accordion" data-toggle="collapse" data-target="#collapse_<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $index; ?>">
          <span class="text"><?php the_sub_field('panel_title'); ?></span>
          <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
        </button>
      </h5>
    </div>

    <div id="collapse_<?php echo $index; ?>" class="df-accordion-collapse collapse" aria-labelledby="heading_<?php echo $index; ?>" data-parent="#product_accordion">
      <div class="card-body">
        <?php the_sub_field('panel_text'); ?>
      </div>
    </div>
</div>
