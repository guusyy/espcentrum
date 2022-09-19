<?php get_header(); ?>

<main class="flex-grow min-h-full bg-white">
  <section>
    <div class="py-16 mx-auto container-base">
      <div class="grid items-center grid-cols-12 lg:gap-x-10">

        <div class="flex items-center gap-10 pb-3 mb-12 border-b-2 col-span-full border-primary">
          <h2 class="text-3xl font-bold">Actueel</h2>
        </div>

        <?php if ( have_posts() ) : ?>
          <ul class="grid grid-cols-1 gap-5 col-span-full lg:grid-cols-2 lg:gap-10">
            <?php
              $counter = 0;
              while ( have_posts() ) :
                the_post();
              ?>
              <li>
                <a class="group" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                  <article class="h-full overflow-hidden transition duration-300 bg-white border-2 rounded shadow border-gray2 group-hover:border-black">
                    <?php if ( $counter < 2 ) : ?>
                      <div class="w-full min-h-[15.5rem] max-h-[15.5rem] overflow-hidden flex items-center bg-gray3">
                        <?php the_post_thumbnail('medium_large', ['class' => 'group-hover:scale-[1.03] group-focus:scale-[1.03] duration-[400ms] transition-all object-cover object-top w-full aspect-[339/152]']); ?>
                      </div>
                    <?php endif; ?>
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
                      <span class="block font-bold underline transition duration-300 text-secondary underline-offset-4 group-hover:text-secondaryHover group-hover:decoration-[3px] group-hover:underline-offset-[3px]">
                        Lees meer
                      </span>
                    </div>
                  </article>
                </a>
              </li>
              <?php $counter++; ?>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
