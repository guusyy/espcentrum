<section class="bg-gray1">
  <div class="mx-auto container-xl">
    <div class="grid items-center grid-cols-12 gap-6 py-10 2xl:py-20">
      <div class="order-2 lg:order-1 col-span-full lg:col-start-1 lg:col-span-6 xl:col-start-2 xl:col-span-5">
        <h2 class="mb-2 text-3xl font-bold"><?php echo $attributes['title']; ?></h2>
        <div class="mb-4 rte">
        <?php echo $attributes['text']; ?>
        </div>
        <a class="btn" href="<?php echo esc_url( $attributes['button-url'] ); ?>"><?php echo $attributes['button-label']; ?></a>
        <?php if ($attributes['button-2-label']) : ?>
          <a class="mt-4 ml-0 btn btn--outline lg:mt-0 lg:ml-2" href="<?php echo esc_url( $attributes['button-2-url'] ); ?>"><?php echo $attributes['button-2-label']; ?></a>
        <?php endif; ?>
      </div>
      <div class="flex justify-center order-1 lg:order-2 col-span-full lg:col-span-6 xl:col-span-5">
        <?php if ( isset( $attributes['image']['url'] ) ) : ?>
          <?php echo wp_get_attachment_image( $attributes['image']['id'], array('412', '412'), "", array( "class" => "w-full aspect-square object-contain max-w-[412px]" ) ); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>