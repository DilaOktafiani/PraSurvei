<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pra Survei - BPR Adipura Santosa</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-between text-xs sm:text-sm">

    <!-- HEADER -->
    <header class="no-print bg-[#0A3370] text-white shadow-md py-4 border-b-4 border-[#0082CB] sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BPR Adipura Santosa" class="h-9 w-auto bg-white p-1 rounded object-contain">
                <h1 class="text-xl font-bold tracking-wide">BPR ADIPURA SANTOSA</h1>
            </div>
            <a href="{{ route('riwayat') }}" class="inline-flex items-center justify-center gap-2 text-sm text-white font-medium px-4 py-1.5 rounded-full border-2 border-white hover:bg-white/10 transition"> 
                <span>Kembali</span> 
            </a>
        </div> 
    </header>

    <!-- KONTEN UTAMA -->
    <main class="max-w-5xl mx-auto my-8 px-4 w-full flex-grow">
        
        <!-- KOTAK UTAMA (ID print-area MEMBUNGKUS SEMUA ISI SAMPAI BAWAH) -->
        <div id="print-area" class="bg-white shadow-sm p-6 sm:p-8 border border-gray-200 rounded-none">
            
            <!-- JUDUL FORM & TOMBOL AKSI -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-4 border-b border-gray-200 gap-4">
                <!-- Judul & Tombol Edit -->
                <div class="flex flex-wrap items-center gap-3">
                    <h2 class="text-xl font-bold text-[#0A3370] tracking-wide flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#0A3370]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        FORM SURVEY
                    </h2>
                    
                    <a href="{{ route('z1-surveica', ['id' => $data->id]) }}" class="no-print inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200 px-4 py-2 rounded-lg text-xs font-semibold hover:bg-amber-100 transition shadow-sm">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Edit</span>
                    </a>
                </div>

                <!-- Tombol Cetak & Export -->
                <div class="no-print flex flex-wrap items-center justify-end gap-2.5 w-full md:w-auto">
                    <!-- Tombol Cetak -->
                    <button type="button" onclick="printRiwayat({{ $data->id }})" class="inline-flex items-center gap-2 bg-white text-gray-900 border border-gray-300 px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-50 transition shadow-sm cursor-pointer active:scale-95">
                        <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.725 14.406v2.426c0 1.096.892 1.988 1.988 1.988h6.574c1.096 0 1.988-.892 1.988-1.988v-2.426m-10.55 0h10.55m-10.55 0a2.25 2.25 0 01-2.25-2.25v-3.375c0-1.242 1.008-2.25 2.25-2.25h10.55c1.242 0 2.25 1.008 2.25 2.25v3.375a2.25 2.25 0 01-2.25 2.25m-10.55 0V6.75A2.25 2.25 0 018.975 4.5h6.05a2.25 2.25 0 012.25 2.25v5.437"/></svg>
                        <span>Cetak</span>
                    </button>

                    @if(!isset($isExport))
                    <!-- Dropdown Download/Export Dokumen (Alpine.js) -->
                    <div class="relative inline-block text-left w-full sm:w-auto" x-data="{ open: false }">
                        <button @click="open = !open" type="button" style="background-color: #0082CB; border: 1px solid #0A3370;" class="w-full sm:w-auto inline-flex items-center justify-between sm:justify-center gap-5 text-white px-5 py-2 rounded-lg text-xs font-semibold hover:opacity-95 transition shadow-sm active:scale-95">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span>Download</span>
                            </span>
                            
                            <svg class="h-3.5 w-3.5 text-sky-100 transition-transform duration-300" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                            @click.away="open = false" 
                            class="absolute left-0 sm:left-auto sm:right-0 mt-2 w-full bg-white ring-1 ring-black/5 focus:outline-none z-50 rounded-xl shadow-xl overflow-hidden divide-y divide-gray-100">
                            <div class="p-1.5 space-y-0.5">
                                <a href="{{ route('riwayat.pdf2', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-700 rounded-lg hover:bg-rose-50 hover:text-rose-700 transition-colors">
                                    <svg class="w-4 h-4 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>PDF</span>
                                </a>
                                <a href="{{ route('riwayat.word2', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>Word</span>
                                </a>
                                <a href="{{ route('riwayat.excel2', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-700 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>Excel</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- A. DATA DEBITUR -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    A. Data Debitur
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
                    
                    <!-- Nomor Register -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1"></div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Nomor Register</div>
                        <div class="p-2 sm:col-span-8 font-semibold flex items-center" style="color: #000000;">{{ $data->no_register ?? '-' }}</div>
                    </div>

                    <!-- Nama Debitur & Nama Marketing -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">1</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Nama Debitur</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 font-semibold flex items-center" style="color: #000000;">{{ $data->nama ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2 flex items-center">Nama Marketing</div>
                        <div class="p-2 sm:col-span-2 font-medium flex items-center">{{ $data->nama_marketing ?? '-' }}</div>
                    </div>

                    <!-- Tanggal OTS -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1"></div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Tanggal OTS</div>
                        <div class="p-2 sm:col-span-8 font-medium flex items-center">{{ $data->tanggal_ots ?? '-' }}</div>
                    </div>

                    <!-- Plafon & JKW -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">2</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Plafon</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 font-bold flex items-center" style="color: #000000;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2 flex items-center">JKW</div>
                        <div class="p-2 sm:col-span-2 font-medium flex items-center">{{ $data->jangka_waktu ?? '-' }}</div>
                    </div>

                    <!-- Tujuan Penggunaan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">3</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Tujuan Penggunaan</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->tujuan_penggunaan ?? '-' }}</div>
                    </div>

                    <!-- Estimasi Kewajiban -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">4</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Estimasi Kewajiban</div>
                        <div class="p-2 sm:col-span-8 font-bold flex items-center" style="color: #000000;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- Type Fasilitas -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">5</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Type Fasilitas</div>
                        <div class="p-2 sm:col-span-8 text-black font-normal flex items-center">
                            {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                        </div>
                    </div>

                    <!-- Temuan CA -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">6</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Temuan CA</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center" style="text-align: justify;">{{ $data->temuan_ca ?? '-' }}</div>
                    </div>

                </div>
            </div>

            <!-- B. AGUNAN -->
            @php
                $agunan = $data->agunan_tanah->first() ?? null;
            @endphp
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    B. Agunan
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
                    
                    <!-- Judul JAMINAN -->
                    <div class="grid grid-cols-1 border-b border-gray-300">
                        <div class="p-2 bg-gray-100 font-bold uppercase text-[#0A3370]">JAMINAN</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Kepemilikan</div>
                        <div class="p-2 sm:col-span-3 font-medium flex items-center">{{ $agunan->kepemilikan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Alamat</div>
                        <div class="p-2 sm:col-span-3 flex items-center">{{ $agunan->alamat ?? '-' }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Share Loc</div>
                        <div class="p-2 sm:col-span-3 flex items-center">
                            @if(!empty($agunan->share_location) && $agunan->share_location !== '-')
                                <a href="{{ $agunan->share_location }}" target="_blank" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-medium underline">
                                    <span>📍 Lihat Lokasi di Peta</span>
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Judul Collateral -->
                    <div class="grid grid-cols-1 border-b border-gray-300">
                        <div class="p-2 bg-gray-100 font-bold uppercase text-[#0A3370]">Collateral</div>
                    </div>

                    <!-- Header Tabel Penilaian Jaminan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 bg-gray-100 border-b border-gray-300 font-semibold">
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 flex items-center">Uraian</div>
                        <div class="p-2 sm:col-span-1 border-r border-gray-300 text-center flex items-center justify-center">Luas (m2)</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Harga</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Nilai Pasar</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Nilai Taksasi</div>
                        <div class="p-2 sm:col-span-3 text-right flex items-center justify-end">Nilai Likuidasi</div>
                    </div>

                    <!-- Baris Tanah -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-200">
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 font-medium flex items-center">Tanah</div>
                        <div class="p-2 sm:col-span-1 border-r border-gray-300 text-center flex items-center justify-center">{{ $agunan->luas_tanah ?? '-' }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($agunan->harga_tanah ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($agunan->tanah_pasar ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($agunan->tanah_taksasi ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-3 text-right flex items-center justify-end">Rp {{ number_format($agunan->tanah_likuidasi ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- Baris Bangunan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-200">
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 font-medium flex items-center">Bangunan</div>
                        <div class="p-2 sm:col-span-1 border-r border-gray-300 text-center flex items-center justify-center">{{ $agunan->luas_bangunan ?? '-' }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($agunan->harga_bangunan ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($agunan->bangunan_pasar ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($agunan->bangunan_taksasi ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-3 text-right flex items-center justify-end">Rp {{ number_format($agunan->bangunan_likuidasi ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- Baris Total -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 bg-gray-50 font-bold border-b border-gray-300">
                        <div class="p-2 sm:col-span-5 border-r border-gray-300 text-center flex items-center justify-center">Total</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format(($agunan->tanah_pasar ?? 0) + ($agunan->bangunan_pasar ?? 0), 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format(($agunan->tanah_taksasi ?? 0) + ($agunan->bangunan_taksasi ?? 0), 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-3 text-right flex items-center justify-end">Rp {{ number_format(($agunan->tanah_likuidasi ?? 0) + ($agunan->bangunan_likuidasi ?? 0), 0, ',', '.') }}</div>
                    </div>

                    <!-- Denah -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Denah</div>
                        <div class="p-2 sm:col-span-3">
                            @if(!empty($agunan->denah) && $agunan->denah !== '-')
                                <div class="inline-block border border-gray-200 rounded overflow-hidden bg-white shadow-sm p-1.5">
                                    <img src="{{ asset('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 480px; height: auto;" class="block">
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Spesifikasi Jaminan -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Spesifikasi Jaminan</div>
                        <div class="p-2 sm:col-span-3 whitespace-pre-line flex items-center" style="text-align: justify;">{{ $agunan->spesifikasi ?? '-' }}</div>
                    </div>
                    
                    <!-- Judul Informasi Harga -->
                    <div class="grid grid-cols-1 border-b border-gray-300">
                        <div class="p-2 bg-gray-100 font-bold uppercase text-[#0A3370]">Informasi Harga</div>
                    </div>

                    <!-- INFORMASI HARGA -->
                    <div class="grid grid-cols-1">
                        <div class="divide-y divide-gray-200">
                            @php
                                $infoList = [
                                    $agunan->info_harga1 ?? '-',
                                    $agunan->info_harga2 ?? '-',
                                    $agunan->info_harga3 ?? '-',
                                ];
                            @endphp

                            @foreach($infoList as $index => $info)
                                <div class="grid grid-cols-1 sm:grid-cols-10 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
                                    <div class="p-2 sm:col-span-1 bg-gray-50/50 sm:bg-transparent font-medium border-r border-gray-200 text-center flex items-center justify-center">{{ $index + 1 }}</div>
                                    <div class="p-2 sm:col-span-9 whitespace-pre-line flex items-center" style="text-align: justify;">{{ !empty(trim($info)) ? $info : '-' }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <!-- C. Analisis Jaminan -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    C. Analisis Jaminan
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->analisis_jaminan->analisis_jaminan ?? '-' }}
                </div>
            </div>

            <!-- D. Analisis SLIK -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    D. Analisis SLIK
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
                    
                    <!-- D.1 Informasi Penghasilan Utama menurut nasabah -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.1</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Informasi Penghasilan Utama menurut nasabah</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line" style="text-align: justify;">{{ $data->capacity->informasi_penghasilan_utama ?? '-' }}</div>
                    </div>

                    <!-- D.2 Informasi Penghasilan Pendukung menurut nasabah -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.2</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Informasi Penghasilan Pendukung menurut nasabah</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line" style="text-align: justify;">{{ $data->capacity->informasi_penghasilan_pendukung ?? '-' }}</div>
                    </div>

                    <!-- D.3 Pengeluaran Rumah Tangga -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.3</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Pengeluaran Rumah Tangga</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line">Rp {{ number_format($data->capacity->pengeluaran_rumah_tangga ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- D.3 Angsuran Bank Lain -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center"></div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Angsuran Bank Lain</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line">Rp {{ number_format($data->capacity->angsuran_bank_lain ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- D.3 Angsuran BPR -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center"></div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Angsuran BPR</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line">Rp {{ number_format($data->capacity->angsuran_bpr ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- D.4 Analisis Kapasitas CA -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.4</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Analisis Kapasitas CA</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line" style="text-align: justify;">{{ $data->capacity->analisis_kapasitas ?? '-' }}</div>
                    </div>

                    <!-- D.5 Kelengkapan Berkas -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.5</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Kelengkapan Berkas</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line">
                            @if(is_array($data->capacity->kelengkapan_berkas ?? null))
                                <div class="space-y-1">
                                    @foreach($data->capacity->kelengkapan_berkas as $item)
                                        <div>{{ $item }}</div>
                                    @endforeach
                                </div>
                            @else
                                {{ $data->capacity->kelengkapan_berkas ?? '-' }}
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- E. Deskripsi Usaha -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    E. Deskripsi Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->capacity->deskripsi_usaha ?? '-' }}
                </div>
            </div>

            <!-- F. Analisis Capital -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    F. Analisis Capital
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->capital->analisis_aset ?? '-' }}
                </div>
            </div>

            <!-- G. Analisis Take Over -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    G. Analisis Take Over
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->kondisi->analisis_take_over ?? '-' }}
                </div>
            </div>

            <!-- H. Analisis Kelengkapan Berkas -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    H. Analisis Kelengkapan Berkas
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}
                </div>
            </div>

            <!-- I. Analisis Badan Usaha -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    I. Analisis Badan Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->badanusaha->analisa_badan_usaha ?? '-' }}
                </div>
            </div>

            <!-- J. Analisis SWOT -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    J. Analisis SWOT
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
                    
                    <!-- J.1 Strengths (Kekuatan) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.1</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Strengths (Kekuatan)</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line" style="text-align: justify;">{{ $data->swot->kekuatan ?? '-' }}</div>
                    </div>

                    <!-- J.2 Weaknesses (Kelemahan) dan Mitigasi -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.2</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Weaknesses (Kelemahan) dan Mitigasi</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line" style="text-align: justify;">{{ $data->swot->kelemahan ?? '-' }}</div>
                    </div>

                    <!-- J.3 Opportunities (Peluang) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.3</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Opportunities (Peluang)</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line" style="text-align: justify;">{{ $data->swot->peluang ?? '-' }}</div>
                    </div>

                    <!-- J.4 Threats (Ancaman) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.4</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Threats (Ancaman)</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center whitespace-pre-line" style="text-align: justify;">{{ $data->swot->ancaman ?? '-' }}</div>
                    </div>

                    <!-- Kesimpulan -->
<div class="grid grid-cols-1">
    <div class="p-2 bg-gray-100 font-bold uppercase text-[#0A3370] border-b border-gray-300" style="padding-left: 16px; padding-right: 16px;">Kesimpulan</div>
    <div class="p-2 font-normal whitespace-pre-line" style="padding-left: 16px; padding-right: 16px; text-align: justify;">{{ $data->swot->kesimpulan ?? '-' }}</div>
</div>

                </div>
            </div>

            <!-- K. Rekomendasi -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    K. Rekomendasi
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->swot->rekomendasi ?? '-' }}
                </div>
            </div>

            <!-- L. Syarat dan Catatan Lainnya -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    L. Syarat dan Catatan Lainnya
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line text-xs" style="text-align: justify;">
                    {{ $data->swot->syarat_catatan ?? '-' }}
                </div>
            </div>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="text-center text-xs text-gray-500 py-6">
        &copy; 2026 BPR Adipura Santosa | Surakarta.
    </footer>

<!-- Iframe tersembunyi untuk mengambil tampilan riwayat-print -->
<iframe id="iframe-print" style="display: none;"></iframe>

<script>
function printRiwayat(id) {
    // Menyesuaikan URL dengan route baru: /riwayat/detail2/{id}/print2
    var urlPrint = "{{ url('/riwayat/detail2') }}/" + id + "/print2";
    
    var iframe = document.getElementById('iframe-print');
    iframe.src = urlPrint;
    
    iframe.onload = function() {
        iframe.contentWindow.print();
    };
}
</script>
</body>
</html>