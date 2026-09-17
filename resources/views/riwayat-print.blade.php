<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pra Survei - {{ $data->nama ?? '-' }}</title>
    <style>
        /* Mengatur agar halaman cetak fleksibel dengan margin atas 1 inci */
        @page {
            size: auto; /* Mengikuti pilihan user di window print (Portrait/Landscape) */
            margin: 2cm 1cm 1cm 1cm; /* Urutan: Top, Right, Bottom, Left */
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #111;
            line-height: 1.15;
            margin: 0;
            padding: 0;
            background-color: #555;
        }

        .page-container {
            width: 100%; /* Lebar 100% agar menyesuaikan kertas apapun yang dipilih */
            max-width: 297mm; /* Batas maksimal selebar ukuran landscape */
            min-height: 100vh;
            padding: 10mm;
            margin: 20px auto;
            background: white;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        h2 {
            text-align: center;
            font-size: 12pt;
            margin: 0 0 8px 0;
            color: #0A3370;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table.export-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
            page-break-inside: avoid;
        }
        table.export-table td, table.export-table th {
            border: 1px solid #444444;
            padding: 2.5px 5px;
            vertical-align: top;
        }
        .header-title {
            background-color: #0A3370 !important;
            color: white !important;
            font-weight: bold;
            font-size: 8.5pt;
            padding: 3px 5px;
        }
        .bg-label {
            background-color: #f1f5f9;
            font-weight: 600;
        }
        .font-bold {
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-emerald {
            color: #047857;
            font-weight: bold;
        }

        /* Penyesuaian saat benar-benar dicetak */
        @media print {
            body {
                background-color: white;
            }
            .page-container {
                box-shadow: none;
                margin: 0;
                padding: 1cm; /* Mengembalikan padding isi dokumen saat diprint */
                width: 100% !important;
                max-width: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="page-container" style="margin-top: 0; padding-top: 0;">
        <h2 style="margin-top: 0; margin-bottom: 20px;">FORM PRA-SURVEI</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <tr>
                <td colspan="4" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    A. DATA DEBITUR
                </td>
            </tr>
            <tr>
                <td class="bg-label" style="width: 22%; padding: 10px 14px; padding-left: 28px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nomor Register</td>
                <td style="width: 28%; padding: 10px 14px; border: 1px solid #0A3370 !important; font-weight: bold;">{{ $data->no_register ?? '-' }}</td>
                <td class="bg-label" style="width: 22%; padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nama Marketing</td>
                <td style="width: 28%; padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data?->user?->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">1. Nama Debitur</td>
                <td class="font-bold" style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->nama ?? '-' }}</td>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nama Pasangan</td>
                <td class="font-bold" style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->nama_pasangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding: 10px 14px; padding-left: 28px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Usia</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->usia ?? '-' }}</td>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Usia Pasangan</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->usia_pasangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">2. Usaha</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->usaha ?? '-' }}</td>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Lama Usaha</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->lama_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">3. Alamat Debitur</td>
                <td colspan="3" style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->alamat_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding: 10px 14px; padding-left: 28px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Alamat Domisili</td>
                <td colspan="3" style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->alamat_domisili ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">4. Plafon</td>
                <td class="font-bold text-black" style="padding: 10px 14px; border: 1px solid #0A3370 !important;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">JKW</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">{{ $data->jangka_waktu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" rowspan="2" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">5. Tujuan Penggunaan</td>
                <td rowspan="2" style="padding: 10px 14px; vertical-align: top; border: 1px solid #0A3370 !important;">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Angsuran</td>
                <td class="font-bold text-black" style="padding: 10px 14px; border: 1px solid #0A3370 !important;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Type Fasilitas</td>
                <td style="padding: 10px 14px; font-size: 10pt; border: 1px solid #0A3370 !important;">
                    {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                </td>
            </tr>
        </table>

                @php 
            $agunan =$data->agunan_tanah->first() ?? null; 
        @endphp

        <!-- B. DATA JAMINAN -->
        @if(isset($data->agunan_tanah) && $data->agunan_tanah->count() > 0)
            @foreach($data->agunan_tanah as $index => $agunan)
                @php
                    $urutanJaminan = $index + 1;

                    // Perhitungan Tanah
                    $luasTanah = $agunan->luas_tanah ?? 0;
                    $hargaTanah = $agunan->harga_tanah ?? 0;
                    $tanahPasar = $luasTanah * $hargaTanah;
                    $tanahTaksasi = $tanahPasar * 0.70;
                    $tanahLikuidasi = $tanahPasar * 0.50;

                    // Perhitungan Bangunan
                    $luasBangunan = $agunan->luas_bangunan ?? 0;
                    $hargaBangunan = $agunan->harga_bangunan ?? 0;
                    $bangunanPasar = $luasBangunan * $hargaBangunan;
                    $bangunanTaksasi = $bangunanPasar * 0.70;
                    $bangunanLikuidasi = $bangunanPasar * 0.50;
                @endphp

                <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px; margin-bottom: 12px;">
                    <!-- Header Utama -->
                    <tr>
                        <td colspan="6" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                            B. DATA JAMINAN {{ $data->agunan_tanah->count() > 1 ? 'KE-' . $urutanJaminan : '' }}
                        </td>
                    </tr>
                    
                    <!-- Kepemilikan -->
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px;">Kepemilikan</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px; font-weight: bold;">{{ $agunan->kepemilikan ?? '-' }}</td>
                    </tr>
                    
                    <!-- Alamat -->
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px;">Alamat</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ $agunan->alamat ?? '-' }}</td>
                    </tr>
                    
                    <!-- Share Loc -->
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px;">Share Loc</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px;">
                            @if(!empty($agunan->share_location) && $agunan->share_location !== '-')
                                <a href="{{ $agunan->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline; font-weight: 500;">
                                    📍 Lihat Lokasi di Peta
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>

                    <!-- TABEL RINCIAN NILAI JAMINAN (Kolom pertama disamakan menjadi 22%) -->
                    <tr class="bg-label text-center">
                        <td style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 10px;">Uraian</td>
                        <td style="width: 9%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 6px;">Luas (m2)</td>
                        <td style="width: 15%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 8px; white-space: nowrap;">Harga</td>
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 8px; white-space: nowrap;">Nilai Pasar</td>
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 8px; white-space: nowrap;">Nilai Taksasi</td>
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 8px; white-space: nowrap;">Nilai Likuidasi</td>
                    </tr>
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 14px;">Tanah</td>
                        <td class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 8px 6px;">{{ $agunan->luas_tanah ?? '-' }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 14px;">Bangunan</td>
                        <td class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 8px 6px;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="font-bold bg-label">
                        <td colspan="3" class="text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 10px;">TOTAL</td>
                        <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</td>
                        <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</td>
                        <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px 8px; white-space: nowrap;">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</td>
                    </tr>

                    <!-- Spesifikasi Jaminan -->
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px; vertical-align: top;">Spesifikasi Jaminan</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify;">{{ $agunan->spesifikasi ?? '-' }}</td>
                    </tr>
                    
                    <!-- Denah -->
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px; vertical-align: top;">Denah</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px;">
                            @if(!empty($agunan->denah) && $agunan->denah !== '-')
                                <div style="width: 100%; max-width: 380px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff;">
                                    <img src="{{ asset('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 100%; height: auto; display: block;">
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                    
                    <!-- Informasi Harga -->
                    <tr>
                        <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px; vertical-align: top;">Informasi Harga</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 0 !important;">
                            @php
                                $infoList = [
                                    $agunan->info_harga1 ?? '-',
                                    $agunan->info_harga2 ?? '-',
                                    $agunan->info_harga3 ?? '-'
                                ];
                            @endphp
                            <table style="width: 100%; border-collapse: collapse; border: none !important;">
                                @foreach($infoList as $infoIndex => $info)
                                    <tr>
                                        <td style="width: 8%; border-top: none; border-bottom: {{ $loop->last ? 'none' : '1px solid #d1d5db' }}; border-right: 1px solid #d1d5db; border-left: none; text-align: center; padding: 10px 14px; background-color: #f9fafb; font-weight: 500;">{{ $infoIndex + 1 }}</td>
                                        <td style="width: 92%; border-top: none; border-bottom: {{ $loop->last ? 'none' : '1px solid #d1d5db' }}; border-right: none; border-left: none; padding: 10px 14px; white-space: pre-line; text-align: justify;">{{ !empty(trim($info)) ? $info : '-' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            @endforeach
        @endif

        <!-- C. SLIK -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px; table-layout: fixed;">
            <tr>
                <td colspan="7" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    C. SLIK
                </td>
            </tr>
            <tr class="bg-label text-center">
                <td style="width: 21%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 8px;">Nama Bank</td>
                <td style="width: 11%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 8px;">Plafon</td>
                <td style="width: 11%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 8px;">Outstanding</td>
                <td style="width: 5%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 4px;">KOL</td>
                <td style="width: 11%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 8px;">Angsuran</td>
                <td style="width: 4%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 4px;">JKW</td>
                <td style="width: 37%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 8px;">Keterangan</td>
            </tr>
            @forelse($data->pinjaman ?? [] as $slik)
            <tr>
                <td style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 8px; word-wrap: break-word;">{{ $slik->nama_ljk ?? '-' }}</td>
                
                <!-- Plafon -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 8px 6px;">
                    <div style="text-align: right; padding-right: 4px; font-size: 9pt; color: #374151;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; white-space: nowrap;">{{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <!-- Outstanding -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 8px 6px;">
                    <div style="text-align: right; padding-right: 4px; font-size: 9pt; color: #374151;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; white-space: nowrap;">{{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 4px;">{{ $slik->kolekbilitas ?? $slik->kolektibilitas ?? '-' }}</td>
                
                <!-- Angsuran -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 8px 6px;">
                    <div style="text-align: right; padding-right: 4px; font-size: 9pt; color: #374151;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; white-space: nowrap;">{{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 4px;">{{ $slik->jkw ?? '-' }}</td>
                <td style="border: 1px solid #0A3370 !important; text-align: justify; padding: 10px 8px; word-wrap: break-word;">{{ $slik->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 14px;">Tidak ada data SLIK.</td>
            </tr>
            @endforelse
            
            <!-- Baris Total -->
            <tr class="font-bold bg-label">
                <td style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: center; font-weight: bold; padding: 10px 8px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">TOTAL</td>
                
                <!-- Total Plafon -->
                <td style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; vertical-align: middle; padding: 8px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    <div style="text-align: right; padding-right: 4px; font-size: 9pt; color: #374151; font-weight: bold;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; white-space: nowrap; font-weight: bold;">{{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <!-- Total Outstanding -->
                <td style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; vertical-align: middle; padding: 8px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    <div style="text-align: right; padding-right: 4px; font-size: 9pt; color: #374151; font-weight: bold;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; white-space: nowrap; font-weight: bold;">{{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: center; font-weight: bold; padding: 10px 4px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">-</td>
                
                <!-- Total Angsuran -->
                <td style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; vertical-align: middle; padding: 8px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    <div style="text-align: right; padding-right: 4px; font-size: 9pt; color: #374151; font-weight: bold;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; white-space: nowrap; font-weight: bold;">{{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td style="background-color: #f3f4f6 !important; border: 1px label !important; border: 1px solid #0A3370 !important; text-align: center; font-weight: bold; padding: 10px 4px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">-</td>
                <td style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: center; font-weight: bold; padding: 10px 8px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">-</td>
            </tr>
        </table>

        <!-- D. INFORMASI USAHA -->
        @php
            $omset = optional($data->infousaha)->omset_usaha ?? 0;
            $biaya = optional($data->infousaha)->biaya_operasional ?? 0;
            $penghasilanKotor = $omset - $biaya;
            $tambahan = optional($data->infousaha)->penghasilan_tambahan ?? 0;
            $totalPendapatan = $penghasilanKotor + $tambahan;
            $pengeluaranRT = optional($data->infousaha)->pengeluaran_rumah_tangga ?? 0;
            $penghasilanBersih = $totalPendapatan - $pengeluaranRT;
            $angsuranBankLain = optional($data->infousaha)->angsuran_bank_lain ?? 0;
            $sisaPenghasilan = $penghasilanBersih - $angsuranBankLain;
            $angsuranBpr = optional($data->infousaha)->angsuran_bpr ?? 0;
            $sisaPenghasilanBersih = $sisaPenghasilan - $angsuranBpr;
        @endphp

        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px;">
            <tr>
                <td colspan="6" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    D. INFORMASI USAHA
                </td>
            </tr>
            <tr>
                <td style="width: 5%; padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: center;">1.</td>
                <td style="width: 30%; padding: 10px 14px; border: 1px solid #0A3370 !important;">Omset Usaha</td>
                <td style="width: 6%; padding: 10px 14px; text-align: left; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none;">Rp</td>
                <td style="width: 19%; padding: 10px 14px; text-align: right; font-weight: normal; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; white-space: nowrap;">{{ number_format($omset, 0, ',', '.') }}</td>
                <td colspan="2" rowspan="12" style="vertical-align: top; padding: 12px 14px; width: 40%; background-color: #fff; border: 1px solid #0A3370 !important;">
                    <div class="font-bold" style="margin-bottom: 6px;">Deskripsi Usaha :</div>
                    <div style="white-space: pre-line; color: #333; font-size: 10pt; text-align: justify;">
                        {{ optional($data->infousaha)->deskripsi_usaha ?? '-' }}
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: center;">2.</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">Biaya Operasional</td>
                <td style="padding: 10px 14px; text-align: left; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; font-weight: normal; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; white-space: nowrap;">{{ number_format($biaya, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: center;"></td>
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Penghasilan Kotor</td>
                <td style="padding: 10px 14px; text-align: left; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; font-weight: bold; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">{{ number_format($penghasilanKotor, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: center;">3.</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">Penghasilan Tambahan</td>
                <td style="padding: 10px 14px; text-align: left; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; font-weight: normal; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; white-space: nowrap;">{{ number_format($tambahan, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: center;"></td>
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Total Pendapatan</td>
                <td style="padding: 10px 14px; text-align: left; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; font-weight: bold; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: center;">4.</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">Pengeluaran Rumah Tangga</td>
                <td style="padding: 10px 14px; text-align: left; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; font-weight: normal; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; white-space: nowrap;">{{ number_format($pengeluaranRT, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: center;"></td>
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Penghasilan Bersih</td>
                <td style="padding: 10px 14px; text-align: left; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; font-weight: bold; color: #000000 !important; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">{{ number_format($penghasilanBersih, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: center;">5.</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">Angsuran Bank Lain</td>
                <td style="padding: 10px 14px; text-align: left; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; font-weight: normal; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; white-space: nowrap;">{{ number_format($angsuranBankLain, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: center;"></td>
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Sisa Penghasilan</td>
                <td style="padding: 10px 14px; text-align: left; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; font-weight: bold; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: center;">6.</td>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important;">Angsuran BPR</td>
                <td style="padding: 10px 14px; text-align: left; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; font-weight: normal; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; white-space: nowrap;">{{ number_format($angsuranBpr, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: center;"></td>
                <td style="padding: 10px 14px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Sisa Penghasilan Bersih</td>
                <td style="padding: 10px 14px; text-align: left; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-left: 1px solid #0A3370 !important; border-right: none; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp</td>
                <td style="padding: 10px 14px; text-align: right; background-color: #f3f4f6 !important; border-top: 1px solid #0A3370 !important; border-bottom: 1px solid #0A3370 !important; border-right: 1px solid #0A3370 !important; border-left: none; font-weight: bold; color: #000000 !important; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- E. LEGALITAS -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px; margin-bottom: 12px;">
            <tr>
                <td style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    E. LEGALITAS
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: justify; color: #333; background-color: #FFFFFF !important; white-space: pre-line;">
                    @php
                        $listLegalitas = collect($data->agunan_tanah ?? [])->pluck('kepemilikan')->filter()->implode("\n");
                    @endphp
                    {{ !empty($listLegalitas) ? $listLegalitas : '-' }}
                </td>
            </tr>
        </table>

        <!-- F. CAPITAL -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px;">
            <tr>
                <td colspan="2" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    F. CAPITAL / ASET YANG DIMILIKI
                </td>
            </tr>
            @php 
                $capital = $data->capital;
                $asets = [
                    optional($capital)->aset1 ?? '-',
                    optional($capital)->aset2 ?? '-',
                    optional($capital)->aset3 ?? '-',
                    optional($capital)->aset4 ?? '-',
                    optional($capital)->aset5 ?? '-',
                ];
            @endphp
            @foreach($asets as $index => $aset)
            <tr>
                <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: left; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">ASET {{ $index + 1 }}</td>
                <td style="white-space: pre-line; border: 1px solid #0A3370 !important; padding: 10px 14px; text-align: justify;">{{ !empty(trim($aset)) ? $aset : '-' }}</td>
            </tr>
            @endforeach
        </table>

        <!-- G SAMPAI L. KELENGKAPAN BERKAS -->
        @php
            $sections = [
                ['title' => 'G. KELENGKAPAN BERKAS TAKE OVER', 'val' => optional($data->takeover)->berkas_take_over ?? null],
                ['title' => 'H. KELENGKAPAN DATA KTP', 'val' => optional($data->datalengkap)->ktp ?? null],
                ['title' => 'I. KELENGKAPAN DATA SLIK', 'val' => optional($data->datalengkap)->slik ?? null],
                ['title' => 'J. KELENGKAPAN DATA KARTU KELUARGA', 'val' => optional($data->datalengkap)->kk ?? null],
                ['title' => 'K. KELENGKAPAN DATA SURAT NIKAH', 'val' => optional($data->datalengkap)->surat_nikah ?? null],
                ['title' => 'L. KELENGKAPAN DATA BADAN USAHA', 'val' => optional($data->badanusaha)->berkas_badan_usaha ?? null],
            ];
        @endphp

        @foreach($sections as $sec)
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px;">
            <tr>
                <td style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    {{ $sec['title'] }}
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 14px; white-space: pre-line; border: 1px solid #0A3370 !important; text-align: justify;">
                    @php 
                        $val = $sec['val'];
                        if (is_string($val)) {
                            $decoded = json_decode($val, true);
                            if (json_last_error() === JSON_ERROR_NONE) $val = $decoded;
                        }
                    @endphp
                    {{ is_array($val) ? implode(', ', $val) : ($val ?? '-') }}
                </td>
            </tr>
        </table>
        @endforeach
    </div>

</body>
</html>