<main class="bg-white flex-grow">
  <article <?php post_class( 'pb-28 container-base bg-white min-h-full g' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
      <div class="h-[380px] md:h-96 overflow-hidden -mx-8 md:-mx-6 lg:-mx-4">
        <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-top')); ?>
      </div>
    <?php endif; ?>
    
    <div class="container-xl mx-auto grid grid-cols-12 gap-x-10">
      <div class="col-start-3 col-span-8 pt-12">
        <?php if ( !is_front_page() ) : ?>
          <header class="entry-header mb-4 fade">
            <?php the_title( sprintf( '<h1 class="entry-title text-dark text-m3xl md:text-3xl font-extrabold leading-tight mb-1"><span class="">', esc_url( get_permalink() ) ), '</span></h1>' ); ?>
          </header>
        <?php endif; ?>
        <?php if ( is_search() || is_archive() ) : ?>
          <?php if ( !is_front_page() ) : ?>
            <header class="entry-header mb-4 fade">
              <?php the_title( sprintf( '<h1 class="entry-title text-dark text-m3xl md:text-3xl font-extrabold leading-tight mb-1"><span class="">', esc_url( get_permalink() ) ), '</span></h1>' ); ?>
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