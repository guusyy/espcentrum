
<?php get_header(); ?>
<main class="bg-slate-200 flex-grow">
  <article class="container-xl mx-auto bg-white">    
    <div class="md:flex min-h-screen">
      <div class="w-full flex items-center justify-center">
        <div class="max-w-sm m-8">
          <div class="text-5xl md:text-15xl text-gray-800 border-primary border-b">404</div>
          <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>
          <p class="text-gray-800 text-2xl md:text-3xl font-light mb-8"><?php _e( 'De pagina die je zoekt is niet gevonden.', 'tailpress' ); ?></p>
          <a href="<?php echo get_bloginfo( 'url' ); ?>" class="bg-primary px-4 py-2 rounded text-white">
            <?php _e( 'Terug naar home', 'tailpress' ); ?>
          </a>
        </div>
      </div>
    </div>
  </article>
</main>
<?php
get_footer();