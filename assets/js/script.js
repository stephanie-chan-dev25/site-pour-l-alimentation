const blackHamburger = document.querySelector(".black-hamburger");
const greenHamburger = document.querySelector(".green-hamburger");
const menu = document.querySelector("ul");
function hamburgerOnHover() {
    if (window.innerWidth <= 500) {
      blackHamburger.style.display = "block";
      greenHamburger.style.display = "none";
  
      blackHamburger.addEventListener("mouseenter", showGreen);
      greenHamburger.addEventListener("mouseleave", showBlack);
      greenHamburger.addEventListener("click", toggleMenu);
    } else {
      blackHamburger.style.display = "none";
      greenHamburger.style.display = "none";
    }
  }
  
  function showGreen() {
    blackHamburger.style.display = "none";
    greenHamburger.style.display = "block";
  }
  
  function showBlack() {
    greenHamburger.style.display = "none";
    blackHamburger.style.display = "block";
  }
  
  function toggleMenu() {
    menu.classList.toggle("active");
  }
  
  hamburgerOnHover();
  window.addEventListener("resize", hamburgerOnHover);
  