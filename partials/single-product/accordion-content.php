<div class="container-fluid accordion-content" id="olio-info">
  <div class="row">
    <div class="col-12">
      <div class="df-accordion" id="product_accordion">
        <?php
          while ( have_rows('accordion_content') ) : the_row();

            // Text-Based Accordion Panel
            if( get_row_layout() == 'text-based_panel' ) {
              get_template_part('partials/single-product/accordion-text-based-panel');
            }

            // Certifications Accordion Panel
            if( get_row_layout() == 'certifications_panel' ) {
              get_template_part('partials/single-product/accordion-certifications-panel');
            }

          endwhile;
        ?>
      </div>
    </div>
  </div>
</div>
