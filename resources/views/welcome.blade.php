<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Donat KaWan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Fredoka', sans-serif; }
        
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #fdf2f8; }
        ::-webkit-scrollbar-thumb { background: #db2777; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #be185d; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Glassmorphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-[#FFF5F7] text-gray-800 flex flex-col min-h-screen selection:bg-pink-200 selection:text-pink-900">

    <nav class="fixed w-full z-50 transition-all duration-300 glass shadow-sm">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center py-4">
                
                <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-bold text-pink-600 flex items-center gap-2 hover:scale-105 transition transform">
                    <div class="bg-pink-100 p-2 rounded-full"><i class="fas fa-donut text-pink-600"></i></div>
                    <span class="text-gray-800 tracking-tight">KaWan<span class="text-pink-500">.</span></span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-pink-600 font-medium transition">Beranda</a>
                    <a href="#katalog" class="text-gray-600 hover:text-pink-600 font-medium transition">Menu</a>
                    <a href="{{ route('track.order') }}" class="text-gray-600 hover:text-pink-600 font-medium transition flex items-center gap-2">
                        <i class="fas fa-search"></i> Lacak Order
                    </a>
                    
                    <a href="{{ route('cart') }}" class="relative bg-pink-600 text-white px-5 py-2 rounded-full font-bold shadow-lg shadow-pink-200 hover:bg-pink-700 hover:shadow-pink-300 transition flex items-center gap-2">
                        <i class="fas fa-shopping-basket"></i>
                        <span>Rp {{ number_format(collect(session('cart'))->sum(fn($i) => $i['price'] * $i['quantity']), 0, ',', '.') }}</span>
                        @if(session('cart'))
                            <span class="absolute -top-1 -right-1 bg-yellow-400 text-pink-900 text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold border-2 border-white">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                </div>

                <div class="md:hidden flex items-center gap-4">
                    <a href="{{ route('cart') }}" class="relative text-pink-600 text-2xl">
                        <i class="fas fa-shopping-basket"></i>
                        @if(session('cart'))
                            <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                    <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden pb-4 bg-white/90 backdrop-blur-md absolute w-full left-0 top-full shadow-lg border-t border-gray-100">
                <div class="flex flex-col p-4 space-y-3">
                    <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg hover:bg-pink-50 text-gray-700 font-bold">Beranda</a>
                    <a href="#katalog" class="block px-4 py-2 rounded-lg hover:bg-pink-50 text-gray-700 font-bold">Menu Favorit</a>
                    <a href="{{ route('track.order') }}" class="block px-4 py-2 rounded-lg hover:bg-pink-50 text-gray-700 font-bold">Cek Pesanan</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="pt-32 pb-20 px-4 relative overflow-hidden">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div data-aos="fade-right" class="text-center md:text-left z-10">
                <span class="bg-orange-100 text-orange-600 px-4 py-1 rounded-full text-sm font-bold tracking-wide mb-4 inline-block">
                    <i class="fas fa-fire mr-1"></i> Donat Paling Viral 2025
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight mb-6">
                    Rasakan <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600">Ledakan</span> Rasa di Mulutmu!
                </h1>
                <p class="text-lg text-gray-500 mb-8 max-w-lg mx-auto md:mx-0 leading-relaxed">
                    Dibuat dengan cinta, tepung premium, dan topping yang melimpah ruah. Pesan sekarang, kami antar selagi hangat.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#katalog" class="bg-pink-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-pink-700 transition shadow-xl shadow-pink-200 transform hover:-translate-y-1">
                        Pesan Sekarang
                    </a>
                    <a href="{{ route('track.order') }}" class="bg-white text-gray-700 border border-gray-200 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-50 transition flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i> Lacak Order
                    </a>
                </div>
            </div>

            <div data-aos="fade-left" class="relative z-10 flex justify-center">
                <div class="absolute inset-0 bg-pink-200 rounded-full blur-3xl opacity-30 animate-pulse"></div>
                <div class="relative bg-white/40 backdrop-blur-sm p-8 rounded-[3rem] border border-white/50 shadow-2xl transform rotate-3 hover:rotate-0 transition duration-500">
                    <div class="text-center">
                        <i class="fas fa-donut text-[150px] text-pink-500 drop-shadow-2xl animate-bounce" style="animation-duration: 3s;"></i>
                        <div class="mt-6 bg-white/80 backdrop-blur px-6 py-3 rounded-2xl shadow-lg inline-block">
                            <p class="font-bold text-gray-800">🔥 Best Seller</p>
                            <p class="text-sm text-pink-500">Choco Lava</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-pink-100 to-transparent -z-10 opacity-50"></div>
    </header>

<section class="py-12 bg-white/50 backdrop-blur-sm border-y border-pink-100 mb-10">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Cara Pesan Donat KaWan <i class="fas fa-utensils text-pink-500 ml-2"></i></h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 relative">
            <div class="group" data-aos="fade-up" data-aos-delay="0">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-500 group-hover:text-white transition duration-300">
                    <i class="fas fa-hand-pointer text-2xl text-pink-500 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">1. Pilih Varian</h3>
                <p class="text-sm text-gray-500">Klik donat favoritmu.</p>
            </div>
            
            <div class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-500 group-hover:text-white transition duration-300">
                    <i class="fas fa-shopping-basket text-2xl text-pink-500 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">2. Isi Keranjang</h3>
                <p class="text-sm text-gray-500">Tentukan jumlahnya.</p>
            </div>

            <div class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-500 group-hover:text-white transition duration-300">
                    <i class="fas fa-map-marker-alt text-2xl text-pink-500 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">3. Checkout</h3>
                <p class="text-sm text-gray-500">Pilih Delivery/Pickup.</p>
            </div>

            <div class="group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-500 group-hover:text-white transition duration-300">
                    <i class="fas fa-smile-beam text-2xl text-pink-500 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">4. Nikmati!</h3>
                <p class="text-sm text-gray-500">Donat siap disantap.</p>
            </div>
        </div>
    </div>
</section>

    <div class="container mx-auto px-4 md:px-8 py-10" id="katalog">
        
        <div class="flex justify-center mb-10">
            <div class="bg-white p-2 rounded-full shadow-lg border border-gray-100 flex overflow-x-auto space-x-2 max-w-full no-scrollbar">
                <a href="{{ route('home') }}" class="whitespace-nowrap px-6 py-2 rounded-full font-bold transition {{ !request('category') ? 'bg-pink-600 text-white shadow-md' : 'text-gray-500 hover:bg-gray-100' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat->slug]) }}" class="whitespace-nowrap px-6 py-2 rounded-full font-bold transition {{ request('category') == $cat->slug ? 'bg-pink-600 text-white shadow-md' : 'text-gray-500 hover:bg-gray-100' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-8 mb-8" data-aos="fade-down">
            <div class="relative max-w-xl mx-auto">
                <input type="text" id="searchInput" placeholder="Cari rasa favoritmu... (cth: Keju, Coklat)" 
                       class="w-full pl-12 pr-4 py-4 rounded-full border border-pink-100 shadow-lg focus:outline-none focus:ring-4 focus:ring-pink-200 transition bg-white/80 backdrop-blur text-gray-700">
                <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-pink-400 text-xl"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $index => $product)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 50 }}" class="product-card group bg-white rounded-[2rem] shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden relative flex flex-col h-full">
                
                <div class="h-56 bg-gray-50 relative overflow-hidden p-0 flex items-center justify-center"> <div class="absolute w-48 h-48 bg-pink-100 rounded-full opacity-0 group-hover:opacity-100 transition duration-500 scale-0 group-hover:scale-100"></div>
                    
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover relative z-10 group-hover:scale-110 group-hover:rotate-3 transition duration-500">
                    @else
                        <div class="w-full h-full p-6 flex items-center justify-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/3081/3081920.png" class="w-full h-full object-contain relative z-10 opacity-50 grayscale group-hover:grayscale-0 transition duration-500">
                        </div>
                    @endif

                    <div class="absolute top-3 left-3 z-20 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded-full shadow-sm text-gray-600 border border-gray-100">
                        <i class="fas fa-box mr-1"></i> {{ $product->stock }}
                    </div>

                    @if($index < 2) 
                        <div class="absolute top-3 right-0 z-20 bg-yellow-400 text-pink-900 text-[10px] font-bold px-3 py-1 rounded-l-full shadow-md flex items-center gap-1 animate-pulse">
                            <i class="fas fa-crown text-pink-700"></i> Best Seller
                        </div>
                    @endif
                </div>

                <div class="p-6 flex flex-col flex-grow bg-white relative z-20">
                    <div class="mb-2">
                        <span class="text-xs font-bold text-pink-500 uppercase tracking-wider">{{ $product->category->name ?? 'Donat' }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 leading-tight group-hover:text-pink-600 transition">{{ $product->name }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $product->description }}</p>
                    
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <div class="flex justify-between items-end mb-3">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400">Harga</span>
                                <span class="text-xl font-bold text-gray-800">Rp {{ number_format($product->price/1000, 0) }}<span class="text-sm text-gray-500">rb</span></span>
                            </div>
                            <span class="text-xs text-pink-500 bg-pink-50 px-2 py-1 rounded-lg">
                                Sisa: {{ $product->stock }}
                            </span>
                        </div>

                        <form action="{{ route('add.to.cart', $product->id) }}" method="GET" class="flex gap-2">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                   class="w-16 bg-gray-50 border border-gray-200 rounded-lg text-center font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                   placeholder="1">
                            
                            <button type="submit" class="flex-1 bg-gray-900 text-white rounded-lg py-2 font-bold hover:bg-pink-600 transition shadow-lg flex items-center justify-center gap-2 group-active:scale-95">
                                <i class="fas fa-plus text-xs"></i> <span class="text-sm">Keranjang</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

<div id="emptyState" class="hidden text-center py-20">
    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-search text-4xl text-gray-400"></i>
    </div>
    <h3 class="text-xl font-bold text-gray-600">Yah, pencarian tidak ditemukan</h3>
    <p class="text-gray-400">Coba kata kunci lain seperti "Coklat" atau "Keju"</p>
</div>

    <section class="py-20 bg-white relative mt-10">
        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-[#FFF5F7] to-white"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-12">Kata Mereka yang Sudah <span class="text-pink-600">Ketagihan</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-[2rem] hover:bg-pink-50 transition duration-300 text-left relative">
                    <div class="text-5xl text-pink-200 absolute top-4 right-6">"</div>
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6 relative z-10">"Sumpah donatnya lembut banget! Coklatnya gak bikin eneg. Fix bakal langganan buat camilan skripsi."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center font-bold text-purple-600">S</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Sarah A.</h4>
                            <p class="text-xs text-gray-500">Mahasiswi</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-[2rem] hover:bg-pink-50 transition duration-300 text-left relative">
                    <div class="text-5xl text-pink-200 absolute top-4 right-6">"</div>
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6 relative z-10">"Respon admin cepet, pengiriman aman. Pas sampe rumah, donatnya masih cantik gak belepotan."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center font-bold text-blue-600">B</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Bayu P.</h4>
                            <p class="text-xs text-gray-500">Freelancer</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-[2rem] hover:bg-pink-50 transition duration-300 text-left relative">
                    <div class="text-5xl text-pink-200 absolute top-4 right-6">"</div>
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6 relative z-10">"Varian kejunya juara dunia! Asin manisnya pas. Tolong stok diperbanyak min, sering kehabisan!"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center font-bold text-green-600">D</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Dina M.</h4>
                            <p class="text-xs text-gray-500">Ibu Rumah Tangga</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white pt-16 pb-8 mt-20 rounded-t-[3rem]">
        <div class="container mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="bg-pink-600 p-2 rounded-lg"><i class="fas fa-donut text-white text-xl"></i></div>
                        <span class="text-2xl font-bold">KaWan Donuts</span>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Menyajikan kebahagiaan berbentuk bulat sejak 2025. Dibuat dengan bahan premium dan cinta yang tulus.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-pink-500 border-b border-gray-800 pb-2 inline-block">Jam Operasional</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span class="text-white">09:00 - 21:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu</span>
                            <span class="text-white">09:00 - 22:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Minggu</span>
                            <span class="text-pink-400 font-bold">Libur (Rebahan)</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-pink-500 border-b border-gray-800 pb-2 inline-block">Lokasi Kami</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-pink-600"></i>
                            <span>Jl. KaWan No. 123, Kampus Univ, Kota Pendidikan.</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="fas fa-phone mt-1 text-pink-600"></i>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="fas fa-envelope mt-1 text-pink-600"></i>
                            <span>hello@donatkawan.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; 2025 Toko Donat KaWan. Built with Laravel 11 & Filament.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
        
        // Mobile Menu Logic
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Yummy!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#db2777',
            confirmButtonText: 'Lanjut Belanja'
        });
    </script>
    @endif

    <script>
        // Live Search 
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let products = document.querySelectorAll('.product-card');
            let emptyState = document.getElementById('emptyState');
            let found = false;

            products.forEach(function(card) {
                let title = card.querySelector('h3').innerText.toLowerCase();
                let desc = card.querySelector('p').innerText.toLowerCase();
                
                if (title.includes(filter) || desc.includes(filter)) {
                    card.style.display = ""; 
                    card.classList.add('animate-fade-in'); 
                    found = true;
                } else {
                    card.style.display = "none"; 
                }
            });

            if (!found) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        });
    </script>

</body>
</html>