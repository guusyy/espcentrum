(() => {
  // resources/js/app.js
  window.addEventListener("load", function() {
    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    let main_navigation = document.querySelector("#navigation-menu");
    document.querySelector("#primary-menu-toggle").addEventListener("click", function(e) {
      e.preventDefault();
      e.currentTarget.classList.toggle("active-menu");
      main_navigation.classList.toggle("hidden");
      main_navigation.querySelectorAll(".sub-menu-holder").forEach((elem) => elem.classList.remove("!translate-x-0"));
      anime({
        targets: main_navigation.querySelectorAll("#primary-menu > ul > li"),
        opacity: [0, 1],
        translateY: [10, 0],
        delay: anime.stagger(100)
      });
      var tl2 = anime.timeline({
        easing: "easeOutExpo",
        complete: () => {
          [
            ...main_navigation.querySelectorAll("#primary-menu > ul > li"),
            ...main_navigation.querySelectorAll("#cta-menu > ul > li"),
            ...main_navigation.querySelectorAll("[top-nav-items] > li"),
            ...main_navigation.querySelectorAll("[social-items]")
          ].forEach((elem) => elem.style = "");
        }
      });
      tl2.add({
        targets: main_navigation.querySelectorAll("#primary-menu > ul > li"),
        opacity: [0, 1],
        translateY: [10, 0],
        delay: anime.stagger(100)
      }).add({
        targets: main_navigation.querySelectorAll("#cta-menu > ul > li"),
        opacity: [0, 1],
        translateY: [10, 0]
      }, "-=800").add({
        targets: main_navigation.querySelectorAll("[top-nav-items] > li"),
        opacity: [0, 1],
        translateY: [10, 0],
        delay: anime.stagger(100)
      }, "-=1000").add({
        targets: main_navigation.querySelectorAll("[social-items]"),
        opacity: [0, 1],
        translateY: [10, 0]
      }, "-=1000");
    });
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href"))?.scrollIntoView({
          behavior: "smooth"
        });
      });
    });
    document.querySelectorAll(".js-menuCollapse").forEach((menuItem) => {
      menuItem.addEventListener("click", function(e) {
        anime.remove(main_navigation.querySelectorAll("#primary-menu > ul > li"));
        main_navigation.querySelectorAll("#primary-menu > ul > li").forEach((elem) => elem.style = "");
        const navItem = e.target.closest(".menu-item");
        if (navItem.nextElementSibling == void 0 && navItem.previousElementSibling == void 0) {
          e.target.closest(".sub-menu-holder")?.classList.remove("!translate-x-0");
        } else {
          navItem.querySelector(".sub-menu-holder")?.classList.add("!translate-x-0");
        }
      });
    });
    document.querySelectorAll("[toggle-open]")?.forEach((button) => {
      button.addEventListener("click", () => {
        const group = button.closest(".group");
        group?.toggleAttribute("open");
        anime({
          targets: group.querySelectorAll(".sidebarmenu > li"),
          opacity: [0, 1],
          translateY: [10, 0],
          delay: anime.stagger(100)
        });
      });
    });
    var lastScrollTop = 0;
    if (!isSafari) {
      window.addEventListener("scroll", function() {
        var header = document.querySelector(".espcentrum-header");
        var st = window.pageYOffset || document.documentElement.scrollTop;
        if (st > lastScrollTop) {
          header.classList.toggle("espcentrum-sticky", window.scrollY > 0);
        } else {
          header.classList.remove("espcentrum-sticky");
        }
        lastScrollTop = st <= 0 ? 0 : st;
      });
    }
    const swiper = new Swiper(".swiper", {
      direction: "horizontal",
      spaceBetween: 19,
      centerSlider: true,
      slidesPerView: 1,
      draggable: true,
      speed: 900,
      autoplay: {
        delay: 3e3
      },
      pagination: {
        el: ".swiper-pagination"
      },
      navigation: {
        nextEl: ".swiper-next",
        prevEl: ".swiper-prev"
      },
      breakpoints: {
        640: {
          slidesPerView: 1
        },
        768: {
          slidesPerView: 2
        },
        1010: {
          slidesPerView: 3
        }
      }
    });
    [...document.querySelectorAll("[medewerkers-show]")].forEach((button) => {
      button.addEventListener("click", () => {
        const hideButton = document.querySelector("[medewerkers-hide]");
        const overlay = document.querySelector("[medewerkers-overlay]");
        const container = document.querySelector("[medewerkers-container]");
        const contentHeight = container.querySelector("ul").clientHeight + button.clientHeight;
        button.classList.add("hidden");
        hideButton.classList.remove("hidden");
        overlay.classList.add("hidden");
        container.classList.remove("!max-h-[min(70vh,_1000px)]", "overflow-hidden");
        container.style.maxHeight = contentHeight + "px";
        hideButton.addEventListener("click", () => {
          button.classList.remove("hidden");
          hideButton.classList.add("hidden");
          overlay.classList.remove("hidden");
          container.classList.add("!max-h-[min(70vh,_1000px)]", "overflow-hidden");
        });
      });
    });
    var tl = anime.timeline({
      easing: "easeOutExpo"
    });
    tl.add({
      targets: ".fade",
      opacity: [0, 1],
      translateY: [-8, 0],
      duration: 600,
      delay: anime.stagger(150)
    }).add({
      targets: ".appear",
      opacity: [0, 1],
      duration: 600
    }, "-=400");
  });
})();
