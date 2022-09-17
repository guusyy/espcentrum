<section>
  <div class="mx-auto my-20 container-xl">
    <div class="grid items-center grid-cols-12 lg:gap-x-10">
      <div class="mb-4 text-center col-span-full">
        <h2 class="text-3xl font-bold"><?php echo $attributes['title']; ?></h2>
      </div>
      <div class="col-span-full">
        <div class="flex items-center w-full gap-5">
          <button aria-label="previous-slide" class="w-8 swiper-prev shrink-0">
            <svg width="16" height="25" viewBox="0 0 16 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.4444 2.94444L12.5 0L0 12.5L12.5 25L15.4444 22.0556L5.88889 12.5L15.4444 2.94444Z" fill="#D97307"/>
            </svg>
          </button>
          <div class="swiper">
            <ul class="flex items-center w-full swiper-wrapper">
              
                <?php 
                  global $loop;
                  
                  $all_posts = array( 'post_type' => 'partners', 'meta_key' => 'toon_in_partnerweergave', 'order' => 'DESC' );
                  $loop = new WP_Query( $all_posts );
        
                  if($loop->have_posts()){
                    while($loop->have_posts()){
                          $loop->the_post();
                      ?>
                      <li class="swiper-slide group">
                        <a href="<?php echo get_field('partner_url'); ?>" aria-label="<?php the_title(); ?>" target="_blank">
                          <article class="">
                            <div class="flex items-center justify-center w-full">
                              <?php 
                                $image = get_field('logo');
                                if( !empty( $image ) ): ?>
                                  <?php echo wp_get_attachment_image( $image['id'], array('300', '180'), "", array( "class" => "max-h-[120px] max-w-[200px] lg:max-h-[150px] lg:max-w-[250px] xl:max-h-[180px] xl:max-w-[300px] object-contain" ) ); ?>
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
          <button aria-label="next-slide" class="w-8 swiper-next shrink-0">
            <svg class="ml-auto" width="16" height="25" viewBox="0 0 16 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M-0.000108461 22.0556L2.94434 25L15.4443 12.5L2.94434 -1.09278e-06L-0.000106791 2.94445L9.55545 12.5L-0.000108461 22.0556Z" fill="#D97307"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>