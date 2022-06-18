<?php
/*
Template Name: Nieuws artikel
Template Post Type: nieuws
*/
?>

<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<?php
      while ( have_posts() ) :
        the_post();
			?>

      <main class="flex-grow min-h-full bg-white">

      <div class="">
        <article <?php post_class( 'pb-28 bg-white min-h-full' ); ?>>

          <?php if ( has_post_thumbnail() ) : ?>
            <div class="container-base mx-auto h-[200px] lg:h-[360px] md:h-96 overflow-hidden">
              <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-top')); ?>
            </div>
          <?php endif; ?>
          
          <div class="mx-auto container-xl">
            <div class="grid grid-cols-12 lg:gap-x-5 xl:gap-x-10">
              <div class="col-span-full lg:col-start-3 lg:col-span-8">
                <div class="mt-12 mb-8">
                  <a class="btn" href="<?php echo get_post_type_archive_link('nieuws'); ?>">Terug naar overzicht</a>
                </div>
                <header class="mt-8 entry-header fade">
                  <?php the_title( sprintf( '<h2 class="mb-2 text-4xl font-bold text-black entry-title"><span>', esc_url( get_permalink() ) ), '</span></h2>' ); ?>
                </header>
                <div class="entry-content appear">
                  <span class="block mb-6 font-semibold text-secondary text-small">
                    <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                  </span>
                  <?php
                    /* translators: %s: Name of current post */
                    the_content();
                  ?>
                </div>
              </div>
            </div>
          </div>
          
        </article>
      </div>

      </main>

		<?php endwhile; ?>

	<?php endif; ?>

<?php
get_footer();
