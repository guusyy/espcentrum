<?php

/**
 * Theme setup.
 */
function espcentrum_theme_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

  add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'espcentrum_theme_setup' );

/**
 * Enqueue theme assets.
 */
function espcentrum_theme_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', espcentrum_theme_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
  wp_enqueue_script( 'anime', espcentrum_theme_asset( 'js/anime.min.js' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', espcentrum_theme_asset( 'js/app.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'espcentrum_theme_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function espcentrum_theme_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function espcentrum_theme_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}



// Add mega menu to submenu
class WPSE_78121_Sublevel_Walker extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-holder'><div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul><div class='sub-menu-bg'></div></div></div>\n";
    }
}

add_filter( 'nav_menu_css_class', 'espcentrum_theme_nav_menu_add_li_class', 10, 4 );

function yourprefix_menu_arrow($item_output, $item, $depth, $args) {
  if (in_array('menu-item-has-children', $item->classes)) {
      $arrow = '<button class="hidden menu-collapse js-menuCollapse"><svg class="fill-primary" width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0.000116534 15.88L2.12012 18L11.1201 9L2.12012 -7.86805e-07L0.000117737 2.12L6.88012 9L0.000116534 15.88Z" />
      </svg></button></div>'; // Change the class to your font icon
      $item_output = str_replace('</a>', '</a>'. $arrow .'', $item_output);
      $item_output = str_replace('<a', '<div class="menu-parent"><a', $item_output);
  }
  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'yourprefix_menu_arrow', 10, 4);

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function espcentrum_theme_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'espcentrum_theme_nav_menu_add_submenu_class', 10, 3 );

function wpb_custom_new_menu() {
  register_nav_menu('cta-menu',__( 'Call to action menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

// Our custom post type function
function create_posttype() {
 
  register_post_type( 'Nieuws',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Nieuws' ),
              'singular_name' => __( 'Nieuws' )
          ),
          'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'actueel'),
          'show_in_rest' => true,
          'menu_icon' => 'dashicons-format-aside',
          'publicly_queryable' =>  true,
          'hierarchical'        => true,
          'menu_position'       => 20,
          'template' => true
      )
  );

  register_post_type( 'Vestigingen',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Vestigingen' ),
              'singular_name' => __( 'Vestiging' ),
              'add_new'               => __( 'Nieuwe vestiging', 'vestiging' ),
              'add_new_item'          => __( 'Nieuwe vestiging', 'vestiging' ),
              'new_item'              => __( 'Nieuwe vestiging', 'vestiging' ),
          ),
          'supports'            => array( 'title', 'custom-fields'),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'vestiging'),
          'show_in_rest' => false,
          'menu_icon' => 'dashicons-location',
          'publicly_queryable' =>  false,
          'hierarchical'        => true,
          'menu_position'       => 30,
          'template' => false
      )
  );

  register_post_type( 'Medewerkers',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Medewerkers' ),
              'singular_name' => __( 'Medewerker' ),
              'add_new'               => __( 'Nieuwe medewerker', 'medewerker' ),
              'add_new_item'          => __( 'Nieuwe medewerker', 'medewerker' ),
              'new_item'              => __( 'Nieuwe medewerker', 'medewerker' ),
          ),
          'supports'            => array( 'title', 'custom-fields'),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'medewerker'),
          'show_in_rest' => false,
          'menu_icon' => 'dashicons-groups',
          'publicly_queryable' =>  false,
          'hierarchical'        => true,
          'menu_position'       => 40,
          'template' => false
      )
  );

  register_post_type( 'Partners',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Partners' ),
              'singular_name' => __( 'Partner' ),
              'add_new'               => __( 'Nieuwe partner', 'partner' ),
              'add_new_item'          => __( 'Nieuwe partner', 'partner' ),
              'new_item'              => __( 'Nieuwe partner', 'partner' ),
          ),
          'supports'            => array( 'title', 'custom-fields'),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'partner'),
          'show_in_rest' => true,
          'menu_icon' => 'dashicons-building',
          'publicly_queryable' =>  true,
          'hierarchical'        => true,
          'menu_position'       => 50,
          'template' => false
      )
  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function register_custom_widget_areas() {
  register_sidebar(
    array(
    'id' => 'footer-col-one',
    'name' => esc_html__( 'Footer column one', 'espcentrum' ),
    'description' => esc_html__( 'Footer column one', 'espcentrum' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="mb-2 font-bold espcentrum-widget-title">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'footer-col-two',
    'name' => esc_html__( 'Footer column two', 'espcentrum' ),
    'description' => esc_html__( 'Footer column two', 'espcentrum' ),
    'before_widget' => '<div id="%1$s" class="espcentrum-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="mb-2 font-bold espcentrum-widget-title">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'footer-col-three',
    'name' => esc_html__( 'Footer column three', 'espcentrum' ),
    'description' => esc_html__( 'Footer column three', 'espcentrum' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="mb-2 font-bold espcentrum-widget-title">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'footer-col-four',
    'name' => esc_html__( 'Footer column four', 'espcentrum' ),
    'description' => esc_html__( 'Footer column four', 'espcentrum' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="mb-2 font-bold espcentrum-widget-title">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'sub-footer',
    'name' => esc_html__( 'Sub footer', 'espcentrum' ),
    'description' => esc_html__( 'Sub footer', 'espcentrum' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="mb-2 font-bold espcentrum-widget-title">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'logo-footer',
    'name' => esc_html__( 'Logo footer', 'espcentrum' ),
    'description' => esc_html__( 'Logo footer', 'espcentrum' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="mb-2 font-bold espcentrum-widget-title">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar( array(
    'name' => esc_html__( 'Page Sidebar', 'espcentrum' ),
    'description' => esc_html__( 'Page Sidebar', 'espcentrum' ),
		'id'            => 'page-sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'register_custom_widget_areas' );

function my_remove_admin_menus() {
  remove_menu_page( 'edit-comments.php' );
  remove_menu_page('edit.php');
}
add_action( 'admin_init', 'my_remove_admin_menus' );

// add editor the privilege to edit theme

// get the the role object
$role_object = get_role( 'editor' );

// add $cap capability to this role object
$role_object->add_cap( 'edit_theme_options' );

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Espcentrum Wordpress uitleg', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
echo '<h2 style="margin-bottom:1rem">Hulp bij aanpassen van de content van ESPCentrum website</h2>
    <h3 style="font-size: 18px; font-weight: bold;">Toevoegen of wijzigen van een pagina</h3>
    <ol>
      <li>Selecteer tabblad pagina"s</li>
      <li>Druk op de knop "nieuwe pagina"</li>
      <li>Vul de content en de "uitgelichte afbeelding"</li>
      <li>Selecteer het juiste template (met of zonder zijnavigatie)</li>
      <li>Selecteer rechts in het scherm onder "Pagina attributen" de bovenliggende pagina (van bijvoorbeeld de discipline.</li>
      <li>Publiceer de pagina <b>Let op: De pagina is niet standaard te zien in het menu op de website</b></li>
      <li>Indien nodig: Vergeet de pagina niet toe te voegen aan het navigatie menu</li>
    </ol>
    <h3 style="font-size: 18px; font-weight: bold;">Pagina toevoegen aan het navigatiemenu (en zijnavigatie)</h3>
    <ol>
      <li>Selecteer "Weergave > Menus"</li>
      <li>Selecteer de (nieuwe) pagina links onder paginas en klik op "Aan menu toevoegen"</li>
      <li>Sleep de pagina naar de juiste positie in het rechterscherm</li>
      <li>Druk op "Menu opslaan"</li>
    </ol>
    <h3 style="font-size: 18px; font-weight: bold;">Toevoegen van Nieuwsartikelen</h3>
    <ol>
      <li>Selecteer tabblad "Nieuws"</li>
      <li>Maak een nieuw nieuws artikel aan</li>
      <li>Vul de content</li>
      <li>Selecteer een uitgelichte afbeelding</li>
      <li>Publiceer het nieuwsartikel</li>
    </ol>
    <h3 style="font-size: 18px; font-weight: bold;">Medewerkers tabblad</h3>
    <p>
      Medewerkers worden getoond in het medewerkersblok op bijvoorbeeld de "Praktijk" pagina.
    </p>
    <h3 style="font-size: 18px; font-weight: bold;">Vestigingen tabblad</h3>
    <p>
      Vestigingen worden getoond in het vestigingenblok op bijvoorbeeld de "Contact" pagina.
    </p>
    <h3 style="font-size: 18px; font-weight: bold;">Partners tabblad</h3>
    <p>
      Partners worden getoond in de partnerslider op bijvoorbeeld de "Homepagina".
    </p>
  ';
}

// Widgets
require_once('functions/widgets/esp_wg_subpages.php');

?>