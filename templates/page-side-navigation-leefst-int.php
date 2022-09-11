<?php
/*
Template Name: Leefstijl interventies hoofdpagina
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
          <div class="bg-[#ECFFF1] overflow-hidden">
            <div class="relative w-full mx-auto container-base">
              <div class="grid grid-cols-12 lg:gap-x-10">
                <div class="lg:rows-start-1 col-span-full lg:col-start-1 lg:col-span-6">
                  <div class="h-full py-6 lg:py-10 xl:py-14">
                    <div class="flex items-center gap-5 mb-4 lg:mb-8">
                      <svg class="!w-[24px] !h-[22px] lg:!w-[46px] lg:!h-[43px]" width="50" height="47" viewBox="0 0 50 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.2286 46.0855L21.6367 42.8484C8.87944 31.3402 0.457153 23.7459 0.457153 14.4532C0.457153 6.85897 6.43945 0.914062 14.0814 0.914062C18.3917 0.914062 22.5285 2.90801 25.2286 6.04662C27.9287 2.90801 32.0655 0.914062 36.3757 0.914062C44.0177 0.914062 50 6.85897 50 14.4532C50 23.7459 41.5777 31.3402 28.8204 42.8484L25.2286 46.0855Z" fill="#01B132"/>
                      </svg>
                      <h1 class="text-4xl font-bold leading-[1.1] text-themegreen"><?php echo get_field('titel'); ?></h1>
                    </div>
                    <p><?php echo get_field('introtekst'); ?></p>
                  </div>
                </div>
                <div class="relative row-start-1 col-span-full lg:col-start-7 lg:col-span-6">
                  <div class="h-[250px] lg:h-[374px]">
                    <div class="absolute bottom-0 left-0 z-50 hidden h-full lg:block">
                      <svg class="fill-[#ECFFF1] z-50 h-full w-auto" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" fill="#ECFFF1"/>
                      </svg>
                    </div>
                    <div class="absolute left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 top-1/2 -translate-y-1/2 h-full w-screen lg:w-[calc(100%+260px)]">
                      <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-center')); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="absolute bottom-0 z-50 hidden h-full lg:block left-full">
                <svg class="fill-[#ECFFF1] z-50 rotate-180 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                  <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" fill="#ECFFF1"/>
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
