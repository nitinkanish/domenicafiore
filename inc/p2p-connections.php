<?php
function my_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'posts_to_pages',
		'from' => 'awards',
		'to' => 'award-shows'
	) );
}
add_action( 'p2p_init', 'my_connection_types' );
?>
