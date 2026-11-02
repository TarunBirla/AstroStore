# ✨ AstroStore - Premium Cosmic Vedic Astrology E-Commerce Platform

A complete, production-ready, enterprise-grade **Vedic Astrology & Gemstones E-commerce platform** built with **Laravel PHP**. Designed with a deeply immersive cosmic aesthetic, custom authentication (no Breeze/Jetstream bloat), complete client-side responsiveness, full Devotee user panel, and an extensive Master Acharya Admin Panel with visual analytics.

---

## 🎨 Cosmic Design System

| Element | Specification | Hex / Value |
| :--- | :--- | :--- |
| **Primary Base** | Deep Midnight Indigo | `#1a0b2e` |
| **Deep Secondary** | Royal Purple | `#3d1d6b` |
| **Vedic Accent** | Celestial Gold | `#d4af37` |
| **Sacred Accent** | Auspicious Saffron | `#ff9933` |
| **Text Primary** | Pure Starlight Cream | `#f5f0e6` |
| **Headings Font** | Google Font 'Cinzel' | `font-family: 'Cinzel', serif;` |
| **Body Font** | Google Font 'Poppins' | `font-family: 'Poppins', sans-serif;` |

*All color variables are centralized in `public/css/theme.css`.*

---

## 🔑 Default Celestial Credentials

### 1. Master Administrator
- **Login Portal:** `/admin/login`
- **Email:** `admin@astro.com`
- **Password:** `Admin@123`
- **Role:** `admin`

### 2. Demo Devotee (Customer)
- **Login Portal:** `/login`
- **Email:** `user@astro.com`
- **Password:** `User@123`
- **Role:** `user`

### 3. Active Consecrated Coupons
- `WELCOME10`: 10% Discount (Orders above ₹500, max discount ₹300)
- `FLAT200`: Flat ₹200 OFF (Orders above ₹1,200)
- `ASTRO20`: 20% Discount (Orders above ₹1,500, max discount ₹1,000)

---

## 🚀 Instant Local Installation & Run

1. **Clone / Open Workspace:**
   ```bash
   cd c:\Users\hp\Downloads\Astrologers
   ```

2. **Verify Database Configuration (`.env`):**
   The application is pre-configured with SQLite out of the box (`database/database.sqlite`), but also supports MySQL seamlessly:
   ```env
   DB_CONNECTION=sqlite
   # Or switch to MySQL:
   # DB_CONNECTION=mysql
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=astro_store
   # DB_USERNAME=root
   # DB_PASSWORD=
   ```

3. **Run Migrations & Seeders (if initializing new database):**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   php artisan storage:link
   ```

4. **Launch Local Server:**
   ```bash
   php artisan serve
   ```
   Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

---

## 🌐 1-Click Live Shared Hosting Setup Route

Live shared hosting environments (cPanel, DirectAdmin, Hostinger, GoDaddy) often do not provide SSH terminal access. AstroStore includes a dedicated, secure database initialization route:

### How to use:
1. Upload your files to shared hosting.
2. In your live `.env` file, set a secret key:
   ```env
   SETUP_KEY=ASTRO_SETUP_2026_SECRET
   SETUP_LOCKED=false
   ```
3. Visit the setup URL in your browser:
   ```
   https://yourdomain.com/setup-database?key=ASTRO_SETUP_2026_SECRET
   ```
4. This route automatically:
   - Verifies the database connection
   - Runs `Artisan::call('migrate --force')`
   - Runs `Artisan::call('db:seed --force')` (Creates Admin, Demo user, 6 categories, 18 demo products, 3 coupons, 4 banners, settings, 7 blogs)
   - Executes `Artisan::call('storage:link')`
   - Renders a cosmic success status dashboard displaying all generated tables and logs.
5. **Security Finalization:** Once the setup finishes, set `SETUP_LOCKED=true` in `.env` to permanently block subsequent executions.

---

## 📦 Complete Feature Matrix

### 1. Frontend Customer Experience
- **Celestial Hero Slider:** Dynamic banners managed from Admin Panel.
- **Sacred Categories:** Gemstones, Rudraksha, Yantras, Pooja Items, Astrology Books, Kundli & Consultation.
- **Shop & Live Filters:** Search keyword, Category checkboxes, Min/Max Price sliders, In-stock only filter, 4 sorting modes, pagination.
- **Product Detail:** Multi-image gallery with zoom switch, discount badges, stock alert, quantity selector, tabs for description, wearing vidhi, customer reviews, and related remedies.
- **7 Astrology Blogs:** In-depth Jyotish articles with author bio and reading counter.
- **Contact & Support:** Form saving directly to database with instant Acharya notification.
- **Informational Pages:** About Us, FAQs accordion, Privacy Policy, Terms, and 7-day Refund Policy.

### 2. Sacred Cart, Coupons & Divine Checkout
- **Cart Management:** AJAX Add to Cart, quantity increment/decrement, live navbar count badge, guest session merging upon login.
- **Free Shipping Progress Bar:** Real-time visual progress showing amount required for free insured shipping.
- **Vedic Coupons Engine:** Expiration dates, minimum order values, maximum discount caps, per-user usage restrictions, usage limit tracking.
- **Checkout:** Address pre-fill from devotee profile, optional "save to profile" toggle, custom Gotra/astrological birth notes.
- **Payment Channels:**
  - Cash on Delivery (COD)
  - Razorpay (Cards, NetBanking, UPI with Razorpay JS SDK)
  - Direct Scan & Pay UPI
- **Transaction Safety:** DB transactions wrap order creation, automatic inventory stock decrement, coupon usage registration, and Mailable order confirmation dispatch.

### 3. Devotee User Sanctuary (`/user`)
- **Dashboard:** Total orders, pending rites, completed deliveries, total amount spent, and wishlist counter.
- **Order History:** Filter by status (pending, processing, shipped, delivered, cancelled).
- **Order Detail:** Sacred fulfillment timeline, delivery address, payment method, cancel button (active strictly only while pending, restoring inventory stock immediately).
- **Printable Tax Invoice:** Clean high-resolution invoice with Sanskrit watermark seal.
- **Payment History:** Complete ledger of transactions with method, amount, status and dates.
- **Profile & Addresses:** Update name, phone, address, city, state, pincode, and profile avatar image upload.
- **Security:** Password change with current password validation.
- **Sacred Wishlist:** Saved items with 1-click cart addition.

### 4. Master Acharya Admin Panel (`/admin`)
- **Cosmic Sidebar:** Collapsible, responsive navigation with active state highlights.
- **Dashboard Visual Analytics:**
  - 6 Key metric cards (Gross Revenue, Total Orders, Pending Rites, Active Items, Devotees, Low Stock Alert)
  - 4 interactive Chart.js graphs: 12-Month Sales Trajectory, Order Status Doughnut, Category Inventory Distribution, and Last 7 Days Daily Revenue.
  - Recent orders and newly joined devotees widgets.
- **Sales Analytics:** Date range filter, average order value (AOV), total units dispatched, top-performing remedies table, coupon redemptions report, and 1-click **Export to CSV**.
- **Category CRUD:** Name, slug generation, image upload, status toggle, sort order.
- **Product CRUD:** Category selector, SKU, price, sale price, stock, short description, rich detailed description, main image upload + multiple gallery images (with preview & individual delete), featured toggle, status toggle, SEO fields.
- **Coupon CRUD:** Code, percentage / fixed amount, min order, max discount cap, start / end dates, status toggle.
- **Banner CRUD:** Hero slider & offer positions, subtitle, image upload, button CTA text, target link.
- **Order Management:** Filter by status, payment status, and date; status updates (pending, processing, shipped, delivered, cancelled); automatic stock restoration on cancellation.
- **Payment Management:** Audit payment ledger, method filters, status updates, total collection stats.
- **User Management:** Create new user/admin, edit particulars, block/unblock access, view devotee order history.
- **Moderation:** Review approval/rejection and contact query management.
- **Store Settings (Tabbed):** General, Contact, Shipping & Taxes, Payment Keys (Razorpay), Social Links, and SEO Defaults with automatic cache flushing.

---

## 🗂️ Files Created / Updated

- **Theme & Layouts:**
  - `public/css/theme.css`
  - `resources/views/layouts/app.blade.php`
  - `resources/views/layouts/admin.blade.php`
  - `resources/views/partials/header.blade.php`
  - `resources/views/partials/footer.blade.php`
  - `resources/views/partials/alerts.blade.php`
  - `resources/views/components/product-card.blade.php`
  - `resources/views/errors/404.blade.php`
  - `resources/views/errors/500.blade.php`
- **Database & Models:**
  - `database/migrations/2014_10_12_000000_create_users_table.php`
  - `database/migrations/2026_01_01_000001_create_astro_store_tables.php`
  - `database/seeders/DatabaseSeeder.php`
  - `app/Helpers/helpers.php`
  - Models in `app/Models/`: `User`, `Category`, `Product`, `ProductImage`, `Coupon`, `Order`, `OrderItem`, `Payment`, `Cart`, `Banner`, `Setting`, `Wishlist`, `Review`, `ContactMessage`, `CouponUsage`, `Blog`
- **Authentication & Middleware:**
  - `app/Http/Middleware/AdminMiddleware.php`
  - `app/Http/Controllers/Auth/LoginController.php`
  - `app/Http/Controllers/Auth/RegisterController.php`
  - `app/Http/Controllers/Auth/ForgotPasswordController.php`
  - `app/Http/Controllers/Admin/AuthController.php`
  - Views: `resources/views/auth/login.blade.php`, `register.blade.php`, `forgot-password.blade.php`, `reset-password.blade.php`, `resources/views/admin/auth/login.blade.php`
- **Frontend & E-Commerce:**
  - `app/Http/Controllers/HomeController.php`
  - `app/Http/Controllers/ShopController.php`
  - `app/Http/Controllers/FrontendProductController.php`
  - `app/Http/Controllers/BlogController.php`
  - `app/Http/Controllers/PageController.php`
  - `app/Http/Controllers/CartController.php`
  - `app/Http/Controllers/WishlistController.php`
  - `app/Http/Controllers/CheckoutController.php`
  - `app/Mail/OrderConfirmationMail.php`
  - Views: `resources/views/frontend/home.blade.php`, `shop.blade.php`, `category.blade.php`, `product-detail.blade.php`, `blogs/index.blade.php`, `blogs/show.blade.php`, `pages/about.blade.php`, `pages/contact.blade.php`, `pages/faq.blade.php`, `pages/privacy-policy.blade.php`, `pages/terms.blade.php`, `pages/refund-policy.blade.php`, `cart/index.blade.php`, `checkout/index.blade.php`, `checkout/thank-you.blade.php`, `emails/order-confirmation.blade.php`
- **User Sanctuary Panel:**
  - `app/Http/Controllers/User/DashboardController.php`
  - `app/Http/Controllers/User/OrderController.php`
  - `app/Http/Controllers/User/ProfileController.php`
  - Views: `resources/views/user/partials/sidebar.blade.php`, `dashboard.blade.php`, `orders/index.blade.php`, `orders/show.blade.php`, `orders/invoice.blade.php`, `transactions.blade.php`, `profile.blade.php`, `wishlist.blade.php`
- **Master Admin Panel:**
  - `app/Http/Controllers/Admin/DashboardController.php`
  - `app/Http/Controllers/Admin/AnalyticsController.php`
  - `app/Http/Controllers/Admin/CategoryController.php`
  - `app/Http/Controllers/Admin/ProductController.php`
  - `app/Http/Controllers/Admin/CouponController.php`
  - `app/Http/Controllers/Admin/BannerController.php`
  - `app/Http/Controllers/Admin/OrderController.php`
  - `app/Http/Controllers/Admin/PaymentController.php`
  - `app/Http/Controllers/Admin/UserController.php`
  - `app/Http/Controllers/Admin/ReviewController.php`
  - `app/Http/Controllers/Admin/ContactMessageController.php`
  - `app/Http/Controllers/Admin/SettingController.php`
  - Views in `resources/views/admin/`: `dashboard.blade.php`, `analytics/index.blade.php`, `categories/*`, `products/*`, `coupons/*`, `banners/*`, `orders/*`, `payments/*`, `users/*`, `reviews/*`, `messages/*`, `settings/*`
- **Routes:**
  - `routes/web.php`
  - `routes/admin.php`
"# AstroStore" 
