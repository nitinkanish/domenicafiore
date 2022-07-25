<?php
/**
 * The template for the Blog index page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();
?>

<?php get_template_part( 'loop-templates/tpl', 'list-content-type' ); ?>

<?php get_footer(); ?>
