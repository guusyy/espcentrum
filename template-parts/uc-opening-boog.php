<?php
/**
 * Opening "Boog": foto over de hele breedte, de groene boog uit de huisstijl (visitekaartjes,
 * briefpapier) schuift eroverheen met de titel en het beeldmerk.
 *
 * @var array $args ['attributes' => blokattributen]
 */

$a          = $args['attributes'];
$afbeelding = isset( $a['afbeelding']['id'] ) ? (int) $a['afbeelding']['id'] : 0;
?>
<section class="esp-op esp-op--boog">
  <div class="esp-op-boog__foto" aria-hidden="true">
    <?php
    if ( $afbeelding ) {
      echo wp_get_attachment_image( $afbeelding, 'full', false, array( 'class' => 'esp-op-cover', 'loading' => 'eager', 'fetchpriority' => 'high', 'sizes' => '100vw' ) );
    }
    ?>
  </div>

  <svg class="esp-op-boog__vlak" viewBox="0 0 1440 620" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0 620 V250 C 260 140, 560 150, 820 250 C 900 280, 940 300, 980 290 C 1120 120, 1300 90, 1440 140 V620 Z" fill="#5a7666"/>
    <path d="M980 290 C 1120 120, 1300 90, 1440 140" fill="none" stroke="#b0b58e" stroke-width="3" opacity=".7"/>
  </svg>

  <div class="esp-op-boog__inhoud">
    <div class="esp-op-boog__tekst">
      <?php get_template_part( 'template-parts/uc-opening-tekst', null, array( 'attributes' => $a, 'licht' => true ) ); ?>
    </div>
    <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'esp-op-boog__merk', 'fill' => 'verloop' ) ); ?>
  </div>
</section>
