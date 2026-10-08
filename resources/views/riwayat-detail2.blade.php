<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Survei - BPR Adipura Santosa</title>

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
                    <h2 class="text-2xl font-bold text-[#0A3370] tracking-wide">
                        ANALISA KREDIT
                    </h2>
                    
                    <a href="{{ route('z1-muk', ['id' => $data->id]) }}" class="no-print inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200 px-4 py-2 rounded-lg text-base font-semibold hover:bg-amber-100 transition shadow-sm">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Edit</span>
                    </a>
                </div>

                <!-- Tombol Cetak & Export -->
                <div class="no-print flex flex-wrap items-center justify-end gap-2.5 w-full md:w-auto">
                    <!-- Tombol Cetak -->
                    <button type="button" onclick="printRiwayat({{ $data->id }})" class="inline-flex items-center gap-2 bg-white text-gray-900 border border-gray-300 px-4 py-2 rounded-lg text-base font-bold hover:bg-gray-50 transition shadow-sm cursor-pointer active:scale-95">
                        <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.725 14.406v2.426c0 1.096.892 1.988 1.988 1.988h6.574c1.096 0 1.988-.892 1.988-1.988v-2.426m-10.55 0h10.55m-10.55 0a2.25 2.25 0 01-2.25-2.25v-3.375c0-1.242 1.008-2.25 2.25-2.25h10.55c1.242 0 2.25 1.008 2.25 2.25v3.375a2.25 2.25 0 01-2.25 2.25m-10.55 0V6.75A2.25 2.25 0 018.975 4.5h6.05a2.25 2.25 0 012.25 2.25v5.437"/></svg>
                        <span>Cetak</span>
                    </button>

                    @if(!isset($isExport))
                    <!-- Dropdown Download/Export Dokumen (Alpine.js) -->
                    <div class="relative inline-block text-left w-full sm:w-auto" x-data="{ open: false }">
                        <button @click="open = !open" type="button" style="background-color: #0082CB; border: 1px solid #0A3370;" class="w-full sm:w-auto inline-flex items-center justify-between sm:justify-center gap-5 text-white px-5 py-2 rounded-lg text-base font-semibold hover:opacity-95 transition shadow-sm active:scale-95">
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
                                <a href="{{ route('riwayat.pdf2', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-base font-semibold text-gray-700 rounded-lg hover:bg-rose-50 hover:text-rose-700 transition-colors">
                                    <svg class="w-4 h-4 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>PDF</span>
                                </a>
                                <a href="{{ route('riwayat.word2', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-base font-semibold text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>Word</span>
                                </a>
                                <a href="{{ route('riwayat.excel2', $data->id) }}" class="group flex items-center gap-2.5 px-3 py-2 text-base font-semibold text-gray-700 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>Excel</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Judul Analisa Kredit
            <div class="text-center mb-6">
                <h2 class="text-[#0A3370] font-bold text-xl uppercase tracking-wider">
                    ANALISA KREDIT
                </h2>
            </div> -->

            <!-- A. DATA DEBITUR -->
            <div class="mb-6">
                <div class="text-[#0A3370] px-3.5 py-2 font-bold text-base uppercase rounded-none">
                    A. DATA DEBITUR
                </div>
                <div class="rounded-none text-sm">
                    
                    <!-- Nama Debitur -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">1</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Nama Debitur</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-semibold flex items-center" style="color: #000000;">{{ $data->nama ?? '-' }}</div>
                    </div>

                    <!-- Tempat / Tanggal Lahir -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">2</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Tempat / Tgl Lahir</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->tempat_tanggal_lahir ?? '-' }}</div>
                    </div>

                    <!-- Nama Ibu Kandung -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1 flex items-center justify-center">3</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Nama Ibu Kandung</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->nama_ibu_kandung ?? '-' }}</div>
                    </div>

                    <!-- Nama Istri / penjamin -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">4</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Nama Istri / penjamin</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center" style="color: #000000;">{{ $data->nama_istri_penjamin ?? '-' }}</div>
                    </div>

                    <!-- Alamat KTP -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">5</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Alamat KTP</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->alamat_ktp ?? '-' }}</div>
                    </div>

                    <!-- Alamat Domisili -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1 flex items-center justify-center">6</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Alamat Domisili</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->alamat_domisili ?? '-' }}</div>
                    </div>

                    <!-- Telp / HP -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">7</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Telp / HP</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->no_hp ?? '-' }}</div>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1 flex items-center justify-center">8</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Pekerjaan</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->pekerjaan ?? '-' }}</div>
                    </div>

                    <!-- Bidang Usaha -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1 flex items-center justify-center">9</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Bidang Usaha</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->bidang_usaha ?? '-' }}</div>
                    </div>

                    <!-- Alamat Kerja / Usaha -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">10</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Alamat Kerja / Usaha</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->alamat_usaha ?? '-' }}</div>
                    </div>

                    <!-- Telp / HP Usaha -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">11</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">Telp / HP</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                        <div class="p-2 sm:col-span-8 font-normal flex items-center">{{ $data->kontak ?? '-' }}</div>
                    </div>

                    <!-- IDI di Bank Lain -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold text-center sm:col-span-1">12</div>
                        <div class="p-2 font-semibold sm:col-span-2 flex items-center">IDI di Bank Lain</div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">:</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-8 sm:col-span-12">
                            @if(!empty($data->idi_di_bank_lain) && $data->idi_di_bank_lain !== '-')
                                <div class="inline-block border border-gray-200 rounded overflow-hidden bg-white shadow-sm p-1.5">
                                    <img 
                                        src="{{ asset('storage/' . $data->idi_di_bank_lain) }}" 
                                        alt="IDI di Bank Lain"
                                        style="width: 700px; height: auto;"
                                        class="block"
                                    >
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold sm:col-span-12 pl-8">
                            Keterangan :
                        </div>
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $data->keterangan ?? '-' }}
                        </div>
                    </div>
                
                </div>
            </div>

            <!-- B. PENGAJUAN PLAFON KREDIT -->
            <div class="mb-6">
                <div class="text-[#0A3370] px-3.5 py-2 font-bold text-base uppercase rounded-none">
                    B. PENGAJUAN PLAFON KREDIT
                </div>
                <div class="rounded-none text-sm">

                    <!-- Perhitungan Pengajuan Plafon Kredit -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">

                        <div class="p-8 sm:col-span-12">
                            @if(!empty($data->idi_di_bank_lain) && $data->idi_di_bank_lain !== '-')

                                <div class="inline-block border border-gray-200 rounded overflow-hidden bg-white shadow-sm p-1.5">
                                    <img 
                                        src="{{ asset('storage/' . $data->idi_di_bank_lain) }}" 
                                        alt="IDI di Bank Lain"
                                        style="width: 700px; height: auto;"
                                        class="block"
                                    >
                                </div>

                            @else
                                <span>-</span>
                            @endif
                        </div>

                    </div>

                    <!-- Tujuan Penggunaan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold sm:col-span-12 pl-8">
                           Tujuan Penggunaan :
                        </div>
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $data->pengajuan_plafon_kredit ->tujuan_penggunaan ?? '-' }}
                        </div>
                    </div>
                
                </div>
            </div>

            <!-- C. INFORMASI MENGENAI USAHA -->
            <div class="mb-6">
                <div class="text-[#0A3370] px-3.5 py-2 font-bold text-base uppercase rounded-none">
                    C. INFORMASI MENGENAI USAHA
                </div>
                <div class="rounded-none text-sm">

                     <!-- 1. Gambaran Pekerjaan Debitur -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold sm:col-span-12 pl-8">
                           1. Gambaran Pekerjaan Debitur
                        </div>
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $infoUtama->informasi_usaha ->gambaran_pekerjaan_debitur ?? '-' }}
                        </div>
                    </div>

                     <!-- 2. Usaha Pendukung Lain -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold sm:col-span-12 pl-8">
                           2. Usaha Pendukung Lain
                        </div>
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $infoUtama->informasi_usaha ->usaha_pendukung ?? '-' }}
                        </div>
                    </div>
                
                </div>
            </div>

            <!-- E. REFERENSI CREDIT ANALIST -->
            <div class="mb-6">
                <div class="text-[#0A3370] px-3.5 py-2 font-bold text-base uppercase rounded-none">
                    E. REFERENSI CREDIT ANALIST
                </div>
                <div class="rounded-none text-sm">

                     <!-- Keterangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $data->referensi_ca->referensi_ca ?? '-' }}
                        </div>
                    </div>
                
                </div>
            </div>

            <!-- F. DEVIASI -->
            <div class="mb-6">
                <div class="text-[#0A3370] px-3.5 py-2 font-bold text-base uppercase rounded-none">
                    F. DEVIASI
                </div>
                <div class="rounded-none text-sm">

                     <!-- Keterangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $data->deviasi->deviasi ?? '-' }}
                        </div>
                    </div>
                
                </div>
            </div>

            <!-- G. KESIMPULAN -->
            <div class="mb-6">
                <div class="text-[#0A3370] px-3.5 py-2 font-bold text-base uppercase rounded-none">
                    G. KESIMPULAN
                </div>
                <div class="rounded-none text-sm">
                     <!-- Keterangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $data->kesimpulan->kesimpulan ?? '-' }}
                        </div>
                    </div>

                    <!-- Provisi -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-2">
                            Provisi
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-9 font-normal">
                            {{ $data->kesimpulan->provisi ?? '-' }}
                        </div>
                    </div>

                    <!-- Biaya Administrasi -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-2">
                            Biaya Administrasi
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-9 font-normal">
                            {{ $data->kesimpulan->biaya_administrasi ?? '-' }}
                        </div>
                    </div>

                    <!-- Jaminan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-2">
                            Jaminan
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-9 font-normal">
                            {{ $data->kesimpulan->jaminan ?? '-' }}
                        </div>
                    </div>

                    <!-- Blokir -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-2">
                            Blokir
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-9 font-normal">
                            {{ $data->kesimpulan->blokir ?? '-' }}
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-2">
                            Keterangan
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-9 font-normal">
                            {{ $data->kesimpulan->keterangan ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

            <!-- Judul Gambar -->
            <div class="text-center mb-6">
                <h2 class="text-[#0A3370] font-bold text-lg uppercase tracking-wider">
                    GAMBAR JAMINAN, TEMPAT USAHA & TEMPAT TINGGAL
                </h2>
            </div>

                    <!-- 1. Lokasi dan Foto Jaminan  -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold sm:col-span-12 pl-8">
                           1. Lokasi dan Foto Jaminan 
                        </div>
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $infoUtama->informasi_usaha ->gambaran_pekerjaan_debitur ?? '-' }}
                        </div>
                    </div>

                     <!-- 2. Lokasi dan Foto Tempat Usaha -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold sm:col-span-12 pl-8">
                           2. Lokasi dan Foto Tempat Usaha
                        </div>
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $infoUtama->informasi_usaha ->usaha_pendukung ?? '-' }}
                        </div>
                    </div>

                    <!-- 3. Lokasi dan Foto Tempat Tinggal -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-2 font-semibold sm:col-span-12 pl-8">
                            3. Lokasi dan Foto Tempat Tinggal 
                        </div>
                        <div class="py-1 px-8 sm:col-span-12 font-normal pl-8">
                            {{ $infoUtama->informasi_usaha ->usaha_pendukung ?? '-' }}
                        </div>
                    </div>

            <!-- Judul Spesifikasi -->
            <div class="text-center mb-6">
                <h2 class="text-[#0A3370] font-bold text-lg uppercase tracking-wider">
                    SPESIFIKASI JAMINAN KREDIT, MELIPUTI 
                </h2>
            </div>
                    <!-- Sertifikat -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold text-center sm:col-span-1">1</div>
                        <div class="p-2 font-semibold sm:col-span-3">
                            Sertifikat
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-8 font-normal">
                            {{ $data->spesifikasi->sertifikat ?? '-' }}
                        </div>
                    </div>

                    <!-- Nomor/ NIB -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-3">
                            Nomor/ NIB
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-8 font-normal">
                            {{ $data->spesifikasi->nomor_nib ?? '-' }}
                        </div>
                    </div>

                    <!-- Luas Tanah (P x L) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-3">
                            Luas Tanah (P x L)
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-8 font-normal">
                            {{ $data->spesifikasi->luas_tanah ?? '-' }}
                        </div>
                    </div>

                    <!-- Luas Bangunan (P x L) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-3">
                            Luas Bangunan (P x L)
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-8 font-normal">
                            {{ $data->spesifikasi->luas_bangunan ?? '-' }}
                        </div>
                    </div>

                    <!-- Lebar Depan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 items-center pl-6">
                        <div class="p-2 font-semibold sm:col-span-3">
                            Lebar Depan
                        </div>
                        <div class="p-2 font-semibold text-center sm:col-span-1">
                            :
                        </div>
                        <div class="p-2 sm:col-span-8 font-normal">
                            {{ $data->spesifikasi->lebar_depan ?? '-' }}
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