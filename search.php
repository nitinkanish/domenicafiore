<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

get_header();

?>

<div class="container">
  <div class="row header-row">
    <div class="col-12">
      <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'understrap' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    </div>
  </div>
</div>

<div class="container search-results-container">
  <?php if ( have_posts() ) : ?>
    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="row result-row">
        <div class="col-12">
          <?php get_template_part( 'loop-templates/content', 'search' ); ?>
        </div>
      </div>
    <?php endwhile; ?>
</div>
<div class="container pagination-container">
    <!-- Pagination -->
    <div class="row pagination-row">
      <div class="col-12">
        <div class="pagination-links">
          <?php df_the_posts_navigation(); ?>
        </div>
      </div>
    </div>
  <?php else : ?>

    <div class="row">
      <div class="col-12">
        <?php get_template_part( 'loop-templates/content', 'none' ); ?>
      </div>
    </div>

  <?php endif; ?>
</div>

<?php get_footer(); ?>
