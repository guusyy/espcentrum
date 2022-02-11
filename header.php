<!DOCTYPE html>
<html <?php language_attributes(); ?> class="bg-slate-300">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-light text-gray-900 antialiased text-base max-w-[1440px] mx-auto shadow-lg -z-20' ); ?>>

<?php do_action( 'movida_theme_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'movida_theme_header' ); ?>

  <?php if ( is_front_page() ) { ?>
    <header class="movida-header bg-light">
    <?php } else { ?>
      <header class="movida-header bg-light always-sticky">
    <?php } ?>

		<div class="mx-auto container-xl">
			<div class="lg:flex lg:justify-between lg:items-center py-6">
				<div class="flex justify-between items-center">
					<div class="h-10">
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
						<a class="text-primary" href="#" aria-label="Toggle navigation" id="primary-menu-toggle">
							<svg viewBox="0 0 20 20" class="inline-block w-6 h-6" version="1.1"
								 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd">
									<g id="icon-shape">
										<path d="M0,3 L20,3 L20,5 L0,5 L0,3 Z M0,9 L20,9 L20,11 L0,11 L0,9 Z M0,15 L20,15 L20,17 L0,17 L0,15 Z"
											  id="Combined-Shape"></path>
									</g>
								</g>
							</svg>
						</a>
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

	<div id="content" class="site-content flex-grow z-10 overflow-x-hidden">

		<!-- Start introduction -->
		<?php if ( is_front_page() ) : ?>
			<div class="md:container-xl mx-auto mt-12 md:my-12 pb-12 grid grid-cols-1 md:grid-cols-2 items-center">
        <div class="px-5 py-6 md:pb-40 md:row-start-1 row-start-2 md:mt-0 -mt-24 z-10 drop-shadow-[0_-20px_25px_rgba(0,0,0,0.15)] md:shadow-none bg-white md:bg-transparent">
          <h1 class="text-lg md:text-3xl font-bold my-4 text-left">
            <?php echo get_option( 'movida_hero_title' ); ?>
          </h1>
          <p class="text-dark mb-8 md:my-8 max-w-[100%] md:max-w-[80%] justify-">
            <?php echo get_option( 'movida_hero_text' ); ?>
          </p>
          <div class="flex flex-col md:flex-row gap-3 mt-8 max-w-[100%] md:max-w-[80%]">
            <a href="<?php echo get_option( 'movida_hero_button_one_link' ); ?>"
              class="text-center md:text-left w-full sm:w-auto flex-none bg-primary text-white py-2 px-4 border border-transparent rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200">
              <?php echo get_option( 'movida_hero_button_one' ); ?>
            </a>
            <a href="<?php echo get_option( 'movida_hero_button_two_link' ); ?>"
              class="text-center md:text-left w-full sm:w-auto flex-none bg-white border-primary text-gray-800 py-2 px-4 border-2 rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200">
              <?php echo get_option( 'movida_hero_button_two' ); ?>
            </a>
          </div>
        </div>
        <div class="px-5 md:px-0 md:row-start-1 row-start-1">
          <img src="<?php echo get_option( 'movida_hero_image' ); ?>" alt="Movida Hero Image">
        </div>
			</div>
      <div class="container-xl mx-auto mb-4 md:mt-12 pb-12 grid grid-cols-1">
        <div class="relative">
          <h2 id="programma-s" class="text-m3xl md:text-4xl font-bold my-4 text-left text-white">
            <?php echo get_option( 'movida_programma_title' ); ?>
          </h2>
          <ul class="grid grid-cols-1 md:grid-cols-3 gap-5 my-12">
            <?php 
              global $loop;
              
              $all_posts = array( 'post_type' => 'programma', 'posts_per_page' => -1 );
              $loop = new WP_Query( $all_posts );

              if($loop->have_posts()){
                while($loop->have_posts()){
                      $loop->the_post();
                  ?>

                  <li>
                    <div class="shadow-lg rounded-2xl bg-white overflow-hidden h-full flex flex-col">
                      <div class="h-44 program-thumbnail">
                        <?php the_post_thumbnail(); ?>
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
                  </li>
                  
                  <?php
                }
              }
              wp_reset_query();
            ?>
          </ul>
          <figure class="absolute w-[960px] h-[960px] top-[-150px] bottom-0 left-[-240px] md:left-[-275px] bg-primary rounded-full -z-10"></figure>
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
              class="text-center md:text-left w-full sm:w-auto flex-none bg-secondary text-white py-2 px-4 border border-transparent rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200">
              <?php echo get_option( 'movida_contact_button_one' ); ?>
            </a>
            <a href="<?php echo get_option( 'movida_contact_button_two_link' ); ?>"
              class="text-center md:text-left w-full sm:w-auto flex-none bg-white border-secondary text-gray-800 py-2 px-4 border-2 rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200">
              <?php echo get_option( 'movida_contact_button_two' ); ?>
            </a>
          </div>
        </div>
			</div>
		<?php endif; ?>
		<!-- End introduction -->

		<?php do_action( 'movida_theme_content_start' ); ?>

		<main>
