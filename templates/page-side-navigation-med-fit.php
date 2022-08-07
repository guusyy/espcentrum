<?php
/*
Template Name: Medische fitness hoofdpagina
Template Post Type: post, page, product, programma
*/
?>

<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>

      <main class="flex-grow bg-white">
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="bg-[#FFEDED] overflow-hidden">
            <div class="relative w-full mx-auto container-base">
              <div class="grid grid-cols-12 lg:gap-x-10">
                <div class="lg:rows-start-1 col-span-full lg:col-start-1 lg:col-span-6">
                  <div class="h-full py-6 lg:py-10 xl:py-14">
                    <div class="flex items-center gap-5 mb-4 lg:mb-8">
                      <svg class="!w-[25px] !h-[25px] lg:!w-[46px] lg:!h-[46px]" width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50.139 34.722L54 30.861L50.139 27L40.5 36.639L17.361 13.5L27 3.861L23.139 0L19.278 3.861L15.417 0L9.639 5.778L5.778 1.917L1.917 5.778L5.778 9.639L0 15.417L3.861 19.278L0 23.139L3.861 27L13.5 17.361L36.639 40.5L27 50.139L30.861 54L34.722 50.139L38.583 54L44.361 48.222L48.222 52.083L52.083 48.222L48.222 44.361L54 38.583L50.139 34.722Z" fill="#C93438"/>
                      </svg>
                      <h1 class="text-4xl font-bold leading-[1.1] text-themered"><?php echo get_field('titel'); ?></h1>
                    </div>
                    <p><?php echo get_field('introtekst'); ?></p>
                  </div>
                </div>
                <div class="relative row-start-1 col-span-full lg:col-start-7 lg:col-span-6">
                  <div class="h-[250px] lg:h-[374px]">
                    <div class="absolute bottom-0 left-0 z-50 hidden lg:block">
                      <svg class="fill-[#FFEDED] z-50" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg">
                        <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" fill="#FFEDED"/>
                      </svg>
                    </div>
                    <div class="absolute left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 top-1/2 -translate-y-1/2 h-full w-screen lg:w-[calc(100%+247px)]">
                      <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-center')); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="absolute bottom-0 z-50 hidden lg:block left-full">
                <svg class="fill-[#FFEDED] z-50 rotate-180" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg">
                  <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" fill="#FFEDED"/>
                </svg>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="w-full mx-auto container-xl">
          <section class="grid grid-cols-12 my-4 lg:my-14 lg:gap-x-5 xl:gap-x-10">
            <aside class="my-4 col-span-full lg:col-span-4 mb-7 lg:my-0">
              <?php if (is_active_sidebar('page-sidebar')) : ?>
                <?php dynamic_sidebar('page-sidebar'); ?>
              <?php endif; ?>
            </aside>
            <article <?php post_class( 'col-span-full lg:col-start-5 lg:col-span-full bg-white min-h-full' ); ?>>
        
              <?php if ( is_search() || is_archive() ) : ?>
        
                <?php if ( !is_front_page() ) : ?>
                  <header class="mb-4 entry-header fade">
                    <?php the_title( sprintf( '<h1 class="mb-1 font-extrabold leading-tight entry-title text-dark text-m3xl md:text-3xl"><span class="">', esc_url( get_permalink() ) ), '</span></h1>' ); ?>
                  </header>
                <?php endif; ?>
        
        
                <div class="entry-summary">
                  <?php the_excerpt(); ?>
                </div>
        
                <?php else : ?>
        
                <div class="entry-content">
                  <?php
                  /* translators: %s: Name of current post */
                  the_content(
                    sprintf(
                      __( 'Continue reading %s', 'tailpress' ),
                      the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    )
                  );
        
                  wp_link_pages(
                    array(
                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tailpress' ) . '</span>',
                      'after'       => '</div>',
                      'link_before' => '<span>',
                      'link_after'  => '</span>',
                      'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tailpress' ) . ' </span>%',
                      'separator'   => '<span class="screen-reader-text">, </span>',
                    )
                  );
                  ?>
                </div>
        
              <?php endif; ?>
            </article>
          </section>
        </div>
        <?php if ( get_field('toon_medewerkers')) : ?>
          <?php get_template_part( 'template-parts/medewerkers' ); ?>
        <?php endif; ?>

      </main>

		<?php endwhile; ?>

	<?php endif; ?>

<?php
get_footer();
