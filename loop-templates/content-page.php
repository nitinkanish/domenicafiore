<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="container">
		<div class="row">
			<div class="col-12">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</div>
		</div>
	</div>

</article><!-- #post-## -->
