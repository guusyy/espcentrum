(() => {
  // resources/js/app.js
  window.addEventListener("load", function() {
    let main_navigation = document.querySelector("#primary-menu");
    document.querySelector("#primary-menu-toggle").addEventListener("click", function(e) {
      e.preventDefault();
      main_navigation.classList.toggle("hidden");
    });
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href")).scrollIntoView({
          behavior: "smooth"
        });
      });
    });
    document.querySelectorAll(".menu-item-has-children").forEach((menuItem) => {
      menuItem.addEventListener("click", function(e) {
        e.currentTarget.classList.toggle("movida-open");
      });
    });
    window.addEventListener("scroll", function() {
      var header = document.querySelector(".movida-header");
      header.classList.toggle("movida-sticky", window.scrollY > 0);
    });
  });
})();
