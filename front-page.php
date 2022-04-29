<?php get_header(); ?>

  <main class="w-full">
    
    <?php
      if( get_option( 'page_on_front' ) ) {
        echo apply_filters( 'the_content', get_post( get_option( 'page_on_front' ) )->post_content );
      }
    ?>

    <section class="container mx-auto my-20">
      
    </section>
  </main>
<?php
get_footer(); ?>