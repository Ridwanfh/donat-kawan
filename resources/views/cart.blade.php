<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Toko Donat KaWan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600&display=swap');
        body { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="bg-[#FFF5F7] min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4 py-4">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-pink-600 font-bold flex items-center gap-2 transition">
                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center hover:bg-pink-100">
                    <i class="fas fa-arrow-left text-sm"></i>
                </div>
                Kembali ke Menu
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Keranjang Belanjaan</h1>

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i> {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-4">
                @if(session('cart'))
                    <div class="hidden md:grid grid-cols-12 gap-4 text-sm text-gray-400 uppercase tracking-wider font-bold mb-2 pl-4">
                        <div class="col-span-6">Produk</div>
                        <div class="col-span-2 text-center">Harga</div>
                        <div class="col-span-2 text-center">Qty</div>
                        <div class="col-span-2 text-right">Total</div>
                    </div>

                    @php $total = 0; $count = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php 
                            $total += $details['price'] * $details['quantity']; 
                            $count += $details['quantity'];
                        @endphp
                        
                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:grid md:grid-cols-12 gap-4 items-center relative group hover:shadow-md transition">
                            
                            <div class="col-span-6 w-full flex items-center gap-4">
                                <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                                    @if($details['image'])
                                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-300"><i class="fas fa-image"></i></div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $details['name'] }}</h3>
                                    <p class="text-xs text-gray-400">Varian Lezat</p>
                                </div>
                            </div>

                            <div class="col-span-2 text-gray-600 font-medium">
                                <span class="md:hidden text-xs text-gray-400">Harga: </span>
                                Rp {{ number_format($details['price'], 0, ',', '.') }}
                            </div>

                            <div class="col-span-2 flex justify-center">
                                <span class="bg-pink-50 text-pink-600 font-bold px-4 py-1 rounded-full text-sm border border-pink-100">
                                    x {{ $details['quantity'] }}
                                </span>
                            </div>

                            <div class="col-span-2 text-right font-bold text-gray-800">
                                <span class="md:hidden text-xs text-gray-400 mr-2">Subtotal: </span>
                                Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                            </div>

                            <form action="{{ route('remove.from.cart') }}" method="POST" class="absolute top-2 right-2 md:static md:col-span-1">
                                @csrf @method('DELETE')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-start gap-3 mt-4">
                        <i class="fas fa-box-open text-yellow-600 mt-1"></i>
                        <div class="text-sm text-yellow-800">
                            <strong>Status Kotak:</strong> Kamu punya <strong>{{ $count }}</strong> donat.
                            @if($count < 6)
                                Tambah <span class="font-bold">{{ 6 - $count }}</span> lagi untuk 1/2 Lusin.
                            @elseif($count > 6 && $count < 12)
                                Tambah <span class="font-bold">{{ 12 - $count }}</span> lagi untuk 1 Lusin.
                            @else
                                Kotakmu sudah penuh kebahagiaan!
                            @endif
                        </div>
                    </div>

                @else
                    <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                        <div class="w-24 h-24 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shopping-basket text-4xl text-pink-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Keranjang Masih Kosong</h3>
                        <p class="text-gray-400 mb-6">Yuk isi dengan yang manis-manis!</p>
                        <a href="{{ route('home') }}" class="bg-pink-600 text-white px-8 py-3 rounded-full font-bold hover:bg-pink-700 transition shadow-lg shadow-pink-200">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>

            <div class="h-fit">
                <div class="bg-white p-6 md:p-8 rounded-3xl shadow-lg border border-gray-100 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Informasi Pengiriman</h2>
                    
                    <form action="{{ route('checkout') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="customer_name" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition" placeholder="Siapa namamu?" required>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">WhatsApp</label>
                            <input type="number" name="customer_phone" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition" placeholder="08xxxxx" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Metode Ambil</label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="cursor-pointer">
                                    <input type="radio" name="order_type" value="pickup" class="peer sr-only" checked onchange="toggleAddress()">
                                    <div class="bg-white border-2 border-gray-200 rounded-xl p-3 text-center peer-checked:border-pink-500 peer-checked:text-pink-600 peer-checked:bg-pink-50 transition">
                                        <i class="fas fa-store mb-1 block"></i> Pickup
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="order_type" value="delivery" class="peer sr-only" onchange="toggleAddress()">
                                    <div class="bg-white border-2 border-gray-200 rounded-xl p-3 text-center peer-checked:border-pink-500 peer-checked:text-pink-600 peer-checked:bg-pink-50 transition">
                                        <i class="fas fa-motorcycle mb-1 block"></i> Delivery
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="addressBox" class="hidden">
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Alamat Lengkap</label>
                            <textarea name="address" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition" placeholder="Jalan, No Rumah, Patokan..."></textarea>
                        </div>

                        <hr class="border-dashed border-gray-200 my-4">

                        <div class="flex justify-between items-end mb-6">
                            <span class="text-gray-500">Total Bayar</span>
                            <span class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-pink-600 hover:scale-[1.02] transition shadow-xl disabled:opacity-50 disabled:cursor-not-allowed" {{ empty(session('cart')) ? 'disabled' : '' }}>
                            Buat Pesanan <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAddress() {
            const isDelivery = document.querySelector('input[name="order_type"]:checked').value === 'delivery';
            const box = document.getElementById('addressBox');
            if(isDelivery) {
                box.classList.remove('hidden');
            } else {
                box.classList.add('hidden');
            }
        }
    </script>
</body>
</html>