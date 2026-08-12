<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BPR Adipura Santosa - Sistem Informasi Pra-Survei dan Survei</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar -->
    <header class="bg-[#0A3370] text-white shadow-md py-4 border-b-4 border-[#0082CB] sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            
            <!-- Logo & Title Container -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BPR Adipura Santosa" class="h-9 w-auto bg-white p-1 rounded object-contain">
                <h1 class="text-xl font-bold tracking-wide">BPR ADIPURA SANTOSA</h1>
            </div>

        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto mt-8 px-4 w-full flex-grow">
        
        <!-- Welcome Message -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8 text-center md:text-left">
            <h2 class="text-2xl font-bold text-[#0A3370]">Selamat Datang di Sistem Survei Marketing</h2>
            <p class="text-gray-600 mt-2 text-sm md:text-base">Silakan pilih menu formulir di bawah ini untuk memulai input data atau mengecek riwayat pengajuan.</p>
        </div>

        <!-- 🔳 SECTION TOMBOL UTAMA (3 KARTU SEJAJAR) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Tombol 1: Pra-Survei -->
            <div class="bg-white border-t-4 border-[#0082CB] rounded-lg shadow-sm border-x border-b border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Pra-Survei AO</h3>
                    <p class="text-gray-500 text-sm mt-2">Input data awal dan pengecekan komitmen calon nasabah langsung dari lokasi kunjungan.</p>
                </div>
                <a href="/1pra-survei" class="block text-center bg-[#0082CB] text-white font-semibold py-2.5 rounded-lg hover:bg-[#006FB0] transition shadow-sm text-sm">
                    Isi Formulir Pra-Survei
                </a>
            </div>

            <!-- Tombol 2: Survei CA -->
            <div class="bg-white border-t-4 border-[#0A3370] rounded-lg shadow-sm border-x border-b border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Survei CA</h3>
                    <p class="text-gray-500 text-sm mt-2">Analisis kelayakan kredit mendalam dan verifikasi data lanjutan oleh Credit Analyst.</p>
                </div>
                <a href="/survei-ca" class="block text-center bg-[#0A3370] text-white font-semibold py-2.5 rounded-lg hover:bg-[#062452] transition shadow-sm text-sm">
                    Isi Formulir Survei
                </a>
            </div>

            <!-- Tombol 3: Riwayat Pengajuan -->
            <div class="bg-white border-t-4 border-[#0A3370] rounded-lg shadow-sm border-x border-b border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Riwayat Pengajuan</h3>
                    <p class="text-gray-500 text-sm mt-2">Cek riwayat lengkap pengiriman data untuk formulir pra-survei dan survei Anda.</p>
                </div>
                <a href="/riwayat" class="block text-center bg-transparent text-[#0A3370] border-2 border-[#0A3370] font-semibold py-2.5 rounded-lg hover:bg-[#0A3370] hover:text-white transition shadow-sm text-sm">
                    Lihat Riwayat
                </a>
            </div>

        </div>

    </main>

    <footer class="text-center text-xs text-gray-500 mt-16 pb-8">
        &copy; 2026 BPR Adipura Santosa | Surakarta.
    </footer>

</body>
</html>