<section class="bg-[#ECFFF1] hover:bg-[#daf5e1] transition duration-500 overflow-hidden shadow mb-10">
    <a href="<?php echo $attributes['url']; ?>" class="group">
        <div class="relative w-full mx-auto container-base">
            <div class="grid grid-cols-12 lg:gap-x-10">
            <div class="lg:rows-start-1 col-span-full lg:col-start-1 lg:col-span-6">
                <div class="h-full py-6 lg:py-10 xl:py-14">
                <div class="flex items-center gap-5 mb-4 lg:mb-8">
                    <svg class="!w-[24px] !h-[22px] lg:!w-[46px] lg:!h-[43px]" width="50" height="47" viewBox="0 0 50 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.2286 46.0855L21.6367 42.8484C8.87944 31.3402 0.457153 23.7459 0.457153 14.4532C0.457153 6.85897 6.43945 0.914062 14.0814 0.914062C18.3917 0.914062 22.5285 2.90801 25.2286 6.04662C27.9287 2.90801 32.0655 0.914062 36.3757 0.914062C44.0177 0.914062 50 6.85897 50 14.4532C50 23.7459 41.5777 31.3402 28.8204 42.8484L25.2286 46.0855Z" fill="#01B132"/>
                    </svg>
                    <h2 class="!text-4xl font-bold leading-[1.1] text-themegreen !my-0"><?php echo $attributes['titel']; ?></h2>
                </div>
                <p><?php echo $attributes['tekst']; ?></p>
                </div>
            </div>
            <div class="relative row-start-1 col-span-full lg:col-start-7 lg:col-span-6">
                <div class="h-[200px] lg:h-[374px]">
                <div class="absolute bottom-0 left-0 z-50 hidden h-full lg:block">
                    <svg class="fill-[#ECFFF1] group-hover:fill-[#daf5e1] transition-all duration-500 z-50 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z"/>
                    </svg>
                </div>
                <div class="absolute left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 top-1/2 -translate-y-1/2 h-full w-screen lg:w-[calc(100%+260px)] overflow-hidden bg-themegreen/20">
                    <?php if ( isset( $attributes['afbeelding']['url'] ) ) : ?>
                        <?php echo wp_get_attachment_image( $attributes['afbeelding']['id'], array('910', '374'), "", array( "class" => "object-cover object-center w-full h-full group-hover:scale-[1.04] !duration-500 !transition-all" ) ); ?>
                    <?php endif; ?>
                </div>
                </div>
            </div>
            </div>
            <div class="absolute bottom-0 z-50 hidden h-full lg:block left-full">
            <svg class="fill-[#ECFFF1] group-hover:fill-[#daf5e1] transition-all duration-500 z-50 rotate-180 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" />
            </svg>
            </div>
        </div>
    </a>
</section>