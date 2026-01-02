<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        $products = $query->get();
        $categories = Category::all();
        
        return view('welcome', compact('products', 'categories'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Ambil jumlah dari input user 
        $quantity = (int) $request->query('quantity', 1);

        // Validasi stok
        if($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', $quantity . 'x ' . $product->name . ' berhasil masuk kotak!');
    }

    public function cart()
    {
        return view('cart');
    }

    public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'order_type' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Ambil Cart
                $cart = session('cart', []);
                
                if(empty($cart)) {
                    throw new Exception("Keranjang belanja kosong!");
                }

                $total = 0;
                
                // 2. Cek Stok 
                foreach($cart as $id => $details) {
                    $product = Product::lockForUpdate()->find($id);
                    if(!$product || $product->stock < $details['quantity']) {
                        throw new Exception("Maaf, stok untuk " . $details['name'] . " tidak mencukupi.");
                    }
                    $total += $details['price'] * $details['quantity'];
                }

                // 3. Buat Order
                $order = Order::create([
                    'customer_name' => $request->customer_name,
                    'customer_phone' => $request->customer_phone,
                    'order_type' => $request->order_type,
                    'address' => $request->address,
                    'total_price' => $total,
                    'status' => 'pending'
                ]);

                // 4. Masukkan Item & Kurangi Stok
                foreach($cart as $id => $details) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'quantity' => $details['quantity'],
                        'price' => $details['price']
                    ]);

                    // Kurangi Stok
                    $product = Product::find($id);
                    $product->decrement('stock', $details['quantity']);
                }

                // 5. Hapus Cart
                session()->forget('cart');
                
                // Simpan ID order untuk redirect
                session()->flash('order_id', $order->id);
            });

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        // 6. Redirect ke Halaman Sukses (Invoice Internal)
        return redirect()->route('order.success', session('order_id'));
    }

    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('success', compact('order'));
    }

    public function trackOrder(Request $request)
    {
        $order = null;
        if ($request->has('order_id')) {
            $order = Order::with('items.product')->find($request->order_id);
        }
        return view('track', compact('order'));
    }
}