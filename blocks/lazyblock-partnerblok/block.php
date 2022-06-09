<section>
  <div class="container-xl mx-auto my-20">
    <div class="grid grid-cols-12 lg:gap-x-10 items-center">
      <div class="col-span-full mb-4 text-center">
        <h2 class="text-3xl font-bold"><?php echo $attributes['title']; ?></h2>
      </div>
      <div class="col-span-full">
        <div class="w-full flex items-center gap-5">
          <button aria-label="previous-slide" class="swiper-prev shrink-0 w-8">
            <svg width="16" height="25" viewBox="0 0 16 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.4444 2.94444L12.5 0L0 12.5L12.5 25L15.4444 22.0556L5.88889 12.5L15.4444 2.94444Z" fill="#D97307"/>
            </svg>
          </button>
          <div class="swiper">
            <ul class="swiper-wrapper flex items-center w-full">
              
                <?php 
                  global $loop;
                  
                  $all_posts = array( 'post_type' => 'partners', 'meta_key' => 'toon_in_partnerweergave', 'meta_value' => true, 'order' => 'DESC' );
                  $loop = new WP_Query( $all_posts );
        
                  if($loop->have_posts()){
                    while($loop->have_posts()){
                          $loop->the_post();
                      ?>
                      <li class="swiper-slide group">
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
          <button aria-label="next-slide" class="swiper-next shrink-0 w-8">
            <svg class="ml-auto" width="16" height="25" viewBox="0 0 16 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M-0.000108461 22.0556L2.94434 25L15.4443 12.5L2.94434 -1.09278e-06L-0.000106791 2.94445L9.55545 12.5L-0.000108461 22.0556Z" fill="#D97307"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>