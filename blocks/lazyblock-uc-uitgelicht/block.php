<?php
  $social_posts = new WP_Query( array(
    'post_type'      => 'social_post',
    'posts_per_page' => (int) $attributes['aantal'] ?: 6,
  ) );
?>
<section class="py-16 bg-brand-sand lg:py-24">
  <div class="container-base">
    <?php if ( $attributes['titel'] || $attributes['tekst'] ) : ?>
      <div class="mb-10">
        <?php if ( $attributes['titel'] ) : ?>
          <h2 class="mb-2 text-4xl font-bold lg:text-5xl text-brand-ochre"><?php echo esc_html( $attributes['titel'] ); ?></h2>
        <?php endif; ?>
        <?php if ( $attributes['tekst'] ) : ?>
          <p class="max-w-2xl text-lg"><?php echo esc_html( $attributes['tekst'] ); ?></p>
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
