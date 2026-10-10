<?php
  $social_posts = new WP_Query( array(
    'post_type'      => 'social_post',
    'posts_per_page' => (int) $attributes['aantal'] ?: 6,
  ) );
?>
<section class="relative pt-24 pb-16 bg-brand-sand lg:pt-32 lg:pb-24">
  <svg class="absolute left-0 block w-full h-10 -top-px lg:h-16" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0 0 L1440 0 L1440 50 C 1000 10, 520 80, 0 30 Z" fill="#F2EAD3"/>
  </svg>
  <div class="relative container-base">
    <?php if ( $attributes['titel'] || $attributes['tekst'] ) : ?>
      <div class="mb-10 lg:mb-12">
        <?php if ( $attributes['titel'] ) : ?>
          <h2 class="mb-3 esp-titel"><?php echo esc_html( $attributes['titel'] ); ?></h2>
        <?php endif; ?>
        <?php if ( $attributes['tekst'] ) : ?>
          <p class="max-w-2xl text-small leading-relaxed text-black"><?php echo esc_html( $attributes['tekst'] ); ?></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <?php if ( $social_posts->have_posts() ) : ?>
      <ul class="grid grid-cols-2 gap-3 sm:gap-6 lg:grid-cols-3 lg:gap-8">
        <?php
          while ( $social_posts->have_posts() ) {
            $social_posts->the_post();
            get_template_part( 'template-parts/social-post-card' );
          }
          wp_reset_postdata();
        ?>
      </ul>
    <?php elseif ( 'editor' === $context ) : ?>
      <p>Nog geen social posts. Voeg ze toe onder Social posts in het menu links.</p>
    <?php endif; ?>
  </div>
</section>
