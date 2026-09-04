<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BPR Adipura Santosa - Sistem Informasi Pra-Survei dan Survei</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom 3D Card Shadow Effect */
        .card-3d {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .card-3d:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -10px rgba(10, 51, 112, 0.15), 0 10px 15px -5px rgba(10, 51, 112, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <!-- Floating Financial & Analytics Watermark Elements (Hanya di Sisi Kanan & Kiri) -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0 opacity-20 blur-[1px]">
        
        <!-- SISI KIRI -->
        <svg class="absolute top-24 left-8 w-8 h-8 text-[#0A3370]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
        
        <svg class="absolute top-64 left-12 w-8 h-8 text-[#0082CB]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        
        <svg class="absolute bottom-32 left-10 w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>

        <svg class="absolute bottom-10 left-16 w-8 h-8 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>

        <!-- SISI KANAN -->
        <svg class="absolute top-24 right-10 w-8 h-8 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        
        <svg class="absolute top-64 right-12 w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
        
        <svg class="absolute bottom-32 right-8 w-8 h-8 text-[#0A3370]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z"/></svg>

        <svg class="absolute bottom-10 right-14 w-8 h-8 text-[#0082CB]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>

    </div>

    <!-- Header / Navbar -->
    <header class="bg-[#0A3370] text-white shadow-lg py-4 border-b-4 border-[#0082CB] sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center relative z-10">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BPR Adipura Santosa" class="h-9 w-auto bg-white p-1 rounded object-contain">
                <h1 class="text-xl font-bold tracking-wide">BPR ADIPURA SANTOSA</h1>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto mt-8 px-4 w-full flex-grow relative z-10">
        
        <!-- Welcome Message -->
        <div class="bg-white rounded-xl card-3d p-6 mb-8 text-center md:text-left border border-gray-100">
            <h2 class="text-2xl font-bold text-[#0A3370]">Selamat Datang di Sistem Survei Marketing</h2>
            <p class="text-gray-600 mt-2 text-sm md:text-base">Silakan pilih menu formulir di bawah ini untuk memulai input data atau mengecek riwayat pengajuan.</p>
        </div>

        <!-- 🔳 SECTION TOMBOL UTAMA (3 KARTU SEJAJAR) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Tombol 1: Pra-Survei -->
            <div class="bg-white border-t-4 border-[#0082CB] rounded-xl card-3d border-x border-b border-gray-100 p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2.5 bg-sky-50 text-sky-600 rounded-lg shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Pra-Survei AO</h3>
                    </div>
                    <p class="text-gray-500 text-sm mb-6">Input data awal dan pengecekan komitmen calon nasabah langsung dari lokasi kunjungan.</p>
                </div>
                <a href="{{ route('1pra-survei', ['new' => 'true']) }}" class="block text-center bg-[#0082CB] text-white font-semibold py-2.5 rounded-lg hover:bg-[#006FB0] transition shadow-md text-sm">
                    Isi Formulir Pra-Survei
                </a>
            </div>

            <!-- Tombol 2: Survei CA -->
            <div class="bg-white border-t-4 border-[#0A3370] rounded-xl card-3d border-x border-b border-gray-100 p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2.5 bg-amber-50 text-amber-600 rounded-lg shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Survei CA</h3>
                    </div>
                    <p class="text-gray-500 text-sm mb-6">Analisis kelayakan kredit mendalam dan verifikasi data lanjutan oleh Credit Analyst.</p>
                </div>
                <a href="{{ route('z1-surveica', ['new' => 'true']) }}" class="block text-center bg-[#0A3370] text-white font-semibold py-2.5 rounded-lg hover:bg-[#062452] transition shadow-md text-sm">
    Isi Formulir Survei
</a>
            </div>

            <!-- Tombol 3: Riwayat Pengajuan -->
            <div class="bg-white border-t-4 border-[#0A3370] rounded-xl card-3d border-x border-b border-gray-100 p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-lg shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Riwayat Pengajuan</h3>
                    </div>
                    <p class="text-gray-500 text-sm mb-6">Cek riwayat lengkap pengiriman data untuk formulir pra-survei dan survei Anda.</p>
                </div>
                <a href="/riwayat" class="block text-center bg-transparent text-[#0A3370] border-2 border-[#0A3370] font-semibold py-2.5 rounded-lg hover:bg-[#0A3370] hover:text-white transition shadow-sm text-sm">
                    Lihat Riwayat
                </a>
            </div>

        </div>

    </main>

    <footer class="text-center text-xs text-gray-500 mt-16 pb-8 relative z-10">
        &copy; 2026 BPR Adipura Santosa | Surakarta.
    </footer>

</body>
</html>