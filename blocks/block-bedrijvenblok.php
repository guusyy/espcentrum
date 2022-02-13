<ul class="list-none grid grid-cols-1 md:grid-cols-2 gap-5">
  <?php 
    global $loop;
    
    $all_posts = array( 'post_type' => 'bedrijven', 'posts_per_page' => -1, 'order' => 'ASC' );
    $loop = new WP_Query( $all_posts );

    if($loop->have_posts()){
      while($loop->have_posts()){
            $loop->the_post();
        ?>

        <li>
          <div class="shadow-lg rounded-2xl bg-white flex flex-col p-4">
            <div class="flex align-center justify-center max-w-full p-4">
              <?php if( get_field('logo') ): ?>
                <?php $image = get_field('logo'); ?>
                <img 
                  class="object-contain max-w-full"
                  width="<?php echo $image['width']; ?>"
                  height="<?php echo $image['height']; ?>"
                  style="aspect-ratio: <?php echo $image['width']; ?> / <?php echo $image['height']; ?>" 
                  src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" 
                />
              <?php endif; ?>
            </div>
            <div class="flex flex-col justify-between gap-5 h-full">
              <div class="flex flex-col gap-5">
                <h3 class="text-xl font-bold">
                  <?php the_title(); ?>
                </h3>
                <?php if( get_field('beschrijving') ): ?>
                  <div class="m-0">
                    <?php the_field('beschrijving'); ?>
                  </div>
                <?php endif; ?>
                <table>
                  <?php if( get_field('email') ): ?>
                    <tr class="text-small">
                      <td class="font-semibold w-24">E-mail</td>
                      <td><a href="mailto:<?php the_field('email'); ?>" class="text-primary-important"><?php the_field('email'); ?></a></td>
                    </tr>
                  <?php endif; ?>
                  <?php if( get_field('website') ): ?>
                    <tr class="text-small">
                      <td class="font-semibold w-24">Website</td>
                      <td><a href="https://<?php the_field('website'); ?>" target="_blank" class="text-primary-important"><?php the_field('website'); ?></a></td>
                    </tr>
                  <?php endif; ?>
                  <?php if( get_field('Telefoonnummer') ): ?>
                    <tr class="text-small">
                      <td class="font-semibold w-24">Telefoon</td>
                      <td><a href="tel:<?php the_field('Telefoonnummer'); ?>" class="text-primary-important"><?php the_field('Telefoonnummer'); ?></a></td>
                    </tr>
                  <?php endif; ?>
                </table>
              </div>
            </div>
          </div>
        </li>
        
        <?php
      }
    }
    wp_reset_query();
  ?>
</ul>