<?php

/**
 * WP-CLI ingang voor het vullen van de pagina Nieuwe huisstijl, zie functions/under-construction-seed.php.
 *
 *   wp eval-file wp-content/themes/espcentrum/scripts/seed-under-construction.php dry-run
 *   wp eval-file wp-content/themes/espcentrum/scripts/seed-under-construction.php
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
  exit;
}

$dry_run        = in_array( 'dry-run', $args, true );
$waarschuwingen = esp_under_construction_vullen(
  $dry_run,
  function ( $tekst, $type = 'log' ) {
    if ( 'error' === $type ) {
      WP_CLI::error( $tekst );
    }
    WP_CLI::log( $tekst );
  }
);

WP_CLI::log( '' );
foreach ( $waarschuwingen as $waarschuwing ) {
  WP_CLI::warning( $waarschuwing );
}

WP_CLI::success( $dry_run ? 'Dry-run klaar. Draai zonder "dry-run" om te vullen.' : 'Klaar. De pagina staat als concept klaar om te publiceren.' );
