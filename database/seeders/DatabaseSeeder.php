<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Blog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Users (Admin + Demo User)
        User::updateOrCreate(
            ['email' => 'admin@astro.com'],
            [
                'name' => 'Master Acharya (Admin)',
                'email' => 'admin@astro.com',
                'phone' => '+91 9876543210',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'status' => 'active',
                'address' => 'Vedic Jyotish Kendra, Ghat Marg',
                'city' => 'Varanasi',
                'state' => 'Uttar Pradesh',
                'pincode' => '221001',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@astro.com'],
            [
                'name' => 'Aarav Sharma',
                'email' => 'user@astro.com',
                'phone' => '+91 9123456780',
                'password' => Hash::make('User@123'),
                'role' => 'user',
                'status' => 'active',
                'address' => 'Flat 402, Shanti Heights, Malad West',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'pincode' => '400064',
            ]
        );

        // 2. Settings
        $settings = [
            'site_name' => 'AstroStore',
            'site_tagline' => 'Sacred Vedic Astrology, Energised Gemstones & Blessings',
            'email' => 'blessings@astrostore.com',
            'phone' => '+91 98765 43210',
            'address' => '108 Cosmic Enclave, Mandir Road, Varanasi, UP - 221001',
            'currency' => 'INR',
            'currency_symbol' => '₹',
            'shipping_charge' => '70',
            'free_shipping_above' => '999',
            'tax_percent' => '3',
            'facebook_url' => 'https://facebook.com/astrostore',
            'instagram_url' => 'https://instagram.com/astrostore',
            'youtube_url' => 'https://youtube.com/astrostore',
            'whatsapp_number' => '+919876543210',
            'razorpay_key_id' => 'rzp_test_astro_dummy_key',
            'razorpay_key_secret' => 'rzp_test_astro_dummy_secret',
            'meta_title' => 'AstroStore | 100% Certified Astrological Gemstones, Rudraksha & Consultations',
            'meta_description' => 'India\'s revered Vedic Astrological store offering lab-certified energised gemstones, genuine Nepal rudraksha beads, powerful brass yantras and expert Jyotish Kundli consultations.',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(['key' => $key], ['value' => $val]);
        }

        // 3. Coupons
        $coupons = [
            [
                'code' => 'WELCOME10',
                'type' => 'percent',
                'value' => 10,
                'min_order' => 500,
                'max_discount' => 300,
                'usage_limit' => 1000,
                'start_date' => now()->subDays(5),
                'end_date' => now()->addMonths(6),
                'status' => 1,
            ],
            [
                'code' => 'FLAT200',
                'type' => 'fixed',
                'value' => 200,
                'min_order' => 1200,
                'max_discount' => 200,
                'usage_limit' => 500,
                'start_date' => now()->subDays(5),
                'end_date' => now()->addMonths(6),
                'status' => 1,
            ],
            [
                'code' => 'ASTRO20',
                'type' => 'percent',
                'value' => 20,
                'min_order' => 1500,
                'max_discount' => 1000,
                'usage_limit' => 200,
                'start_date' => now()->subDays(5),
                'end_date' => now()->addMonths(6),
                'status' => 1,
            ],
        ];

        foreach ($coupons as $c) {
            Coupon::updateOrCreate(['code' => $c['code']], $c);
        }

        // 4. Banners
        $banners = [
            [
                'title' => 'Divine Planetary Alignment & Energised Gemstones',
                'subtitle' => 'Unlock cosmic fortune with 100% Gov-Lab certified planetary ratnas consecrated with sacred Vedic mantras.',
                'image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=1400&q=80',
                'button_text' => 'Explore Sacred Gems',
                'button_link' => '/shop?category=gemstones',
                'position' => 'home_slider',
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Sacred Siddh 1 to 14 Mukhi Nepal Rudraksha',
                'subtitle' => 'Experience peace, health and Lord Shiva\'s supreme grace with authenticated Himalayan Rudraksha beads.',
                'image' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?auto=format&fit=crop&w=1400&q=80',
                'button_text' => 'Shop Blessed Rudraksha',
                'button_link' => '/shop?category=rudraksha',
                'position' => 'home_slider',
                'sort_order' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Personalized Vedic Kundli & Career Astrology',
                'subtitle' => 'Live video consultations with revered Varanasi Jyotish Acharyas with accurate Dasha predictions.',
                'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=1400&q=80',
                'button_text' => 'Book Acharya Consultation',
                'button_link' => '/shop?category=kundli-and-consultation',
                'position' => 'home_slider',
                'sort_order' => 3,
                'status' => 1,
            ],
            [
                'title' => 'Auspicious Navratri & Diwali Maha Yantra Offer',
                'subtitle' => 'Get up to 30% discount on energized 24K Gold Plated Shree Yantras for eternal prosperity & Vastu balance.',
                'image' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=1200&q=80',
                'button_text' => 'Claim Divine Offer',
                'button_link' => '/shop',
                'position' => 'offer',
                'sort_order' => 1,
                'status' => 1,
            ]
        ];

        foreach ($banners as $b) {
            Banner::updateOrCreate(['title' => $b['title']], $b);
        }

        // 5. 6 Categories
        $categoriesData = [
            [
                'name' => 'Gemstones',
                'slug' => 'gemstones',
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=600&q=80',
                'description' => 'Certified Jyotish quality Yellow Sapphire, Blue Sapphire, Natural Ruby, Emerald & Pearl energised for planetary pacification.',
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Rudraksha',
                'slug' => 'rudraksha',
                'image' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?auto=format&fit=crop&w=600&q=80',
                'description' => 'Authentic Nepalese Rudraksha beads (1 Mukhi to 14 Mukhi), Gauri Shankar and Siddh Malas blessed with Prana Pratishtha.',
                'sort_order' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Yantras',
                'slug' => 'yantras',
                'image' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=600&q=80',
                'description' => 'Sacred geometric 24K Gold-Plated and pure copper yantras including Maha Meru Shree Yantra and Kuber Yantra.',
                'sort_order' => 3,
                'status' => 1,
            ],
            [
                'name' => 'Pooja Items',
                'slug' => 'pooja-items',
                'image' => 'https://images.unsplash.com/photo-1583083527882-4bee9aba2eea?auto=format&fit=crop&w=600&q=80',
                'description' => 'Pure Brass Diyas, Gangajal, Pure Kasturi Chandan, Sambrani Dhoop and sacred Hawan Samagri.',
                'sort_order' => 4,
                'status' => 1,
            ],
            [
                'name' => 'Astrology Books',
                'slug' => 'astrology-books',
                'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=80',
                'description' => 'Authentic commentaries on Brihat Parashara Hora Shastra, Lal Kitab, Vedic Astrology & Palmistry guides.',
                'sort_order' => 5,
                'status' => 1,
            ],
            [
                'name' => 'Kundli and Consultation',
                'slug' => 'kundli-and-consultation',
                'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=600&q=80',
                'description' => 'Comprehensive 50+ pages Janam Kundli analysis reports and 1-on-1 video consultations with gold-medalist Astrologers.',
                'sort_order' => 6,
                'status' => 1,
            ],
        ];

        $createdCategories = [];
        foreach ($categoriesData as $c) {
            $createdCategories[$c['slug']] = Category::updateOrCreate(['slug' => $c['slug']], $c);
        }

        // 6. Products: 3 in each category (18 demo products)
        $productsData = [
            // Gemstones
            [
                'category_slug' => 'gemstones',
                'name' => 'Natural Ceylon Yellow Sapphire (Pukhraj) - 4.25 Ratti',
                'slug' => 'natural-ceylon-yellow-sapphire-pukhraj-4-25-ratti',
                'sku' => 'GEM-PUK-425',
                'short_description' => '100% Unheated Vedic Yellow Sapphire from Sri Lanka for Jupiter (Brihaspati) blessings, wisdom & wealth.',
                'description' => 'Our Natural Ceylon Yellow Sapphire (Pukhraj) is certified by reputed Gem Testing Laboratories. Consecrated with 108 Gayatri and Brihaspati Beej Mantras on auspicious Thursday Pushya Nakshatra. Ideal for wearing in Gold or Panchdhatu ring on index finger.',
                'price' => 18500.00,
                'sale_price' => 15999.00,
                'stock' => 12,
                'main_image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'gemstones',
                'name' => 'Natural Colombian Emerald (Panna) - 5.15 Ratti',
                'slug' => 'natural-colombian-emerald-panna-5-15-ratti',
                'sku' => 'GEM-PAN-515',
                'short_description' => 'Deep vivid green certified Emerald for Mercury (Budh) blessings, sharp intellect, communication & business growth.',
                'description' => 'Finest quality Colombian Emerald exhibiting rich emerald cut and dazzling luster. Specifically recommended for businessmen, chartered accountants, students and creative artists seeking planetary elevation of planet Budh.',
                'price' => 14200.00,
                'sale_price' => 12499.00,
                'stock' => 8,
                'main_image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'gemstones',
                'name' => 'Natural Burmese Ruby (Manikya) - 3.75 Ratti',
                'slug' => 'natural-burmese-ruby-manikya-3-75-ratti',
                'sku' => 'GEM-RUB-375',
                'short_description' => 'Pigeon blood red untreated Ruby for Sun (Surya Dev) pacification, leadership, vitality & royal authority.',
                'description' => 'A royal gemstone that invokes leadership aura and physical vitality. Untreated and certified natural ruby, energized with Aditya Hridaya Stotra during Sunday sunrise.',
                'price' => 22000.00,
                'sale_price' => 18999.00,
                'stock' => 5,
                'main_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],

            // Rudraksha
            [
                'category_slug' => 'rudraksha',
                'name' => 'Original Nepal 5 Mukhi Rudraksha Mala (108+1 Beads)',
                'slug' => 'original-nepal-5-mukhi-rudraksha-mala-108-beads',
                'sku' => 'RUD-5M-108',
                'short_description' => 'Traditional high-energy Nepali 5 Mukhi beads knotted in pure silk thread for Japa and health harmony.',
                'description' => 'The most universally beneficial bead ruled by planet Jupiter and Lord Kalagni Rudra. Calms blood pressure, stabilizes nervous energies, and enhances concentration during meditation.',
                'price' => 1899.00,
                'sale_price' => 1299.00,
                'stock' => 45,
                'main_image' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'rudraksha',
                'name' => 'Certified Rare 7 Mukhi Nepal Rudraksha Bead (Mahalaxmi Swaroop)',
                'slug' => 'certified-rare-7-mukhi-nepal-rudraksha-bead',
                'sku' => 'RUD-7M-NEP',
                'short_description' => 'Blessed by Goddess Mahalakshmi and ruled by planet Venus (Shukra), attracts financial abundance and fortune.',
                'description' => 'Seven Mukhi Rudraksha is famed for dissolving financial blocks, removing Saturn (Shani Sade Sati) malefic impacts, and opening channels for prosperity in enterprise.',
                'price' => 3800.00,
                'sale_price' => 2999.00,
                'stock' => 15,
                'main_image' => 'https://images.unsplash.com/photo-1615655406736-b37c4fabf923?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'rudraksha',
                'name' => 'Siddh Gauri Shankar Rudraksha (Divine Union)',
                'slug' => 'siddh-gauri-shankar-rudraksha-divine-union',
                'sku' => 'RUD-GS-DIV',
                'short_description' => 'Two naturally conjoined Rudraksha beads representing Lord Shiva and Mata Parvati for marital bliss and harmony.',
                'description' => 'Gauri Shankar Rudraksha is renowned for resolving relationship conflicts, bringing auspicious marriage proposals, and harmonizing family dynamics.',
                'price' => 6500.00,
                'sale_price' => 5499.00,
                'stock' => 7,
                'main_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],

            // Yantras
            [
                'category_slug' => 'yantras',
                'name' => '24K Gold Plated Maha Meru Shree Yantra (Heavy Brass)',
                'slug' => '24k-gold-plated-maha-meru-shree-yantra-heavy-brass',
                'sku' => 'YAN-SHR-MM',
                'short_description' => '3D Sacred Geometry Maha Meru Shree Yantra consecrated to infuse cosmic radiance, wealth and positive vastu.',
                'description' => 'Cast in virgin brass with thick 24K gold foil plating. The 3D pyramidal design harnesses supreme cosmic wavelengths, purifying electromagnetic fields of homes and corporate offices.',
                'price' => 4500.00,
                'sale_price' => 3499.00,
                'stock' => 20,
                'main_image' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'yantras',
                'name' => 'Energised Pure Copper Kuber Yantra Plate (6x6 inch)',
                'slug' => 'energised-pure-copper-kuber-yantra-plate-6x6-inch',
                'sku' => 'YAN-KUB-COP',
                'short_description' => 'Hand-etched pure copper yantra invoking Lord Kuber for cash flow stabilization, debt clearance and savings.',
                'description' => 'Placing this energized Kuber Yantra inside cash boxes, lockers, or North-East corners of offices invites unceasing opportunities and shields from fiscal distress.',
                'price' => 1499.00,
                'sale_price' => 999.00,
                'stock' => 35,
                'main_image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],
            [
                'category_slug' => 'yantras',
                'name' => 'Vastu Dosh Nivaran Yantra in Wooden Frame',
                'slug' => 'vastu-dosh-nivaran-yantra-in-wooden-frame',
                'sku' => 'YAN-VAS-FRM',
                'short_description' => 'Neutralizes severe architectural Vastu flaws without demolition. Enclosed in ornate teak finish wall frame.',
                'description' => 'Combines 8 directional directional protective yantras into one holistic mandala. Recommended for homes facing South or West entry directions.',
                'price' => 2100.00,
                'sale_price' => 1650.00,
                'stock' => 18,
                'main_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],

            // Pooja Items
            [
                'category_slug' => 'pooja-items',
                'name' => 'Handcrafted Brass Akhand Jyot Diya with Glass Chimney',
                'slug' => 'handcrafted-brass-akhand-jyot-diya-with-glass-chimney',
                'sku' => 'POO-AKH-DIY',
                'short_description' => 'Heavy brass eternal flame oil lamp engineered for continuous non-stop burn during Navratri & daily prayers.',
                'description' => 'Crafted by master artisans of Moradabad using solid pure bell brass. Equipped with thermal-resistant borosilicate glass chimney that protects sacred flame from drafts.',
                'price' => 1650.00,
                'sale_price' => 1299.00,
                'stock' => 40,
                'main_image' => 'https://images.unsplash.com/photo-1583083527882-4bee9aba2eea?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'pooja-items',
                'name' => 'Pure Himalayan Kasturi Chandan Paste (100g Bottle)',
                'slug' => 'pure-himalayan-kasturi-chandan-paste-100g-bottle',
                'sku' => 'POO-KAS-CHN',
                'short_description' => 'Pure natural sandalwood infused with Vedic herbal fragrances for deity Abhishek and auspicious Tilak.',
                'description' => 'Natural Chandan soothing for the Third Eye (Ajna Chakra). Calms mental chatter, reduces anger and invites positive sattvic vibrations during japa.',
                'price' => 750.00,
                'sale_price' => 599.00,
                'stock' => 60,
                'main_image' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],
            [
                'category_slug' => 'pooja-items',
                'name' => 'Natural White Dakshinavarti Shankh (Blowing Conch Shell)',
                'slug' => 'natural-white-dakshinavarti-shankh-conch-shell',
                'sku' => 'POO-DAK-SHK',
                'short_description' => 'Natural sea conch shell associated with Goddess Lakshmi, fills environment with purifying OM frequencies.',
                'description' => 'Sound vibrations produced from blowing this conch disperse negative biological energies and cleanse atmospheric bacteria.',
                'price' => 2999.00,
                'sale_price' => 2399.00,
                'stock' => 14,
                'main_image' => 'https://images.unsplash.com/photo-1615655406736-b37c4fabf923?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],

            // Astrology Books
            [
                'category_slug' => 'astrology-books',
                'name' => 'Brihat Parashara Hora Shastra (2 Volumes Hardbound Deluxe)',
                'slug' => 'brihat-parashara-hora-shastra-2-volumes-hardbound-deluxe',
                'sku' => 'BOK-BPHS-02',
                'short_description' => 'The foundational encyclopaedia of Vedic astrology by Sage Parashara with exhaustive Hindi & English commentary.',
                'description' => 'Over 100 chapters covering Dasha systems, planetary combinations (Yogas), divisional charts (Vargas), and longevity calculation techniques.',
                'price' => 2400.00,
                'sale_price' => 1999.00,
                'stock' => 25,
                'main_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],
            [
                'category_slug' => 'astrology-books',
                'name' => 'Lal Kitab: The Miraculous Remedies of Destiny',
                'slug' => 'lal-kitab-the-miraculous-remedies-of-destiny',
                'sku' => 'BOK-LAL-KIT',
                'short_description' => 'Classic practical astrological remedies for instant planetary pacification and karma resolution.',
                'description' => 'Clear, accessible explanations of planetary house positions and simple, non-expensive domestic remedies that yield immediate tangible relief.',
                'price' => 950.00,
                'sale_price' => 799.00,
                'stock' => 30,
                'main_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],
            [
                'category_slug' => 'astrology-books',
                'name' => 'Practical Palmistry & Hasta Rekha Shastra Illustrated',
                'slug' => 'practical-palmistry-hasta-rekha-shastra-illustrated',
                'sku' => 'BOK-PAL-HAS',
                'short_description' => 'Full color guide to hand reading, mounts, life lines, fate lines and timing of major life transformations.',
                'description' => 'Contains 200+ detailed hand diagrams to read health, wealth, love, divorce, and overseas travel indications directly from palms.',
                'price' => 850.00,
                'sale_price' => 699.00,
                'stock' => 22,
                'main_image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],

            // Kundli and Consultation
            [
                'category_slug' => 'kundli-and-consultation',
                'name' => 'Personalized 50+ Page Vedic Kundli Horoscope (Deluxe Spiral Print)',
                'slug' => 'personalized-50-page-vedic-kundli-horoscope-print',
                'sku' => 'KUN-PRN-50P',
                'short_description' => 'Calculated with Swiss Ephemeris micro-precision: Complete 120-year Vimshottari Dasha, Sade Sati & Gemstone recommendations.',
                'description' => 'A lifetime heirloom report compiled specifically for your exact date, time and city of birth. Printed on gold-bordered archival parchment and delivered directly to your doorstep.',
                'price' => 1999.00,
                'sale_price' => 1499.00,
                'stock' => 100,
                'main_image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'kundli-and-consultation',
                'name' => '1-on-1 Live Video Consultation with Senior Acharya (45 Mins)',
                'slug' => '1-on-1-live-video-consultation-senior-acharya-45-mins',
                'sku' => 'KUN-VID-45M',
                'short_description' => 'Private video session addressing career, relationship, finances, medical concerns and tailored Vedic remedies.',
                'description' => 'Interact face-to-face with an experienced Varanasi Jyotish scholar. Includes comprehensive chart reading, immediate question-answer period, and a written remedy sheet sent post-call.',
                'price' => 3500.00,
                'sale_price' => 2499.00,
                'stock' => 50,
                'main_image' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 1,
            ],
            [
                'category_slug' => 'kundli-and-consultation',
                'name' => 'Vedic Kundli Matchmaking & Gun Milan Report (Kundli Milan)',
                'slug' => 'vedic-kundli-matchmaking-gun-milan-report',
                'sku' => 'KUN-MIL-REP',
                'short_description' => 'Detailed 36 Guna Ashtakoota compatibility analysis, Manglik Dosha evaluation & marriage longevity assessment.',
                'description' => 'Essential before entering sacred matrimony. We cross-examine boy and girl birth charts to evaluate emotional bond, health compatibility, progeny promise, and remedies if any dosha exists.',
                'price' => 1299.00,
                'sale_price' => 999.00,
                'stock' => 100,
                'main_image' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=800&q=80',
                'is_featured' => 0,
            ],
        ];

        foreach ($productsData as $prod) {
            $cat = $createdCategories[$prod['category_slug']] ?? null;
            if ($cat) {
                unset($prod['category_slug']);
                $prod['category_id'] = $cat->id;
                Product::updateOrCreate(['slug' => $prod['slug']], $prod);
            }
        }

        // 7. 7 Astrology Blogs
        $blogsData = [
            [
                'title' => 'The Power of Pukhraj: How Yellow Sapphire Transforms Jupiter Energy',
                'slug' => 'the-power-of-pukhraj-how-yellow-sapphire-transforms-jupiter-energy',
                'excerpt' => 'Discover how the auspicious yellow sapphire stone aligns with Guru Brihaspati to bestow unmatched wisdom, child blessings and financial breakthroughs.',
                'content' => 'In Vedic astrology, Guru (Jupiter) is the Guru of the Gods—the supreme karaka of fortune, divine wisdom, progeny, and dharma. When Brihaspati sits weakly in your birth chart (debilitated in Capricorn or afflicted by Rahu), one often experiences stagnation in career and recurring financial blockages. Wearing an untreated, Ceylon Yellow Sapphire (Pukhraj) of auspicious weight on a Thursday during Pushya Nakshatra can awaken your dormant luck.',
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80',
                'author' => 'Acharya Vidyadhar',
                'views' => 450,
                'status' => 1,
            ],
            [
                'title' => 'Nepal vs. Java Rudraksha: Sacred Differences You Must Know',
                'slug' => 'nepal-vs-java-rudraksha-sacred-differences-you-must-know',
                'excerpt' => 'Understand the structural, bio-energetic and spiritual differences between authentic Nepali beads and Indonesian Java beads.',
                'content' => 'Many seekers wonder why authentic Nepal Rudraksha beads command supreme reverence compared to smaller Java beads. Ancient texts like the Shiva Purana and Padma Purana hail the Himalayan foothills as the premier celestial cradle where Lord Shiva sheds his cosmic tears. Nepali beads are larger with deeply carved mukhi lines and high electromagnetic charge, making their results tangibly faster for meditation.',
                'image' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?auto=format&fit=crop&w=800&q=80',
                'author' => 'Swami Someshwara',
                'views' => 780,
                'status' => 1,
            ],
            [
                'title' => 'Mysteries of Shree Yantra: Sacred Geometry for Prosperity & Vastu',
                'slug' => 'mysteries-of-shree-yantra-sacred-geometry-for-prosperity-vastu',
                'excerpt' => 'Unlock the esoteric 9 interlocking triangles of the Maha Meru Shree Yantra that represent the micro and macrocosm of the universe.',
                'content' => 'The Shree Yantra is heralded as the Queen of all Sacred Mandalas. The 9 interlocking triangles generate 43 smaller subsidiary triangles, encapsulating the cosmic manifestation of the divine mother Lalita Tripurasundari. Keeping an energized 3D Meru Shree Yantra facing East or North-East neutralizes heavy Vastu defects and harmonizes chaotic room frequencies.',
                'image' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=800&q=80',
                'author' => 'Dr. Radhakrishna Shastri',
                'views' => 620,
                'status' => 1,
            ],
            [
                'title' => 'Saturn Transit & Shani Sade Sati: Remedies That Actually Bring Relief',
                'slug' => 'saturn-transit-shani-sade-sati-remedies-that-bring-relief',
                'excerpt' => 'Demystifying the feared seven-and-a-half-year Sade Sati of Lord Shani Dev and practical Vedic remedies to turn hardship into enduring success.',
                'content' => 'Lord Shani is not a punishing tormentor; He is the cosmic judge who balances your karmic ledger with absolute impartiality. During Sade Sati, chanting Hanuman Chalisa every Tuesday and Saturday, lighting a mustard oil lamp under a Peepal tree, and wearing a consecrated 7 Mukhi Rudraksha acts as an invincible karmic shield.',
                'image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80',
                'author' => 'Acharya Vidyadhar',
                'views' => 1250,
                'status' => 1,
            ],
            [
                'title' => 'Top 5 Vastu Tips to Attract Wealth and Mental Peace into Your Home',
                'slug' => 'top-5-vastu-tips-to-attract-wealth-and-mental-peace',
                'excerpt' => 'Easy-to-implement traditional Vastu Shastra secrets for your entrance, kitchen, and locker room to revitalize your home energy.',
                'content' => 'Your living space is a living energetic organism. Keep the North-East (Ishan Kon) completely clean, clutter-free and open to light. Never place mirrors directly facing the bed, ensure the kitchen sits in the South-East (Agni Kon), and keep an Akhand Brass Diya burning during twilight to invoke serene sattvic peace.',
                'image' => 'https://images.unsplash.com/photo-1583083527882-4bee9aba2eea?auto=format&fit=crop&w=800&q=80',
                'author' => 'Pandit Devrat',
                'views' => 930,
                'status' => 1,
            ],
            [
                'title' => 'Manglik Dosha Explained: Myths, Truths & Astrological Cancellation Rules',
                'slug' => 'manglik-dosha-explained-myths-truths-cancellation-rules',
                'excerpt' => 'Is Mangal Dosha always a barrier to happy marriage? Learn the lesser-known cancellation rules found in classic Parashara texts.',
                'content' => 'Almost 60% of people have Mars in the 1st, 2nd, 4th, 7th, 8th, or 12th house from the ascendant, Moon, or Venus. However, ancient classics list over 20 exceptional planetary arrangements where Mangal Dosha stands automatically cancelled—such as Mars placed in Aries in the 1st house or Jupiter aspecting Mars directly.',
                'image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80',
                'author' => 'Dr. Radhakrishna Shastri',
                'views' => 840,
                'status' => 1,
            ],
            [
                'title' => 'How to Choose Your Lucky Gemstone According to Ascendant (Lagna)',
                'slug' => 'how-to-choose-your-lucky-gemstone-according-to-ascendant-lagna',
                'excerpt' => 'Why you should never wear a gemstone based solely on your Sun sign (Rashi), and how Lagna lord calculation guarantees miraculous results.',
                'content' => 'Wearing the wrong gemstone can agitate malefic lord energies and cause physical discomfort. In authentic Parashari astrology, gems are prescribed exclusively for functional benefic lords (1st, 5th, and 9th houses). Discover which gem harmonizes best with your natural ascendant constitution.',
                'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=800&q=80',
                'author' => 'Acharya Vidyadhar',
                'views' => 1100,
                'status' => 1,
            ],
        ];

        foreach ($blogsData as $b) {
            Blog::updateOrCreate(['slug' => $b['slug']], $b);
        }
    }
}
