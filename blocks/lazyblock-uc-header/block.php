<?php
  $beeldmerk  = get_template_directory_uri() . '/assets/image/esp-beeldmerk-tijdelijk.jpg';
  $instagram  = $attributes['instagram'];
  $facebook   = $attributes['facebook'];
  $afbeelding = isset( $attributes['afbeelding']['id'] ) ? (int) $attributes['afbeelding']['id'] : 0;
?>
<section class="relative overflow-hidden text-brand-cream bg-brand-green">
  <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
    <path d="M-120 120 C 260 40, 620 260, 520 520 S 760 960, 1180 780" fill="none" stroke="#6D8677" stroke-width="120" stroke-linecap="round" opacity=".55"/>
    <path d="M1560 60 C 1240 120, 1120 380, 1300 640" fill="none" stroke="#6D8677" stroke-width="120" stroke-linecap="round" opacity=".55"/>
  </svg>

  <div class="relative pt-12 pb-28 lg:pt-20 lg:pb-40 container-base">
    <div class="grid items-center grid-cols-12 gap-10">
      <div class="col-span-full lg:col-span-7">
        <div class="flex items-center gap-3 mb-8 lg:hidden" aria-hidden="true">
          <img class="w-auto h-12" src="<?php echo esc_url( $beeldmerk ); ?>" alt="" width="84" height="60">
          <span class="flex flex-col leading-none">
            <span class="text-2xl font-bold text-white">ESP Centrum</span>
            <span class="text-lg text-brand-olive">samen vooruit</span>
          </span>
        </div>
        <?php if ( $attributes['label'] ) : ?>
          <span class="inline-block px-4 py-1 mb-6 font-semibold border rounded-full border-brand-olive text-brand-olive"><?php echo esc_html( $attributes['label'] ); ?></span>
        <?php endif; ?>
        <h1 class="mb-6 text-5xl font-bold lg:text-[4.5rem] lg:leading-[1.05] text-brand-sand"><?php echo esc_html( $attributes['titel'] ?: get_the_title() ); ?></h1>
        <?php if ( $attributes['intro'] ) : ?>
          <p class="max-w-2xl mb-8 text-lg text-white lg:text-xl"><?php echo nl2br( esc_html( $attributes['intro'] ) ); ?></p>
        <?php endif; ?>
        <div class="flex flex-wrap gap-3">
          <?php if ( $instagram ) : ?>
            <a class="inline-flex items-center gap-2 px-6 py-3 text-lg font-semibold transition rounded-full bg-brand-cream text-brand-green hover:bg-white" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">
              <?php echo esp_social_icon( 'instagram' ); ?> Instagram
            </a>
          <?php endif; ?>
          <?php if ( $facebook ) : ?>
            <a class="inline-flex items-center gap-2 px-6 py-3 text-lg font-semibold transition border-2 rounded-full border-brand-cream text-brand-cream hover:bg-brand-cream hover:text-brand-green" href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener">
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
              <path d="M0 120 L0 30 C 90 -10, 210 10, 290 50 C 340 75, 375 70, 400 60 L400 120 Z" fill="#A97426" opacity=".92"/>
            </svg>
            <span class="absolute text-3xl font-semibold bottom-6 left-8 text-brand-cream">samen vooruit</span>
          </div>
        <?php else : ?>
          <div class="flex flex-col items-start max-w-sm mx-auto text-left" aria-hidden="true">
            <img class="w-full max-w-xs" src="<?php echo esc_url( $beeldmerk ); ?>" alt="" width="320" height="230">
            <span class="mt-6 text-5xl font-bold leading-none text-white">ESP Centrum</span>
            <span class="mt-2 text-2xl leading-none text-brand-olive">samen vooruit</span>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <svg class="absolute bottom-0 left-0 w-full h-16 lg:h-28" viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0 120 L0 95 C 420 115, 620 20, 1000 18 C 1220 16, 1360 50, 1440 70 L1440 120 Z" fill="#F2EAD3"/>
  </svg>
</section>
