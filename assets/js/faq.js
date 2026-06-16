document.querySelectorAll(".faq-header").forEach((btn) => {
  btn.addEventListener("click", () => {
    const faq = btn.closest(".faq");
    const open = faq.classList.toggle("is-open");
    btn.setAttribute("aria-expanded", open);
  });
});
