<?php
  $parent = get_post( wp_get_post_parent_id( $post->ID ) );
?>
<!-- Breadcrumbs -->
<div class="breadcrumb-links">
  <a href="<?php echo get_permalink( get_page_by_path( 'concierge' ) ); ?>"><?php _e( 'Concierge', 'domenicafiore' ); ?></a> / <a href="<?php echo get_permalink( $parent->ID ); ?>"><?php echo $parent->post_title; ?></a> / <?php echo get_the_title( $post->ID ); ?>
</div>
<!-- Intro Container -->
<div class="container intro">
  <div class="row">
    <div class="col-12">
      <h1><?php the_sub_field('intro_title'); ?></h1>
      <p><?php the_sub_field('intro_copy'); ?></p>
    </div>
  </div>
</div>
