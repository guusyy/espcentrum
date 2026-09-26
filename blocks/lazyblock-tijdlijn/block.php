<?php
  $stappen = is_array( $attributes['items'] ) ? $attributes['items'] : array();
  $labels  = array(
    'klaar'      => 'Klaar',
    'bezig'      => 'Nu bezig',
    'binnenkort' => 'Binnenkort',
  );
?>
<section class="py-10 lg:py-14">
  <div class="container-base esp-tijdlijn">
  <?php if ( $attributes['title'] ) : ?>
    <h2 class="mb-10 text-4xl font-bold text-brand-ochre"><?php echo esc_html( $attributes['title'] ); ?></h2>
  <?php endif; ?>

  <?php if ( $stappen ) : ?>
    <ol class="relative grid gap-10 lg:grid-flow-col lg:auto-cols-fr lg:gap-8">
      <span class="absolute left-[11px] top-3 bottom-3 w-0.5 bg-brand-olive lg:left-3 lg:right-3 lg:top-[11px] lg:bottom-auto lg:h-0.5 lg:w-auto" aria-hidden="true"></span>

      <?php foreach ( $stappen as $stap ) : ?>
        <?php $status = isset( $labels[ $stap['status'] ?? '' ] ) ? $stap['status'] : 'binnenkort'; ?>
        <li class="relative pl-12 lg:pl-0 lg:pt-14 esp-tijdlijn__stap esp-tijdlijn__stap--<?php echo esc_attr( $status ); ?>">
          <span class="absolute top-0 left-0 flex items-center justify-center w-6 h-6 rounded-full esp-tijdlijn__punt" aria-hidden="true">
            <?php if ( 'klaar' === $status ) : ?>
              <svg class="w-3.5 h-3.5" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8.5l3.2 3L13 4.5"/></svg>
            <?php endif; ?>
          </span>
          <?php if ( ! empty( $stap['moment'] ) ) : ?>
            <span class="block mb-1 font-semibold tracking-wide uppercase text-small text-brand-ochre"><?php echo esc_html( $stap['moment'] ); ?></span>
          <?php endif; ?>
          <?php if ( ! empty( $stap['titel'] ) ) : ?>
            <h3 class="mb-2"><?php echo esc_html( $stap['titel'] ); ?></h3>
          <?php endif; ?>
          <?php if ( ! empty( $stap['tekst'] ) ) : ?>
            <p class="mb-3"><?php echo esc_html( $stap['tekst'] ); ?></p>
          <?php endif; ?>
          <span class="inline-block px-3 py-0.5 font-semibold rounded-full text-small esp-tijdlijn__label"><?php echo esc_html( $labels[ $status ] ); ?></span>
        </li>
      <?php endforeach; ?>
    </ol>
  <?php endif; ?>
</div>
</section>
