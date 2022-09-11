<section id="medewerkers" class="py-10 mt-10 scroll-mt-16 2xl:py-16 bg-gray2">
    <div class="container-xl">
        <h2 class="mb-10 font-bold text-center text-m3xl xl:text-3xl">Ons team</h2>

        <div medewerkers-container class="relative !max-h-[min(70vh,_1000px)] overflow-hidden transition-all duration-1000">

            <ul class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-x-4 gap-y-8">
                <?php 
                    global $loop;
                    
                    $all_posts = array( 'post_type' => 'medewerkers', 'order' => 'ASC', 'posts_per_page'=>-1 );
                    $loop = new WP_Query( $all_posts );
        
                    if($loop->have_posts()){
                        while($loop->have_posts()){
                                $loop->the_post();
                            ?>
                            <li class="group">
                                <article class="">
                                    <div class="w-full">
                                        <div class="relative w-full">
                                            <?php 
                                                $image = get_field('foto_2');
                                                
                                                if( !empty( $image ) ): ?>
                                                    <?php echo wp_get_attachment_image( $image['id'], array('278', '310'), "", array( "class" => "absolute top-0 left-0 z-10 w-full h-full transition duration-300 rounded opacity-0 object-cover group-focus:opacity-100 group-hover:opacity-100" ) ); ?>
                                                <?php endif; ?>
                                            <?php 
                                                $image = get_field('foto');
                                                
                                                if( !empty( $image ) ): ?>
                                                    <?php echo wp_get_attachment_image( $image['id'], array('278', '310'), "", array( "class" => "w-full rounded aspect-[386/430] object-cover" ) ); ?>
                                                <?php endif; ?>
                                        </div>
                                        <div class="py-4">
                                            <h3 class="mb-2 font-semibold text-mxl 2xl:text-xl"><?php echo get_field('naam'); ?></h3>
                                            <?php if( get_field('big-nummer') ): ?>
                                                <span class="block text-gray5 px-2.5 lg:leading-snug text-xs rounded lg:text-small border border-gray5 w-fit mb-2 leading-snug">BIG-nummer: <span class="whitespace-nowrap"><?php echo get_field('big-nummer'); ?></span></span>
                                            <?php endif; ?>
                                            <?php if( get_field('nro-nummer') ): ?>
                                                <span class="block text-gray5 px-2.5 lg:leading-snug text-xs rounded lg:text-small border border-gray5 w-fit mb-2 leading-snug">Lidnummer NRO: <span class="whitespace-nowrap"><?php echo get_field('nro-nummer'); ?></span></span>
                                            <?php endif; ?>
                                            <span class="block text-xs leading-snug lg:leading-snug text-gray5 lg:text-small"><?php echo get_field('functies'); ?></span>
                                        </div>
                                    </div>
                                </article>
                            </li>
                            <?php
                        }
                    }
                    wp_reset_query();
                ?>
            </ul>

            <figure medewerkers-overlay>
                <div class="absolute bottom-0 left-0 z-40 w-full h-1/2 bg-gradient-to-t from-gray2 to-transparent">

                </div>
            </figure>

            <div class="sticky z-50 bottom-5">
                <button medewerkers-show class="sticky z-50 flex items-center -translate-x-1/2 btn btn--outline left-1/2 group w-fit">
                    Alle medewerkers
                    <svg class="ml-2 transition duration-500 group-hover:translate-y-1"  width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.53111 3.68813e-07L-2.83023e-07 1.52518L6.5 8L13 1.52518L11.4689 -6.5581e-08L6.5 4.94964L1.53111 3.68813e-07Z" fill="black"/>
                    </svg>
                </button>
    
                <button medewerkers-hide class="sticky z-50 flex items-center hidden -translate-x-1/2 btn btn--outline left-1/2 group w-fit">
                    Verberg medewerkers
                    <svg class="ml-2 transition duration-500 rotate-180 group-hover:translate-y-1"  width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.53111 3.68813e-07L-2.83023e-07 1.52518L6.5 8L13 1.52518L11.4689 -6.5581e-08L6.5 4.94964L1.53111 3.68813e-07Z" fill="black"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>