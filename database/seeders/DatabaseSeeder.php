<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@athar-herb.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_active' => true,
            'user_type' => UserType::ADMIN,
        ]);

        // Create Sample Users
        $users = [
            ['name' => 'أحمد محمد', 'email' => 'ahmed@example.com', 'user_type' => UserType::CUSTOMER, 'is_active' => true],
            ['name' => 'فاطمة علي', 'email' => 'fatima@example.com', 'user_type' => UserType::CUSTOMER, 'is_active' => true],
            ['name' => 'محمد خالد', 'email' => 'mohammed@example.com', 'user_type' => UserType::MANAGER, 'is_active' => true],
            ['name' => 'سارة عبدالله', 'email' => 'sarah@example.com', 'user_type' => UserType::SUPPORT, 'is_active' => true],
            ['name' => 'عمر حسن', 'email' => 'omar@example.com', 'user_type' => UserType::CUSTOMER, 'is_active' => false],
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'is_active' => $userData['is_active'],
                'user_type' => $userData['user_type'],
            ]);
        }

        // Create Categories
        $categories = [
            ['name_ar' => 'الزيوت الطبيعية', 'name' => 'Natural Oils', 'description_ar' => 'زيوت طبيعية عالية الجودة', 'description' => 'High quality natural oils'],
            ['name_ar' => 'العسل', 'name' => 'Honey', 'description_ar' => 'عسل طبيعي نقي', 'description' => 'Pure natural honey'],
            ['name_ar' => 'الأعشاب', 'name' => 'Herbs', 'description_ar' => 'أعشاب طبية طبيعية', 'description' => 'Natural medicinal herbs'],
            ['name_ar' => 'التوابل', 'name' => 'Spices', 'description_ar' => 'توابل طبيعية عالية الجودة', 'description' => 'High quality natural spices'],
            ['name_ar' => 'البذور', 'name' => 'Seeds', 'description_ar' => 'بذور صحية ومفيدة', 'description' => 'Healthy and beneficial seeds'],
        ];

        foreach ($categories as $index => $categoryData) {
            Category::create([
                'name_ar' => $categoryData['name_ar'],
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description_ar' => $categoryData['description_ar'],
                'description' => $categoryData['description'],
                'is_active' => true,
            ]);
        }

        // Create Products
        $products = [
            [
                'name_ar' => 'زيت الزيتون البكر',
                'name' => 'Extra Virgin Olive Oil',
                'short_description_ar' => 'زيت زيتون بكر ممتاز، عصرة أولى باردة',
                'short_description' => 'Extra virgin olive oil, first cold pressed',
                'description_ar' => 'زيت زيتون بكر ممتاز، عصرة أولى باردة، غني بمضادات الأكسدة والفيتامينات. منتج طبيعي 100% من أجود أنواع الزيتون.',
                'description' => 'Extra virgin olive oil, first cold pressed, rich in antioxidants and vitamins. 100% natural product from the finest olives.',
                'price' => 120.00,
                'cost_price' => 80.00,
                'stock_quantity' => 50,
                'category_id' => 1,
                'sku' => 'OIL-001',
            ],
            [
                'name_ar' => 'عسل السدر الطبيعي',
                'name' => 'Natural Sidr Honey',
                'short_description_ar' => 'عسل سدر طبيعي نقي 100%',
                'short_description' => 'Pure 100% natural sidr honey',
                'description_ar' => 'عسل سدر طبيعي نقي 100%، من المناحل الجبلية، غني بالفوائد الصحية والعناصر الغذائية المفيدة.',
                'description' => 'Pure 100% natural sidr honey, from mountain apiaries, rich in health benefits and beneficial nutrients.',
                'price' => 250.00,
                'cost_price' => 180.00,
                'stock_quantity' => 30,
                'category_id' => 2,
                'sku' => 'HON-001',
            ],
            [
                'name_ar' => 'زعتر بري',
                'name' => 'Wild Thyme',
                'short_description_ar' => 'زعتر بري أصلي، مجفف طبيعياً',
                'short_description' => 'Original wild thyme, naturally dried',
                'description_ar' => 'زعتر بري أصلي، مجفف طبيعياً، نكهة مميزة وفوائد صحية. غني بمضادات الأكسدة والزيوت الطيارة المفيدة.',
                'description' => 'Original wild thyme, naturally dried, distinctive flavor and health benefits. Rich in antioxidants and beneficial essential oils.',
                'price' => 45.00,
                'cost_price' => 25.00,
                'stock_quantity' => 100,
                'category_id' => 3,
                'sku' => 'HRB-001',
            ],
            [
                'name_ar' => 'كركم عضوي',
                'name' => 'Organic Turmeric',
                'short_description_ar' => 'كركم عضوي نقي، مضاد للالتهابات',
                'short_description' => 'Pure organic turmeric, anti-inflammatory',
                'description_ar' => 'كركم عضوي نقي، مضاد للالتهابات ومقوي للمناعة. يحتوي على مادة الكركمين الفعالة في علاج العديد من الأمراض.',
                'description' => 'Pure organic turmeric, anti-inflammatory and immunity booster. Contains curcumin effective in treating many diseases.',
                'price' => 55.00,
                'cost_price' => 35.00,
                'stock_quantity' => 80,
                'category_id' => 4,
                'sku' => 'SPC-001',
            ],
            [
                'name_ar' => 'حبة البركة',
                'name' => 'Black Seed',
                'short_description_ar' => 'حبة البركة الأصلية',
                'short_description' => 'Original black seed',
                'description_ar' => 'حبة البركة الأصلية، غنية بالفوائد العلاجية والصحية. تساعد في تقوية المناعة وعلاج العديد من الأمراض.',
                'description' => 'Original black seed, rich in therapeutic and health benefits. Helps strengthen immunity and treat many diseases.',
                'price' => 35.00,
                'cost_price' => 20.00,
                'stock_quantity' => 120,
                'category_id' => 5,
                'sku' => 'SED-001',
            ],
        ];

        foreach ($products as $index => $productData) {
            Product::create([
                'name_ar' => $productData['name_ar'],
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'short_description_ar' => $productData['short_description_ar'],
                'short_description' => $productData['short_description'],
                'description_ar' => $productData['description_ar'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'cost_price' => $productData['cost_price'],
                'stock_quantity' => $productData['stock_quantity'],
                'category_id' => $productData['category_id'],
                'sku' => $productData['sku'],
                'is_active' => true,
                'is_featured' => true,
                'image_path' => 'products/placeholder.jpg',
            ]);
        }

        // Create Banners
        $banners = [
            [
                'title_ar' => 'منتجات طبيعية 100%',
                'title' => '100% Natural Products',
                'description_ar' => 'اكتشف مجموعتنا من المنتجات الطبيعية عالية الجودة',
                'description' => 'Discover our collection of high-quality natural products',
            ],
            [
                'title_ar' => 'عروض خاصة',
                'title' => 'Special Offers',
                'description_ar' => 'خصومات تصل إلى 50% على منتجات مختارة',
                'description' => 'Discounts up to 50% on selected products',
            ],
            [
                'title_ar' => 'شحن مجاني',
                'title' => 'Free Shipping',
                'description_ar' => 'شحن مجاني للطلبات فوق 200 ريال',
                'description' => 'Free shipping on orders over 200 SAR',
            ],
        ];

        foreach ($banners as $index => $bannerData) {
            Banner::create([
                'title_ar' => $bannerData['title_ar'],
                'title' => $bannerData['title'],
                'description_ar' => $bannerData['description_ar'],
                'description' => $bannerData['description'],
                'link_text' => 'تسوق الآن',
                'link_url' => '/products',
                'is_active' => true,
                'sort_order' => $index + 1,
                'image' => 'banners/placeholder.jpg',
            ]);
        }

        // Create Testimonials
        $testimonials = [
            [
                'name_ar' => 'سارة أحمد',
                'name' => 'Sarah Ahmed',
                'role_ar' => 'عميلة',
                'role' => 'Customer',
                'content_ar' => 'منتجات ممتازة وجودة عالية، أنصح بشدة بمنتجات عطار الأعشاب',
                'content' => 'Excellent products and high quality, I highly recommend Athar Herb products',
                'rating' => 5,
            ],
            [
                'name_ar' => 'محمد علي',
                'name' => 'Mohammed Ali',
                'role_ar' => 'عميل',
                'role' => 'Customer',
                'content_ar' => 'زيت الزيتون من أفضل ما جربت، طعم أصيل ونقاء واضح',
                'content' => 'The olive oil is one of the best I have tried, authentic taste and clear purity',
                'rating' => 5,
            ],
            [
                'name_ar' => 'فاطمة خالد',
                'name' => 'Fatima Khaled',
                'role_ar' => 'عميلة',
                'role' => 'Customer',
                'content_ar' => 'خدمة عملاء رائعة وسرعة في التوصيل، المنتجات طبيعية 100%',
                'content' => 'Excellent customer service and fast delivery, 100% natural products',
                'rating' => 5,
            ],
            [
                'name_ar' => 'أحمد محمود',
                'name' => 'Ahmed Mahmoud',
                'role_ar' => 'عميل',
                'role' => 'Customer',
                'content_ar' => 'عسل السدر من أجود الأنواع، استفدت منه كثيراً',
                'content' => 'Sidr honey is one of the finest types, I benefited from it a lot',
                'rating' => 5,
            ],
            [
                'name_ar' => 'نورة سعيد',
                'name' => 'Noura Saeed',
                'role_ar' => 'عميلة',
                'role' => 'Customer',
                'content_ar' => 'أسعار مناسبة وجودة ممتازة، سأستمر في الشراء منهم',
                'content' => 'Reasonable prices and excellent quality, I will continue to buy from them',
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $index => $testimonialData) {
            Testimonial::create([
                'name_ar' => $testimonialData['name_ar'],
                'name' => $testimonialData['name'],
                'role_ar' => $testimonialData['role_ar'],
                'role' => $testimonialData['role'],
                'content_ar' => $testimonialData['content_ar'],
                'content' => $testimonialData['content'],
                'rating' => $testimonialData['rating'],
                'is_approved' => true,
                'sort_order' => $index + 1,
            ]);
        }

        // Create FAQs
        $faqs = [
            [
                'question_ar' => 'ما هي طرق الدفع المتاحة؟',
                'question' => 'What payment methods are available?',
                'answer_ar' => 'نوفر عدة طرق دفع: الدفع عند الاستلام، التحويل البنكي، الفيزا والماستركارد، وكذلك الدفع عبر أبل باي وSTC Pay.',
                'answer' => 'We offer several payment methods: Cash on delivery, Bank transfer, Visa and Mastercard, as well as Apple Pay and STC Pay.',
            ],
            [
                'question_ar' => 'كم تستغرق عملية التوصيل؟',
                'question' => 'How long does delivery take?',
                'answer_ar' => 'يتم التوصيل خلال 2-5 أيام عمل داخل المملكة. للرياض وجدة والدمام: 1-2 يوم عمل. المناطق الأخرى: 3-5 أيام عمل.',
                'answer' => 'Delivery takes 2-5 business days within Saudi Arabia. For Riyadh, Jeddah and Dammam: 1-2 business days. Other areas: 3-5 business days.',
            ],
            [
                'question_ar' => 'هل منتجاتكم طبيعية 100%؟',
                'question' => 'Are your products 100% natural?',
                'answer_ar' => 'نعم، جميع منتجاتنا طبيعية 100% ومعتمدة من وزارة الصحة السعودية. لدينا شهادات جودة وتحاليل مخبرية لكل منتج.',
                'answer' => 'Yes, all our products are 100% natural and approved by the Saudi Ministry of Health. We have quality certificates and laboratory tests for each product.',
            ],
            [
                'question_ar' => 'كيف يمكنني إرجاع أو استبدال المنتج؟',
                'question' => 'How can I return or exchange a product?',
                'answer_ar' => 'يمكن إرجاع أو استبدال المنتج خلال 14 يوم من تاريخ الاستلام بشرط عدم فتح المنتج. نتحمل تكلفة الإرجاع في حال وجود عيب.',
                'answer' => 'Products can be returned or exchanged within 14 days from the date of receipt, provided the product has not been opened. We bear the cost of return if there is a defect.',
            ],
            [
                'question_ar' => 'هل تقدمون شحن مجاني؟',
                'question' => 'Do you offer free shipping?',
                'answer_ar' => 'نعم، نوفر شحن مجاني للطلبات التي تزيد عن 200 ريال داخل المملكة. للطلبات الأقل، رسوم الشحن 20 ريال.',
                'answer' => 'Yes, we offer free shipping for orders over 200 SAR within Saudi Arabia. For smaller orders, shipping fee is 20 SAR.',
            ],
        ];

        foreach ($faqs as $index => $faqData) {
            Faq::create([
                'question_ar' => $faqData['question_ar'],
                'question' => $faqData['question'],
                'answer_ar' => $faqData['answer_ar'],
                'answer' => $faqData['answer'],
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }

        // Create Blog Posts
        $posts = [
            [
                'title_ar' => 'فوائد زيت الزيتون البكر للصحة',
                'title' => 'Benefits of Extra Virgin Olive Oil for Health',
                'content_ar' => 'زيت الزيتون البكر يحتوي على العديد من الفوائد الصحية المذهلة. يساعد في تحسين صحة القلب، ويقلل من الالتهابات، ويحتوي على مضادات أكسدة قوية تحمي الجسم من الأمراض. كما أنه غني بالأحماض الدهنية الأحادية غير المشبعة والفيتامينات.',
                'content' => 'Extra virgin olive oil contains many amazing health benefits. It helps improve heart health, reduces inflammation, and contains powerful antioxidants that protect the body from diseases. It is also rich in monounsaturated fatty acids and vitamins.',
            ],
            [
                'title_ar' => 'كيف تختار العسل الطبيعي الأصلي',
                'title' => 'How to Choose Pure Natural Honey',
                'content_ar' => 'اختيار العسل الطبيعي الأصلي يتطلب معرفة بعض العلامات المميزة. العسل الطبيعي له قوام كثيف، لا يذوب بسرعة في الماء، وله رائحة مميزة. تأكد من شراء العسل من مصادر موثوقة ومعتمدة للحصول على أفضل جودة.',
                'content' => 'Choosing pure natural honey requires knowing some distinctive signs. Natural honey has a thick consistency, does not dissolve quickly in water, and has a distinctive aroma. Make sure to buy honey from trusted and certified sources for the best quality.',
            ],
            [
                'title_ar' => 'الأعشاب المفيدة لتقوية المناعة',
                'title' => 'Beneficial Herbs for Boosting Immunity',
                'content_ar' => 'هناك العديد من الأعشاب الطبيعية التي تساعد في تقوية جهاز المناعة مثل الزنجبيل، الكركم، حبة البركة، والزعتر. هذه الأعشاب تحتوي على مركبات طبيعية تساعد الجسم على مقاومة الأمراض وتحسين الصحة العامة.',
                'content' => 'There are many natural herbs that help strengthen the immune system such as ginger, turmeric, black seed, and thyme. These herbs contain natural compounds that help the body fight diseases and improve overall health.',
            ],
            [
                'title_ar' => 'فوائد الكركم العضوي وطرق استخدامه',
                'title' => 'Benefits of Organic Turmeric and Ways to Use It',
                'content_ar' => 'الكركم العضوي من أفضل التوابل الطبيعية. يحتوي على مادة الكركمين المضادة للالتهابات، ويمكن استخدامه في الطبخ أو كمشروب صحي. يساعد في تحسين الهضم، تقوية المناعة، وعلاج العديد من الأمراض المزمنة.',
                'content' => 'Organic turmeric is one of the best natural spices. It contains curcumin, an anti-inflammatory compound, and can be used in cooking or as a healthy drink. It helps improve digestion, boost immunity, and treat many chronic diseases.',
            ],
            [
                'title_ar' => 'حبة البركة: الحبة السوداء المعجزة',
                'title' => 'Black Seed: The Miracle Black Cumin',
                'content_ar' => 'حبة البركة أو الحبة السوداء معروفة بفوائدها الصحية العديدة. تساعد في تقوية المناعة، تحسين الهضم، وعلاج العديد من الأمراض. يمكن استخدامها كبذور أو زيت للحصول على أقصى فائدة صحية.',
                'content' => 'Black seed or black cumin is known for its many health benefits. It helps strengthen immunity, improve digestion, and treat many diseases. It can be used as seeds or oil for maximum health benefits.',
            ],
        ];

        $adminUser = User::first();

        foreach ($posts as $index => $postData) {
            Post::create([
                'title_ar' => $postData['title_ar'],
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'content_ar' => $postData['content_ar'],
                'content' => $postData['content'],
                'excerpt_ar' => Str::limit($postData['content_ar'], 150),
                'excerpt' => Str::limit($postData['content'], 150),
                'is_published' => true,
                'published_at' => now()->subDays(rand(1, 30)),
                'featured_image' => 'posts/placeholder.jpg',
                'user_id' => $adminUser->id,
            ]);
        }

        // Create Pages
        Page::create([
            'title_ar' => 'سياسة الخصوصية',
            'title' => 'Privacy Policy',
            'slug' => 'privacy',
            'content_ar' => 'نحن في عطار الأعشاب نحترم خصوصيتك ونلتزم بحماية معلوماتك الشخصية. نجمع المعلومات فقط لتحسين خدماتنا وتوفير تجربة تسوق أفضل. لن نشارك معلوماتك مع أي طرف ثالث دون موافقتك.',
            'content' => 'At Athar Herb, we respect your privacy and are committed to protecting your personal information. We collect information only to improve our services and provide a better shopping experience. We will not share your information with any third party without your consent.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        Page::create([
            'title_ar' => 'الشروط والأحكام',
            'title' => 'Terms and Conditions',
            'slug' => 'terms',
            'content_ar' => 'باستخدام موقع عطار الأعشاب، فإنك توافق على الشروط والأحكام التالية. جميع المنتجات طبيعية ومعتمدة. يحق للعميل إرجاع المنتج خلال 14 يوم. نحن نضمن جودة جميع منتجاتنا ونلتزم بتقديم أفضل خدمة.',
            'content' => 'By using the Athar Herb website, you agree to the following terms and conditions. All products are natural and certified. The customer has the right to return the product within 14 days. We guarantee the quality of all our products and are committed to providing the best service.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        // Seed Orders
        $this->command->info('Seeding orders...');
        $this->call(OrderSeeder::class);

        $this->command->info('Database seeded successfully!');
    }
}

