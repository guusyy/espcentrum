<?php
/**
 * Tekst van Huisstijl: Header: label, titel (woord voor woord voor de animatie), intro en social-knoppen.
 *
 * Args:
 *   attributes (array) Blokattributen van Huisstijl: Header.
 *   licht      (bool)  Lichte tekst op een donkere achtergrond.
 *   label      (bool)  Toon het label boven de titel (standaard ja).
 */

$a     = $args['attributes'];
$titel = $a['titel'] ?: get_the_title();
$licht = ! empty( $args['licht'] );
?>
<div class="esp-op-tekst<?php echo $licht ? ' esp-op-tekst--licht' : ''; ?>">
  <?php if ( $a['label'] && ( $args['label'] ?? true ) ) : ?>
    <span class="esp-op-label"><span class="esp-op-label__stip" aria-hidden="true"></span><?php echo esc_html( $a['label'] ); ?></span>
  <?php endif; ?>

  <h1 class="esp-op-titel" aria-label="<?php echo esc_attr( $titel ); ?>">
    <?php foreach ( preg_split( '/\s+/', trim( $titel ) ) as $i => $woord ) : ?>
      <span class="esp-op-woord" aria-hidden="true"><span style="--i:<?php echo (int) $i; ?>"><?php echo esc_html( $woord ); ?></span></span>
    <?php endforeach; ?>
  </h1>


  <?php if ( $a['intro'] ) : ?>
    <p class="esp-op-intro"><?php echo nl2br( esc_html( $a['intro'] ) ); ?></p>
  <?php endif; ?>

  <?php if ( $a['instagram'] || $a['facebook'] ) : ?>
    <div class="esp-op-knoppen">
      <?php if ( $a['instagram'] ) : ?>
        <a class="esp-op-knop esp-op-knop--vol" href="<?php echo esc_url( $a['instagram'] ); ?>" target="_blank" rel="noopener"><?php echo esp_social_icon( 'instagram' ); ?> Instagram</a>
      <?php endif; ?>
      <?php if ( $a['facebook'] ) : ?>
        <a class="esp-op-knop" href="<?php echo esc_url( $a['facebook'] ); ?>" target="_blank" rel="noopener"><?php echo esp_social_icon( 'facebook' ); ?> Facebook</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
