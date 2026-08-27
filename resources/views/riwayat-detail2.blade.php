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
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 pb-4 border-b-2 border-[#0A3370] gap-4">
                <div class="flex flex-wrap items-center gap-4">
                    <h2 class="text-xl font-bold text-[#0A3370] tracking-wider">FORM CREDIT ANALYS</h2>
                    <a href="{{ route('1pra-survei', ['id' => $data->id]) }}" class="no-print inline-flex items-center gap-2 bg-amber-600 text-white px-3.5 py-1.5 rounded-lg text-sm font-semibold hover:bg-amber-700 transition shadow-sm">
                        <span>✏️ Edit Data</span>
                    </a>
                </div>

                <div class="no-print flex flex-wrap items-center justify-end gap-3">
                    <button type="button" onclick="printRiwayat({{ $data->id }})" class="inline-flex items-center gap-2 bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition shadow-sm cursor-pointer">
                        <span>🖨️ Cetak</span>
                    </button>

                    @if(!isset($isExport))
                    <div class="relative inline-block text-left" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="inline-flex items-center gap-2 bg-[#0A3370] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#07224e] transition shadow-sm">
                            <span>📥 Export Dokumen</span>
                            <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" 
                            class="origin-top-right absolute right-0 mt-2 w-48 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50 rounded-none shadow-lg">
                            <div class="py-1">
                                <a href="{{ route('riwayat.pdf2', $data->id) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📄 Export ke PDF</a>
                                <a href="{{ route('riwayat.word2', $data->id) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📝 Export ke Word</a>
                                <a href="{{ route('riwayat.excel2', $data->id) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📊 Export ke Excel</a>
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
                <div class="border border-[#0A3370] rounded-none">
                    
                    <!-- Nomor Register -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1"></div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3">Nomor Register</div>
                        <div class="p-3.5 sm:col-span-8 font-medium">{{ $data->no_register ?? '-' }}</div>
                    </div>

                    <!-- Nama Debitur & Nama Marketing -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">1</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Nama Debitur</div>
                        <div class="p-3.5 border-r border-gray-300 sm:col-span-4 font-medium">{{ $data->nama ?? '-' }}</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2">Nama Marketing</div>
                        <div class="p-3.5 sm:col-span-2 font-medium">{{ $data->nama_marketing ?? '-' }}</div>
                    </div>

                    <!-- Tanggal OTS -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1"></div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3">Tanggal OTS</div>
                        <div class="p-3.5 sm:col-span-8 font-medium">{{ $data->tanggal_ots ?? '-' }}</div>
                    </div>

                    <!-- Plafon & JKW -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">2</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Plafon</div>
                        <div class="p-3.5 border-r border-gray-300 sm:col-span-4 font-semibold text-emerald-700">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-2">JKW</div>
                        <div class="p-3.5 sm:col-span-2 font-medium">{{ $data->jangka_waktu ?? '-' }}</div>
                    </div>

                    <!-- Tujuan Penggunaan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1">3</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3">Tujuan Penggunaan</div>
                        <div class="p-3.5 sm:col-span-8 font-medium">{{ $data->tujuan_penggunaan ?? '-' }}</div>
                    </div>

                    <!-- Estimasi Kewajiban -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">4</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Estimasi Kewajiban</div>
                        <div class="p-3.5 sm:col-span-8 font-medium">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- Type Fasilitas -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1">5</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3">Type Fasilitas</div>
                        <div class="p-3.5 sm:col-span-8 text-gray-700 font-medium">
                            {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                        </div>
                    </div>

                    <!-- Temuan CA -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1">6</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3">Temuan CA</div>
                        <div class="p-3.5 sm:col-span-8 font-medium">{{ $data->temuan_ca ?? '-' }}</div>
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
                <div class="border border-[#0A3370] rounded-none">
                    
                    <!-- Judul JAMINAN -->
                    <div class="grid grid-cols-1 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-100 font-bold uppercase text-[#0A3370]">JAMINAN</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Kepemilikan</div>
                        <div class="p-3.5 sm:col-span-3 font-medium">{{ $agunan->kepemilikan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Alamat</div>
                        <div class="p-3.5 sm:col-span-3">{{ $agunan->alamat ?? '-' }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Share Loc</div>
                        <div class="p-3.5 sm:col-span-3">
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
                        <div class="p-3.5 bg-gray-100 font-bold uppercase text-[#0A3370]">Collateral</div>
                    </div>

                    <!-- Header Tabel Penilaian Jaminan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 bg-gray-100 border-b border-gray-300 font-semibold">
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300">Uraian</div>
                        <div class="p-3.5 sm:col-span-1 border-r border-gray-300 text-center">Luas (m2)</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Harga</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Nilai Pasar</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Nilai Taksasi</div>
                        <div class="p-3.5 sm:col-span-3 text-right">Nilai Likuidasi</div>
                    </div>

                    <!-- Baris Tanah -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-200">
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 font-medium">Tanah</div>
                        <div class="p-3.5 sm:col-span-1 border-r border-gray-300 text-center">{{ $agunan->luas_tanah ?? '-' }}</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format($agunan->harga_tanah ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format($agunan->tanah_pasar ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format($agunan->tanah_taksasi ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-3 text-right">Rp {{ number_format($agunan->tanah_likuidasi ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- Baris Bangunan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-200">
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 font-medium">Bangunan</div>
                        <div class="p-3.5 sm:col-span-1 border-r border-gray-300 text-center">{{ $agunan->luas_bangunan ?? '-' }}</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format($agunan->harga_bangunan ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format($agunan->bangunan_pasar ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format($agunan->bangunan_taksasi ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-3 text-right">Rp {{ number_format($agunan->bangunan_likuidasi ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <!-- Baris Total -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 bg-gray-50 font-bold border-b border-gray-300">
                        <div class="p-3.5 sm:col-span-5 border-r border-gray-300 text-center">Total</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format(($agunan->tanah_pasar ?? 0) + ($agunan->bangunan_pasar ?? 0), 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-2 border-r border-gray-300 text-right">Rp {{ number_format(($agunan->tanah_taksasi ?? 0) + ($agunan->bangunan_taksasi ?? 0), 0, ',', '.') }}</div>
                        <div class="p-3.5 sm:col-span-3 text-right">Rp {{ number_format(($agunan->tanah_likuidasi ?? 0) + ($agunan->bangunan_likuidasi ?? 0), 0, ',', '.') }}</div>
                    </div>

                    <!-- Denah -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Denah</div>
                        <div class="p-3.5 sm:col-span-3">
                            @if(!empty($agunan->denah) && $agunan->denah !== '-')
                                <div class="w-full max-w-sm border border-gray-200 rounded overflow-hidden bg-white shadow-sm">
                                    <img src="{{ asset('storage/' . $agunan->denah) }}" alt="Denah Lokasi" class="w-full h-auto object-cover max-h-64">
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Spesifikasi Jaminan -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Spesifikasi Jaminan</div>
                        <div class="p-3.5 sm:col-span-3 whitespace-pre-line">{{ $agunan->spesifikasi ?? '-' }}</div>
                    </div>
                    
                    <!-- Judul Informasi Harga -->
                    <div class="grid grid-cols-1 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-100 font-bold uppercase text-[#0A3370]">Informasi Harga</div>
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
                                    <div class="p-3.5 sm:col-span-1 bg-gray-50/50 sm:bg-transparent font-medium border-r border-gray-200 text-center">{{ $index + 1 }}</div>
                                    <div class="p-3.5 sm:col-span-9 whitespace-pre-line">{{ !empty(trim($info)) ? $info : '-' }}</div>
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
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    {{ $data->analisis_jaminan ?? '-' }}
                </div>
            </div>

            <!-- D. Analisis SLIK -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    D. Analisis SLIK
                </div>
                <div class="border border-[#0A3370] rounded-none">
                    
                    <!-- D.1 Informasi Penghasilan Utama menurut nasabah -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.1</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Informasi Penghasilan Utama menurut nasabah</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->dataslik->penghasilan_utama ?? $data->analisis_slik ?? '-' }}</div>
                    </div>

                    <!-- D.2 Informasi Penghasilan Pendukung menurut nasabah -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.2</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Informasi Penghasilan Pendukung menurut nasabah</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->dataslik->penghasilan_pendukung ?? $data->analisis_slik ?? '-' }}</div>
                    </div>

                    <!-- D.3 Header Tabel Keuangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 bg-gray-100 border-b border-gray-300 font-semibold">
                        <div class="p-3.5 bg-gray-50 border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center text-black">D.3</div>
                        <div class="p-3.5 border-r border-gray-300 sm:col-span-3 text-left flex items-center justify-start">Pengeluaran Rumah Tangga</div><div class="p-3.5 border-r border-gray-300 sm:col-span-4 text-center flex items-center justify-center">Angsuran Bank Lain</div>
                        <div class="p-3.5 sm:col-span-4 text-center flex items-center justify-center">Angsuran BPR</div>
                    </div>

                    <!-- D.3 Isi Data Keuangan -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300 font-medium">
                        <div class="p-3.5 bg-gray-50 border-r border-gray-300 sm:col-span-1"></div>
                        <div class="p-3.5 border-r border-gray-300 sm:col-span-3 text-center flex items-center justify-center">{{ $data->dataslik->pengeluaran_rumah_tangga ?? '-' }}</div>
                        <div class="p-3.5 border-r border-gray-300 sm:col-span-4 text-center flex items-center justify-center">{{ $data->dataslik->angsuran_bank_lain ?? '-' }}</div>
                        <div class="p-3.5 sm:col-span-4 text-center flex items-center justify-center">{{ $data->dataslik->angsuran_bpr ?? '-' }}</div>
                    </div>

                    <!-- D.4 Analisis Kapasitas CA -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.4</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Analisis Kapasitas CA</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->dataslik->analisis_kapasitas_ca ?? $data->analisis_slik ?? '-' }}</div>
                    </div>

                    <!-- D.5 Kelengkapan Berkas -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">D.5</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Kelengkapan Berkas</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->dataslik->kelengkapan_berkas ?? $data->analisis_slik ?? '-' }}</div>
                    </div>

                </div>
            </div>

            <!-- E. Deskripsi Usaha -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    E. Deskripsi Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    {{ $data->capacity->deskripsi_usaha ?? '-' }}
                </div>
            </div>

            <!-- F. Analisis Capital -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    F. Analisis Capital
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    {{ $data->capital->analisis_aset ?? '-' }}
                </div>
            </div>

            <!-- G. Analisis Take Over -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    G. Analisis Take Over
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    {{ $data->kondisi->analisis_take_over ?? '-' }}
                </div>
            </div>

            <!-- H. Analisis Kelengkapan Berkas -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    H. Analisis Kelengkapan Berkas
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    {{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}
                </div>
            </div>

            <!-- I. Analisis Badan Usaha -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    I. Analisis Badan Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    {{ $data->badanusaha->analisa_badan_usaha ?? '-' }}
                </div>
            </div>

            <!-- J. Analisis SWOT -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    J. Analisis SWOT
                </div>
                <div class="border border-[#0A3370] rounded-none">
                    
                    <!-- J.1 Strengths (Kekuatan) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.1</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Strengths (Kekuatan)</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->swot->kekuatan ?? '-' }}</div>
                    </div>

                    <!-- J.2 Weaknesses (Kelemahan) dan Mitigasi -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.2</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Weaknesses (Kelemahan) dan Mitigasi</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->swot->kelemahan ?? '-' }}</div>
                    </div>

                    <!-- J.3 Opportunities (Peluang) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.3</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Opportunities (Peluang)</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->swot->peluang ?? '-' }}</div>
                    </div>

                    <!-- J.4 Threats (Ancaman) -->
                    <div class="grid grid-cols-1 sm:grid-cols-12 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 text-center sm:col-span-1 flex items-center justify-center">J.4</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 sm:col-span-3 flex items-center">Threats (Ancaman)</div>
                        <div class="p-3.5 sm:col-span-8 font-medium flex items-center whitespace-pre-line">{{ $data->swot->ancaman ?? '-' }}</div>
                    </div>

                    <!-- Kesimpulan (Model style Collateral, full ke samping tanpa kolom nomor) -->
                    <div class="grid grid-cols-1">
                        <div class="p-3.5 bg-gray-100 font-bold uppercase text-[#0A3370] border-b border-gray-300">Kesimpulan</div>
                        <div class="p-3.5 font-medium whitespace-pre-line">{{ $data->swot->kesimpulan ?? '-' }}</div>
                    </div>

                </div>
            </div>

            <!-- K. Rekomendasi -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    K. Rekomendasi
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    {{ $data->swot->rekomendasi ?? '-' }}
                </div>
            </div>

            <!-- L. Syarat dan Catatan Lainnya -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    L. Syarat dan Catatan Lainnya
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
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