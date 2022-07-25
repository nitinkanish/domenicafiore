<?php
/**
 * Search results partial template.
 *
 * @package understrap
 */
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php df_post_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-header -->

  <?php if ( has_excerpt() ) : ?>
		<div class="entry-summary">
			<?php echo $post->post_excerpt; ?>
		</div><!-- .entry-summary -->
	<?php elseif ( '' !== get_post()->post_content ) : ?>
		<div class="entry-summary">
			<?php echo wp_trim_words( get_post()->post_content ); ?>
		</div><!-- .entry-summary -->
	<?php endif; ?>

	<a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-green"><?php _e( 'View', 'domenicafiore' ); ?></a>

</article><!-- #post-## -->
