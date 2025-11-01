<?php

return [
    'navigation' => [
        'groups' => [
            'e-commerce' => 'التجارة الإلكترونية',
            'content' => 'المحتوى',
            'roles-permissions' => 'الأدوار والصلاحيات',
        ],
    ],

    'resources' => [
        'products' => [
            'label' => 'منتج',
            'plural_label' => 'المنتجات',
            'navigation_label' => 'المنتجات',

            'tabs' => [
                'general' => 'معلومات عامة',
                'pricing' => 'التسعير',
                'inventory' => 'المخزون',
                'media' => 'الوسائط',
                'settings' => 'الإعدادات',
            ],

            'sections' => [
                'basic_information' => 'المعلومات الأساسية',
                'basic_information_desc' => 'أدخل التفاصيل الأساسية للمنتج',
                'description' => 'الوصف',
                'description_desc' => 'وصف تفصيلي للمنتج',
                'pricing' => 'الأسعار',
                'pricing_desc' => 'إدارة أسعار المنتج',
                'stock' => 'إدارة المخزون',
                'stock_desc' => 'تتبع مخزون المنتج والكميات',
                'images' => 'الصور',
                'images_desc' => 'إضافة صور المنتج',
                'visibility' => 'الظهور والحالة',
                'visibility_desc' => 'التحكم في حالة ظهور المنتج',
                'product_info' => 'معلومات المنتج',
                'pricing_info' => 'معلومات التسعير',
                'inventory_info' => 'معلومات المخزون',
                'media_info' => 'الوسائط',
                'status_info' => 'الحالة والظهور',
            ],

            'fields' => [
                'category_id' => 'الفئة',
                'name' => 'اسم المنتج',
                'slug' => 'الرابط المختصر',
                'short_description' => 'وصف مختصر',
                'description' => 'الوصف الكامل',
                'price' => 'السعر',
                'cost_price' => 'سعر التكلفة',
                'sku' => 'رمز المنتج',
                'stock_quantity' => 'الكمية المتوفرة',
                'low_stock_threshold' => 'حد التنبيه للمخزون المنخفض',
                'weight' => 'الوزن',
                'unit_of_measure' => 'وحدة القياس',
                'expiration_date' => 'تاريخ الانتهاء',
                'image_path' => 'الصورة الرئيسية',
                'secondary_images' => 'صور إضافية',
                'is_active' => 'نشط',
                'is_featured' => 'منتج مميز',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
                'stock_status' => 'حالة المخزون',
                'profit_margin' => 'هامش الربح',
            ],

            'placeholders' => [
                'name' => 'أدخل اسم المنتج',
                'slug' => 'يتم إنشاؤه تلقائياً من الاسم',
                'short_description' => 'وصف قصير يظهر في قوائم المنتجات',
                'description' => 'وصف تفصيلي للمنتج',
                'category' => 'اختر فئة المنتج',
                'sku' => 'مثال: PRD-001',
                'unit_of_measure' => 'مثال: قطعة، كيلو، علبة',
                'expiration_date' => 'اختر التاريخ',
            ],

            'helpers' => [
                'slug' => 'يستخدم في رابط URL المنتج. يجب أن يكون فريداً.',
                'sku' => 'رمز فريد لتحديد المنتج في المخزون.',
                'short_description' => 'بحد أقصى 500 حرف. يظهر في البحث وقوائم المنتجات.',
                'price' => 'سعر البيع للعملاء',
                'cost_price' => 'سعر الشراء أو التكلفة (اختياري)',
                'stock_quantity' => 'العدد الحالي المتوفر في المخزون',
                'low_stock_threshold' => 'سيتم التنبيه عندما يصل المخزون لهذا العدد',
                'weight' => 'الوزن بالكيلوجرام (اختياري)',
                'unit_of_measure' => 'وحدة البيع: قطعة، كيلو، علبة، إلخ',
                'expiration_date' => 'تاريخ انتهاء الصلاحية (اختياري)',
                'image_path' => 'الصورة الرئيسية التي تظهر في القوائم. بحد أقصى 2 ميجابايت',
                'secondary_images' => 'صور إضافية للمنتج. بحد أقصى 5 صور، كل صورة 2 ميجابايت',
                'is_active' => 'إذا كان غير نشط، لن يظهر المنتج للعملاء',
                'is_featured' => 'سيظهر في قسم المنتجات المميزة',
            ],

            'filters' => [
                'active' => 'نشط',
                'inactive' => 'غير نشط',
                'featured' => 'مميز',
                'in_stock' => 'متوفر',
                'low_stock' => 'مخزون منخفض',
                'out_of_stock' => 'نفذ من المخزون',
                'stock_status' => 'حالة المخزون',
                'category' => 'الفئة',
                'price_range' => 'نطاق السعر',
            ],

            'badges' => [
                'featured' => 'مميز',
                'new' => 'جديد',
                'low_stock' => 'مخزون منخفض',
                'out_of_stock' => 'نفذ',
            ],

            'actions' => [
                'view' => 'عرض',
                'edit' => 'تعديل',
                'delete' => 'حذف',
                'duplicate' => 'نسخ',
                'activate' => 'تفعيل',
                'deactivate' => 'إلغاء التفعيل',
            ],
        ],

        'categories' => [
            'label' => 'فئة',
            'plural_label' => 'الفئات',
            'navigation_label' => 'الفئات',

            'tabs' => [
                'general' => 'معلومات عامة',
                'settings' => 'الإعدادات',
            ],

            'sections' => [
                'basic_information' => 'المعلومات الأساسية',
                'basic_information_desc' => 'أدخل تفاصيل الفئة الأساسية',
                'arabic_content' => 'المحتوى بالعربية',
                'arabic_content_desc' => 'أدخل المحتوى باللغة العربية',
                'hierarchy' => 'التسلسل الهرمي',
                'hierarchy_desc' => 'حدد الفئة الرئيسية إذا كانت هذه فئة فرعية',
                'visibility' => 'الظهور',
                'visibility_desc' => 'التحكم في حالة ظهور الفئة',
            ],

            'fields' => [
                'name' => 'اسم الفئة',
                'name_ar' => 'اسم الفئة بالعربية',
                'slug' => 'المعرف',
                'description' => 'الوصف',
                'description_ar' => 'الوصف بالعربية',
                'parent_id' => 'الفئة الأساسية',
                'is_active' => 'نشط',
                'products_count' => 'عدد المنتجات',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],

            'placeholders' => [
                'name' => 'أدخل اسم الفئة',
                'name_ar' => 'أدخل اسم الفئة بالعربية',
                'slug' => 'يتم إنشاؤه تلقائياً من الاسم',
                'description' => 'وصف الفئة بالإنجليزية',
                'description_ar' => 'وصف الفئة بالعربية',
                'parent_id' => 'اختر الفئة الرئيسية',
            ],

            'helpers' => [
                'slug' => 'يستخدم في رابط URL الفئة. يجب أن يكون فريداً.',
                'name' => 'اسم الفئة كما سيظهر للعملاء',
                'description' => 'وصف مختصر للفئة',
                'parent_id' => 'اختر فئة رئيسية لإنشاء فئة فرعية',
                'is_active' => 'إذا كانت غير نشطة، لن تظهر الفئة ومنتجاتها للعملاء',
            ],

            'filters' => [
                'active' => 'نشط',
                'inactive' => 'غير نشط',
                'parent_categories' => 'الفئات الرئيسية',
                'subcategories' => 'الفئات الفرعية',
                'has_products' => 'تحتوي على منتجات',
                'trashed' => 'المحذوف',
            ],

            'badges' => [
                'active' => 'نشط',
                'inactive' => 'غير نشط',
                'parent' => 'فئة رئيسية',
                'subcategory' => 'فئة فرعية',
            ],

            'actions' => [
                'view' => 'عرض',
                'edit' => 'تحرير',
                'delete' => 'حذف',
                'restore' => 'استعادة',
                'force_delete' => 'حذف نهائي',
            ],
        ],

        'orders' => [
            'label' => 'طلب',
            'plural_label' => 'الطلبات',
            'navigation_label' => 'الطلبات',
            'fields' => [
                'user_id' => 'العميل',
                'order_number' => 'رقم الطلب',
                'total_amount' => 'المبلغ الإجمالي',
                'status' => 'الحالة',
                'shipping_address' => 'عنوان الشحن',
                'billing_address' => 'عنوان الفاتورة',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
            'status' => [
                'pending' => 'قيد الانتظار',
                'processing' => 'قيد المعالجة',
                'shipped' => 'تم الشحن',
                'delivered' => 'تم التسليم',
                'cancelled' => 'ملغي',
            ],
        ],

        'reviews' => [
            'label' => 'تقييم',
            'plural_label' => 'التقييمات',
            'navigation_label' => 'التقييمات',
            'fields' => [
                'product_id' => 'المنتج',
                'user_id' => 'المستخدم',
                'rating' => 'التقييم',
                'comment' => 'التعليق',
                'is_approved' => 'معتمد',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
        ],

        'wishlists' => [
            'label' => 'قائمة رغبات',
            'plural_label' => 'قوائم الرغبات',
            'navigation_label' => 'قوائم الرغبات',
            'fields' => [
                'user_id' => 'المستخدم',
                'product_id' => 'المنتج',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
            ],
        ],

        'posts' => [
            'label' => 'مقال',
            'plural_label' => 'المقالات',
            'navigation_label' => 'المقالات',
            'fields' => [
                'title' => 'العنوان',
                'slug' => 'المعرف',
                'content' => 'المحتوى',
                'excerpt' => 'المقتطف',
                'featured_image' => 'الصورة المميزة',
                'author_id' => 'الكاتب',
                'published_at' => 'تاريخ النشر',
                'is_published' => 'منشور',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
        ],

        'pages' => [
            'label' => 'صفحة',
            'plural_label' => 'الصفحات',
            'navigation_label' => 'الصفحات',
            'fields' => [
                'title' => 'العنوان',
                'slug' => 'المعرف',
                'content' => 'المحتوى',
                'is_published' => 'منشور',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
        ],

        'banners' => [
            'label' => 'بنر',
            'plural_label' => 'البنرات',
            'navigation_label' => 'البنرات',
            'fields' => [
                'title' => 'العنوان',
                'image_path' => 'الصورة',
                'link' => 'الرابط',
                'description' => 'الوصف',
                'is_active' => 'نشط',
                'display_order' => 'ترتيب العرض',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
        ],

        'faqs' => [
            'label' => 'سؤال شائع',
            'plural_label' => 'الأسئلة الشائعة',
            'navigation_label' => 'الأسئلة الشائعة',
            'fields' => [
                'question' => 'السؤال',
                'answer' => 'الإجابة',
                'display_order' => 'ترتيب العرض',
                'is_active' => 'نشط',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
        ],

        'testimonials' => [
            'label' => 'شهادة',
            'plural_label' => 'الشهادات',
            'navigation_label' => 'الشهادات',
            'fields' => [
                'name' => 'الاسم',
                'position' => 'المنصب',
                'company' => 'الشركة',
                'content' => 'المحتوى',
                'image_path' => 'الصورة',
                'rating' => 'التقييم',
                'is_active' => 'نشط',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
        ],

        'users' => [
            'label' => 'مستخدم',
            'plural_label' => 'المستخدمون',
            'navigation_label' => 'المستخدمون',
            'navigation_group' => 'الأدوار والصلاحيات',

            'fields' => [
                'name' => 'الاسم',
                'email' => 'البريد الإلكتروني',
                'email_verified_at' => 'تم التحقق من البريد الإلكتروني',
                'password' => 'كلمة المرور',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],

            'placeholders' => [
                'name' => 'أدخل اسم المستخدم الكامل',
                'email' => 'user@example.com',
                'password' => 'أدخل كلمة مرور قوية',
            ],

            'helpers' => [
                'email' => 'سيتم استخدام هذا البريد الإلكتروني لتسجيل الدخول',
                'password' => 'يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل',
                'email_verified_at' => 'تاريخ التحقق من البريد الإلكتروني',
            ],

            'actions' => [
                'verify_email' => 'التحقق من البريد الإلكتروني',
                'reset_password' => 'إعادة تعيين كلمة المرور',
                'view' => 'عرض',
                'edit' => 'تحرير',
                'delete' => 'حذف',
                'restore' => 'استعادة',
                'force_delete' => 'حذف نهائي',
            ],

            'filters' => [
                'verified' => 'تم التحقق منه',
                'unverified' => 'لم يتم التحقق منه',
                'trashed' => 'المحذوف',
            ],

            'badges' => [
                'verified' => 'تم التحقق',
                'unverified' => 'لم يتم التحقق',
                'active' => 'نشط',
                'inactive' => 'غير نشط',
            ],
        ],
    ],

    'pages' => [
        'dashboard' => 'لوحة التحكم',
    ],
];
