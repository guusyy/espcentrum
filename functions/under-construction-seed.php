<?php

/**
 * Eenmalig vullen van de pagina Nieuwe huisstijl: social posts en de pagina met alle blokken.
 *
 * Te starten via Extra > Nieuwe huisstijl vullen in wp-admin (alleen beheerders), of met WP-CLI:
 *   wp eval-file wp-content/themes/espcentrum/scripts/seed-under-construction.php dry-run
 *
 * De pagina wordt als concept aangemaakt: zodra hij gepubliceerd is, verschijnt de sticker op de hele site.
 * Bestaande posts en een bestaande pagina Nieuwe huisstijl worden overgeslagen, nooit overschreven.
 * Verwijder dit bestand, de require in functions.php en scripts/under-construction-afbeeldingen na het vullen op productie.
 */

/**
 * Teksten per blok, in de volgorde waarin ze op de pagina staan.
 * Vervang deze door de definitieve teksten van Eva voor de deploy.
 */
function esp_under_construction_teksten() {
  return array(
    'uc-header'     => array(
      'label'     => 'Onze nieuwe website is in de maak',
      'titel'     => 'Nieuw gezicht, vertrouwde zorg!',
      'intro'     => 'Het ESP Centrum heeft een nieuwe uitstraling, en ook aan onze website wordt hard gewerkt. Hier geven we je alvast een voorproefje van ons nieuwe verhaal.',
      'instagram' => 'https://www.instagram.com/espcentrum/',
      'facebook'  => 'https://www.facebook.com/espcentrum/',
    ),
    'uc-kaarten'    => array(
      'titel'   => '',
      'kaarten' => array(
        array(
          'titel' => 'Wat verandert er voor jou?',
          'tekst' => 'Eigenlijk alleen ons jasje! De komende tijd vernieuwen we stap voor stap onze website, socials en de kleding van het team. Maar maak je geen zorgen: onze vertrouwde zorg, professionele begeleiding en bekende gezichten blijven precies zoals je van ons gewend bent.',
        ),
        array(
          'titel' => 'Waarom een nieuwe uitstraling?',
          'tekst' => 'Wij geloven dat gezondheid verder gaat dan alleen het verhelpen van klachten. Het gaat erom dat we samen met jou werken aan herstel en dat jij met plezier, vertrouwen én op jouw eigen manier de regie leert terugpakken over je lichaam en geest.',
        ),
      ),
    ),
    'uc-quote'      => array(
      'tekst' => 'Gezondheid is geen eenmalige sprint, maar een duurzame beweging die bij jou past.',
      'bron'  => '',
    ),
    'tijdlijn'      => array(
      'title' => 'Stap voor stap vooruit',
      'items' => array(
        array(
          'moment' => 'Juli 2026',
          'titel'  => 'Nieuwe uitstraling',
          'tekst'  => 'Van de wapperende vlaggen buiten tot het nieuwe logo in onze entreehal.',
          'status' => 'klaar',
        ),
        array(
          'moment' => 'Zomer 2026',
          'titel'  => 'Socials in de nieuwe huisstijl',
          'tekst'  => 'Op Instagram en Facebook delen we ons nieuwe merkverhaal al.',
          'status' => 'klaar',
        ),
        array(
          'moment' => 'Najaar 2026',
          'titel'  => 'Nieuwe website',
          'tekst'  => 'Achter de schermen bouwen we aan een nieuwe website in onze nieuwe huisstijl.',
          'status' => 'bezig',
        ),
        array(
          'moment' => 'Binnenkort',
          'titel'  => 'Nieuwe kleding voor het team',
          'tekst'  => 'Ook de kleding van het team krijgt het nieuwe jasje.',
          'status' => 'binnenkort',
        ),
      ),
    ),
    'uc-uitgelicht' => array(
      'titel'  => 'Uitgelicht',
      'tekst'  => 'Ons nieuwe verhaal delen we nu al op Instagram en Facebook.',
      'aantal' => 6,
    ),
    'uc-afsluiter'  => array(
      'tekst' => 'Kom gerust langs, proef de sfeer en ontdek hoe we samen vooruit blijven bewegen!',
    ),
  );
}

/**
 * Social posts, oudste eerst. Afbeeldingen staan in scripts/under-construction-afbeeldingen.
 */
function esp_under_construction_posts() {
  return array(
    array(
      'titel'      => 'Nieuw gezicht, vertrouwde zorg!',
      'datum'      => '2026-07-16 10:00:00',
      'afbeelding' => 'nieuwe-uitstraling.jpg',
      'link'       => 'https://www.instagram.com/espcentrum/',
      'tekst'      => 'Nieuw gezicht, vertrouwde zorg! ✨
Vanaf vandaag zie je het meteen zodra je bij ons binnenloopt: het ESP Centrum heeft een gloednieuwe uitstraling! Van de wapperende vlaggen buiten tot het nieuwe logo in onze entreehal.',
    ),
    array(
      'titel'      => 'Na je vakantie weer terug naar een gezonde routine?',
      'datum'      => '2026-08-24 10:00:00',
      'afbeelding' => 'gezonde-gewoonte.jpg',
      'link'       => 'https://www.instagram.com/espcentrum/',
      'tekst'      => 'Na je vakantie weer terug naar een gezonde routine? 🥗👟
Grote veranderingen beginnen vaak klein. Niet met een streng dieet of een complete reset, maar met gewoontes die je echt kunt volhouden.',
    ),
    array(
      'titel'      => 'Dagelijks 30 minuten bewegen',
      'datum'      => '2026-09-08 10:00:00',
      'afbeelding' => 'dagelijks-30-minuten.jpg',
      'link'       => 'https://www.facebook.com/photo?fbid=1718228100286176&set=a.478601980915467',
      'tekst'      => 'Wist je dat dagelijks 30 minuten matig intensief bewegen de kans op een beroerte met 20% tot 30% kan verlagen?
In beweging blijven is een van de belangrijkste manieren om hart- en vaatziekten te voorkomen en van beroertes te herstellen.',
    ),
    array(
      'titel'      => 'Ik moet gewoon even doorzetten',
      'datum'      => '2026-09-15 10:00:00',
      'afbeelding' => 'doorzetten.jpg',
      'link'       => 'https://www.facebook.com/photo?fbid=1726483246127328&set=a.478601980915467',
      'tekst'      => '‘Ik moet gewoon even doorzetten.’ Dat hopen veel mensen als ze merken dat hun energie opraakt. Je voelt dat je doorgaat, maar eigenlijk staat je lijf voortdurend in de overlevingsstand.',
    ),
    array(
      'titel'      => 'Bewegen is pas echt leuk als je ervaart wat het met je doet',
      'datum'      => '2026-09-23 10:00:00',
      'afbeelding' => 'duurzame-beweging.jpg',
      'link'       => 'https://www.facebook.com/photo?fbid=1732549205520732&set=a.478601980915467',
      'tekst'      => 'Bewegen is pas echt leuk als je ervaart wat het met je doet.
Vandaag is het #BEACTIVEDAY: de dag waarop heel Nederland in beweging komt.
Maar ‘gewoon meer bewegen’ omdat het moet? Dat houd je zelden vol.',
    ),
    array(
      'titel'      => 'Het zal wel stress zijn',
      'datum'      => '2026-09-25 10:00:00',
      'afbeelding' => 'nieuwe-uitstraling.jpg',
      'link'       => 'https://www.instagram.com/p/DbIJnwTs_Ie/',
      'tekst'      => '‘Het zal wel stress zijn…’

Nekpijn heeft invloed op hoe je beweegt. Stress op hoe je herstelt. Vermoeidheid op je energie en motivatie.

Daarom kijken we bij ESP Centrum niet alleen naar de klacht zelf, maar naar het totaalplaatje. Fysiotherapeuten, leefstijlcoaches en trainers stemmen regelmatig samen af om te kijken wat jóu helpt om vooruit te komen.',
    ),
  );
}

/**
 * Vul de site.
 *
 * @param bool     $dry_run Alleen tonen wat er zou gebeuren.
 * @param callable $log     Ontvangt ( $melding, $type ), type is 'log' of 'error'.
 *
 * @return array Waarschuwingen.
 */
function esp_under_construction_vullen( $dry_run, $log ) {
  $melding        = function ( $tekst ) use ( $dry_run, $log ) {
    $log( ( $dry_run ? '[dry-run] ' : '' ) . $tekst );
  };
  $waarschuwingen = array();

  if ( ! post_type_exists( 'social_post' ) || ! function_exists( 'update_field' ) || ! WP_Block_Type_Registry::get_instance()->is_registered( 'lazyblock/uc-header' ) ) {
    $log( 'Social posts, ACF of de huisstijlblokken ontbreken. Is het theme gedeployed en staat Lazy Blocks op versie 4 of hoger?', 'error' );
    return $waarschuwingen;
  }

  require_once ABSPATH . 'wp-admin/includes/file.php';
  require_once ABSPATH . 'wp-admin/includes/media.php';
  require_once ABSPATH . 'wp-admin/includes/image.php';

  $log( $dry_run ? '== Dry-run: er wordt niets aangepast ==' : '== Nieuwe huisstijl vullen ==' );

  /*
   * 1. Social posts, herkenbaar aan de link en titel zodat ze niet dubbel worden aangemaakt.
   */
  $log( "\n-- Social posts --" );
  $map         = get_template_directory() . '/scripts/under-construction-afbeeldingen/';
  $media_cache = array();

  foreach ( esp_under_construction_posts() as $post ) {
    $bestaat = get_posts( array(
      'post_type'      => 'social_post',
      'post_status'    => 'any',
      'title'          => $post['titel'],
      'posts_per_page' => 1,
      'fields'         => 'ids',
    ) );

    if ( $bestaat ) {
      $melding( "Bestaat al: {$post['titel']}" );
      continue;
    }

    $melding( "Aanmaken: {$post['titel']} ({$post['afbeelding']})" );

    if ( ! file_exists( $map . $post['afbeelding'] ) ) {
      $waarschuwingen[] = "Afbeelding {$post['afbeelding']} niet gevonden, post zonder afbeelding aangemaakt.";
    }

    if ( $dry_run ) {
      continue;
    }

    $id = wp_insert_post( array(
      'post_type'   => 'social_post',
      'post_status' => 'publish',
      'post_title'  => $post['titel'],
      'post_date'   => $post['datum'],
    ) );
    update_field( 'field_esp_social_post_link', $post['link'], $id );
    update_field( 'field_esp_social_post_tekst', $post['tekst'], $id );

    if ( file_exists( $map . $post['afbeelding'] ) ) {
      if ( ! isset( $media_cache[ $post['afbeelding'] ] ) ) {
        // Sideload verplaatst het bestand, dus eerst een tijdelijke kopie maken.
        $tmp = wp_tempnam( $post['afbeelding'] );
        copy( $map . $post['afbeelding'], $tmp );
        $media = media_handle_sideload( array( 'name' => $post['afbeelding'], 'tmp_name' => $tmp ), $id );
        if ( is_wp_error( $media ) ) {
          $waarschuwingen[] = "Afbeelding {$post['afbeelding']} uploaden mislukt: " . $media->get_error_message();
          @unlink( $tmp );
          continue;
        }
        $media_cache[ $post['afbeelding'] ] = $media;
      }
      set_post_thumbnail( $id, $media_cache[ $post['afbeelding'] ] );
    }
  }

  /*
   * 2. De pagina, als concept.
   */
  $log( "\n-- Pagina --" );
  $bestaande = get_pages( array(
    'meta_key'    => '_wp_page_template',
    'meta_value'  => 'templates/page-under-construction.php',
    'post_status' => array( 'publish', 'draft', 'pending', 'private' ),
    'number'      => 1,
  ) );

  if ( $bestaande ) {
    $melding( "Er bestaat al een pagina met het template Nieuwe huisstijl ({$bestaande[0]->post_title}), niet overschreven." );
  } else {
    $blokken = array();
    foreach ( esp_under_construction_teksten() as $naam => $attrs ) {
      // Herhalende velden (kaarten, tijdlijnstappen) slaat Lazy Blocks op als gecodeerde JSON.
      foreach ( $attrs as $sleutel => $waarde ) {
        if ( is_array( $waarde ) ) {
          $attrs[ $sleutel ] = rawurlencode( wp_json_encode( $waarde ) );
        }
      }
      $blokken[] = array( 'blockName' => 'lazyblock/' . $naam, 'attrs' => $attrs, 'innerBlocks' => array(), 'innerHTML' => '', 'innerContent' => array() );
    }

    $melding( 'Pagina "Nieuwe huisstijl" aanmaken als concept met ' . count( $blokken ) . ' blokken.' );

    if ( ! $dry_run ) {
      $inhoud = implode( "\n\n", array_map( 'serialize_block', $blokken ) );
      $id     = wp_insert_post( array(
        'post_type'    => 'page',
        'post_status'  => 'draft',
        'post_title'   => 'Nieuwe huisstijl',
        'post_name'    => 'nieuwe-huisstijl',
        'post_content' => wp_slash( $inhoud ),
      ) );
      update_post_meta( $id, '_wp_page_template', 'templates/page-under-construction.php' );
      $log( 'Bekijk en publiceer de pagina via: ' . admin_url( 'post.php?post=' . $id . '&action=edit' ) );
    }
  }

  return $waarschuwingen;
}

function esp_under_construction_vullen_menu() {
  add_management_page(
    'Nieuwe huisstijl vullen',
    'Nieuwe huisstijl vullen',
    'manage_options',
    'esp-under-construction-vullen',
    'esp_under_construction_vullen_pagina'
  );
}
add_action( 'admin_menu', 'esp_under_construction_vullen_menu' );

function esp_under_construction_vullen_pagina() {
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Geen toegang.' );
  }

  $uitvoer = array();
  $actie   = isset( $_POST['esp_uc_actie'] ) ? sanitize_key( $_POST['esp_uc_actie'] ) : '';

  if ( in_array( $actie, array( 'voorbeeld', 'uitvoeren' ), true ) ) {
    check_admin_referer( 'esp_under_construction_vullen' );

    $waarschuwingen = esp_under_construction_vullen(
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
    <h1>Nieuwe huisstijl vullen</h1>
    <p>Maakt de social posts aan en de pagina Nieuwe huisstijl met alle blokken. De pagina wordt als concept aangemaakt: publiceer hem als hij klaar is, dan verschijnt ook de sticker op de site.</p>
    <p>Bekijk eerst het voorbeeld. Bestaande posts en een bestaande pagina worden niet overschreven.</p>
    <form method="post">
      <?php wp_nonce_field( 'esp_under_construction_vullen' ); ?>
      <button class="button" name="esp_uc_actie" value="voorbeeld">Voorbeeld bekijken</button>
      <button class="button button-primary" name="esp_uc_actie" value="uitvoeren" onclick="return confirm('Nieuwe huisstijl vullen? Maak eerst een backup.');">Vullen</button>
    </form>
    <?php if ( $uitvoer ) : ?>
      <h2><?php echo 'voorbeeld' === $actie ? 'Voorbeeld: er is niets aangepast' : 'Klaar'; ?></h2>
      <pre style="background:#fff;border:1px solid #c3c4c7;padding:12px;white-space:pre-wrap;"><?php echo esc_html( implode( "\n", $uitvoer ) ); ?></pre>
    <?php endif; ?>
  </div>
  <?php
}
