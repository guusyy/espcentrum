<section>
  <div class="px-4 lg:px-10 py-16">
    <div class="grid grid-cols-12 gap-x-10 items-center">
      <div class="col-span-full mb-4">
        <h2 class="text-3xl font-bold mb-2 border-b-2 border-primary"><?php echo $attributes['title']; ?></h2>
      </div>
      <ul class="col-span-full grid grid-cols-2 gap-10">
        <?php 
          global $loop;
          
          $all_posts = array( 'post_type' => 'nieuws', 'posts_per_page' => 2, 'order' => 'DESC' );
          $loop = new WP_Query( $all_posts );

          if($loop->have_posts()){
            while($loop->have_posts()){
                  $loop->the_post();
              ?>

                <li class="group">
                  <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                    <article class="shadow rounded bg-white h-full overflow-hidden">
                      <div class="w-full max-h-[22.5rem] overflow-hidden flex items-center">
                        <?php the_post_thumbnail('medium_large', ['class' => 'group-hover:scale-[1.03] duration-[400ms] transition-all object-cover w-full']); ?>
                      </div>
                      <div class="p-4">
                        <h3 class="text-lg font-bold mb-1">
                          <?php the_title(); ?>
                        </h3>
                        <span class="block text-secondary font-semibold text-small mb-2">
                          <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                        </span>
                        <div class="mb-4">
                          <?php the_excerpt(); ?>
                        </div>
                        <span class="block text-secondary underline underline-offset-2">
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