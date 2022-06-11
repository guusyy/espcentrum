<section class="bg-gray1">
  <div class="container-xl mx-auto">
    <div class="grid grid-cols-12 gap-6 py-10 2xl:py-20 items-center">
      <div class="order-2 lg:order-1 col-span-full lg:col-start-1 lg:col-span-6 xl:col-start-2 xl:col-span-5">
        <h2 class="text-3xl font-bold mb-2"><?php echo $attributes['title']; ?></h2>
        <div class="rte mb-4">
        <?php echo $attributes['text']; ?>
        </div>
        <a class="btn" href="<?php echo esc_url( $attributes['button-url'] ); ?>"><?php echo $attributes['button-label']; ?></a>
      </div>
      <div class="order-1 lg:order-2 flex justify-center col-span-full lg:col-span-6 xl:col-span-5">
        <?php if ( isset( $attributes['image']['url'] ) ) : ?>
            <img class="w-full aspect-square object-contain max-w-[412px]" src="<?php echo esc_url( $attributes['image']['url'] ); ?>" alt="<?php echo esc_attr( $attributes['image']['alt'] ); ?>" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>