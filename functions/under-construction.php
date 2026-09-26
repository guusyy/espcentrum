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
function esp_social_icon( $platform, $class = 'w-5 h-5' ) {
  if ( 'instagram' === $platform ) {
    return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 1.8.2 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1 .4 2.2.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.2 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1 .4-2.2.4-1.3.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-1.8-.2-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1-.4-2.2-.1-1.3-.1-1.6-.1-4.8s0-3.6.1-4.8c.1-1.2.2-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1-.4 2.2-.4 1.2-.1 1.6-.1 4.8-.1zm0 1.8c-3.1 0-3.5 0-4.7.1-1.1.1-1.7.2-2.1.4-.5.2-.9.4-1.3.8-.4.4-.6.8-.8 1.3-.2.4-.3 1-.4 2.1-.1 1.2-.1 1.6-.1 4.7s0 3.5.1 4.7c.1 1.1.2 1.7.4 2.1.2.5.4.9.8 1.3.4.4.8.6 1.3.8.4.2 1 .3 2.1.4 1.2.1 1.6.1 4.7.1s3.5 0 4.7-.1c1.1-.1 1.7-.2 2.1-.4.5-.2.9-.4 1.3-.8.4-.4.6-.8.8-1.3.2-.4.3-1 .4-2.1.1-1.2.1-1.6.1-4.7s0-3.5-.1-4.7c-.1-1.1-.2-1.7-.4-2.1-.2-.5-.4-.9-.8-1.3-.4-.4-.8-.6-1.3-.8-.4-.2-1-.3-2.1-.4-1.2-.1-1.6-.1-4.7-.1zm0 3.1a4.9 4.9 0 1 1 0 9.8 4.9 4.9 0 0 1 0-9.8zm0 8a3.1 3.1 0 1 0 0-6.2 3.1 3.1 0 0 0 0 6.2zm6.2-8.2a1.1 1.1 0 1 1-2.3 0 1.1 1.1 0 0 1 2.3 0z"/></svg>';
  }
  if ( 'facebook' === $platform ) {
    return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.26h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z"/></svg>';
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
