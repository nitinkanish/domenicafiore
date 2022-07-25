<?php

function df_get_translated_permalink_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);

  if ($page) {
    $wpml_object_id = apply_filters( 'wpml_object_id', $page->ID, 'post' );
    return get_permalink($wpml_object_id);
  } else {
    return null;
  }
}
