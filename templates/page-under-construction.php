<?php
/*
Template Name: Nieuwe huisstijl
Template Post Type: page
*/
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<main class="flex-grow brand-page">
  <?php
    // Huisstijlblokken zijn elk een eigen sectie, andere blokken komen samen in een contentsectie.
    $sectie_blokken = esp_huisstijl_blokken();
    $content        = array();

    $toon_content = function () use ( &$content ) {
      if ( ! $content ) {
        return;
      }
      echo '<section class="py-16 lg:py-24"><div class="brand-content container-base">';
      echo apply_filters( 'the_content', serialize_blocks( $content ) );
      echo '</div></section>';
      $content = array();
    };

    foreach ( parse_blocks( get_the_content() ) as $block ) {
      if ( in_array( $block['blockName'], $sectie_blokken, true ) ) {
        $toon_content();
        echo render_block( $block );
      } elseif ( $block['blockName'] || trim( $block['innerHTML'] ) ) {
        $content[] = $block;
      }
    }
    $toon_content();
  ?>
</main>

<?php endwhile; ?>

<?php
get_footer();
