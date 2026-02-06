/**
 * LUMINA Theme JavaScript
 * Premium Shopify Theme by Céline Dev Studio
 */

// ============================================
// Core Utilities
// ============================================

const Lumina = window.Lumina || {};

// Debounce function
Lumina.debounce = (fn, delay = 300) => {
  let timeoutId;
  return (...args) => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => fn(...args), delay);
  };
};

// Throttle function
Lumina.throttle = (fn, limit = 100) => {
  let inThrottle;
  return (...args) => {
    if (!inThrottle) {
      fn(...args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  };
};

// Fetch with error handling
Lumina.fetchJSON = async (url, options = {}) => {
  try {
    const response = await fetch(url, {
      ...options,
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        ...options.headers
      }
    });
    
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    return await response.json();
  } catch (error) {
    console.error('Fetch error:', error);
    throw error;
  }
};

// Format money
Lumina.formatMoney = (cents, format = Lumina.moneyFormat) => {
  if (typeof cents === 'string') cents = cents.replace('.', '');
  let value = '';
  const placeholderRegex = /\{\{\s*(\w+)\s*\}\}/;
  
  const formatWithDelimiters = (number, precision = 2, thousands = ',', decimal = '.') => {
    if (isNaN(number) || number == null) return 0;
    number = (number / 100.0).toFixed(precision);
    const parts = number.split('.');
    const dollars = parts[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, `$1${thousands}`);
    const cents = parts[1] ? decimal + parts[1] : '';
    return dollars + cents;
  };

  switch (format.match(placeholderRegex)?.[1]) {
    case 'amount':
      value = formatWithDelimiters(cents, 2);
      break;
    case 'amount_no_decimals':
      value = formatWithDelimiters(cents, 0);
      break;
    case 'amount_with_comma_separator':
      value = formatWithDelimiters(cents, 2, '.', ',');
      break;
    case 'amount_no_decimals_with_comma_separator':
      value = formatWithDelimiters(cents, 0, '.', ',');
      break;
    default:
      value = formatWithDelimiters(cents, 2);
  }

  return format.replace(placeholderRegex, value);
};

// Trap focus within element
Lumina.trapFocus = (container, elementToFocus = container) => {
  const focusableElements = container.querySelectorAll(
    'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
  );
  const firstFocusable = focusableElements[0];
  const lastFocusable = focusableElements[focusableElements.length - 1];

  container.addEventListener('keydown', (e) => {
    if (e.key !== 'Tab') return;

    if (e.shiftKey) {
      if (document.activeElement === firstFocusable) {
        lastFocusable.focus();
        e.preventDefault();
      }
    } else {
      if (document.activeElement === lastFocusable) {
        firstFocusable.focus();
        e.preventDefault();
      }
    }
  });

  elementToFocus.focus();
};

// ============================================
// Animation Observer
// ============================================

class AnimationObserver {
  constructor() {
    if (!Lumina.settings.enableAnimations) return;
    
    this.observer = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            this.observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
    );

    this.init();
  }

  init() {
    document.querySelectorAll('[data-animate], [data-animate-stagger]').forEach(el => {
      this.observer.observe(el);
    });
  }
}

// ============================================
// Header
// ============================================

class StickyHeader extends HTMLElement {
  constructor() {
    super();
    this.header = this;
    this.headerBounds = {};
    this.currentScrollTop = 0;
    this.preventReveal = false;
  }

  connectedCallback() {
    this.headerBounds = this.getBoundingClientRect();
    document.documentElement.style.setProperty('--header-height', `${this.headerBounds.height}px`);
    
    this.onScrollHandler = this.onScroll.bind(this);
    window.addEventListener('scroll', this.onScrollHandler, { passive: true });
    
    this.createObserver();
  }

  disconnectedCallback() {
    window.removeEventListener('scroll', this.onScrollHandler);
  }

  createObserver() {
    const observer = new IntersectionObserver((entries) => {
      this.headerBounds = entries[0].intersectionRect;
      observer.disconnect();
    });

    observer.observe(this);
  }

  onScroll() {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;

    if (scrollTop > this.currentScrollTop && scrollTop > this.headerBounds.bottom) {
      requestAnimationFrame(() => this.hide());
    } else if (scrollTop < this.currentScrollTop) {
      requestAnimationFrame(() => this.reveal());
    }

    if (scrollTop > 0) {
      this.classList.add('is-scrolled');
    } else {
      this.classList.remove('is-scrolled');
    }

    this.currentScrollTop = scrollTop;
  }

  hide() {
    if (this.preventReveal) return;
    this.classList.add('header--hidden');
  }

  reveal() {
    this.classList.remove('header--hidden');
  }
}

customElements.define('sticky-header', StickyHeader);

// ============================================
// Mobile Menu
// ============================================

class MobileMenu extends HTMLElement {
  constructor() {
    super();
    this.menuDrawer = this.querySelector('.mobile-menu__drawer');
    this.openButton = document.querySelector('[data-mobile-menu-open]');
    this.closeButton = this.querySelector('[data-mobile-menu-close]');
    this.overlay = this.querySelector('.mobile-menu__overlay');
  }

  connectedCallback() {
    this.openButton?.addEventListener('click', () => this.open());
    this.closeButton?.addEventListener('click', () => this.close());
    this.overlay?.addEventListener('click', () => this.close());
    
    // Handle submenu toggles
    this.querySelectorAll('[data-submenu-toggle]').forEach(toggle => {
      toggle.addEventListener('click', (e) => this.toggleSubmenu(e));
    });
    
    // Close on escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.classList.contains('is-open')) {
        this.close();
      }
    });
  }

  open() {
    this.classList.add('is-open');
    document.body.classList.add('overflow-hidden');
    Lumina.trapFocus(this.menuDrawer, this.closeButton);
  }

  close() {
    this.classList.remove('is-open');
    document.body.classList.remove('overflow-hidden');
    this.openButton?.focus();
  }

  toggleSubmenu(e) {
    const toggle = e.currentTarget;
    const submenu = toggle.nextElementSibling;
    const isOpen = toggle.getAttribute('aria-expanded') === 'true';
    
    toggle.setAttribute('aria-expanded', !isOpen);
    submenu.classList.toggle('is-open');
  }
}

customElements.define('mobile-menu', MobileMenu);

// ============================================
// Cart Functionality
// ============================================

class CartDrawer extends HTMLElement {
  constructor() {
    super();
    this.drawer = this.querySelector('.cart-drawer__container');
    this.overlay = this.querySelector('.cart-drawer__overlay');
    this.closeButton = this.querySelector('[data-cart-close]');
    this.loading = this.querySelector('#cart-drawer-loading');
    this.isRefreshing = false; // Prevent concurrent refreshes
  }

  connectedCallback() {
    this.closeButton?.addEventListener('click', () => this.close());
    this.overlay?.addEventListener('click', () => this.close());

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.classList.contains('is-open')) {
        this.close();
      }
    });

    document.addEventListener('cart:open', () => this.open());
    document.addEventListener('cart:close', () => this.close());
    document.addEventListener('cart:refresh', () => this.refresh());

    // Initialize cart item handlers
    this.initCartItemHandlers();
  }

  initCartItemHandlers() {
    // Use event delegation for dynamic content
    this.addEventListener('click', async (e) => {
      // Handle remove item button
      const removeButton = e.target.closest('[data-remove-item]');
      if (removeButton) {
        e.preventDefault();
        const cartItem = removeButton.closest('[data-cart-item]');
        if (cartItem) {
          await this.removeItem(cartItem);
        }
      }
    });

    // Handle quantity changes with debounce
    this.addEventListener('change', Lumina.debounce(async (e) => {
      const quantityInput = e.target.closest('[data-quantity-input]');
      if (quantityInput) {
        const cartItem = quantityInput.closest('[data-cart-item]');
        if (cartItem) {
          await this.updateItemQuantity(cartItem, parseInt(quantityInput.value, 10));
        }
      }
    }, 300));
  }

  async removeItem(cartItem) {
    const line = cartItem.dataset.line;

    if (!line) {
      console.error('CartDrawer: Missing line attribute on cart item');
      return;
    }

    this.showItemLoading(cartItem);

    try {
      const formData = new FormData();
      formData.append('line', line);
      formData.append('quantity', '0');

      const response = await fetch(Lumina.routes.cartChange, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      // Refresh drawer and update count
      await this.refresh();
      this.showNotification(Lumina.cartStrings?.itemRemoved || 'Item removed from cart');

    } catch (error) {
      console.error('Failed to remove item:', error);
      this.hideItemLoading(cartItem);
      this.showNotification(Lumina.cartStrings?.error || 'Error updating cart', 'error');
    }
  }

  async updateItemQuantity(cartItem, quantity) {
    const line = cartItem.dataset.line;

    if (!line) {
      console.error('CartDrawer: Missing line attribute on cart item');
      return;
    }

    // If quantity is 0 or less, remove the item
    if (quantity <= 0) {
      await this.removeItem(cartItem);
      return;
    }

    this.showItemLoading(cartItem);

    try {
      const formData = new FormData();
      formData.append('line', line);
      formData.append('quantity', quantity.toString());

      const response = await fetch(Lumina.routes.cartChange, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      // Refresh drawer and update count
      await this.refresh();

    } catch (error) {
      console.error('Failed to update quantity:', error);
      this.hideItemLoading(cartItem);
      this.showNotification(Lumina.cartStrings?.error || 'Error updating cart', 'error');
    }
  }

  showItemLoading(cartItem) {
    const loader = cartItem.querySelector('[data-item-loader]');
    if (loader) loader.hidden = false;
    cartItem.classList.add('is-updating');
  }

  hideItemLoading(cartItem) {
    const loader = cartItem.querySelector('[data-item-loader]');
    if (loader) loader.hidden = true;
    cartItem.classList.remove('is-updating');
  }

  showLoading() {
    if (this.loading) this.loading.hidden = false;
  }

  hideLoading() {
    if (this.loading) this.loading.hidden = true;
  }

  showNotification(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast--${type}`;

    const messageSpan = document.createElement('span');
    messageSpan.className = 'toast__message';
    messageSpan.textContent = message;

    const closeBtn = document.createElement('button');
    closeBtn.className = 'toast__close';
    closeBtn.setAttribute('aria-label', 'Close');
    closeBtn.textContent = '×';

    toast.appendChild(messageSpan);
    toast.appendChild(closeBtn);
    document.body.appendChild(toast);

    requestAnimationFrame(() => toast.classList.add('is-visible'));

    const removeToast = () => {
      toast.classList.add('is-leaving');
      setTimeout(() => toast.remove(), 300);
    };

    closeBtn.addEventListener('click', removeToast);
    setTimeout(removeToast, 4000);
  }

  open() {
    this.classList.add('is-open');
    document.body.classList.add('overflow-hidden');
    Lumina.trapFocus(this.drawer, this.closeButton);
  }

  close() {
    this.classList.remove('is-open');
    document.body.classList.remove('overflow-hidden');
  }

  async refresh() {
    // Prevent concurrent refreshes
    if (this.isRefreshing) return;
    this.isRefreshing = true;

    this.showLoading();

    try {
      const response = await fetch(`${Lumina.routes.cart}?section_id=cart-drawer`, {
        credentials: 'same-origin'
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const html = await response.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');

      // Update cart content
      const newContent = doc.querySelector('#cart-drawer-content');
      const currentContent = this.querySelector('#cart-drawer-content');
      if (newContent && currentContent) {
        currentContent.innerHTML = newContent.innerHTML;
      }

      // Update cart footer
      const newFooter = doc.querySelector('.cart-drawer__footer');
      const currentFooter = this.querySelector('.cart-drawer__footer');
      if (newFooter && currentFooter) {
        currentFooter.innerHTML = newFooter.innerHTML;
      } else if (newFooter && !currentFooter) {
        // Footer appeared (cart was empty, now has items)
        this.querySelector('.cart-drawer__container').appendChild(newFooter.cloneNode(true));
      } else if (!newFooter && currentFooter) {
        // Footer disappeared (cart is now empty)
        currentFooter.remove();
      }

      // Update cart count in header
      const newCount = doc.querySelector('.cart-drawer__count');
      if (newCount) {
        const currentCount = this.querySelector('.cart-drawer__count');
        if (currentCount) currentCount.textContent = newCount.textContent;
      }

      // Update free shipping progress
      const newShipping = doc.querySelector('.cart-drawer__shipping-progress');
      const currentShipping = this.querySelector('.cart-drawer__shipping-progress');
      if (newShipping && currentShipping) {
        currentShipping.innerHTML = newShipping.innerHTML;
      }

      // Update header cart count from the refreshed drawer content (no extra fetch needed)
      const newCountText = doc.querySelector('.cart-drawer__count')?.textContent;
      if (newCountText) {
        const countMatch = newCountText.match(/\d+/);
        const itemCount = countMatch ? parseInt(countMatch[0], 10) : 0;
        document.querySelectorAll('[data-cart-count]').forEach(el => {
          el.textContent = itemCount;
          el.classList.toggle('is-hidden', itemCount === 0);
        });
      }

    } catch (error) {
      console.error('Failed to refresh cart:', error);
      this.showNotification(Lumina.cartStrings?.error || 'Failed to update cart', 'error');
    } finally {
      this.isRefreshing = false;
      this.hideLoading();
    }
  }

  async updateCartCount() {
    try {
      const cart = await Lumina.fetchJSON(Lumina.routes.cart + '.js');
      document.querySelectorAll('[data-cart-count]').forEach(el => {
        el.textContent = cart.item_count;
        el.classList.toggle('is-hidden', cart.item_count === 0);

        // Trigger animation
        el.classList.add('is-updating');
        setTimeout(() => el.classList.remove('is-updating'), 400);
      });

      // Update cart drawer count display
      const drawerCount = this.querySelector('.cart-drawer__count');
      if (drawerCount) {
        drawerCount.textContent = `(${cart.item_count})`;
      }

    } catch (error) {
      console.error('Failed to update cart count:', error);
    }
  }
}

customElements.define('cart-drawer', CartDrawer);

// Cart Add Form
class ProductForm extends HTMLElement {
  constructor() {
    super();
    this.form = this.querySelector('form');
    this.submitButton = this.querySelector('[type="submit"]');
  }

  connectedCallback() {
    this.form?.addEventListener('submit', this.onSubmitHandler.bind(this));
  }

  async onSubmitHandler(e) {
    e.preventDefault();

    if (this.submitButton.getAttribute('aria-disabled') === 'true') return;

    this.submitButton.setAttribute('aria-disabled', 'true');
    this.submitButton.classList.add('is-loading');

    const formData = new FormData(this.form);

    try {
      const response = await fetch(Lumina.routes.cartAdd, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      // Check if response is ok before parsing JSON
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const contentType = response.headers.get('content-type');
      if (!contentType || !contentType.includes('application/json')) {
        throw new Error('Server returned non-JSON response');
      }

      const result = await response.json();

      if (result.status === 422) {
        this.handleError(result.description);
        return;
      }

      // Refresh cart and open drawer
      document.dispatchEvent(new CustomEvent('cart:refresh'));

      if (Lumina.settings.cartType === 'drawer') {
        document.dispatchEvent(new CustomEvent('cart:open'));
      } else if (Lumina.settings.cartType === 'popup') {
        this.showNotification('Product added to cart');
      }

    } catch (error) {
      console.error('Add to cart error:', error);
      this.handleError(Lumina.cartStrings.error);
    } finally {
      this.submitButton.setAttribute('aria-disabled', 'false');
      this.submitButton.classList.remove('is-loading');
    }
  }

  handleError(message) {
    this.showNotification(message, 'error');
  }

  showNotification(message, type = 'success') {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = `toast toast--${type}`;
    toast.innerHTML = `
      <span class="toast__message">${message}</span>
      <button class="toast__close" aria-label="Close">×</button>
    `;
    
    document.body.appendChild(toast);
    
    requestAnimationFrame(() => toast.classList.add('is-visible'));
    
    const removeToast = () => {
      toast.classList.add('is-leaving');
      setTimeout(() => toast.remove(), 300);
    };
    
    toast.querySelector('.toast__close').addEventListener('click', removeToast);
    setTimeout(removeToast, 4000);
  }
}

customElements.define('product-form', ProductForm);

// Quantity Selector
class QuantityInput extends HTMLElement {
  constructor() {
    super();
    this.input = this.querySelector('input');
    this.changeEvent = new Event('change', { bubbles: true });
  }

  connectedCallback() {
    this.querySelectorAll('button').forEach(button => {
      button.addEventListener('click', this.onButtonClick.bind(this));
    });
  }

  onButtonClick(e) {
    e.preventDefault();

    const min = parseInt(this.input.min) || 0;
    const max = parseInt(this.input.max) || 9999;
    const step = parseInt(this.input.step) || 1;
    let currentValue = parseInt(this.input.value) || min;

    if (e.currentTarget.name === 'plus') {
      currentValue = Math.min(currentValue + step, max);
    } else {
      currentValue = Math.max(currentValue - step, min);
    }

    if (this.input.value !== currentValue.toString()) {
      this.input.value = currentValue;
      this.input.dispatchEvent(this.changeEvent);
    }
  }
}

customElements.define('quantity-input', QuantityInput);

// ============================================
// Product Gallery
// ============================================

class ProductGallery extends HTMLElement {
  constructor() {
    super();
    this.mainImage = this.querySelector('.gallery__main-image img');
    this.thumbnails = this.querySelectorAll('.gallery__thumbnail');
  }

  connectedCallback() {
    this.thumbnails.forEach(thumb => {
      thumb.addEventListener('click', () => this.switchImage(thumb));
      thumb.addEventListener('mouseenter', () => this.switchImage(thumb));
    });
  }

  switchImage(thumbnail) {
    const newSrc = thumbnail.dataset.src;
    const newSrcset = thumbnail.dataset.srcset;
    
    // Update active state
    this.thumbnails.forEach(t => t.classList.remove('is-active'));
    thumbnail.classList.add('is-active');
    
    // Animate image change
    this.mainImage.classList.add('is-changing');
    
    setTimeout(() => {
      this.mainImage.src = newSrc;
      if (newSrcset) this.mainImage.srcset = newSrcset;
      this.mainImage.classList.remove('is-changing');
    }, 150);
  }
}

customElements.define('product-gallery', ProductGallery);

// ============================================
// Variant Selector
// ============================================

class VariantSelector extends HTMLElement {
  constructor() {
    super();
    this.productData = JSON.parse(this.querySelector('[type="application/json"]')?.textContent || '{}');
    this.currentVariant = this.productData.variants?.find(v => v.available) || this.productData.variants?.[0];
  }

  connectedCallback() {
    this.addEventListener('change', this.onVariantChange.bind(this));
  }

  onVariantChange() {
    const selectedOptions = this.getSelectedOptions();
    this.currentVariant = this.productData.variants.find(variant => {
      return variant.options.every((option, index) => option === selectedOptions[index]);
    });

    if (!this.currentVariant) return;

    this.updateFormVariantId(); // CRITICAL: Update hidden input
    this.updateUrl();
    this.updatePrice();
    this.updateAddToCartButton();
    this.updateMedia();

    // Dispatch custom event
    this.dispatchEvent(new CustomEvent('variant:changed', {
      detail: { variant: this.currentVariant },
      bubbles: true
    }));
  }

  getSelectedOptions() {
    // Support both data-option-selector and standard inputs
    const radioInputs = this.querySelectorAll('input[type="radio"]:checked');
    const selectInputs = this.querySelectorAll('select');

    if (radioInputs.length > 0) {
      return Array.from(radioInputs).map(input => input.value);
    }

    if (selectInputs.length > 0) {
      return Array.from(selectInputs).map(select => select.value);
    }

    // Fallback to data-option-selector
    const selectors = this.querySelectorAll('[data-option-selector]');
    return Array.from(selectors).map(selector => {
      if (selector.type === 'radio') {
        return this.querySelector(`[name="${selector.name}"]:checked`)?.value;
      }
      return selector.value;
    });
  }

  updateFormVariantId() {
    // CRITICAL FIX: Update the hidden variant ID input when variant changes
    if (!this.currentVariant) return;

    const form = document.querySelector('product-form form, form[action*="/cart/add"]');
    if (form) {
      const variantInput = form.querySelector('input[name="id"]');
      if (variantInput) {
        variantInput.value = this.currentVariant.id;
      }
    }
  }

  updateUrl() {
    if (!this.currentVariant) return;
    window.history.replaceState({}, '', `${window.location.pathname}?variant=${this.currentVariant.id}`);
  }

  updatePrice() {
    // Update main product price
    const priceContainer = document.querySelector('[data-product-price], .main-product__price');
    if (!priceContainer) return;

    const price = Lumina.formatMoney(this.currentVariant.price);
    const comparePrice = this.currentVariant.compare_at_price
      ? Lumina.formatMoney(this.currentVariant.compare_at_price)
      : null;

    // Create elements safely instead of innerHTML
    priceContainer.textContent = '';

    if (comparePrice) {
      const compareSpan = document.createElement('span');
      compareSpan.className = 'main-product__price-compare';
      compareSpan.textContent = comparePrice;
      priceContainer.appendChild(compareSpan);
    }

    const priceSpan = document.createElement('span');
    priceSpan.className = comparePrice ? 'main-product__price-current on-sale' : 'main-product__price-current';
    priceSpan.textContent = price;
    priceContainer.appendChild(priceSpan);

    priceContainer.classList.toggle('price--on-sale', !!comparePrice);
  }

  updateAddToCartButton() {
    // Support multiple button selectors
    const button = document.querySelector('[data-add-to-cart], .main-product__add-button, button[name="add"]');
    if (!button) return;

    const buttonText = button.querySelector('[data-add-to-cart-text], .main-product__add-button-text, span:first-child');

    // Get localized strings from Lumina or use defaults
    const strings = Lumina.productStrings || {
      addToCart: 'Add to cart',
      soldOut: 'Sold out',
      unavailable: 'Unavailable'
    };

    if (!this.currentVariant) {
      button.disabled = true;
      if (buttonText) buttonText.textContent = strings.unavailable;
    } else if (!this.currentVariant.available) {
      button.disabled = true;
      if (buttonText) buttonText.textContent = strings.soldOut;
    } else {
      button.disabled = false;
      if (buttonText) buttonText.textContent = strings.addToCart;
    }
  }

  updateMedia() {
    if (!this.currentVariant.featured_media) return;

    const mediaId = this.currentVariant.featured_media.id;
    const thumbnail = document.querySelector(`[data-media-id="${mediaId}"]`);
    thumbnail?.click();
  }
}

customElements.define('variant-selector', VariantSelector);

// Also support variant-picker custom element name (used in main-product.liquid)
customElements.define('variant-picker', class extends VariantSelector {});

// ============================================
// Search
// ============================================

class PredictiveSearch extends HTMLElement {
  constructor() {
    super();
    this.input = this.querySelector('input[type="search"]');
    this.results = this.querySelector('.predictive-search__results');
    this.status = this.querySelector('.predictive-search__status');
  }

  connectedCallback() {
    this.input?.addEventListener('input', Lumina.debounce(this.onInput.bind(this), 300));
    
    document.addEventListener('click', (e) => {
      if (!this.contains(e.target)) this.close();
    });
  }

  async onInput() {
    const query = this.input.value.trim();
    
    if (query.length < 2) {
      this.close();
      return;
    }

    this.classList.add('is-loading');

    try {
      const url = `${Lumina.routes.predictiveSearch}?q=${encodeURIComponent(query)}&resources[type]=product,collection,article&resources[limit]=4&section_id=predictive-search`;
      const response = await fetch(url, { credentials: 'same-origin' });
      const html = await response.text();
      
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const resultsHTML = doc.querySelector('.predictive-search__results')?.innerHTML;
      
      if (resultsHTML) {
        this.results.innerHTML = resultsHTML;
        this.open();
      }
    } catch (error) {
      console.error('Search error:', error);
    } finally {
      this.classList.remove('is-loading');
    }
  }

  open() {
    this.classList.add('is-open');
    this.input.setAttribute('aria-expanded', 'true');
  }

  close() {
    this.classList.remove('is-open');
    this.input.setAttribute('aria-expanded', 'false');
  }
}

customElements.define('predictive-search', PredictiveSearch);

// ============================================
// Accordion
// ============================================

class AccordionItem extends HTMLElement {
  constructor() {
    super();
    this.header = this.querySelector('.accordion__header');
    this.content = this.querySelector('.accordion__content');
  }

  connectedCallback() {
    this.header?.addEventListener('click', () => this.toggle());
  }

  toggle() {
    const isOpen = this.classList.contains('is-open');
    
    // Close siblings if in accordion group
    if (!isOpen && this.closest('[data-accordion-single]')) {
      this.parentElement.querySelectorAll('accordion-item.is-open').forEach(item => {
        item.classList.remove('is-open');
        item.header.setAttribute('aria-expanded', 'false');
      });
    }
    
    this.classList.toggle('is-open');
    this.header.setAttribute('aria-expanded', !isOpen);
  }
}

customElements.define('accordion-item', AccordionItem);

// ============================================
// Tabs
// ============================================

class TabsComponent extends HTMLElement {
  constructor() {
    super();
    this.tabs = this.querySelectorAll('[data-tab]');
    this.panels = this.querySelectorAll('[data-tab-panel]');
  }

  connectedCallback() {
    this.tabs.forEach(tab => {
      tab.addEventListener('click', () => this.switchTab(tab.dataset.tab));
    });
  }

  switchTab(tabId) {
    // Update tabs
    this.tabs.forEach(tab => {
      const isActive = tab.dataset.tab === tabId;
      tab.classList.toggle('is-active', isActive);
      tab.setAttribute('aria-selected', isActive);
    });
    
    // Update panels
    this.panels.forEach(panel => {
      const isActive = panel.dataset.tabPanel === tabId;
      panel.classList.toggle('is-active', isActive);
      panel.hidden = !isActive;
    });
  }
}

customElements.define('tabs-component', TabsComponent);

// ============================================
// Modal
// ============================================

class ModalDialog extends HTMLElement {
  constructor() {
    super();
    this.closeButton = this.querySelector('[data-modal-close]');
    this.overlay = this.querySelector('.modal__overlay');
  }

  connectedCallback() {
    this.closeButton?.addEventListener('click', () => this.close());
    this.overlay?.addEventListener('click', () => this.close());
    
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.classList.contains('is-open')) {
        this.close();
      }
    });
  }

  show(content) {
    if (content) {
      const contentArea = this.querySelector('.modal__content-area');
      if (contentArea) contentArea.innerHTML = content;
    }
    
    this.classList.add('is-open');
    document.body.classList.add('overflow-hidden');
    Lumina.trapFocus(this);
  }

  close() {
    this.classList.remove('is-open');
    document.body.classList.remove('overflow-hidden');
  }
}

customElements.define('modal-dialog', ModalDialog);

// ============================================
// Quick Add to Cart
// ============================================

class QuickAdd {
  constructor() {
    this.init();
  }

  init() {
    document.addEventListener('click', async (e) => {
      const quickAddButton = e.target.closest('[data-add-to-cart-quick]');
      if (quickAddButton) {
        e.preventDefault();
        await this.addToCart(quickAddButton);
      }
    });
  }

  async addToCart(button) {
    const variantId = button.dataset.addToCartQuick;
    if (!variantId) return;

    // Disable button and show loading state
    button.disabled = true;
    button.classList.add('is-loading');
    const originalContent = button.innerHTML;
    button.innerHTML = '<span class="spinner"></span>';

    try {
      const formData = new FormData();
      formData.append('id', variantId);
      formData.append('quantity', '1');

      const response = await fetch(Lumina.routes.cartAdd, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      // Check if response is ok before parsing JSON
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const contentType = response.headers.get('content-type');
      if (!contentType || !contentType.includes('application/json')) {
        throw new Error('Server returned non-JSON response');
      }

      const result = await response.json();

      if (result.status === 422) {
        this.showNotification(result.description || Lumina.cartStrings?.error || 'Error adding to cart', 'error');
        return;
      }

      // Refresh cart and open drawer
      document.dispatchEvent(new CustomEvent('cart:refresh'));

      if (Lumina.settings.cartType === 'drawer') {
        document.dispatchEvent(new CustomEvent('cart:open'));
      }

      this.showNotification(Lumina.cartStrings?.itemAdded || 'Added to cart');

    } catch (error) {
      console.error('Quick add error:', error);
      this.showNotification(Lumina.cartStrings?.error || 'Error adding to cart', 'error');
    } finally {
      button.disabled = false;
      button.classList.remove('is-loading');
      button.innerHTML = originalContent;
    }
  }

  showNotification(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast--${type}`;

    const messageSpan = document.createElement('span');
    messageSpan.className = 'toast__message';
    messageSpan.textContent = message;

    const closeBtn = document.createElement('button');
    closeBtn.className = 'toast__close';
    closeBtn.setAttribute('aria-label', 'Close');
    closeBtn.textContent = '×';

    toast.appendChild(messageSpan);
    toast.appendChild(closeBtn);
    document.body.appendChild(toast);

    requestAnimationFrame(() => toast.classList.add('is-visible'));

    const removeToast = () => {
      toast.classList.add('is-leaving');
      setTimeout(() => toast.remove(), 300);
    };

    closeBtn.addEventListener('click', removeToast);
    setTimeout(removeToast, 4000);
  }
}

// ============================================
// Quick View
// ============================================

class QuickView {
  constructor() {
    this.modal = document.querySelector('quick-view-modal');
    this.init();
  }

  init() {
    document.addEventListener('click', (e) => {
      const trigger = e.target.closest('[data-quick-view]');
      if (trigger) {
        e.preventDefault();
        this.open(trigger.dataset.quickView);
      }
    });
  }

  async open(productUrl) {
    if (!this.modal) return;

    this.modal.showLoading();

    try {
      // Use main-product section as fallback if quick-view section doesn't exist
      const response = await fetch(`${productUrl}?section_id=quick-view`, {
        credentials: 'same-origin'
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const html = await response.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');

      // Try multiple selectors for content
      const content = doc.querySelector('.quick-view__content')?.innerHTML
        || doc.querySelector('.main-product')?.innerHTML
        || doc.querySelector('.shopify-section')?.innerHTML;

      if (content) {
        this.modal.show(content);
      } else {
        throw new Error('No content found');
      }
    } catch (error) {
      console.error('Quick view error:', error);
      this.modal.showError(Lumina.cartStrings?.error || 'Failed to load product');
    }
  }
}

// ============================================
// Slideshow/Carousel
// ============================================

class Slideshow extends HTMLElement {
  constructor() {
    super();
    this.slides = this.querySelectorAll('.slideshow__slide');
    this.dots = this.querySelector('.slideshow__dots');
    this.prevBtn = this.querySelector('[data-slideshow-prev]');
    this.nextBtn = this.querySelector('[data-slideshow-next]');
    this.currentIndex = 0;
    this.autoplay = this.dataset.autoplay === 'true';
    this.autoplayInterval = parseInt(this.dataset.interval) || 5000;
    this.intervalId = null;
  }

  connectedCallback() {
    if (this.slides.length <= 1) return;

    this.createDots();
    this.prevBtn?.addEventListener('click', () => this.prev());
    this.nextBtn?.addEventListener('click', () => this.next());
    
    if (this.autoplay) {
      this.startAutoplay();
      this.addEventListener('mouseenter', () => this.stopAutoplay());
      this.addEventListener('mouseleave', () => this.startAutoplay());
    }

    // Touch support
    let touchStartX = 0;
    this.addEventListener('touchstart', (e) => touchStartX = e.touches[0].clientX);
    this.addEventListener('touchend', (e) => {
      const diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 50) diff > 0 ? this.next() : this.prev();
    });
  }

  createDots() {
    if (!this.dots) return;
    this.dots.innerHTML = this.slides.length > 1 
      ? Array.from(this.slides).map((_, i) => 
          `<button class="slideshow__dot ${i === 0 ? 'is-active' : ''}" data-index="${i}" aria-label="Go to slide ${i + 1}"></button>`
        ).join('')
      : '';
    
    this.dots.addEventListener('click', (e) => {
      if (e.target.classList.contains('slideshow__dot')) {
        this.goTo(parseInt(e.target.dataset.index));
      }
    });
  }

  goTo(index) {
    this.slides[this.currentIndex].classList.remove('is-active');
    this.dots?.children[this.currentIndex]?.classList.remove('is-active');
    
    this.currentIndex = (index + this.slides.length) % this.slides.length;
    
    this.slides[this.currentIndex].classList.add('is-active');
    this.dots?.children[this.currentIndex]?.classList.add('is-active');
  }

  next() { this.goTo(this.currentIndex + 1); }
  prev() { this.goTo(this.currentIndex - 1); }

  startAutoplay() {
    this.intervalId = setInterval(() => this.next(), this.autoplayInterval);
  }

  stopAutoplay() {
    clearInterval(this.intervalId);
  }
}

customElements.define('slideshow-component', Slideshow);

// ============================================
// Initialize
// ============================================

document.addEventListener('DOMContentLoaded', () => {
  new AnimationObserver();
  new QuickAdd();
  new QuickView();

  // Cart drawer trigger - intercept clicks on cart icon to open drawer
  document.querySelectorAll('[data-cart-open]').forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      if (Lumina.settings.cartType === 'drawer') {
        e.preventDefault();
        document.dispatchEvent(new CustomEvent('cart:open'));
      }
    });
  });

  // Search modal trigger
  document.querySelectorAll('[data-search-open]').forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      const searchModal = document.querySelector('search-modal');
      if (searchModal) searchModal.open();
    });
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  // Cart page quantity updates (AJAX)
  const cartForm = document.getElementById('cart-form');
  if (cartForm) {
    // Handle quantity changes on cart page
    cartForm.addEventListener('change', Lumina.debounce(async (e) => {
      const quantityInput = e.target.closest('[data-quantity-input]');
      if (!quantityInput) return;

      const quantityWrapper = quantityInput.closest('quantity-input');
      const line = quantityWrapper?.dataset.line;
      const quantity = parseInt(quantityInput.value, 10);

      if (!line) return;

      // Show loading state
      const cartItem = quantityInput.closest('.cart-item');
      if (cartItem) cartItem.classList.add('is-updating');

      try {
        const formData = new FormData();
        formData.append('line', line);
        formData.append('quantity', quantity.toString());

        const response = await fetch(Lumina.routes.cartChange, {
          method: 'POST',
          body: formData,
          credentials: 'same-origin',
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Reload page to show updated cart
        window.location.reload();

      } catch (error) {
        console.error('Failed to update cart:', error);
        if (cartItem) cartItem.classList.remove('is-updating');
        alert(Lumina.cartStrings?.error || 'Error updating cart');
      }
    }, 500));
  }
});

window.Lumina = Lumina;
