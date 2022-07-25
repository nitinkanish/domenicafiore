<?php
  $categories = get_the_category();
  $args = array(
    'post_type' => 'post',
    'tag' => 'recommended',
    'post__not_in' => array( get_the_ID() ),
    'posts_per_page' => 2,
    // 'cat'     => $categories[0]->term_id,
    'orderby' => 'date',
    'order' => 'DESC',
  );
  $query = new WP_Query( $args );
?>

<div class="container related-posts">
<?php if( $query->have_posts() ) : ?>

    <div class="row">
      <div class="col-12">
        <h3>People Also Viewed</h3>
      </div>
    </div>
    <div class="row">
      <?php while( $query->have_posts() ) : $query->the_post(); ?>
        <div class="col-6 related-post-column">
          <div class="thumbnail-container">
            <div class="image-container" style="background-image:url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');"></div>
          </div>
          <div class="meta-container">
            <?php df_post_meta(); ?>
          </div>
          <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
          <div class="excerpt">
            <?php the_excerpt(); ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

<?php endif; wp_reset_postdata(); ?>
</div>
