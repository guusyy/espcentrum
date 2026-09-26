<li>
  <a class="group" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
    <article class="flex flex-col h-full overflow-hidden transition duration-300 bg-white border-2 rounded shadow border-gray2 group-hover:border-black">
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="w-full aspect-[339/152] max-h-[15.5rem] overflow-hidden flex items-center bg-gray3">
          <?php the_post_thumbnail( 'medium_large', array( 'class' => 'group-hover:scale-[1.03] group-focus:scale-[1.03] duration-[400ms] transition-all object-cover object-top w-full aspect-[339/152]' ) ); ?>
        </div>
      <?php endif; ?>
      <div class="flex flex-col flex-grow p-4">
        <h3 class="mb-2 text-lg font-bold">
          <?php echo esc_html( esp_vacature_title() ); ?>
        </h3>
        <div class="flex flex-wrap gap-2 mb-3">
          <?php if ( get_field( 'uren' ) ) : ?>
            <span class="px-2 py-0.5 text-xs font-semibold rounded bg-gray2 text-secondary"><?php echo esc_html( get_field( 'uren' ) ); ?></span>
          <?php endif; ?>
          <span class="px-2 py-0.5 text-xs font-semibold rounded bg-gray2 text-secondary">Gennep</span>
          <?php if ( get_field( 'sluitingsdatum' ) ) : ?>
            <span class="px-2 py-0.5 text-xs font-semibold rounded bg-gray2 text-secondary">
              Reageren t/m <?php echo esc_html( date_i18n( 'j F', DateTime::createFromFormat( 'Ymd', get_field( 'sluitingsdatum' ) )->getTimestamp() ) ); ?>
            </span>
          <?php endif; ?>
        </div>
        <p class="flex-grow mb-4 line-clamp-3">
          <?php echo esc_html( has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 40 ) ); ?>
        </p>
        <span class="block font-bold underline transition duration-300 text-secondary underline-offset-4 group-hover:text-secondaryHover group-hover:decoration-[3px] group-hover:underline-offset-[3px]">
          Bekijk vacature
        </span>
      </div>
    </article>
  </a>
</li>
