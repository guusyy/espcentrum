<?php
  $link     = get_field( 'link' );
  $platform = esp_social_platform( $link );
  $naam     = 'facebook' === $platform ? 'Facebook' : 'Instagram';

  // Afbeeldingen breder dan de Instagram-verhouding 4:5 (bijv. vierkant) passend tonen, zodat er geen tekst wegvalt.
  $meta     = wp_get_attachment_metadata( get_post_thumbnail_id() );
  $passend  = ! empty( $meta['width'] ) && ! empty( $meta['height'] ) && $meta['width'] / $meta['height'] > 0.85;
?>
<li>
  <a class="flex flex-col h-full overflow-hidden transition duration-300 group esp-kaart rounded-2xl sm:rounded-3xl hover:-translate-y-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-ochre" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( 'Bekijk op ' . $naam ); ?>">
    <div class="flex items-center justify-between px-3 py-2 sm:px-4 sm:py-3">
      <span class="flex items-center gap-2 text-xs font-semibold sm:text-base font-brand">
        <span class="flex items-center justify-center w-6 h-6 rounded-full sm:w-8 sm:h-8 bg-brand-green">
          <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'w-4 sm:w-5', 'fill' => 'verloop' ) ); ?>
        </span>
        <span class="hidden sm:inline">ESP Centrum</span>
      </span>
      <span class="text-brand-ochre"><?php echo esp_social_icon( $platform, 'w-5 h-5 sm:w-6 sm:h-6' ); ?></span>
    </div>
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="overflow-hidden aspect-[4/5] bg-brand-sand">
        <?php the_post_thumbnail( 'medium_large', array( 'class' => ( $passend ? 'object-contain' : 'object-cover' ) . ' w-full h-full transition duration-500 group-hover:scale-[1.03]' ) ); ?>
      </div>
    <?php endif; ?>
    <div class="flex flex-col flex-grow p-3 sm:p-4">
      <?php if ( get_field( 'tekst' ) ) : ?>
        <p class="flex-grow mb-3 text-xs leading-relaxed sm:text-small sm:leading-relaxed text-black line-clamp-2 sm:line-clamp-4 sm:mb-4"><?php echo esc_html( get_field( 'tekst' ) ); ?></p>
      <?php endif; ?>
      <span class="inline-flex items-center gap-1.5 text-xs font-semibold sm:text-base font-brand text-brand-ochre">
        Bekijk op <?php echo esc_html( $naam ); ?>
        <svg class="w-3.5 h-3.5 transition duration-300 sm:w-4 sm:h-4 group-hover:translate-x-1" viewBox="0 0 23 23" fill="currentColor" aria-hidden="true"><path d="M11.5 0L9.47 2.03l8.03 8.03H0v2.88h17.5l-8.03 8.03L11.5 23 23 11.5z"/></svg>
      </span>
    </div>
  </a>
</li>
