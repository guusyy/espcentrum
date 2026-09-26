<?php

/**
 * Under construction-pagina: uitgelichte social posts en paginavelden.
 *
 * Social posts worden handmatig toegevoegd (afbeelding, tekst en link naar de post), zodat er
 * geen Instagram- of Facebook-scripts en dus geen tracking cookies op de site komen.
 */

function esp_register_social_post_type() {
  register_post_type( 'social_post',
    array(
      'labels' => array(
        'name'               => __( 'Social posts' ),
        'singular_name'      => __( 'Social post' ),
        'add_new'            => __( 'Nieuwe post' ),
        'add_new_item'       => __( 'Nieuwe social post' ),
        'edit_item'          => __( 'Social post bewerken' ),
        'all_items'          => __( 'Alle social posts' ),
        'featured_image'     => __( 'Afbeelding van de post' ),
        'set_featured_image' => __( 'Afbeelding kiezen' ),
      ),
      'description'         => 'Uitgelichte posts van Instagram en Facebook.',
      'supports'            => array( 'title', 'thumbnail' ),
      'public'              => false,
      'show_ui'             => true,
      'show_in_rest'        => false,
      'exclude_from_search' => true,
      'menu_icon'           => 'dashicons-instagram',
      'menu_position'       => 22,
    )
  );
}
add_action( 'init', 'esp_register_social_post_type' );

function esp_register_under_construction_menu() {
  register_nav_menu( 'under-construction-links', __( 'Under construction: snelle links' ) );
}
add_action( 'init', 'esp_register_under_construction_menu' );

function esp_register_under_construction_fields() {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'      => 'group_esp_social_post',
    'title'    => 'Social post',
    'position' => 'acf_after_title',
    'fields'   => array(
      array(
        'key'          => 'field_esp_social_post_link',
        'label'        => 'Link naar de post',
        'name'         => 'link',
        'type'         => 'url',
        'required'     => 1,
        'instructions' => 'Kopieer de link van de post op Instagram of Facebook. Het platform wordt herkend aan de link.',
      ),
      array(
        'key'          => 'field_esp_social_post_tekst',
        'label'        => 'Tekst',
        'name'         => 'tekst',
        'type'         => 'textarea',
        'rows'         => 4,
        'instructions' => 'Plak de tekst van de post. Op de kaart worden de eerste regels getoond.',
      ),
    ),
    'location' => array(
      array(
        array( 'param' => 'post_type', 'operator' => '==', 'value' => 'social_post' ),
      ),
    ),
  ) );

  acf_add_local_field_group( array(
    'key'    => 'group_esp_under_construction',
    'title'  => 'Under construction',
    'fields' => array(
      array(
        'key'   => 'field_esp_uc_label',
        'label' => 'Label boven de titel',
        'name'  => 'label',
        'type'  => 'text',
      ),
      array(
        'key'          => 'field_esp_uc_titel',
        'label'        => 'Titel',
        'name'         => 'titel',
        'type'         => 'text',
        'instructions' => 'Laat leeg om de paginatitel te gebruiken.',
      ),
      array(
        'key'   => 'field_esp_uc_intro',
        'label' => 'Introtekst',
        'name'  => 'intro',
        'type'  => 'textarea',
        'rows'  => 4,
      ),
      array(
        'key'           => 'field_esp_uc_afbeelding',
        'label'         => 'Afbeelding',
        'name'          => 'afbeelding',
        'type'          => 'image',
        'return_format' => 'id',
        'instructions'  => 'Optioneel. Zonder afbeelding wordt het beeldmerk getoond.',
      ),
      array(
        'key'   => 'field_esp_uc_social_titel',
        'label' => 'Titel socials',
        'name'  => 'social_titel',
        'type'  => 'text',
      ),
      array(
        'key'   => 'field_esp_uc_social_tekst',
        'label' => 'Tekst socials',
        'name'  => 'social_tekst',
        'type'  => 'textarea',
        'rows'  => 2,
      ),
      array(
        'key'   => 'field_esp_uc_instagram',
        'label' => 'Instagram-pagina',
        'name'  => 'instagram_url',
        'type'  => 'url',
      ),
      array(
        'key'   => 'field_esp_uc_facebook',
        'label' => 'Facebook-pagina',
        'name'  => 'facebook_url',
        'type'  => 'url',
      ),
      array(
        'key'   => 'field_esp_uc_uitgelicht_titel',
        'label' => 'Titel uitgelichte posts',
        'name'  => 'uitgelicht_titel',
        'type'  => 'text',
      ),
      array(
        'key'           => 'field_esp_uc_aantal',
        'label'         => 'Aantal uitgelichte posts',
        'name'          => 'aantal_posts',
        'type'          => 'number',
        'default_value' => 6,
        'min'           => 1,
        'max'           => 12,
        'instructions'  => 'De nieuwste social posts worden getoond.',
      ),
      array(
        'key'          => 'field_esp_uc_links_titel',
        'label'        => 'Titel snelle links',
        'name'         => 'links_titel',
        'type'         => 'text',
        'instructions' => 'De links zelf beheer je via Weergave > Menu\'s, locatie "Under construction: snelle links".',
      ),
      array(
        'key'   => 'field_esp_uc_afsluiter',
        'label' => 'Afsluitende tekst',
        'name'  => 'afsluiter',
        'type'  => 'text',
      ),
    ),
    'location' => array(
      array(
        array( 'param' => 'page_template', 'operator' => '==', 'value' => 'templates/page-under-construction.php' ),
      ),
    ),
  ) );
}
add_action( 'acf/init', 'esp_register_under_construction_fields' );

/**
 * Platform van een social post, afgeleid van de link.
 *
 * @param string $url Link naar de post.
 *
 * @return string 'instagram', 'facebook' of ''.
 */
function esp_social_platform( $url ) {
  $host = wp_parse_url( (string) $url, PHP_URL_HOST );

  if ( $host && preg_match( '/(^|\.)instagram\.com$/', $host ) ) {
    return 'instagram';
  }
  if ( $host && preg_match( '/(^|\.)(facebook\.com|fb\.com|fb\.watch)$/', $host ) ) {
    return 'facebook';
  }

  return '';
}

/**
 * Icoon van Instagram of Facebook als inline SVG.
 *
 * @param string $platform 'instagram' of 'facebook'.
 * @param string $class    CSS classes.
 *
 * @return string
 */
function esp_social_icon( $platform, $class = 'w-6 h-6' ) {
  // Dezelfde iconen als in de header en footer van de site.
  if ( 'instagram' === $platform ) {
    return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.4179 0.529419C21.9648 0.529419 23.2207 1.78536 23.2207 3.33227V20.6677C23.2207 22.2147 21.9648 23.4706 20.4179 23.4706H3.0824C1.53548 23.4706 0.279541 22.2147 0.279541 20.6677V3.33227C0.279541 1.78536 1.53544 0.529419 3.0824 0.529419H20.4179V0.529419ZM11.7501 4.15878C9.62059 4.15878 9.35354 4.16779 8.51722 4.20597C7.6826 4.24405 7.11261 4.37659 6.61381 4.57047C6.09818 4.77085 5.6609 5.03897 5.22498 5.47486C4.78905 5.91078 4.52093 6.3481 4.32055 6.86369C4.12671 7.36248 3.99417 7.93247 3.95604 8.76709C3.91791 9.60342 3.90891 9.87047 3.90891 12C3.90891 14.1295 3.91791 14.3966 3.95604 15.2329C3.99417 16.0675 4.12671 16.6375 4.32055 17.1363C4.52093 17.6519 4.78905 18.0892 5.22498 18.5252C5.6609 18.9611 6.09818 19.2292 6.61381 19.4296C7.11261 19.6234 7.6826 19.756 8.51722 19.794C9.35354 19.8322 9.62059 19.8412 11.7501 19.8412C13.8797 19.8412 14.1467 19.8322 14.983 19.794C15.8177 19.756 16.3877 19.6234 16.8864 19.4296C17.402 19.2292 17.8394 18.9611 18.2753 18.5252C18.7112 18.0892 18.9793 17.6519 19.1797 17.1363C19.3735 16.6375 19.5061 16.0675 19.5442 15.2329C19.5823 14.3966 19.5914 14.1295 19.5914 12C19.5914 9.87047 19.5823 9.60342 19.5442 8.76709C19.5061 7.93247 19.3735 7.36248 19.1797 6.86369C18.9793 6.3481 18.7112 5.91078 18.2753 5.47486C17.8394 5.03897 17.402 4.77085 16.8864 4.57047C16.3877 4.37659 15.8177 4.24405 14.983 4.20597C14.1467 4.16779 13.8797 4.15878 11.7501 4.15878ZM11.7501 5.57164C13.8438 5.57164 14.0918 5.57961 14.9187 5.61734C15.6832 5.65225 16.0983 5.77999 16.3747 5.8873C16.7407 6.02957 17.0019 6.19952 17.2763 6.47387C17.5507 6.74827 17.7206 7.00949 17.8628 7.37548C17.9702 7.6518 18.0979 8.06698 18.1328 8.83148C18.1705 9.6583 18.1785 9.90631 18.1785 12C18.1785 14.0937 18.1705 14.3417 18.1328 15.1685C18.0979 15.933 17.9702 16.3482 17.8628 16.6245C17.7206 16.9906 17.5507 17.2517 17.2763 17.5261C17.0019 17.8005 16.7407 17.9704 16.3747 18.1127C16.0983 18.2201 15.6832 18.3478 14.9187 18.3827C14.092 18.4204 13.844 18.4284 11.7501 18.4284C9.6563 18.4284 9.40834 18.4204 8.5816 18.3827C7.81711 18.3478 7.40192 18.2201 7.1256 18.1127C6.75957 17.9704 6.49839 17.8005 6.22399 17.5261C5.9496 17.2517 5.77964 16.9906 5.63743 16.6245C5.53007 16.3482 5.40232 15.933 5.36742 15.1685C5.32969 14.3417 5.32172 14.0937 5.32172 12C5.32172 9.90631 5.32969 9.6583 5.36742 8.83148C5.40232 8.06698 5.53007 7.6518 5.63743 7.37548C5.77964 7.00949 5.9496 6.74827 6.22399 6.47387C6.49839 6.19952 6.75957 6.02957 7.1256 5.8873C7.40192 5.77999 7.81711 5.65225 8.5816 5.61734C9.40843 5.57961 9.65643 5.57164 11.7501 5.57164ZM11.7501 7.97343C9.52631 7.97343 7.72355 9.77619 7.72355 12C7.72355 14.2238 9.52631 16.0266 11.7501 16.0266C13.9739 16.0266 15.7767 14.2238 15.7767 12C15.7767 9.77619 13.9739 7.97343 11.7501 7.97343ZM11.7501 14.6137C10.3066 14.6137 9.1364 13.4436 9.1364 12C9.1364 10.5565 10.3066 9.38628 11.7501 9.38628C13.1937 9.38628 14.3639 10.5565 14.3639 12C14.3639 13.4436 13.1937 14.6137 11.7501 14.6137ZM16.8768 7.81436C16.8768 8.33403 16.4554 8.75526 15.9358 8.75526C15.4161 8.75526 14.9949 8.33403 14.9949 7.81436C14.9949 7.29469 15.4161 6.87342 15.9358 6.87342C16.4554 6.87342 16.8768 7.29469 16.8768 7.81436Z"/></svg>';
  }
  if ( 'facebook' === $platform ) {
    return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 23 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.1383 0.529419C21.6853 0.529419 22.9412 1.78536 22.9412 3.33227V20.6677C22.9412 22.2147 21.6852 23.4706 20.1383 23.4706H15.3678V14.8267H18.352L18.9197 11.1247H15.3678V8.72224C15.3678 7.70947 15.864 6.72224 17.4549 6.72224H19.0699V3.57051C19.0699 3.57051 17.6042 3.3204 16.203 3.3204C13.2777 3.3204 11.3657 5.09337 11.3657 8.30312V11.1247H8.11387V14.8267H11.3657V23.4706H2.80286C1.25594 23.4706 0 22.2147 0 20.6677V3.33227C0 1.78536 1.25589 0.529419 2.80286 0.529419H20.1383V0.529419Z"/></svg>';
  }

  return '';
}

/**
 * Snelle links als knoppen op de under construction-pagina.
 */
function esp_under_construction_link_attributes( $atts, $item, $args ) {
  if ( isset( $args->theme_location ) && 'under-construction-links' === $args->theme_location ) {
    $atts['class'] = 'group flex items-center justify-between gap-4 px-6 py-4 text-lg font-semibold bg-white rounded-2xl shadow-sm transition hover:-translate-y-0.5 hover:shadow-md text-brand-green';
  }

  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'esp_under_construction_link_attributes', 10, 3 );
