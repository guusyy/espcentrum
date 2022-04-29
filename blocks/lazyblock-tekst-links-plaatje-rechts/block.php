<section class="bg-gray1">
  <div class="container-xl mx-auto py-20">
    <div class="grid grid-cols-2 gap-10 items-center px-20">
      <div>
        <h2 class="text-3xl font-bold mb-2"><?php echo $attributes['title']; ?></h2>
        <div class="rte mb-8">
        <?php echo $attributes['text']; ?>
        </div>
        <a class="btn" href="<?php echo esc_url( $attributes['button-url'] ); ?>"><?php echo $attributes['button-label']; ?></a>
      </div>
      <div class="flex justify-center">
        <?php if ( isset( $attributes['image']['url'] ) ) : ?>
            <img class="w-full aspect-square object-contain max-w-[412px]" src="<?php echo esc_url( $attributes['image']['url'] ); ?>" alt="<?php echo esc_attr( $attributes['image']['alt'] ); ?>" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>