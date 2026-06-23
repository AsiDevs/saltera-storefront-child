(function () {
  var actions        = document.querySelector('.single-product__actions');
  if (!actions) return;

  var minusBtn       = document.getElementById('qty-minus');
  var plusBtn        = document.getElementById('qty-plus');
  var qtyEl          = document.getElementById('qty-value');
  var priceContainer = document.querySelector('.single-product__price');
  if (!minusBtn || !plusBtn || !qtyEl) return;

  var productId = actions.dataset.productId;
  var buttons   = actions.querySelectorAll('.btn');
  var qty       = 1;

  // Parse variation map: { slug: { id, price, price_html } }
  var variations = {};
  try { variations = JSON.parse(actions.dataset.variations || '{}'); } catch (e) {}
  var isVariable = Object.keys(variations).length > 0;

  var selectedVariationId = null;
  var unitPrice = priceContainer ? parseFloat(priceContainer.dataset.unitPrice) : 0;

  // Sync selectedVariationId with the initially-active pill
  var activePill = document.querySelector('.single-product__variant-pill.is-active');
  if (activePill && isVariable) {
    var initSlug = activePill.dataset.variant;
    if (variations[initSlug]) {
      selectedVariationId = variations[initSlug].id;
      unitPrice           = variations[initSlug].price;
    }
  }

  function updateUrls() {
    var id   = selectedVariationId || productId;
    var base = window.location.origin + '/';
    buttons.forEach(function (btn) {
      var isBuyNow = btn.classList.contains('btn-primary');
      var url = new URL(base);
      url.searchParams.set('add-to-cart', id);
      url.searchParams.set('quantity', qty);
      if (isBuyNow) url.searchParams.set('buy_now', '1');
      btn.href = url.toString();
    });
  }

  function updatePrice() {
    if (!priceContainer || !unitPrice) return;
    var bdi = priceContainer.querySelector('bdi');
    if (!bdi) return;
    var total     = unitPrice * qty;
    var formatted = total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    Array.from(bdi.childNodes).forEach(function (node) {
      if (node.nodeType === 3) {
        node.textContent = ' ' + formatted;
      }
    });
  }

  // Size pill selection
  var pills = document.querySelectorAll('.single-product__variant-pill:not([disabled])');
  pills.forEach(function (pill) {
    pill.addEventListener('click', function () {
      pills.forEach(function (p) { p.classList.remove('is-active'); });
      pill.classList.add('is-active');

      var slug = pill.dataset.variant;
      if (isVariable && variations[slug]) {
        var v               = variations[slug];
        selectedVariationId = v.id;
        unitPrice           = v.price;
        priceContainer.innerHTML         = v.price_html;
        priceContainer.dataset.unitPrice = unitPrice;
        if (qty > 1) updatePrice();
      }
      updateUrls();
    });
  });

  // Qty stepper
  minusBtn.addEventListener('click', function () {
    if (qty > 1) {
      qty--;
      qtyEl.textContent = qty;
      updateUrls();
      updatePrice();
    }
  });

  plusBtn.addEventListener('click', function () {
    qty++;
    qtyEl.textContent = qty;
    updateUrls();
    updatePrice();
  });

  // Ensure correct variation ID is in button hrefs from page load
  updateUrls();
})();

// Gallery thumbnail switcher
(function () {
  var thumbs  = document.querySelectorAll('.single-product__thumb');
  var mainImg = document.getElementById('product-main-img');
  if (!thumbs.length || !mainImg) return;

  thumbs.forEach(function (thumb) {
    thumb.addEventListener('click', function () {
      thumbs.forEach(function (t) { t.classList.remove('is-active'); });
      thumb.classList.add('is-active');
      mainImg.src = thumb.dataset.img;
    });
  });
})();

// Dropdown accordions
(function () {
  document.querySelectorAll('.single-product__dropdown-header').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = btn.closest('.single-product__dropdown');
      var open = item.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', open);
    });
  });
})();
