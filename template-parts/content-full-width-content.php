<main class="flex-grow bg-white">
  <article <?php post_class( 'pb-16 bg-white min-h-full g' ); ?>>
      <?php if ( is_search() || is_archive() ) : ?>
        <?php if ( !is_front_page() ) : ?>
          <header class="mb-4 entry-header">
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
</main>