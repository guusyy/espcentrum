<?php
/**
 * Opening "Vorm": foto in een grote organische vorm met het beeldmerk eroverheen, titel groot ernaast.
 * Geïnspireerd op de voorbeeldsite die Eva stuurde (beeld uitgesneden door een merkvorm).
 *
 * @var array $args ['attributes' => blokattributen, 'smal' => foto een derde in plaats van de helft,
 *                   'groen' => groen met één groot beeldmerk op de achtergrond, het label als pil op de foto
 *                              en alleen titel, intro en knoppen in de tekstkolom]
 */

$a          = $args['attributes'];
$afbeelding = isset( $a['afbeelding']['id'] ) ? (int) $a['afbeelding']['id'] : 0;
$groen      = ! empty( $args['groen'] );
?>
<section class="esp-op esp-op--vorm<?php echo empty( $args['smal'] ) ? '' : ' esp-op--smal'; ?><?php echo $groen ? ' esp-op--groen' : ''; ?>">
  <?php if ( $groen ) : ?>
    <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'esp-op-vorm__achtermerk', 'fill' => '#63806f' ) ); ?>
    <?php // Logo rechtsboven op het groen, zoals op de presentatiedia uit het huisstijlhandboek. ?>
    <?php get_template_part( 'template-parts/esp-logo', null, array( 'class' => 'esp-op-vorm__hoeklogo' ) ); ?>
  <?php endif; ?>
  <div class="esp-op-vorm__beeld" aria-hidden="true">
    <?php
    // Rechterrand van de foto: één strakke boog, of bij Vorm groen de rechterkant van het brein
    // uit het beeldmerk (vereenvoudigd en afgevlakt, zonder de terugkrul onderaan).
    $clip_id = wp_unique_id( 'esp-op-vorm-clip-' );
    if ( $groen ) {
      $rand = 'M0,0 L0.780,0.000 C0.790,0.012 0.820,0.048 0.839,0.071 C0.857,0.095 0.878,0.119 0.892,0.143 C0.906,0.167 0.916,0.190 0.923,0.214 C0.931,0.238 0.930,0.262 0.938,0.286 C0.946,0.310 0.964,0.333 0.971,0.357 C0.978,0.381 0.976,0.405 0.979,0.429 C0.981,0.452 0.985,0.476 0.986,0.500 C0.987,0.524 0.990,0.548 0.985,0.571 C0.981,0.595 0.965,0.619 0.960,0.643 C0.955,0.667 0.958,0.690 0.956,0.714 C0.953,0.738 0.952,0.762 0.943,0.786 C0.934,0.810 0.913,0.833 0.900,0.857 C0.887,0.881 0.879,0.905 0.862,0.929 C0.846,0.952 0.810,0.988 0.800,1.000 L0,1 Z';
    } else {
      $rand = 'M0,0 H0.8 C0.95,0.16 1,0.42 0.97,0.62 C0.94,0.82 0.86,0.95 0.74,1 H0 Z';
    }
    ?>
    <svg class="esp-op-vorm__clip" width="0" height="0">
      <clipPath id="<?php echo esc_attr( $clip_id ); ?>" clipPathUnits="objectBoundingBox">
        <path d="<?php echo esc_attr( $rand ); ?>"/>
      </clipPath>
    </svg>
    <div class="esp-op-vorm__foto" style="clip-path: url(#<?php echo esc_attr( $clip_id ); ?>)">
      <?php
      if ( $afbeelding ) {
        echo wp_get_attachment_image( $afbeelding, 'full', false, array( 'class' => 'esp-op-cover', 'loading' => 'eager', 'fetchpriority' => 'high', 'sizes' => empty( $args['smal'] ) ? '(min-width: 1024px) 55vw, 100vw' : '(min-width: 1024px) 36vw, 100vw' ) );
      }
      ?>
      <?php if ( $groen ) : ?>
        <?php // Zoals in de social posts: een okervlak onderin met het label. ?>
        <svg class="esp-op-vorm__vlak" viewBox="0 0 600 260" preserveAspectRatio="none" aria-hidden="true">
          <path d="M0 260 V70 C 120 10, 300 0, 420 60 C 500 100, 560 170, 600 260 Z" fill="#b17421"/>
        </svg>
        <?php if ( $a['label'] ) : ?>
          <span class="esp-op-vorm__vlaktekst"><?php echo esc_html( $a['label'] ); ?></span>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <?php if ( ! $groen ) : ?>
      <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'esp-op-vorm__merk', 'fill' => 'verloop' ) ); ?>
    <?php endif; ?>
  </div>

  <div class="esp-op-vorm__tekst">
    <?php get_template_part( 'template-parts/uc-opening-tekst', null, array( 'attributes' => $a, 'pil' => ! $groen, 'licht' => $groen, 'label' => ! $groen ) ); ?>
  </div>
</section>
