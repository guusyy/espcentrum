<section class="bg-gray1">
  <div class="container-xl mx-auto">
    <div class="grid grid-cols-12 gap-6 py-10 lg:py-20 items-center">
      <div class="order-2 lg:order-1 col-span-full lg:col-start-1 lg:col-span-6 xl:col-start-2 xl:col-span-5">
        <h2 class="text-3xl font-bold mb-2"><?php echo $attributes['title']; ?></h2>
        <div class="rte mb-8">
          <?php echo $attributes['text']; ?>
        </div>
        <button class="btn btn--outline" onclick="showCheckWidget('1858', '1', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'check&start=start')">
          <?php echo $attributes['button-label']; ?>
        </button>
        <script type="text/javascript" src="https://www.hierhebikpijn.nl/widget/js/hhip_widget-3.0.js?id=1858"></script>
      </div>
      <div class="order-1 lg:order-2 flex justify-center col-span-full lg:col-span-6 xl:col-span-5">
        <?php if ( isset( $attributes['image']['url'] ) ) : ?>
            <img 
              class="w-full aspect-square object-contain max-w-[412px] cursor-pointer" 
              src="<?php echo esc_url( $attributes['image']['url'] ); ?>" 
              alt="<?php echo esc_attr( $attributes['image']['alt'] ); ?>"
              onclick="showCheckWidget('1858', '1', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'check&start=start')"
            />
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>