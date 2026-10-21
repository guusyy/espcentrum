<?php
/**
 * Vacatureteksten in blokken, met om en om een witte en een grijze achtergrond.
 *
 * In de blokeditor bestaat een vacature uit een intro (gewone alinea), Vacatureblokken (kopje en
 * tekst) en hier en daar een Citaat. Een nieuwe vacature begint met de vaste blokken.
 *
 * Oudere vacatures zijn uit Word geplakt: de kopjes zijn daar vetgedrukte regels midden in een
 * alinea. De Werken bij-migratie zet die om naar blokken (esp_vacature_naar_blokken); vacatures
 * die nog niet zijn omgezet worden bij het tonen op dezelfde manier opgedeeld (esp_vacature_blokken).
 */

// Langere vetgedrukte regels zijn een benadrukte zin, geen kopje.
const ESP_VACATURE_KOP_MAX_LENGTE = 80;

/**
 * Blokken waarmee een nieuwe vacature begint. Lege blokken worden niet getoond, dus wat Eva niet
 * nodig heeft mag ze leeg laten of weghalen.
 */
function esp_vacature_template() {
  $blok = function ( $kopje, $tekst = '' ) {
    $alinea = $tekst ? array( 'content' => $tekst ) : array( 'placeholder' => 'Typ of plak hier de tekst. Een lijstje maak je met een streepje (-) en een spatie.' );
    return array( 'lazyblock/vacature-blok', array( 'title' => $kopje ), array( array( 'core/paragraph', $alinea ) ) );
  };

  return array(
    array( 'core/paragraph', array(
      'className'   => 'vacature-intro',
      'placeholder' => 'Intro: wie zoeken jullie, en waarom is dit een mooie plek om te werken?',
    ) ),
    $blok( 'Wat ons bijzonder maakt', 'Gezondheid gaat verder dan klachten verhelpen. Bij ESP Centrum combineren we daarom zorg en preventie met vernieuwende manieren van bewegen en behandelen, voor alle leeftijden en doelgroepen. Denk aan fysiotherapie, leefstijlcoaching en specifieke programma’s zoals revalidatie of verantwoord trainen. Geen standaardtraject, maar samen met collega’s positieve doelen stellen die bij onze cliënten passen: soms klein, soms uitdagend. Altijd persoonlijk en met aandacht.' ),
    $blok( 'Wat jou bijzonder maakt' ),
    $blok( 'Hoe ziet jouw werkdag eruit?' ),
    array( 'lazyblock/citaat', array() ),
    $blok( 'Wat breng je mee?' ),
    $blok( 'Wat bieden we?' ),
    $blok( 'Het team' ),
    $blok( 'Enthousiast?' ),
  );
}

/**
 * Vacatureblok en Citaat, in code zodat ze met het theme mee naar productie gaan.
 * Templates in blocks/lazyblock-vacature-blok/ en blocks/lazyblock-citaat/.
 */
function esp_register_vacature_blokken() {
  if ( ! function_exists( 'lazyblocks' ) ) {
    return;
  }

  $control = function ( $type, $name, $label, $extra = array() ) {
    return array_merge( array(
      'type' => $type, 'name' => $name, 'default' => '', 'label' => $label,
      'help' => '', 'child_of' => '', 'placement' => 'content', 'width' => '100',
      'hide_if_not_selected' => 'false', 'save_in_meta' => 'false', 'save_in_meta_name' => '',
      'required' => 'false', 'placeholder' => '', 'characters_limit' => '',
    ), $extra );
  };
  $blok = function ( $id, $title, $icon, $description, $controls, $post_types ) {
    lazyblocks()->add_block( array(
      'id'          => $id,
      'title'       => $title,
      'icon'        => 'dashicons dashicons-' . $icon,
      'keywords'    => array( 'vacature', 'werken bij' ),
      'slug'        => 'lazyblock/' . $id,
      'description' => $description,
      'category'    => 'text',
      'supports'    => array(
        'customClassName' => false,
        'anchor'          => false,
        'align'           => array(),
        'html'            => false,
        'multiple'        => true,
        'inserter'        => true,
      ),
      'controls'    => $controls,
      'code'        => array(
        'output_method' => 'template',
        'show_preview'  => 'never',
        'single_output' => false,
      ),
      'condition'   => $post_types,
    ) );
  };

  $blok( 'vacature-blok', 'Vacatureblok', 'text-page', 'Kopje met tekst. De achtergrond wisselt vanzelf tussen wit en grijs.', array(
    'control_esp_vacblok_title' => $control( 'text', 'title', 'Kopje' ),
    'control_esp_vacblok_text'  => $control( 'inner_blocks', 'text', 'Tekst', array(
      'help' => 'Een blok zonder tekst wordt niet getoond.',
    ) ),
  ), array( 'vacature' ) );

  // Citaat is ook op gewone pagina's te gebruiken.
  $blok( 'citaat', 'Citaat', 'format-quote', 'Een uitspraak van bijvoorbeeld een collega of cliënt, met naam eronder.', array(
    'control_esp_vaccitaat_quote' => $control( 'textarea', 'quote', 'Citaat', array(
      'help' => 'Zonder aanhalingstekens, die komen er vanzelf omheen. Leeg laten = niet tonen.',
    ) ),
    'control_esp_vaccitaat_naam'  => $control( 'text', 'naam', 'Naam', array(
      'placeholder' => 'Bijvoorbeeld: Martijn, fysiotherapeut',
    ) ),
  ), array() );
}
// Voor Lazy Blocks' eigen registratie op init prioriteit 20.
add_action( 'init', 'esp_register_vacature_blokken', 10 );

/**
 * In een vacature alleen de blokken die daar horen, zodat bijvoorbeeld "Hier heb ik pijn" niet in
 * de lijst staat. Andersom staan de vacatureblokken alleen bij vacatures (condition hierboven).
 *
 * @param bool|string[]           $toegestaan Toegestane blokken.
 * @param WP_Block_Editor_Context $context    Editor.
 */
function esp_vacature_toegestane_blokken( $toegestaan, $context ) {
  if ( empty( $context->post ) || 'vacature' !== $context->post->post_type ) {
    return $toegestaan;
  }

  return array(
    'lazyblock/vacature-blok',
    'lazyblock/citaat',
    'core/paragraph',
    'core/list',
    'core/list-item',
  );
}
add_filter( 'allowed_block_types_all', 'esp_vacature_toegestane_blokken', 10, 2 );

/**
 * Volgnummer van het volgende Vacatureblok op de pagina, voor de wisseling wit/grijs.
 *
 * @param bool $opnieuw Begin weer bij 0, aan het begin van elke the_content.
 */
function esp_vacature_blok_nummer( $opnieuw = false ) {
  static $nummer = 0;
  if ( $opnieuw ) {
    $nummer = 0;
    return 0;
  }
  return $nummer++;
}
add_filter( 'the_content', function ( $content ) {
  esp_vacature_blok_nummer( true );
  return $content;
}, 1 );

/**
 * Deel de HTML van een vacature op in kopjes en losse blokken (alinea's, lijsten, citaten).
 *
 * @param string $html HTML, na wpautop.
 * @return array|null Items: array( 'kop', tekst ) of array( 'blok', DOMElement ); null als er geen kopjes zijn.
 */
function esp_vacature_items( $html ) {
  if ( ! class_exists( 'DOMDocument' ) || '' === trim( $html ) ) {
    return null;
  }

  $doc = new DOMDocument();
  libxml_use_internal_errors( true );
  $doc->loadHTML( '<?xml encoding="utf-8"?><div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
  libxml_clear_errors();
  $root = $doc->getElementsByTagName( 'div' )->item( 0 );
  if ( ! $root ) {
    return null;
  }

  esp_vacature_vet_opschonen( $doc );

  $items  = array();
  $inline = array();
  foreach ( iterator_to_array( $root->childNodes ) as $node ) {
    if ( XML_COMMENT_NODE === $node->nodeType ) {
      continue;
    }
    if ( esp_vacature_is_inline( $node ) ) {
      $inline[] = $node;
      continue;
    }
    if ( $inline ) {
      $items  = array_merge( $items, esp_vacature_regels( $doc, $inline ) );
      $inline = array();
    }
    $tag = strtolower( $node->nodeName );
    if ( 'p' === $tag ) {
      $items = array_merge( $items, esp_vacature_regels( $doc, iterator_to_array( $node->childNodes ) ) );
    } elseif ( 'h2' === $tag ) {
      $items[] = array( 'kop', trim( $node->textContent ) );
    } else {
      $items[] = array( 'blok', $node );
    }
  }
  if ( $inline ) {
    $items = array_merge( $items, esp_vacature_regels( $doc, $inline ) );
  }

  return in_array( 'kop', array_column( $items, 0 ), true ) ? $items : null;
}

/**
 * Toon een vacature die nog niet in blokken staat toch in blokken.
 *
 * @param string $content Inhoud van de vacature, na wpautop.
 */
function esp_vacature_blokken( $content ) {
  if ( ! is_singular( 'vacature' ) || has_block( 'lazyblock/vacature-blok', get_the_ID() ) ) {
    return $content;
  }

  $items = esp_vacature_items( $content );
  if ( ! $items ) {
    return $content;
  }

  // Alles voor het eerste kopje is de intro, daarna een blok per kopje.
  $uit     = new DOMDocument( '1.0', 'UTF-8' );
  $intro   = null;
  $blok    = null;
  $nummer  = 0;
  $wrapper = $uit->createElement( 'div' );
  $uit->appendChild( $wrapper );

  foreach ( $items as $item ) {
    if ( 'kop' === $item[0] ) {
      $blok = $uit->createElement( 'section' );
      $blok->setAttribute( 'class', 'vacature-blok' . ( $nummer++ % 2 ? ' vacature-blok--grijs' : '' ) );
      $kop = $uit->createElement( 'h2' );
      $kop->appendChild( $uit->createTextNode( $item[1] ) );
      $blok->appendChild( $kop );
      $wrapper->appendChild( $blok );
      continue;
    }

    $doel = $blok;
    if ( ! $doel ) {
      if ( ! $intro ) {
        $intro = $uit->createElement( 'div' );
        $intro->setAttribute( 'class', 'vacature-intro' );
        $wrapper->appendChild( $intro );
      }
      $doel = $intro;
    }
    $doel->appendChild( $uit->importNode( $item[1], true ) );
  }

  $html = '';
  foreach ( $wrapper->childNodes as $node ) {
    $html .= $uit->saveHTML( $node );
  }

  return $html;
}
add_filter( 'the_content', 'esp_vacature_blokken', 25 );

/**
 * Zet de tekst van een oude vacature om naar blokken: de intro als alinea, een Vacatureblok per
 * kopje en een Citaat voor elk citaat (direct na het blok waarin het stond).
 *
 * @param string $post_content Inhoud uit de database.
 * @return array|null Array( 'content' => blokken, 'blokken' => aantal, 'citaten' => aantal ), of null
 *                    als de vacature al in blokken staat of geen kopjes heeft.
 */
function esp_vacature_naar_blokken( $post_content ) {
  if ( has_block( 'lazyblock/vacature-blok', $post_content ) ) {
    return null;
  }

  $items = esp_vacature_items( has_blocks( $post_content ) ? do_blocks( $post_content ) : wpautop( $post_content ) );
  if ( ! $items ) {
    return null;
  }

  $blokken = array();
  $huidig  = null;
  $citaten = array();
  $aantal  = array( 'blokken' => 0, 'citaten' => 0 );

  $sluit = function () use ( &$huidig, &$citaten, &$blokken, &$aantal ) {
    if ( $huidig ) {
      $blokken[] = esp_vacature_lazyblock( 'vacature-blok', array( 'title' => $huidig['title'] ), $huidig['binnen'] );
      $aantal['blokken']++;
    }
    foreach ( $citaten as $citaat ) {
      $blokken[] = esp_vacature_lazyblock( 'citaat', $citaat );
      $aantal['citaten']++;
    }
    $huidig  = null;
    $citaten = array();
  };

  foreach ( $items as $item ) {
    if ( 'kop' === $item[0] ) {
      $sluit();
      $huidig = array( 'title' => $item[1], 'binnen' => array() );
      continue;
    }

    $node   = $item[1];
    $citaat = esp_vacature_als_citaat( $node );
    if ( $citaat ) {
      $citaten[] = $citaat;
      continue;
    }

    if ( $huidig ) {
      $blok = esp_vacature_als_blok( $node );
      if ( $blok ) {
        $huidig['binnen'][] = $blok;
      }
      continue;
    }

    $tekst = preg_replace( '/\s+/u', ' ', esp_vacature_tekst( $node->textContent ) );
    if ( '' !== $tekst ) {
      $blokken[] = esp_vacature_core_blok( 'paragraph', '<p class="vacature-intro">' . esc_html( $tekst ) . '</p>', array( 'className' => 'vacature-intro' ) );
    }
  }
  $sluit();

  return array( 'content' => serialize_blocks( $blokken ) ) + $aantal;
}

/**
 * @param string $naam   Naam van het Lazy Block zonder "lazyblock/".
 * @param array  $attrs  Waarden van de velden.
 * @param array  $binnen Binnenblokken (het veld Tekst van het Vacatureblok).
 */
function esp_vacature_lazyblock( $naam, array $attrs, array $binnen = array() ) {
  $id = substr( md5( uniqid( $naam, true ) ), 0, 8 );

  return array(
    'blockName'    => 'lazyblock/' . $naam,
    'attrs'        => $attrs + array( 'blockId' => $id, 'blockUniqueClass' => 'lazyblock-' . $naam . '-' . $id ),
    'innerBlocks'  => $binnen,
    'innerHTML'    => '',
    'innerContent' => array_fill( 0, count( $binnen ), null ),
  );
}

/**
 * Een core-blok, met de binnenblokken (zoals de punten van een lijst) tussen $voor en $na.
 */
function esp_vacature_core_blok( $naam, $voor, array $attrs = array(), array $binnen = array(), $na = '' ) {
  return array(
    'blockName'    => 'core/' . $naam,
    'attrs'        => $attrs,
    'innerBlocks'  => $binnen,
    'innerHTML'    => $voor . $na,
    'innerContent' => $binnen ? array_merge( array( $voor ), array_fill( 0, count( $binnen ), null ), array( $na ) ) : array( $voor . $na ),
  );
}

/**
 * Zet een alinea, lijst of kopje uit een oude vacature om naar een blok voor de blokeditor.
 *
 * @param DOMNode $node Element.
 * @return array|null Blok, of null als het leeg is.
 */
function esp_vacature_als_blok( DOMNode $node ) {
  $tag = strtolower( $node->nodeName );

  if ( 'ul' === $tag || 'ol' === $tag ) {
    $punten = array();
    foreach ( $node->childNodes as $li ) {
      if ( 'li' !== strtolower( $li->nodeName ) ) {
        continue;
      }
      $sublijsten = array();
      $inhoud     = '';
      foreach ( $li->childNodes as $kind ) {
        $kindtag = strtolower( $kind->nodeName );
        if ( 'ul' === $kindtag || 'ol' === $kindtag ) {
          $sub = esp_vacature_als_blok( $kind );
          if ( $sub ) {
            $sublijsten[] = $sub;
          }
        } else {
          $inhoud .= $kind->ownerDocument->saveHTML( $kind );
        }
      }
      $punten[] = esp_vacature_core_blok( 'list-item', '<li>' . esp_vacature_inline_html( $inhoud ), array(), $sublijsten, '</li>' );
    }
    if ( ! $punten ) {
      return null;
    }
    $attrs = 'ol' === $tag ? array( 'ordered' => true ) : array();
    return esp_vacature_core_blok( 'list', "<$tag class=\"wp-block-list\">", $attrs, $punten, "</$tag>" );
  }

  $inhoud = '';
  foreach ( $node->childNodes as $kind ) {
    $inhoud .= $kind->ownerDocument->saveHTML( $kind );
  }
  $inhoud = esp_vacature_inline_html( $inhoud );
  if ( '' === trim( wp_strip_all_tags( $inhoud ) ) ) {
    return null;
  }

  if ( preg_match( '/^h([3-6])$/', $tag, $niveau ) ) {
    return esp_vacature_core_blok( 'heading', "<h{$niveau[1]} class=\"wp-block-heading\">$inhoud</h{$niveau[1]}>", array( 'level' => (int) $niveau[1] ) );
  }

  return esp_vacature_core_blok( 'paragraph', "<p>$inhoud</p>" );
}

/**
 * Alleen vet, cursief, links en regeleinden overhouden; de rest (spans en stijlen uit Word) weg.
 */
function esp_vacature_inline_html( $html ) {
  $html = wp_kses( $html, array(
    'strong' => array(), 'b' => array(), 'em' => array(), 'i' => array(), 'br' => array(),
    'a'      => array( 'href' => true, 'target' => true, 'rel' => true ),
  ) );
  $html = preg_replace( array( '#<(/?)b>#', '#<(/?)i>#' ), array( '<$1strong>', '<$1em>' ), $html );
  $html = preg_replace( '/\s+/u', ' ', str_replace( "\xc2\xa0", ' ', $html ) );

  return trim( preg_replace( '#^(\s*<br\s*/?>)+|(<br\s*/?>\s*)+$#i', '', trim( $html ) ) );
}

/**
 * Herken een citaat van een collega, zoals “We zijn een hecht team.” (Martijn).
 *
 * @param DOMNode $node Alinea of blockquote.
 * @return array|null Array( 'quote' => tekst, 'naam' => naam ).
 */
function esp_vacature_als_citaat( DOMNode $node ) {
  $tag = strtolower( $node->nodeName );
  if ( 'blockquote' !== $tag && ! ( 'p' === $tag && 'citaat' === $node->getAttribute( 'class' ) ) ) {
    return null;
  }

  $tekst = preg_replace( '/\s+/u', ' ', esp_vacature_tekst( $node->textContent ) );
  $naam  = '';
  if ( preg_match( '/^(.*?)\s*\(([^()]{2,60})\)$/u', $tekst, $match ) ) {
    $tekst = $match[1];
    $naam  = $match[2];
  }

  return array( 'quote' => preg_replace( '/^["“„\s]+|["”\s]+$/u', '', $tekst ), 'naam' => $naam );
}

/**
 * Haal regeleinden uit vetgedrukte stukken (zoals "<b>Kopje<br></b>") en gooi lege vetgedrukte
 * stukken weg, zodat een kopje een eigen regel is tussen twee <br>'s.
 *
 * @param DOMDocument $doc Document.
 */
function esp_vacature_vet_opschonen( DOMDocument $doc ) {
  $xpath = new DOMXPath( $doc );
  foreach ( iterator_to_array( $xpath->query( '//b|//strong' ) ) as $vet ) {
    if ( ! $vet->parentNode ) {
      continue;
    }
    while ( $vet->firstChild && esp_vacature_is_leeg_of_br( $vet->firstChild ) ) {
      $vet->parentNode->insertBefore( $vet->firstChild, $vet );
    }
    while ( $vet->lastChild && esp_vacature_is_leeg_of_br( $vet->lastChild ) ) {
      $vet->parentNode->insertBefore( $vet->lastChild, $vet->nextSibling );
    }
    if ( ! $vet->hasChildNodes() ) {
      $vet->parentNode->removeChild( $vet );
    }
  }
}

function esp_vacature_is_leeg_of_br( DOMNode $node ) {
  if ( XML_TEXT_NODE === $node->nodeType ) {
    return '' === esp_vacature_tekst( $node->textContent );
  }
  return 'br' === strtolower( $node->nodeName );
}

function esp_vacature_is_inline( DOMNode $node ) {
  if ( XML_TEXT_NODE === $node->nodeType ) {
    return true;
  }
  if ( XML_ELEMENT_NODE !== $node->nodeType ) {
    return false;
  }
  return in_array( strtolower( $node->nodeName ), array( 'a', 'b', 'strong', 'i', 'em', 'span', 'br', 'u', 'sup', 'sub', 'small' ), true );
}

/**
 * Tekst zonder witruimte en harde spaties aan het begin en eind.
 */
function esp_vacature_tekst( $tekst ) {
  return trim( str_replace( "\xc2\xa0", ' ', $tekst ) );
}

/**
 * Splits de inhoud van een alinea bij de regeleinden. Een regel die helemaal vetgedrukt en kort is,
 * wordt een kopje; de andere regels blijven samen een alinea.
 *
 * @param DOMDocument $doc   Document.
 * @param DOMNode[]   $nodes Inhoud van de alinea.
 * @return array Items: array( 'kop', tekst ) of array( 'blok', DOMElement ).
 */
function esp_vacature_regels( DOMDocument $doc, array $nodes ) {
  // Plat maken tot stukjes tekst (en afbeeldingen), elk met de opmaak-elementen eromheen.
  $stukjes = array();
  $plat    = function ( DOMNode $node, array $omhulsel ) use ( &$plat, &$stukjes ) {
    $tag = strtolower( $node->nodeName );
    if ( XML_ELEMENT_NODE === $node->nodeType && 'br' !== $tag && 'img' !== $tag && $node->hasChildNodes() ) {
      foreach ( iterator_to_array( $node->childNodes ) as $kind ) {
        $plat( $kind, array_merge( $omhulsel, array( $node ) ) );
      }
      return;
    }
    $stukjes[] = array( $node, $omhulsel );
  };
  foreach ( $nodes as $node ) {
    $plat( $node, array() );
  }

  $regels = array( array() );
  foreach ( $stukjes as $stukje ) {
    if ( 'br' === strtolower( $stukje[0]->nodeName ) ) {
      $regels[] = array();
    } else {
      $regels[ count( $regels ) - 1 ][] = $stukje;
    }
  }

  $items  = array();
  $alinea = array();
  $sluit  = function () use ( &$alinea, &$items, $doc ) {
    $p = esp_vacature_bouw_alinea( $doc, $alinea );
    if ( $p ) {
      $items[] = array( 'blok', $p );
    }
    $alinea = array();
  };

  foreach ( $regels as $regel ) {
    // Een lege regel (twee regeleinden achter elkaar) begint een nieuwe alinea.
    if ( '' === esp_vacature_tekst( implode( '', array_map( function ( $stukje ) {
      return 'img' === strtolower( $stukje[0]->nodeName ) ? 'img' : $stukje[0]->textContent;
    }, $regel ) ) ) ) {
      $sluit();
      continue;
    }
    $kop = esp_vacature_kop( $regel );
    if ( null !== $kop ) {
      $sluit();
      $items[] = array( 'kop', $kop );
      continue;
    }
    if ( $alinea ) {
      $alinea[] = null; // Regeleinde tussen twee regels van dezelfde alinea.
    }
    $alinea = array_merge( $alinea, $regel );
  }
  $sluit();

  return $items;
}

/**
 * Geef de tekst van het kopje als de regel een kopje is, anders null.
 *
 * @param array $regel Stukjes van een regel.
 */
function esp_vacature_kop( array $regel ) {
  $tekst = '';
  foreach ( $regel as $stukje ) {
    $node = $stukje[0];
    if ( XML_TEXT_NODE !== $node->nodeType ) {
      return null; // Een afbeelding of iets anders hoort niet in een kopje.
    }
    if ( '' === esp_vacature_tekst( $node->textContent ) ) {
      $tekst .= ' ';
      continue;
    }
    $vet = false;
    foreach ( $stukje[1] as $om ) {
      $tag = strtolower( $om->nodeName );
      if ( 'a' === $tag ) {
        return null;
      }
      $vet = $vet || 'b' === $tag || 'strong' === $tag;
    }
    if ( ! $vet ) {
      return null;
    }
    $tekst .= $node->textContent;
  }

  $tekst = preg_replace( '/\s+/u', ' ', esp_vacature_tekst( $tekst ) );
  // Een citaat of een zin die op een punt eindigt is geen kopje; "..." wel.
  if ( '' === $tekst || mb_strlen( $tekst ) > ESP_VACATURE_KOP_MAX_LENGTE || preg_match( '/^["“„]|(?<!\.)\.$/u', $tekst ) ) {
    return null;
  }

  return rtrim( $tekst, ': ' );
}

/**
 * Bouw een alinea uit stukjes, met de oorspronkelijke opmaak eromheen. Opeenvolgende stukjes
 * binnen hetzelfde element (bijvoorbeeld een link) komen weer in één element.
 *
 * @param DOMDocument $doc     Document.
 * @param array       $stukjes Stukjes; null is een regeleinde.
 * @return DOMElement|null Null als de alinea leeg is.
 */
function esp_vacature_bouw_alinea( DOMDocument $doc, array $stukjes ) {
  // Lege regels aan het begin en eind weghalen.
  $leeg = function ( $stukje ) {
    return null === $stukje || ( XML_TEXT_NODE === $stukje[0]->nodeType && '' === esp_vacature_tekst( $stukje[0]->textContent ) );
  };
  while ( $stukjes && $leeg( $stukjes[0] ) ) {
    array_shift( $stukjes );
  }
  while ( $stukjes && $leeg( end( $stukjes ) ) ) {
    array_pop( $stukjes );
  }
  if ( ! $stukjes ) {
    return null;
  }

  $p      = $doc->createElement( 'p' );
  $open   = array(); // Paren van origineel element en kopie, van buiten naar binnen.
  $citaat = true;

  foreach ( $stukjes as $stukje ) {
    if ( null === $stukje ) {
      $open = array();
      $p->appendChild( $doc->createElement( 'br' ) );
      continue;
    }
    list( $node, $omhulsel ) = $stukje;

    // Spans uit Word ("font-weight: 400") voegen niets toe.
    $omhulsel = array_values( array_filter( $omhulsel, function ( $om ) {
      return 'span' !== strtolower( $om->nodeName );
    } ) );

    $gedeeld = 0;
    while ( isset( $open[ $gedeeld ], $omhulsel[ $gedeeld ] ) && $open[ $gedeeld ][0]->isSameNode( $omhulsel[ $gedeeld ] ) ) {
      $gedeeld++;
    }
    $open   = array_slice( $open, 0, $gedeeld );
    $ouder  = $gedeeld ? $open[ $gedeeld - 1 ][1] : $p;
    for ( $i = $gedeeld; $i < count( $omhulsel ); $i++ ) {
      $kopie = $omhulsel[ $i ]->cloneNode( false );
      $ouder->appendChild( $kopie );
      $open[] = array( $omhulsel[ $i ], $kopie );
      $ouder  = $kopie;
    }
    $ouder->appendChild( $node->cloneNode( true ) );

    if ( XML_TEXT_NODE === $node->nodeType && '' !== esp_vacature_tekst( $node->textContent ) ) {
      $tags   = array_map( function ( $om ) {
        return strtolower( $om->nodeName );
      }, $omhulsel );
      $citaat = $citaat && array_intersect( $tags, array( 'i', 'em' ) );
    }
  }

  // Een alinea die helemaal cursief is en met een aanhalingsteken begint, is een citaat van een collega.
  if ( $citaat && preg_match( '/^["“„]/u', esp_vacature_tekst( $p->textContent ) ) ) {
    $p->setAttribute( 'class', 'citaat' );
  }

  return $p;
}
