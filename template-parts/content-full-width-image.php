<main class="flex-grow overflow-hidden bg-white">
  <article <?php post_class( 'pb-28 container-base bg-white min-h-full' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
      <div class="h-[200px] lg:h-[360px] md:h-96 relative">
        <div class="absolute bottom-0 z-50 hidden lg:block right-full">
          <svg class="z-50 h-full fill-white" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
              <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" />
          </svg>
        </div>
        <div class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 h-full w-screen lg:w-[calc(100%+calc(247px*2))] overflow-hidden">
          <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-top')); ?>
        </div>
        <div class="absolute bottom-0 z-50 hidden lg:block left-full">
          <svg class="z-50 h-full rotate-180 fill-white" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
              <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" />
          </svg>
        </div>
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
      </div>
    </div>
  </article>
</main>