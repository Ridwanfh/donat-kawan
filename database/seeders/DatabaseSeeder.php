<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin (Jika belum ada)
        User::updateOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin Donat',
            'password' => Hash::make('password'),
        ]);

        // 2. Buat Kategori
        $cat1 = Category::create(['name' => 'Coklat Lovers', 'slug' => 'coklat-lovers']);
        $cat2 = Category::create(['name' => 'Buah Segar', 'slug' => 'buah-segar']);
        $cat3 = Category::create(['name' => 'Kacang Gurih', 'slug' => 'kacang-gurih']);

        // 3. Buat Produk Dummy (Stok awal 50)
        // Note: Gambar dikosongkan dulu, nanti Anda upload manual pas Demo biar terlihat "Real"
        $p1 = Product::create([
            'category_id' => $cat1->id,
            'name' => 'Choco Lava Explosion',
            'slug' => 'choco-lava',
            'description' => 'Donat dengan isian coklat lumer yang meledak di mulut.',
            'price' => 12000,
            'stock' => 50,
        ]);

        $p2 = Product::create([
            'category_id' => $cat2->id,
            'name' => 'Strawberry Glaze',
            'slug' => 'strawberry-glaze',
            'description' => 'Manis asam segar strawberry asli.',
            'price' => 10000,
            'stock' => 45,
        ]);
        
        $p3 = Product::create([
            'category_id' => $cat3->id,
            'name' => 'Almond Crunchy',
            'slug' => 'almond-crunchy',
            'description' => 'Taburan almond panggang yang renyah.',
            'price' => 15000,
            'stock' => 30,
        ]);

        // 4. Buat Dummy Orders (Untuk Grafik Dashboard)
        // Kita buat seolah-olah ada transaksi minggu lalu
        for ($i = 0; $i < 10; $i++) {
            $order = Order::create([
                'customer_name' => 'Pelanggan ' . $i,
                'customer_phone' => '0812345678' . $i,
                'order_type' => $i % 2 == 0 ? 'pickup' : 'delivery',
                'total_price' => rand(50000, 150000),
                'status' => 'completed',
                'created_at' => now()->subDays(rand(1, 7)), // Random tanggal 7 hari terakhir
                'updated_at' => now()->subDays(rand(1, 7)),
            ]);
        }
    }
}