

// Cart State (in-memory storage)
let cart = [];
let darkMode = false;

// Initialize App
document.addEventListener('DOMContentLoaded', function() {
    initApp();
});

function initApp() {
    // Load featured products on home page (only if container exists)
    if (document.getElementById('featuredProducts')) {
        loadFeaturedProducts();
    }

    // Setup scroll animations
    setupScrollAnimations();

    // Setup navbar scroll effect
    setupNavbarScroll();

    // Update cart badge
    updateCartBadge();

    // Setup dark mode toggle
    setupDarkMode();

    // Setup scroll to top button
    setupScrollToTop();
}


function updateActiveNavLink(pageName) {
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.classList.remove('active');
    });

    // Map page names to nav link text
    const navMap = {
        'home': 'الرئيسية',
        'products': 'المنتجات',
        'about': 'من نحن',
        'contact': 'اتصل بنا'
    };

    const targetText = navMap[pageName];
    if (targetText) {
        navLinks.forEach(link => {
            if (link.textContent.trim() === targetText) {
                link.classList.add('active');
            }
        });
    }
}




function changeQuantity(delta) {
    const quantityEl = document.getElementById('detailQuantity');
    let quantity = parseInt(quantityEl.textContent);
    quantity = Math.max(1, quantity + delta);
    quantityEl.textContent = quantity;
}

function addToCartWithQuantity(productId) {
    const quantity = parseInt(document.getElementById('detailQuantity').textContent);
    addToCart(productId, quantity);
}

// Cart Functions
function addToCart(productId, quantity = 1) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    // Check if product already in cart
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({
            ...product,
            quantity: quantity
        });
    }

    updateCartBadge();
    showToast(`تمت إضافة ${product.name} إلى السلة`);
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCartBadge();
    loadCart();
    showToast('تم حذف المنتج من السلة');
}

function updateCartQuantity(productId, delta) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity = Math.max(1, item.quantity + delta);
        updateCartBadge();
        loadCart();
    }
}

function updateCartBadge() {
    const badge = document.getElementById('cartCount');
    if (!badge) return; // Exit if badge doesn't exist

    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    badge.textContent = totalItems;

    // Also update wishlist badge if it exists
    const wishlistBadge = document.getElementById('wishlistCount');
    if (wishlistBadge) {
        // You can update this based on actual wishlist count
        wishlistBadge.textContent = '0';
    }
}

function loadCart() {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartSummaryContainer = document.getElementById('cartSummary');
    const emptyCartContainer = document.getElementById('emptyCart');

    // Exit if containers don't exist (not on cart page)
    if (!cartItemsContainer || !cartSummaryContainer || !emptyCartContainer) {
        return;
    }

    if (cart.length === 0) {
        cartItemsContainer.style.display = 'none';
        cartSummaryContainer.style.display = 'none';
        emptyCartContainer.style.display = 'block';
        return;
    }

    cartItemsContainer.style.display = 'block';
    cartSummaryContainer.style.display = 'block';
    emptyCartContainer.style.display = 'none';

    // Render cart items
    let cartHTML = '';
    cart.forEach(item => {
        cartHTML += `
            <div class="cart-item">
                <div class="cart-item-image">
                    <img src="${item.image}" alt="${item.name}">
                </div>
                <div class="cart-item-info">
                    <h4 class="cart-item-name">${item.name}</h4>
                    <p class="cart-item-price">${item.price} ريال</p>
                </div>
                <div class="cart-item-actions">
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateCartQuantity(${item.id}, -1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="quantity-value">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateCartQuantity(${item.id}, 1)">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <button class="btn btn-outline-primary btn-sm" onclick="removeFromCart(${item.id})">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </div>
                <div class="ms-auto">
                    <strong>${item.price * item.quantity} ريال</strong>
                </div>
            </div>
        `;
    });
    cartItemsContainer.innerHTML = cartHTML;

    // Calculate totals
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = subtotal * 0.15;
    const total = subtotal + tax;

    // Render cart summary
    const summaryHTML = `
        <h4>ملخص الطلب</h4>
        <div class="summary-row">
            <span>المجموع الفرعي:</span>
            <span>${subtotal.toFixed(2)} ريال</span>
        </div>
        <div class="summary-row">
            <span>الضريبة (15%):</span>
            <span>${tax.toFixed(2)} ريال</span>
        </div>
        <div class="summary-row total">
            <span>الإجمالي:</span>
            <span>${total.toFixed(2)} ريال</span>
        </div>
        <button class="btn btn-gold w-100 mt-3" onclick="handleCheckout()">
            <i class="fas fa-credit-card"></i>
            إتمام الشراء
        </button>
        <button class="btn btn-outline-primary w-100 mt-2" onclick="showPage('products')">
            <i class="fas fa-arrow-right"></i>
            متابعة التسوق
        </button>
    `;
    cartSummaryContainer.innerHTML = summaryHTML;
}

function handleCheckout() {
    showToast('شكراً لك! سيتم التواصل معك قريباً لإتمام الطلب');
    cart = [];
    updateCartBadge();
    loadCart();
}

// Dark Mode
function toggleDarkMode() {
    darkMode = !darkMode;
    document.body.classList.toggle('dark-mode');

    const themeIcon = document.getElementById('themeIcon');
    if (darkMode) {
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    } else {
        themeIcon.classList.remove('fa-sun');
        themeIcon.classList.add('fa-moon');
    }
}

// Toast Notification
function showToast(message) {
    const toastEl = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');

    toastMessage.textContent = message;

    const toast = new bootstrap.Toast(toastEl, {
        autohide: true,
        delay: 3000
    });

    toast.show();
}

// Navbar Scroll Effect
function setupNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// Scroll Animations
function setupScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all elements with scroll-fade-in class
    const animateElements = document.querySelectorAll('.scroll-fade-in');
    animateElements.forEach(el => observer.observe(el));

    // Re-observe when new content is loaded
    const reObserve = function() {
        const newElements = document.querySelectorAll('.scroll-fade-in:not(.visible)');
        newElements.forEach(el => observer.observe(el));
    };

    // Call reObserve periodically
    setInterval(reObserve, 1000);
}

// Contact Form
function handleContactSubmit(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    showToast(`شكراً ${name}! تم إرسال رسالتك بنجاح`);

    // Reset form
    event.target.reset();

    return false;
}

// Dark Mode Toggle
function setupDarkMode() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (!darkModeToggle) return;

    // Check for saved dark mode preference or system preference
    const savedDarkMode = localStorage.getItem('darkMode');
    let isDarkMode = false;

    if (savedDarkMode !== null) {
        // Use saved preference if exists
        isDarkMode = savedDarkMode === 'true';
    } else {
        // Check system preference
        isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    }

    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        darkMode = true;
        updateDarkModeIcon();
    }

    darkModeToggle.addEventListener('click', function() {
        darkMode = !darkMode;
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', darkMode);
        updateDarkModeIcon();
    });

    // Listen for system theme changes
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            // Only apply system preference if user hasn't manually set a preference
            if (localStorage.getItem('darkMode') === null) {
                darkMode = e.matches;
                if (darkMode) {
                    document.body.classList.add('dark-mode');
                } else {
                    document.body.classList.remove('dark-mode');
                }
                updateDarkModeIcon();
            }
        });
    }
}

function updateDarkModeIcon() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (!darkModeToggle) return;

    const icon = darkModeToggle.querySelector('i');
    if (icon) {
        icon.className = darkMode ? 'fas fa-sun' : 'fas fa-moon';
    }
}

// Scroll to Top Button
function setupScrollToTop() {
    const scrollBtn = document.getElementById('scrollToTop');
    if (!scrollBtn) return;

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollBtn.style.display = 'block';
        } else {
            scrollBtn.style.display = 'none';
        }
    });

    scrollBtn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Toast Notification Helper
function showToast(message) {
    const toastEl = document.getElementById('liveToast');
    if (!toastEl) return;

    const toastBody = toastEl.querySelector('.toast-body');
    if (toastBody) {
        toastBody.textContent = message;
    }

    const toast = new bootstrap.Toast(toastEl);
    toast.show();
}
