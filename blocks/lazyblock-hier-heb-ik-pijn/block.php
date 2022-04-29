<section class="bg-gray1">
  <div class="container-xl mx-auto py-20">
    <div class="grid grid-cols-2 gap-10 items-center px-20">
      <div>
        <h2 class="text-3xl font-bold mb-2"><?php echo $attributes['title']; ?></h2>
        <div class="rte mb-8">
          <?php echo $attributes['text']; ?>
        </div>
        <button class="btn btn--outline" onclick="showCheckWidget('1858', '1', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'check&start=start')">
          <?php echo $attributes['button-label']; ?>
        </button>
        <script type="text/javascript" src="https://www.hierhebikpijn.nl/widget/js/hhip_widget-3.0.js?id=1858"></script>
        <br><br>
        In samenwerking met <a href='https://www.hierhebikpijn.nl/'>Hierhebikpijn.nl</a>
      </div>
      <div class="flex justify-center">
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