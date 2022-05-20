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

  register_post_type( 'Partners',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Partners' ),
              'singular_name' => __( 'Partner' )
          ),
          'supports'            => array( 'title', 'custom-fields'),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'partner'),
          'show_in_rest' => true,
          'menu_icon' => 'dashicons-building',
          'publicly_queryable' =>  true,
          'hierarchical'        => true,
          'menu_position'       => 21,
          'template' => false
      )
  );

  register_post_type( 'Medewerkers',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Medewerkers' ),
              'singular_name' => __( 'Medewerker' )
          ),
          'supports'            => array( 'title', 'custom-fields'),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'medewerker'),
          'show_in_rest' => false,
          'menu_icon' => 'dashicons-groups',
          'publicly_queryable' =>  false,
          'hierarchical'        => true,
          'menu_position'       => 31,
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
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="espcentrum-widget-title font-bold mb-2">',
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
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="espcentrum-widget-title font-bold mb-2">',
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
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="espcentrum-widget-title font-bold mb-2">',
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
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="espcentrum-widget-title font-bold mb-2">',
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
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="espcentrum-widget-title font-bold mb-2">',
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
    'before_title' => '<div class="espcentrum-widget-title-holder"><h3 class="espcentrum-widget-title font-bold mb-2">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar( array(
		'name'          => 'Page Sidebar',
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

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Espcentrum Wordpress uitleg', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
echo '<h2>Welkom bij de Espcentrum website</h2>
    <h3 style="font-size: 18px; font-weight: bold;">Wijzigen van de homepage content</h3>
    <p>
      Het aanpassen van de teksten op de homepagina kan gemakkelijk onder het tabblad <strong>Weergave</strong> -> <strong>Customizer</strong>. Dit opent de customizer. In de customizer selecteer het tabblad <strong>Espcentrum homepagina settings</strong>. Hierin kunnen gemakkelijk de teksten, afbeelding en links worden aangepast. Je ziet rechts direct in de preview het resultaat. Pas na het opslaan van de wijzingen worden de wijzigingen definietf.
    </p>
    <h3 style="font-size: 18px; font-weight: bold;">Toevoegen of wijzigen van een pagina</h3>
    <p>
      Onder het tabblad <strong>pagina-s</strong> kun je pagina-s toevoegen en wijzigen.
    </p>
    <p>
      Bij het aanmaken of wijzingen van een pagina kan er uit twee templates gekozen worden.
    </p>
    <h4 style="font-size: 14px; font-weight: bold;">Full width page layout</h4>
    <p>
      Uitgelichte afbeelding wordt over de gehele breedte bovenin de pagina getoond.
    </p>
    <h4 style="font-size: 14px; font-weight: bold;">Boxed page layout</h4>
    <p>
      Uitgelichte afbeelding wordt afgekaderd samen met de tekst/content van de pagina. Dit is handig wanneer het belangrijk is als de afbeelding op alle schermen zoveel mogelijk in zijn geheel zichtbaar is.
    </p>
    <p>
      Selecteer het gewenste template rechts in de pagina editor, onder het tabblad "Template".
    </p>
    <h3 style="font-size: 18px; font-weight: bold;">Toevoegen of wijzigen van een behandel programma</h3>
    <p>
      Onder het tabblad <strong>programma-s</strong> is het mogelijk de programmma-s te wijzigen. Dit gaat op dezelfde manier als een pagina. Vergeet hierbij de <strong>uitgelichte afbeelding</strong> niet. Deze afbeelding kan rechts in het scherm onder <strong>Uitgelichte afbeelding</strong> worden toegevoegd. Deze afbeelding wordt na het toevoegen automatisch weergegeven in de bovenkant van de pagina en de tegel in de homepage programma slider.</br>
      Programma-s worden niet automatisch toegevoegd aan het menu. Dit kun je vervolgens doen in het tabblad <strong>Weergave</strong> -> <strong>Menu-s</strong>. In menu-s selecteer je "primary menu" en vanuit het tabblad programma-s kan het nieuwe programmam gesleept worden naar het programma menu item. Vervolgens om dit programma ook toe te voegen aan de footer selecteer je het menu <strong>footer column two</strong> en voeg je het nieuwe programma hier aan toe.
    </p>
    <h3 style="font-size: 18px; font-weight: bold;">Contact informatie van de bedrijven wijzigen</h3>
    <p>In het tabblad <strong>bedrijven</strong> is het mogelijk van de verschillende bedrijven de contact informatie aan te passen. Hier zijn verschillende velden instelbaar. Bij het wijzigen van deze data wordt het automatisch weergegeven in de bedrijven blokken op de "Over Espcentrum" pagina.</p>
  ';
}

// Widgets
require_once('functions/widgets/esp_wg_subpages.php');