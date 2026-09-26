<?php if ( $attributes['tekst'] ) : ?>
  <section class="py-10 lg:py-14">
    <div class="container-base">
      <blockquote class="esp-quote">
        <p><?php echo esc_html( $attributes['tekst'] ); ?></p>
        <?php if ( $attributes['bron'] ) : ?>
          <cite><?php echo esc_html( $attributes['bron'] ); ?></cite>
        <?php endif; ?>
      </blockquote>
    </div>
  </section>
<?php endif; ?>
