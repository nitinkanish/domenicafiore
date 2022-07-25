<div class="container profile-list">
  <?php if( have_rows('profiles') ): while ( have_rows('profiles') ) : the_row(); ?>
    <?php
      $social_media = get_sub_field('social_media');
      $stats = get_sub_field('stats');
    ?>
    <div class="row profile-row">
      <div class="col-12 col-sm-6 name-photo">
        <div class="row">
          <div class="col-5 name-column">
            <h2><?php the_sub_field('name'); ?></h2>
          </div>
          <div class="col-7 photo-column">
            <div class="photo-outer">
              <div class="image-container" style="background-image:url('<?php the_sub_field('photo'); ?>');"></div>
            </div>
            <div class="social-links">
              <?php if( $social_media['instagram'] ) : ?>
                <div class="link instagram">
                  <a href="<?php echo $social_media['instagram']; ?>">
                    <i class="fab fa-instagram"></i>
                  </a>
                </div>
              <?php endif; ?>
              <?php if( $social_media['facebook'] ) : ?>
                <div class="link facebook">
                  <a href="<?php echo $social_media['facebook']; ?>">
                    <i class="fab fa-facebook"></i>
                  </a>
                </div>
              <?php endif; ?>
              <?php if( $social_media['twitter'] ) : ?>
                <div class="link twitter">
                  <a href="<?php echo $social_media['twitter']; ?>">
                    <i class="fab fa-twitter"></i>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 stats">
        <?php if( $stats['hometown'] ) : ?>
          <p class="stat-row">
            <span class="stat-title"><?php _e( 'Hometown', 'domenicafiore' ); ?>: </span>
            <?php echo $stats['hometown']; ?>
          </p>
        <?php endif; ?>
        <?php if( $stats['profession'] ) : ?>
          <p class="stat-row">
            <span class="stat-title"><?php _e( 'Profession', 'domenicafiore' ); ?>: </span>
            <?php echo $stats['profession']; ?>
          </p>
        <?php endif; ?>
        <?php if( $stats['culinary_education'] ) : ?>
          <p class="stat-row">
            <span class="stat-title"><?php _e( 'Culinary Education', 'domenicafiore' ); ?>: </span>
            <?php echo $stats['culinary_education']; ?>
          </p>
        <?php endif; ?>
        <?php if( $stats['favorite_oil'] ) : ?>
          <p class="stat-row">
            <span class="stat-title"><?php _e( 'Favorite Oil', 'domenicafiore' ); ?>: </span>
            <?php echo $stats['favorite_oil']; ?>
          </p>
        <?php endif; ?>
        <?php if( $stats['favorite_recipe'] ) : ?>
          <p class="stat-row">
            <span class="stat-title"><?php _e( 'Favorite Recipe', 'domenicafiore' ); ?>: </span>
            <?php echo $stats['favorite_recipe']; ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
  <?php
    endwhile;
    else :
      // no rows found
    endif;
  ?>
</div>
