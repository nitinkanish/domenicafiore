<div class="container-fluid faq">
  <div class="row">
    <?php if( have_rows('categories') ): ?>
      <div class="col-12">
        <h3><?php _e( 'FAQs', 'domenicafiore' ); ?></h3>
        <div class="df-accordion" id="faq-accordion">
          <!-- FAQ Categories repeater -->
          <?php while ( have_rows('categories') ) : the_row(); ?>
            <?php $index = get_row_index(); ?>
            <div class="card">
              <div class="card-header" id="heading_<?php echo $index; ?>">
                <h5 class="mb-0">
                  <button class="btn btn-accordion" data-toggle="collapse" data-target="#collapse_<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $index; ?>">
                    <span class="text"><?php the_sub_field('category_title'); ?></span>
                    <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                  </button>
                </h5>
              </div>

              <div id="collapse_<?php echo $index; ?>" class="df-accordion-collapse collapse" aria-labelledby="heading_<?php echo $index; ?>" data-parent="#faq-accordion">
                <div class="card-body">
                  <!-- Questions & Answers in category -->
                  <?php if( have_rows('questions_answers') ):
                    while ( have_rows('questions_answers') ) : the_row(); ?>
                    <div class="question-answer-container">
                      <p class="question"><?php the_sub_field('question'); ?></p>
                      <p class="answer"><?php the_sub_field('answer'); ?></p>
                    </div>
                  <?php endwhile;
                    endif; ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    <?php
      else :
        // no rows found
      endif;
    ?>
  </div>
</div>
