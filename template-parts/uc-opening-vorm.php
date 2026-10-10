<?php
/**
 * Opening "Vorm": foto in een grote organische vorm met het beeldmerk eroverheen, titel groot ernaast.
 * Geïnspireerd op de voorbeeldsite die Eva stuurde (beeld uitgesneden door een merkvorm).
 *
 * @var array $args ['attributes' => blokattributen, 'smal' => foto een derde in plaats van de helft,
 *                   'groen' => groene achtergrond met het logopatroon en het volledige logo, zoals de standaard header]
 */

$a          = $args['attributes'];
$afbeelding = isset( $a['afbeelding']['id'] ) ? (int) $a['afbeelding']['id'] : 0;
$groen      = ! empty( $args['groen'] );
?>
<section class="esp-op esp-op--vorm<?php echo empty( $args['smal'] ) ? '' : ' esp-op--smal'; ?><?php echo $groen ? ' esp-op--groen esp-patroon' : ''; ?>">
  <div class="esp-op-vorm__beeld" aria-hidden="true">
    <?php
    // Rechterrand van de foto: één strakke boog, of bij Vorm groen de rechterkant van het brein uit het beeldmerk.
    $clip_id = wp_unique_id( 'esp-op-vorm-clip-' );
    if ( $groen ) {
      $rand = 'M0,0 L0.720,0.000 C0.727,0.000 0.749,0.001 0.759,0.003 C0.769,0.005 0.772,0.007 0.780,0.011 C0.788,0.016 0.799,0.023 0.807,0.031 C0.815,0.039 0.822,0.048 0.829,0.059 C0.835,0.069 0.838,0.085 0.846,0.094 C0.854,0.104 0.868,0.106 0.878,0.116 C0.888,0.126 0.901,0.142 0.909,0.154 C0.916,0.166 0.918,0.174 0.922,0.185 C0.926,0.197 0.931,0.212 0.933,0.225 C0.934,0.238 0.934,0.253 0.933,0.264 C0.933,0.276 0.924,0.286 0.928,0.294 C0.932,0.302 0.949,0.304 0.956,0.311 C0.964,0.318 0.968,0.326 0.973,0.335 C0.977,0.345 0.981,0.358 0.983,0.367 C0.986,0.376 0.986,0.379 0.987,0.388 C0.988,0.396 0.989,0.407 0.987,0.418 C0.985,0.429 0.976,0.444 0.977,0.455 C0.977,0.466 0.987,0.476 0.990,0.485 C0.993,0.494 0.995,0.498 0.997,0.509 C0.998,0.521 1.001,0.541 1.000,0.555 C0.999,0.569 0.995,0.583 0.991,0.595 C0.987,0.607 0.983,0.616 0.977,0.625 C0.971,0.633 0.962,0.642 0.956,0.647 C0.951,0.653 0.941,0.650 0.941,0.655 C0.941,0.660 0.953,0.670 0.957,0.679 C0.961,0.688 0.964,0.697 0.965,0.707 C0.967,0.718 0.967,0.731 0.966,0.743 C0.965,0.756 0.962,0.771 0.959,0.782 C0.956,0.792 0.952,0.796 0.948,0.804 C0.943,0.812 0.939,0.820 0.930,0.829 C0.922,0.838 0.902,0.850 0.895,0.859 C0.889,0.867 0.895,0.869 0.893,0.877 C0.891,0.886 0.889,0.897 0.883,0.909 C0.878,0.921 0.867,0.939 0.859,0.950 C0.852,0.960 0.845,0.966 0.838,0.973 C0.830,0.979 0.822,0.984 0.814,0.989 C0.805,0.993 0.794,0.996 0.784,0.998 C0.775,1.000 0.767,1.001 0.756,1.000 C0.746,0.999 0.727,0.993 0.721,0.991 L0,1 Z';
      $lijn = 'M0.750,0.000 C0.757,0.000 0.779,0.001 0.789,0.003 C0.799,0.005 0.802,0.007 0.810,0.011 C0.818,0.016 0.829,0.023 0.837,0.031 C0.845,0.039 0.852,0.048 0.859,0.059 C0.865,0.069 0.868,0.085 0.876,0.094 C0.884,0.104 0.898,0.106 0.908,0.116 C0.918,0.126 0.931,0.142 0.939,0.154 C0.946,0.166 0.948,0.174 0.952,0.185 C0.956,0.197 0.961,0.212 0.963,0.225 C0.964,0.238 0.964,0.253 0.963,0.264 C0.963,0.276 0.954,0.286 0.958,0.294 C0.962,0.302 0.979,0.304 0.986,0.311 C0.994,0.318 0.998,0.326 1.003,0.335 C1.007,0.345 1.011,0.358 1.013,0.367 C1.016,0.376 1.016,0.379 1.017,0.388 C1.018,0.396 1.019,0.407 1.017,0.418 C1.015,0.429 1.006,0.444 1.007,0.455 C1.007,0.466 1.017,0.476 1.020,0.485 C1.023,0.494 1.025,0.498 1.027,0.509 C1.028,0.521 1.031,0.541 1.030,0.555 C1.029,0.569 1.025,0.583 1.021,0.595 C1.017,0.607 1.013,0.616 1.007,0.625 C1.001,0.633 0.992,0.642 0.986,0.647 C0.981,0.653 0.971,0.650 0.971,0.655 C0.971,0.660 0.983,0.670 0.987,0.679 C0.991,0.688 0.994,0.697 0.995,0.707 C0.997,0.718 0.997,0.731 0.996,0.743 C0.995,0.756 0.992,0.771 0.989,0.782 C0.986,0.792 0.982,0.796 0.978,0.804 C0.973,0.812 0.969,0.820 0.960,0.829 C0.952,0.838 0.932,0.850 0.925,0.859 C0.919,0.867 0.925,0.869 0.923,0.877 C0.921,0.886 0.919,0.897 0.913,0.909 C0.908,0.921 0.897,0.939 0.889,0.950 C0.882,0.960 0.875,0.966 0.868,0.973 C0.860,0.979 0.852,0.984 0.844,0.989 C0.835,0.993 0.824,0.996 0.814,0.998 C0.805,1.000 0.797,1.001 0.786,1.000 C0.776,0.999 0.757,0.993 0.751,0.991';
    } else {
      $rand = 'M0,0 H0.8 C0.95,0.16 1,0.42 0.97,0.62 C0.94,0.82 0.86,0.95 0.74,1 H0 Z';
      $lijn = 'M0.83,0 C0.98,0.16 1.03,0.42 1,0.62 C0.97,0.82 0.89,0.95 0.77,1';
    }
    ?>
    <svg class="esp-op-vorm__clip" width="0" height="0">
      <clipPath id="<?php echo esc_attr( $clip_id ); ?>" clipPathUnits="objectBoundingBox">
        <path d="<?php echo esc_attr( $rand ); ?>"/>
      </clipPath>
    </svg>
    <svg class="esp-op-vorm__lijn" viewBox="0 0 1 1" preserveAspectRatio="none">
      <path d="<?php echo esc_attr( $lijn ); ?>" fill="none" pathLength="1" vector-effect="non-scaling-stroke"/>
    </svg>
    <div class="esp-op-vorm__foto" style="clip-path: url(#<?php echo esc_attr( $clip_id ); ?>)">
      <?php
      if ( $afbeelding ) {
        echo wp_get_attachment_image( $afbeelding, 'full', false, array( 'class' => 'esp-op-cover', 'loading' => 'eager', 'fetchpriority' => 'high', 'sizes' => empty( $args['smal'] ) ? '(min-width: 1024px) 55vw, 100vw' : '(min-width: 1024px) 36vw, 100vw' ) );
      }
      ?>
    </div>
    <?php if ( ! $groen ) : ?>
      <?php get_template_part( 'template-parts/esp-beeldmerk', null, array( 'class' => 'esp-op-vorm__merk', 'fill' => 'verloop' ) ); ?>
    <?php endif; ?>
  </div>

  <div class="esp-op-vorm__tekst">
    <?php if ( $groen ) : ?>
      <?php get_template_part( 'template-parts/esp-logo', null, array( 'class' => 'esp-op-vorm__logo esp-op-vorm__logo--staand' ) ); ?>
      <?php get_template_part( 'template-parts/esp-logo', null, array( 'class' => 'esp-op-vorm__logo esp-op-vorm__logo--liggend', 'liggend' => true ) ); ?>
    <?php endif; ?>
    <?php get_template_part( 'template-parts/uc-opening-tekst', null, array( 'attributes' => $a, 'pil' => ! $groen, 'licht' => $groen ) ); ?>
  </div>
</section>
