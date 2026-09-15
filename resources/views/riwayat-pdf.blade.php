<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pra Survei - {{ $data->nama ?? '-' }}</title>
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
            font-size: 11pt;
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
        <h2>FORM PRA-SURVEI</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px; margin-bottom: 12px;">
            <tr>
                <td colspan="4" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    A. DATA DEBITUR
                </td>
            </tr>
            <tr>
                <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding-left: 28px;">Nomor Register</td>
                <td style="width: 28%; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px;">{{ $data->no_register ?? '-' }}</td>
                <td class="bg-label" style="width: 22%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nama Marketing</td>
                <td style="width: 28%; border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ $data->nama_marketing ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">1. Nama Debitur</td>
                <td class="font-bold" style="border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px;">{{ $data->nama ?? '-' }}</td>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nama Pasangan</td>
                <td class="font-bold" style="border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px;">{{ $data->nama_pasangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding-left: 28px;">Usia</td>
                <td style="border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ $data->usia ?? '-' }}</td>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Usia Pasangan</td>
                <td style="border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ $data->usia_pasangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">2. Usaha</td>
                <td style="border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ $data->usaha ?? '-' }}</td>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Lama Usaha</td>
                <td style="border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ $data->lama_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">3. Alamat Debitur</td>
                <td colspan="3" class="font-normal" style="border: 1px solid #0A3370 !important; padding: 10px 14px; text-align: justify;">{{ $data->alamat_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding-left: 28px;">Alamat Domisili</td>
                <td colspan="3" class="font-normal" style="border: 1px solid #0A3370 !important; padding: 10px 14px; text-align: justify;">{{ $data->alamat_domisili ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">4. Plafon</td>
                <td class="font-bold text-black" style="border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; white-space: nowrap;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">JKW</td>
                <td style="border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ $data->jangka_waktu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" rowspan="2" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; vertical-align: top; -webkit-print-color-adjust: exact; print-color-adjust: exact;">5. Tujuan Penggunaan</td>
                <td rowspan="2" style="border: 1px solid #0A3370 !important; padding: 10px 14px; vertical-align: top; text-align: justify;">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Angsuran</td>
                <td class="font-bold text-black" style="border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; white-space: nowrap;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Type Fasilitas</td>
                <td style="border: 1px solid #0A3370 !important; padding: 10px 14px;">{{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}</td>
            </tr>
        </table>

        @php $agunan = $data->agunan_tanah->first() ?? null; @endphp

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

                <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 12px; margin-bottom: 12px; table-layout: fixed;">
                    <!-- Header Utama / Nomor Jaminan -->
                    <tr>
                        <td colspan="6" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 10px 14px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                            B. DATA {{ $data->agunan_tanah->count() > 1 ? 'JAMINAN KE-' . $urutanJaminan : '' }}
                        </td>
                    </tr>
                    
                    <!-- Kepemilikan -->
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Kepemilikan</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px; font-weight: bold;">{{ $agunan->kepemilikan ?? '-' }}</td>
                    </tr>
                    
                    <!-- Alamat -->
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Alamat</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px; text-align: justify;">{{ $agunan->alamat ?? '-' }}</td>
                    </tr>
                    
                    <!-- Share Loc -->
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Share Loc</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px;">
                            @if(!empty($agunan->share_location) && $agunan->share_location !== '-')
                                <a href="{{ $agunan->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline; font-weight: 500;">
                                    Lihat Lokasi di Peta
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>

                    <!-- TABEL RINCIAN NILAI JAMINAN (Lebar kolom Uraian disamakan 18% agar sejajar dengan Kepemilikan/Alamat) -->
                    <tr class="bg-label text-center">
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; padding: 10px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Uraian</td>
                        <td style="width: 10%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; padding: 10px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Luas (m2)</td>
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; padding: 10px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Harga</td>
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; padding: 10px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nilai Pasar</td>
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; padding: 10px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nilai Taksasi</td>
                        <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; padding: 10px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Nilai Likuidasi</td>
                    </tr>
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Tanah</td>
                        <td class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 6px;">{{ $agunan->luas_tanah ?? '-' }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Bangunan</td>
                        <td class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 10px 6px;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</td>
                        <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 10px 6px; white-space: nowrap;">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="font-bold bg-label">
                        <td colspan="3" class="text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; padding: 10px 6px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">TOTAL</td>
                        <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; padding: 10px 6px; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</td>
                        <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; padding: 10px 6px; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</td>
                        <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; padding: 10px 6px; white-space: nowrap; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</td>
                    </tr>

                    <!-- Spesifikasi Jaminan -->
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; vertical-align: top; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Spesifikasi Jaminan</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word;">{{ $agunan->spesifikasi ?? '-' }}</td>
                    </tr>

                    <!-- Denah -->
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; vertical-align: top; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Denah</td>
                        <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 10px 14px;">
                            @if(!empty($agunan->denah) && $agunan->denah !== '-')
                                <div style="width: 100%; max-width: 400px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff;">
                                    <img src="{{ public_path('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 100%; height: auto; display: block;">
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Informasi Harga -->
                    <tr>
                        <td class="bg-label" style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; padding: 10px 14px; vertical-align: top; -webkit-print-color-adjust: exact; print-color-adjust: exact;">Informasi Harga</td>
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
                                        <td style="width: 10%; border-top: {{ $loop->first ? 'none' : '1px solid #0A3370' }}; border-bottom: {{ $loop->last ? 'none' : '1px solid #0A3370' }}; border-right: 1px solid #0A3370; border-left: none; text-align: center; padding: 10px 14px; background-color: #f9fafb; font-weight: 500;">{{ $infoIndex + 1 }}</td>
                                        <td style="width: 90%; border-top: {{ $loop->first ? 'none' : '1px solid #0A3370' }}; border-bottom: {{ $loop->last ? 'none' : '1px solid #0A3370' }}; border-right: none; border-left: none; padding: 10px 14px; white-space: pre-line; text-align: justify; text-justify: inter-word;">{{ !empty(trim($info)) ? $info : '-' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            @endforeach
        @endif

        <!-- C. SLIK -->
        <table class="export-table" style="margin-top: 8px; table-layout: fixed; width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important;">
            <tr>
                <td colspan="7" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 8px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    C. SLIK
                </td>
            </tr>
            <tr class="bg-label text-center">
                <td style="width: 21%; text-align: center; font-size: 10pt; font-weight: bold; padding: 6px 4px; border: 1px solid #0A3370 !important;">Nama Bank</td>
                <td style="width: 11%; text-align: center; font-size: 10pt; font-weight: bold; padding: 6px 4px; border: 1px solid #0A3370 !important;">Plafon</td>
                <td style="width: 11%; text-align: center; font-size: 10pt; font-weight: bold; padding: 6px 4px; border: 1px solid #0A3370 !important;">Outstanding</td>
                <td style="width: 5%; text-align: center; font-size: 10pt; font-weight: bold; padding: 6px 2px; border: 1px solid #0A3370 !important;">KOL</td>
                <td style="width: 11%; text-align: center; font-size: 10pt; font-weight: bold; padding: 6px 4px; border: 1px solid #0A3370 !important;">Angsuran</td>
                <td style="width: 4%; text-align: center; font-size: 10pt; font-weight: bold; padding: 6px 2px; border: 1px solid #0A3370 !important;">JKW</td>
                <td style="width: 36%; text-align: center; font-size: 10pt; font-weight: bold; padding: 6px 4px; border: 1px solid #0A3370 !important;">Keterangan</td>
            </tr>
            @forelse($data->pinjaman ?? [] as $slik)
            <tr>
                <td class="text-center" style="border: 1px solid #0A3370 !important; word-wrap: break-word; font-size: 10pt; padding: 6px 4px;">{{ $slik->nama_ljk ?? '-' }}</td>
                
                <!-- Plafon -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 6px 4px;">
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; white-space: nowrap;">{{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <!-- Outstanding -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 6px 4px;">
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; white-space: nowrap;">{{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td class="text-center" style="border: 1px solid #0A3370 !important; font-size: 10pt; padding: 6px 2px;">{{ $slik->kolekbilitas ?? $slik->kolektibilitas ?? '-' }}</td>
                
                <!-- Angsuran -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 6px 4px;">
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; white-space: nowrap;">{{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td class="text-center" style="border: 1px solid #0A3370 !important; font-size: 10pt; padding: 6px 2px;">{{ $slik->jkw ?? '-' }}</td>
                <td class="text-center" style="border: 1px solid #0A3370 !important; word-wrap: break-word; font-size: 10pt; padding: 6px 4px;">{{ $slik->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center" style="border: 1px solid #0A3370 !important; font-size: 10pt; padding: 8px;">Tidak ada data SLIK.</td></tr>
            @endforelse
            
            <!-- Baris Total -->
            <tr class="font-bold bg-label">
                <td class="text-center" style="border: 1px solid #0A3370 !important; font-size: 10pt; font-weight: bold; padding: 6px 4px; background-color: #f3f4f6 !important;">TOTAL</td>
                
                <!-- Total Plafon -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 6px 4px; background-color: #f3f4f6 !important;">
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; font-weight: bold;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; font-weight: bold; white-space: nowrap;">{{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <!-- Total Outstanding -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 6px 4px; background-color: #f3f4f6 !important;">
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; font-weight: bold;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; font-weight: bold; white-space: nowrap;">{{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td class="text-center" style="border: 1px solid #0A3370 !important; font-size: 10pt; font-weight: bold; padding: 6px 2px; background-color: #f3f4f6 !important;">-</td>
                
                <!-- Total Angsuran -->
                <td style="border: 1px solid #0A3370 !important; vertical-align: middle; padding: 6px 4px; background-color: #f3f4f6 !important;">
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; font-weight: bold;">Rp</div>
                    <div style="text-align: right; padding-right: 4px; font-size: 10pt; font-weight: bold; white-space: nowrap;">{{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</div>
                </td>
                
                <td class="text-center" style="border: 1px solid #0A3370 !important; font-size: 10pt; font-weight: bold; padding: 6px 2px; background-color: #f3f4f6 !important;">-</td>
                <td class="text-center" style="border: 1px solid #0A3370 !important; font-size: 10pt; font-weight: bold; padding: 6px 4px; background-color: #f3f4f6 !important;">-</td>
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

        <table class="export-table" style="margin-top: 8px;">
            <tr>
                <td colspan="6" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 7px 10px; text-transform: uppercase;">D. INFORMASI USAHA</td>
            </tr>
            <tr>
                <td style="width: 4%; text-align: center; padding: 8px 4px;">1.</td>
                <td style="width: 31%; font-weight: normal; padding: 8px 6px;">Omset Usaha</td>
                <td style="width: 5%; border-right: none; font-weight: normal; padding: 8px 4px;">Rp</td>
                <td style="width: 20%; text-align: right; font-weight: normal; border-left: none; padding: 8px 6px;">{{ number_format($omset, 0, ',', '.') }}</td>
                <td colspan="2" rowspan="11" style="vertical-align: top; width: 40%; background: #fff; padding: 8px 10px;">
                    <div class="font-bold" style="padding-bottom: 2px; margin-bottom: 6px; padding-top: 2px;">Deskripsi Usaha :</div>
                    <div style="white-space: pre-line; font-size: 10pt; text-align: justify;">{{ optional($data->infousaha)->deskripsi_usaha ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal; padding: 8px 4px;">2.</td>
                <td style="font-weight: normal; padding: 8px 6px;">Biaya Operasional</td>
                <td style="border-right: none; font-weight: normal; padding: 8px 4px;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none; padding: 8px 6px;">{{ number_format($biaya, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal; padding: 8px 4px;"></td>
                <td class="text-black font-bold" style="padding: 8px 6px;">Penghasilan Kotor</td>
                <td style="border-right: none; padding: 8px 4px;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none; padding: 8px 6px;" class="text-black font-bold">{{ number_format($penghasilanKotor, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal; padding: 8px 4px;">3.</td>
                <td style="font-weight: normal; padding: 8px 6px;">Penghasilan Tambahan</td>
                <td style="border-right: none; font-weight: normal; padding: 8px 4px;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none; padding: 8px 6px;">{{ number_format($tambahan, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal; padding: 8px 4px;"></td>
                <td class="text-black font-bold" style="padding: 8px 6px;">Total Pendapatan</td>
                <td style="border-right: none; padding: 8px 4px;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none; padding: 8px 6px;" class="text-black font-bold">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal; padding: 8px 4px;">4.</td>
                <td style="font-weight: normal; padding: 8px 6px;">Pengeluaran Rumah Tangga</td>
                <td style="border-right: none; font-weight: normal; padding: 8px 4px;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none; padding: 8px 6px;">{{ number_format($pengeluaranRT, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal; padding: 8px 4px;"></td>
                <td class="text-black font-bold" style="padding: 8px 6px;">Penghasilan Bersih</td>
                <td style="border-right: none; padding: 8px 4px;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none; padding: 8px 6px;" class="text-black font-bold">{{ number_format($penghasilanBersih, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal; padding: 8px 4px;">5.</td>
                <td style="font-weight: normal; padding: 8px 6px;">Angsuran Bank Lain</td>
                <td style="border-right: none; font-weight: normal; padding: 8px 4px;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none; padding: 8px 6px;">{{ number_format($angsuranBankLain, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal; padding: 8px 4px;"></td>
                <td class="text-black font-bold" style="padding: 8px 6px;">Sisa Penghasilan</td>
                <td style="border-right: none; padding: 8px 4px;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none; padding: 8px 6px;" class="text-black font-bold">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal; padding: 8px 4px;">6.</td>
                <td style="font-weight: normal; padding: 8px 6px;">Angsuran BPR</td>
                <td style="border-right: none; font-weight: normal; padding: 8px 4px;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none; padding: 8px 6px;">{{ number_format($angsuranBpr, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal; padding: 8px 4px;"></td>
                <td class="text-black font-bold" style="padding: 8px 6px;">Sisa Penghasilan Bersih</td>
                <td style="border-right: none; padding: 8px 4px;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none; padding: 8px 6px;" class="text-black font-bold">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</td>
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
                <td style="padding: 10px 14px; border: 1px solid #0A3370 !important; text-align: left; color: #333; background-color: #FFFFFF !important; white-space: pre-line;">
                    @php
                        $listLegalitas = collect($data->agunan_tanah ?? [])->pluck('kepemilikan')->filter()->implode("\n");
                    @endphp
                    {{ !empty($listLegalitas) ? $listLegalitas : '-' }}
                </td>
            </tr>
        </table>

        <!-- F. CAPITAL / ASET YANG DIMILIKI -->
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
                <td style="white-space: pre-line; border: 1px solid #0A3370 !important; padding: 10px 14px; text-align: left; color: #333;">{{ !empty(trim($aset)) ? $aset : '-' }}</td>
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
                <td style="padding: 10px 14px; white-space: pre-line; border: 1px solid #0A3370 !important; text-align: left; color: #333;">
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