<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Toko Donat KaWan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&display=swap');
        body { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="bg-pink-50 min-h-screen flex items-center justify-center py-10">

    <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-md w-full text-center border-t-8 border-pink-500 relative overflow-hidden">
        
        <div class="mb-6">
            <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto text-4xl shadow-inner">
                <i class="fas fa-check"></i>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2">Hore! Pesanan Diterima</h1>
        <p class="text-gray-500 mb-6">Terima kasih Kak <strong>{{ $order->customer_name }}</strong>, donatmu sedang disiapkan!</p>

        <div class="bg-gray-50 rounded-xl p-4 text-left border border-gray-200 mb-6 relative">
            <div class="absolute -bottom-1 left-0 w-full h-2 bg-white" style="background-image: radial-gradient(circle, transparent 50%, white 50%); background-size: 10px 10px;"></div>
            
            <div class="flex justify-between text-sm text-gray-500 mb-2">
                <span>ID Order: #{{ $order->id }}</span>
                <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>

            <div class="flex justify-between text-sm text-gray-500 mb-2">
                <span>Tipe: <span class="font-bold uppercase text-pink-600">{{ $order->order_type }}</span></span>
            </div>

            @if($order->order_type == 'delivery')
            <div class="mb-4 text-sm text-gray-600 bg-white p-3 rounded border border-gray-100">
                <span class="font-bold block text-gray-800 mb-1">Alamat Pengiriman:</span>
                {{ $order->address }}
            </div>
            @endif

            <hr class="border-dashed border-gray-300 my-2">

            <div class="space-y-2 mb-4">
                @foreach($order->items as $item)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-700">{{ $item->quantity }}x {{ $item->product->name }}</span>
                    <span class="font-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <hr class="border-gray-300 my-2">

            <div class="flex justify-between text-lg font-bold text-gray-800">
                <span>Total Bayar</span>
                <span class="text-pink-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="space-y-3">
            <a href="https://wa.me/?text=Halo%20Admin,%20saya%20sudah%20pesan%20dengan%20ID%20{{ $order->id }}" target="_blank" class="block w-full bg-green-500 text-white font-bold py-3 rounded-lg hover:bg-green-600 transition">
                <i class="fab fa-whatsapp"></i> Konfirmasi ke WhatsApp
            </a>
            <a href="{{ route('home') }}" class="block w-full bg-pink-100 text-pink-600 font-bold py-3 rounded-lg hover:bg-pink-200 transition">
                Pesan Lagi
            </a>
            <button onclick="window.print()" class="text-gray-400 text-sm hover:text-gray-600 mt-2 underline">
                Cetak Bukti Pesanan
            </button>
        </div>
    </div>

</body>
</html>