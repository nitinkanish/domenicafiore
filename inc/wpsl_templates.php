<?php
add_filter( 'wpsl_templates', 'custom_templates' );

function custom_templates( $templates ) {

  /**
   * The 'id' is for internal use and must be unique ( since 2.0 ).
   * The 'name' is used in the template dropdown on the settings page.
   * The 'path' points to the location of the custom template,
   * in this case the folder of your active theme.
   */
  $templates[] = array (
      'id'   => 'df_store-locator',
      'name' => 'DF Store Locator Template',
      'path' => get_stylesheet_directory() . '/' . 'wpsl-templates/df_store-locator.php',
  );

  return $templates;
}
?>
