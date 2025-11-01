<?php

return [
    'navigation' => [
        'groups' => [
            'e-commerce' => 'E-commerce',
            'content' => 'Content',
            'roles-permissions' => 'Roles & Permissions',
        ],
    ],

    'resources' => [
        'products' => [
            'label' => 'Product',
            'plural_label' => 'Products',
            'navigation_label' => 'Products',

            'tabs' => [
                'general' => 'General Information',
                'pricing' => 'Pricing',
                'inventory' => 'Inventory',
                'media' => 'Media',
                'settings' => 'Settings',
            ],

            'sections' => [
                'basic_information' => 'Basic Information',
                'basic_information_desc' => 'Enter the basic product details',
                'description' => 'Description',
                'description_desc' => 'Detailed product description',
                'pricing' => 'Pricing',
                'pricing_desc' => 'Manage product pricing',
                'stock' => 'Stock Management',
                'stock_desc' => 'Track product inventory and quantities',
                'images' => 'Images',
                'images_desc' => 'Upload product images',
                'visibility' => 'Visibility & Status',
                'visibility_desc' => 'Control product visibility and status',
                'product_info' => 'Product Information',
                'pricing_info' => 'Pricing Information',
                'inventory_info' => 'Inventory Information',
                'media_info' => 'Media',
                'status_info' => 'Status & Visibility',
            ],

            'fields' => [
                'category_id' => 'Category',
                'name' => 'Product Name',
                'slug' => 'Slug',
                'short_description' => 'Short Description',
                'description' => 'Full Description',
                'price' => 'Price',
                'cost_price' => 'Cost Price',
                'sku' => 'SKU',
                'stock_quantity' => 'Stock Quantity',
                'low_stock_threshold' => 'Low Stock Threshold',
                'weight' => 'Weight',
                'unit_of_measure' => 'Unit of Measure',
                'expiration_date' => 'Expiration Date',
                'image_path' => 'Main Image',
                'secondary_images' => 'Additional Images',
                'is_active' => 'Active',
                'is_featured' => 'Featured Product',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
                'stock_status' => 'Stock Status',
                'profit_margin' => 'Profit Margin',
            ],

            'placeholders' => [
                'name' => 'Enter product name',
                'slug' => 'Auto-generated from name',
                'short_description' => 'Brief description shown in product listings',
                'description' => 'Detailed product description',
                'category' => 'Select product category',
                'sku' => 'e.g., PRD-001',
                'unit_of_measure' => 'e.g., piece, kg, box',
                'expiration_date' => 'Select date',
            ],

            'helpers' => [
                'slug' => 'Used in product URL. Must be unique.',
                'sku' => 'Unique code to identify the product in inventory.',
                'short_description' => 'Maximum 500 characters. Shown in search and product listings.',
                'price' => 'Selling price for customers',
                'cost_price' => 'Purchase or cost price (optional)',
                'stock_quantity' => 'Current number available in stock',
                'low_stock_threshold' => 'Alert will be triggered when stock reaches this number',
                'weight' => 'Weight in kilograms (optional)',
                'unit_of_measure' => 'Unit of sale: piece, kg, box, etc.',
                'expiration_date' => 'Product expiration date (optional)',
                'image_path' => 'Main image shown in listings. Maximum 2MB',
                'secondary_images' => 'Additional product images. Maximum 5 images, 2MB each',
                'is_active' => 'If inactive, the product won\'t be visible to customers',
                'is_featured' => 'Will be shown in the featured products section',
            ],

            'filters' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
                'featured' => 'Featured',
                'in_stock' => 'In Stock',
                'low_stock' => 'Low Stock',
                'out_of_stock' => 'Out of Stock',
                'stock_status' => 'Stock Status',
                'category' => 'Category',
                'price_range' => 'Price Range',
            ],

            'badges' => [
                'featured' => 'Featured',
                'new' => 'New',
                'low_stock' => 'Low Stock',
                'out_of_stock' => 'Out of Stock',
            ],

            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'duplicate' => 'Duplicate',
                'activate' => 'Activate',
                'deactivate' => 'Deactivate',
            ],
        ],

        'categories' => [
            'label' => 'Category',
            'plural_label' => 'Categories',
            'navigation_label' => 'Categories',

            'tabs' => [
                'general' => 'General Information',
                'settings' => 'Settings',
            ],

            'sections' => [
                'basic_information' => 'Basic Information',
                'basic_information_desc' => 'Enter the basic category details',
                'arabic_content' => 'Arabic Content',
                'arabic_content_desc' => 'Enter content in Arabic language',
                'hierarchy' => 'Hierarchy',
                'hierarchy_desc' => 'Set parent category if this is a subcategory',
                'visibility' => 'Visibility',
                'visibility_desc' => 'Control category visibility status',
            ],

            'fields' => [
                'name' => 'Category Name',
                'name_ar' => 'Category Name (Arabic)',
                'slug' => 'Slug',
                'description' => 'Description',
                'description_ar' => 'Description (Arabic)',
                'parent_id' => 'Parent Category',
                'is_active' => 'Is Active',
                'products_count' => 'Products Count',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],

            'placeholders' => [
                'name' => 'Enter category name',
                'name_ar' => 'Enter category name in Arabic',
                'slug' => 'Auto-generated from name',
                'description' => 'Category description in English',
                'description_ar' => 'Category description in Arabic',
                'parent_id' => 'Select parent category',
            ],

            'helpers' => [
                'slug' => 'Used in category URL. Must be unique.',
                'name' => 'Category name as it will appear to customers',
                'description' => 'Brief description of the category',
                'parent_id' => 'Select a parent category to create a subcategory',
                'is_active' => 'If inactive, category and its products will not be visible to customers',
            ],

            'filters' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
                'parent_categories' => 'Parent Categories',
                'subcategories' => 'Subcategories',
                'has_products' => 'Has Products',
                'trashed' => 'Trashed',
            ],

            'badges' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
                'parent' => 'Parent Category',
                'subcategory' => 'Subcategory',
            ],

            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'restore' => 'Restore',
                'force_delete' => 'Force Delete',
            ],
        ],

        'orders' => [
            'label' => 'Order',
            'plural_label' => 'Orders',
            'navigation_label' => 'Orders',
            'fields' => [
                'user_id' => 'Customer',
                'order_number' => 'Order Number',
                'total_amount' => 'Total Amount',
                'status' => 'Status',
                'shipping_address' => 'Shipping Address',
                'billing_address' => 'Billing Address',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
            'status' => [
                'pending' => 'Pending',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'cancelled' => 'Cancelled',
            ],
        ],

        'reviews' => [
            'label' => 'Review',
            'plural_label' => 'Reviews',
            'navigation_label' => 'Reviews',
            'fields' => [
                'product_id' => 'Product',
                'user_id' => 'User',
                'rating' => 'Rating',
                'comment' => 'Comment',
                'is_approved' => 'Is Approved',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
        ],

        'wishlists' => [
            'label' => 'Wishlist',
            'plural_label' => 'Wishlists',
            'navigation_label' => 'Wishlists',
            'fields' => [
                'user_id' => 'User',
                'product_id' => 'Product',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
        ],

        'posts' => [
            'label' => 'Post',
            'plural_label' => 'Posts',
            'navigation_label' => 'Posts',
            'fields' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'content' => 'Content',
                'excerpt' => 'Excerpt',
                'featured_image' => 'Featured Image',
                'author_id' => 'Author',
                'published_at' => 'Published At',
                'is_published' => 'Is Published',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
        ],

        'pages' => [
            'label' => 'Page',
            'plural_label' => 'Pages',
            'navigation_label' => 'Pages',
            'fields' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'content' => 'Content',
                'is_published' => 'Is Published',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
        ],

        'banners' => [
            'label' => 'Banner',
            'plural_label' => 'Banners',
            'navigation_label' => 'Banners',
            'fields' => [
                'title' => 'Title',
                'image_path' => 'Image',
                'link' => 'Link',
                'description' => 'Description',
                'is_active' => 'Is Active',
                'display_order' => 'Display Order',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
        ],

        'faqs' => [
            'label' => 'FAQ',
            'plural_label' => 'FAQs',
            'navigation_label' => 'FAQs',
            'fields' => [
                'question' => 'Question',
                'answer' => 'Answer',
                'display_order' => 'Display Order',
                'is_active' => 'Is Active',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
        ],

        'testimonials' => [
            'label' => 'Testimonial',
            'plural_label' => 'Testimonials',
            'navigation_label' => 'Testimonials',
            'fields' => [
                'name' => 'Name',
                'position' => 'Position',
                'company' => 'Company',
                'content' => 'Content',
                'image_path' => 'Image',
                'rating' => 'Rating',
                'is_active' => 'Is Active',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
        ],

        'users' => [
            'label' => 'User',
            'plural_label' => 'Users',
            'navigation_label' => 'Users',
            'navigation_group' => 'Roles & Permissions',

            'fields' => [
                'name' => 'Name',
                'email' => 'Email Address',
                'email_verified_at' => 'Email Verified At',
                'password' => 'Password',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],

            'placeholders' => [
                'name' => 'Enter full name',
                'email' => 'user@example.com',
                'password' => 'Enter a strong password',
            ],

            'helpers' => [
                'email' => 'This email will be used for login',
                'password' => 'Password must be at least 8 characters',
                'email_verified_at' => 'Date when email was verified',
            ],

            'actions' => [
                'verify_email' => 'Verify Email',
                'reset_password' => 'Reset Password',
                'view' => 'View',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'restore' => 'Restore',
                'force_delete' => 'Force Delete',
            ],

            'filters' => [
                'verified' => 'Verified',
                'unverified' => 'Unverified',
                'trashed' => 'Trashed',
            ],

            'badges' => [
                'verified' => 'Verified',
                'unverified' => 'Unverified',
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
        ],
    ],

    'pages' => [
        'dashboard' => 'Dashboard',
    ],
];
