<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-light text-gray-900 antialiased text-base' ); ?>>

<?php do_action( 'movida_theme_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'movida_theme_header' ); ?>

	<header>

		<div class="mx-auto container">
			<div class="lg:flex lg:justify-between lg:items-center border-b py-6">
				<div class="flex justify-between items-center">
					<div>
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
						<a href="#" aria-label="Toggle navigation" id="primary-menu-toggle">
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
						'container_class' => 'hidden bg-gray-100 mt-4 p-4 lg:mt-0 lg:p-0 lg:bg-transparent lg:block',
						'menu_class'      => 'lg:flex lg:-mx-4',
						'theme_location'  => 'primary',
						'li_class'        => 'lg:mx-4',
						'fallback_cb'     => false,
					)
				);
				?>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow">

		<!-- Start introduction -->
		<?php if ( is_front_page() ) : ?>
			<div class="container mx-auto my-12 border-b pb-12 grid grid-cols-1 md:grid-cols-2 items-center">
        <div class="mb-40">
          <h1 class="text-3xl lg:text-3xl font-normal my-4">
            <?php echo get_option( 'movida_hero_title' ); ?>
          </h1>
          <p class="text-dark my-8 max-w-[80%]">
            <?php echo get_option( 'movida_hero_text' ); ?>
          </p>
          <div class="flex gap-3 mt-8 max-w-[80%]">
            <a href="https://github.com/jeffreyvr/tailpress"
              class="w-full sm:w-auto flex-none bg-primary text-white py-2 px-4 border border-transparent rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200">
              Over Movida
            </a>
            <a href="https://github.com/jeffreyvr/tailpress"
              class="w-full sm:w-auto flex-none bg-white border-primary text-gray-800 py-2 px-4 border-2 rounded-2xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200">
              Programma's
            </a>
          </div>
        </div>
        <div>
          <img src="http://movida.local/wp-content/uploads/2022/01/movida-hero-image-839x1024.png" alt="">
        </div>
			</div>
		<?php endif; ?>
		<!-- End introduction -->

		<?php do_action( 'movida_theme_content_start' ); ?>

		<main>
