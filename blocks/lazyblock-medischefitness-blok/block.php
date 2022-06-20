<section class="bg-[#FFEDED] hover:bg-[#ffe2e2] transition duration-500 overflow-hidden shadow mb-10">
    <a href="<?php echo $attributes['url']; ?>" class="group">
        <div class="relative w-full mx-auto container-base">
            <div class="grid grid-cols-12 lg:gap-x-10">
            <div class="lg:rows-start-1 col-span-full lg:col-start-1 lg:col-span-6">
                <div class="h-full py-6 lg:py-10 xl:py-14">
                <div class="flex items-center gap-5 mb-4 lg:mb-8">
                    <svg class="!w-[25px] !h-[25px] lg:!w-[46px] lg:!h-[46px]" width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50.139 34.722L54 30.861L50.139 27L40.5 36.639L17.361 13.5L27 3.861L23.139 0L19.278 3.861L15.417 0L9.639 5.778L5.778 1.917L1.917 5.778L5.778 9.639L0 15.417L3.861 19.278L0 23.139L3.861 27L13.5 17.361L36.639 40.5L27 50.139L30.861 54L34.722 50.139L38.583 54L44.361 48.222L48.222 52.083L52.083 48.222L48.222 44.361L54 38.583L50.139 34.722Z" fill="#C93438"/>
                    </svg>
                    <h2 class="!text-4xl font-bold leading-[1.1] text-themered !my-0"><?php echo $attributes['titel']; ?></h2>
                </div>
                <p><?php echo $attributes['tekst']; ?></p>
                </div>
            </div>
            <div class="relative row-start-1 col-span-full lg:col-start-7 lg:col-span-6">
                <div class="h-[200px] lg:h-[374px]">
                <div class="absolute bottom-0 left-0 z-50 hidden h-full lg:block">
                    <svg class="fill-[#FFEDED] group-hover:fill-[#ffe2e2] transition-all duration-500 z-50 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
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
            <svg class="fill-[#FFEDED] group-hover:fill-[#ffe2e2] transition-all duration-500 z-50 rotate-180 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" />
            </svg>
            </div>
        </div>
    </a>
</section>