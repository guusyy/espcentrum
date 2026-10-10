<?php if ( $attributes['tekst'] ) : ?>
  <section class="relative overflow-hidden bg-brand-green esp-patroon">
    <svg class="absolute left-0 block w-full h-10 -top-px lg:h-16" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
      <path d="M0 0 L1440 0 L1440 30 C 1080 80, 560 10, 0 60 Z" fill="#E1D9C5"/>
    </svg>
    <div class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 container-base">
      <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'w-auto h-12 mb-6 lg:h-14', 'fill' => 'verloop' ) ); ?>
      <p class="max-w-5xl text-2xl font-semibold leading-[1.05] lg:text-5xl text-brand-sand esp-balance"><?php echo esc_html( $attributes['tekst'] ); ?></p>
      <span class="block mt-4 text-lg text-brand-olive lg:text-xl">samen vooruit</span>
      <?php if ( $attributes['knop_tekst'] && $attributes['knop_link'] ) : ?>
        <a class="inline-flex items-center gap-2 px-6 py-3 mt-8 text-lg font-semibold transition duration-300 rounded-full shadow-sm bg-brand-cream text-brand-green hover:bg-white hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-olive focus-visible:ring-offset-2 focus-visible:ring-offset-brand-green" href="<?php echo esc_url( $attributes['knop_link'] ); ?>">
          <?php echo esc_html( $attributes['knop_tekst'] ); ?>
          <svg class="w-4 h-4" viewBox="0 0 23 23" fill="currentColor" aria-hidden="true"><path d="M11.5 0L9.47 2.03l8.03 8.03H0v2.88h17.5l-8.03 8.03L11.5 23 23 11.5z"/></svg>
        </a>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
