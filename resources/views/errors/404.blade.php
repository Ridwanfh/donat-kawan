<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Toko Donat KsaWan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>@import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&display=swap'); body { font-family: 'Fredoka', sans-serif; }</style>
</head>
<body class="bg-pink-50 min-h-screen flex flex-col items-center justify-center text-center px-4">
    
    <div class="relative mb-8">
        <i class="fas fa-cookie-bite text-9xl text-pink-300 animate-bounce"></i>
        <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-24 h-4 bg-gray-200 rounded-full blur-sm"></div>
    </div>

    <h1 class="text-6xl font-bold text-pink-600 mb-2">404</h1>
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Ups! Donatnya Gelinding Entah Kemana</h2>
    <p class="text-gray-500 mb-8 max-w-md">Halaman yang kamu cari sepertinya sudah dimakan atau tidak pernah ada.</p>

    <a href="{{ url('/') }}" class="bg-pink-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-700 transition transform hover:scale-105">
        <i class="fas fa-arrow-left mr-2"></i> Balik ke Toko
    </a>

</body>
</html>