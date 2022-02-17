<!DOCTYPE html>
<html <?php language_attributes(); ?> class="bg-slate-300">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link
    rel="stylesheet"
    href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
  />
  <script defer src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>


  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

	<?php wp_head(); ?>

</head>

<body <?php body_class( 'bg-light text-gray-900 antialiased text-base max-w-[2040px] mx-auto -z-20 shadow-xl' ); ?>>

<?php do_action( 'movida_theme_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'movida_theme_header' ); ?>

  <?php if ( is_front_page() ) { ?>
    <header class="movida-header bg-light">
    <?php } else { ?>
      <header class="movida-header bg-light always-sticky">
    <?php } ?>

		<div class="mx-auto container-xl">
			<div class="lg:flex lg:justify-between lg:items-center py-3 md:py-6">
				<div class="flex justify-between items-center">
					<div class="h-[28px] md:h-10">
						<?php if ( has_custom_logo() ) { ?>
              <?php the_custom_logo(); ?>
						<?php } else { ?>
							<div class="text-lg uppercase">
								<a href="<?php echo get_bloginfo( 'url' ); ?>" class="font-extrabold text-lg uppercase">
									<?php echo get_bloginfo( 'name' ); ?>
								</a>
							</div>

							<p class="text-sm font-light text-gray-600">
								<?php echo get_bloginfo( 'description' ); ?>
							</p>

						<?php } ?>
					</div>

					<div class="lg:hidden">
            <div class="hamburger">
              <a class="text-primary main-nav-toggle" href="#main-nav" aria-label="Toggle navigation" id="primary-menu-toggle"><i>Menu</i></a>
            </div>
					</div>
				</div>

				<?php
				wp_nav_menu(
					array(
						'container_id'    => 'primary-menu',
						'container_class' => 'hidden mt-4 p-4 lg:mt-0 lg:p-0 bg-transparent lg:block',
						'menu_class'      => 'lg:flex lg:-mx-4 items-center',
						'theme_location'  => 'primary',
						'li_class'        => 'lg:mx-3 font-bold border-b-2 border-transparent pt-4',
						'fallback_cb'     => false,
					)
				);
				?>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow z-10 overflow-hidden">

		<!-- Start introduction -->
		<?php if ( is_front_page() ) : ?>
			<div class="md:container-xl mx-auto mt-12 md:my-12 pb-12 grid grid-cols-1 md:grid-cols-2 md:items-start lg:items-center">
        <div class="drop-shadow-[0_-20px_25px_rgba(0,0,0,0.15)] md:shadow-none bg-white md:bg-transparent md:row-start-1 row-start-2 z-10 -mt-32 md:mt-0 fade">
          <div class="container-xl px-5 md:px-0 py-6 md:pb-40">
            <h1 class="text-lg md:text-3xl font-bold my-4 text-left fade">
              <?php echo get_option( 'movida_hero_title' ); ?>
            </h1>
            <p class="text-dark mb-8 md:my-8 max-w-[100%] md:max-w-[80%] fade">
              <?php echo get_option( 'movida_hero_text' ); ?>
            </p>
            <div class="flex flex-col md:flex-row gap-3 mt-8 max-w-[100%] md:max-w-[80%] fade">
              <a href="<?php echo get_option( 'movida_hero_button_one_link' ); ?>"
                class="flex items-center text-center justify-center md:justify-start w-full sm:w-auto flex-none bg-primary text-white py-2 px-4 border border-transparent rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary focus:outline-none hover:bg-primaryHover transition-all duration-200">
                <?php echo get_option( 'movida_hero_button_one' ); ?>
              </a>
              <a href="<?php echo get_option( 'movida_hero_button_two_link' ); ?>"
                class="flex items-center text-center justify-center md:justify-start w-full sm:w-auto flex-none bg-transparent border-primary text-gray-800 py-2 px-4 border-2 rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary focus:outline-none hover:border-primaryHover transition-all duration-200">
                <?php echo get_option( 'movida_hero_button_two' ); ?>
              </a>
            </div>
          </div>
        </div>
        <div class="max-w-2xl px-5 md:px-0 md:row-start-1 row-start-1 md:pt-16 lg:pt-0 fade">
          <img src="<?php echo get_option( 'movida_hero_image' ); ?>" alt="Movida Hero Image" style="aspect-ratio: 1200 / 1464">
        </div>
			</div>
      <div class="container-xl mx-auto mb-4 md:mt-12 pb-20 md:pb-12 grid grid-cols-1">
        <div class="relative">
          <h2 id="programma-s" class="text-m3xl md:text-4xl font-bold my-4 text-left text-white fade">
            <?php echo get_option( 'movida_programma_title' ); ?>
          </h2>
          <!-- Slider main container -->
          <figure class="absolute 
          w-[960px] h-[960px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-[64%]
          md:w-[780px] md:h-[780px] md:top-[-100px] md:left-[-200px] md:translate-x-0 md:translate-y-0
          lg:hidden
          bottom-0 bg-primary rounded-full -z-10 appear"></figure>
          <figure class="absolute 
          hidden
          lg:block
          lg:w-[800px] lg:h-[800px] lg:top-[-100px] lg:left-[-200px]
          xl:w-[860px] xl:h-[860px] xl:top-[-120px] xl:left-[-240px]
          2xl:w-[920px] 2xl:h-[920px] 2xl:top-[-150px] 2xl:left-[-240px]
          bottom-0 bg-primary rounded-full -z-10 fade"></figure>
          <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <?php 
                global $loop;
                
                $all_posts = array( 'post_type' => 'programma', 'posts_per_page' => -1, 'order' => 'ASC' );
                $loop = new WP_Query( $all_posts );

                if($loop->have_posts()){
                  while($loop->have_posts()){
                        $loop->the_post();
                    ?>

                    <div class="swiper-slide h-auto fade">
                      <div class="shadow-lg rounded-2xl bg-white overflow-hidden flex flex-col h-full">
                        <div class="h-44 program-thumbnail">
                          <?php the_post_thumbnail('medium_large'); ?>
                        </div>
                        <div class="p-4 flex flex-col justify-between gap-5 h-full">
                          <div class="flex flex-col gap-5">
                            <h3 class="text-xl font-bold">
                              <?php the_title(); ?>
                            </h3>
                            <div class="">
                              <?php the_excerpt(); ?>
                            </div>
                          </div>
                          <a class="font-bold flex items-center gap-3 btn--link" href="<?php the_permalink(); ?>">
                            <svg class="mb-1" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_104_680)">
                              <path d="M7.01367 0L14.0273 7.01367L7.01367 14.0273L5.7832 12.7969L10.6641 7.875H0V6.15234H10.6641L5.7832 1.23047L7.01367 0Z" fill="black"/>
                              </g>
                              <defs>
                              <clipPath id="clip0_104_680">
                              <rect width="14.0273" height="14.0273" fill="white"/>
                              </clipPath>
                              </defs>
                            </svg>
                            Meer info
                          </a>
                        </div>
                      </div>
                    </div>
                    
                    <?php
                  }
                }
                wp_reset_query();
              ?>
            </div>
            
            <div class="mt-5 flex align-center justify-center md:justify-start gap-2">
              <button class="swiper-prev">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="49" y="49" width="48" height="48" rx="15" transform="rotate(-180 49 49)" stroke="white" stroke-width="2"/>
                  <g clip-path="url(#clip0_119_868)">
                  <path d="M24.6667 39L11.3333 25.6667L24.6667 12.3333L27.0059 14.6725L17.7271 24.0292L38 24.0292L38 27.3041L17.7271 27.3041L27.0058 36.6608L24.6667 39Z" fill="white"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_119_868">
                  <rect width="26.6667" height="26.6667" fill="white" transform="translate(38 39) rotate(-180)"/>
                  </clipPath>
                  </defs>
                </svg>
              </button>
              <button class="swiper-next">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="1" y="1" width="48" height="48" rx="15" stroke="white" stroke-width="2"/>
                  <g clip-path="url(#clip0_119_865)">
                  <path d="M25.3333 11L38.6667 24.3333L25.3333 37.6667L22.9942 35.3275L32.2729 25.9708H12V22.6959H32.2729L22.9942 13.3392L25.3333 11Z" fill="white"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_119_865">
                  <rect width="26.6667" height="26.6667" fill="white" transform="translate(12 11)"/>
                  </clipPath>
                  </defs>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="container-xl mx-auto md:my-12 md:pb-12 grid grid-cols-1 md:grid-cols-12 items-center">
        <div class="col-span-full md:col-start-5 lg:col-start-7 xl:col-start-8">
          <h2 class="text-m2xl md:text-4xl font-bold md:my-4 text-left">
            <?php echo get_option( 'movida_contact_title' ); ?>
          </h2>
          <p class="text-dark my-2 md:my-8 max-w-[100%] md:max-w-[80%]">
            <?php echo get_option( 'movida_contact_text' ); ?>
          </p>
          <div class="flex flex-col md:flex-row gap-3 mt-8 max-w-[100%] md:max-w-[80%]">
            <a href="<?php echo get_option( 'movida_contact_button_one_link' ); ?>"
              class="flex items-center text-center justify-center md:justify-start w-full sm:w-auto flex-none bg-secondary text-white py-2 px-4 border border-transparent rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-secondary focus:outline-none hover:bg-secondaryHover transition-all duration-200">
              <?php echo get_option( 'movida_contact_button_one' ); ?>
            </a>
            <a href="<?php echo get_option( 'movida_contact_button_two_link' ); ?>"
              class="flex items-center text-center justify-center md:justify-start w-full sm:w-auto flex-none bg-transparent border-secondary text-gray-800 py-2 px-4 border-2 rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-secondary focus:outline-none hover:border-secondaryHover transition-all duration-200">
              <?php echo get_option( 'movida_contact_button_two' ); ?>
            </a>
          </div>
        </div>
			</div>
		<?php endif; ?>
		<!-- End introduction -->

		<?php do_action( 'movida_theme_content_start' ); ?>

		<main>
