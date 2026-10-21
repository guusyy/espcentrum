<?php

/**
 * WP-CLI ingang voor de Werken bij-migratie, zie functions/werken-bij-migratie.php.
 *
 *   wp eval-file wp-content/themes/espcentrum/scripts/migrate-werken-bij.php dry-run
 *   wp eval-file wp-content/themes/espcentrum/scripts/migrate-werken-bij.php
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
  exit;
}

$dry_run        = in_array( 'dry-run', $args, true );
$waarschuwingen = esp_werken_bij_migratie(
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

WP_CLI::success( $dry_run ? 'Dry-run klaar. Controleer de uitvoer en draai zonder "dry-run" om te migreren.' : 'Migratie klaar. Controleer /werken-bij/ en de homepage.' );
