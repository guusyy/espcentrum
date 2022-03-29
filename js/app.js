(() => {
  // resources/js/app.js
  window.addEventListener("load", function() {
    let main_navigation = document.querySelector("#primary-menu");
    document.querySelector("#primary-menu-toggle").addEventListener("click", function(e) {
      e.preventDefault();
      e.currentTarget.classList.toggle("active-menu");
      main_navigation.classList.toggle("hidden");
    });
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href"))?.scrollIntoView({
          behavior: "smooth"
        });
      });
    });
    document.querySelectorAll(".menu-item-has-children").forEach((menuItem) => {
      menuItem.addEventListener("click", function(e) {
        e.currentTarget.classList.toggle("espcentrum-open");
      });
    });
    window.addEventListener("scroll", function() {
      var header = document.querySelector(".espcentrum-header");
      header.classList.toggle("espcentrum-sticky", window.scrollY > 0);
    });
    var tl = anime.timeline({
      easing: "easeOutExpo"
    });
    tl.add({
      targets: ".fade",
      opacity: [0, 1],
      translateY: [8, 0],
      duration: 1e3,
      delay: anime.stagger(150)
    }).add({
      targets: ".appear",
      opacity: [0, 1],
      duration: 1e3
    }, "-=600");
  });
})();
