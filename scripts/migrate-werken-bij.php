<?php

/**
 * Eenmalige migratie: vacatures naar het Vacature post type en de Werken bij-pagina inrichten.
 *
 * Draai vanuit de WordPress-root:
 *   wp eval-file wp-content/themes/espcentrum/scripts/migrate-werken-bij.php dry-run
 *   wp eval-file wp-content/themes/espcentrum/scripts/migrate-werken-bij.php
 *
 * Het script leest de actuele staat van de site en kan veilig vaker gedraaid worden:
 * wat al gemigreerd is wordt overgeslagen. Bestaande teksten worden niet aangepast.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
  exit;
}

$dry_run = in_array( 'dry-run', $args, true );

/*
 * Teksten. Vervang de voorbeelden door de definitieve teksten van Eva voor de deploy.
 */
$teksten = array(
  'intro'                   => '[voorbeeld]Samen zorgen we ervoor dat mensen weer met vertrouwen vooruit bewegen. Met een team van 30 specialisten, korte lijnen en een flinke dosis werkplezier. Kom jij ons team versterken?[/voorbeeld]',
  'vacatures_titel'         => '[voorbeeld]Openstaande vacatures[/voorbeeld]',
  'geen_vacatures_tekst'    => '[voorbeeld]Op dit moment hebben we geen openstaande vacatures. Een open sollicitatie is altijd welkom.[/voorbeeld]',
  'open_sollicitatie_titel' => '[voorbeeld]Staat jouw vacature er niet tussen?[/voorbeeld]',
  'open_sollicitatie_tekst' => '[voorbeeld]Kom eens langs, proef de sfeer en ontdek hoe we samen vooruit bewegen. We maken graag kennis, ook als er nu geen passende vacature openstaat.[/voorbeeld]',
  'sollicitatie_tekst'      => '[voorbeeld]Enthousiast? Bellen, appen of mailen mag allemaal.[/voorbeeld]',
  'homepage_blok_titel'     => 'Werken bij',
  'homepage_blok_tekst'     => '[voorbeeld]Wil jij mensen met vertrouwen vooruit laten bewegen? Kom ons team van specialisten versterken.[/voorbeeld]',
  'homepage_blok_knop'      => 'Bekijk onze vacatures',
);

// Bekende vacatures: ID => verwachte titel (deel), nieuwe slug, uren.
$vacatures = array(
  2927 => array( 'titel' => 'Manueel therapeut', 'slug' => 'aankomend-manueel-therapeut', 'uren' => '28-40 uur' ),
  2949 => array( 'titel' => 'oncologiefysiotherapeut', 'slug' => 'oedeem-en-oncologiefysiotherapeut', 'uren' => '20-24 uur' ),
  2894 => array( 'titel' => 'Sportfysiotherapeut', 'slug' => 'sportfysiotherapeut', 'uren' => '28-40 uur' ),
  2925 => array( 'titel' => 'Diëtist', 'slug' => 'dietist', 'uren' => '24-32 uur' ),
);

// Dubbele vacaturepagina's die naar concept gaan, met de vacature waar ze naartoe verwijzen.
$dubbele_paginas = array(
  2885 => 2949,
  2978 => 2927,
  2973 => 2949,
);

$werken_bij_id  = 2845;
$waarschuwingen = array();

// Contactpersoon uit de sollicitatiezin van een vacature, zodat er geen persoonsgegevens in de repo staan.
$contact = array();
if ( preg_match(
  '/naar ([A-Z][\p{L}]+ [A-Z][\p{L}]+) via:? ([^\s,]+@espcentrum\.nl), ([0-9-]+)/u',
  wp_strip_all_tags( get_post_field( 'post_content', 2927 ) ),
  $match
) ) {
  $contact = array(
    'contact_naam'     => $match[1],
    'contact_email'    => $match[2],
    'contact_telefoon' => $match[3],
  );
} else {
  $waarschuwingen[] = 'Contactpersoon niet gevonden in de vacaturetekst, vul die in op de Werken bij-pagina.';
}

function esp_migratie_log( $melding, $dry_run ) {
  WP_CLI::log( ( $dry_run ? '[dry-run] ' : '' ) . $melding );
}

if ( ! post_type_exists( 'vacature' ) || ! function_exists( 'update_field' ) ) {
  WP_CLI::error( 'Het Vacature post type of ACF ontbreekt. Is het theme met de vacaturecode al gedeployed?' );
}

WP_CLI::log( $dry_run ? '== Dry-run: er wordt niets aangepast ==' : '== Migratie ==' );

/*
 * 1. Vacatures omzetten.
 */
WP_CLI::log( "\n-- Vacatures --" );

foreach ( $vacatures as $id => $vacature ) {
  $post = get_post( $id );

  if ( ! $post || false === mb_stripos( $post->post_title, $vacature['titel'] ) ) {
    $waarschuwingen[] = "Vacature $id ({$vacature['titel']}) niet gevonden of titel gewijzigd, overgeslagen.";
    continue;
  }

  if ( 'vacature' === $post->post_type ) {
    esp_migratie_log( "Al gemigreerd: {$post->post_title}", $dry_run );
    continue;
  }

  esp_migratie_log( "Omzetten: {$post->post_title} ({$post->post_status}) -> /werken-bij/{$vacature['slug']}/", $dry_run );

  if ( ! $dry_run ) {
    wp_update_post( array( 'ID' => $id, 'post_type' => 'vacature', 'post_name' => $vacature['slug'] ) );
    clean_post_cache( $id );
    update_field( 'field_esp_vacature_uren', $vacature['uren'], $id );
    update_field( 'field_esp_vacature_dienstverband', 'PART_TIME', $id );
  }
}

// Nieuwe vacatures die Eva sinds de export als nieuwsbericht heeft aangemaakt.
$onbekend = get_posts( array(
  'post_type'      => 'nieuws',
  'post_status'    => 'any',
  'posts_per_page' => -1,
  'post__not_in'   => array_keys( $vacatures ),
) );

foreach ( $onbekend as $post ) {
  if ( 0 !== mb_stripos( $post->post_title, 'Vacature' ) ) {
    continue;
  }

  esp_migratie_log( "Omzetten (nieuw sinds export): {$post->post_title} ({$post->post_status})", $dry_run );
  $waarschuwingen[] = "Vul uren en dienstverband in bij de nieuwe vacature: {$post->post_title} (ID {$post->ID}).";

  if ( ! $dry_run ) {
    wp_update_post( array(
      'ID'        => $post->ID,
      'post_type' => 'vacature',
      'post_name' => sanitize_title( preg_replace( '/^Vacature:\s*/i', '', $post->post_title ) ),
    ) );
  }
}

/*
 * 2. Dubbele vacaturepagina's naar concept en uit het menu.
 */
WP_CLI::log( "\n-- Dubbele vacaturepagina's --" );

foreach ( $dubbele_paginas as $id => $doel ) {
  $post = get_post( $id );

  if ( ! $post || 'page' !== $post->post_type || 0 !== mb_stripos( $post->post_title, 'Vacature' ) ) {
    $waarschuwingen[] = "Pagina $id is geen vacaturepagina (meer), overgeslagen.";
    continue;
  }

  if ( 'draft' === $post->post_status ) {
    esp_migratie_log( "Al concept: {$post->post_title}", $dry_run );
  } else {
    esp_migratie_log( "Naar concept: {$post->post_title}", $dry_run );
    if ( ! $dry_run ) {
      wp_update_post( array( 'ID' => $id, 'post_status' => 'draft' ) );
    }
  }

  foreach ( wp_get_nav_menus() as $menu ) {
    foreach ( (array) wp_get_nav_menu_items( $menu->term_id, array( 'post_status' => 'any' ) ) as $item ) {
      if ( 'page' === $item->object && (int) $item->object_id === $id ) {
        esp_migratie_log( "Uit menu '{$menu->name}': {$item->title}", $dry_run );
        if ( ! $dry_run ) {
          wp_delete_post( $item->ID, true );
        }
      }
    }
  }
}

/*
 * 3. Werken bij-pagina.
 */
WP_CLI::log( "\n-- Werken bij-pagina --" );

$pagina = get_post( $werken_bij_id );

if ( ! $pagina || 'page' !== $pagina->post_type ) {
  $waarschuwingen[] = "Werken bij-pagina $werken_bij_id niet gevonden, overgeslagen.";
} else {
  if ( 'werken-bij' === $pagina->post_name && 'templates/page-werken-bij.php' === get_page_template_slug( $werken_bij_id ) ) {
    esp_migratie_log( 'Slug en template staan al goed.', $dry_run );
  } else {
    esp_migratie_log( "Slug {$pagina->post_name} -> werken-bij, template -> Werken bij", $dry_run );

    if ( ! $dry_run ) {
      wp_update_post( array( 'ID' => $werken_bij_id, 'post_name' => 'werken-bij' ) );
      update_post_meta( $werken_bij_id, '_wp_page_template', 'templates/page-werken-bij.php' );
    }
  }

  $velden = array(
    'intro'                   => 'field_esp_werken_bij_intro',
    'vacatures_titel'         => 'field_esp_werken_bij_vacatures_titel',
    'geen_vacatures_tekst'    => 'field_esp_werken_bij_geen_vacatures',
    'open_sollicitatie_titel' => 'field_esp_werken_bij_open_titel',
    'open_sollicitatie_tekst' => 'field_esp_werken_bij_open_tekst',
    'sollicitatie_tekst'      => 'field_esp_werken_bij_sollicitatie_tekst',
  );

  foreach ( $velden as $naam => $key ) {
    if ( get_field( $naam, $werken_bij_id ) ) {
      esp_migratie_log( "Veld '$naam' heeft al een waarde, niet overschreven.", $dry_run );
      continue;
    }
    esp_migratie_log( "Veld '$naam' invullen.", $dry_run );
    if ( ! $dry_run ) {
      update_field( $key, $teksten[ $naam ], $werken_bij_id );
    }
  }

  foreach ( $contact as $naam => $waarde ) {
    if ( get_field( $naam, $werken_bij_id ) ) {
      continue;
    }
    esp_migratie_log( "Veld '$naam' invullen.", $dry_run );
    if ( ! $dry_run ) {
      update_field( 'field_esp_werken_bij_' . $naam, $waarde, $werken_bij_id );
    }
  }
}

/*
 * 4. Homepage: Vacatures-blok onder "Hier heb ik pijn", nieuwsblok terug naar Actueel.
 */
WP_CLI::log( "\n-- Homepage --" );

$homepage_id = (int) get_option( 'page_on_front' );
$blocks      = parse_blocks( get_post_field( 'post_content', $homepage_id ) );
$namen       = wp_list_pluck( $blocks, 'blockName' );
$gewijzigd   = false;

if ( in_array( 'lazyblock/vacatures', $namen, true ) ) {
  esp_migratie_log( 'Vacatures-blok staat al op de homepage.', $dry_run );
} else {
  $vacature_blok = array(
    'blockName'    => 'lazyblock/vacatures',
    'attrs'        => array(
      'title'        => $teksten['homepage_blok_titel'],
      'text'         => $teksten['homepage_blok_tekst'],
      'amount'       => 3,
      'button-label' => $teksten['homepage_blok_knop'],
      'button-url'   => '/werken-bij/',
    ),
    'innerBlocks'  => array(),
    'innerHTML'    => '',
    'innerContent' => array(),
  );
  $scheiding = array( 'blockName' => null, 'attrs' => array(), 'innerBlocks' => array(), 'innerHTML' => "\n\n", 'innerContent' => array( "\n\n" ) );

  $positie = array_search( 'lazyblock/hier-heb-ik-pijn', $namen, true );
  if ( false === $positie ) {
    $waarschuwingen[] = "Blok 'Hier heb ik pijn' niet gevonden op de homepage, Vacatures-blok onderaan gezet.";
    $positie = count( $blocks ) - 1;
  }

  esp_migratie_log( 'Vacatures-blok toevoegen onder "Hier heb ik pijn".', $dry_run );
  array_splice( $blocks, $positie + 1, 0, array( $scheiding, $vacature_blok ) );
  $gewijzigd = true;
}

foreach ( $blocks as &$block ) {
  if ( 'lazyblock/nieuwsblok' === $block['blockName'] && 'Werken bij' === ( $block['attrs']['title'] ?? '' ) ) {
    esp_migratie_log( 'Nieuwsblok terug naar "Actueel" / "Bekijk al het nieuws".', $dry_run );
    $block['attrs']['title']        = 'Actueel';
    $block['attrs']['button-label'] = 'Bekijk al het nieuws';
    $block['attrs']['button-url']   = '/actueel/';
    $gewijzigd                      = true;
  }
}
unset( $block );

if ( $gewijzigd && ! $dry_run ) {
  wp_update_post( array( 'ID' => $homepage_id, 'post_content' => wp_slash( serialize_blocks( $blocks ) ) ) );
}

/*
 * 5. Redirects in de 301 Redirects-plugin (type post, dus gekoppeld aan het ID).
 */
WP_CLI::log( "\n-- Redirects --" );

global $wpdb;
$tabel = $wpdb->prefix . 'redirects';

if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $tabel ) ) !== $tabel ) {
  $waarschuwingen[] = 'Tabel van de 301 Redirects-plugin niet gevonden, redirects niet toegevoegd.';
} else {
  $redirects = array(
    'werken-bij-2/'                                              => $werken_bij_id,
    'actueel/vacature-aankomend-manueel-therapeut-28-40-uur/'    => 2927,
    'actueel/vacature-oedeem-oncologiefysiotherapeut-20-24-uur/' => 2949,
    'vacature-aankomend-manueel-therapeut-28-40-uur/'            => 2927,
    'vacature-oedeem-en-oncologiefysiotherapeut-20-24-uur/'      => 2949,
    'vacature-oedeemfysiotherapie/'                              => 2949,
  );

  foreach ( $redirects as $van => $naar ) {
    if ( $wpdb->get_var( $wpdb->prepare( "SELECT id FROM $tabel WHERE url_from = %s", $van ) ) ) {
      esp_migratie_log( "Redirect bestaat al: /$van", $dry_run );
      continue;
    }
    esp_migratie_log( "Redirect toevoegen: /$van -> ID $naar", $dry_run );
    if ( ! $dry_run ) {
      $wpdb->insert( $tabel, array( 'url_from' => $van, 'url_to' => (string) $naar, 'status' => '301', 'type' => 'post', 'count' => 0 ) );
    }
  }
}

if ( ! $dry_run ) {
  flush_rewrite_rules();
}

WP_CLI::log( '' );
foreach ( $waarschuwingen as $waarschuwing ) {
  WP_CLI::warning( $waarschuwing );
}

WP_CLI::success( $dry_run ? 'Dry-run klaar. Controleer de uitvoer en draai zonder "dry-run" om te migreren.' : 'Migratie klaar. Controleer /werken-bij/ en de homepage.' );
