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
<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-between" 
      x-data="{ 
          activeTab: localStorage.getItem('activeRiwayatTab') || 'prasurvei', 
          searchPrasurvei: '', 
          searchCa: '' 
      }"
      x-init="$watch('activeTab', val => localStorage.setItem('activeRiwayatTab', val))">
      
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
        <div class="flex space-x-3 mb-5">
            <button @click="activeTab = 'prasurvei'" 
                :class="activeTab === 'prasurvei' ? 'bg-gradient-to-r from-[#0A3370] via-[#0082CB] to-[#38BDF8] text-white shadow-lg ring-2 ring-[#0A3370]/25' : 'bg-white text-gray-700 hover:bg-sky-50/60 hover:text-[#0A3370] shadow-md'"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition border border-gray-200">
                <svg class="w-4 h-4 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Riwayat Pra-Survei AO</span>
            </button>
            <button @click="activeTab = 'surveica'" 
                :class="activeTab === 'surveica' ? 'bg-gradient-to-r from-[#0A3370] via-[#0082CB] to-[#38BDF8] text-white shadow-lg ring-2 ring-[#0A3370]/25' : 'bg-white text-gray-700 hover:bg-sky-50/60 hover:text-[#0A3370] shadow-md'"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition border border-gray-200">
                <svg class="w-4 h-4 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-6 9l2 2 4-4"/>
                </svg>
                <span>Riwayat Survei CA</span>
            </button>
        </div>

        <!-- Kotak Putih Utama -->
        <div class="bg-white rounded-xl shadow-2xl p-6 mb-8 border border-gray-200/80">
            
            <!-- ===== KONTEN TAB 1: PRA-SURVEI AO ===== -->
            <div x-show="activeTab === 'prasurvei'">
                <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-[#0A3370]">Riwayat Pengajuan Pra-Survei AO</h2>
                        <p class="text-gray-500 text-xs mt-0.5">Daftar ringkasan data nasabah tahap awal dari Account Officer.</p>
                    </div>
                    <!-- Kolom Pencarian diperlebar ke kiri (sm:w-80 atau sm:w-96) -->
                    <div class="relative w-full sm:w-80 flex items-center">
                        <input 
                            type="text" 
                            x-model="searchPrasurvei" 
                            placeholder="Cari berdasarkan No. Register / Nama Debitur" 
                            class="w-full pl-4 pr-14 py-2.5 text-xs bg-white border-2 border-gray-300 rounded-full shadow-md focus:outline-none focus:border-[#0082CB] text-gray-700 placeholder:text-gray-400"
                        >
                        <div class="absolute right-1 w-8 h-8 bg-gradient-to-r from-[#0A3370] via-[#0082CB] to-[#38BDF8] rounded-full flex items-center justify-center text-white shadow-md pointer-events-none">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto overflow-hidden border border-[#0A3370] rounded-[6px] shadow-sm">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-[#0A3370] text-white uppercase tracking-wider">
                                <th class="p-3">No</th>
                                <th class="p-3">No. Register</th>
                                <th class="p-3">Nama Nasabah</th>
                                <th class="p-3">Jenis Usaha</th>
                                <th class="p-3">Plafon Pengajuan</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 divide-y divide-gray-200">
                            @forelse($dataDebitur ?? [] as $index => $item)
                            <tr class="hover:bg-blue-50/60 transition-colors"
                                x-show="searchPrasurvei === '' || '{{ strtolower($item->no_register ?? '') }}'.includes(searchPrasurvei.toLowerCase()) || '{{ strtolower($item->nama ?? '') }}'.includes(searchPrasurvei.toLowerCase()) || '{{ strtolower($item->usaha ?? '') }}'.includes(searchPrasurvei.toLowerCase())">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3 font-semibold text-gray-800">{{ $item->no_register ?? '-' }}</td>
                                <td class="p-3 font-medium text-gray-900">{{ $item->nama ?? '-' }}</td>
                                <td class="p-3">{{ $item->usaha ?? '-' }}</td>
                                <td class="p-3 font-semibold text-emerald-700">Rp {{ number_format($item->plafon ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('riwayat.detail', $item->id) }}" class="group relative inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold text-[#0A3370] bg-blue-50/80 hover:bg-gradient-to-r hover:from-[#0A3370] hover:via-[#0082CB] hover:to-[#38BDF8] hover:text-white rounded-lg border border-blue-200/60 shadow-xs hover:shadow-md transition-all duration-300">
                                        <span class="w-5 h-5 bg-white/80 group-hover:bg-white/20 rounded-md flex items-center justify-center transition-all duration-300 group-hover:scale-105 shadow-xs">
                                            <svg class="w-3 h-3 text-[#0082CB] group-hover:text-white group-hover:rotate-45 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </span>
                                        <span>Lihat Detail</span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="p-5 text-center text-gray-500">Belum ada data riwayat pra-survei yang tersimpan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ===== KONTEN TAB 2: SURVEI CA ===== -->
            <div x-show="activeTab === 'surveica'" style="display: none;">
                <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-[#0A3370]">Riwayat Analisis Survei CA</h2>
                        <p class="text-gray-500 text-xs mt-0.5">Daftar ringkasan analisis kelayakan kredit oleh Credit Analyst.</p>
                    </div>
                    <!-- Kolom Pencarian diperlebar ke kiri (sm:w-80 atau sm:w-96) -->
                    <div class="relative w-full sm:w-80 flex items-center">
                        <input 
                            type="text" 
                            x-model="searchCa" 
                            placeholder="Cari berdasarkan No. Register / Nama Debitur" 
                            class="w-full pl-4 pr-14 py-2.5 text-xs bg-white border-2 border-gray-300 rounded-full shadow-md focus:outline-none focus:border-[#0082CB] text-gray-700 placeholder:text-gray-400"
                        >
                        <div class="absolute right-1 w-8 h-8 bg-gradient-to-r from-[#0A3370] via-[#0082CB] to-[#38BDF8] rounded-full flex items-center justify-center text-white shadow-md pointer-events-none">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto overflow-hidden border border-[#0A3370] rounded-[6px] shadow-sm">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-[#0A3370] text-white uppercase tracking-wider">
                                <th class="p-3">No</th>
                                <th class="p-3">No. Register</th>
                                <th class="p-3">Nama Nasabah</th>
                                <th class="p-3">Plafon</th>
                                <th class="p-3">Jangka Waktu</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 divide-y divide-gray-200">
                            @forelse($dataSurveiCa ?? [] as $index => $ca)
                            <tr class="hover:bg-blue-50/60 transition-colors"
                                x-show="searchCa === '' || '{{ strtolower($ca->no_register ?? '') }}'.includes(searchCa.toLowerCase()) || '{{ strtolower($ca->nama ?? '') }}'.includes(searchCa.toLowerCase())">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3 font-medium text-gray-900">{{ $ca->no_register ?? '-' }}</td>
                                <td class="p-3 font-medium text-gray-900">{{ $ca->nama ?? '-' }}</td>
                                <td class="p-3 font-semibold text-emerald-700">Rp {{ number_format($ca->plafon ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3">{{ $ca->jangka_waktu ?? '-' }}</td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('riwayat.detail2', $ca->id) }}" class="group relative inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold text-[#0A3370] bg-blue-50/80 hover:bg-gradient-to-r hover:from-[#0A3370] hover:via-[#0082CB] hover:to-[#38BDF8] hover:text-white rounded-lg border border-blue-200/60 shadow-xs hover:shadow-md transition-all duration-300">
                                        <span class="w-5 h-5 bg-white/80 group-hover:bg-white/20 rounded-md flex items-center justify-center transition-all duration-300 group-hover:scale-105 shadow-xs">
                                            <svg class="w-3 h-3 text-[#0082CB] group-hover:text-white group-hover:rotate-45 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </span>
                                        <span>Lihat Detail</span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="p-5 text-center text-gray-500">Belum ada data riwayat survei CA yang tersimpan.</td></tr>
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