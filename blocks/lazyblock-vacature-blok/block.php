<?php
// Een blok zonder tekst (bijvoorbeeld een standaardkopje dat niet is ingevuld) niet tonen.
if ( '' === trim( wp_strip_all_tags( (string) $attributes['text'] ) ) ) {
  return;
}
$grijs = esp_vacature_blok_nummer() % 2;
?>
<section class="vacature-blok<?php echo $grijs ? ' vacature-blok--grijs' : ''; ?>">
  <?php if ( $attributes['title'] ) : ?>
    <h2><?php echo esc_html( $attributes['title'] ); ?></h2>
  <?php endif; ?>
  <?php echo $attributes['text']; ?>
</section>
