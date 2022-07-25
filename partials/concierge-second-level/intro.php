<!-- Breadcrumbs -->
<div class="breadcrumb-links">
  <a href="<?php echo get_permalink( get_page_by_path( 'concierge' ) ); ?>"><?php _e( 'Concierge', 'domenicafiore' ); ?></a> / <?php the_field('page_headline'); ?>
</div>
<!-- Intro Container -->
<div class="container intro">
  <div class="row">
    <div class="col-12">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/concierge-bell.svg" alt="<?php the_sub_field('intro_title'); ?>">
      <h1 class="conqueror"><?php _e( 'Concierge', 'domenicafiore' ); ?></h1>
      <h2><?php the_field('page_headline'); ?></h2>
      <p><?php the_field('intro_text'); ?></p>
      <h3><?php the_field('menu_headline'); ?></h3>
    </div>
  </div>
</div>
