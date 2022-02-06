<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-12' ); ?>>

  <?php if ( !is_front_page() ) : ?>
    <header class="entry-header mb-4">
      <?php the_title( sprintf( '<h1 class="entry-title text-primary text-2xl md:text-3xl font-extrabold leading-tight mb-1"><span class="border-b-2 border-secondary">', esc_url( get_permalink() ) ), '</span></h1>' ); ?>
    </header>
  <?php endif; ?>

	<?php if ( is_search() || is_archive() ) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	<?php else : ?>

		<div class="entry-content">
			<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading %s', 'tailpress' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tailpress' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tailpress' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
			?>
		</div>

	<?php endif; ?>

</article>
