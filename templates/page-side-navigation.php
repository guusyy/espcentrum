<?php
/*
Template Name: Page with sidenavigation
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
          <div class="w-full mx-auto container-base">
            <div class="h-[200px] lg:h-[380px] md:h-96 overflow-hidden -mx-8 md:-mx-6 lg:-mx-4">
              <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-top')); ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="w-full mx-auto container-xl">
          <div class="grid grid-cols-12 my-4 lg:my-14 lg:gap-x-5 xl:gap-x-10">
            <aside class="col-span-full lg:col-span-4 my-4 mb-7 lg:my-0 lg:pt-[5.5rem]">
              <?php if (is_active_sidebar('page-sidebar')) : ?>
                <?php dynamic_sidebar('page-sidebar'); ?>
              <?php endif; ?>
            </aside>
            <article <?php post_class( 'col-span-full lg:col-start-5 lg:col-span-full bg-white min-h-full' ); ?>>
              <?php if ( !is_front_page() ) : ?>
                <header class="mb-4 entry-header fade">
                  <?php the_title( sprintf( '<h1 class="mb-1 font-extrabold leading-tight entry-title text-dark text-m3xl md:text-3xl"><span class="">', esc_url( get_permalink() ) ), '</span></h1>' ); ?>
                </header>
              <?php endif; ?>
        
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
        
                <div class="entry-content appear">
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
          </div>
        </div>

      </main>

		<?php endwhile; ?>

	<?php endif; ?>

<?php
get_footer();
