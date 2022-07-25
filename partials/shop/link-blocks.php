<?php
  $page_id = woocommerce_get_page_id('shop');
  $shop_links = get_post_meta( $page_id, '_shop_link_data_group', TRUE );
?>
<div class="container link-blocks">
  <div class="row">

    <?php foreach ( $shop_links as $link ) : ?>
      <div class="col-12 col-sm-6 link-panel">
        <div class="panel-content">
          <h2 class="conqueror"><?php echo $link['link_title']; ?></h2>
          <p><?php echo $link['link_text']; ?></p>
        </div>
        <div class="link-image">
          <a href="<?php echo $link['link_url'] ?>">
            <img src="<?php echo $link['link_image'] ?>" alt="<?php echo $link['link_title']; ?>">
          </a>
        </div>
        <a class="btn btn-grey" href="<?php echo $link['link_url']; ?>"><?php echo $link['link_button_label']; ?></a>
      </div>
    <?php endforeach; ?>

  </div>
</div>
