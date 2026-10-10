<a class="fixed z-40 block w-24 h-24 overflow-hidden transition duration-300 rounded-full shadow-xl group bottom-4 right-4 lg:bottom-8 lg:right-8 lg:w-32 lg:h-32 bg-brand-green hover:scale-105 focus:outline-none focus-visible:ring-4 focus-visible:ring-brand-olive font-brand" href="<?php echo esc_url( $args['url'] ); ?>" aria-label="Bekijk onze nieuwe uitstraling">
  <svg class="absolute inset-0 w-full h-full motion-safe:animate-[spin_24s_linear_infinite] esp-sticker-ring" viewBox="0 0 100 100" aria-hidden="true">
    <defs>
      <path id="esp-sticker-cirkel" d="M50 50 m-38 0 a38 38 0 1 1 76 0 a38 38 0 1 1 -76 0"/>
    </defs>
    <text class="uppercase fill-brand-sand" font-size="9.4" font-weight="600" letter-spacing="1.6">
      <textPath href="#esp-sticker-cirkel" textLength="236">nieuwe uitstraling • samen vooruit •</textPath>
    </text>
  </svg>
  <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'absolute w-1/2 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2', 'fill' => 'verloop' ) ); ?>
</a>
