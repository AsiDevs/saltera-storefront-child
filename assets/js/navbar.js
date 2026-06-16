document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.querySelector(".navbar__toggle");
  const mobileNav = document.querySelector(".navbar__mobile-nav");
  if (toggle && mobileNav) {
    toggle.addEventListener("click", () => {
      const open = mobileNav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open);
      mobileNav.setAttribute("aria-hidden", !open);
    });
  }

  const bar = document.getElementById("announcement-bar");
  const closeBtn = bar?.querySelector(".announcement-bar__close");
  closeBtn?.addEventListener("click", () => {
    bar.style.display = "none";
  });
});
