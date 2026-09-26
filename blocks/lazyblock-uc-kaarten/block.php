<?php $kaarten = is_array( $attributes['kaarten'] ) ? $attributes['kaarten'] : array(); ?>
<section class="py-10 lg:py-14">
  <div class="container-base">
    <?php if ( $attributes['titel'] ) : ?>
      <h2 class="mb-8 text-4xl font-bold text-brand-ochre"><?php echo esc_html( $attributes['titel'] ); ?></h2>
    <?php endif; ?>
    <?php if ( $kaarten ) : ?>
      <div class="grid grid-cols-1 gap-6 lg:gap-8 <?php echo count( $kaarten ) >= 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2'; ?>">
        <?php foreach ( $kaarten as $kaart ) : ?>
          <div class="p-8 bg-white shadow-sm rounded-2xl">
            <?php if ( ! empty( $kaart['titel'] ) ) : ?>
              <h3 class="mb-3 text-2xl font-bold"><?php echo esc_html( $kaart['titel'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $kaart['tekst'] ) ) : ?>
              <p class="text-lg"><?php echo nl2br( esc_html( $kaart['tekst'] ) ); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
