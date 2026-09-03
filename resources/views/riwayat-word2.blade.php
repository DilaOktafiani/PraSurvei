<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Survei - {{ $data->nama ?? '-' }}</title>
    <style>
    @page {
        size: A4;
        margin: 10mm 12mm 10mm 12mm;
    }
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 8pt;
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
    
    /* === KHUSUS KELAS WARNA SECTION JAMINAN AGAR SELALU MUNCUL DI PDF === */
    .section-header-jaminan {
        background-color: #0A3370 !important;
        color: #FFFFFF !important;
        font-weight: bold;
        padding: 6px 10px;
        text-transform: uppercase;
        border: 1px solid #0A3370 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .bg-label-jaminan {
        background-color: #f3f4f6 !important;
        border: 1px solid #0A3370 !important;
        font-weight: bold;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        padding: 8px;
    }
    .cell-jaminan {
        border: 1px solid #0A3370 !important;
        padding: 8px;
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
        <table class="export-table" style="table-layout: fixed; width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        A. Data Debitur
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Nomor Register -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: middle;"></td>
                    <td colspan="3" class="bg-label" style="width: 25%;">Nomor Register</td>
                    <td colspan="8" class="font-bold" style="width: 67%;">{{ $data->no_register ?? '-' }}</td>
                </tr>
                <!-- Nama Debitur & Marketing -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: middle;">1</td>
                    <td colspan="3" class="bg-label">Nama Debitur</td>
                    <td colspan="4" class="font-bold">{{ $data->nama ?? '-' }}</td>
                    <td colspan="2" class="bg-label">Nama Marketing</td>
                    <td colspan="2" style="font-weight: normal;">{{ $data->nama_marketing ?? '-' }}</td>
                </tr>
                <!-- Tanggal OTS -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: middle;"></td>
                    <td colspan="3" class="bg-label">Tanggal OTS</td>
                    <td colspan="8" style="font-weight: normal;">{{ $data->tanggal_ots ?? '-' }}</td>
                </tr>
                <!-- Plafon & JKW -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: top;">2</td>
                    <td colspan="3" class="bg-label" style="vertical-align: top;">Plafon</td>
                    <td colspan="4" style="font-weight: bold; color: #000000; vertical-align: top;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">JKW</td>
                    <td colspan="2" style="font-weight: normal; vertical-align: top;">{{ $data->jangka_waktu ?? '-' }}</td>
                </tr>
                <!-- Tujuan Penggunaan -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: top;">3</td>
                    <td colspan="3" class="bg-label" style="vertical-align: top;">Tujuan Penggunaan</td>
                    <td colspan="8" style="vertical-align: top;">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                </tr>
                <!-- Estimasi Kewajiban -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: top;">4</td>
                    <td colspan="3" class="bg-label" style="vertical-align: top;">Estimasi Kewajiban</td>
                    <td colspan="8" style="font-weight: bold; color: #000000; vertical-align: top;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- Type Fasilitas -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: top;">5</td>
                    <td colspan="3" class="bg-label" style="vertical-align: top;">Type Fasilitas</td>
                    <td colspan="8" style="vertical-align: top;">
                        {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                    </td>
                </tr>
                <!-- Temuan CA -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%; text-align: center; vertical-align: top;">6</td>
                    <td colspan="3" class="bg-label" style="vertical-align: top;">Temuan CA</td>
                    <td colspan="8" style="text-align: justify; vertical-align: top;">{{ $data->temuan_ca ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- B. AGUNAN -->
        @php
            $agunan = $data->agunan_tanah->first() ?? null;
        @endphp
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            B. AGUNAN
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Sub Header JAMINAN -->
                <tr>
                    <td colspan="12" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 6px 10px; text-align: left;">
                        <div style="background-color: #f3f4f6; color: #0A3370; width: 100%;">Jaminan</div>
                    </td>
                </tr>
                
                <!-- Kepemilikan -->
                <tr>
                    <td colspan="3" bgcolor="#f3f4f6" class="bg-label" style="width: 25%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Kepemilikan</td>
                    <td colspan="9" style="width: 75%; border: 1px solid #0A3370 !important; padding: 8px; font-weight: bold;">{{ $agunan->kepemilikan ?? '-' }}</td>
                </tr>
                
                <!-- Alamat -->
                <tr>
                    <td colspan="3" bgcolor="#f3f4f6" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Alamat</td>
                    <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 8px;">{{ $agunan->alamat ?? '-' }}</td>
                </tr>
                
                <!-- Share Loc -->
                <tr>
                    <td colspan="3" bgcolor="#f3f4f6" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Share Loc</td>
                    <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 8px;">
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
                    <td colspan="12" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 6px 10px; text-align: left;">
                        <div style="background-color: #f3f4f6; color: #0A3370; width: 100%;">Collateral</div>
                    </td>
                </tr>

                @php
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

                <!-- TABEL RINCIAN NILAI JAMINAN -->
                <tr class="sub-header" style="text-align: center; background-color: #f9fafb; color: #000000;">
                    <td colspan="2" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; color: #000000;">Uraian</td>
                    <td colspan="1" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; color: #000000;">Luas (m2)</td>
                    <td colspan="2" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; color: #000000;">Harga</td>
                    <td colspan="2" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; color: #000000;">Nilai Pasar</td>
                    <td colspan="2" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; color: #000000;">Nilai Taksasi</td>
                    <td colspan="3" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; color: #000000;">Nilai Likuidasi</td>
                </tr>
                <tr>
                    <td colspan="2" bgcolor="#f3f4f6" class="bg-label font-bold" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Tanah</td>
                    <td colspan="1" class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 8px;">{{ $agunan->luas_tanah ?? '-' }}</td>
                    <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" bgcolor="#f3f4f6" class="bg-label font-bold" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Bangunan</td>
                    <td colspan="1" class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 8px;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                    <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</td>
                </tr>
                <tr class="font-bold bg-label">
                    <td colspan="5" bgcolor="#f3f4f6" class="text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">TOTAL</td>
                    <td colspan="2" bgcolor="#f3f4f6" class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</td>
                    <td colspan="2" bgcolor="#f3f4f6" class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</td>
                    <td colspan="3" bgcolor="#f3f4f6" class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</td>
                </tr>

                <!-- Denah -->
                <tr>
                    <td colspan="3" bgcolor="#f3f4f6" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Denah</td>
                    <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 8px; text-align: left;">
                        @if(!empty($agunan->denah_base64))
                            <div style="max-width: 230px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff; padding: 4px; text-align: left;">
                                <img src="{{ $agunan->denah_base64 }}" alt="Denah Lokasi" style="max-width: 100%; height: auto; display: block; margin: 0;" />
                            </div>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>

                <!-- Spesifikasi Jaminan -->
                <tr>
                    <td colspan="3" bgcolor="#f3f4f6" class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Spesifikasi Jaminan</td>
                    <td colspan="9" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word;">{{ $agunan->spesifikasi ?? '-' }}</td>
                </tr>

                <!-- Sub Header INFORMASI HARGA -->
                <tr>
                    <td colspan="12" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 6px 10px; text-align: left;">
                        <div style="background-color: #f3f4f6; color: #0A3370; width: 100%;">Informasi Harga</div>
                    </td>
                </tr>
                <!-- Informasi Harga 1 -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="width: 8%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">1</td>
                    <td colspan="11" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $agunan->info_harga1 ?? '-' }}</td>
                </tr>
                <!-- Informasi Harga 2 -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">2</td>
                    <td colspan="11" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $agunan->info_harga2 ?? '-' }}</td>
                </tr>
                <!-- Informasi Harga 3 -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">3</td>
                    <td colspan="11" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $agunan->info_harga3 ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- C. ANALISIS JAMINAN -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        C. Analisis Jaminan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->analisis_jaminan->analisis_jaminan ?? '-' }}</td>
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
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            D. ANALISIS SLIK
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- D.1 Penghasilan Utama -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="width: 8%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">D.1</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="width: 25%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Informasi Penghasilan Utama menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $capacity->informasi_penghasilan_utama ?? $capacity->penghasilan_utama ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                
                <!-- D.2 Penghasilan Pendukung -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">D.2</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Informasi Penghasilan Pendukung menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $capacity->informasi_penghasilan_pendukung ?? $capacity->penghasilan_pendukung ?? $data->analisis_slik ?? '-' }}</td>
                </tr>

                <!-- D.3 Pengeluaran Rumah Tangga -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: middle; text-align: center;">D.3</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: middle;">Pengeluaran Rumah Tangga</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; vertical-align: middle;">
                        @php $valD3 = $capacity->pengeluaran_rumah_tangga ?? 0; @endphp
                        Rp {{ is_numeric($valD3) ? number_format($valD3, 0, ',', '.') : $valD3 }}
                    </td>
                </tr>

                <!-- D.3 Angsuran Bank Lain -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: middle; text-align: center;"></td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: middle;">Angsuran Bank Lain</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; vertical-align: middle;">
                        @php $valBankLain = $capacity->angsuran_bank_lain ?? 0; @endphp
                        Rp {{ is_numeric($valBankLain) ? number_format($valBankLain, 0, ',', '.') : $valBankLain }}
                    </td>
                </tr>

                <!-- D.3 Angsuran BPR -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: middle; text-align: center;"></td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: middle;">Angsuran BPR</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; vertical-align: middle;">
                        @php $valBPR = $capacity->angsuran_bpr ?? 0; @endphp
                        Rp {{ is_numeric($valBPR) ? number_format($valBPR, 0, ',', '.') : $valBPR }}
                    </td>
                </tr>

                <!-- D.4 Analisis Kapasitas CA -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">D.4</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Analisis Kapasitas CA</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $capacity->analisis_kapasitas ?? $capacity->analisis_kapasitas_ca ?? $data->analisis_slik ?? '-' }}</td>
                </tr>

                <!-- D.5 Kelengkapan Berkas -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">D.5</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Kelengkapan Berkas</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; vertical-align: top; text-align: justify; text-justify: inter-word;">
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
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            E. Deskripsi Usaha
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->capacity->deskripsi_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- F. ANALISIS CAPITAL -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            F. Analisis Capital
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->capital->analisis_aset ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- G. ANALISIS TAKE OVER -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            G. Analisis Take Over
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->kondisi->analisis_take_over ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- H. ANALISIS KELENGKAPAN BERKAS -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            H. Analisis Kelengkapan Berkas
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- I. ANALISIS BADAN USAHA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            I. Analisis Badan Usaha
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->badanusaha->analisa_badan_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- J. ANALISIS SWOT -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            J. Analisis SWOT
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- J.1 Strengths (Kekuatan) -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="width: 8%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">J.1</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="width: 25%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Strengths (Kekuatan)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->swot->kekuatan ?? '-' }}</td>
                </tr>
                <!-- J.2 Weaknesses (Kelemahan) dan Mitigasi -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">J.2</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Weaknesses (Kelemahan) dan Mitigasi</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->swot->kelemahan ?? '-' }}</td>
                </tr>
                <!-- J.3 Opportunities (Peluang) -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">J.3</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Opportunities (Peluang)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->swot->peluang ?? '-' }}</td>
                </tr>
                <!-- J.4 Threats (Ancaman) -->
                <tr>
                    <td class="bg-label text-center" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top; text-align: center;">J.4</td>
                    <td colspan="3" class="bg-label" bgcolor="#f3f4f6" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Threats (Ancaman)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->swot->ancaman ?? '-' }}</td>
                </tr>
                <!-- Sub Header Kesimpulan -->
                <tr>
                    <td colspan="12" class="sub-header" bgcolor="#f3f4f6" style="text-align: left; background-color: #f3f4f6 !important; color: #0A3370 !important; font-weight: bold; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 6px 10px;">
                        <div style="background-color: #f3f4f6; color: #0A3370; width: 100%;">Kesimpulan</div>
                    </td>
                </tr>
                <!-- Isi Kesimpulan -->
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->swot->kesimpulan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- K. REKOMENDASI -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            K. Rekomendasi
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->swot->rekomendasi ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- L. SYARAT DAN CATATAN LAINNYA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" bgcolor="#0A3370" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; text-align: left;">
                        <div style="background-color: #0A3370; color: #FFFFFF; width: 100%; padding: 0px; margin: 0px;">
                            L. Syarat dan Catatan Lainnya
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word; vertical-align: top;">{{ $data->swot->syarat_catatan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>