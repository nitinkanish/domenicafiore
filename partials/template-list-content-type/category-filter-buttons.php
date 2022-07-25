<?php
  // Get category terms
  if ( is_page('recipes') ) {
    $categories = get_terms( 'recipe_categories' );
  } elseif ( is_home() ) {
    $categories = get_terms( 'category' );
  }
?>

<!-- Tag Links -->
<?php if ( isset( $categories ) ) { ?>
  <div class="container category-filter-buttons">
    <div class="row">
      <div class="col-12 button-container">
        <?php foreach($categories as $category) { ?>
          <a class="btn btn-grey" href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
        <?php	}	?>
      </div>
    </div>
  </div>
<?php } ?>
