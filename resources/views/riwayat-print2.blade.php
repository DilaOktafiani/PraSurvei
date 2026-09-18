<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Survei - {{ $data->nama ?? '-' }}</title>
    <style>
        @page {
            size: auto;
            margin: 1.5cm 1cm 1.5cm 1cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #111;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            background-color: #555;
        }

        .page-container {
            width: 100%;
            max-width: 210mm;
            min-height: 100vh;
            padding: 10mm;
            margin: 20px auto;
            background: white;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        h2.main-title {
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
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        table.export-table td, table.export-table th {
            border: 1px solid #0A3370;
            padding: 3px 5px;
            vertical-align: top;
        }

        .section-header {
            background-color: #0A3370 !important;
            color: #FFFFFF !important;
            font-weight: bold;
            font-size: 8.5pt;
            padding: 5px 8px;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .sub-header {
            background-color: #e5e7eb !important;
            font-weight: bold;
            color: #0A3370;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .bg-label {
            background-color: #f3f4f6 !important;
            font-weight: 600;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
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

        .whitespace-pre {
            white-space: pre-line;
        }

        @media print {
            body {
                background-color: white;
            }
            .page-container {
                box-shadow: none;
                margin: 0;
                padding: 0;
                width: 100% !important;
                max-width: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="page-container">
        <h2 class="main-title">FORM SURVEI</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th colspan="12" class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
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
                    <td colspan="3" class="font-bold" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->nama ?? '-' }}</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nama Marketing</td>
                    <td colspan="2" style="padding: 10px 14px; font-weight: normal; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->nama_marketing ?? '-' }}</td>
                </tr>
                <!-- Tanggal OTS -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;"></td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Tanggal OTS</td>
                    <td colspan="8" style="padding: 10px 14px; font-weight: normal; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->tanggal_ots ?? '-' }}</td>
                </tr>
                <!-- Plafon & JKW -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">2</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Plafon</td>
                    <td colspan="3" class="font-bold" style="padding: 10px 14px; color: #000000; border: 1px solid #0A3370 !important; line-height: 1.5;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">JKW</td>
                    <td colspan="2" class="font-normal" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->jangka_waktu ?? '-' }}</td>
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
                    <td colspan="8" class="font-bold" style="padding: 10px 14px; color: #000000; border: 1px solid #0A3370 !important; line-height: 1.5;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
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
                    <td colspan="8" style="padding: 10px 14px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->temuan_ca ?? '-' }}</td>
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

                <table class="export-table" style="width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #0A3370 !important; margin-top: 12px; margin-bottom: 12px;">
                    <thead>
                        <tr>
                            <th colspan="6" class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                                B. Agunan {{ $data->agunan_tanah->count() > 1 ? 'Ke-' . $urutanJaminan : '' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sub Header JAMINAN -->
                        <tr>
                            <td colspan="6" class="sub-header" style="text-align: left; background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Jaminan</td>
                        </tr>
                        <!-- Kepemilikan -->
                        <tr>
                            <td colspan="2" class="bg-label" style="width: 25%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Kepemilikan</td>
                            <td colspan="4" class="font-bold" style="width: 75%; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $agunan->kepemilikan ?? '-' }}</td>
                        </tr>
                        <!-- Alamat -->
                        <tr>
                            <td colspan="2" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Alamat</td>
                            <td colspan="4" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $agunan->alamat ?? '-' }}</td>
                        </tr>
                        <!-- Share Loc -->
                        <tr>
                            <td colspan="2" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Share Loc</td>
                            <td colspan="4" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">
                                @if(!empty($agunan->share_location) && $agunan->share_location !== '-')
                                    <a href="{{ $agunan->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline;">
                                        📍 Lihat Lokasi di Peta
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Sub Header COLLATERAL -->
                        <tr>
                            <td colspan="6" class="sub-header" style="text-align: left; background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Collateral</td>
                        </tr>
                        <!-- Header Kolom Collateral -->
                        <tr class="sub-header" style="text-align: center; background-color: #f9fafb !important; color: #000000 !important;">
                            <td style="width: 25%; font-weight: bold; color: #000000; padding: 10px 8px; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Uraian</td>
                            <td style="width: 10%; font-weight: bold; color: #000000; padding: 10px 8px; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Luas (m2)</td>
                            <td style="width: 15%; font-weight: bold; text-align: right; color: #000000; padding: 10px 8px; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Harga</td>
                            <td style="width: 16%; font-weight: bold; text-align: right; color: #000000; padding: 10px 8px; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nilai Pasar</td>
                            <td style="width: 17%; font-weight: bold; text-align: right; color: #000000; padding: 10px 8px; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nilai Taksasi</td>
                            <td style="width: 17%; font-weight: bold; text-align: right; color: #000000; padding: 10px 8px; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nilai Likuidasi</td>
                        </tr>
                        <!-- Baris Tanah -->
                        <tr>
                            <td class="bg-label font-bold" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Tanah</td>
                            <td class="text-center" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: center; line-height: 1.5;">{{ $agunan->luas_tanah ?? '-' }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</td>
                        </tr>
                        <!-- Baris Bangunan -->
                        <tr>
                            <td class="bg-label font-bold" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Bangunan</td>
                            <td class="text-center" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: center; line-height: 1.5;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5;">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</td>
                        </tr>
                        <!-- Total Collateral -->
                        <tr class="font-bold bg-label">
                            <td colspan="3" style="text-align: center; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Total</td>
                            <td class="text-right" style="padding: 10px 8px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</td>
                            <td class="text-right" style="padding: 10px 8px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</td>
                        </tr>

                        <!-- Denah -->
                        <tr>
                            <td colspan="2" class="bg-label" style="vertical-align: middle; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Denah</td>
                            <td colspan="4" style="padding: 12px; border: 1px solid #0A3370 !important; line-height: 1.5;">
                                @if(!empty($agunan->denah) && $agunan->denah !== '-')
                                    <div style="width: 100%; max-width: 380px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff;">
                                        <img src="{{ asset('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 100%; height: auto; display: block;">
                                    </div>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Spesifikasi Jaminan -->
                        <tr>
                            <td colspan="2" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Spesifikasi Jaminan</td>
                            <td colspan="4" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $agunan->spesifikasi ?? '-' }}</td>
                        </tr>

                        <!-- Sub Header INFORMASI HARGA -->
                        <tr>
                            <td colspan="6" class="sub-header" style="text-align: left; background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Informasi Harga</td>
                        </tr>
                        <!-- Informasi Harga 1 -->
                        <tr>
                            <td class="bg-label text-center" style="width: 8%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">1</td>
                            <td colspan="5" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $agunan->info_harga1 ?? '-' }}</td>
                        </tr>
                        <!-- Informasi Harga 2 -->
                        <tr>
                            <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">2</td>
                            <td colspan="5" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $agunan->info_harga2 ?? '-' }}</td>
                        </tr>
                        <!-- Informasi Harga 3 -->
                        <tr>
                            <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">3</td>
                            <td colspan="5" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $agunan->info_harga3 ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        @endif

        <!-- C. ANALISIS JAMINAN -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        C. Analisis Jaminan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->analisis_jaminan->analisis_jaminan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- D. ANALISIS SLIK -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th colspan="12" class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        D. Analisis SLIK
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- D.1 Penghasilan Utama -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">D.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Informasi Penghasilan Utama menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->capacity->informasi_penghasilan_utama ?? '-' }}</td>
                </tr>
                <!-- D.2 Penghasilan Pendukung -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">D.2</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Informasi Penghasilan Pendukung menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->capacity->informasi_penghasilan_pendukung ?? '-' }}</td>
                </tr>
                <!-- D.3 Pengeluaran Rumah Tangga -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">D.3</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Pengeluaran Rumah Tangga</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">Rp {{ number_format($data->capacity->pengeluaran_rumah_tangga ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- D.3 Angsuran Bank Lain -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;"></td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Angsuran Bank Lain</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">Rp {{ number_format($data->capacity->angsuran_bank_lain ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- D.3 Angsuran BPR -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;"></td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Angsuran BPR</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">Rp {{ number_format($data->capacity->angsuran_bpr ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- D.4 Analisis Kapasitas CA -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">D.4</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Analisis Kapasitas CA</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->capacity->analisis_kapasitas ?? '-' }}</td>
                </tr>
                <!-- D.5 Kelengkapan Berkas -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">D.5</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Kelengkapan Berkas</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">
                        @if(is_array($data->capacity->kelengkapan_berkas ?? null))
                            @foreach($data->capacity->kelengkapan_berkas as $item)
                                <div style="margin-bottom: 4px;">{{ $item }}</div>
                            @endforeach
                        @else
                            {{ $data->capacity->kelengkapan_berkas ?? '-' }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- E. DESKRIPSI USAHA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        E. Deskripsi Usaha
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->capacity->deskripsi_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- F. ANALISIS CAPITAL -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        F. Analisis Capital
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->capital->analisis_aset ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- G. ANALISIS TAKE OVER -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        G. Analisis Take Over
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->kondisi->analisis_take_over ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- H. ANALISIS KELENGKAPAN BERKAS -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        H. Analisis Kelengkapan Berkas
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- I. ANALISIS BADAN USAHA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        I. Analisis Badan Usaha
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->badanusaha->analisa_badan_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- J. ANALISIS SWOT -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; table-layout: fixed; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th colspan="12" class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        J. Analisis SWOT
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- J.1 Strengths (Kekuatan) -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">J.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%; padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Strengths (Kekuatan)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->swot->kekuatan ?? '-' }}</td>
                </tr>
                <!-- J.2 Weaknesses (Kelemahan) dan Mitigasi -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">J.2</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Weaknesses (Kelemahan) dan Mitigasi</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->swot->kelemahan ?? '-' }}</td>
                </tr>
                <!-- J.3 Opportunities (Peluang) -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">J.3</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Opportunities (Peluang)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->swot->peluang ?? '-' }}</td>
                </tr>
                <!-- J.4 Threats (Ancaman) -->
                <tr>
                    <td class="bg-label text-center" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">J.4</td>
                    <td colspan="3" class="bg-label" style="padding: 10px 12px; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; line-height: 1.5; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Threats (Ancaman)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify; padding: 10px 14px; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->swot->ancaman ?? '-' }}</td>
                </tr>
                <!-- Sub Header Kesimpulan -->
                <tr>
                    <td colspan="12" class="sub-header" style="text-align: left; background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; font-size: 10.5pt; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Kesimpulan</td>
                </tr>
                <!-- Isi Kesimpulan -->
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 12px 16px; font-weight: normal; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->swot->kesimpulan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- K. REKOMENDASI -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        K. Rekomendasi
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->swot->rekomendasi ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- L. SYARAT DAN CATATAN LAINNYA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <thead>
                <tr>
                    <th class="section-header" style="text-align: left; background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; font-size: 11pt; padding: 12px 18px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        L. Syarat dan Catatan Lainnya
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="whitespace-pre" style="padding: 12px 16px; text-align: justify; border: 1px solid #0A3370 !important; line-height: 1.5;">{{ $data->swot->syarat_catatan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>