<?php if ( has_post_thumbnail() ) : ?>
  <div class="row">
    <div class="col-12 hero-image">
      <div class="image-container" style="background-image:url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');"></div>
    </div>
  </div>
</div>
<?php endif; ?>
