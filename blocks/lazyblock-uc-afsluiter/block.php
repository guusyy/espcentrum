<?php if ( $attributes['tekst'] ) : ?>
  <section class="relative overflow-hidden text-center bg-brand-green">
    <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 1440 400" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
      <path d="M-100 330 C 240 250, 420 400, 700 320 S 1180 140, 1560 240" fill="none" stroke="#6D8677" stroke-width="90" stroke-linecap="round" opacity=".5"/>
    </svg>
    <svg class="absolute left-0 block w-full h-10 -top-px lg:h-16" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
      <path d="M0 0 L1440 0 L1440 30 C 1080 80, 560 10, 0 60 Z" fill="#E1D9C5"/>
    </svg>
    <div class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 container-base">
      <img class="w-auto h-12 mx-auto mb-6 lg:h-14" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/esp-beeldmerk-tijdelijk.jpg' ); ?>" alt="" width="84" height="60">
      <p class="max-w-3xl mx-auto text-2xl font-semibold leading-snug lg:text-4xl text-brand-sand esp-balance"><?php echo esc_html( $attributes['tekst'] ); ?></p>
      <span class="block mt-4 text-lg text-brand-olive lg:text-xl">samen vooruit</span>
    </div>
  </section>
<?php endif; ?>
