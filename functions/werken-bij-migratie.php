<?php

/**
 * Eenmalige migratie: vacatures naar het Vacature post type en de Werken bij-pagina inrichten.
 *
 * Te starten via Extra > Werken bij-migratie in wp-admin (alleen beheerders), of met WP-CLI:
 *   wp eval-file wp-content/themes/espcentrum/scripts/migrate-werken-bij.php dry-run
 *
 * De migratie leest de actuele staat van de site en kan veilig vaker gedraaid worden:
 * wat al gemigreerd is wordt overgeslagen. Bestaande teksten worden niet aangepast.
 * Verwijder dit bestand en de require in functions.php na de migratie op productie.
 */

/**
 * Voer de migratie uit.
 *
 * @param bool     $dry_run Alleen tonen wat er zou gebeuren.
 * @param callable $log     Ontvangt ( $melding, $type ), type is 'log' of 'error'.
 *
 * @return array Waarschuwingen.
 */
function esp_werken_bij_migratie( $dry_run, $log ) {
  $melding = function ( $tekst ) use ( $dry_run, $log ) {
    $log( ( $dry_run ? '[dry-run] ' : '' ) . $tekst );
  };

  /*
   * Teksten van Eva (mail van 7 oktober 2026).
   */
  $teksten = array(
    'intro'                   => 'Werken bij ESP Centrum betekent mensen begeleiden om weer met plezier en vertrouwen vooruit te kunnen bewegen. Ons team bestaat uit 30 therapeuten, fitnessinstructeurs en leefstijlcoaches. Samen combineren we vernieuwende vormen van bewegen en behandelen met gerichte programma’s voor revalidatie en verantwoord trainen. We geloven niet in standaardtrajecten, maar wel in samen positieve doelen stellen. Soms klein, soms uitdagend, maar altijd persoonlijk en met aandacht. Sluit jij je aan bij ons team?',
    'vacatures_titel'         => 'Openstaande vacatures',
    'geen_vacatures_tekst'    => 'Op dit moment hebben we geen openstaande vacatures. Een open sollicitatie is altijd welkom.',
    'open_sollicitatie_titel' => 'Staat jouw vacature er niet tussen?',
    'open_sollicitatie_tekst' => 'Staat jouw ideale vacature er niet tussen? Stuur jouw open sollicitatie, inclusief CV en motivatie, naar ons op. We maken graag kennis. Vertel ons wie je bent, wat je drijft en hoe je denkt een bijdrage te kunnen leveren. We ontdekken graag samen hoe we de beweging vooruit kunnen maken.',
    'sollicitatie_tekst'      => 'Klaar om samen de beweging vooruit te maken? Bel, app of mail ons vrijblijvend om kennis te maken. Kom je liever persoonlijk langs om de sfeer te proeven? Laat het ons weten, dan zetten we de koffie voor je klaar!',
    'homepage_blok_titel'     => 'Werken bij',
    'homepage_blok_tekst'     => 'Wil jij mensen met plezier én vertrouwen vooruit laten bewegen? Kom ons team versterken en maak samen met ons de beweging vooruit!',
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

  if ( ! post_type_exists( 'vacature' ) || ! function_exists( 'update_field' ) ) {
    $log( 'Het Vacature post type of ACF ontbreekt. Is het theme met de vacaturecode al gedeployed?', 'error' );
    return $waarschuwingen;
  }

  $log( $dry_run ? '== Dry-run: er wordt niets aangepast ==' : '== Migratie ==' );

  /*
   * 1. Vacatures omzetten.
   */
  $log( "\n-- Vacatures --" );

  foreach ( $vacatures as $id => $vacature ) {
    $post = get_post( $id );

    if ( ! $post || false === mb_stripos( $post->post_title, $vacature['titel'] ) ) {
      $waarschuwingen[] = "Vacature $id ({$vacature['titel']}) niet gevonden of titel gewijzigd, overgeslagen.";
      continue;
    }

    if ( 'vacature' === $post->post_type ) {
      $melding( "Al gemigreerd: {$post->post_title}" );
      continue;
    }

    $melding( "Omzetten: {$post->post_title} ({$post->post_status}) -> /werken-bij/{$vacature['slug']}/" );

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

    $melding( "Omzetten (nieuw sinds export): {$post->post_title} ({$post->post_status})" );
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
  $log( "\n-- Dubbele vacaturepagina's --" );

  foreach ( $dubbele_paginas as $id => $doel ) {
    $post = get_post( $id );

    if ( ! $post || 'page' !== $post->post_type || 0 !== mb_stripos( $post->post_title, 'Vacature' ) ) {
      $waarschuwingen[] = "Pagina $id is geen vacaturepagina (meer), overgeslagen.";
      continue;
    }

    if ( 'draft' === $post->post_status ) {
      $melding( "Al concept: {$post->post_title}" );
    } else {
      $melding( "Naar concept: {$post->post_title}" );
      if ( ! $dry_run ) {
        wp_update_post( array( 'ID' => $id, 'post_status' => 'draft' ) );
      }
    }

    foreach ( wp_get_nav_menus() as $menu ) {
      foreach ( (array) wp_get_nav_menu_items( $menu->term_id, array( 'post_status' => 'any' ) ) as $item ) {
        if ( 'page' === $item->object && (int) $item->object_id === $id ) {
          $melding( "Uit menu '{$menu->name}': {$item->title}" );
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
  $log( "\n-- Werken bij-pagina --" );

  $pagina = get_post( $werken_bij_id );

  if ( ! $pagina || 'page' !== $pagina->post_type ) {
    $waarschuwingen[] = "Werken bij-pagina $werken_bij_id niet gevonden, overgeslagen.";
  } else {
    if ( 'werken-bij' === $pagina->post_name && 'templates/page-werken-bij.php' === get_page_template_slug( $werken_bij_id ) ) {
      $melding( 'Slug en template staan al goed.' );
    } else {
      $melding( "Slug {$pagina->post_name} -> werken-bij, template -> Werken bij" );

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
        $melding( "Veld '$naam' heeft al een waarde, niet overschreven." );
        continue;
      }
      $melding( "Veld '$naam' invullen." );
      if ( ! $dry_run ) {
        update_field( $key, $teksten[ $naam ], $werken_bij_id );
      }
    }

    foreach ( $contact as $naam => $waarde ) {
      if ( get_field( $naam, $werken_bij_id ) ) {
        continue;
      }
      $melding( "Veld '$naam' invullen." );
      if ( ! $dry_run ) {
        update_field( 'field_esp_werken_bij_' . $naam, $waarde, $werken_bij_id );
      }
    }
  }

  /*
   * 4. Homepage: Vacatures-blok onder "Hier heb ik pijn", nieuwsblok terug naar Actueel.
   */
  $log( "\n-- Homepage --" );

  $homepage_id = (int) get_option( 'page_on_front' );
  $blocks      = parse_blocks( get_post_field( 'post_content', $homepage_id ) );
  $namen       = wp_list_pluck( $blocks, 'blockName' );
  $gewijzigd   = false;

  if ( in_array( 'lazyblock/vacatures', $namen, true ) ) {
    $melding( 'Vacatures-blok staat al op de homepage.' );
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

    $melding( 'Vacatures-blok toevoegen onder "Hier heb ik pijn".' );
    array_splice( $blocks, $positie + 1, 0, array( $scheiding, $vacature_blok ) );
    $gewijzigd = true;
  }

  foreach ( $blocks as &$block ) {
    if ( 'lazyblock/nieuwsblok' === $block['blockName'] && 'Werken bij' === ( $block['attrs']['title'] ?? '' ) ) {
      $melding( 'Nieuwsblok terug naar "Actueel" / "Bekijk al het nieuws".' );
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
  $log( "\n-- Redirects --" );

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
        $melding( "Redirect bestaat al: /$van" );
        continue;
      }
      $melding( "Redirect toevoegen: /$van -> ID $naar" );
      if ( ! $dry_run ) {
        $wpdb->insert( $tabel, array( 'url_from' => $van, 'url_to' => (string) $naar, 'status' => '301', 'type' => 'post', 'count' => 0 ) );
      }
    }
  }

  if ( ! $dry_run ) {
    flush_rewrite_rules();
  }

  return $waarschuwingen;
}

function esp_werken_bij_migratie_menu() {
  add_management_page(
    'Werken bij-migratie',
    'Werken bij-migratie',
    'manage_options',
    'esp-werken-bij-migratie',
    'esp_werken_bij_migratie_pagina'
  );
}
add_action( 'admin_menu', 'esp_werken_bij_migratie_menu' );

function esp_werken_bij_migratie_pagina() {
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Geen toegang.' );
  }

  $uitvoer = array();
  $actie   = isset( $_POST['esp_migratie_actie'] ) ? sanitize_key( $_POST['esp_migratie_actie'] ) : '';

  if ( in_array( $actie, array( 'voorbeeld', 'uitvoeren' ), true ) ) {
    check_admin_referer( 'esp_werken_bij_migratie' );

    $waarschuwingen = esp_werken_bij_migratie(
      'voorbeeld' === $actie,
      function ( $tekst, $type = 'log' ) use ( &$uitvoer ) {
        $uitvoer[] = ( 'error' === $type ? 'Fout: ' : '' ) . $tekst;
      }
    );

    foreach ( $waarschuwingen as $waarschuwing ) {
      $uitvoer[] = 'Let op: ' . $waarschuwing;
    }
  }
  ?>
  <div class="wrap">
    <h1>Werken bij-migratie</h1>
    <p>Zet de vacatures om naar het nieuwe Vacature-onderdeel, richt de Werken bij-pagina in, zet het Vacatures-blok op de homepage en voegt redirects toe voor de oude vacaturelinks.</p>
    <p>Bekijk eerst het voorbeeld. Bestaande teksten worden niet overschreven en je kunt de migratie veilig vaker uitvoeren.</p>
    <form method="post">
      <?php wp_nonce_field( 'esp_werken_bij_migratie' ); ?>
      <button class="button" name="esp_migratie_actie" value="voorbeeld">Voorbeeld bekijken</button>
      <button class="button button-primary" name="esp_migratie_actie" value="uitvoeren" onclick="return confirm('Migratie uitvoeren? Maak eerst een backup.');">Migratie uitvoeren</button>
    </form>
    <?php if ( $uitvoer ) : ?>
      <h2><?php echo 'voorbeeld' === $actie ? 'Voorbeeld: er is niets aangepast' : 'Migratie uitgevoerd'; ?></h2>
      <pre style="background:#fff;border:1px solid #c3c4c7;padding:12px;white-space:pre-wrap;"><?php echo esc_html( implode( "\n", $uitvoer ) ); ?></pre>
    <?php endif; ?>
  </div>
  <?php
}
