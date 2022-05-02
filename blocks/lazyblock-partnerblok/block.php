<section>
  <div class="container-xl mx-auto my-20">
    <div class="grid grid-cols-12 gap-x-10 items-center">
      <div class="col-span-full mb-4 text-center">
        <h2 class="text-3xl font-bold"><?php echo $attributes['title']; ?></h2>
      </div>
      <div class="grid col-span-full w-full swiper">
        <!-- Additional required wrapper -->
        <ul class="swiper-wrapper">
          
            <?php 
              global $loop;
              
              $all_posts = array( 'post_type' => 'partners', 'meta_key' => 'toon_in_partnerweergave', 'meta_value' => true, 'order' => 'DESC' );
              $loop = new WP_Query( $all_posts );
    
              if($loop->have_posts()){
                while($loop->have_posts()){
                      $loop->the_post();
                  ?>
                  <li class="swiper-slide group flex justify-center items-center">
                    <a href="<?php echo get_field('partner_url'); ?>" aria-label="<?php the_title(); ?>">
                      <article class="">
                        <div class="w-full flex items-center justify-center">
                          <?php 
                            $image = get_field('logo');
                            if( !empty( $image ) ): ?>
                                <img class="max-h-[180px] max-w-[300px]" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                          <?php endif; ?>
                        </div>
                      </article>
                    </a>
                  </li>
                  <?php
                }
              }
              wp_reset_query();
            ?>
        </ul>
      </div>
    </div>
  </div>
</section>