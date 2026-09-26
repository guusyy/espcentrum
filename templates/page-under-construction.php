<?php
/*
Template Name: Under construction
Template Post Type: page
*/

$beeldmerk  = get_template_directory_uri() . '/assets/image/esp-beeldmerk-tijdelijk.jpg';
$instagram  = get_field( 'instagram_url' );
$facebook   = get_field( 'facebook_url' );
$afbeelding = get_field( 'afbeelding' );
$social_posts = new WP_Query( array(
  'post_type'      => 'social_post',
  'posts_per_page' => (int) get_field( 'aantal_posts' ) ?: 6,
) );
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<main class="flex-grow brand-page">

  <section class="relative overflow-hidden text-brand-cream bg-brand-green">
    <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
      <path d="M-120 120 C 260 40, 620 260, 520 520 S 760 960, 1180 780" fill="none" stroke="#6D8677" stroke-width="120" stroke-linecap="round" opacity=".55"/>
      <path d="M1560 60 C 1240 120, 1120 380, 1300 640" fill="none" stroke="#6D8677" stroke-width="120" stroke-linecap="round" opacity=".55"/>
    </svg>

    <div class="relative pt-12 pb-28 lg:pt-20 lg:pb-40 container-base">
      <div class="grid items-center grid-cols-12 gap-10">
        <div class="col-span-full lg:col-span-7">
          <?php if ( get_field( 'label' ) ) : ?>
            <span class="inline-block px-4 py-1 mb-6 font-semibold border rounded-full border-brand-olive text-brand-olive"><?php echo esc_html( get_field( 'label' ) ); ?></span>
          <?php endif; ?>
          <h1 class="mb-6 text-5xl font-bold lg:text-[4.5rem] lg:leading-[1.05] text-brand-sand"><?php echo esc_html( get_field( 'titel' ) ?: get_the_title() ); ?></h1>
          <?php if ( get_field( 'intro' ) ) : ?>
            <p class="max-w-2xl mb-8 text-lg text-white lg:text-xl"><?php echo nl2br( esc_html( get_field( 'intro' ) ) ); ?></p>
          <?php endif; ?>
          <div class="flex flex-wrap gap-3">
            <?php if ( $instagram ) : ?>
              <a class="inline-flex items-center gap-2 px-6 py-3 text-lg font-semibold transition rounded-full bg-brand-cream text-brand-green hover:bg-white" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">
                <?php echo esp_social_icon( 'instagram' ); ?> Instagram
              </a>
            <?php endif; ?>
            <?php if ( $facebook ) : ?>
              <a class="inline-flex items-center gap-2 px-6 py-3 text-lg font-semibold transition border-2 rounded-full border-brand-cream text-brand-cream hover:bg-brand-cream hover:text-brand-green" href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener">
                <?php echo esp_social_icon( 'facebook' ); ?> Facebook
              </a>
            <?php endif; ?>
          </div>
        </div>
        <div class="hidden lg:block lg:col-span-5">
          <?php if ( $afbeelding ) : ?>
            <?php echo wp_get_attachment_image( $afbeelding, 'large', false, array( 'class' => 'w-full aspect-[4/5] object-cover rounded-[2.5rem] shadow-xl' ) ); ?>
          <?php else : ?>
            <img class="w-full max-w-md mx-auto" src="<?php echo esc_url( $beeldmerk ); ?>" alt="" width="320" height="230">
          <?php endif; ?>
        </div>
      </div>
    </div>

    <svg class="absolute bottom-0 left-0 w-full h-16 lg:h-28" viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true">
      <path d="M0 120 L0 95 C 420 115, 620 20, 1000 18 C 1220 16, 1360 50, 1440 70 L1440 120 Z" fill="#F2EAD3"/>
    </svg>
  </section>

  <?php if ( get_the_content() ) : ?>
    <section class="py-16 lg:py-24">
      <div class="brand-content container-base">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ( $social_posts->have_posts() ) : ?>
    <section class="py-16 bg-brand-sand lg:py-24">
      <div class="container-base">
        <div class="flex flex-col gap-4 mb-10 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <?php if ( get_field( 'uitgelicht_titel' ) ) : ?>
              <h2 class="mb-2 text-4xl font-bold lg:text-5xl text-brand-ochre"><?php echo esc_html( get_field( 'uitgelicht_titel' ) ); ?></h2>
            <?php endif; ?>
            <?php if ( get_field( 'social_tekst' ) ) : ?>
              <p class="max-w-2xl text-lg"><?php echo esc_html( get_field( 'social_tekst' ) ); ?></p>
            <?php endif; ?>
          </div>
          <?php if ( get_field( 'social_titel' ) && ( $instagram || $facebook ) ) : ?>
            <div class="flex items-center gap-3">
              <span class="font-semibold"><?php echo esc_html( get_field( 'social_titel' ) ); ?></span>
              <?php if ( $instagram ) : ?>
                <a class="p-3 transition rounded-full bg-brand-green text-brand-cream hover:bg-brand-ochre" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener" aria-label="Instagram"><?php echo esp_social_icon( 'instagram' ); ?></a>
              <?php endif; ?>
              <?php if ( $facebook ) : ?>
                <a class="p-3 transition rounded-full bg-brand-green text-brand-cream hover:bg-brand-ochre" href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener" aria-label="Facebook"><?php echo esp_social_icon( 'facebook' ); ?></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
        <ul class="grid grid-cols-2 gap-3 sm:gap-6 lg:grid-cols-3 lg:gap-8">
          <?php
            while ( $social_posts->have_posts() ) {
              $social_posts->the_post();
              get_template_part( 'template-parts/social-post-card' );
            }
            wp_reset_postdata();
          ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>

  <?php if ( get_field( 'afsluiter' ) ) : ?>
    <section class="py-12 text-center bg-brand-green">
      <div class="container-base">
        <p class="text-2xl font-semibold lg:text-3xl text-brand-sand"><?php echo esc_html( get_field( 'afsluiter' ) ); ?></p>
      </div>
    </section>
  <?php endif; ?>

</main>

<?php endwhile; ?>

<?php
get_footer();
