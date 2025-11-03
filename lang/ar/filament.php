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

            'tabs' => [
                'order_details' => 'تفاصيل الطلب',
                'customer_info' => 'معلومات العميل',
                'items' => 'المنتجات',
            ],

            'sections' => [
                'order_information' => 'معلومات الطلب',
                'order_information_description' => 'رقم الطلب والحالة والمبلغ الإجمالي',
                'customer_information' => 'معلومات العميل',
                'customer_details' => 'تفاصيل العميل',
                'customer_details_desc' => 'معلومات العميل الذي أنشأ هذا الطلب',
                'addresses' => 'العناوين',
                'addresses_desc' => 'عناوين الشحن والفواتير',
                'order_items' => 'منتجات الطلب',
                'order_items_description' => 'قائمة المنتجات المطلوبة',
                'shipping_address' => 'عنوان الشحن',
                'shipping_address_description' => 'عنوان توصيل الطلب',
                'billing_address' => 'عنوان الفاتورة',
                'billing_address_description' => 'عنوان إصدار الفاتورة',
                'payment_information' => 'معلومات الدفع',
                'payment_information_description' => 'حالة وطريقة الدفع',
                'totals' => 'الإجماليات',
                'totals_description' => 'تفاصيل المبالغ والإجماليات',
                'additional_information' => 'معلومات إضافية',
                'payment_info' => 'معلومات الدفع',
                'notes' => 'ملاحظات',
            ],

            'fields' => [
                'user_id' => 'العميل',
                'customer' => 'العميل',
                'order_number' => 'رقم الطلب',
                'total_amount' => 'المبلغ الإجمالي',
                'subtotal' => 'المجموع الفرعي',
                'tax' => 'الضريبة',
                'shipping_cost' => 'تكلفة الشحن',
                'discount' => 'الخصم',
                'status' => 'الحالة',
                'payment_status' => 'حالة الدفع',
                'payment_method' => 'طريقة الدفع',
                'shipping_address' => 'عنوان الشحن',
                'billing_address' => 'عنوان الفاتورة',
                'address' => 'العنوان',
                'customer_name' => 'اسم العميل',
                'customer_email' => 'بريد العميل',
                'customer_phone' => 'هاتف العميل',
                'city' => 'المدينة',
                'state' => 'المنطقة',
                'postal_code' => 'الرمز البريدي',
                'same_as_shipping' => 'نفس عنوان الشحن',
                'order_date' => 'تاريخ الطلب',
                'items_count' => 'عدد المنتجات',
                'product' => 'المنتج',
                'product_name' => 'اسم المنتج',
                'price' => 'السعر',
                'quantity' => 'الكمية',
                'total' => 'المجموع',
                'notes' => 'ملاحظات',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],

            'placeholders' => [
                'order_number' => 'ORD-2025-0001',
                'select_customer' => 'اختر العميل',
                'notes' => 'أدخل أي ملاحظات إضافية',
            ],

            'helpers' => [
                'order_number' => 'رقم تعريف فريد للطلب',
                'status' => 'الحالة الحالية للطلب',
                'total_amount' => 'المبلغ الإجمالي النهائي شامل الضرائب والشحن',
                'copied' => 'تم النسخ إلى الحافظة',
            ],

            'status' => [
                'pending' => 'قيد الانتظار',
                'processing' => 'قيد المعالجة',
                'shipped' => 'تم الشحن',
                'delivered' => 'تم التسليم',
                'cancelled' => 'ملغي',
                'refunded' => 'مسترد',
                'failed' => 'فشل',
            ],

            'payment_status' => [
                'pending' => 'في انتظار الدفع',
                'paid' => 'مدفوع',
                'failed' => 'فشل الدفع',
                'refunded' => 'مسترد',
            ],

            'filters' => [
                'all_orders' => 'جميع الطلبات',
                'status' => 'الحالة',
                'payment_status' => 'حالة الدفع',
                'order_date' => 'تاريخ الطلب',
                'from' => 'من',
                'to' => 'إلى',
                'total_amount' => 'المبلغ الإجمالي',
                'min_amount' => 'الحد الأدنى',
                'max_amount' => 'الحد الأقصى',
                'date_range' => 'نطاق التاريخ',
                'customer' => 'العميل',
                'amount_range' => 'نطاق المبلغ',
                'trashed' => 'المحذوف',
            ],

            'badges' => [
                'new' => 'جديد',
                'urgent' => 'عاجل',
                'completed' => 'مكتمل',
            ],

            'actions' => [
                'add_item' => 'إضافة منتج',
                'view' => 'عرض',
                'edit' => 'تحرير',
                'delete' => 'حذف',
                'restore' => 'استعادة',
                'force_delete' => 'حذف نهائي',
                'mark_as_processing' => 'تحديد كقيد المعالجة',
                'mark_as_shipped' => 'تحديد كمشحون',
                'mark_as_delivered' => 'تحديد كمسلم',
                'cancel_order' => 'إلغاء الطلب',
                'print_invoice' => 'طباعة الفاتورة',
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

            'tabs' => [
                'basic_info' => 'المعلومات الأساسية',
                'security' => 'الأمان',
                'all_users' => 'جميع المستخدمين',
                'verified' => 'مُتحقق منهم',
                'unverified' => 'غير مُتحقق منهم',
                'this_week' => 'هذا الأسبوع',
                'this_month' => 'هذا الشهر',
            ],

            'sections' => [
                'account_details' => 'تفاصيل الحساب',
                'account_details_desc' => 'المعلومات الأساسية للمستخدم',
                'password_security' => 'كلمة المرور والأمان',
                'password_security_desc' => 'إدارة كلمة المرور وإعدادات الأمان',
                'user_overview' => 'نظرة عامة على المستخدم',
                'user_overview_desc' => 'المعلومات الأساسية والحالة',
                'account_info' => 'معلومات الحساب',
                'account_info_desc' => 'تواريخ التحقق والنشاط',
                'system_info' => 'معلومات النظام',
                'system_info_desc' => 'معلومات تقنية ومعرفات',
            ],

            'fields' => [
                'id' => 'المعرف',
                'name' => 'الاسم',
                'email' => 'البريد الإلكتروني',
                'email_verified_at' => 'تاريخ التحقق من البريد',
                'verified' => 'التحقق',
                'status' => 'الحالة',
                'password' => 'كلمة المرور',
                'password_confirmation' => 'تأكيد كلمة المرور',
                'is_active' => 'نشط',
                'user_type' => 'نوع المستخدم',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],

            'user_types' => [
                'customer' => 'عميل',
                'admin' => 'مدير',
                'manager' => 'مشرف',
                'support' => 'دعم فني',
            ],

            'placeholders' => [
                'name' => 'أدخل الاسم الكامل',
                'email' => 'user@example.com',
                'password' => 'أدخل كلمة مرور قوية (8 أحرف على الأقل)',
                'password_confirmation' => 'أعد إدخال كلمة المرور',
            ],

            'helpers' => [
                'email' => 'سيتم استخدام هذا البريد الإلكتروني لتسجيل الدخول. يجب أن يكون فريداً.',
                'password' => 'يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل. استخدم مزيجاً من الأحرف والأرقام والرموز.',
                'email_verified_at' => 'التاريخ والوقت الذي تم فيه التحقق من البريد الإلكتروني للمستخدم.',
                'is_active' => 'إذا كان غير نشط، لن يتمكن المستخدم من تسجيل الدخول إلى النظام.',
                'user_type' => 'حدد دور المستخدم ونوع حسابه في النظام.',
            ],

            'actions' => [
                'verify_email' => 'التحقق من البريد',
                'reset_password' => 'إعادة تعيين كلمة المرور',
                'view' => 'عرض',
                'edit' => 'تحرير',
                'delete' => 'حذف',
                'restore' => 'استعادة',
                'force_delete' => 'حذف نهائي',
            ],

            'filters' => [
                'verification_status' => 'حالة التحقق',
                'verified' => 'مُتحقق منه',
                'unverified' => 'غير مُتحقق منه',
                'user_type' => 'نوع المستخدم',
                'status' => 'حالة الحساب',
                'trashed' => 'المحذوفون',
                'created_this_month' => 'تم الإنشاء هذا الشهر',
                'created_this_week' => 'تم الإنشاء هذا الأسبوع',
            ],

            'badges' => [
                'verified' => 'مُتحقق منه',
                'unverified' => 'غير مُتحقق منه',
                'active' => 'نشط',
                'inactive' => 'غير نشط',
            ],

            'messages' => [
                'copied' => 'تم النسخ!',
                'email_copied' => 'تم نسخ البريد الإلكتروني!',
            ],

            'empty_state' => [
                'heading' => 'لا يوجد مستخدمون',
                'description' => 'ابدأ بإنشاء مستخدم جديد.',
            ],
        ],
    ],

    'pages' => [
        'dashboard' => 'لوحة التحكم',
    ],
];
