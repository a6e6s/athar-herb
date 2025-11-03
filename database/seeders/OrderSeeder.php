<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all customer users
        $customers = User::where('user_type', UserType::CUSTOMER)->get();

        // If no customers exist, create some
        if ($customers->isEmpty()) {
            $customers = User::factory(10)->create([
                'user_type' => UserType::CUSTOMER,
                'is_active' => true,
            ]);
        }

        // Get all products
        $products = Product::where('is_active', true)->get();

        // If no products exist, skip seeding
        if ($products->isEmpty()) {
            $this->command->warn('No products found. Please seed products first.');
            return;
        }

        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentStatuses = ['pending', 'paid', 'failed', 'refunded'];
        $paymentMethods = ['cash_on_delivery', 'credit_card', 'debit_card', 'bank_transfer', 'paypal'];

        $cities = [
            'الرياض' => 'Riyadh',
            'جدة' => 'Jeddah',
            'مكة المكرمة' => 'Mecca',
            'المدينة المنورة' => 'Medina',
            'الدمام' => 'Dammam',
            'الخبر' => 'Khobar',
            'الطائف' => 'Taif',
            'تبوك' => 'Tabuk',
            'أبها' => 'Abha',
            'القصيم' => 'Qassim',
        ];

        $this->command->info('Creating orders...');
        $progressBar = $this->command->getOutput()->createProgressBar(50);
        $progressBar->start();

        // Create 50 orders with varying dates
        for ($i = 0; $i < 50; $i++) {
            $customer = $customers->random();
            $orderDate = now()->subDays(rand(0, 90))->subHours(rand(0, 23));

            // Random city
            $cityAr = array_rand($cities);
            $cityEn = $cities[$cityAr];

            // Generate shipping and billing addresses
            $shippingAddress = [
                'name' => $customer->name,
                'phone' => '05' . rand(10000000, 99999999),
                'address' => 'حي ' . ['النرجس', 'الياسمين', 'الورود', 'الربيع', 'النخيل'][rand(0, 4)] . '، شارع ' . rand(1, 50),
                'city' => $cityAr,
                'postal_code' => rand(10000, 99999),
                'country' => 'المملكة العربية السعودية',
            ];

            $billingAddress = $shippingAddress; // Same as shipping for simplicity

            // Calculate order details
            $subtotal = 0;
            $orderNumber = 'ORD-' . strtoupper(uniqid());

            // Determine order status and payment based on date
            $daysAgo = now()->diffInDays($orderDate);
            if ($daysAgo > 60) {
                $status = ['delivered', 'cancelled'][rand(0, 1)];
                $paymentStatus = $status === 'delivered' ? 'paid' : ['failed', 'refunded'][rand(0, 1)];
            } elseif ($daysAgo > 30) {
                $status = ['delivered', 'shipped'][rand(0, 1)];
                $paymentStatus = 'paid';
            } elseif ($daysAgo > 7) {
                $status = ['processing', 'shipped', 'delivered'][rand(0, 2)];
                $paymentStatus = ['paid', 'pending'][rand(0, 1)];
            } else {
                $status = ['pending', 'processing'][rand(0, 1)];
                $paymentStatus = ['pending', 'paid'][rand(0, 1)];
            }

            // Create the order
            $order = Order::create([
                'user_id' => $customer->id,
                'order_number' => $orderNumber,
                'total_amount' => 0, // Will update after adding items
                'status' => $status,
                'payment_status' => $paymentStatus,
                'payment_method' => $paymentMethods[rand(0, count($paymentMethods) - 1)],
                'shipping_address' => $shippingAddress,
                'billing_address' => $billingAddress,
                'tax' => 0, // Will calculate
                'shipping_cost' => 0, // Will calculate
                'discount' => 0,
                'notes' => rand(0, 10) > 7 ? 'يرجى التسليم في المساء فقط' : null,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            // Add random number of items (1-5)
            $itemCount = rand(1, 5);
            $selectedProducts = $products->random($itemCount);

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->discount_price ?? $product->price;
                $total = $price * $quantity;
                $subtotal += $total;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name_ar,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total' => $total,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);
            }

            // Calculate shipping cost (free for orders over 200 SAR)
            $shippingCost = $subtotal >= 200 ? 0 : 30;

            // Calculate 15% VAT
            $tax = $subtotal * 0.15;

            // Random discount for some orders
            $discount = rand(0, 10) > 7 ? rand(10, 50) : 0;

            // Update order with final amounts
            $totalAmount = $subtotal + $tax + $shippingCost - $discount;

            $order->update([
                'total_amount' => $totalAmount,
                'tax' => $tax,
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('✓ Successfully created 50 orders with items!');

        // Display summary
        $this->command->newLine();
        $this->command->info('Order Summary:');
        $this->command->table(
            ['Status', 'Count'],
            collect($statuses)->map(function ($status) {
                return [$status, Order::where('status', $status)->count()];
            })
        );

        $this->command->newLine();
        $this->command->info('Payment Summary:');
        $this->command->table(
            ['Payment Status', 'Count'],
            collect($paymentStatuses)->map(function ($paymentStatus) {
                return [$paymentStatus, Order::where('payment_status', $paymentStatus)->count()];
            })
        );

        $this->command->newLine();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $this->command->info("Total Revenue (Paid Orders): " . number_format($totalRevenue, 2) . " SAR");
    }
}
