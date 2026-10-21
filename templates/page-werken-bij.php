<?php
/*
Template Name: Werken bij
Template Post Type: page
*/
?>

<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			$vacatures      = esp_get_open_vacatures();
			$contact_naam   = get_field( 'contact_naam' );
			$contact_email  = get_field( 'contact_email' );
			$contact_tel    = get_field( 'contact_telefoon' );
			?>

      <main class="flex-grow bg-white">

        <section class="bg-gray1">
          <div class="mx-auto container-xl">
            <div class="grid items-center grid-cols-12 gap-6 py-10 2xl:py-20">
              <div class="order-2 lg:order-1 col-span-full lg:col-span-6 xl:col-start-2 xl:col-span-5">
                <h1 class="mb-4 text-5xl font-bold text-black tracking-[-0.04em]"><?php the_title(); ?></h1>
                <?php if ( get_field( 'intro' ) ) : ?>
                  <p class="mb-6 text-base 2xl:text-lg2"><?php echo esc_html( get_field( 'intro' ) ); ?></p>
                <?php endif; ?>
                <a class="btn" href="#vacatures">Bekijk vacatures</a>
                <a class="mt-4 ml-0 btn btn--outline lg:mt-0 lg:ml-2" href="#open-sollicitatie">Open sollicitatie</a>
              </div>
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="order-1 lg:order-2 col-span-full lg:col-span-6 xl:col-span-5">
                  <?php the_post_thumbnail( 'large', array( 'class' => 'w-full rounded shadow-md aspect-[4/3] object-cover' ) ); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>

        <section id="vacatures" class="scroll-mt-8">
          <div class="py-16 container-base">
            <?php if ( get_field( 'vacatures_titel' ) ) : ?>
              <div class="flex items-center gap-10 pb-3 mb-8 border-b-2 border-primary">
                <h2 class="text-3xl font-bold"><?php echo esc_html( get_field( 'vacatures_titel' ) ); ?></h2>
              </div>
            <?php endif; ?>
            <?php if ( $vacatures->have_posts() ) : ?>
              <ul class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3 lg:gap-10">
                <?php
                  while ( $vacatures->have_posts() ) {
                    $vacatures->the_post();
                    get_template_part( 'template-parts/vacature-card' );
                  }
                  wp_reset_postdata();
                ?>
              </ul>
            <?php elseif ( get_field( 'geen_vacatures_tekst' ) ) : ?>
              <p><?php echo esc_html( get_field( 'geen_vacatures_tekst' ) ); ?></p>
            <?php endif; ?>
          </div>
        </section>

        <?php if ( get_the_content() ) : ?>
          <section>
            <div class="w-full mx-auto container-xl">
              <div class="grid grid-cols-12 pb-16 lg:gap-x-5 xl:gap-x-10">
                <div class="entry-content col-span-full lg:col-start-3 lg:col-span-8">
                  <?php the_content(); ?>
                </div>
              </div>
            </div>
          </section>
        <?php endif; ?>

        <section id="open-sollicitatie" class="scroll-mt-8 bg-gray1">
          <div class="mx-auto container-xl">
            <div class="grid grid-cols-12 gap-6 py-12 2xl:py-16">
              <div class="col-span-full lg:col-start-3 lg:col-span-8">
                <?php if ( get_field( 'open_sollicitatie_titel' ) ) : ?>
                  <h2 class="mb-2 text-3xl font-bold"><?php echo esc_html( get_field( 'open_sollicitatie_titel' ) ); ?></h2>
                <?php endif; ?>
                <?php if ( get_field( 'open_sollicitatie_tekst' ) ) : ?>
                  <p class="mb-4"><?php echo esc_html( get_field( 'open_sollicitatie_tekst' ) ); ?></p>
                <?php endif; ?>
                <?php if ( $contact_naam ) : ?>
                  <p class="mb-4 font-semibold">Contactpersoon: <?php echo esc_html( $contact_naam ); ?></p>
                <?php endif; ?>
                <?php if ( $contact_email ) : ?>
                  <a class="btn" href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>?subject=<?php echo rawurlencode( 'Open sollicitatie' ); ?>">Stuur een open sollicitatie</a>
                <?php endif; ?>
                <?php if ( $contact_tel ) : ?>
                  <a class="mt-4 ml-0 btn btn--outline lg:mt-0 lg:ml-2" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_tel ) ); ?>">Bel <?php echo esc_html( $contact_tel ); ?></a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </section>

      </main>

		<?php endwhile; ?>

	<?php endif; ?>

<?php
get_footer();
