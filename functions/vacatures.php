<?php

/**
 * Vacatures: post type, velden, Lazy Block en Google for Jobs structured data.
 */

function esp_register_vacature_post_type() {
  register_post_type( 'vacature',
    array(
      'labels' => array(
        'name'          => __( 'Vacatures' ),
        'singular_name' => __( 'Vacature' ),
        'add_new'       => __( 'Nieuwe vacature' ),
        'add_new_item'  => __( 'Nieuwe vacature' ),
        'new_item'      => __( 'Nieuwe vacature' ),
        'edit_item'     => __( 'Vacature bewerken' ),
        'all_items'     => __( 'Alle vacatures' ),
      ),
      'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
      'public'       => true,
      'has_archive'  => false,
      'rewrite'      => array( 'slug' => 'werken-bij', 'with_front' => false ),
      'show_in_rest' => false,
      'menu_icon'    => 'dashicons-id-alt',
      'menu_position'=> 21,
    )
  );
}
// Prioriteit 0: de redirect-plugin draait op init 1 en heeft de permalinks van vacatures nodig.
add_action( 'init', 'esp_register_vacature_post_type', 0 );

/**
 * Titel zonder het voorvoegsel "Vacature:", als platte tekst (niet HTML-gecodeerd).
 *
 * @param int|null $post_id Vacature ID.
 *
 * @return string
 */
function esp_vacature_title( $post_id = null ) {
  $title = get_post_field( 'post_title', $post_id ?: get_the_ID() );

  return preg_replace( '/^Vacature:\s*/i', '', html_entity_decode( $title, ENT_QUOTES, 'UTF-8' ) );
}

/**
 * ACF velden in code, zodat ze via git mee naar productie gaan.
 */
function esp_register_vacature_fields() {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'      => 'group_esp_vacature',
    'title'    => 'Vacature details',
    'position' => 'side',
    'fields'   => array(
      array(
        'key'          => 'field_esp_vacature_uren',
        'label'        => 'Uren per week',
        'name'         => 'uren',
        'type'         => 'text',
        'placeholder'  => '28-40 uur',
        'instructions' => 'Wordt getoond op de vacaturekaart.',
      ),
      array(
        'key'           => 'field_esp_vacature_dienstverband',
        'label'         => 'Dienstverband',
        'name'          => 'dienstverband',
        'type'          => 'select',
        'choices'       => array(
          'PART_TIME' => 'Parttime',
          'FULL_TIME' => 'Fulltime',
          'INTERN'    => 'Stage',
        ),
        'default_value' => 'PART_TIME',
      ),
      array(
        'key'            => 'field_esp_vacature_sluitingsdatum',
        'label'          => 'Reageren kan tot en met',
        'name'           => 'sluitingsdatum',
        'type'           => 'date_picker',
        'display_format' => 'd-m-Y',
        'return_format'  => 'Ymd',
        'instructions'   => 'Optioneel. Vul hier de sluitingsdatum in, niet alleen in de tekst: na deze datum verdwijnt de vacature automatisch van de Werken bij-pagina en de homepage, en toont de vacature "Reageren t/m …". De vacaturepagina zelf blijft bereikbaar tot je de vacature depubliceert.',
      ),
      array(
        'key'   => 'field_esp_vacature_contact_naam',
        'label' => 'Contactpersoon',
        'name'  => 'contact_naam',
        'type'  => 'text',
      ),
      array(
        'key'   => 'field_esp_vacature_contact_email',
        'label' => 'E-mail contactpersoon',
        'name'  => 'contact_email',
        'type'  => 'email',
      ),
      array(
        'key'   => 'field_esp_vacature_contact_telefoon',
        'label' => 'Telefoon contactpersoon',
        'name'  => 'contact_telefoon',
        'type'  => 'text',
      ),
    ),
    'location' => array(
      array(
        array( 'param' => 'post_type', 'operator' => '==', 'value' => 'vacature' ),
      ),
    ),
  ) );

  acf_add_local_field_group( array(
    'key'    => 'group_esp_werken_bij',
    'title'  => 'Werken bij',
    'fields' => array(
      array(
        'key'          => 'field_esp_werken_bij_intro',
        'label'        => 'Introtekst',
        'name'         => 'intro',
        'type'         => 'textarea',
        'rows'         => 3,
        'instructions' => 'Korte tekst bovenaan de pagina, naast de uitgelichte afbeelding.',
      ),
      array(
        'key'   => 'field_esp_werken_bij_vacatures_titel',
        'label' => 'Titel vacatures',
        'name'  => 'vacatures_titel',
        'type'  => 'text',
      ),
      array(
        'key'          => 'field_esp_werken_bij_geen_vacatures',
        'label'        => 'Tekst als er geen vacatures zijn',
        'name'         => 'geen_vacatures_tekst',
        'type'         => 'textarea',
        'rows'         => 2,
        'instructions' => 'Ook gebruikt in het Vacatures-blok, bijvoorbeeld op de homepage.',
      ),
      array(
        'key'   => 'field_esp_werken_bij_open_titel',
        'label' => 'Titel open sollicitatie',
        'name'  => 'open_sollicitatie_titel',
        'type'  => 'text',
      ),
      array(
        'key'   => 'field_esp_werken_bij_open_tekst',
        'label' => 'Tekst open sollicitatie',
        'name'  => 'open_sollicitatie_tekst',
        'type'  => 'textarea',
        'rows'  => 3,
      ),
      array(
        'key'          => 'field_esp_werken_bij_sollicitatie_tekst',
        'label'        => 'Tekst bij solliciteren',
        'name'         => 'sollicitatie_tekst',
        'type'         => 'textarea',
        'rows'         => 2,
        'instructions' => 'Staat op elke vacaturepagina, naast de contactgegevens.',
      ),
      array(
        'key'   => 'field_esp_werken_bij_contact_naam',
        'label' => 'Contactpersoon',
        'name'  => 'contact_naam',
        'type'  => 'text',
      ),
      array(
        'key'   => 'field_esp_werken_bij_contact_email',
        'label' => 'E-mail contactpersoon',
        'name'  => 'contact_email',
        'type'  => 'email',
      ),
      array(
        'key'   => 'field_esp_werken_bij_contact_telefoon',
        'label' => 'Telefoon contactpersoon',
        'name'  => 'contact_telefoon',
        'type'  => 'text',
      ),
    ),
    'location' => array(
      array(
        array( 'param' => 'page_template', 'operator' => '==', 'value' => 'templates/page-werken-bij.php' ),
      ),
    ),
  ) );
}
add_action( 'acf/init', 'esp_register_vacature_fields' );

/**
 * Lazy Block in code, template staat in blocks/lazyblock-vacatures/block.php.
 */
function esp_register_vacatures_block() {
  if ( ! function_exists( 'lazyblocks' ) ) {
    return;
  }

  lazyblocks()->add_block( array(
    'id'          => 'vacatures',
    'title'       => 'Vacatures',
    'icon'        => 'dashicons dashicons-id-alt',
    'keywords'    => array( 'vacatures', 'werken bij' ),
    'slug'        => 'lazyblock/vacatures',
    'description' => 'Toont de openstaande vacatures als kaarten.',
    'category'    => 'text',
    'supports'    => array(
      'customClassName' => true,
      'anchor'          => true,
      'align'           => array(),
      'html'            => false,
      'multiple'        => true,
      'inserter'        => true,
    ),
    'controls'    => array(
      'control_esp_vac_title' => array(
        'type' => 'text', 'name' => 'title', 'default' => 'Werken bij', 'label' => 'Titel',
        'help' => '', 'child_of' => '', 'placement' => 'content', 'width' => '100',
        'hide_if_not_selected' => 'false', 'save_in_meta' => 'false', 'save_in_meta_name' => '',
        'required' => 'false', 'placeholder' => '', 'characters_limit' => '',
      ),
      'control_esp_vac_text' => array(
        'type' => 'textarea', 'name' => 'text', 'default' => '', 'label' => 'Tekst',
        'help' => 'Optioneel, korte tekst onder de titel.', 'child_of' => '', 'placement' => 'content', 'width' => '100',
        'hide_if_not_selected' => 'false', 'save_in_meta' => 'false', 'save_in_meta_name' => '',
        'required' => 'false', 'placeholder' => '', 'characters_limit' => '',
      ),
      'control_esp_vac_amount' => array(
        'type' => 'number', 'name' => 'amount', 'default' => '3', 'label' => 'Aantal vacatures',
        'help' => '0 = alle vacatures', 'child_of' => '', 'placement' => 'content', 'width' => '100',
        'hide_if_not_selected' => 'false', 'save_in_meta' => 'false', 'save_in_meta_name' => '',
        'required' => 'false', 'placeholder' => '', 'characters_limit' => '',
      ),
      'control_esp_vac_button_label' => array(
        'type' => 'text', 'name' => 'button-label', 'default' => 'Bekijk onze vacatures', 'label' => 'Knop label',
        'help' => '', 'child_of' => '', 'placement' => 'content', 'width' => '100',
        'hide_if_not_selected' => 'false', 'save_in_meta' => 'false', 'save_in_meta_name' => '',
        'required' => 'false', 'placeholder' => '', 'characters_limit' => '',
      ),
      'control_esp_vac_button_url' => array(
        'type' => 'url', 'name' => 'button-url', 'default' => '/werken-bij/', 'label' => 'Knop link',
        'help' => '', 'child_of' => '', 'placement' => 'content', 'width' => '100',
        'hide_if_not_selected' => 'false', 'save_in_meta' => 'false', 'save_in_meta_name' => '',
        'required' => 'false', 'placeholder' => '', 'characters_limit' => '',
      ),
    ),
    'code'        => array(
      'output_method' => 'template',
      'show_preview'  => 'always',
      'single_output' => true,
    ),
    'condition'   => array(),
  ) );
}
// Voor Lazy Blocks' eigen registratie op init prioriteit 20.
add_action( 'init', 'esp_register_vacatures_block', 10 );

/**
 * Sluitingsdatum van een vacature als timestamp, of null als die leeg of ongeldig is.
 * ACF slaat datums op als Ymd; een afwijkend formaat mag geen fatale fout geven.
 *
 * @param int|null $post_id Vacature, standaard de huidige post.
 */
function esp_vacature_sluitingsdatum( $post_id = null ) {
  $waarde = get_field( 'sluitingsdatum', $post_id );
  $datum  = $waarde ? DateTime::createFromFormat( 'Ymd', (string) $waarde, wp_timezone() ) : false;
  return $datum ? $datum->getTimestamp() : null;
}

/**
 * Openstaande vacatures: gepubliceerd en sluitingsdatum niet verstreken.
 *
 * @param int $amount Aantal vacatures, 0 voor alle.
 *
 * @return WP_Query
 */
function esp_get_open_vacatures( $amount = 0 ) {
  return new WP_Query( array(
    'post_type'      => 'vacature',
    'posts_per_page' => $amount > 0 ? $amount : -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => array(
      'relation' => 'OR',
      array( 'key' => 'sluitingsdatum', 'compare' => 'NOT EXISTS' ),
      array( 'key' => 'sluitingsdatum', 'value' => '', 'compare' => '=' ),
      array( 'key' => 'sluitingsdatum', 'value' => current_datetime()->format( 'Ymd' ), 'compare' => '>=', 'type' => 'NUMERIC' ),
    ),
  ) );
}

/**
 * De pagina met het Werken bij-template, voor terug-links en contactgegevens.
 *
 * @return WP_Post|null
 */
function esp_get_werken_bij_page() {
  $pages = get_pages( array(
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'templates/page-werken-bij.php',
    'number'     => 1,
  ) );

  return $pages ? $pages[0] : null;
}

/**
 * Veld van de Werken bij-pagina, voor teksten die ook elders getoond worden.
 *
 * @param string $field Veldnaam.
 *
 * @return mixed
 */
function esp_get_werken_bij_field( $field ) {
  $page = esp_get_werken_bij_page();

  return $page ? get_field( $field, $page->ID ) : null;
}

/**
 * Contactgegevens van de vacature, met die van de Werken bij-pagina als terugval.
 *
 * @param int $post_id Vacature ID.
 *
 * @return array
 */
function esp_get_vacature_contact( $post_id ) {
  $page    = esp_get_werken_bij_page();
  $contact = array();

  foreach ( array( 'contact_naam', 'contact_email', 'contact_telefoon' ) as $field ) {
    $value = get_field( $field, $post_id );
    if ( ! $value && $page ) {
      $value = get_field( $field, $page->ID );
    }
    $contact[ $field ] = $value;
  }

  return $contact;
}

/**
 * JobPosting structured data, zodat vacatures in Google for Jobs kunnen verschijnen.
 */
function esp_vacature_structured_data() {
  if ( ! is_singular( 'vacature' ) ) {
    return;
  }

  $post_id = get_queried_object_id();
  $data    = array(
    '@context'           => 'https://schema.org/',
    '@type'              => 'JobPosting',
    'title'              => esp_vacature_title( $post_id ),
    'description'        => apply_filters( 'the_content', get_post_field( 'post_content', $post_id ) ),
    'datePosted'         => get_the_date( 'c', $post_id ),
    'employmentType'     => get_field( 'dienstverband', $post_id ) ?: 'PART_TIME',
    'hiringOrganization' => array(
      '@type'  => 'Organization',
      'name'   => 'ESP Centrum',
      'sameAs' => home_url( '/' ),
    ),
    'jobLocation'        => array(
      '@type'   => 'Place',
      'address' => array(
        '@type'           => 'PostalAddress',
        'streetAddress'   => 'Langeweg 204',
        'addressLocality' => 'Gennep',
        'postalCode'      => '6591 XA',
        'addressCountry'  => 'NL',
      ),
    ),
  );

  $sluitingsdatum = esp_vacature_sluitingsdatum( $post_id );
  if ( $sluitingsdatum ) {
    $data['validThrough'] = wp_date( 'Y-m-d', $sluitingsdatum ) . 'T23:59:59';
  }

  echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ) . '</script>' . "\n";
}
add_action( 'wp_head', 'esp_vacature_structured_data' );
