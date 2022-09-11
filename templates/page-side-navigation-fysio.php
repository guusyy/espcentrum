<?php
/*
Template Name: Fysiotherapie hoofdpagina
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
          <div class="bg-[#FAF1FF] overflow-hidden">
            <div class="relative w-full mx-auto container-base">
              <div class="grid grid-cols-12 lg:gap-x-10">
                <div class="lg:rows-start-1 col-span-full lg:col-start-1 lg:col-span-6">
                  <div class="h-full py-6 lg:py-10 xl:py-14">
                    <div class="flex items-center gap-5 mb-4 lg:mb-8">
                      <svg class="!w-[15.7px] !h-[25px] lg:!w-[34px] lg:!h-[54px]" width="34" height="54" viewBox="0 0 34 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5611 10.0465C22.4055 10.0465 24.7327 7.78605 24.7327 5.02326C24.7327 2.26047 22.4055 0 19.5611 0C16.7167 0 14.3895 2.26047 14.3895 5.02326C14.3895 7.78605 16.7167 10.0465 19.5611 10.0465ZM9.86442 18.586L2.75351 54H8.18366L12.7088 33.907L18.2682 38.9302V54H23.4398V35.0372L18.1389 29.8884L19.6904 22.3535C23.0519 26.3721 28.0942 28.8837 33.7829 28.8837V23.8605C28.9992 23.8605 24.862 21.3488 22.5348 17.707L20.0783 13.6884C19.1732 12.1814 17.4925 11.3023 15.6824 11.3023C15.036 11.3023 14.3895 11.4279 13.7431 11.6791L0.167725 17.0791V28.8837H5.33929V20.4698L9.86442 18.586Z" fill="#8221B9"/>
                      </svg>
                      <h1 class="text-4xl font-bold leading-[1.1] text-themepurple"><?php echo get_field('titel'); ?></h1>
                    </div>
                    <p><?php echo get_field('introtekst'); ?></p>
                  </div>
                </div>
                <div class="relative row-start-1 col-span-full lg:col-start-7 lg:col-span-6">
                  <div class="h-[250px] lg:h-[374px]">
                    <div class="absolute bottom-0 left-0 z-50 hidden lg:block">
                      <svg class="fill-[#FAF1FF] z-50" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg">
                        <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" fill="#FAF1FF"/>
                      </svg>
                    </div>
                    <div class="absolute left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 top-1/2 -translate-y-1/2 h-full w-screen lg:w-[calc(100%+260px)]">
                      <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-center')); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="absolute bottom-0 z-50 hidden lg:block left-full h-full">
                <svg class="fill-[#FAF1FF] z-50 rotate-180" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg">
                  <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" fill="#FAF1FF"/>
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
