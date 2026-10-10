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
    <svg class="esp-op-vorm__clip" width="0" height="0">
      <clipPath id="esp-op-vorm-clip" clipPathUnits="objectBoundingBox">
        <path d="M0,0 H0.86 C0.97,0.08 1,0.24 0.93,0.38 C0.86,0.52 0.99,0.64 0.97,0.79 C0.95,0.93 0.82,1 0.66,1 H0 Z"/>
      </clipPath>
    </svg>
    <div class="esp-op-vorm__foto">
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
