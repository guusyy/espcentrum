<?php
  $link     = get_field( 'link' );
  $platform = esp_social_platform( $link );
  $naam     = 'facebook' === $platform ? 'Facebook' : 'Instagram';
?>
<li>
  <a class="flex flex-col h-full overflow-hidden transition duration-300 bg-white shadow-sm group rounded-xl sm:rounded-2xl hover:-translate-y-1 hover:shadow-lg" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( 'Bekijk op ' . $naam ); ?>">
    <div class="flex items-center justify-between px-3 py-2 sm:px-4 sm:py-3">
      <span class="flex items-center gap-2 text-xs font-semibold sm:text-base">
        <img class="w-6 h-6 rounded-full sm:w-8 sm:h-8" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/esp-beeldmerk-tijdelijk.jpg' ); ?>" alt="" width="32" height="32">
        <span class="hidden sm:inline">ESP Centrum</span>
      </span>
      <span class="text-brand-ochre"><?php echo esp_social_icon( $platform, 'w-5 h-5 sm:w-6 sm:h-6' ); ?></span>
    </div>
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="overflow-hidden aspect-[4/3] bg-brand-sand">
        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'object-cover w-full h-full transition duration-500 group-hover:scale-[1.03]' ) ); ?>
      </div>
    <?php endif; ?>
    <div class="flex flex-col flex-grow p-3 sm:p-4">
      <?php if ( get_field( 'tekst' ) ) : ?>
        <p class="flex-grow mb-3 text-xs sm:text-small line-clamp-2 sm:line-clamp-4 sm:mb-4"><?php echo esc_html( get_field( 'tekst' ) ); ?></p>
      <?php endif; ?>
      <span class="text-xs font-semibold underline transition-all sm:text-base text-brand-ochre underline-offset-4 group-hover:underline-offset-2">
        Bekijk op <?php echo esc_html( $naam ); ?>
      </span>
    </div>
  </a>
</li>
