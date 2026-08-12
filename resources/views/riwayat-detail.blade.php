<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pra Survei - BPR Adipura Santosa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan Alpine.js untuk fungsionalitas dropdown interaktif -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-between">

    <!-- HEADER -->
    <header class="bg-[#0A3370] text-white shadow-md py-4 border-b-4 border-[#0082CB] sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BPR Adipura Santosa" class="h-9 w-auto bg-white p-1 rounded object-contain">
                <h1 class="text-xl font-bold tracking-wide">BPR ADIPURA SANTOSA</h1>
            </div>
            <a href="{{ route('riwayat') }}" class="inline-flex items-center gap-2 text-sm text-white font-medium px-4 py-1.5 rounded-full border-2 border-white hover:bg-white/10 transition"> 
                <span>Kembali</span> 
            </a>
        </div> 
    </header>

    <!-- KONTEN UTAMA -->
    <main class="max-w-5xl mx-auto my-8 px-4 w-full flex-grow">
        <div class="bg-white rounded-lg shadow-sm p-6 sm:p-8 border border-gray-200">
            
            <!-- JUDUL FORM & TOMBOL EXPORT DI ATAS -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 pb-4 border-b-2 border-[#0A3370] gap-4">
                <h2 class="text-xl font-bold text-[#0A3370] tracking-wider">FORM PRA SURVEY (MARKETING)</h2>

                <!-- DROPDOWN TOMBOL EXPORT (Hanya muncul pilihan saat diklik) -->
                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="inline-flex items-center gap-2 bg-[#0A3370] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#07224e] transition shadow-sm">
                        <span>📥 Export Dokumen</span>
                        <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Menu Pilihan Export -->
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50">
                        <div class="py-1">
                            <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📄 Export ke PDF</a>
                            <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📝 Export ke Word</a>
                            <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📊 Export ke Excel</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- A. DATA DEBITUR -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-sm uppercase rounded-t-md">
                    A. Data Debitur
                </div>
                <div class="border border-[#0A3370] rounded-b-md text-xs sm:text-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Nomor Register</div>
                        <div class="p-2 border-r border-gray-300 font-medium">{{ $data->no_register ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Nama Marketing</div>
                        <div class="p-2 font-medium">{{ $data->nama_marketing ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">1. Nama Debitur</div>
                        <div class="p-2 border-r border-gray-300 font-medium">{{ $data->nama ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Nama Pasangan</div>
                        <div class="p-2 font-medium">{{ $data->nama_pasangan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Usia</div>
                        <div class="p-2 border-r border-gray-300">{{ $data->usia ?? '-' }} Tahun</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Usia Pasangan</div>
                        <div class="p-2">{{ $data->usia_pasangan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">2. Usaha</div>
                        <div class="p-2 border-r border-gray-300">{{ $data->usaha ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Lama Usaha</div>
                        <div class="p-2">{{ $data->lama_usaha ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">3. Alamat Debitur</div>
                        <div class="p-2 sm:col-span-3">{{ $data->alamat_debitur ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Alamat Domisili</div>
                        <div class="p-2 sm:col-span-3">{{ $data->alamat_domisili ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">4. Plafond</div>
                        <div class="p-2 border-r border-gray-300 font-semibold text-emerald-700">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">JKW</div>
                        <div class="p-2">{{ $data->jkw ?? '-' }} bulan</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">5. Tujuan Penggunaan</div>
                        <div class="p-2 border-r border-gray-300">{{ $data->tujuan_penggunaan ?? '-' }}</div>
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Angsuran / Type Fasilitas</div>
                        <div class="p-2">
                            <div>Rp {{ number_format($data->angsuran ?? 0, 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $data->type_fasilitas ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- B. DATA JAMINAN -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-sm uppercase rounded-t-md">
                    B. Data Jaminan
                </div>
                <div class="border border-[#0A3370] rounded-b-md text-xs sm:text-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">1. Kepemilikan</div>
                        <div class="p-2 sm:col-span-3 font-medium">{{ $data->jaminan_kepemilikan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Alamat Jaminan</div>
                        <div class="p-2 sm:col-span-3">{{ $data->jaminan_alamat ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Share Loc</div>
                        <div class="p-2 sm:col-span-3">
                            <a href="{{ $data->jaminan_shareloc ?? '#' }}" target="_blank" class="text-blue-600 underline truncate block">{{ $data->jaminan_shareloc ?? '-' }}</a>
                        </div>
                    </div>

                    <!-- Tabel Penilaian Jaminan -->
                    <div class="overflow-x-auto border-b border-gray-300">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-300 text-xs">
                                    <th class="p-2 border-r border-gray-300">Uraian</th>
                                    <th class="p-2 border-r border-gray-300 text-center">Luas (m2)</th>
                                    <th class="p-2 border-r border-gray-300 text-right">Harga Satuan</th>
                                    <th class="p-2 border-r border-gray-300 text-right">Nilai Pasar</th>
                                    <th class="p-2 border-r border-gray-300 text-right">Nilai Taksasi</th>
                                    <th class="p-2 text-right">Nilai Likuidasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-200">
                                    <td class="p-2 border-r border-gray-300 font-medium">Tanah</td>
                                    <td class="p-2 border-r border-gray-300 text-center">{{ $data->tanah_luas ?? '-' }}</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->tanah_harga ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->tanah_pasar ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->tanah_taksasi ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-2 text-right">Rp {{ number_format($data->tanah_likuidasi ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="p-2 border-r border-gray-300 font-medium">Bangunan</td>
                                    <td class="p-2 border-r border-gray-300 text-center">{{ $data->bangunan_luas ?? '-' }}</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->bangunan_harga ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->bangunan_pasar ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($data->bangunan_taksasi ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-2 text-right">Rp {{ number_format($data->bangunan_likuidasi ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-gray-50 font-bold">
                                    <td colspan="3" class="p-2 border-r border-gray-300 text-right">Total</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format(($data->tanah_pasar ?? 0) + ($data->bangunan_pasar ?? 0), 0, ',', '.') }}</td>
                                    <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format(($data->tanah_taksasi ?? 0) + ($data->bangunan_taksasi ?? 0), 0, ',', '.') }}</td>
                                    <td class="p-2 text-right">Rp {{ number_format(($data->tanah_likuidasi ?? 0) + ($data->bangunan_likuidasi ?? 0), 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Spesifikasi Jaminan</div>
                        <div class="p-2 sm:col-span-3 whitespace-pre-line">{{ $data->spesifikasi_jaminan ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Denah / Link</div>
                        <div class="p-2 sm:col-span-3">
                            <a href="{{ $data->link_denah ?? '#' }}" target="_blank" class="text-blue-600 underline truncate block">{{ $data->link_denah ?? '-' }}</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">Informasi Harga Pembanding</div>
                        <div class="p-2 sm:col-span-3 whitespace-pre-line">{{ $data->info_harga ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- C. SLIK -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-sm uppercase rounded-t-md">
                    C. SLIK (Checking)
                </div>
                <div class="border border-[#0A3370] rounded-b-md overflow-x-auto text-xs sm:text-sm">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-300 text-xs">
                                <th class="p-2 border-r border-gray-300">Nama Bank</th>
                                <th class="p-2 border-r border-gray-300 text-right">Plafon</th>
                                <th class="p-2 border-r border-gray-300 text-right">Outstanding</th>
                                <th class="p-2 border-r border-gray-300 text-center">KOL</th>
                                <th class="p-2 border-r border-gray-300 text-right">Angsuran</th>
                                <th class="p-2 border-r border-gray-300 text-center">JKW</th>
                                <th class="p-2 text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data->slik ?? [] as $slik)
                            <tr class="border-b border-gray-200">
                                <td class="p-2 border-r border-gray-300 font-medium">{{ $slik['bank'] }}</td>
                                <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($slik['plafon'], 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($slik['outstanding'], 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-center font-bold text-red-600">{{ $slik['kol'] }}</td>
                                <td class="p-2 border-r border-gray-300 text-right">Rp {{ number_format($slik['angsuran'], 0, ',', '.') }}</td>
                                <td class="p-2 border-r border-gray-300 text-center">{{ $slik['jkw'] }}</td>
                                <td class="p-2 text-center">{{ $slik['keterangan'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-3 text-center text-gray-500">Tidak ada data SLIK.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- D. INFORMASI USAHA & KEUANGAN -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-sm uppercase rounded-t-md">
                    D. Informasi Usaha & Keuangan
                </div>
                <div class="border border-[#0A3370] rounded-b-md text-xs sm:text-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-2">
                        <div class="border-r border-gray-300">
                            <div class="flex justify-between p-2 border-b border-gray-200">
                                <span class="font-medium">1. Omset Usaha</span>
                                <span class="font-semibold">Rp {{ number_format($data->omset_usaha ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between p-2 border-b border-gray-200">
                                <span class="font-medium">2. Biaya Operasional</span>
                                <span class="font-semibold">Rp {{ number_format($data->biaya_operasional ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between p-2 border-b border-gray-200 bg-gray-50">
                                <span class="font-bold">Penghasilan Kotor</span>
                                <span class="font-bold">Rp {{ number_format(($data->omset_usaha ?? 0) - ($data->biaya_operasional ?? 0), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between p-2 border-b border-gray-200">
                                <span class="font-medium">3. Penghasilan Tambahan</span>
                                <span class="font-semibold">Rp {{ number_format($data->penghasilan_tambahan ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between p-2 border-b border-gray-200 bg-gray-50">
                                <span class="font-bold">Total Pendapatan</span>
                                <span class="font-bold">Rp {{ number_format((($data->omset_usaha ?? 0) - ($data->biaya_operasional ?? 0)) + ($data->penghasilan_tambahan ?? 0), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between p-2 border-b border-gray-200">
                                <span class="font-medium">4. Pengeluaran Rumah Tangga</span>
                                <span class="font-semibold">Rp {{ number_format($data->pengeluaran_rt ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between p-2 border-b border-gray-200 bg-gray-50">
                                <span class="font-bold">Penghasilan Bersih</span>
                                <span class="font-bold text-emerald-700">Rp {{ number_format($data->penghasilan_bersih ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="p-3 bg-gray-50 flex flex-col justify-between">
                            <div>
                                <span class="block font-bold text-gray-700 mb-1">Deskripsi Usaha:</span>
                                <p class="text-gray-600 whitespace-pre-line">{{ $data->deskripsi_usaha ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- E, F, G, H, I, J, K, L (LEGALITAS & KELENGKAPAN) -->
            <div class="mb-6">
                <div class="bg-[#0A3370] text-white px-3 py-1.5 font-bold text-sm uppercase rounded-t-md">
                    E - L. Legalitas & Kelengkapan Berkas
                </div>
                <div class="border border-[#0A3370] rounded-b-md text-xs sm:text-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">E. Legalitas</div>
                        <div class="p-2 sm:col-span-3">{{ $data->legalitas ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">F. Capital / Aset</div>
                        <div class="p-2 sm:col-span-3">{{ $data->capital_aset ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">G. Berkas Take Over</div>
                        <div class="p-2 sm:col-span-3">{{ $data->berkas_take_over ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">H. Data KTP</div>
                        <div class="p-2 sm:col-span-3">{{ $data->data_ktp ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">I. Data SLIK</div>
                        <div class="p-2 sm:col-span-3">{{ $data->data_slik ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">J. Kartu Keluarga</div>
                        <div class="p-2 sm:col-span-3">{{ $data->data_kk ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 border-b border-gray-300">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">K. Surat Nikah</div>
                        <div class="p-2 sm:col-span-3">{{ $data->data_surat_nikah ?? '-' }}</div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4">
                        <div class="p-2 bg-gray-50 font-semibold border-r border-gray-300">L. Badan Usaha</div>
                        <div class="p-2 sm:col-span-3">{{ $data->data_badan_usaha ?? '-' }}</div>
                    </div>
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