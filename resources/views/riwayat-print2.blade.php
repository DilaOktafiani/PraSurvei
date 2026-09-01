<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Form Credit Analysis - {{ $data->nama ?? '-' }}</title>
    <style>
        @page {
            size: auto;
            margin: 1.5cm 1cm 1.5cm 1cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8pt;
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
            font-size: 11pt;
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
        <h2 class="main-title">FORM SURVEY</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" class="section-header" style="text-align: left;">A. Data Debitur</th>
                </tr>
            </thead>
            <tbody>
                <!-- Nomor Register -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%;"></td>
                    <td colspan="3" class="bg-label" style="width: 25%;">Nomor Register</td>
                    <td colspan="8" class="font-bold" style="width: 67%;">{{ $data->no_register ?? '-' }}</td>
                </tr>
                <!-- Nama Debitur & Marketing -->
                <tr>
                    <td class="bg-label text-center">1</td>
                    <td colspan="3" class="bg-label">Nama Debitur</td>
                    <td colspan="4" class="font-bold">{{ $data->nama ?? '-' }}</td>
                    <td colspan="2" class="bg-label">Nama Marketing</td>
                    <td colspan="2" style="font-weight: normal;">{{ $data->nama_marketing ?? '-' }}</td>
                </tr>
                <!-- Tanggal OTS -->
                <tr>
                    <td class="bg-label text-center"></td>
                    <td colspan="3" class="bg-label">Tanggal OTS</td>
                    <td colspan="8" style="font-weight: normal;">{{ $data->tanggal_ots ?? '-' }}</td>
                </tr>
                <!-- Plafon & JKW -->
                <tr>
                    <td class="bg-label text-center">2</td>
                    <td colspan="3" class="bg-label">Plafon</td>
                    <td colspan="4" class="font-bold" style="color: #000000;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="bg-label">JKW</td>
                    <td colspan="2" class="font-normal">{{ $data->jangka_waktu ?? '-' }}</td>
                </tr>
                <!-- Tujuan Penggunaan -->
                <tr>
                    <td class="bg-label text-center">3</td>
                    <td colspan="3" class="bg-label">Tujuan Penggunaan</td>
                    <td colspan="8">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                </tr>
                <!-- Estimasi Kewajiban -->
                <tr>
                    <td class="bg-label text-center">4</td>
                    <td colspan="3" class="bg-label">Estimasi Kewajiban</td>
                    <td colspan="8" class="font-bold" style="color: #000000;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- Type Fasilitas -->
                <tr>
                    <td class="bg-label text-center">5</td>
                    <td colspan="3" class="bg-label">Type Fasilitas</td>
                    <td colspan="8">
                        {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                    </td>
                </tr>
                <!-- Temuan CA -->
                <tr>
                    <td class="bg-label text-center">6</td>
                    <td colspan="3" class="bg-label">Temuan CA</td>
                    <td colspan="8" style="text-align: justify;">{{ $data->temuan_ca ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- B. AGUNAN -->
        @php
            $agunan = $data->agunan_tanah->first() ?? null;
        @endphp
        <table class="export-table" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" class="section-header" style="text-align: left;">B. Agunan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sub Header JAMINAN -->
                <tr>
                    <td colspan="12" class="sub-header" style="text-align: left; background-color: #f3f4f6; color: #0A3370; font-weight: bold; text-transform: uppercase;">Jaminan</td>
                </tr>
                <!-- Kepemilikan -->
                <tr>
                    <td colspan="3" class="bg-label" style="width: 25%;">Kepemilikan</td>
                    <td colspan="9" class="font-bold" style="width: 75%;">{{ $agunan->kepemilikan ?? '-' }}</td>
                </tr>
                <!-- Alamat -->
                <tr>
                    <td colspan="3" class="bg-label">Alamat</td>
                    <td colspan="9">{{ $agunan->alamat ?? '-' }}</td>
                </tr>
                <!-- Share Loc -->
                <tr>
                    <td colspan="3" class="bg-label">Share Loc</td>
                    <td colspan="9">
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
                    <td colspan="12" class="sub-header" style="text-align: left; background-color: #f3f4f6; color: #0A3370; font-weight: bold; text-transform: uppercase;">Collateral</td>
                </tr>
                <!-- Header Kolom Collateral -->
                <tr class="sub-header" style="text-align: center; background-color: #f9fafb; color: #000000;">
                    <td colspan="2" style="font-weight: bold; color: #000000;">Uraian</td>
                    <td colspan="1" style="font-weight: bold; color: #000000;">Luas (m2)</td>
                    <td colspan="2" style="font-weight: bold; text-align: right; color: #000000;">Harga</td>
                    <td colspan="2" style="font-weight: bold; text-align: right; color: #000000;">Nilai Pasar</td>
                    <td colspan="2" style="font-weight: bold; text-align: right; color: #000000;">Nilai Taksasi</td>
                    <td colspan="3" style="font-weight: bold; text-align: right; color: #000000;">Nilai Likuidasi</td>
                </tr>
                <!-- Baris Tanah -->
                <tr>
                    <td colspan="2" class="bg-label font-bold">Tanah</td>
                    <td colspan="1" class="text-center">{{ $agunan->luas_tanah ?? '-' }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->harga_tanah ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->tanah_pasar ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->tanah_taksasi ?? 0, 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right">Rp {{ number_format($agunan->tanah_likuidasi ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- Baris Bangunan -->
                <tr>
                    <td colspan="2" class="bg-label font-bold">Bangunan</td>
                    <td colspan="1" class="text-center">{{ $agunan->luas_bangunan ?? '-' }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->harga_bangunan ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->bangunan_pasar ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->bangunan_taksasi ?? 0, 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right">Rp {{ number_format($agunan->bangunan_likuidasi ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- Total Collateral -->
                <tr class="font-bold bg-label">
                    <td colspan="5" style="text-align: center; border-right: none;">Total</td>
                    <td colspan="2" class="text-right" style="border-left: 1px solid #000000; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">Rp {{ number_format(($agunan->tanah_pasar ?? 0) + ($agunan->bangunan_pasar ?? 0), 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format(($agunan->tanah_taksasi ?? 0) + ($agunan->bangunan_taksasi ?? 0), 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right">Rp {{ number_format(($agunan->tanah_likuidasi ?? 0) + ($agunan->bangunan_likuidasi ?? 0), 0, ',', '.') }}</td>
                </tr>

                <!-- Denah -->
                <tr>
                    <td colspan="3" class="bg-label" style="vertical-align: middle;">Denah</td>
                    <td colspan="9" style="padding: 8px;">
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
                    <td colspan="3" class="bg-label">Spesifikasi Jaminan</td>
                    <td colspan="9" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $agunan->spesifikasi ?? '-' }}</td>
                </tr>

                <!-- Sub Header INFORMASI HARGA -->
                <tr>
                    <td colspan="12" class="sub-header" style="text-align: left; background-color: #f3f4f6; color: #0A3370; font-weight: bold; text-transform: uppercase;">Informasi Harga</td>
                </tr>
                <!-- Informasi Harga 1 -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%;">1</td>
                    <td colspan="11" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $agunan->info_harga1 ?? '-' }}</td>
                </tr>
                <!-- Informasi Harga 2 -->
                <tr>
                    <td class="bg-label text-center">2</td>
                    <td colspan="11" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $agunan->info_harga2 ?? '-' }}</td>
                </tr>
                <!-- Informasi Harga 3 -->
                <tr>
                    <td class="bg-label text-center">3</td>
                    <td colspan="11" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $agunan->info_harga3 ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- C. ANALISIS JAMINAN -->
        <table class="export-table">
            <tr>
                <td class="section-header">C. Analisis Jaminan</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->analisis_jaminan->analisis_jaminan ?? '-' }}</td>
            </tr>
        </table>

        <!-- D. ANALISIS SLIK -->
        <table class="export-table" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" class="section-header" style="text-align: left;">D. Analisis SLIK</th>
                </tr>
            </thead>
            <tbody>
                <!-- D.1 Penghasilan Utama -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%;">D.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%;">Informasi Penghasilan Utama menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; text-align: justify;">{{ $data->capacity->informasi_penghasilan_utama ?? '-' }}</td>
                </tr>
                <!-- D.2 Penghasilan Pendukung -->
                <tr>
                    <td class="bg-label text-center">D.2</td>
                    <td colspan="3" class="bg-label">Informasi Penghasilan Pendukung menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $data->capacity->informasi_penghasilan_pendukung ?? '-' }}</td>
                </tr>
                <!-- D.3 Pengeluaran Rumah Tangga -->
                <tr>
                    <td class="bg-label text-center">D.3</td>
                    <td colspan="3" class="bg-label">Pengeluaran Rumah Tangga</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">Rp {{ number_format($data->capacity->pengeluaran_rumah_tangga ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- D.3 Angsuran Bank Lain -->
                <tr>
                    <td class="bg-label text-center"></td>
                    <td colspan="3" class="bg-label">Angsuran Bank Lain</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">Rp {{ number_format($data->capacity->angsuran_bank_lain ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- D.3 Angsuran BPR -->
                <tr>
                    <td class="bg-label text-center"></td>
                    <td colspan="3" class="bg-label">Angsuran BPR</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">Rp {{ number_format($data->capacity->angsuran_bpr ?? 0, 0, ',', '.') }}</td>
                </tr>
                <!-- D.4 Analisis Kapasitas CA -->
                <tr>
                    <td class="bg-label text-center">D.4</td>
                    <td colspan="3" class="bg-label">Analisis Kapasitas CA</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $data->capacity->analisis_kapasitas ?? '-' }}</td>
                </tr>
                <!-- D.5 Kelengkapan Berkas -->
                <tr>
                    <td class="bg-label text-center">D.5</td>
                    <td colspan="3" class="bg-label">Kelengkapan Berkas</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">
                        @if(is_array($data->capacity->kelengkapan_berkas ?? null))
                            @foreach($data->capacity->kelengkapan_berkas as $item)
                                <div>{{ $item }}</div>
                            @endforeach
                        @else
                            {{ $data->capacity->kelengkapan_berkas ?? '-' }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- E. DESKRIPSI USAHA -->
        <table class="export-table">
            <tr>
                <td class="section-header">E. Deskripsi Usaha</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->capacity->deskripsi_usaha ?? '-' }}</td>
            </tr>
        </table>

        <!-- F. ANALISIS CAPITAL -->
        <table class="export-table">
            <tr>
                <td class="section-header">F. Analisis Capital</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->capital->analisis_aset ?? '-' }}</td>
            </tr>
        </table>

        <!-- G. ANALISIS TAKE OVER -->
        <table class="export-table">
            <tr>
                <td class="section-header">G. Analisis Take Over</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->kondisi->analisis_take_over ?? '-' }}</td>
            </tr>
        </table>

        <!-- H. ANALISIS KELENGKAPAN BERKAS -->
        <table class="export-table">
            <tr>
                <td class="section-header">H. Analisis Kelengkapan Berkas</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}</td>
            </tr>
        </table>

        <!-- I. ANALISIS BADAN USAHA -->
        <table class="export-table">
            <tr>
                <td class="section-header">I. Analisis Badan Usaha</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->badanusaha->analisa_badan_usaha ?? '-' }}</td>
            </tr>
        </table>

        <!-- J. ANALISIS SWOT -->
        <table class="export-table" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="12" class="section-header" style="text-align: left;">J. Analisis SWOT</th>
                </tr>
            </thead>
            <tbody>
                <!-- J.1 Strengths (Kekuatan) -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%;">J.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%;">Strengths (Kekuatan)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%; text-align: justify;">{{ $data->swot->kekuatan ?? '-' }}</td>
                </tr>
                <!-- J.2 Weaknesses (Kelemahan) dan Mitigasi -->
                <tr>
                    <td class="bg-label text-center">J.2</td>
                    <td colspan="3" class="bg-label">Weaknesses (Kelemahan) dan Mitigasi</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $data->swot->kelemahan ?? '-' }}</td>
                </tr>
                <!-- J.3 Opportunities (Peluang) -->
                <tr>
                    <td class="bg-label text-center">J.3</td>
                    <td colspan="3" class="bg-label">Opportunities (Peluang)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $data->swot->peluang ?? '-' }}</td>
                </tr>
                <!-- J.4 Threats (Ancaman) -->
                <tr>
                    <td class="bg-label text-center">J.4</td>
                    <td colspan="3" class="bg-label">Threats (Ancaman)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="text-align: justify;">{{ $data->swot->ancaman ?? '-' }}</td>
                </tr>
                <!-- Sub Header Kesimpulan -->
                <tr>
                    <td colspan="12" class="sub-header" style="text-align: left; background-color: #f3f4f6; color: #0A3370; font-weight: bold; text-transform: uppercase;">Kesimpulan</td>
                </tr>
                <!-- Isi Kesimpulan -->
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px; font-weight: normal; text-align: justify;">{{ $data->swot->kesimpulan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- K. REKOMENDASI -->
        <table class="export-table">
            <tr>
                <td class="section-header">K. Rekomendasi</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->swot->rekomendasi ?? '-' }}</td>
            </tr>
        </table>

        <!-- L. SYARAT DAN CATATAN LAINNYA -->
        <table class="export-table">
            <tr>
                <td class="section-header">L. Syarat dan Catatan Lainnya</td>
            </tr>
            <tr>
                <td class="whitespace-pre" style="padding: 6px; text-align: justify;">{{ $data->swot->syarat_catatan ?? '-' }}</td>
            </tr>
        </table>

    </div>

</body>
</html>