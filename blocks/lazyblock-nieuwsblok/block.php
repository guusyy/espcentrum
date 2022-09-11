<section>
  <div class="py-16 container-base">
    <div class="grid items-center grid-cols-12 lg:gap-x-10">
      <div class="flex items-center gap-10 pb-3 mb-4 border-b-2 col-span-full border-primary">
        <h2 class="text-3xl font-bold"><?php echo $attributes['title']; ?></h2>
        <a href="<?php echo $attributes['button-url']; ?>" class="hidden btn btn--outline lg:inline-block"><?php echo $attributes['button-label']; ?></a>
      </div>
      <ul class="grid grid-cols-1 gap-5 col-span-full lg:grid-cols-2 lg:gap-10">
        <?php 
          global $loop;
          
          $all_posts = array( 'post_type' => 'nieuws', 'meta_key' => 'toon_in_uitgelicht_nieuws', 'posts_per_page' => 2, 'order' => 'DESC' );
          $loop = new WP_Query( $all_posts );

          if($loop->have_posts()){
            while($loop->have_posts()){
                  $loop->the_post();
              ?>

                <li>
                  <a class="group" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                    <article class="h-full transition duration-300 bg-white border-2 rounded shadow overf low-hidden group-hover:border-black border-gray2">
                      <div class="w-full max-h-[15.5rem] overflow-hidden flex items-center">
                        <?php the_post_thumbnail('medium_large', ['class' => 'group-hover:scale-[1.03] group-focus:scale-[1.03] duration-[400ms] transition-all object-cover w-full aspect-[339/152]']); ?>
                      </div>
                      <div class="p-4">
                        <h3 class="mb-1 text-lg font-bold">
                          <?php the_title(); ?>
                        </h3>
                        <span class="block mb-2 font-semibold text-secondary text-small">
                          <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                        </span>
                        <div class="mb-4 line-clamp-3">
                          <?php 
                            $str= wp_strip_all_tags(get_the_content());
                            echo $str1= substr ($str,0,500);
                          ?> 
                        </div>
                        <span class="block font-bold underline transition duration-300 text-secondary underline-offset-4 group-hover:text-secondaryHover group-hover:underline-offset-2 group-hover:decoration-[3px]">
                          Lees meer
                        </span>
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
      <div class="my-8 lg:hidden col-span-full">
        <a href="<?php echo $attributes['button-url']; ?>" class="btn btn--outline"><?php echo $attributes['button-label']; ?></a>
      </div>
    </div>
  </div>
</section>