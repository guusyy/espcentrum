
</main>

<?php do_action( 'movida_theme_content_end' ); ?>

</div>

<?php do_action( 'movida_theme_content_after' ); ?>

<footer id="colophon" class="site-footer bg-primary text-white text-small" role="contentinfo">
	<?php do_action( 'movida_theme_footer' ); ?>

  <div class="container mx-auto grid grid-cols-3 my-10">
    <div>
      <h2 class="font-bold mb-2">Direct naar</h2>
      <ul>
        <li>Over Movida</li>
        <li>Behandelteam</li>
        <li>Vergoeding & Aanmelding</li>
      </ul>
    </div>
    <div>
      <h2 class="font-bold mb-2">Programma's</h2>
      <ul>
        <li>Oncologie</li>
        <li>CVA</li>
      </ul>
    </div>
    <div>
      <h2 class="font-bold mb-2">Contact</h2>
      <div class="grid grid-cols-2">
        <ul>
          <li>Tel: 0485-516009</li>
          <li>info@movida.nl</li>
        </ul>
        <ul>
          <li>Langeweg 204</li>
          <li>6591XA Gennep</li>
        </ul>
      </div>
    </div>
  </div>

	<div class="container mx-auto text-center border-t py-8">
    <div class="flex justify-between">
      <div>
        <ul class="flex gap-8">
          <li>&copy; <?php echo date_i18n( 'Y' );?> <?php echo get_bloginfo( 'name' );?></li>
          <li>Privacybeleid</li>
          <li>Algemene voorwaarden</li>
        </ul>
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
