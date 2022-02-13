// Navigation toggle
window.addEventListener('load', function () {
		let main_navigation = document.querySelector('#primary-menu');
		document.querySelector('#primary-menu-toggle').addEventListener('click', function (e) {
					e.preventDefault();
					main_navigation.classList.toggle('hidden');
		});

		document.querySelectorAll('a[href^="#"]').forEach(anchor => {
			anchor.addEventListener('click', function (e) {
					e.preventDefault();
	
					document.querySelector(this.getAttribute('href')).scrollIntoView({
							behavior: 'smooth'
					});
			});
		});

		document.querySelectorAll('.menu-item-has-children').forEach(menuItem => {
			menuItem.addEventListener('click', function (e) {
				e.currentTarget.classList.toggle('movida-open');
			})
		})

		window.addEventListener('scroll', function(){
			var header = document.querySelector('.movida-header');
			header.classList.toggle("movida-sticky", window.scrollY > 0);
		})

    const swiper = new Swiper('.swiper', {
      // Optional parameters
      direction: 'horizontal',
      spaceBetween: 19,
      centerSlider: true,
      slidesPerView: 1.1,

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
          slidesPerView: 1.1,
        },
        // when window width is >= 480px
        768: {
          slidesPerView: 2.1,
        },
        // when window width is >= 640px
        1010: {
          slidesPerView: 3.1,
        }
      }
    });
});