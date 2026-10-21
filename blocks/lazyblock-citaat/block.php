<?php
$citaat = preg_replace( '/^["“„\s]+|["”\s]+$/u', '', (string) $attributes['quote'] );
if ( '' === $citaat ) {
  return;
}
?>
<figure class="citaat-blok">
  <blockquote class="citaat">
    <p>“<?php echo esc_html( $citaat ); ?>”</p>
  </blockquote>
  <?php if ( $attributes['naam'] ) : ?>
    <figcaption><?php echo esc_html( $attributes['naam'] ); ?></figcaption>
  <?php endif; ?>
</figure>
