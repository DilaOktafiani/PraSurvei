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
            <div class="flex items-center gap-3">
                <a href="{{ route('riwayat') }}" class="inline-flex items-center justify-center gap-2 text-sm text-white font-medium px-4 py-1.5 rounded-full border-2 border-white hover:bg-white/10 transition"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    <span>Kembali</span> 
                </a>
                <a href="/" class="inline-flex items-center justify-center gap-2 text-sm text-white font-medium px-4 py-1.5 rounded-full border-2 border-white hover:bg-white/10 transition"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"> 
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /> 
                    </svg> 
                    <span>Beranda</span> 
                </a> 
            </div>
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
                        FORM PRA-SURVEI
                    </h2>
                    
                    <a href="{{ route('1pra-survei', ['id' => $data->id]) }}" class="no-print inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200 px-4 py-2 rounded-lg text-xs font-semibold hover:bg-amber-100 transition shadow-sm">
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
                                <a href="{{ route('riwayat.pdf', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-700 rounded-lg hover:bg-rose-50 hover:text-rose-700 transition-colors">
                                    <svg class="w-4 h-4 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>PDF</span>
                                </a>
                                <a href="{{ route('riwayat.word', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>Word</span>
                                </a>
                                <a href="{{ route('riwayat.excel', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-700 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
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
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    A. Data Debitur
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
                    
                    <!-- Nomor Register & Nama Marketing -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center"></div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Nomor Register</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 font-medium flex items-center">{{ $data->no_register ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2 flex items-center">Nama Marketing</div>
                        <div class="p-2 sm:col-span-2 font-medium flex items-center">{{ $data->nama_marketing ?? '-' }}</div>
                    </div>

                    <!-- 1. Nama Debitur & Nama Pasangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">1</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Nama Debitur</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 font-medium flex items-center">{{ $data->nama ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2 flex items-center">Nama Pasangan</div>
                        <div class="p-2 sm:col-span-2 font-medium flex items-center">{{ $data->nama_pasangan ?? '-' }}</div>
                    </div>

                    <!-- Usia & Usia Pasangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center"></div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Usia</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 flex items-center">{{ $data->usia ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2 flex items-center">Usia Pasangan</div>
                        <div class="p-2 sm:col-span-2 flex items-center">{{ $data->usia_pasangan ?? '-' }}</div>
                    </div>

                    <!-- 2. Usaha & Lama Usaha -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">2</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Usaha</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 flex items-center">{{ $data->usaha ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2 flex items-center">Lama Usaha</div>
                        <div class="p-2 sm:col-span-2 flex items-center">{{ $data->lama_usaha ?? '-' }}</div>
                    </div>
                    
                    <!-- 3. Alamat Debitur -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">3</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Alamat Debitur</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->alamat_ktp ?? '-' }}</div>
                    </div>

                    <!-- Alamat Domisili -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center"></div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Alamat Domisili</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->alamat_domisili ?? '-' }}</div>
                    </div>

                    <!-- 4. Plafon & JKW -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">4</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Plafon</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 font-bold text-black flex items-center">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2 flex items-center">JKW</div>
                        <div class="p-2 sm:col-span-2 flex items-center">{{ $data->jangka_waktu ?? '-' }}</div>
                    </div>
                    
                    <!-- 5. Tujuan Penggunaan, Angsuran & Type Fasilitas -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">5</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Tujuan Penggunaan</div>
                        <div class="p-2 border-r border-gray-300 sm:col-span-4 whitespace-pre-line flex items-center">{{ $data->tujuan_penggunaan ?? '-' }}</div>
                        
                        <div class="sm:col-span-4 flex flex-col">
                            <div class="grid grid-cols-2 border-b border-gray-300">
                                <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Angsuran</div>
                                <div class="p-2 font-bold text-black flex items-center">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Type Fasilitas</div>
                                <div class="p-2 text-black font-normal flex items-center">{{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- B. DATA JAMINAN -->
            @php
                $agunan = $data->agunan_tanah->first() ?? null;
            @endphp
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    B. Data Jaminan
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
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

                    <!-- Header Tabel Penilaian Jaminan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 bg-gray-100 border-b border-gray-300 font-semibold">
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-center">Uraian</div>
                        <div class="p-2 sm:col-span-1 border-r border-gray-300 text-center">Luas (m2)</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-center">Harga</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-center">Nilai Pasar</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-center">Nilai Taksasi</div>
                        <div class="p-2 sm:col-span-3 text-center">Nilai Likuidasi</div>
                    </div>

                    <!-- Baris Tanah -->
                    @php
                        $luasTanah = $agunan->luas_tanah ?? 0;
                        $hargaTanah = $agunan->harga_tanah ?? 0;
                        $tanahPasar = $luasTanah * $hargaTanah;
                        $tanahTaksasi = $tanahPasar * 0.70;
                        $tanahLikuidasi = $tanahPasar * 0.50;
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-200">
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 font-medium flex items-center">Tanah</div>
                        <div class="p-2 sm:col-span-1 border-r border-gray-300 text-center flex items-center justify-center">{{ $agunan->luas_tanah ?? '-' }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-3 text-right flex items-center justify-end">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</div>
                    </div>

                    <!-- Baris Bangunan -->
                    @php
                        $luasBangunan = $agunan->luas_bangunan ?? 0;
                        $hargaBangunan = $agunan->harga_bangunan ?? 0;
                        $bangunanPasar = $luasBangunan * $hargaBangunan;
                        $bangunanTaksasi = $bangunanPasar * 0.70;
                        $bangunanLikuidasi = $bangunanPasar * 0.50;
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-200">
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 font-medium flex items-center">Bangunan</div>
                        <div class="p-2 sm:col-span-1 border-r border-gray-300 text-center flex items-center justify-center">{{ $agunan->luas_bangunan ?? '-' }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-3 text-right flex items-center justify-end">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</div>
                    </div>

                    <!-- Baris Total -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 bg-gray-50 font-bold border-b border-gray-300">
                        <div class="p-2 sm:col-span-5 border-r border-gray-300 text-center flex items-center justify-center">Total</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-2 border-r border-gray-300 text-right flex items-center justify-end">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</div>
                        <div class="p-2 sm:col-span-3 text-right flex items-center justify-end">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Spesifikasi Jaminan</div>
                        <div class="p-2 sm:col-span-3 whitespace-pre-line flex items-center" style="text-align: justify;">{{ $agunan->spesifikasi ?? '-' }}</div>
                    </div>
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
                    
                    <!-- INFORMASI HARGA -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 sm:col-span-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-start">Informasi Harga</div>
                        <div class="sm:col-span-10 divide-y divide-gray-200">
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

            <!-- C. SLIK -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    C. SLIK
                </div>
                <div class="border border-[#0A3370] rounded-none overflow-x-auto text-xs">
                    <table class="w-full text-left border-collapse table-fixed">
                        <colgroup>
                            <col style="width: 16.666%;">
                            <col style="width: 13.888%;">
                            <col style="width: 13.888%;">
                            <col style="width: 8.333%;">
                            <col style="width: 13.888%;">
                            <col style="width: 8.333%;">
                            <col style="width: 25%;">
                        </colgroup>
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-300 font-semibold">
                                <th class="p-2 border-r border-gray-300 text-center">Nama Bank</th>
                                <th class="p-2 border-r border-gray-300 text-center">Plafon</th>
                                <th class="p-2 border-r border-gray-300 text-center">Outstanding</th>
                                <th class="p-2 border-r border-gray-300 text-center">KOL</th>
                                <th class="p-2 border-r border-gray-300 text-center">Angsuran</th>
                                <th class="p-2 border-r border-gray-300 text-center">JKW</th>
                                <th class="p-2 text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data->pinjaman ?? [] as $slik)
                            <tr class="border-b border-gray-200">
                                <td class="p-2 border-r border-gray-300 text-center font-normal">{{ $slik->nama_ljk ?? '-' }}</td>
                                <td class="p-2 border-r border-gray-300 text-right font-normal">Rp {{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-right font-normal">Rp {{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-center font-normal text-black">{{ $slik->kolekbilitas ?? '-' }}</td>
                                <td class="p-2 border-r border-gray-300 text-right font-normal">Rp {{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-center font-normal">{{ $slik->jkw ?? '-' }}</td>
                                <td class="p-2 text-center font-normal" style="text-align: justify;">{{ $slik->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="p-3 text-center text-gray-500 font-normal">Tidak ada data SLIK.</td></tr>
                            @endforelse
                            
                            <!-- BARIS TOTAL -->
                            <tr class="bg-gray-50 font-bold">
                                <td class="p-2 border-r border-gray-300 text-center">Total</td>
                                <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-center">-</td>
                                <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-center">-</td>
                                <td class="p-2 text-center">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- D. INFORMASI USAHA -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    D. Informasi Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        
                        <!-- Bagian Kiri: Tabel Keuangan (Mengambil 7 kolom) -->
                        <div class="sm:col-span-7 border-r border-gray-300 divide-y divide-gray-200">
                            
                            <!-- 1. Omset Usaha -->
                            <div class="grid grid-cols-12 p-2 items-center">
                                <div class="col-span-1 font-medium">1.</div>
                                <div class="col-span-6 font-medium">Omset Usaha</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->omset_usaha ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- 2. Biaya Operasional -->
                            <div class="grid grid-cols-12 p-2 items-center">
                                <div class="col-span-1 font-medium">2.</div>
                                <div class="col-span-6 font-medium">Biaya Operasional</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->biaya_operasional ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Penghasilan Kotor (Omset - Biaya Operasional) -->
                            @php
                                $penghasilanKotor = ($data->infousaha->omset_usaha ?? 0) - ($data->infousaha->biaya_operasional ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-2 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Penghasilan Kotor</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-right">{{ number_format($penghasilanKotor, 0, ',', '.') }}</div>
                            </div>

                            <!-- 3. Penghasilan Tambahan -->
                            <div class="grid grid-cols-12 p-2 items-center">
                                <div class="col-span-1 font-medium">3.</div>
                                <div class="col-span-6 font-medium">Penghasilan Tambahan</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->penghasilan_tambahan ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Total Pendapatan (Penghasilan Kotor + Penghasilan Tambahan) -->
                            @php
                                $totalPendapatan = $penghasilanKotor + ($data->infousaha->penghasilan_tambahan ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-2 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Total Pendapatan</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-right">{{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                            </div>

                            <!-- 4. Pengeluaran Rumah Tangga -->
                            <div class="grid grid-cols-12 p-2 items-center">
                                <div class="col-span-1 font-medium">4.</div>
                                <div class="col-span-6 font-medium">Pengeluaran Rumah Tangga</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->pengeluaran_rumah_tangga ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Penghasilan Bersih (Total Pendapatan - Pengeluaran Rumah Tangga) -->
                            @php
                                $penghasilanBersih = $totalPendapatan - ($data->infousaha->pengeluaran_rumah_tangga ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-2 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Penghasilan Bersih</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-black text-right">{{ number_format($penghasilanBersih, 0, ',', '.') }}</div>
                            </div>

                            <!-- 5. Angsuran Bank Lain -->
                            <div class="grid grid-cols-12 p-2 items-center">
                                <div class="col-span-1 font-medium">5.</div>
                                <div class="col-span-6 font-medium">Angsuran Bank Lain</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->angsuran_bank_lain ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Sisa Penghasilan (Penghasilan Bersih - Angsuran Bank Lain) -->
                            @php
                                $sisaPenghasilan = $penghasilanBersih - ($data->infousaha->angsuran_bank_lain ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-2 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Sisa Penghasilan</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-right">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</div>
                            </div>

                            <!-- 6. Angsuran BPR -->
                            <div class="grid grid-cols-12 p-2 items-center">
                                <div class="col-span-1 font-medium">6.</div>
                                <div class="col-span-6 font-medium">Angsuran BPR</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->angsuran_bpr ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Sisa Penghasilan Bersih (Sisa Penghasilan - Angsuran BPR) -->
                            @php
                                $sisaPenghasilanBersih = $sisaPenghasilan - ($data->infousaha->angsuran_bpr ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-2 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Sisa Penghasilan Bersih</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-black text-right">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</div>
                            </div>

                        </div>

                        <!-- Bagian Kanan: Deskripsi Usaha (Mengambil 5 kolom sisa) -->
                        <div class="sm:col-span-5 p-2 bg-white flex flex-col">
                            <span class="font-bold text-gray-800 mb-1">Deskripsi Usaha :</span>
                            <div class="flex-grow p-1 text-gray-700 whitespace-pre-line text-justify">
                                {{ $data->infousaha->deskripsi_usaha ?? '-' }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- E. LEGALITAS -->
            @forelse($data->agunan_tanah ?? [] as $tanah)
                <div class="mb-6">
                    <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                        E. Legalitas
                    </div>
                    <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                        {{ $tanah->kepemilikan ?? '-' }}
                    </div>
                </div>
            @empty
                <div class="mb-6">
                    <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                        E. Legalitas
                    </div>
                    <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                        -
                    </div>
                </div>
            @endforelse

            <!-- F. CAPITAL / ASET YANG DIMILIKI -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    F. Capital / Aset Yang Dimiliki
                </div>
                <div class="border border-[#0A3370] rounded-none text-xs">
                    @php 
                        $capital = $data->capital;
                        $asets = [
                            $capital->aset1 ?? '-',
                            $capital->aset2 ?? '-',
                            $capital->aset3 ?? '-',
                            $capital->aset4 ?? '-',
                            $capital->aset5 ?? '-',
                        ];
                    @endphp

                    @foreach($asets as $index => $aset)
                    <div class="grid grid-cols-1 sm:grid-cols-4 {{ !$loop->last ? 'border-b border-gray-300' : '' }}">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">ASET {{ $index + 1 }}</div>
                        <div class="p-2 sm:col-span-3 whitespace-pre-line flex items-center" style="text-align: justify;">{{ !empty(trim($aset)) ? $aset : '-' }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- G. KELENGKAPAN BERKAS TAKE OVER -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    G. Kelengkapan Berkas Take Over
                </div>
                <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                    @php $val = $data->kondisi->berkas_take_over ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- H. KELENGKAPAN DATA KTP -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    H. Kelengkapan Data KTP
                </div>
                <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                    @php $val = $data->datalengkap->ktp ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- I. KELENGKAPAN DATA SLIK -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    I. Kelengkapan Data SLIK
                </div>
                <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                    @php 
                        $val = $data->datalengkap->slik ?? null; 
                        
                        // Handle jika data tersimpan sebagai string JSON
                        if (is_string($val)) {
                            $decoded = json_decode($val, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                $val = $decoded;
                            }
                        }
                    @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- J. KELENGKAPAN DATA KARTU KELUARGA -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    J. Kelengkapan Data Kartu Keluarga
                </div>
                <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                    @php $val = $data->datalengkap->kk ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- K. KELENGKAPAN DATA SURAT NIKAH -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    K. Kelengkapan Data Surat Nikah
                </div>
                <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                    @php $val = $data->datalengkap->surat_nikah ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- L. KELENGKAPAN DATA BADAN USAHA -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-xs uppercase rounded-none">
                    L. Kelengkapan Data Badan Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none p-2 bg-white whitespace-pre-line text-xs flex items-center" style="text-align: justify;">
                    @php $val = $data->badanusaha->berkas_badan_usaha ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
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
    // Sesuaikan URL route print kamu di sini
    var urlPrint = "{{ url('/riwayat/detail') }}/" + id + "/print";
    
    var iframe = document.getElementById('iframe-print');
    iframe.src = urlPrint;
    
    // Begitu desain dari riwayat-print selesai dimuat di latar belakang, langsung print
    iframe.onload = function() {
        iframe.contentWindow.print();
    };
}
</script>
</body>
</html>