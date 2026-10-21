<?php
/**
 * Deel vacatureteksten op in blokken, met om en om een witte en een grijze achtergrond.
 *
 * Vacatures worden vaak uit Word of Google Docs geplakt: de kopjes zijn dan vetgedrukte regels
 * midden in een alinea in plaats van echte kopjes. Deze filter herkent zowel echte kopjes (Kop 2)
 * als zulke vetgedrukte regels, maakt er een h2 van en begint bij elk kopje een nieuw blok.
 * De tekst in de database blijft ongewijzigd.
 */

// Langere vetgedrukte regels zijn een benadrukte zin, geen kopje.
const ESP_VACATURE_KOP_MAX_LENGTE = 80;

/**
 * @param string $content Inhoud van de vacature, na wpautop.
 */
function esp_vacature_blokken( $content ) {
  if ( ! is_singular( 'vacature' ) || ! class_exists( 'DOMDocument' ) || '' === trim( $content ) ) {
    return $content;
  }

  $doc = new DOMDocument();
  libxml_use_internal_errors( true );
  $doc->loadHTML( '<?xml encoding="utf-8"?><div>' . $content . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
  libxml_clear_errors();
  $root = $doc->getElementsByTagName( 'div' )->item( 0 );
  if ( ! $root ) {
    return $content;
  }

  esp_vacature_vet_opschonen( $doc );

  // Alle inhoud als een rij van kopjes en losse blokken (alinea's, lijsten, citaten).
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

  if ( ! in_array( 'kop', array_column( $items, 0 ), true ) ) {
    return $content;
  }

  // Groepeer: alles voor het eerste kopje is de intro, daarna een blok per kopje.
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
    $p->setAttribute( 'class', 'vacature-citaat' );
  }

  return $p;
}
