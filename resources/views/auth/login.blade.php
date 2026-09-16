<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT BPR Adipura Santosa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

    <div class="relative bg-white p-8 pt-16 rounded-2xl shadow-xl w-full max-w-sm mt-8 border border-slate-200">
        
        <!-- Ikon Profil Bulat di Atas -->
        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
            <div class="w-24 h-24 bg-gradient-to-br from-[#0A3370] to-[#0082CB] rounded-full flex items-center justify-center shadow-lg border-4 border-white text-white transition-transform duration-300 hover:scale-105 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 drop-shadow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
        </div>

        <!-- Judul Instansi -->
        <div class="text-center mb-6 mt-2">
            <h2 class="text-lg font-bold text-slate-800">PT BPR Adipura Santosa</h2>
            <p class="text-xs text-slate-400">Silakan login untuk melanjutkan</p>
        </div>

        <!-- PESAN ERROR -->
        @if ($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-r text-xs shadow-sm">
                <p class="font-bold">Login Gagal!</p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-r text-xs shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Input Username (Sudah Diubah) -->
            <div class="flex items-stretch border border-slate-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-[#0082CB] shadow-sm">
                <div class="bg-[#0A3370] text-white px-3.5 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input type="text" name="username" value="{{ old('username') }}" required placeholder="Username"
                    class="w-full px-3 py-3 text-sm bg-slate-50 text-slate-700 focus:bg-white focus:outline-none">
            </div>

            <!-- Input Password -->
            <div class="flex items-stretch border border-slate-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-[#0082CB] shadow-sm">
                <div class="bg-[#0A3370] text-white px-3.5 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input type="password" name="password" required placeholder="Password"
                    class="w-full px-3 py-3 text-sm bg-slate-50 text-slate-700 focus:bg-white focus:outline-none">
            </div>

            <!-- Tombol Login -->
            <button type="submit" 
                class="w-full bg-[#0082CB] hover:bg-[#006ab3] text-white font-bold py-3 px-4 rounded-lg text-sm transition shadow-md mt-2">
                Login
            </button>
        </form>

    </div>

</body>
</html>