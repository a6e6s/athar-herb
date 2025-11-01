<?php

return [
    'navigation' => [
        'groups' => [
            'e-commerce' => 'E-commerce',
            'content' => 'Content',
        ],
    ],

    'resources' => [
        'products' => [
            'label' => 'Product',
            'plural_label' => 'Products',
            'navigation_label' => 'Products',
            'fields' => [
                'category_id' => 'Category',
                'name' => 'Name',
                'slug' => 'Slug',
                'short_description' => 'Short Description',
                'description' => 'Description',
                'price' => 'Price',
                'cost_price' => 'Cost Price',
                'sku' => 'SKU',
                'stock_quantity' => 'Stock Quantity',
                'low_stock_threshold' => 'Low Stock Threshold',
                'weight' => 'Weight',
                'unit_of_measure' => 'Unit of Measure',
                'expiration_date' => 'Expiration Date',
                'image_path' => 'Image',
                'secondary_images' => 'Secondary Images',
                'is_active' => 'Is Active',
                'is_featured' => 'Is Featured',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
            ],
        ],

        'categories' => [
            'label' => 'Category',
            'plural_label' => 'Categories',
            'navigation_label' => 'Categories',
            'fields' => [
                'name' => 'Name',
                'slug' => 'Slug',
                'description' => 'Description',
                'parent_id' => 'Parent Category',
                'is_active' => 'Is Active',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
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
    ],

    'pages' => [
        'dashboard' => 'Dashboard',
    ],
];
