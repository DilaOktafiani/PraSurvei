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
                    <h2 class="text-xl font-bold text-[#0A3370] tracking-wider">FORM PRA SURVEY (MARKETING)</h2>
                    <a href="{{ route('1pra-survei', ['id' => $data->id]) }}" class="no-print inline-flex items-center gap-2 bg-amber-600 text-white px-3.5 py-1.5 rounded-lg text-sm font-semibold hover:bg-amber-700 transition shadow-sm">
                        <span>✏️ Edit Data</span>
                    </a>
                </div>

                <div class="no-print flex flex-wrap items-center justify-end gap-3">
                    <a href="{{ route('riwayat.print', ['id' => $data->id]) }}" target="_blank" class="inline-flex items-center gap-2 bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition shadow-sm">
                    <span>🖨️ Cetak</span>
                </a>

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
                                <a href="{{ route('riwayat.export', ['id' => $data->id, 'type' => 'pdf']) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📄 Export ke PDF</a>
                                <a href="{{ route('riwayat.export', ['id' => $data->id, 'type' => 'word']) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📝 Export ke Word</a>
                                <a href="{{ route('riwayat.export', ['id' => $data->id, 'type' => 'excel']) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📊 Export ke Excel</a>
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
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Nomor Register</div>
                        <div class="p-3.5 border-r border-gray-300 font-medium">{{ $data->no_register ?? '-' }}</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Nama Marketing</div>
                        <div class="p-3.5 font-medium">{{ $data->nama_marketing ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">1. Nama Debitur</div>
                        <div class="p-3.5 border-r border-gray-300 font-medium">{{ $data->nama ?? '-' }}</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Nama Pasangan</div>
                        <div class="p-3.5 font-medium">{{ $data->nama_pasangan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Usia</div>
                        <div class="p-3.5 border-r border-gray-300">{{ $data->usia ?? '-' }}</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Usia Pasangan</div>
                        <div class="p-3.5">{{ $data->usia_pasangan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">2. Usaha</div>
                        <div class="p-3.5 border-r border-gray-300">{{ $data->usaha ?? '-' }}</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Lama Usaha</div>
                        <div class="p-3.5">{{ $data->lama_usaha ?? '-' }}</div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">3. Alamat Debitur</div>
                        <div class="p-3.5 sm:col-span-3 font-medium">{{ $data->alamat_ktp ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Alamat Domisili</div>
                        <div class="p-3.5 sm:col-span-3 font-medium">{{ $data->alamat_domisili ?? '-' }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">4. Plafon</div>
                        <div class="p-3.5 border-r border-gray-300 font-semibold text-emerald-700">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</div>
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">JKW</div>
                        <div class="p-3.5">{{ $data->jangka_waktu ?? '-' }}</div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-4">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">5. Tujuan Penggunaan</div>
                        <div class="p-3.5 border-r border-gray-300 sm:col-span-1 whitespace-pre-line flex items-center">{{ $data->tujuan_penggunaan ?? '-' }}</div>
                        
                        <div class="sm:col-span-2 flex flex-col">
                            <div class="grid grid-cols-2 border-b border-gray-300">
                                <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Angsuran</div>
                                <div class="p-3.5 font-semibold text-emerald-700">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Type Fasilitas</div>
                                <div class="p-3.5 text-gray-700 font-medium">{{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}</div>
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
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    B. Data Jaminan
                </div>
                <div class="border border-[#0A3370] rounded-none">
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">1. Kepemilikan</div>
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

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">Spesifikasi Jaminan</div>
                        <div class="p-3.5 sm:col-span-3 whitespace-pre-line">{{ $agunan->spesifikasi ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                    <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300 flex items-center">Denah</div>
                    <div class="p-3.5 sm:col-span-3">
                        @if(!empty($agunan->denah) && $agunan->denah !== '-')
                            <div class="w-full max-w-sm border border-gray-200 rounded overflow-hidden bg-white shadow-sm">
                                <!-- Menggunakan asset('storage/...') karena file di-upload dan disimpan di server -->
                                <img src="{{ asset('storage/' . $agunan->denah) }}" alt="Denah Lokasi" class="w-full h-auto object-cover max-h-64">
                            </div>
                        @else
                            <span>-</span>
                        @endif
                    </div>
                </div>
                    
                    <!-- INFORMASI HARGA -->
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        <div class="p-3.5 sm:col-span-2 bg-gray-50 font-semibold border-r border-gray-300 flex items-start">Informasi Harga</div>
                        <div class="sm:col-span-10 divide-y divide-gray-200">
                            @php
                                // Menggabungkan kolom database terpisah menjadi sebuah array urut
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

            <!-- C. SLIK -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    C. SLIK
                </div>
                <div class="border border-[#0A3370] rounded-none overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-300">
                                <th class="p-3.5 border-r border-gray-300 text-center">Nama Bank</th>
                                <th class="p-3.5 border-r border-gray-300 text-center">Plafon</th>
                                <th class="p-3.5 border-r border-gray-300 text-center">Outstanding</th>
                                <th class="p-3.5 border-r border-gray-300 text-center">KOL</th>
                                <th class="p-3.5 border-r border-gray-300 text-center">Angsuran</th>
                                <th class="p-3.5 border-r border-gray-300 text-center">JKW</th>
                                <th class="p-3.5 text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data->pinjaman ?? [] as $slik)
                            <tr class="border-b border-gray-200">
                                <td class="p-3.5 border-r border-gray-300 text-center font-medium">{{ $slik->nama_ljk ?? '-' }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-right">Rp {{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-right">Rp {{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-center font-bold text-red-600">{{ $slik->kolekbilitas ?? '-' }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-right">Rp {{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-center">{{ $slik->jkw ?? '-' }}</td>
                                <td class="p-3.5 text-center">{{ $slik->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="p-4 text-center text-gray-500">Tidak ada data SLIK.</td></tr>
                            @endforelse
                            
                            <!-- BARIS TOTAL -->
                            <tr class="bg-gray-50 font-bold">
                                <td class="p-3.5 border-r border-gray-300 text-center">Total</td>
                                <td class="p-3.5 border-r border-gray-300 text-right">Rp {{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-right">Rp {{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-center">-</td>
                                <td class="p-3.5 border-r border-gray-300 text-right">Rp {{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</td>
                                <td class="p-3.5 border-r border-gray-300 text-center">-</td>
                                <td class="p-3.5 text-center">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- D. INFORMASI USAHA -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    D. Informasi Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none">
                    <div class="grid grid-cols-1 sm:grid-cols-12">
                        
                        <!-- Bagian Kiri: Tabel Keuangan (Mengambil 7 kolom) -->
                        <div class="sm:col-span-7 border-r border-gray-300 divide-y divide-gray-200">
                            
                            <!-- 1. Omset Usaha -->
                            <div class="grid grid-cols-12 p-3.5 items-center">
                                <div class="col-span-1 font-medium">1.</div>
                                <div class="col-span-6 font-medium">Omset Usaha</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->omset_usaha ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- 2. Biaya Operasional -->
                            <div class="grid grid-cols-12 p-3.5 items-center">
                                <div class="col-span-1 font-medium">2.</div>
                                <div class="col-span-6 font-medium">Biaya Operasional</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->biaya_operasional ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Penghasilan Kotor (Omset - Biaya Operasional) -->
                            @php
                                $penghasilanKotor = ($data->infousaha->omset_usaha ?? 0) - ($data->infousaha->biaya_operasional ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-3.5 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Penghasilan Kotor</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-right">{{ number_format($penghasilanKotor, 0, ',', '.') }}</div>
                            </div>

                            <!-- 3. Penghasilan Tambahan -->
                            <div class="grid grid-cols-12 p-3.5 items-center">
                                <div class="col-span-1 font-medium">3.</div>
                                <div class="col-span-6 font-medium">Penghasilan Tambahan</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->penghasilan_tambahan ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Total Pendapatan (Penghasilan Kotor + Penghasilan Tambahan) -->
                            @php
                                $totalPendapatan = $penghasilanKotor + ($data->infousaha->penghasilan_tambahan ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-3.5 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Total Pendapatan</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-right">{{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                            </div>

                            <!-- 4. Pengeluaran Rumah Tangga -->
                            <div class="grid grid-cols-12 p-3.5 items-center">
                                <div class="col-span-1 font-medium">4.</div>
                                <div class="col-span-6 font-medium">Pengeluaran Rumah Tangga</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->pengeluaran_rumah_tangga ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Penghasilan Bersih (Total Pendapatan - Pengeluaran Rumah Tangga) -->
                            @php
                                $penghasilanBersih = $totalPendapatan - ($data->infousaha->pengeluaran_rumah_tangga ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-3.5 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Penghasilan Bersih</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-emerald-700 text-right">{{ number_format($penghasilanBersih, 0, ',', '.') }}</div>
                            </div>

                            <!-- 5. Angsuran Bank Lain -->
                            <div class="grid grid-cols-12 p-3.5 items-center">
                                <div class="col-span-1 font-medium">5.</div>
                                <div class="col-span-6 font-medium">Angsuran Bank Lain</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->angsuran_bank_lain ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Sisa Penghasilan (Penghasilan Bersih - Angsuran Bank Lain) -->
                            @php
                                $sisaPenghasilan = $penghasilanBersih - ($data->infousaha->angsuran_bank_lain ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-3.5 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Sisa Penghasilan</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-right">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</div>
                            </div>

                            <!-- 6. Angsuran BPR -->
                            <div class="grid grid-cols-12 p-3.5 items-center">
                                <div class="col-span-1 font-medium">6.</div>
                                <div class="col-span-6 font-medium">Angsuran BPR</div>
                                <div class="col-span-1 font-medium text-right">Rp</div>
                                <div class="col-span-4 font-semibold text-right">{{ number_format($data->infousaha->angsuran_bpr ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <!-- Sisa Penghasilan Bersih (Sisa Penghasilan - Angsuran BPR) -->
                            @php
                                $sisaPenghasilanBersih = $sisaPenghasilan - ($data->infousaha->angsuran_bpr ?? 0);
                            @endphp
                            <div class="grid grid-cols-12 p-3.5 items-center bg-gray-50">
                                <div class="col-span-1"></div>
                                <div class="col-span-6 font-bold">Sisa Penghasilan Bersih</div>
                                <div class="col-span-1 font-bold text-right">Rp</div>
                                <div class="col-span-4 font-bold text-emerald-700 text-right">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</div>
                            </div>

                        </div>

                        <!-- Bagian Kanan: Deskripsi Usaha (Mengambil 5 kolom sisa) -->
                        <div class="sm:col-span-5 p-3.5 bg-white flex flex-col">
                            <span class="font-bold text-gray-800 mb-2">Deskripsi Usaha :</span>
                            <div class="flex-grow p-2 text-gray-700 whitespace-pre-line">
                                {{ $data->infousaha->deskripsi_usaha ?? '-' }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- E. LEGALITAS -->
            @forelse($data->agunan_tanah ?? [] as $tanah)
                <div class="mb-6">
                    <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                        E. Legalitas {{ $tanah->urutan ? '- ' . $tanah->urutan : '' }}
                    </div>
                    <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                        {{ $tanah->kepemilikan ?? '-' }}
                    </div>
                </div>
            @empty
                <div class="mb-6">
                    <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                        E. Legalitas
                    </div>
                    <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                        -
                    </div>
                </div>
            @endforelse

            <!-- F. CAPITAL / ASET YANG DIMILIKI -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    F. Capital / Aset Yang Dimiliki
                </div>
                <div class="border border-[#0A3370] rounded-none">
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
                        <div class="p-3.5 bg-gray-50 font-semibold border-r border-gray-300">ASET {{ $index + 1 }}</div>
                        <div class="p-3.5 sm:col-span-3 whitespace-pre-line">{{ !empty(trim($aset)) ? $aset : '-' }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- G. KELENGKAPAN BERKAS TAKE OVER -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    G. Kelengkapan Berkas Take Over
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    @php $val = $data->kondisi->berkas_take_over ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- H. KELENGKAPAN DATA KTP -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    H. Kelengkapan Data KTP
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    @php $val = $data->datalengkap->ktp ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- I. KELENGKAPAN DATA SLIK -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    I. Kelengkapan Data SLIK
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
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
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    J. Kelengkapan Data Kartu Keluarga
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    @php $val = $data->datalengkap->kk ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- K. KELENGKAPAN DATA SURAT NIKAH -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    K. Kelengkapan Data Surat Nikah
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
                    @php $val = $data->datalengkap->surat_nikah ?? null; @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </div>
            </div>

            <!-- L. KELENGKAPAN DATA BADAN USAHA -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3.5 py-2 font-bold text-sm uppercase rounded-none">
                    L. Kelengkapan Data Badan Usaha
                </div>
                <div class="border border-[#0A3370] rounded-none p-3.5 bg-white whitespace-pre-line">
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

</body>
</html>