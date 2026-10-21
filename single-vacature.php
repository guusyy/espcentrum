<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<?php
      while ( have_posts() ) :
        the_post();
        $contact        = esp_get_vacature_contact( get_the_ID() );
        $werken_bij     = esp_get_werken_bij_page();
        $sluitingsdatum = esp_vacature_sluitingsdatum();
			?>

      <main class="flex-grow min-h-full bg-white">
        <article <?php post_class( 'pb-28 bg-white min-h-full' ); ?>>

          <?php if ( has_post_thumbnail() ) : ?>
            <div class="container-base mx-auto h-[200px] lg:h-[360px] md:h-96 overflow-hidden">
              <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover object-top' ) ); ?>
            </div>
          <?php endif; ?>

          <div class="mx-auto container-xl">
            <div class="grid grid-cols-12 lg:gap-x-5 xl:gap-x-10">
              <div class="col-span-full lg:col-span-8">
                <?php if ( $werken_bij ) : ?>
                  <div class="mt-12 mb-8">
                    <a class="btn btn--outline" href="<?php echo esc_url( get_permalink( $werken_bij ) ); ?>">Alle vacatures</a>
                  </div>
                <?php endif; ?>
                <header class="mt-8 mb-6 entry-header fade">
                  <span class="block mb-2 font-semibold text-secondary text-small">Vacature</span>
                  <h1 class="mb-4 font-bold text-black text-m2xl md:text-4xl"><?php echo esc_html( esp_vacature_title() ); ?></h1>
                  <div class="flex flex-wrap gap-2">
                    <?php if ( get_field( 'uren' ) ) : ?>
                      <span class="px-3 py-1 font-semibold rounded text-small bg-gray2 text-secondary"><?php echo esc_html( get_field( 'uren' ) ); ?></span>
                    <?php endif; ?>
                    <span class="px-3 py-1 font-semibold rounded text-small bg-gray2 text-secondary">Gennep</span>
                    <?php if ( $sluitingsdatum ) : ?>
                      <span class="px-3 py-1 font-semibold rounded text-small bg-gray2 text-secondary">
                        Reageren t/m <?php echo esc_html( wp_date( 'j F Y', $sluitingsdatum ) ); ?>
                      </span>
                    <?php endif; ?>
                  </div>
                </header>
                <div class="entry-content">
                  <?php the_content(); ?>
                </div>
              </div>

              <aside class="col-span-full lg:col-span-4 lg:mt-[8.5rem]">
                <div class="p-6 border-2 rounded shadow lg:sticky lg:top-36 border-gray2 bg-gray1">
                  <h2 class="mb-2 text-xl font-bold">Solliciteren</h2>
                  <?php if ( esp_get_werken_bij_field( 'sollicitatie_tekst' ) ) : ?>
                    <p class="mb-4"><?php echo esc_html( esp_get_werken_bij_field( 'sollicitatie_tekst' ) ); ?></p>
                  <?php endif; ?>
                  <?php if ( $contact['contact_naam'] ) : ?>
                    <p class="mb-4 font-semibold">Contactpersoon: <?php echo esc_html( $contact['contact_naam'] ); ?></p>
                  <?php endif; ?>
                  <div class="flex flex-col gap-3">
                    <?php if ( $contact['contact_email'] ) : ?>
                      <a class="btn" href="mailto:<?php echo esc_attr( antispambot( $contact['contact_email'] ) ); ?>?subject=<?php echo rawurlencode( 'Sollicitatie: ' . esp_vacature_title() ); ?>">Mail je sollicitatie</a>
                    <?php endif; ?>
                    <?php if ( $contact['contact_telefoon'] ) : ?>
                      <a class="btn btn--outline" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact['contact_telefoon'] ) ); ?>">Bel <?php echo esc_html( $contact['contact_telefoon'] ); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
              </aside>
            </div>
          </div>

        </article>
      </main>

		<?php endwhile; ?>

	<?php endif; ?>

<?php
get_footer();
