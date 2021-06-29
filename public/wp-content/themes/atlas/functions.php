<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);



// Add ACF to post list
function change_columns( $cols ) {
  $cols = array(
  'cb'         => '<input type="checkbox" />',
  'title'      => 'Title',
  'catmap'     => 'Categoría',
  'date'       => 'Fecha'
  );
  return $cols;
}
function custom_columns( $column ) {
global $post;
	if( $column == 'catmap' ) {
	    $catmap = get_field('category');      
      $value = $catmap['label'];
      $label = $catmap['choices'][ $value ];


	    if( $catmap ) {
	        echo $value;
		} else {
			echo '-';
		}
	}
}
add_action( "manage_lugar_posts_custom_column", "custom_columns", 10, 2 );
add_filter( "manage_lugar_posts_columns", "change_columns" );