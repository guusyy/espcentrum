<main class="flex-grow bg-white">
  <article <?php post_class( 'pb-28 container-base bg-white min-h-full g' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
      <div class="h-[200px] lg:h-[360px] md:h-96 overflow-hidden -mx-8 md:-mx-6 lg:-mx-4">
        <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-top')); ?>
      </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-12 px-0 mx-auto container-xl lg:gap-x-10">
      <div class="pt-12 col-span-full lg:col-start-3 lg:col-span-8">
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
      </div>
    </div>
  </article>
</main>