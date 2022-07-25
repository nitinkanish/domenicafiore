<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

?>

<h3 class="page-title"><?php esc_html_e( 'Nothing Found', 'understrap' ); ?></h3>

<?php if ( is_search() ) : ?>

  <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'understrap' ); ?></p>

<?php else : ?>

  <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'understrap' ); ?></p>

<?php endif; ?>

<div class="search-form-container">

  <?php get_search_form(); ?>

</div>
