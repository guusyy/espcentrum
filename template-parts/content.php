<main class="bg-white min-h-full flex-grow">

  <div class="my-20 container-xl mx-auto">
    <article <?php post_class( 'pb-28 bg-white min-h-full' ); ?>>
  
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="container mx-auto h-[380px] md:h-96 overflow-hidden">
          <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover object-top')); ?>
        </div>
      <?php endif; ?>
      
      <div class="container mx-auto">
        <header class="entry-header mb-4 fade">
          <?php the_title( sprintf( '<h2 class="entry-title text-black text-4xl font-bold mb-2"><span>', esc_url( get_permalink() ) ), '</span></h2>' ); ?>
        </header>
  
        <div class="entry-content appear">
          <?php
            /* translators: %s: Name of current post */
            the_content();
          ?>
        </div>
      </div>
      
    </article>
  </div>

</main>