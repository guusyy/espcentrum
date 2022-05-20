// Navigation toggle
window.addEventListener('load', function () {
		let main_navigation = document.querySelector('#primary-menu');
		document.querySelector('#primary-menu-toggle').addEventListener('click', function (e) {
					e.preventDefault();
          e.currentTarget.classList.toggle("active-menu");
					main_navigation.classList.toggle('hidden');
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

    // NAVIGATION SCROLL

    var lastScrollTop = 0;

		window.addEventListener('scroll', function(){
			var header = document.querySelector('.espcentrum-header');
      
      var st = window.pageYOffset || document.documentElement.scrollTop;
      if (st > lastScrollTop){
        header.classList.toggle("espcentrum-sticky", window.scrollY > 0);
      } else {
        header.classList.remove("espcentrum-sticky");
      }
      lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
		})

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