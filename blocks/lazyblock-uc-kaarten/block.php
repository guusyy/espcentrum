<?php $kaarten = is_array( $attributes['kaarten'] ) ? $attributes['kaarten'] : array(); ?>
<section class="py-12 lg:py-16">
  <div class="container-base">
    <?php if ( $attributes['titel'] ) : ?>
      <h2 class="mb-10 esp-titel"><?php echo esc_html( $attributes['titel'] ); ?></h2>
    <?php endif; ?>
    <?php if ( $kaarten ) : ?>
      <div class="grid grid-cols-1 gap-6 lg:gap-8 <?php echo count( $kaarten ) >= 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2'; ?>">
        <?php foreach ( $kaarten as $kaart ) : ?>
          <div class="p-8 lg:p-10 esp-kaart">
            <span class="block w-10 h-1 mb-6 rounded-full bg-brand-ochre" aria-hidden="true"></span>
            <?php if ( ! empty( $kaart['titel'] ) ) : ?>
              <h3 class="mb-3 text-2xl font-bold lg:text-3xl esp-balance"><?php echo esc_html( $kaart['titel'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $kaart['tekst'] ) ) : ?>
              <p class="text-lg leading-relaxed text-black"><?php echo nl2br( esc_html( $kaart['tekst'] ) ); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
