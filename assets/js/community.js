(function () {
  const slider      = document.getElementById('communitySlider');
  const progressBar = document.getElementById('communityProgressBar');
  const prevBtn     = document.getElementById('communityPrev');
  const nextBtn     = document.getElementById('communityNext');
  const modal       = document.getElementById('communityModal');
  const overlay     = document.getElementById('communityModalOverlay');
  const closeBtn    = document.getElementById('communityModalClose');
  const modalVideo  = document.getElementById('communityModalVideo');

  if (!slider) return;

  function getSlideStep() {
    const slide = slider.querySelector('.community__slide');
    if (!slide) return slider.clientWidth;
    const gap = parseFloat(getComputedStyle(slider).gap) || 20;
    return slide.offsetWidth + gap;
  }

  function updateControls() {
    const max      = slider.scrollWidth - slider.clientWidth;
    const progress = max > 0 ? slider.scrollLeft / max : 0;
    progressBar.style.width = (progress * 100) + '%';
    prevBtn.classList.toggle('is-active', slider.scrollLeft > 1);
    nextBtn.classList.toggle('is-active', slider.scrollLeft < max - 1);
  }

  slider.addEventListener('scroll', updateControls, { passive: true });
  window.addEventListener('resize', updateControls);

  prevBtn.addEventListener('click', () => {
    slider.scrollBy({ left: -getSlideStep(), behavior: 'smooth' });
  });

  nextBtn.addEventListener('click', () => {
    slider.scrollBy({ left: getSlideStep(), behavior: 'smooth' });
  });

  // Mouse drag
  let isDragging  = false;
  let dragMoved   = false;
  let startX      = 0;
  let startScroll = 0;

  slider.addEventListener('mousedown', (e) => {
    isDragging  = true;
    dragMoved   = false;
    startX      = e.pageX - slider.offsetLeft;
    startScroll = slider.scrollLeft;
    slider.classList.add('is-dragging');
  });

  document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x    = e.pageX - slider.offsetLeft;
    const walk = x - startX;
    if (Math.abs(walk) > 4) dragMoved = true;
    slider.scrollLeft = startScroll - walk;
  });

  document.addEventListener('mouseup', () => {
    if (!isDragging) return;
    isDragging = false;
    slider.classList.remove('is-dragging');
  });

  // Video modal — only open on a real click (not end of drag)
  slider.addEventListener('click', (e) => {
    if (dragMoved) return;
    const card = e.target.closest('.community__card.is-video');
    if (!card) return;
    const url = card.dataset.videoUrl;
    if (!url) return;
    openModal(url);
  });

  function openModal(url) {
    modalVideo.src = url;
    modal.setAttribute('aria-hidden', 'false');
    modal.classList.add('is-open');
    document.body.style.overflow = 'hidden';
    modalVideo.play().catch(() => {});
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    modalVideo.pause();
    modalVideo.src = '';
  }

  overlay.addEventListener('click', closeModal);
  closeBtn.addEventListener('click', closeModal);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });

  updateControls();
})();
