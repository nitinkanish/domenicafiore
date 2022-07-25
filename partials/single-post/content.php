<div class="container post-content">
  <div class="row">
    <div class="col-12">
      <header class="entry-header">
        <div class="entry-meta">
          <?php df_post_meta(); ?>
        </div><!-- .entry-meta -->
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      </header><!-- .entry-header -->


      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    		<div class="entry-content">

    			<?php the_content(); ?>

    		</div><!-- .entry-content -->

    	</article><!-- #post-## -->

    </div>
  </div>
</div>
