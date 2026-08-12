<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan - BPR Adipura Santosa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk interaksi Tab & Search -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-between" x-data="{ activeTab: 'prasurvei', searchPrasurvei: '', searchCa: '' }">

    <!-- HEADER -->
    <header class="bg-[#0A3370] text-white shadow-md py-4 border-b-4 border-[#0082CB] sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BPR Adipura Santosa" class="h-9 w-auto bg-white p-1 rounded object-contain">
                <h1 class="text-xl font-bold tracking-wide">BPR ADIPURA SANTOSA</h1>
            </div>
            <a href="/" class="inline-flex items-center justify-center gap-2 text-sm text-white font-medium px-4 py-1.5 rounded-full border-2 border-white hover:bg-white/10 transition"> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"> 
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /> 
                </svg> 
                <span>Beranda</span> 
            </a>
        </div> 
    </header>

    <!-- Konten Utama -->
    <main class="max-w-6xl mx-auto mt-8 px-4 w-full flex-grow">
        
        <!-- Tab Navigasi di Atas -->
        <div class="flex space-x-2 mb-4 border-b border-gray-300 pb-2">
            <button @click="activeTab = 'prasurvei'" 
                :class="activeTab === 'prasurvei' ? 'bg-[#0A3370] text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-100'"
                class="px-5 py-2.5 rounded-lg text-sm font-semibold transition border border-gray-200">
                Riwayat Pra-Survei AO
            </button>
            <button @click="activeTab = 'surveica'" 
                :class="activeTab === 'surveica' ? 'bg-[#0A3370] text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-100'"
                class="px-5 py-2.5 rounded-lg text-sm font-semibold transition border border-gray-200">
                Riwayat Survei CA
            </button>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            
            <!-- ===== KONTEN TAB 1: PRA-SURVEI AO ===== -->
            <div x-show="activeTab === 'prasurvei'">
                <!-- Judul & Tombol Export Pra-Survei -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-[#0A3370]">Riwayat Pengajuan Pra-Survei AO</h2>
                        <p class="text-gray-500 text-sm mt-1">Daftar ringkasan data nasabah tahap awal dari Account Officer.</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('riwayat.excel') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 transition shadow-sm">Export Excel</a>
                        <a href="{{ route('riwayat.pdf') }}" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700 transition shadow-sm">Export PDF</a>
                        <a href="{{ route('riwayat.word') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">Export Word</a>
                    </div>
                </div>

                <!-- Kolom Search User-Friendly -->
                <div class="mb-4 relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </span>
                    <input type="text" x-model="searchPrasurvei" placeholder="Cari berdasarkan No. Register, Nama Nasabah, atau Jenis Usaha" class="w-full pl-10 pr-4 py-2 text-sm bg-gray-50 border-2 border-[#0A3370] rounded-lg focus:ring-2 focus:ring-[#0082CB] focus:border-[#0082CB] outline-none transition">
                </div>

                <!-- Tabel Pra-Survei Disamakan & User-Friendly -->
                <div class="overflow-x-auto border-2 border-[#0A3370] rounded-lg shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#0A3370] text-white border-b border-[#0A3370] text-xs uppercase tracking-wider">
                                <th class="p-3.5">No</th>
                                <th class="p-3.5">No. Register</th>
                                <th class="p-3.5">Nama Nasabah</th>
                                <th class="p-3.5">Jenis Usaha</th>
                                <th class="p-3.5">Plafon Pengajuan</th>
                                <th class="p-3.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                            @forelse($dataDebitur ?? [] as $index => $item)
                            <tr class="hover:bg-blue-50/60 transition-colors">
                                <td class="p-3.5">{{ $loop->iteration }}</td>
                                <td class="p-3.5 font-semibold text-gray-800">{{ $item->no_register ?? '-' }}</td>
                                <td class="p-3.5 font-medium text-gray-900">{{ $item->nama ?? '-' }}</td>
                                <td class="p-3.5">{{ $item->usaha ?? '-' }}</td>
                                <td class="p-3.5 font-semibold text-emerald-700">Rp {{ number_format($item->plafon ?? 0, 0, ',', '.') }}</td>
                                
                                <!-- Tombol Aksi Detail Lengkap -->
                                <td class="p-3.5 text-center">
                                    <a href="{{ route('riwayat.detail', $item->id) }}" class="inline-block text-blue-700 hover:bg-[#0A3370] hover:text-white font-medium text-xs bg-blue-50 px-3.5 py-1.5 rounded-lg border border-blue-200 transition shadow-sm">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-gray-500 text-sm">
                                    Belum ada data riwayat pra-survei yang tersimpan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ===== KONTEN TAB 2: SURVEI CA ===== -->
            <div x-show="activeTab === 'surveica'" style="display: none;">
                <!-- Judul & Tombol Export Survei CA -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-[#0A3370]">Riwayat Analisis Survei CA</h2>
                        <p class="text-gray-500 text-sm mt-1">Daftar ringkasan analisis kelayakan kredit oleh Credit Analyst.</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 transition shadow-sm">Export Excel</a>
                        <a href="#" class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700 transition shadow-sm">Export PDF</a>
                        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">Export Word</a>
                    </div>
                </div>

                <!-- Kolom Search User-Friendly -->
                <div class="mb-4 relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </span>
                    <input type="text" x-model="searchCa" placeholder="Cari berdasarkan Nama Nasabah atau Analis (CA)..." class="w-full pl-10 pr-4 py-2 text-sm bg-gray-50 border-2 border-[#0A3370] rounded-lg focus:ring-2 focus:ring-[#0082CB] focus:border-[#0082CB] outline-none transition">
                </div>

                <!-- Tabel Survei CA Disamakan & User-Friendly -->
                <div class="overflow-x-auto border-2 border-[#0A3370] rounded-lg shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#0A3370] text-white border-b border-[#0A3370] text-xs uppercase tracking-wider">
                                <th class="p-3.5">No</th>
                                <th class="p-3.5">Nama Nasabah</th>
                                <th class="p-3.5">Analis (CA)</th>
                                <th class="p-3.5">Rekomendasi Plafon</th>
                                <th class="p-3.5">Status Analisis</th>
                                <th class="p-3.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                            @forelse($dataSurveiCa ?? [] as $index => $ca)
                            <tr class="hover:bg-blue-50/60 transition-colors">
                                <td class="p-3.5">{{ $loop->iteration }}</td>
                                <td class="p-3.5 font-medium text-gray-900">{{ $ca->nama ?? '-' }}</td>
                                <td class="p-3.5">{{ $ca->nama_ca ?? '-' }}</td>
                                <td class="p-3.5 font-semibold text-emerald-700">Rp {{ number_format($ca->rekomendasi_plafon ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3.5"><span class="bg-yellow-100 text-yellow-800 text-xs px-2.5 py-1 rounded-full font-medium">Pending</span></td>
                                <td class="p-3.5 text-center">
                                    <a href="#" class="inline-block text-blue-700 hover:bg-[#0A3370] hover:text-white font-medium text-xs bg-blue-50 px-3.5 py-1.5 rounded-lg border border-blue-200 transition shadow-sm">Detail CA</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-gray-500 text-sm">
                                    Belum ada data riwayat survei CA yang tersimpan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-xs text-gray-500 py-6">
        &copy; 2026 BPR Adipura Santosa | Surakarta.
    </footer>

</body>
</html>