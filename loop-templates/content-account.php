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
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

</article><!-- #post-## -->
