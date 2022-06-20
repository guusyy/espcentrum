<section class="bg-gray1 scroll-mt-24" id="hierhebikpijn">
  <div class="mx-auto container-xl">
    <div class="grid items-center grid-cols-12 gap-6 py-10 2xl:py-14">
      <div class="order-2 lg:order-1 col-span-full lg:col-start-1 lg:col-span-6 xl:col-start-2 xl:col-span-5">
        <h2 class="mb-2 text-3xl font-bold"><?php echo $attributes['title']; ?></h2>
        <div class="mb-4 rte">
          <?php echo $attributes['text']; ?>
        </div>
        <button class="btn btn--outline" onclick="showCheckWidget('1858', '1', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'check&start=start')">
          <?php echo $attributes['button-label']; ?>
        </button>
        <script type="text/javascript" src="https://www.hierhebikpijn.nl/widget/js/hhip_widget-3.0.js?id=1858"></script>
      </div>
      <div class="flex justify-center order-1 lg:order-2 col-span-full lg:col-span-6 xl:col-span-5">
        <?php if ( isset( $attributes['image']['url'] ) ) : ?>
            <img 
              class="w-full aspect-square object-contain max-w-[380px] cursor-pointer" 
              src="<?php echo esc_url( $attributes['image']['url'] ); ?>" 
              alt="<?php echo esc_attr( $attributes['image']['alt'] ); ?>"
              onclick="showCheckWidget('1858', '1', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'check&start=start')"
            />
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>