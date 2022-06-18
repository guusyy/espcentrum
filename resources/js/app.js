// Navigation toggle
window.addEventListener('load', function () {

  const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

  let main_navigation = document.querySelector('#navigation-menu');

  document.querySelector('#primary-menu-toggle').addEventListener('click', function (e) {
    e.preventDefault();
    e.currentTarget.classList.toggle("active-menu");
    main_navigation.classList.toggle('hidden');

    anime({
      targets: main_navigation.querySelectorAll('#primary-menu > ul > li'),
      opacity: [0, 1],
      translateY: [10, 0],
      delay: anime.stagger(100) // increase delay by 100ms for each elements.
    });

    // Create a timeline with default parameters
    var tl = anime.timeline({
      easing: 'easeOutExpo',
      complete: () => {
        //reset styles on complete
        [...main_navigation.querySelectorAll('#primary-menu > ul > li'),
        ...main_navigation.querySelectorAll('#cta-menu > ul > li'),
        ...main_navigation.querySelectorAll('[top-nav-items] > li'),
        ...main_navigation.querySelectorAll('[social-items]')].forEach(elem => elem.style = "")
      }
    });

    // Add children
    tl
      .add({
        targets: main_navigation.querySelectorAll('#primary-menu > ul > li'),
        opacity: [0, 1],
        translateY: [10, 0],
        delay: anime.stagger(100) // increase delay by 100ms for each elements.
      })
      .add({
        targets: main_navigation.querySelectorAll('#cta-menu > ul > li'),
        opacity: [0, 1],
        translateY: [10, 0],
      }, '-=800')
      .add({
        targets: main_navigation.querySelectorAll('[top-nav-items] > li'),
        opacity: [0, 1],
        translateY: [10, 0],
        delay: anime.stagger(100) // increase delay by 100ms for each elements.
      }, '-=1000')
      .add({
        targets: main_navigation.querySelectorAll('[social-items]'),
        opacity: [0, 1],
        translateY: [10, 0],
      }, '-=1000')
  });

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href'))?.scrollIntoView({
        behavior: 'smooth'
      });
    });
  });

  document.querySelectorAll('.menu-item-has-children').forEach(menuItem => {
    menuItem.addEventListener('click', function (e) {
      e.currentTarget.classList.toggle('espcentrum-open');
    })
  })

  document.querySelectorAll('[toggle-open]')?.forEach(button => {
    button.addEventListener('click', () => {
      const group = button.closest('.group');

      group?.toggleAttribute('open');

      anime({
        targets: group.querySelectorAll('.sidebarmenu > li'),
        opacity: [0, 1],
        translateY: [10, 0],
        delay: anime.stagger(100) // increase delay by 100ms for each elements.
      });
    })
  });

  // NAVIGATION SCROLL

  var lastScrollTop = 0;

  // STICKY NAVIGATION THAT HIDES TOPBAR (NOT FOR SAFARI DUE TO BUG)
  if (!isSafari) {
    window.addEventListener('scroll', function () {
      var header = document.querySelector('.espcentrum-header');
  
      var st = window.pageYOffset || document.documentElement.scrollTop;
      if (st > lastScrollTop) {
        header.classList.toggle("espcentrum-sticky", window.scrollY > 0);
      } else {
        header.classList.remove("espcentrum-sticky");
      }
      lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
    })
  }

  // SWIPER INIT

  const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    spaceBetween: 19,
    centerSlider: true,
    slidesPerView: 1,
    draggable: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-next',
      prevEl: '.swiper-prev',
    },
    // Responsive breakpoints
    breakpoints: {
      // when window width is >= 320px
      640: {
        slidesPerView: 1,
      },
      // when window width is >= 480px
      768: {
        slidesPerView: 2,
      },
      // when window width is >= 640px
      1010: {
        slidesPerView: 3,
      }
    }
  });

  // MEDEWERKERS SHOW ALL OR HIDE ALL

  [...document.querySelectorAll('[medewerkers-show]')].forEach(button => {
    button.addEventListener('click', () => {
      const hideButton = document.querySelector('[medewerkers-hide]');
      const overlay = document.querySelector('[medewerkers-overlay]');
      const container = document.querySelector('[medewerkers-container]');
      const contentHeight = container.querySelector('ul').clientHeight + button.clientHeight;

      button.classList.add('hidden');
      hideButton.classList.remove('hidden');
      overlay.classList.add('hidden');
      container.classList.remove('!max-h-[min(70vh,_1000px)]', 'overflow-hidden');
      container.style.maxHeight = contentHeight + 'px';

      hideButton.addEventListener('click', () => {
        button.classList.remove('hidden');
        hideButton.classList.add('hidden');
        overlay.classList.remove('hidden');
        container.classList.add('!max-h-[min(70vh,_1000px)]', 'overflow-hidden');
      })
    })
  })

  // ANIMATIONS

  // Create a timeline with default parameters
  var tl = anime.timeline({
    easing: 'easeOutExpo'
  });

  // Add children
  tl
    .add({
      targets: '.fade',
      opacity: [0, 1],
      translateY: [-8, 0],
      duration: 600,
      delay: anime.stagger(150)
    })
    .add({
      targets: '.appear',
      opacity: [0, 1],
      duration: 600
    }, '-=400')

});