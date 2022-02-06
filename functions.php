<?php

/**
 * Theme setup.
 */
function movida_theme_setup() {
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

add_action( 'after_setup_theme', 'movida_theme_setup' );

/**
 * Enqueue theme assets.
 */
function movida_theme_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', movida_theme_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', movida_theme_asset( 'js/app.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'movida_theme_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function movida_theme_asset( $path ) {
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
function movida_theme_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'movida_theme_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function movida_theme_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'movida_theme_nav_menu_add_submenu_class', 10, 3 );

// Our custom post type function
function create_posttype() {
 
  register_post_type( 'Programma',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Programma&rsquo;s' ),
              'singular_name' => __( 'Programma' )
          ),
          'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'programma-s'),
          'show_in_rest' => true,
          'menu_icon' => 'dashicons-format-aside',
          'publicly_queryable' =>  true,
          'hierarchical'        => true,
          'menu_position'       => 20,
          'template' => true
      )
  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

// function movida_customize_register($wp_customize){
   
//   $wp_customize->add_section('movida_editor', array(
//       'title'       => __('Movida homepagina editor', 'movida'),
//       'description' => '',
//       'priority'    => 1,
//   ));

//   //  =============================
//   //  = Text Input                =
//   //  =============================
//   $wp_customize->add_setting('hero_title', array(
//       'default'        => 'Centrum voor interdisciplinaire diagnostiek en behandeling',
//       'capability'     => 'edit_theme',
//       'type'           => 'option',
//   ));

//   $wp_customize->add_control('movida_text_test', array(
//       'label'      => __('Hero titel', 'movida'),
//       'section'    => 'movida_editor',
//       'settings'   => 'hero_title',
//   ));
// }

// add_action('customize_register', 'movida_customize_register');

function themename_customize_register($wp_customize){
     
  $wp_customize->add_section('movida_homepage_settings', array(
      'title'    => __('Movida homepagina settings', 'themename'),
      'description' => '',
      'priority' => 1,
  ));

  //  =============================
  //  = Text Input                =
  //  =============================
  $wp_customize->add_setting('movida_hero_title', array(
      'default'        => 'Centrum voor interdisciplinaire diagnostiek en behandeling',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',

  ));

  $wp_customize->add_control('movida_hero_title_control', array(
      'label'      => __('Hero titel', 'movida'),
      'section'    => 'movida_homepage_settings',
      'settings'   => 'movida_hero_title',
  ));

  //  =============================
  //  = Text Area                 =
  //  =============================

  // Add setting
	$wp_customize->add_setting( 'movida_hero_text', array(
		 'default'           => __( 'Wanneer u wordt getroffen door een ongeval of een ernstige aandoening kan uw leven totaal veranderen. Uw dagelijkse activiteiten rondom huis, sporten, werken en hobby’s zijn niet meer vanzelfsprekend. Movida kan u helpen om de kwaliteit van uw leven zo optimaal mogelijk te maken.', 'movida' ),
		 'sanitize_callback' => 'sanitize_text',
     'capability'     => 'edit_theme_options',
     'type'           => 'option',
	) );
	// Add control
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'movida_hero_text_control',
		    array(
		        'label'    => __( 'Hero Text', 'movida' ),
		        'section'    => 'movida_homepage_settings',
		        'settings' => 'movida_hero_text',
		        'type'     => 'textarea'
		    )
	    )
	);

 	// Sanitize text
	function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}

  //  =============================
  //  = Radio Input               =
  //  =============================
  $wp_customize->add_setting('themename_theme_options[color_scheme]', array(
      'default'        => 'value2',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
  ));

  $wp_customize->add_control('movida_homepage_settings', array(
      'label'      => __('Color Scheme', 'themename'),
      'section'    => 'movida_homepage_settings',
      'settings'   => 'themename_theme_options[color_scheme]',
      'type'       => 'radio',
      'choices'    => array(
          'value1' => 'Choice 1',
          'value2' => 'Choice 2',
          'value3' => 'Choice 3',
      ),
  ));


  //  =============================
  //  = Select Box                =
  //  =============================
   $wp_customize->add_setting('themename_theme_options[header_select]', array(
      'default'        => 'value2',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',

  ));
  $wp_customize->add_control( 'example_select_box', array(
      'settings' => 'themename_theme_options[header_select]',
      'label'   => 'Select Something:',
      'section' => 'movida_homepage_settings',
      'type'    => 'select',
      'choices'    => array(
          'value1' => 'Choice 1',
          'value2' => 'Choice 2',
          'value3' => 'Choice 3',
      ),
  ));


  //  =============================
  //  = Image Upload              =
  //  =============================
  $wp_customize->add_setting('themename_theme_options[image_upload_test]', array(
      'default'           => 'image.jpg',
      'capability'        => 'edit_theme_options',
      'type'           => 'option',

  ));

  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(
      'label'    => __('Image Upload Test', 'themename'),
      'section'  => 'movida_homepage_settings',
      'settings' => 'themename_theme_options[image_upload_test]',
  )));

  //  =============================
  //  = File Upload               =
  //  =============================
  $wp_customize->add_setting('themename_theme_options[upload_test]', array(
      'default'           => 'arse',
      'capability'        => 'edit_theme_options',
      'type'           => 'option',

  ));

  $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'upload_test', array(
      'label'    => __('Upload Test', 'themename'),
      'section'  => 'movida_homepage_settings',
      'settings' => 'themename_theme_options[upload_test]',
  )));


  //  =============================
  //  = Color Picker              =
  //  =============================
  $wp_customize->add_setting('themename_theme_options[link_color]', array(
      'default'           => '#000',
      'sanitize_callback' => 'sanitize_hex_color',
      'capability'        => 'edit_theme_options',
      'type'           => 'option',

  ));

  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
      'label'    => __('Link Color', 'themename'),
      'section'  => 'movida_homepage_settings',
      'settings' => 'themename_theme_options[link_color]',
  )));


  //  =============================
  //  = Page Dropdown             =
  //  =============================
  $wp_customize->add_setting('themename_theme_options[page_test]', array(
      'capability'     => 'edit_theme_options',
      'type'           => 'option',

  ));

  $wp_customize->add_control('themename_page_test', array(
      'label'      => __('Page Test', 'themename'),
      'section'    => 'movida_homepage_settings',
      'type'    => 'dropdown-pages',
      'settings'   => 'themename_theme_options[page_test]',
  ));

  // =====================
  //  = Category Dropdown =
  //  =====================
  $categories = get_categories();
  $cats = array();
  $i = 0;
  foreach($categories as $category){
      if($i==0){
          $default = $category->slug;
          $i++;
      }
      $cats[$category->slug] = $category->name;
  }

  $wp_customize->add_setting('_s_f_slide_cat', array(
      'default'        => $default
  ));
  $wp_customize->add_control( 'cat_select_box', array(
      'settings' => '_s_f_slide_cat',
      'label'   => 'Select Category:',
      'section'  => '_s_f_home_slider',
      'type'    => 'select',
      'choices' => $cats,
  ));
}

add_action('customize_register', 'themename_customize_register');

function register_custom_widget_areas() {
  register_sidebar(
    array(
    'id' => 'footer-col-one',
    'name' => esc_html__( 'Footer column one', 'movida' ),
    'description' => esc_html__( 'Footer column one', 'movida' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="movida-widget-title-holder"><h3 class="movida-widget-title font-bold mb-2">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'footer-col-two',
    'name' => esc_html__( 'Footer column two', 'movida' ),
    'description' => esc_html__( 'Footer column two', 'movida' ),
    'before_widget' => '<div id="%1$s" class="movida-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="movida-widget-title-holder"><h3 class="movida-widget-title font-bold mb-2">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'footer-col-three',
    'name' => esc_html__( 'Footer column three', 'movida' ),
    'description' => esc_html__( 'Footer column three', 'movida' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="movida-widget-title-holder"><h3 class="movida-widget-title font-bold mb-2">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'sub-footer',
    'name' => esc_html__( 'Sub footer', 'movida' ),
    'description' => esc_html__( 'Sub footer', 'movida' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="movida-widget-title-holder"><h3 class="movida-widget-title font-bold mb-2">',
    'after_title' => '</h3></div>'
    )
  );
  register_sidebar(
    array(
    'id' => 'logo-footer',
    'name' => esc_html__( 'Logo footer', 'movida' ),
    'description' => esc_html__( 'Logo footer', 'movida' ),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="movida-widget-title-holder"><h3 class="movida-widget-title font-bold mb-2">',
    'after_title' => '</h3></div>'
    )
  );
}
add_action( 'widgets_init', 'register_custom_widget_areas' );