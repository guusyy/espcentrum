<?php if ( $attributes['tekst'] ) : ?>
  <section class="py-12 lg:py-16">
    <div class="container-base">
      <figure class="esp-quote">
        <blockquote>
          <p class="esp-balance"><?php echo esc_html( $attributes['tekst'] ); ?></p>
        </blockquote>
        <?php if ( $attributes['bron'] ) : ?>
          <figcaption><?php echo esc_html( $attributes['bron'] ); ?></figcaption>
        <?php endif; ?>
      </figure>
    </div>
  </section>
<?php endif; ?>
