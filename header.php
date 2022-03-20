<!DOCTYPE html>
<html <?php language_attributes(); ?>>
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

<body <?php body_class( 'bg-white text-gray-900 antialiased text-base mx-auto -z-20 shadow-xl' ); ?>>

<?php do_action( 'espcentrum_theme_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'espcentrum_theme_header' ); ?>

  <?php if ( is_front_page() ) { ?>
    <header class="espcentrum-header bg-light">
  <?php } else { ?>
    <header class="espcentrum-header bg-light always-sticky">
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

	<div id="content" class="site-content flex-grow z-10 overflow-hidden flex bg-light">

		<?php do_action( 'espcentrum_theme_content_start' ); ?>