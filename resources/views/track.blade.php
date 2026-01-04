<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Pesanan - Toko Donat KaWan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&display=swap');
        body { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="bg-[#F0F7FF] min-h-screen flex flex-col">

    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-blue-600 font-bold hover:underline"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-10 flex-grow flex flex-col items-center">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Lacak Status Donatmu <i class="fas fa-search-location text-blue-500"></i></h1>

        <div class="bg-white p-6 rounded-2xl shadow-lg max-w-lg w-full mb-8">
            <form action="{{ route('track.order') }}" method="GET" class="flex gap-2">
                <input type="number" name="order_id" placeholder="Masukkan Nomor Order (Contoh: 1)" class="w-full border rounded-lg px-4 py-3 focus:outline-blue-500" value="{{ request('order_id') }}" required>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                    Cek
                </button>
            </form>
        </div>

        @if(request()->has('order_id'))
            @if($order)
                <div class="bg-white p-6 rounded-2xl shadow-xl max-w-2xl w-full border-t-4 border-blue-500">
                    <div class="flex justify-between items-center mb-4 border-b pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
                            <p class="text-gray-500 text-sm">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm text-gray-500">Status:</span>
                            @if($order->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-bold">Menunggu Konfirmasi</span>
                            @elseif($order->status == 'completed')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">Selesai / Dikirim</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-bold">Dibatalkan</span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="font-bold text-gray-700">Detail Pesanan:</p>
                        <ul class="list-disc pl-5 text-gray-600">
                            @foreach($order->items as $item)
                                <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                        <p class="mt-4 pt-4 border-t font-bold text-lg text-right">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @else
                <div class="bg-red-100 text-red-600 p-4 rounded-lg text-center max-w-lg w-full">
                    <i class="fas fa-exclamation-circle"></i> Order dengan ID <strong>{{ request('order_id') }}</strong> tidak ditemukan.
                </div>
            @endif
        @endif
    </div>

</body>
</html>