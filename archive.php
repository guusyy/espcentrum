<?php
/*
Template Name: Boxed page layout
Template Post Type: post, page, product, programma
*/
?>

<?php get_header(); ?>

<main class="bg-white min-h-full flex-grow">
  <section>
    <div class="container-base mx-auto py-16">
      <div class="grid grid-cols-12 gap-x-10 items-center">

        <div class="col-span-full mb-12 pb-3 border-b-2 border-primary flex items-center gap-10">
          <h2 class="text-3xl font-bold">Actueel</h2>
        </div>

        <?php if ( have_posts() ) : ?>
          <ul class="col-span-full grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-10">
            <?php
              $counter = 0;
              while ( have_posts() ) :
                the_post();
              ?>
              <li class="group">
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                  <article class="shadow rounded bg-white h-full overflow-hidden">
                    <?php if ( $counter < 2 ) : ?>
                      <div class="w-full max-h-[22.5rem] overflow-hidden flex items-center">
                        <?php the_post_thumbnail('medium_large', ['class' => 'group-hover:scale-[1.03] group-focus:scale-[1.03] duration-[400ms] transition-all object-cover w-full']); ?>
                      </div>
                    <?php endif; ?>
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
