<?php $vacatures = esp_get_open_vacatures( (int) $attributes['amount'] ); ?>
<section>
  <div class="py-16 container-base">
    <div class="grid items-center grid-cols-12 lg:gap-x-10">
      <div class="flex items-center gap-10 pb-3 mb-4 border-b-2 col-span-full border-primary">
        <h2 class="text-3xl font-bold"><?php echo esc_html( $attributes['title'] ); ?></h2>
        <?php if ( $attributes['button-label'] ) : ?>
          <a href="<?php echo esc_url( $attributes['button-url'] ); ?>" class="hidden btn btn--outline lg:inline-block"><?php echo esc_html( $attributes['button-label'] ); ?></a>
        <?php endif; ?>
      </div>
      <?php if ( $attributes['text'] ) : ?>
        <p class="mb-6 col-span-full lg:col-span-8"><?php echo esc_html( $attributes['text'] ); ?></p>
      <?php endif; ?>
      <?php if ( $vacatures->have_posts() ) : ?>
        <ul class="grid grid-cols-1 gap-5 col-span-full md:grid-cols-2 xl:grid-cols-3 lg:gap-10">
          <?php
            while ( $vacatures->have_posts() ) {
              $vacatures->the_post();
              get_template_part( 'template-parts/vacature-card' );
            }
            wp_reset_postdata();
          ?>
        </ul>
      <?php elseif ( esp_get_werken_bij_field( 'geen_vacatures_tekst' ) ) : ?>
        <p class="col-span-full"><?php echo esc_html( esp_get_werken_bij_field( 'geen_vacatures_tekst' ) ); ?></p>
      <?php endif; ?>
      <?php if ( $attributes['button-label'] ) : ?>
        <div class="my-8 lg:hidden col-span-full">
          <a href="<?php echo esc_url( $attributes['button-url'] ); ?>" class="btn btn--outline"><?php echo esc_html( $attributes['button-label'] ); ?></a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
