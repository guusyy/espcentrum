<?php
/**
 * Opening "Groei": het beeldmerk bouwt zich op (de boom groeit omhoog, het brein vult zich vanuit het midden),
 * daarna komen titel en teamfoto in beeld. Zonder animatie (prefers-reduced-motion) staat alles meteen goed.
 *
 * @var array $args ['attributes' => blokattributen]
 */

$a          = $args['attributes'];
$afbeelding = isset( $a['afbeelding']['id'] ) ? (int) $a['afbeelding']['id'] : 0;
?>
<section class="esp-op esp-op--groei">
  <div class="esp-op-groei__grid">
    <div class="esp-op-groei__merkvak" aria-hidden="true">
      <div class="esp-op-groei__merk">
        <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'esp-op-groei__boom', 'fill' => 'verloop' ) ); ?>
        <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'esp-op-groei__brein', 'fill' => 'verloop' ) ); ?>
      </div>
      <span class="esp-op-groei__naam">ESP Centrum</span>
      <span class="esp-op-groei__payoff">samen vooruit</span>
    </div>

    <div class="esp-op-groei__tekst">
      <?php get_template_part( 'template-parts/uc-opening-tekst', null, array( 'attributes' => $a, 'pil' => true ) ); ?>
    </div>
  </div>

  <?php if ( $afbeelding ) : ?>
    <div class="esp-op-groei__foto" aria-hidden="true">
      <?php echo wp_get_attachment_image( $afbeelding, 'full', false, array( 'class' => 'esp-op-cover', 'loading' => 'eager', 'sizes' => '100vw' ) ); ?>
    </div>
  <?php endif; ?>

  <svg class="esp-op__golf" viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0 120 L0 95 C 420 115, 620 20, 1000 18 C 1220 16, 1360 50, 1440 70 L1440 120 Z" fill="#F2EAD3"/>
  </svg>
</section>
