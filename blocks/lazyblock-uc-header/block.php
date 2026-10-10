<?php
  $instagram  = $attributes['instagram'];
  $facebook   = $attributes['facebook'];
  $afbeelding = isset( $attributes['afbeelding']['id'] ) ? (int) $attributes['afbeelding']['id'] : 0;
?>
<section class="relative overflow-hidden text-brand-cream bg-brand-green esp-patroon">

  <div class="relative pt-8 pb-20 lg:pt-24 lg:pb-44 container-base">
    <div class="grid items-center grid-cols-1 gap-10 lg:grid-cols-12">
      <div class="col-span-full lg:col-span-7">
        <div class="mb-6 lg:hidden" aria-hidden="true">
          <?php get_template_part( 'template-parts/esp-logo', null, array( 'class' => 'w-40 h-auto' ) ); ?>
        </div>
        <?php if ( $attributes['label'] ) : ?>
          <span class="inline-flex items-center gap-2 px-4 py-1.5 mb-4 lg:mb-6 text-xs font-bold tracking-wider uppercase font-brand rounded-full bg-white/10 text-brand-sand ring-1 ring-inset ring-white/20">
            <span class="w-2 h-2 rounded-full bg-brand-olive animate-pulse" aria-hidden="true"></span>
            <?php echo esc_html( $attributes['label'] ); ?>
          </span>
        <?php endif; ?>
        <h1 class="mb-4 lg:mb-6 text-5xl font-bold tracking-[-0.02em] esp-balance lg:text-[4.5rem] leading-[0.95] text-brand-sand"><?php echo esc_html( $attributes['titel'] ?: get_the_title() ); ?></h1>
        <?php if ( $attributes['intro'] ) : ?>
          <p class="max-w-xl mb-6 text-small leading-relaxed lg:mb-10 text-white/90 lg:text-base lg:leading-relaxed"><?php echo nl2br( esc_html( $attributes['intro'] ) ); ?></p>
        <?php endif; ?>
        <div class="grid grid-cols-2 gap-3 sm:flex sm:flex-wrap">
          <?php if ( $instagram ) : ?>
            <a class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-base font-bold font-brand transition duration-300 rounded-full shadow-sm sm:px-6 sm:py-3 sm:text-lg bg-brand-cream text-brand-green hover:bg-white hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-olive focus-visible:ring-offset-2 focus-visible:ring-offset-brand-green" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">
              <?php echo esp_social_icon( 'instagram' ); ?> Instagram
            </a>
          <?php endif; ?>
          <?php if ( $facebook ) : ?>
            <a class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-base font-bold font-brand transition duration-300 rounded-full sm:px-6 sm:py-3 sm:text-lg ring-2 ring-inset ring-brand-cream/60 text-brand-cream hover:bg-brand-cream hover:text-brand-green hover:ring-brand-cream hover:-translate-y-0.5 focus:outline-none focus-visible:ring-brand-olive" href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener">
              <?php echo esp_social_icon( 'facebook' ); ?> Facebook
            </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="hidden lg:block lg:col-span-5">
        <?php if ( $afbeelding ) : ?>
          <div class="relative overflow-hidden shadow-xl rounded-[2.5rem]">
            <?php echo wp_get_attachment_image( $afbeelding, 'large', false, array( 'class' => 'w-full aspect-[4/5] object-cover' ) ); ?>
            <svg class="absolute bottom-0 left-0 w-full h-1/4" viewBox="0 0 400 120" preserveAspectRatio="none" aria-hidden="true">
              <path d="M0 120 L0 30 C 90 -10, 210 10, 290 50 C 340 75, 375 70, 400 60 L400 120 Z" fill="#B17421" opacity=".92"/>
            </svg>
            <span class="absolute text-3xl font-bold bottom-6 left-8 font-brand text-brand-cream">samen vooruit</span>
          </div>
        <?php else : ?>
          <div class="max-w-sm mx-auto" aria-hidden="true">
            <?php get_template_part( 'template-parts/esp-logo', null, array( 'class' => 'w-full max-w-[360px]' ) ); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <svg class="absolute left-0 block w-full h-16 -bottom-px lg:h-28" viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0 120 L0 95 C 420 115, 620 20, 1000 18 C 1220 16, 1360 50, 1440 70 L1440 120 Z" fill="#F2EAD3"/>
  </svg>
</section>
