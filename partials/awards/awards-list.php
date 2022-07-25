<?php
  // The Query
  $award_shows_query = new WP_Query(
    array(
      'post_type' => 'award_shows',
      'posts_per_page' => -1,
      'meta_key' => 'year',
      'orderby' => 'meta_value_num',
      'order' => 'DESC'
    )
  );

  if ( $award_shows_query->have_posts() ) {
    include( locate_template('partials/awards/sort-awards.php') ); // Builds $sorted_award_shows class
  }
?>

<div class="container-fluid awards-list-container">
  <div class="row">
    <div class="col-12">
      <?php if ( $award_shows_query->have_posts() ) { ?>
      <div class="df-accordion" id="award-years-accordion">
        <?php
          $award_year_index = 1;
          foreach ( $sorted_award_shows as $year ) : $year;
        ?>
          <!-- Year Accordion -->
          <div class="card">
            <div class="card-header" id="award-year-heading-<?php echo($year->year); ?>">
              <h5 class="mb-0">
                <button class="btn btn-accordion" data-toggle="collapse" data-target="#award-year-collapse-<?php echo($year->year); ?>" aria-expanded="<?php if ( $award_year_index == 1 ) { echo 'true'; } else { echo 'false'; } ?>" aria-controls="award-year-collapse-<?php echo($year->year); ?>">
                  <span class="text"><?php echo($year->year); ?></span>
                  <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                </button>
              </h5>
            </div>
            <div id="award-year-collapse-<?php echo($year->year); ?>" class="df-accordion-collapse collapse <?php if ( $award_year_index == 1 ) { echo 'show'; } ?>" aria-labelledby="award-year-heading-<?php echo($year->year); ?>" data-parent="#award-years-accordion">
              <div class="card-body">

                <div class="df-accordion award-shows-accordion" id="award-shows-<?php echo($year->year); ?>-accordion">
                  <!-- Award Shows Accordion -->
                  <?php
                    $award_show_index = 1;
                    foreach ( $year->award_shows as $award_show ) : $award_show;
                  ?>
                    <div class="card">
                      <div class="card-header" id="award-show-card-heading-<?php echo($year->year); ?>-<?php echo $award_show_index; ?>">
                        <h5 class="mb-0">
                          <button class="btn btn-accordion" data-toggle="collapse" data-target="#award-show-collapse-<?php echo($year->year); ?>-<?php echo $award_show_index; ?>" aria-expanded="<?php if ( $award_year_index == 1 ) { echo 'true'; } else { echo 'false'; } ?>" aria-controls="award-show-collapse-<?php echo($year->year); ?>-<?php echo $award_show_index; ?>">
                            <div class="text">
                              <div class="award-show-name">
                                <?php echo($award_show->name); ?>
                              </div>
                            </div>
                            <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                          </button>
                        </h5>
                      </div>
                      <div id="award-show-collapse-<?php echo($year->year); ?>-<?php echo $award_show_index; ?>" class="df-accordion-collapse collapse <?php if ( $award_show_index == 1 ) { echo 'show'; } ?>" aria-labelledby="award-show-card-heading-<?php echo($year->year); ?>-<?php echo $award_show_index; ?>" data-parent="#award-shows-<?php echo($year->year); ?>-accordion">
                        <div class="card-body">
                          <!-- Award Badges -->
                          <?php if ( count((array)$award_show->award_images) > 0 ) : ?>
                            <div class="award-images">
                              <?php foreach( $award_show->award_images as $award_image ) : ?>
                                <img src="<?php echo $award_image->url[0]; ?>">
                              <?php endforeach; ?>
                            </div>
                          <?php endif; ?>
                          <!-- Awards Table -->
                          <?php if ( $award_show->awards ) : ?>
                          <div class="awards-list">
                            <?php foreach( $award_show->awards as $award ) : ?>
                            <div class="award">
                              <div class="olio-name"><?php echo $award->olio_name; ?></div>
                              <div class="award-name"><?php echo $award->award_name; ?></div>
                            </div>
                            <?php endforeach; ?>
                          </div>
                          <?php endif; ?>
                          <!-- Description -->
                          <?php if ( $award_show->description ) : ?>
                            <div class="award-show-description">
                              <?php echo $award_show->description; ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php
                    $award_show_index++;
                    endforeach;
                  ?>
                </div>

              </div>
            </div>
          </div>
        <?php
          $award_year_index++;
          endforeach;
        ?>
      </div>
      <?php } else { } ?>
    </div>
  </div>

</div>
