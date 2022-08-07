<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <script defer src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <?php wp_head(); ?>

</head>

<body <?php body_class('bg-white text-gray-900 antialiased text-base mx-auto -z-20'); ?>>

  <?php do_action('espcentrum_theme_site_before'); ?>

  <div id="page" class="flex flex-col min-h-screen">

    <?php do_action('espcentrum_theme_header'); ?>

      <header class="bg-white shadow espcentrum-header bg-light">
        <div class="hidden lg:block bg-gray2 border-b border-b-[rgba(0,0,0,0.25)] shadow-[0px_1px_0px_rgba(0, 0, 0, 0.25)]">
          <div class="flex justify-between py-2 mx-auto container-base">
            <ul class="flex gap-5 text-xs xl:gap-12 xl:text-small">
              <li class="flex items-center gap-2" opening-time>
                <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="http://espcentrum.local/de-praktijk/openingstijden/">
                  <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.992 0C3.576 0 0 3.584 0 8s3.576 8 7.992 8C12.416 16 16 12.416 16 8s-3.584-8-8.008-8ZM8 14.4A6.398 6.398 0 0 1 1.6 8c0-3.536 2.864-6.4 6.4-6.4 3.536 0 6.4 2.864 6.4 6.4 0 3.536-2.864 6.4-6.4 6.4ZM8.4 4H7.2v4.8l4.2 2.52.6-.984L8.4 8.2V4Z" fill="#01B132" />
                  </svg>
                  Vandaag open van 08:00 - 20:30
                  <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                </a>
              </li>
              <li>
                <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="tel:0485516009">
                  <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.222 6.929a13.387 13.387 0 0 0 5.858 5.853l1.956-1.96a.892.892 0 0 1 .902-.218c.995.33 2.066.507 3.173.507.493 0 .889.396.889.889v3.111a.886.886 0 0 1-.889.889C6.764 16 0 9.236 0 .889 0 .396.4 0 .889 0H4c.493 0 .889.396.889.889 0 1.107.178 2.178.507 3.173a.892.892 0 0 1-.218.902L3.222 6.93Z" fill="#575757" /></svg>
                  Direct contact? 0485-516009
                  <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                </a>
              </li>
              <li>
                <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="https://espcentrum.virtuagym.com/" target="_blank">
                  <svg width="14" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.667 7.2H3.11v1.6h1.556V7.2Zm3.11 0H6.223v1.6h1.556V7.2Zm3.112 0H9.333v1.6h1.556V7.2Zm1.555-5.6h-.777V0H10.11v1.6H3.89V0H2.333v1.6h-.777C.692 1.6.008 2.32.008 3.2L0 14.4c0 .88.692 1.6 1.556 1.6h10.888C13.3 16 14 15.28 14 14.4V3.2c0-.88-.7-1.6-1.556-1.6Zm0 12.8H1.556V5.6h10.888v8.8Z" fill="#575757" /></svg>
                  Reserveer trainingsmoment
                  <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                </a>
              </li>
              <li>
                <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="https://espcentrum.virtuagym.com/" target="_blank">
                  <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 8c1.66 0 2.99-1.34 2.99-3S10.66 2 9 2C7.34 2 6 3.34 6 5s1.34 3 3 3Zm0 2c-2.33 0-7 1.17-7 3.5V16h14v-2.5c0-2.33-4.67-3.5-7-3.5Z" fill="#575757" /></svg>
                  Mijn account
                  <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                </a>
              </li>
            </ul>
            <ul class="flex items-center min-h-full gap-2">
              <li>
                <a href="https://nl-nl.facebook.com/espcentrum/" target="_blank" aria-label="Facebook">
                  <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_472_2350)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1383 0.529419C21.6853 0.529419 22.9412 1.78536 22.9412 3.33227V20.6677C22.9412 22.2147 21.6852 23.4706 20.1383 23.4706H15.3678V14.8267H18.352L18.9197 11.1247H15.3678V8.72224C15.3678 7.70947 15.864 6.72224 17.4549 6.72224H19.0699V3.57051C19.0699 3.57051 17.6042 3.3204 16.203 3.3204C13.2777 3.3204 11.3657 5.09337 11.3657 8.30312V11.1247H8.11387V14.8267H11.3657V23.4706H2.80286C1.25594 23.4706 0 22.2147 0 20.6677V3.33227C0 1.78536 1.25589 0.529419 2.80286 0.529419H20.1383V0.529419Z" fill="#575757" />
                    </g>
                    <defs>
                      <clipPath id="clip0_472_2350">
                        <rect width="22.9412" height="22.9412" fill="white" transform="translate(0 0.529419)" />
                      </clipPath>
                    </defs>
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/espcentrum/" target="_blank" aria-label="Instagram">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_472_2348)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M20.4179 0.529419C21.9648 0.529419 23.2207 1.78536 23.2207 3.33227V20.6677C23.2207 22.2147 21.9648 23.4706 20.4179 23.4706H3.0824C1.53548 23.4706 0.279541 22.2147 0.279541 20.6677V3.33227C0.279541 1.78536 1.53544 0.529419 3.0824 0.529419H20.4179V0.529419ZM11.7501 4.15878C9.62059 4.15878 9.35354 4.16779 8.51722 4.20597C7.6826 4.24405 7.11261 4.37659 6.61381 4.57047C6.09818 4.77085 5.6609 5.03897 5.22498 5.47486C4.78905 5.91078 4.52093 6.3481 4.32055 6.86369C4.12671 7.36248 3.99417 7.93247 3.95604 8.76709C3.91791 9.60342 3.90891 9.87047 3.90891 12C3.90891 14.1295 3.91791 14.3966 3.95604 15.2329C3.99417 16.0675 4.12671 16.6375 4.32055 17.1363C4.52093 17.6519 4.78905 18.0892 5.22498 18.5252C5.6609 18.9611 6.09818 19.2292 6.61381 19.4296C7.11261 19.6234 7.6826 19.756 8.51722 19.794C9.35354 19.8322 9.62059 19.8412 11.7501 19.8412C13.8797 19.8412 14.1467 19.8322 14.983 19.794C15.8177 19.756 16.3877 19.6234 16.8864 19.4296C17.402 19.2292 17.8394 18.9611 18.2753 18.5252C18.7112 18.0892 18.9793 17.6519 19.1797 17.1363C19.3735 16.6375 19.5061 16.0675 19.5442 15.2329C19.5823 14.3966 19.5914 14.1295 19.5914 12C19.5914 9.87047 19.5823 9.60342 19.5442 8.76709C19.5061 7.93247 19.3735 7.36248 19.1797 6.86369C18.9793 6.3481 18.7112 5.91078 18.2753 5.47486C17.8394 5.03897 17.402 4.77085 16.8864 4.57047C16.3877 4.37659 15.8177 4.24405 14.983 4.20597C14.1467 4.16779 13.8797 4.15878 11.7501 4.15878ZM11.7501 5.57164C13.8438 5.57164 14.0918 5.57961 14.9187 5.61734C15.6832 5.65225 16.0983 5.77999 16.3747 5.8873C16.7407 6.02957 17.0019 6.19952 17.2763 6.47387C17.5507 6.74827 17.7206 7.00949 17.8628 7.37548C17.9702 7.6518 18.0979 8.06698 18.1328 8.83148C18.1705 9.6583 18.1785 9.90631 18.1785 12C18.1785 14.0937 18.1705 14.3417 18.1328 15.1685C18.0979 15.933 17.9702 16.3482 17.8628 16.6245C17.7206 16.9906 17.5507 17.2517 17.2763 17.5261C17.0019 17.8005 16.7407 17.9704 16.3747 18.1127C16.0983 18.2201 15.6832 18.3478 14.9187 18.3827C14.092 18.4204 13.844 18.4284 11.7501 18.4284C9.6563 18.4284 9.40834 18.4204 8.5816 18.3827C7.81711 18.3478 7.40192 18.2201 7.1256 18.1127C6.75957 17.9704 6.49839 17.8005 6.22399 17.5261C5.9496 17.2517 5.77964 16.9906 5.63743 16.6245C5.53007 16.3482 5.40232 15.933 5.36742 15.1685C5.32969 14.3417 5.32172 14.0937 5.32172 12C5.32172 9.90631 5.32969 9.6583 5.36742 8.83148C5.40232 8.06698 5.53007 7.6518 5.63743 7.37548C5.77964 7.00949 5.9496 6.74827 6.22399 6.47387C6.49839 6.19952 6.75957 6.02957 7.1256 5.8873C7.40192 5.77999 7.81711 5.65225 8.5816 5.61734C9.40843 5.57961 9.65643 5.57164 11.7501 5.57164ZM11.7501 7.97343C9.52631 7.97343 7.72355 9.77619 7.72355 12C7.72355 14.2238 9.52631 16.0266 11.7501 16.0266C13.9739 16.0266 15.7767 14.2238 15.7767 12C15.7767 9.77619 13.9739 7.97343 11.7501 7.97343ZM11.7501 14.6137C10.3066 14.6137 9.1364 13.4436 9.1364 12C9.1364 10.5565 10.3066 9.38628 11.7501 9.38628C13.1937 9.38628 14.3639 10.5565 14.3639 12C14.3639 13.4436 13.1937 14.6137 11.7501 14.6137ZM16.8768 7.81436C16.8768 8.33403 16.4554 8.75526 15.9358 8.75526C15.4161 8.75526 14.9949 8.33403 14.9949 7.81436C14.9949 7.29469 15.4161 6.87342 15.9358 6.87342C16.4554 6.87342 16.8768 7.29469 16.8768 7.81436Z" fill="#575757" />
                    </g>
                    <defs>
                      <clipPath id="clip0_472_2348">
                        <rect width="22.9412" height="22.9412" fill="white" transform="translate(0.279541 0.529419)" />
                      </clipPath>
                    </defs>
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://nl.linkedin.com/company/esp-centrum-voor-gezondheid-en-sport" target="_blank" aria-label="LinkedIn">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_472_2346)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M20.6974 0.529419C22.2444 0.529419 23.5003 1.78536 23.5003 3.33227V20.6677C23.5003 22.2147 22.2443 23.4706 20.6974 23.4706H3.36194C1.81502 23.4706 0.559082 22.2147 0.559082 20.6677V3.33227C0.559082 1.78536 1.81498 0.529419 3.36194 0.529419H20.6974V0.529419ZM7.74886 19.4952V9.38153H4.38654V19.4952H7.74886ZM19.8709 19.4952V13.6955C19.8709 10.5889 18.2122 9.1437 16.0004 9.1437C14.2169 9.1437 13.418 10.1246 12.9707 10.8135V9.38153H9.60924C9.65382 10.3306 9.60924 19.4952 9.60924 19.4952H12.9707V13.847C12.9707 13.5447 12.9924 13.2425 13.0815 13.0264C13.3241 12.4226 13.8776 11.7972 14.8063 11.7972C16.0222 11.7972 16.5093 12.725 16.5093 14.084V19.4952H19.8709ZM6.09041 4.50478C4.94004 4.50478 4.18845 5.26108 4.18845 6.25235C4.18845 7.22278 4.91719 7.99991 6.04592 7.99991H6.06761C7.23998 7.99991 7.96975 7.22278 7.96975 6.25235C7.94802 5.26247 7.24204 4.50693 6.09041 4.50478Z" fill="#575757" />
                    </g>
                    <defs>
                      <clipPath id="clip0_472_2346">
                        <rect width="22.9412" height="22.9412" fill="white" transform="translate(0.559082 0.529419)" />
                      </clipPath>
                    </defs>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="relative lg:px-10">
          <div class="lg:container-base lg:mx-auto lg:flex lg:justify-between lg:items-center lg:py-6">
            <div class="flex items-center justify-between px-5 py-2 shadow-md lg:shadow-none lg:py-0 lg:px-0">
              <div class="h-[2.6rem] lg:h-[3.5rem] max-w-[148px] lg:min-w-[13rem]">
                <?php if (has_custom_logo()) { ?>
                  <?php the_custom_logo(); ?>
                <?php } else { ?>
                  <div class="text-lg uppercase">
                    <a href="<?php echo get_bloginfo('url'); ?>" class="text-lg font-extrabold uppercase">
                      <?php echo get_bloginfo('name'); ?>
                    </a>
                  </div>

                  <p class="text-sm font-light text-gray-600">
                    <?php echo get_bloginfo('description'); ?>
                  </p>

                <?php } ?>
              </div>

              <div class="lg:hidden">
                <div class="hamburger">
                  <a class="flex flex-col items-center gap-1 px-3 py-1 main-nav-toggle" href="#main-nav" aria-label="Toggle navigation" id="primary-menu-toggle">
                    <svg class="mt-2" width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0 12.2143H18V10.2857H0V12.2143ZM0 7.07143H18V5.14286H0V7.07143ZM0 0V1.92857H18V0H0Z" fill="#575757" />
                    </svg>
                    <span class="text-xs text-gray5">
                      Menu
                    </span>
                  </a>
                </div>
              </div>
            </div>

            <div class="hidden lg:block absolute overflow-y-scroll overscroll-contain lg:overflow-visible lg:static w-full bg-white h-[calc(100vh-5rem)] lg:h-fit" id="navigation-menu">
              <div class="flex flex-col items-center w-full min-h-screen gap-5 px-5 py-8 lg:flex-row lg:justify-between lg:gap-10 lg:flex lg:py-0 lg:px-0 lg:min-h-0">
                  <?php
                  wp_nav_menu(
                    array(
                      'container_id'    => 'primary-menu',
                      'container_class' => 'w-full',
                      'menu_class'      => 'flex flex-col lg:flex-row lg:items-center justify-center gap-0 lg:gap-6 xl:gap-12 divide-y divide-gray4 lg:divide-y-0',
                      'theme_location'  => 'primary',
                      'li_class'        => 'lg:font-regular lg:text-[20px] group lg:py-0 py-4',
                      'fallback_cb'     => false,
                      'walker'         => new WPSE_78121_Sublevel_Walker
                    )
                  );
                  ?>
                  <?php
                  wp_nav_menu(
                    array(
                      'container_id'    => 'cta-menu',
                      'container_class' => 'shrink-0 w-full lg:w-auto',
                      'menu_class'      => 'lg:flex items-center',
                      'theme_location'  => 'cta-menu',
                      'li_class'        => 'cta-menu',
                      'fallback_cb'     => false,
                    )
                  );
                  ?>
                  <div class="flex flex-col justify-between w-full gap-10 py-2 my-10 lg:hidden">
                    <ul class="flex flex-col gap-5 text-xs xl:gap-12 xl:text-small" top-nav-items>
                      <li class="flex items-center gap-2">
                        <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="http://espcentrum.local/de-praktijk/openingstijden/">
                          <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.992 0C3.576 0 0 3.584 0 8s3.576 8 7.992 8C12.416 16 16 12.416 16 8s-3.584-8-8.008-8ZM8 14.4A6.398 6.398 0 0 1 1.6 8c0-3.536 2.864-6.4 6.4-6.4 3.536 0 6.4 2.864 6.4 6.4 0 3.536-2.864 6.4-6.4 6.4ZM8.4 4H7.2v4.8l4.2 2.52.6-.984L8.4 8.2V4Z" fill="#01B132" /></svg>
                          Vandaag open van 08:00 - 20:30
                          <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="tel:0485516009">
                          <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.222 6.929a13.387 13.387 0 0 0 5.858 5.853l1.956-1.96a.892.892 0 0 1 .902-.218c.995.33 2.066.507 3.173.507.493 0 .889.396.889.889v3.111a.886.886 0 0 1-.889.889C6.764 16 0 9.236 0 .889 0 .396.4 0 .889 0H4c.493 0 .889.396.889.889 0 1.107.178 2.178.507 3.173a.892.892 0 0 1-.218.902L3.222 6.93Z" fill="#575757" /></svg>
                          Direct contact? 0485-516009
                          <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="#">
                          <svg width="14" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.667 7.2H3.11v1.6h1.556V7.2Zm3.11 0H6.223v1.6h1.556V7.2Zm3.112 0H9.333v1.6h1.556V7.2Zm1.555-5.6h-.777V0H10.11v1.6H3.89V0H2.333v1.6h-.777C.692 1.6.008 2.32.008 3.2L0 14.4c0 .88.692 1.6 1.556 1.6h10.888C13.3 16 14 15.28 14 14.4V3.2c0-.88-.7-1.6-1.556-1.6Zm0 12.8H1.556V5.6h10.888v8.8Z" fill="#575757" /></svg>
                          Reserveer trainingsmoment
                          <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-2 hover:underline underline-offset-4 group" href="#">
                          <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 8c1.66 0 2.99-1.34 2.99-3S10.66 2 9 2C7.34 2 6 3.34 6 5s1.34 3 3 3Zm0 2c-2.33 0-7 1.17-7 3.5V16h14v-2.5c0-2.33-4.67-3.5-7-3.5Z" fill="#575757" /></svg>
                          Mijn account
                          <svg class="group-hover:translate-x-0.5 transition-all" width="6" height="10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 8.822 1.144 10 6 5 1.144 0 0 1.178 3.712 5 0 8.822Z" fill="#575757" /></svg>
                        </a>
                      </li>
                    </ul>
                    <ul class="flex gap-2" social-items>
                      <li>
                        <a href="https://nl-nl.facebook.com/espcentrum/" target="_blank" aria-label="Facebook">
                          <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_472_2350)">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1383 0.529419C21.6853 0.529419 22.9412 1.78536 22.9412 3.33227V20.6677C22.9412 22.2147 21.6852 23.4706 20.1383 23.4706H15.3678V14.8267H18.352L18.9197 11.1247H15.3678V8.72224C15.3678 7.70947 15.864 6.72224 17.4549 6.72224H19.0699V3.57051C19.0699 3.57051 17.6042 3.3204 16.203 3.3204C13.2777 3.3204 11.3657 5.09337 11.3657 8.30312V11.1247H8.11387V14.8267H11.3657V23.4706H2.80286C1.25594 23.4706 0 22.2147 0 20.6677V3.33227C0 1.78536 1.25589 0.529419 2.80286 0.529419H20.1383V0.529419Z" fill="#575757" />
                            </g>
                            <defs>
                              <clipPath id="clip0_472_2350">
                                <rect width="22.9412" height="22.9412" fill="white" transform="translate(0 0.529419)" />
                              </clipPath>
                            </defs>
                          </svg>
                        </a>
                      </li>
                      <li>
                        <a href="https://www.instagram.com/espcentrum/" target="_blank" aria-label="Instagram" >
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_472_2348)">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M20.4179 0.529419C21.9648 0.529419 23.2207 1.78536 23.2207 3.33227V20.6677C23.2207 22.2147 21.9648 23.4706 20.4179 23.4706H3.0824C1.53548 23.4706 0.279541 22.2147 0.279541 20.6677V3.33227C0.279541 1.78536 1.53544 0.529419 3.0824 0.529419H20.4179V0.529419ZM11.7501 4.15878C9.62059 4.15878 9.35354 4.16779 8.51722 4.20597C7.6826 4.24405 7.11261 4.37659 6.61381 4.57047C6.09818 4.77085 5.6609 5.03897 5.22498 5.47486C4.78905 5.91078 4.52093 6.3481 4.32055 6.86369C4.12671 7.36248 3.99417 7.93247 3.95604 8.76709C3.91791 9.60342 3.90891 9.87047 3.90891 12C3.90891 14.1295 3.91791 14.3966 3.95604 15.2329C3.99417 16.0675 4.12671 16.6375 4.32055 17.1363C4.52093 17.6519 4.78905 18.0892 5.22498 18.5252C5.6609 18.9611 6.09818 19.2292 6.61381 19.4296C7.11261 19.6234 7.6826 19.756 8.51722 19.794C9.35354 19.8322 9.62059 19.8412 11.7501 19.8412C13.8797 19.8412 14.1467 19.8322 14.983 19.794C15.8177 19.756 16.3877 19.6234 16.8864 19.4296C17.402 19.2292 17.8394 18.9611 18.2753 18.5252C18.7112 18.0892 18.9793 17.6519 19.1797 17.1363C19.3735 16.6375 19.5061 16.0675 19.5442 15.2329C19.5823 14.3966 19.5914 14.1295 19.5914 12C19.5914 9.87047 19.5823 9.60342 19.5442 8.76709C19.5061 7.93247 19.3735 7.36248 19.1797 6.86369C18.9793 6.3481 18.7112 5.91078 18.2753 5.47486C17.8394 5.03897 17.402 4.77085 16.8864 4.57047C16.3877 4.37659 15.8177 4.24405 14.983 4.20597C14.1467 4.16779 13.8797 4.15878 11.7501 4.15878ZM11.7501 5.57164C13.8438 5.57164 14.0918 5.57961 14.9187 5.61734C15.6832 5.65225 16.0983 5.77999 16.3747 5.8873C16.7407 6.02957 17.0019 6.19952 17.2763 6.47387C17.5507 6.74827 17.7206 7.00949 17.8628 7.37548C17.9702 7.6518 18.0979 8.06698 18.1328 8.83148C18.1705 9.6583 18.1785 9.90631 18.1785 12C18.1785 14.0937 18.1705 14.3417 18.1328 15.1685C18.0979 15.933 17.9702 16.3482 17.8628 16.6245C17.7206 16.9906 17.5507 17.2517 17.2763 17.5261C17.0019 17.8005 16.7407 17.9704 16.3747 18.1127C16.0983 18.2201 15.6832 18.3478 14.9187 18.3827C14.092 18.4204 13.844 18.4284 11.7501 18.4284C9.6563 18.4284 9.40834 18.4204 8.5816 18.3827C7.81711 18.3478 7.40192 18.2201 7.1256 18.1127C6.75957 17.9704 6.49839 17.8005 6.22399 17.5261C5.9496 17.2517 5.77964 16.9906 5.63743 16.6245C5.53007 16.3482 5.40232 15.933 5.36742 15.1685C5.32969 14.3417 5.32172 14.0937 5.32172 12C5.32172 9.90631 5.32969 9.6583 5.36742 8.83148C5.40232 8.06698 5.53007 7.6518 5.63743 7.37548C5.77964 7.00949 5.9496 6.74827 6.22399 6.47387C6.49839 6.19952 6.75957 6.02957 7.1256 5.8873C7.40192 5.77999 7.81711 5.65225 8.5816 5.61734C9.40843 5.57961 9.65643 5.57164 11.7501 5.57164ZM11.7501 7.97343C9.52631 7.97343 7.72355 9.77619 7.72355 12C7.72355 14.2238 9.52631 16.0266 11.7501 16.0266C13.9739 16.0266 15.7767 14.2238 15.7767 12C15.7767 9.77619 13.9739 7.97343 11.7501 7.97343ZM11.7501 14.6137C10.3066 14.6137 9.1364 13.4436 9.1364 12C9.1364 10.5565 10.3066 9.38628 11.7501 9.38628C13.1937 9.38628 14.3639 10.5565 14.3639 12C14.3639 13.4436 13.1937 14.6137 11.7501 14.6137ZM16.8768 7.81436C16.8768 8.33403 16.4554 8.75526 15.9358 8.75526C15.4161 8.75526 14.9949 8.33403 14.9949 7.81436C14.9949 7.29469 15.4161 6.87342 15.9358 6.87342C16.4554 6.87342 16.8768 7.29469 16.8768 7.81436Z" fill="#575757" />
                            </g>
                            <defs>
                              <clipPath id="clip0_472_2348">
                                <rect width="22.9412" height="22.9412" fill="white" transform="translate(0.279541 0.529419)" />
                              </clipPath>
                            </defs>
                          </svg>
                        </a>
                      </li>
                      <li>
                        <a href="https://nl.linkedin.com/company/esp-centrum-voor-gezondheid-en-sport" target="_blank" aria-label="LinkedIn">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_472_2346)">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M20.6974 0.529419C22.2444 0.529419 23.5003 1.78536 23.5003 3.33227V20.6677C23.5003 22.2147 22.2443 23.4706 20.6974 23.4706H3.36194C1.81502 23.4706 0.559082 22.2147 0.559082 20.6677V3.33227C0.559082 1.78536 1.81498 0.529419 3.36194 0.529419H20.6974V0.529419ZM7.74886 19.4952V9.38153H4.38654V19.4952H7.74886ZM19.8709 19.4952V13.6955C19.8709 10.5889 18.2122 9.1437 16.0004 9.1437C14.2169 9.1437 13.418 10.1246 12.9707 10.8135V9.38153H9.60924C9.65382 10.3306 9.60924 19.4952 9.60924 19.4952H12.9707V13.847C12.9707 13.5447 12.9924 13.2425 13.0815 13.0264C13.3241 12.4226 13.8776 11.7972 14.8063 11.7972C16.0222 11.7972 16.5093 12.725 16.5093 14.084V19.4952H19.8709ZM6.09041 4.50478C4.94004 4.50478 4.18845 5.26108 4.18845 6.25235C4.18845 7.22278 4.91719 7.99991 6.04592 7.99991H6.06761C7.23998 7.99991 7.96975 7.22278 7.96975 6.25235C7.94802 5.26247 7.24204 4.50693 6.09041 4.50478Z" fill="#575757" />
                            </g>
                            <defs>
                              <clipPath id="clip0_472_2346">
                                <rect width="22.9412" height="22.9412" fill="white" transform="translate(0.559082 0.529419)" />
                              </clipPath>
                            </defs>
                          </svg>
                        </a>
                      </li>
                    </ul>
                  </div>
              </div>
            </div>

          </div>
        </div>
        </header>

        <div id="content" class="site-content flex-grow z-10 flex bg-light min-h-[70vh]">

          <?php do_action('espcentrum_theme_content_start'); ?>