<section class="my-8">
    <h2><?php echo $attributes['titel']; ?></h2>
    <ul class="space-y-4 list-none">
        <?php 
            global $loop;
            
            $all_posts = array( 'post_type' => 'vestigingen', 'order' => 'ASC' );
            $loop = new WP_Query( $all_posts );

            if($loop->have_posts()){
            while($loop->have_posts()){
                    $loop->the_post();
                ?>
                <li class="">
                    <a class="!no-underline hover:!no-underline group" href="<?php echo get_field('google_maps_url'); ?>" aria-label="<?php echo get_field('titel'); ?>" target="_blank">
                        <article class="relative flex flex-col gap-1 px-4 py-3 transition bg-white border-2 rounded shadow border-gray2 group-focus:bg-gray2 hover:border-black hover:-translate-y-0.5 group-focus:border-black group-focus:-translate-y-0.5 duration-300">
                            <dl class="w-[calc(100%-4rem)]">
                                <dt class="sr-only">Naam</dt>
                                <dd class="text-lg font-semibold xl:text-xl text-dark"><?php echo get_field('naam'); ?></dd>
                                <dt class="sr-only">Straat en huisnummer</dt>
                                <dd class="text-base font-normal text-dark"><?php echo get_field('straat_en_huisnummer'); ?></dd>
                                <dt class="sr-only">Postcode en stad</dt>
                                <dd class="text-base font-normal text-dark"><?php echo get_field('postcode'); ?> <?php echo get_field('dorp_of_stad'); ?></dd>
                            </dl>
                            <svg class="absolute top-3 right-4" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 16H2V2H9V0H2C0.89 0 0 0.9 0 2V16C0 17.1 0.89 18 2 18H16C17.1 18 18 17.1 18 16V9H16V16ZM11 0V2H14.59L4.76 11.83L6.17 13.24L16 3.41V7H18V0H11Z" fill="#575757"/>
                            </svg>
                        </article>
                    </a>
                </li>
                <?php
            }
            }
            wp_reset_query();
        ?>
    </ul>
</section>