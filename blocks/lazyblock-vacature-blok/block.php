<?php
// Een blok zonder tekst (bijvoorbeeld een standaardkopje dat niet is ingevuld) niet tonen.
// Tekst staat in het blok; blokken van de eerste versie hebben nog de oude tekst (zie vacature-blokken.php).
$tekst = (string) $attributes['text'];
if ( '' === trim( wp_strip_all_tags( $tekst ) ) && ! empty( $attributes['tekst_oud'] ) ) {
  $tekst = wpautop( $attributes['tekst_oud'] );
}
if ( '' === trim( wp_strip_all_tags( $tekst ) ) ) {
  return;
}
$grijs = esp_vacature_blok_nummer() % 2;
?>
<section class="vacature-blok<?php echo $grijs ? ' vacature-blok--grijs' : ''; ?>">
  <?php if ( $attributes['title'] ) : ?>
    <h2><?php echo esc_html( $attributes['title'] ); ?></h2>
  <?php endif; ?>
  <?php echo $tekst; ?>
</section>
