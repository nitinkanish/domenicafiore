<div class="row post-row" id="post-<?php the_ID(); ?>">
	<?php $categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) ); ?>
	<div class="col-6 image-column">
		<?php if ( !empty( get_the_post_thumbnail_url( $post->ID, 'large' ) ) ) : ?>
			<img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="<?php echo the_title(); ?>">
		<?php endif; ?>
	</div>
	<div class="col-6 text-column">
		<?php if ( !in_category('recipe') ) : ?>
			<p class="category"><?php echo $categories_list; ?></p>
		<?php endif; ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<a class="btn btn-grey" href="<?php echo get_post_permalink( $post->ID ); ?>"><?php _e( 'View', 'domenicafiore' ); ?></a>
	</div>
</div>
