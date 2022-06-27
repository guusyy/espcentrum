<?php
/*
Template Name: Pagina afbeelding met content
Template Post Type: post, page, product, programma
*/
?>

<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'template-parts/content-full-width-image', get_post_format() ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

<?php
get_footer();
