// Products Data
const products = [
    {
        id: 1,
        name: "زيت الزيتون البكر",
        nameEn: "Extra Virgin Olive Oil",
        price: 120,
        description: "زيت زيتون بكر ممتاز، عصرة أولى باردة، غني بمضادات الأكسدة والفيتامينات",
        image: "https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400",
        category: "زيوت",
        badge: "جديد"
    },
    {
        id: 2,
        name: "عسل طبيعي",
        nameEn: "Natural Honey",
        price: 85,
        description: "عسل طبيعي نقي 100%، من المناحل الجبلية، غني بالفوائد الصحية",
        image: "https://images.unsplash.com/photo-1587049352846-4a222e784403?w=400",
        category: "عسل",
        badge: "مميز"
    },
    {
        id: 3,
        name: "زعتر بري",
        nameEn: "Wild Thyme",
        price: 45,
        description: "زعتر بري أصلي، مجفف طبيعياً، نكهة مميزة وفوائد صحية",
        image: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400",
        category: "أعشاب",
        badge: ""
    },
    {
        id: 4,
        name: "حبة البركة",
        nameEn: "Black Seed",
        price: 35,
        description: "حبة البركة الأصلية، غنية بالفوائد العلاجية والصحية",
        image: "https://images.unsplash.com/photo-1505944357732-f164ca0adfb3?w=400",
        category: "بذور",
        badge: ""
    },
    {
        id: 5,
        name: "كركم عضوي",
        nameEn: "Organic Turmeric",
        price: 55,
        description: "كركم عضوي نقي، مضاد للالتهابات ومقوي للمناعة",
        image: "https://images.unsplash.com/photo-1615485500834-bc10199bc2bf?w=400",
        category: "توابل",
        badge: "عضوي"
    },
    {
        id: 6,
        name: "قرفة سيلانية",
        nameEn: "Ceylon Cinnamon",
        price: 40,
        description: "قرفة سيلانية أصلية، جودة عالية ونكهة مميزة",
        image: "https://images.unsplash.com/photo-1599909438361-781c8e331a2e?w=400",
        category: "توابل",
        badge: ""
    }
];

// Cart State (in-memory storage)
let cart = [];
let darkMode = false;

// Initialize App
document.addEventListener('DOMContentLoaded', function() {
    initApp();
});

function initApp() {
    // Load featured products on home page
    loadFeaturedProducts();
    
    // Setup scroll animations
    setupScrollAnimations();
    
    // Setup navbar scroll effect
    setupNavbarScroll();
    
    // Update cart badge
    updateCartBadge();
    
    // Show home page by default
    showPage('home');
}

// Page Navigation
function showPage(pageName) {
    // Hide all pages
    const pages = document.querySelectorAll('.page');
    pages.forEach(page => {
        page.classList.remove('active');
    });
    
    // Show selected page
    const targetPage = document.getElementById(pageName + 'Page');
    if (targetPage) {
        targetPage.classList.add('active');
        
        // Load page specific content
        if (pageName === 'products') {
            loadAllProducts();
        } else if (pageName === 'cart') {
            loadCart();
        }
        
        // Update active nav link
        updateActiveNavLink(pageName);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
        
        // Close mobile menu if open
        const navbarCollapse = document.querySelector('.navbar-collapse');
        if (navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
        }
    }
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

// Load Products
function loadFeaturedProducts() {
    const container = document.getElementById('featuredProducts');
    if (!container) return;
    
    container.innerHTML = '';
    
    // Show first 3 products
    products.slice(0, 3).forEach(product => {
        container.innerHTML += createProductCard(product);
    });
}

function loadAllProducts() {
    const container = document.getElementById('allProducts');
    if (!container) return;
    
    container.innerHTML = '';
    
    products.forEach(product => {
        container.innerHTML += createProductCard(product);
    });
}

function createProductCard(product) {
    const badgeHTML = product.badge ? `<span class="product-badge">${product.badge}</span>` : '';
    
    return `
        <div class="col-lg-4 col-md-6">
            <div class="product-card scroll-fade-in">
                <div class="product-image">
                    <img src="${product.image}" alt="${product.name}" loading="lazy">
                    ${badgeHTML}
                </div>
                <div class="product-body">
                    <div class="product-category">${product.category}</div>
                    <h3 class="product-name">${product.name}</h3>
                    <p class="product-description">${product.description}</p>
                    <div class="product-footer">
                        <div class="product-price">
                            ${product.price} <small>ريال</small>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 mt-3" onclick="addToCart(${product.id})">
                        <i class="fas fa-shopping-cart"></i>
                        أضف للسلة
                    </button>
                    <button class="btn btn-outline-primary w-100 mt-2" onclick="showProductDetail(${product.id})">
                        <i class="fas fa-eye"></i>
                        عرض التفاصيل
                    </button>
                </div>
            </div>
        </div>
    `;
}

// Product Detail
function showProductDetail(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;
    
    // Update breadcrumb
    document.getElementById('breadcrumbProduct').textContent = product.name;
    
    // Create product detail HTML
    const detailHTML = `
        <div class="col-lg-6">
            <div class="product-detail-image">
                <img src="${product.image}" alt="${product.name}" class="img-fluid">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="product-detail-info">
                <div class="product-category">${product.category}</div>
                <h1 class="product-name">${product.name}</h1>
                <p class="text-secondary">${product.nameEn}</p>
                <div class="product-detail-price">${product.price} ريال</div>
                <p class="product-description">${product.description}</p>
                
                <div class="quantity-selector">
                    <label>الكمية:</label>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="changeQuantity(-1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="quantity-value" id="detailQuantity">1</span>
                        <button class="quantity-btn" onclick="changeQuantity(1)">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                
                <button class="btn btn-gold btn-lg w-100" onclick="addToCartWithQuantity(${product.id})">
                    <i class="fas fa-shopping-cart"></i>
                    أضف للسلة
                </button>
                
                <div class="mt-4">
                    <h5>المواصفات:</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> منتج طبيعي 100%</li>
                        <li><i class="fas fa-check text-success"></i> جودة عالية مضمونة</li>
                        <li><i class="fas fa-check text-success"></i> مصدر موثوق</li>
                        <li><i class="fas fa-check text-success"></i> معتمد ومفحوص</li>
                    </ul>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('productDetailContent').innerHTML = detailHTML;
    
    // Load related products
    loadRelatedProducts(product.category, product.id);
    
    // Show product detail page
    showPage('productDetail');
}

function loadRelatedProducts(category, excludeId) {
    const container = document.getElementById('relatedProducts');
    if (!container) return;
    
    const relatedProducts = products.filter(p => p.category === category && p.id !== excludeId);
    
    container.innerHTML = '';
    relatedProducts.slice(0, 3).forEach(product => {
        container.innerHTML += createProductCard(product);
    });
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
    const badge = document.getElementById('cartBadge');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    badge.textContent = totalItems;
    badge.style.display = totalItems > 0 ? 'flex' : 'none';
}

function loadCart() {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartSummaryContainer = document.getElementById('cartSummary');
    const emptyCartContainer = document.getElementById('emptyCart');
    
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
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNav');
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