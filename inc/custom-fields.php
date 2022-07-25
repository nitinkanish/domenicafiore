<?php

/**
* Add meta box
*
* @param post $post The post object
* @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
*/

function shop_add_meta_boxes( ){
  global $post;
  $slug = $post->post_name;
  if ( $slug == 'shop' OR $slug == 'shop-2' ) {
    add_meta_box( 'shop_meta_box', 'Shop Page (Custom)', 'shop_build_meta_box', 'page', 'normal', 'default' );
  }
}
add_action( 'admin_head', 'shop_add_meta_boxes' );


function shop_build_meta_box(){
  global $post;
	wp_nonce_field( basename( __FILE__ ), 'shop_meta_box_nonce' );

  $shop_hero_image = get_post_meta($post->ID, '_shop_hero_image', true );
  $shop_hero_title = get_post_meta( $post->ID, '_shop_hero_title', true );
  $shop_intro_text = get_post_meta( $post->ID, '_shop_intro_text', true );
  $shop_links = get_post_meta($post->ID, '_shop_link_data_group', true);

	?>
	<div class='inside'>
		<h3><?php _e( 'Hero Section', 'domenicafiore' ); ?></h3>
		<p>
      <label for="hero-image">Hero Image</label><br />
      <input type="url" id="shop_hero_image" name="hero-image" value="<?php echo $shop_hero_image; ?>">
      <button type="button" class="button inline-btn" id="shop_hero_image_upload_btn" data-media-uploader-target="#shop_hero_image"><?php _e( 'Upload', 'domenicafiore' )?></button>
		</p>
    <p>
      <label for="hero-title">Title Text</label><br />
      <input type="text" name="hero-title" value="<?php echo $shop_hero_title; ?>" />
		</p>
    <p>
      <label for="intro-text">Intro Text</label><br />
      <textarea name="intro-text" cols="55" rows="5"><?php echo $shop_intro_text; ?></textarea>
		</p>

		<h3><?php _e( 'Shop Links', 'domenicafiore' ); ?></h3>
    <div id="links-repeater">
      <?php
       if ( $shop_links ) :
        foreach ( $shop_links as $field ) {
      ?>
      <table class="link-block-table" width="100%">
        <tbody>
          <tr>
            <td>
              <input class="link-id" type="hidden" name="link_id[]" value="<?php if($field['link_id'] != '') echo esc_attr( $field['link_id'] ); ?>">
              <label for="link_image[]">Link Image</label><br />
              <input class="link-image-url" type="url" id="link_image_<?php if($field['link_id'] != '') echo esc_attr( $field['link_id'] ); ?>" name="link_image[]" value="<?php if($field['link_image'] != '') echo esc_attr( $field['link_image'] ); ?>"><br>
              <button type="button" class="button link-image-button" id="link_image_upload_btn_link_image_<?php if($field['link_id'] != '') echo esc_attr( $field['link_id'] ); ?>" data-media-uploader-target="#link_image_<?php if($field['link_id'] != '') echo esc_attr( $field['link_id'] ); ?>">
                <?php _e( 'Upload', 'domenicafiore' )?>
              </button>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_title[]">Link Title</label><br />
              <input type="text" placeholder="Link Title" title="Link Title" name="link_title[]" value="<?php if($field['link_title'] != '') echo esc_attr( $field['link_title'] ); ?>" />
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_text[]">Link Text</label><br />
              <textarea placeholder="Link Text" cols="55" rows="5" name="link_text[]"><?php if($field['link_text'] != '') echo esc_attr( $field['link_text'] ); ?></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_url[]">Link URL</label><br />
              <input class="link-url-input" type="url" placeholder="Link URL" name="link_url[]" value="<?php if($field['link_url'] != '') echo esc_attr( $field['link_url'] ); ?>"></input>
              <button type="button" class="button link-select-btn" id="link_url_select_<?php if($field['link_id'] != '') echo esc_attr( $field['link_id'] ); ?>">Select a Link</button>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_button_label[]">Link Button Label</label><br />
              <input type="text" placeholder="Link Button Label" name="link_button_label[]" value="<?php if($field['link_button_label'] != '') echo esc_attr( $field['link_button_label'] ); ?>"></input>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td><a class="button remove-table" href="#">Remove Link</a></td>
          </tr>
        </tfoot>
      </table>
      <?php
        }
        else : // show a blank one
      ?>
      <table class="link-block-table" width="100%">
        <tbody>
          <tr>
            <td>
              <input class="link-id" type="hidden" name="link_id[]" value="0">
              <label for="link_image[]">Link Image</label><br />
              <input class="link-image-url" type="url" id="link_image_0" name="link_image[]" value=""><br>
              <button type="button" class="button link-image-button" id="link_image_upload_btn_link_image_0" data-media-uploader-target="#link_image_0">
                <?php _e( 'Upload', 'domenicafiore' )?>
              </button>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_title[]">Link Title</label><br />
              <input type="text" placeholder="Link Title" title="Link Title" name="link_title[]" />
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_text[]">Link Text</label><br />
              <textarea placeholder="Link Text" cols="55" rows="5" name="link_text[]"></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_url[]">Link URL</label><br />
              <input class="link-url-input" type="url" placeholder="Link URL" name="link_url[]" value=""></input>
              <button type="button" class="button link-select-btn" id="link_url_select_0">Select a Link</button>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_button_label[]">Link Button Label</label><br />
              <input type="text" placeholder="Link Button Label" name="link_button_label[]"></input>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td><a class="button remove-table-disabled button-disabled" href="#">Remove</a></td>
          </tr>
        </tfoot>
      </table>
      <?php endif; ?>

      <!-- empty hidden one for jQuery -->
      <table class="empty-link-block screen-reader-text">
        <tbody>
          <tr>
            <td>
              <input class="link-id" type="hidden" name="link_id[]" value="">
              <label for="link_image[]">Link Image</label><br />
              <input class="link-image-url" type="url" id="" name="link_image[]" value=""><br>
              <button type="button" class="button link-image-button" id="link_image_upload_btn_link_image_0" data-media-uploader-target="#link_image_0">
                <?php _e( 'Upload', 'domenicafiore' )?>
              </button>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_title[]">Link Title</label><br />
              <input type="text" placeholder="Link Title" title="Link Title" name="link_title[]" />
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_text[]">Link Text</label><br />
              <textarea placeholder="Link Text" cols="55" rows="5" name="link_text[]"></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_url[]">Link URL</label><br />
              <input class="link-url-input" type="url" placeholder="Link URL" name="link_url[]" value=""></input>
              <button type="button" class="button link-select-btn" id="">Select a Link</button>
            </td>
          </tr>
          <tr>
            <td>
              <label for="link_button_label[]">Link Button Label</label><br />
              <input type="text" placeholder="Link Button Label" name="link_button_label[]"></input>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td><a class="button remove-table" href="#">Remove</a></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <p><a id="add-link-button" class="button" href="#">Add Link Block</a></p>

	</div>
	<?php
}

function shop_save_meta_box_data( $post_id ){
	// verify taxonomies meta box nonce
	if ( !isset( $_POST['shop_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['shop_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	// store custom fields values
  if ( isset( $_REQUEST['hero-image'] ) ) {
  	update_post_meta( $post_id, '_shop_hero_image', $_POST['hero-image'] );
  }
  if ( isset( $_REQUEST['hero-title'] ) ) {
  	update_post_meta( $post_id, '_shop_hero_title', $_POST['hero-title'] );
  }
  if ( isset( $_REQUEST['intro-text'] ) ) {
  	update_post_meta( $post_id, '_shop_intro_text', $_POST['intro-text'] );
  }

  // Store link block repeater values
  $old_shop_links = get_post_meta($post_id, '_shop_link_data_group', true);
  $new_shop_links = array();
  $link_ids = $_POST['link_id'];
  $link_images = $_POST['link_image'];
  $link_titles = $_POST['link_title'];
  $link_texts = $_POST['link_text'];
  $link_urls = $_POST['link_url'];
  $link_button_labels = $_POST['link_button_label'];

  $link_count = count( $link_ids );
   for ( $i = 0; $i < $link_count; $i++ ) {
      if ( $link_ids[$i] != '' ) :
        $new_shop_links[$i]['link_id'] = $link_ids[$i];
        $new_shop_links[$i]['link_image'] = $link_images[$i];
        $new_shop_links[$i]['link_title'] = $link_titles[$i];
        $new_shop_links[$i]['link_text'] = $link_texts[$i];
        $new_shop_links[$i]['link_url'] = $link_urls[$i];
        $new_shop_links[$i]['link_button_label'] = $link_button_labels[$i];
      endif;
  }
  if ( !empty( $new_shop_links ) && $new_shop_links != $old_shop_links )
    update_post_meta( $post_id, '_shop_link_data_group', $new_shop_links );
  elseif ( empty($new_shop_links) && $old_shop_links )
    delete_post_meta( $post_id, '_shop_link_data_group', $old_shop_links );
}
add_action( 'save_post', 'shop_save_meta_box_data' );


function df_load_admin_scripts( $hook ) {
  wp_enqueue_media();
  wp_register_script( 'meta-box-image', get_stylesheet_directory_uri() . '/js/df-shop-meta-boxes.js', array( 'jquery' ) );
  wp_localize_script( 'meta-box-image', 'meta_image',
    array(
      'title' => __( 'Choose or Upload Media', 'events' ),
      'button' => __( 'Use this media', 'events' ),
    )
  );
  wp_enqueue_script( 'meta-box-image' );
}
add_action( 'admin_enqueue_scripts', 'df_load_admin_scripts', 10, 1 );


// Add ACF Options Pages

  if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
  		'page_title' 	=> 'Announcement Bar',
  		'menu_title'	=> 'Announcement Bar',
  		'menu_slug' 	=> 'announcement-bar',
      'icon_url'    => 'dashicons-welcome-widgets-menus',
  	));

    acf_add_options_page(array(
  		'page_title' 	=> 'WooCommerce Customizations',
  		'menu_title'	=> 'WooCommerce Customizations',
  		'menu_slug' 	=> 'df-woocommerce-customizations',
      'icon_url'    => 'dashicons-admin-generic',
  	));

  }

?>
