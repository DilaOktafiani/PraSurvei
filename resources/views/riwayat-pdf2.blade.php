<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Survei - {{ $data->nama ?? '-' }}</title>
    <style>
        @page {
            size: A4;
            margin: 10mm 12mm 10mm 12mm; /* Mengatur margin kertas langsung dari PDF-nya */
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #111;
            line-height: 1.15;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .page-container {
            width: 100%;
            background: white;
        }
        h2 {
            text-align: center;
            font-size: 12pt;
            margin: 0 0 15px 0;
            color: #0A3370;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table.export-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            page-break-inside: avoid;
        }
        table.export-table td, table.export-table th {
            border: 1px solid #444444;
            padding: 3px 5px;
            vertical-align: top;
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
    </style>
</head>

<body>

    <div class="page-container">
        <h2 class="main-title">FORM SURVEI</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <!-- Background biru dengan ukuran font dan padding yang seragam -->
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-align: left; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        A. Data Debitur
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Nomor Register -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;"></td>
                    <td colspan="3" class="bg-label" style="width: 25%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nomor Register</td>
                    <td colspan="8" class="font-bold" style="width: 67%; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->no_register ?? '-' }}</td>
                </tr>
                <!-- Nama Debitur & Marketing -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">1</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nama Debitur</td>
                    <td colspan="4" class="font-bold" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->nama ?? '-' }}</td>
                    <td colspan="2" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nama Marketing</td>
                    <td colspan="2" style="font-weight: normal; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->nama_marketing ?? '-' }}</td>
                </tr>
                <!-- Tanggal OTS -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;"></td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Tanggal OTS</td>
                    <td colspan="8" style="font-weight: normal; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->tanggal_ots ?? '-' }}</td>
                </tr>
                <!-- Plafon & JKW -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">2</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Plafon</td>
                    <td colspan="4" style="font-weight: bold; color: #000000; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">JKW</td>
                    <td colspan="2" style="font-weight: normal; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->jangka_waktu ?? '-' }}</td>
                </tr>
                <!-- Tujuan Penggunaan -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">3</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Tujuan Penggunaan</td>
                    <td colspan="8" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                </tr>
                <!-- Estimasi Kewajiban -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">4</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Estimasi Kewajiban</td>
                    <td colspan="8" style="font-weight: bold; color: #000000; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- Type Fasilitas -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">5</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Type Fasilitas</td>
                    <td colspan="8" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">
                        {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                    </td>
                </tr>
                <!-- Temuan CA -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">6</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Temuan CA</td>
                    <td colspan="8" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->temuan_ca ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- B. AGUNAN -->
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

                <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 12px; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                                B. Agunan {{ $data->agunan_tanah->count() > 1 ? 'Ke-' . $urutanJaminan : '' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sub Header JAMINAN -->
                        <tr>
                            <td colspan="12" style="background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px; text-align: left;">Jaminan</td>
                        </tr>
                        
                        <!-- Kepemilikan -->
                        <tr>
                            <td colspan="3" class="bg-label" style="width: 25%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Kepemilikan</td>
                            <td colspan="9" style="width: 75%; border: 1px solid #0A3370 !important; padding: 10px 14px; font-weight: bold; line-height: 1.5;">{{ $agunan->kepemilikan ?? '-' }}</td>
                        </tr>
                        
                        <!-- Alamat -->
                        <tr>
                            <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Alamat</td>
                            <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 10px 14px; line-height: 1.5;">{{ $agunan->alamat ?? '-' }}</td>
                        </tr>
                        
                        <!-- Share Loc -->
                        <tr>
                            <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Share Loc</td>
                            <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 10px 14px; line-height: 1.5;">
                                @if(!empty($agunan->share_location) && $agunan->share_location !== '-')
                                    <a href="{{ $agunan->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline; font-weight: 500;">
                                        📍 Lihat Lokasi di Peta
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Sub Header COLLATERAL -->
                        <tr>
                            <td colspan="12" style="background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px; text-align: left;">Collateral</td>
                        </tr>

                        <!-- TABEL RINCIAN NILAI JAMINAN -->
                        <tr class="sub-header" style="text-align: center; background-color: #f9fafb; color: #000000;">
                            <td colspan="2" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; color: #000000; line-height: 1.5;">Uraian</td>
                            <td colspan="1" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; color: #000000; line-height: 1.5;">Luas (m2)</td>
                            <td colspan="2" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; color: #000000; line-height: 1.5;">Harga</td>
                            <td colspan="2" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; color: #000000; line-height: 1.5;">Nilai Pasar</td>
                            <td colspan="2" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; color: #000000; line-height: 1.5;">Nilai Taksasi</td>
                            <td colspan="3" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; color: #000000; line-height: 1.5;">Nilai Likuidasi</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="bg-label font-bold" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Tanah</td>
                            <td colspan="1" class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 12px; line-height: 1.5;">{{ $agunan->luas_tanah ?? '-' }}</td>
                            <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</td>
                            <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</td>
                            <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</td>
                            <td colspan="3" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="bg-label font-bold" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Bangunan</td>
                            <td colspan="1" class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 12px; line-height: 1.5;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                            <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</td>
                            <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</td>
                            <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</td>
                            <td colspan="3" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="font-bold bg-label">
                            <td colspan="5" class="text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">TOTAL</td>
                            <td colspan="2" class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</td>
                            <td colspan="2" class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</td>
                            <td colspan="3" class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; line-height: 1.5;">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</td>
                        </tr>

                        <!-- Denah -->
                        <tr>
                            <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: middle; line-height: 1.5;">Denah</td>
                            <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 10px 14px; line-height: 1.5;">
                                @if(!empty($agunan->denah) && $agunan->denah !== '-')
                                    <div style="width: 100%; max-width: 380px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff;">
                                        <img src="{{ public_path('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 100%; height: auto; display: block;">
                                    </div>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Spesifikasi Jaminan -->
                        <tr>
                            <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Spesifikasi Jaminan</td>
                            <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; line-height: 1.5;">{{ $agunan->spesifikasi ?? '-' }}</td>
                        </tr>

                        <!-- Sub Header INFORMASI HARGA -->
                        <tr>
                            <td colspan="12" style="background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px; text-align: left;">Informasi Harga</td>
                        </tr>
                        <!-- Informasi Harga 1 -->
                        <tr>
                            <td class="bg-label text-center" style="width: 8%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">1</td>
                            <td colspan="11" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $agunan->info_harga1 ?? '-' }}</td>
                        </tr>
                        <!-- Informasi Harga 2 -->
                        <tr>
                            <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">2</td>
                            <td colspan="11" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $agunan->info_harga2 ?? '-' }}</td>
                        </tr>
                        <!-- Informasi Harga 3 -->
                        <tr>
                            <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">3</td>
                            <td colspan="11" style="border: 1px solid #0A370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $agunan->info_harga3 ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        @endif

        <!-- C. ANALISIS JAMINAN -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-align: left; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        C. Analisis Jaminan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->analisis_jaminan->analisis_jaminan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- D. ANALISIS SLIK -->
        @php
            $capacity = $data->capacity ?? $data->dataslik ?? null;
        @endphp
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        D. Analisis SLIK
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- D.1 Penghasilan Utama -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">D.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Informasi Penghasilan Utama menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $capacity->informasi_penghasilan_utama ?? $capacity->penghasilan_utama ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                
                <!-- D.2 Penghasilan Pendukung -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">D.2</td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Informasi Penghasilan Pendukung menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $capacity->informasi_penghasilan_pendukung ?? $capacity->penghasilan_pendukung ?? $data->analisis_slik ?? '-' }}</td>
                </tr>

                <!-- D.3 Pengeluaran Rumah Tangga -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: middle; text-align: center; line-height: 1.5;">D.3</td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: middle; line-height: 1.5;">Pengeluaran Rumah Tangga</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; vertical-align: middle; line-height: 1.5;">
                        @php $valD3 = $capacity->pengeluaran_rumah_tangga ?? 0; @endphp
                        Rp {{ is_numeric($valD3) ? number_format($valD3, 0, ',', '.') : $valD3 }}
                    </td>
                </tr>

                <!-- D.3 Angsuran Bank Lain -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: middle; text-align: center; line-height: 1.5;"></td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: middle; line-height: 1.5;">Angsuran Bank Lain</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; vertical-align: middle; line-height: 1.5;">
                        @php $valBankLain = $capacity->angsuran_bank_lain ?? 0; @endphp
                        Rp {{ is_numeric($valBankLain) ? number_format($valBankLain, 0, ',', '.') : $valBankLain }}
                    </td>
                </tr>

                <!-- D.3 Angsuran BPR -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: middle; text-align: center; line-height: 1.5;"></td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: middle; line-height: 1.5;">Angsuran BPR</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; vertical-align: middle; line-height: 1.5;">
                        @php $valBPR = $capacity->angsuran_bpr ?? 0; @endphp
                        Rp {{ is_numeric($valBPR) ? number_format($valBPR, 0, ',', '.') : $valBPR }}
                    </td>
                </tr>

                <!-- D.4 Analisis Kapasitas CA -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">D.4</td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Analisis Kapasitas CA</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $capacity->analisis_kapasitas ?? $capacity->analisis_kapasitas_ca ?? $data->analisis_slik ?? '-' }}</td>
                </tr>

                <!-- D.5 Kelengkapan Berkas -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">D.5</td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Kelengkapan Berkas</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; vertical-align: top; text-align: justify; text-justify: inter-word; line-height: 1.5;">
                        @if(!empty($capacity->kelengkapan_berkas))
                            @if(is_array($capacity->kelengkapan_berkas))
                                @foreach($capacity->kelengkapan_berkas as $item)
                                    <div>{{ $item }}</div>
                                @endforeach
                            @else
                                {{ $capacity->kelengkapan_berkas }}
                            @endif
                        @else
                            {{ $data->analisis_slik ?? '-' }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- E. DESKRIPSI USAHA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        E. Deskripsi Usaha
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->capacity->deskripsi_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- F. ANALISIS CAPITAL -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        F. Analisis Capital
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->capital->analisis_aset ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- G. ANALISIS TAKE OVER -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        G. Analisis Take Over
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->kondisi->analisis_take_over ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- H. ANALISIS KELENGKAPAN BERKAS -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        H. Analisis Kelengkapan Berkas
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- I. ANALISIS BADAN USAHA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        I. Analisis Badan Usaha
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->badanusaha->analisa_badan_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- J. ANALISIS SWOT -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        J. Analisis SWOT
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- J.1 Strengths (Kekuatan) -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">J.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Strengths (Kekuatan)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->swot->kekuatan ?? '-' }}</td>
                </tr>
                <!-- J.2 Weaknesses (Kelemahan) dan Mitigasi -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">J.2</td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Weaknesses (Kelemahan) dan Mitigasi</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->swot->kelemahan ?? '-' }}</td>
                </tr>
                <!-- J.3 Opportunities (Peluang) -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">J.3</td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Opportunities (Peluang)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->swot->peluang ?? '-' }}</td>
                </tr>
                <!-- J.4 Threats (Ancaman) -->
                <tr>
                    <td class="bg-label text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; text-align: center; line-height: 1.5;">J.4</td>
                    <td colspan="3" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 12px; vertical-align: top; line-height: 1.5;">Threats (Ancaman)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->swot->ancaman ?? '-' }}</td>
                </tr>
                <!-- Sub Header Kesimpulan -->
                <tr>
                    <td colspan="12" class="sub-header" style="text-align: left; background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 10px 14px;">Kesimpulan</td>
                </tr>
                <!-- Isi Kesimpulan -->
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->swot->kesimpulan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- K. REKOMENDASI -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        K. Rekomendasi
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->swot->rekomendasi ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- L. SYARAT DAN CATATAN LAINNYA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        L. Syarat dan Catatan Lainnya
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 12px 16px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top; line-height: 1.5;">{{ $data->swot->syarat_catatan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>