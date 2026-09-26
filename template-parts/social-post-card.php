<?php
  $link     = get_field( 'link' );
  $platform = esp_social_platform( $link );
  $naam     = 'facebook' === $platform ? 'Facebook' : 'Instagram';
?>
<li>
  <a class="flex flex-col h-full overflow-hidden transition duration-300 bg-white shadow-sm group rounded-2xl hover:-translate-y-1 hover:shadow-lg" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener">
    <div class="flex items-center justify-between px-4 py-3">
      <span class="flex items-center gap-2 font-semibold">
        <img class="w-8 h-8 rounded-full" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/esp-beeldmerk-tijdelijk.jpg' ); ?>" alt="" width="32" height="32">
        ESP Centrum
      </span>
      <span class="text-brand-ochre"><?php echo esp_social_icon( $platform ); ?></span>
    </div>
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="overflow-hidden aspect-square bg-brand-sand">
        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'object-cover w-full h-full transition duration-500 group-hover:scale-[1.03]' ) ); ?>
      </div>
    <?php endif; ?>
    <div class="flex flex-col flex-grow p-4">
      <?php if ( get_field( 'tekst' ) ) : ?>
        <p class="flex-grow mb-4 text-small line-clamp-4"><?php echo esc_html( get_field( 'tekst' ) ); ?></p>
      <?php endif; ?>
      <span class="font-semibold underline transition-all text-brand-ochre underline-offset-4 group-hover:underline-offset-2">
        Bekijk op <?php echo esc_html( $naam ); ?>
      </span>
    </div>
  </a>
</li>
