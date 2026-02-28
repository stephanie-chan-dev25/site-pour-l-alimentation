const blackHamburger = document.querySelector(".black-hamburger");
const greenHamburger = document.querySelector(".green-hamburger");
const nav = document.querySelector("nav");
const menu = document.querySelector("nav ul");
const MOBILE_BREAKPOINT = 800;

if (blackHamburger && greenHamburger && nav && menu) {
  const closeMenu = () => nav.classList.remove("menu-open");

  const toggleMenu = () => {
    if (window.innerWidth <= MOBILE_BREAKPOINT) {
      nav.classList.toggle("menu-open");
    }
  };

  blackHamburger.addEventListener("click", toggleMenu);
  greenHamburger.addEventListener("click", toggleMenu);

  menu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth <= MOBILE_BREAKPOINT) {
        closeMenu();
      }
    });
  });

  window.addEventListener("resize", () => {
    if (window.innerWidth > MOBILE_BREAKPOINT) {
      closeMenu();
    }
  });
}
  
