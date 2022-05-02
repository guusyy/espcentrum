<section>
  <div class="px-4 lg:px-10 py-16">
    <div class="grid grid-cols-12 gap-x-10 items-center">
      <div class="col-span-full mb-4 pb-3 border-b-2 border-primary flex items-center gap-10">
        <h2 class="text-3xl font-bold"><?php echo $attributes['title']; ?></h2>
        <a href="<?php echo $attributes['button-url']; ?>" class="btn btn--outline"><?php echo $attributes['button-label']; ?></a>
      </div>
      <ul class="col-span-full grid grid-cols-2 gap-10">
        <?php 
          global $loop;
          
          $all_posts = array( 'post_type' => 'nieuws', 'meta_key' => 'toon_in_uitgelicht_nieuws', 'meta_value' => true, 'posts_per_page' => 2, 'order' => 'DESC' );
          $loop = new WP_Query( $all_posts );

          if($loop->have_posts()){
            while($loop->have_posts()){
                  $loop->the_post();
              ?>

                <li class="group">
                  <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                    <article class="shadow rounded bg-white h-full overflow-hidden">
                      <div class="w-full max-h-[22.5rem] overflow-hidden flex items-center">
                        <?php the_post_thumbnail('medium_large', ['class' => 'group-hover:scale-[1.03] group-focus:scale-[1.03] duration-[400ms] transition-all object-cover w-full']); ?>
                      </div>
                      <div class="p-4">
                        <h3 class="text-lg font-bold mb-1">
                          <?php the_title(); ?>
                        </h3>
                        <span class="block text-secondary font-semibold text-small mb-2">
                          <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                        </span>
                        <div class="mb-4 line-clamp-3">
                          <?php 
                            $str= get_the_content();
                            echo $str1= substr ($str,0,500);
                          ?> 
                        </div>
                        <span class="block text-secondary font-bold underline underline-offset-4">
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
    </div>
  </div>
</section>