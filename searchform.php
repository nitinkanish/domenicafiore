<?php
/**
 * The template for displaying search forms in Underscores.me
 *
 * @package understrap
 */

?>
<form class="df-form" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="input-group">
		<input class="field form-control" id="s" name="s" type="text"
			placeholder="<?php esc_attr_e( 'Search &hellip;', 'understrap' ); ?>" value="<?php the_search_query(); ?>">
    <input class="submit btn btn-grey" id="searchsubmit" name="submit" type="submit"
    value="<?php esc_attr_e( 'Search', 'understrap' ); ?>">
	</div>
</form>
