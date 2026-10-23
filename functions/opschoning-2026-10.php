<?php

/**
 * Eenmalige opschoning (okt 2026), draait vanzelf bij het eerste bezoek van een beheerder aan wp-admin:
 * - pagina Manuele therapie: slug 'maneuel-therapie-luuk' wordt 'manuele-therapie';
 * - leeg bericht 'Manuele therapie' uit 2022 naar de prullenbak;
 * - redirects van beide oude adressen naar de pagina, en de link op Specialisaties bijgewerkt.
 */

function esp_opschoning_2026_10() {
  if ( get_option( 'esp_opschoning_2026_10' ) || ! current_user_can( 'manage_options' ) ) {
    return;
  }
  update_option( 'esp_opschoning_2026_10', current_time( 'mysql' ), false );

  $pagina_id  = 530;
  $oude_url   = 'ons-aanbod/fysiotherapie/specialisaties/maneuel-therapie-luuk/';
  $pagina     = get_post( $pagina_id );

  if ( $pagina && 'page' === $pagina->post_type && 'maneuel-therapie-luuk' === $pagina->post_name ) {
    wp_update_post( array( 'ID' => $pagina_id, 'post_name' => 'manuele-therapie' ) );
  }

  $bericht = get_post( 527 );
  if ( $bericht && 'post' === $bericht->post_type && 'publish' === $bericht->post_status && '' === trim( $bericht->post_content ) ) {
    wp_trash_post( 527 );
  }

  // Specialisaties linkt rechtstreeks naar het oude adres.
  $specialisaties = get_post( 47 );
  if ( $specialisaties && false !== strpos( $specialisaties->post_content, 'maneuel-therapie-luuk' ) ) {
    wp_update_post( array(
      'ID'           => 47,
      'post_content' => wp_slash( str_replace( 'specialisaties/maneuel-therapie-luuk/', 'specialisaties/manuele-therapie/', $specialisaties->post_content ) ),
    ) );
  }

  // 301 Redirects-plugin, type post: volgt de pagina als het adres later weer verandert.
  global $wpdb;
  $tabel = $wpdb->prefix . 'redirects';
  if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $tabel ) ) === $tabel ) {
    foreach ( array( $oude_url, 'manuele-therapie/' ) as $van ) {
      if ( ! $wpdb->get_var( $wpdb->prepare( "SELECT id FROM $tabel WHERE url_from = %s", $van ) ) ) {
        $wpdb->insert( $tabel, array( 'url_from' => $van, 'url_to' => (string) $pagina_id, 'status' => '301', 'type' => 'post', 'count' => 0 ) );
      }
    }
  }
}
add_action( 'admin_init', 'esp_opschoning_2026_10' );
