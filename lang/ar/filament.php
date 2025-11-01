<?php

return [
    'navigation' => [
        'groups' => [
            'e-commerce' => 'التجارة الإلكترونية',
            'content' => 'المحتوى',
        ],
    ],

    'resources' => [
        'products' => [
            'label' => 'منتج',
            'plural_label' => 'المنتجات',
            'navigation_label' => 'المنتجات',
            'fields' => [
                'category_id' => 'الفئة',
                'name' => 'الاسم',
                'slug' => 'المعرف',
                'short_description' => 'وصف مختصر',
                'description' => 'الوصف',
                'price' => 'السعر',
                'cost_price' => 'سعر التكلفة',
                'sku' => 'رمز المنتج',
                'stock_quantity' => 'الكمية المتوفرة',
                'low_stock_threshold' => 'حد التنبيه للمخزون',
                'weight' => 'الوزن',
                'unit_of_measure' => 'وحدة القياس',
                'expiration_date' => 'تاريخ الانتهاء',
                'image_path' => 'الصورة',
                'secondary_images' => 'صور إضافية',
                'is_active' => 'نشط',
                'is_featured' => 'مميز',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
            ],
        ],

        'categories' => [
            'label' => 'فئة',
            'plural_label' => 'الفئات',
            'navigation_label' => 'الفئات',
            'fields' => [
                'name' => 'الاسم',
                'slug' => 'المعرف',
                'description' => 'الوصف',
                'parent_id' => 'الفئة الأساسية',
                'is_active' => 'نشط',
                'created_at' => 'تاريخ الإنشاء',
                'updated_at' => 'تاريخ التحديث',
                'deleted_at' => 'تاريخ الحذف',
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
    ],

    'pages' => [
        'dashboard' => 'لوحة التحكم',
    ],
];
