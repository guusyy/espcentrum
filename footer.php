<?php do_action('espcentrum_theme_content_end'); ?>

</div>

<?php do_action('espcentrum_theme_content_after'); ?>

<footer class="border-t espcentrum-footer bg-gray2 text-small border-primary" role="contentinfo">
  <?php do_action('espcentrum_theme_footer'); ?>

  <div class="grid grid-cols-1 gap-8 py-10 mx-auto main-footer container-xl lg:grid-cols-12">
    <div class="lg:col-span-4">
      <?php if (is_active_sidebar('footer-col-one')) : ?>
        <?php dynamic_sidebar('footer-col-one'); ?>
      <?php endif; ?>
    </div>
    <div class="lg:col-span-3 xl:col-span-2 xl:col-start-6">
      <?php if (is_active_sidebar('footer-col-two')) : ?>
        <?php dynamic_sidebar('footer-col-two'); ?>
      <?php endif; ?>
    </div>
    <div class="lg:col-span-3 xl:col-span-2">
      <?php if (is_active_sidebar('footer-col-three')) : ?>
        <?php dynamic_sidebar('footer-col-three'); ?>
      <?php endif; ?>
    </div>
    <div class="lg:col-span-2 xl:col-start-11">
      <?php if (is_active_sidebar('footer-col-four')) : ?>
        <?php dynamic_sidebar('footer-col-four'); ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="pb-8 mx-auto text-center container-xl">
    <div class="flex flex-col-reverse items-start justify-between pt-8 border-t lg:items-center lg:flex-row border-gray4">
      <div class="flex flex-col items-start lg:gap-8 lg:flex-row">
        <span class="border-r lg:border-gray5 lg:pr-5">
          ©
          <?php echo date_i18n('Y'); ?> ESP Centrum
        </span>
        <?php if (is_active_sidebar('sub-footer')) : ?>
          <?php dynamic_sidebar('sub-footer'); ?>
        <?php endif; ?>
      </div>
      <div class="flex items-center">
        <ul class="flex gap-2">
          <li>
            <a href="https://nl-nl.facebook.com/espcentrum/" target="_blank">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_472_1577)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0678 0C22.6861 0 24 1.31391 24 2.93222V21.0678C24 22.6861 22.6861 24 21.0678 24H16.0771V14.9571H19.199L19.793 11.0843H16.0771V8.57095C16.0771 7.51144 16.5961 6.47864 18.2605 6.47864H19.95V3.18145C19.95 3.18145 18.4167 2.9198 16.9508 2.9198C13.8905 2.9198 11.8902 4.77459 11.8902 8.13248V11.0843H8.48836V14.9571H11.8902V24H2.93222C1.31391 24 0 22.6861 0 21.0678V2.93222C0 1.31391 1.31386 0 2.93222 0H21.0678V0Z" fill="#575757" />
                </g>
                <defs>
                  <clipPath id="clip0_472_1577">
                    <rect width="24" height="24" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/espcentrum/" target="_blank">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_472_1575)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0678 0C22.6861 0 24 1.31391 24 2.93222V21.0678C24 22.6861 22.6861 24 21.0678 24H2.93222C1.31391 24 0 22.6861 0 21.0678V2.93222C0 1.31391 1.31386 0 2.93222 0H21.0678V0ZM12 3.79688C9.77217 3.79688 9.4928 3.8063 8.61788 3.84623C7.74473 3.88608 7.14844 4.02473 6.62662 4.22756C6.08719 4.43719 5.62973 4.71769 5.17369 5.17369C4.71764 5.62973 4.43714 6.08723 4.22752 6.62662C4.02473 7.14844 3.88608 7.74473 3.84619 8.61788C3.8063 9.4928 3.79688 9.77217 3.79688 12C3.79688 14.2278 3.8063 14.5072 3.84619 15.3821C3.88608 16.2553 4.02473 16.8516 4.22752 17.3734C4.43714 17.9128 4.71764 18.3703 5.17369 18.8263C5.62973 19.2824 6.08719 19.5629 6.62662 19.7725C7.14844 19.9753 7.74473 20.1139 8.61788 20.1538C9.4928 20.1937 9.77217 20.2031 12 20.2031C14.2278 20.2031 14.5072 20.1937 15.3821 20.1538C16.2553 20.1139 16.8516 19.9753 17.3734 19.7725C17.9128 19.5629 18.3703 19.2824 18.8263 18.8263C19.2824 18.3703 19.5629 17.9128 19.7725 17.3734C19.9753 16.8516 20.1139 16.2553 20.1538 15.3821C20.1937 14.5072 20.2031 14.2278 20.2031 12C20.2031 9.77217 20.1937 9.4928 20.1538 8.61788C20.1139 7.74473 19.9753 7.14844 19.7725 6.62662C19.5629 6.08723 19.2824 5.62973 18.8263 5.17369C18.3703 4.71769 17.9128 4.43719 17.3734 4.22756C16.8516 4.02473 16.2553 3.88608 15.3821 3.84623C14.5072 3.8063 14.2278 3.79688 12 3.79688V3.79688ZM12 5.27494C14.1903 5.27494 14.4498 5.28328 15.3148 5.32275C16.1145 5.35927 16.5489 5.49291 16.838 5.60517C17.2209 5.754 17.4941 5.9318 17.7812 6.21881C18.0683 6.50587 18.246 6.77916 18.3948 7.16203C18.5071 7.45111 18.6408 7.88545 18.6772 8.68523C18.7167 9.55022 18.7251 9.80967 18.7251 12C18.7251 14.1903 18.7167 14.4498 18.6772 15.3148C18.6408 16.1145 18.5071 16.5489 18.3948 16.838C18.246 17.2209 18.0683 17.4941 17.7812 17.7812C17.4941 18.0683 17.2209 18.246 16.838 18.3948C16.5489 18.5071 16.1145 18.6408 15.3148 18.6772C14.4499 18.7167 14.1905 18.7251 12 18.7251C9.80953 18.7251 9.55013 18.7167 8.68523 18.6772C7.88545 18.6408 7.45111 18.5071 7.16203 18.3948C6.77911 18.246 6.50587 18.0683 6.21881 17.7812C5.93175 17.4941 5.75395 17.2209 5.60517 16.838C5.49286 16.5489 5.35922 16.1145 5.3227 15.3148C5.28323 14.4498 5.27489 14.1903 5.27489 12C5.27489 9.80967 5.28323 9.55022 5.3227 8.68523C5.35922 7.88545 5.49286 7.45111 5.60517 7.16203C5.75395 6.77916 5.93175 6.50587 6.21881 6.21881C6.50587 5.9318 6.77911 5.754 7.16203 5.60517C7.45111 5.49291 7.88545 5.35927 8.68523 5.32275C9.55022 5.28328 9.80967 5.27494 12 5.27494V5.27494ZM12 7.78758C9.67355 7.78758 7.78758 9.67355 7.78758 12C7.78758 14.3265 9.67355 16.2124 12 16.2124C14.3265 16.2124 16.2124 14.3265 16.2124 12C16.2124 9.67355 14.3265 7.78758 12 7.78758ZM12 14.7344C10.4898 14.7344 9.26564 13.5102 9.26564 12C9.26564 10.4898 10.4898 9.26564 12 9.26564C13.5102 9.26564 14.7344 10.4898 14.7344 12C14.7344 13.5102 13.5102 14.7344 12 14.7344V14.7344ZM17.3632 7.62117C17.3632 8.16483 16.9225 8.6055 16.3788 8.6055C15.8352 8.6055 15.3945 8.16483 15.3945 7.62117C15.3945 7.07752 15.8352 6.6368 16.3788 6.6368C16.9225 6.6368 17.3632 7.07752 17.3632 7.62117Z" fill="#575757" />
                </g>
                <defs>
                  <clipPath id="clip0_472_1575">
                    <rect width="24" height="24" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </a>
          </li>
          <li>
            <a href="https://nl.linkedin.com/company/esp-centrum-voor-gezondheid-en-sport" target="_blank">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_472_1573)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0678 0C22.6861 0 24 1.31391 24 2.93222V21.0678C24 22.6861 22.6861 24 21.0678 24H2.93222C1.31391 24 0 22.6861 0 21.0678V2.93222C0 1.31391 1.31386 0 2.93222 0H21.0678V0ZM7.52161 19.8412V9.26067H4.00411V19.8412H7.52161ZM20.2031 19.8412V13.7737C20.2031 10.5237 18.4679 9.01186 16.154 9.01186C14.2882 9.01186 13.4524 10.038 12.9845 10.7587V9.26067H9.46786C9.5145 10.2535 9.46786 19.8412 9.46786 19.8412H12.9844V13.9323C12.9844 13.616 13.0072 13.2998 13.1004 13.0738C13.3542 12.4421 13.9332 11.7878 14.9048 11.7878C16.1768 11.7878 16.6864 12.7584 16.6864 14.1802V19.8412H20.2031ZM5.78662 4.15884C4.58316 4.15884 3.79688 4.95005 3.79688 5.98706C3.79688 7.00228 4.55925 7.81528 5.74008 7.81528H5.76277C6.98925 7.81528 7.7527 7.00228 7.7527 5.98706C7.72997 4.9515 6.99141 4.16109 5.78662 4.15884Z" fill="#575757" />
                </g>
                <defs>
                  <clipPath id="clip0_472_1573">
                    <rect width="24" height="24" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>

</div>

<?php wp_footer(); ?>
<script data-goatcounter="https://espcentrum.goatcounter.com/count" async src="//gc.zgo.at/count.js"></script>
</body>

</html>