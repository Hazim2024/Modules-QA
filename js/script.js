document.addEventListener("DOMContentLoaded", () => {
    const nav = document.querySelector(".navigation");
    const burger = document.querySelector(".hamburger");
  
    burger.addEventListener("click", () => {
      nav.classList.toggle("nav--open");
      burger.classList.toggle("hamburger--open");
    });
  
    // optional: close the menu when a link is clicked
    nav.querySelectorAll(".nav_link").forEach(link =>
      link.addEventListener("click", () => {
        nav.classList.remove("nav--open");
        burger.classList.remove("hamburger--open");
      })
    );
  });
  