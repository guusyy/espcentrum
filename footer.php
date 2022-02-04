
</main>

<?php do_action( 'movida_theme_content_end' ); ?>

</div>

<?php do_action( 'movida_theme_content_after' ); ?>

<footer class="movida-footer bg-primary text-white text-small" role="contentinfo">
	<?php do_action( 'movida_theme_footer' ); ?>

  <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 my-10">
    <div>
      <?php if ( is_active_sidebar( 'footer-col-one' ) ) : ?>
        <?php dynamic_sidebar( 'footer-col-one' ); ?>
      <?php endif; ?>
    </div>
    <div>
      <?php if ( is_active_sidebar( 'footer-col-two' ) ) : ?>
        <?php dynamic_sidebar( 'footer-col-two' ); ?>
      <?php endif; ?>
    </div>
    <div>
      <?php if ( is_active_sidebar( 'footer-col-three' ) ) : ?>
        <?php dynamic_sidebar( 'footer-col-three' ); ?>
      <?php endif; ?>
    </div>
  </div>

	<div class="container mx-auto text-center pb-8">
    <div class="flex justify-between flex-col-reverse md:flex-row items-start border-t pt-8">
      <div class="flex gap-8 flex-col md:flex-row items-start">
        <?php echo date_i18n( 'Y' );?> <?php echo get_bloginfo( 'name' );?>
        <?php if ( is_active_sidebar( 'sub-footer' ) ) : ?>
          <?php dynamic_sidebar( 'sub-footer' ); ?>
        <?php endif; ?>
      </div>
      <div>
        Logo
      </div>
    </div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
