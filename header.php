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

<body <?php body_class( 'bg-white text-gray-900 antialiased text-base mx-auto -z-20' ); ?>>

<?php do_action( 'espcentrum_theme_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'espcentrum_theme_header' ); ?>

  <?php if ( is_front_page() ) { ?>
    <header class="espcentrum-header bg-light shadow">
  <?php } else { ?>
    <header class="espcentrum-header bg-light shadow always-sticky">
  <?php } ?>

		<div class="mx-auto container-xl">
			<div class="lg:flex lg:justify-between lg:items-center py-3 md:py-6">
				<div class="flex justify-between items-center">
					<div class="h-[3.5rem] md:h-[3.5rem] min-w-[13rem]">
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

        <div class="flex justify-between gap-10 items-center w-full">
          <?php
          wp_nav_menu(
            array(
              'container_id'    => 'primary-menu',
              'container_class' => 'w-full',
              'menu_class'      => 'flex items-center justify-center gap-12',
              'theme_location'  => 'primary',
              'li_class'        => '',
              'fallback_cb'     => false,
            )
          );
          ?>
          <?php
          wp_nav_menu(
            array(
              'container_id'    => 'cta-menu',
              'container_class' => 'shrink-0',
              'menu_class'      => 'lg:flex lg:-mx-4 items-center',
              'theme_location'  => 'cta-menu',
              'li_class'        => 'cta-menu',
              'fallback_cb'     => false,
            )
          );
          ?>
        </div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content flex-grow z-10 overflow-hidden flex bg-light">

		<?php do_action( 'espcentrum_theme_content_start' ); ?>