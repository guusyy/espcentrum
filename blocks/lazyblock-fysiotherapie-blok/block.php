<section class="bg-[#FAF1FF] hover:bg-[#f0e6f5] transition duration-500 overflow-hidden shadow mb-10">
    <a href="<?php echo $attributes['url']; ?>" class="group">
        <div class="relative w-full mx-auto container-base">
            <div class="grid grid-cols-12 lg:gap-x-10">
            <div class="lg:rows-start-1 col-span-full lg:col-start-1 lg:col-span-6">
                <div class="h-full py-6 lg:py-10 xl:py-14">
                <div class="flex items-center gap-5 mb-4 lg:mb-8">
                    <svg class="!w-[15.7px] !h-[25px] lg:!w-[34px] lg:!h-[54px]" width="34" height="54" viewBox="0 0 34 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.5611 10.0465C22.4055 10.0465 24.7327 7.78605 24.7327 5.02326C24.7327 2.26047 22.4055 0 19.5611 0C16.7167 0 14.3895 2.26047 14.3895 5.02326C14.3895 7.78605 16.7167 10.0465 19.5611 10.0465ZM9.86442 18.586L2.75351 54H8.18366L12.7088 33.907L18.2682 38.9302V54H23.4398V35.0372L18.1389 29.8884L19.6904 22.3535C23.0519 26.3721 28.0942 28.8837 33.7829 28.8837V23.8605C28.9992 23.8605 24.862 21.3488 22.5348 17.707L20.0783 13.6884C19.1732 12.1814 17.4925 11.3023 15.6824 11.3023C15.036 11.3023 14.3895 11.4279 13.7431 11.6791L0.167725 17.0791V28.8837H5.33929V20.4698L9.86442 18.586Z" fill="#8221B9"/>
                    </svg>
                    <h2 class="!text-4xl font-bold leading-[1.1] text-themepurple !my-0"><?php echo $attributes['titel']; ?></h2>
                </div>
                <p><?php echo $attributes['tekst']; ?></p>
                </div>
            </div>
            <div class="relative row-start-1 col-span-full lg:col-start-7 lg:col-span-6">
                <div class="h-[200px] lg:h-[374px]">
                <div class="absolute bottom-0 left-0 z-50 hidden h-full lg:block">
                    <svg class="fill-[#FAF1FF] group-hover:fill-[#f0e6f5] transition-all duration-500 z-50 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z"/>
                    </svg>
                </div>
                <div class="absolute left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 top-1/2 -translate-y-1/2 h-full w-screen lg:w-[calc(100%+247px)] overflow-hidden">
                    <?php if ( isset( $attributes['afbeelding']['url'] ) ) : ?>
                        <img 
                        class="object-cover object-center w-full h-full group-hover:scale-[1.04] duration-500 transition-all" 
                        src="<?php echo esc_url( $attributes['afbeelding']['url'] ); ?>" 
                        alt="<?php echo esc_attr( $attributes['afbeelding']['alt'] ); ?>"
                        />
                    <?php endif; ?>
                </div>
                </div>
            </div>
            </div>
            <div class="absolute bottom-0 z-50 hidden lg:block left-full">
            <svg class="fill-[#FAF1FF] group-hover:fill-[#f0e6f5] transition-all duration-500 z-50 rotate-180 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" />
            </svg>
            </div>
        </div>
    </a>
</section>