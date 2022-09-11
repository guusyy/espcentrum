<section class="bg-[#ECF1FF] hover:bg-[#dee6f9] transition duration-500 overflow-hidden shadow mb-10">
    <a href="<?php echo $attributes['url']; ?>" class="group">
        <div class="relative w-full mx-auto container-base">
            <div class="grid grid-cols-12 lg:gap-x-10">
            <div class="lg:rows-start-1 col-span-full lg:col-start-1 lg:col-span-6">
                <div class="h-full py-6 lg:py-10 xl:py-14">
                <div class="flex items-center gap-5 mb-4 lg:mb-8">
                    <svg class="!w-[28px] !h-[36px] lg:!w-[53px] lg:!h-[46px]" width="53" height="47" viewBox="0 0 53 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M44.7958 15.4206L51.2261 32.2118C52.2017 34.7594 51.0119 37.6506 48.5821 38.6367L40.5194 41.9086C39.3266 42.3927 38.0093 42.3519 36.8439 41.808L24.6349 36.0854C24.6349 36.0854 25.4811 34.0963 25.5164 34.0553C25.6752 33.7366 25.929 33.4998 26.2604 33.3654C26.5033 33.2667 26.7508 33.2466 26.994 33.2817C27.0426 33.2754 32.8452 34.1986 32.8452 34.1986L27.5635 20.4067C27.1955 19.4456 27.6383 18.3694 28.555 17.9974C29.4718 17.6254 30.5089 18.1009 30.877 19.0621L33.9812 27.1682L35.0857 26.72L30.8728 15.7188C30.5047 14.7577 30.9476 13.6815 31.8643 13.3095C32.781 12.9375 33.8181 13.4131 34.1862 14.3742L38.3991 25.3753L39.5036 24.9271L35.7341 15.084C35.366 14.1229 35.8089 13.0467 36.7256 12.6747C37.6423 12.3027 38.6795 12.7782 39.0475 13.7394L42.817 23.5825L43.9215 23.1343L41.4824 16.7652C41.1143 15.8041 41.5572 14.7279 42.4739 14.3559C43.3906 13.9839 44.4278 14.4594 44.7958 15.4206Z" fill="#174399"/>
                        <path d="M7.85645 31.1219L1.69879 14.2228C0.764529 11.6588 2.00096 8.78838 4.44642 7.84412L12.5609 4.71091C13.7614 4.24736 15.0778 4.31072 16.2342 4.87456L28.3489 10.8056C28.3489 10.8056 27.4707 12.7799 27.4347 12.8204C27.2709 13.1363 27.0132 13.3687 26.6797 13.4975C26.4352 13.5919 26.1874 13.6078 25.9448 13.5685C25.8961 13.574 20.1093 12.5514 20.1093 12.5514L25.1671 26.432C25.5195 27.3993 25.0593 28.4677 24.1367 28.824C23.2141 29.1802 22.1848 28.6869 21.8323 27.7196L18.8597 19.5614L17.7481 19.9906L21.7824 31.0625C22.1349 32.0298 21.6747 33.0982 20.7521 33.4545C19.8295 33.8107 18.8002 33.3174 18.4477 32.3501L14.4134 21.2782L13.3018 21.7074L16.9115 31.6138C17.2639 32.5812 16.8037 33.6496 15.8811 34.0058C14.9585 34.3621 13.9292 33.8688 13.5767 32.9015L9.96708 22.9951L8.85551 23.4243L11.1912 29.8343C11.5436 30.8016 11.0834 31.87 10.1608 32.2263C9.2382 32.5825 8.20892 32.0892 7.85645 31.1219Z" fill="#174399"/>
                    </svg>

                    <h2 class="!text-4xl font-bold leading-[1.1] text-themeblue !my-0"><?php echo $attributes['titel']; ?></h2>
                </div>
                <p><?php echo $attributes['tekst']; ?></p>
                </div>
            </div>
            <div class="relative row-start-1 col-span-full lg:col-start-7 lg:col-span-6">
                <div class="h-[200px] lg:h-[374px]">
                    <div class="absolute bottom-0 left-0 z-50 hidden h-full lg:block">
                        <svg class="fill-[#ECF1FF] group-hover:fill-[#dee6f9] transition-all duration-500 z-50 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                            <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z"/>
                        </svg>
                    </div>
                    <div class="absolute left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 top-1/2 -translate-y-1/2 h-full w-screen lg:w-[calc(100%+247px)] overflow-hidden">
                        <?php if ( isset( $attributes['afbeelding']['url'] ) ) : ?>
                            <img 
                            class="object-cover object-center w-full h-full group-hover:scale-[1.04] !duration-500 !transition-all" 
                            src="<?php echo esc_url( $attributes['afbeelding']['url'] ); ?>" 
                            alt="<?php echo esc_attr( $attributes['afbeelding']['alt'] ); ?>"
                            />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </div>
            <div class="absolute bottom-0 z-50 hidden lg:block left-full h-full">
                <svg class="fill-[#ECF1FF] group-hover:fill-[#dee6f9] transition-all duration-500 z-50 rotate-180 h-full" width="247" height="374" viewBox="0 0 247 374" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M246.534 0.000224087L0.000366211 374V0.000213623L246.534 0.000224087Z" />
                </svg>
            </div>
        </div>
    </a>
</section>