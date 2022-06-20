<?php
/*
Template Name: Full-width contentblocks only
Template Post Type: post, page, product, programma
*/
?>

<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'template-parts/content-full-width-content', get_post_format() ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

<?php
get_footer();
