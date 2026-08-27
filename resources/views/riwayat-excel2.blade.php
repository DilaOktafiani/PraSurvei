<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Credit Analysis - {{ $data->nama ?? '-' }}</title>
    <style>
        /* Mengatur agar tabel benar-benar mirip grid Excel */
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 10px;
            font-family: 'Calibri', 'Arial', sans-serif;
            font-size: 10pt;
            color: #000000;
        }
        .page-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }
        .main-title {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            color: #0A3370;
            text-transform: uppercase;
        }
        table.export-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            margin-bottom: 15px;
            table-layout: fixed;
        }
        /* Border garis tipis ala Excel di setiap sel */
        table.export-table th, 
        table.export-table td {
            border: 1px solid #d9d9d9 !important;
            padding: 5px 8px;
            vertical-align: middle;
        }
        .section-header {
            background-color: #0A3370 !important; /* Warna biru gelap ala Excel header */
            color: #FFFFFF !important;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
            padding: 6px 8px;
            border: 1px solid #0A3370 !important;
        }
        .sub-header {
            background-color: #f3f4f6 !important;
            color: #0A3370 !important;
            font-weight: bold;
        }
        .bg-label {
            background-color: #f2f2f2 !important; /* Abu-abu terang header kolom Excel */
            font-weight: bold;
            color: #333333;
        }
        .text-center {
            text-align: center !important;
        }
        .text-right {
            text-align: right !important;
        }
        .text-emerald {
            color: #047857 !important;
            font-weight: bold;
        }
        .font-bold {
            font-weight: bold;
        }
        .whitespace-pre-line {
            white-space: pre-line;
        }
    </style>
</head>
<body>

    <div class="page-container">
        <h2 class="main-title">FORM CREDIT ANALYSIS</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table">
            <thead>
                <tr>
                    <th colspan="12" class="section-header">A. Data Debitur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-label text-center" style="width: 6%;"></td>
                    <td colspan="3" class="bg-label" style="width: 24%;">Nomor Register</td>
                    <td colspan="8" class="font-bold" style="width: 70%;">{{ $data->no_register ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">1</td>
                    <td colspan="3" class="bg-label">Nama Debitur</td>
                    <td colspan="4" class="font-bold">{{ $data->nama ?? '-' }}</td>
                    <td colspan="2" class="bg-label">Nama Marketing</td>
                    <td colspan="2" class="font-bold">{{ $data->nama_marketing ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center"></td>
                    <td colspan="3" class="bg-label">Tanggal OTS</td>
                    <td colspan="8">{{ $data->tanggal_ots ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">2</td>
                    <td colspan="3" class="bg-label">Plafon</td>
                    <td colspan="4" class="text-emerald font-bold">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="bg-label">JKW</td>
                    <td colspan="2" class="font-bold">{{ $data->jangka_waktu ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">3</td>
                    <td colspan="3" class="bg-label">Tujuan Penggunaan</td>
                    <td colspan="8" class="whitespace-pre-line">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">4</td>
                    <td colspan="3" class="bg-label">Estimasi Kewajiban</td>
                    <td colspan="8">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">5</td>
                    <td colspan="3" class="bg-label">Type Fasilitas</td>
                    <td colspan="8">
                        {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                    </td>
                </tr>
                <tr>
                    <td class="bg-label text-center">6</td>
                    <td colspan="3" class="bg-label">Temuan CA</td>
                    <td colspan="8" class="whitespace-pre-line">{{ $data->temuan_ca ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- B. AGUNAN -->
        @php
            $agunan = $data->agunan_tanah->first() ?? null;
        @endphp
        <table class="export-table">
            <thead>
                <tr>
                    <th colspan="12" class="section-header">B. Agunan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="sub-header">Jaminan</td>
                </tr>
                <tr>
                    <td colspan="3" class="bg-label" style="width: 25%;">Kepemilikan</td>
                    <td colspan="9" class="font-bold" style="width: 75%;">{{ $agunan->kepemilikan ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="bg-label">Alamat</td>
                    <td colspan="9" class="whitespace-pre-line">{{ $agunan->alamat ?? '-' }}</td>
                </tr>
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

                <tr>
                    <td colspan="12" class="sub-header">Collateral</td>
                </tr>
                <tr class="sub-header text-center" style="background-color: #f9fafb;">
                    <td colspan="2" class="font-bold">Uraian</td>
                    <td colspan="1" class="font-bold">Luas (m2)</td>
                    <td colspan="2" class="font-bold text-right">Harga</td>
                    <td colspan="2" class="font-bold text-right">Nilai Pasar</td>
                    <td colspan="2" class="font-bold text-right">Nilai Taksasi</td>
                    <td colspan="3" class="font-bold text-right">Nilai Likuidasi</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label font-bold">Tanah</td>
                    <td colspan="1" class="text-center">{{ $agunan->luas_tanah ?? '-' }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->harga_tanah ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->tanah_pasar ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->tanah_taksasi ?? 0, 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right">Rp {{ number_format($agunan->tanah_likuidasi ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label font-bold">Bangunan</td>
                    <td colspan="1" class="text-center">{{ $agunan->luas_bangunan ?? '-' }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->harga_bangunan ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->bangunan_pasar ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format($agunan->bangunan_taksasi ?? 0, 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right">Rp {{ number_format($agunan->bangunan_likuidasi ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr class="font-bold bg-label">
                    <td colspan="3" class="text-center">Total</td>
                    <td colspan="2" class="text-right">-</td>
                    <td colspan="2" class="text-right">Rp {{ number_format(($agunan->tanah_pasar ?? 0) + ($agunan->bangunan_pasar ?? 0), 0, ',', '.') }}</td>
                    <td colspan="2" class="text-right">Rp {{ number_format(($agunan->tanah_taksasi ?? 0) + ($agunan->bangunan_taksasi ?? 0), 0, ',', '.') }}</td>
                    <td colspan="3" class="text-right">Rp {{ number_format(($agunan->tanah_likuidasi ?? 0) + ($agunan->bangunan_likuidasi ?? 0), 0, ',', '.') }}</td>
                </tr>

                <tr>
                    <td colspan="3" class="bg-label">Denah</td>
                    <td colspan="9" style="padding: 8px;">
                        @if(!empty($agunan->denah) && $agunan->denah !== '-')
                            <div style="max-width: 250px; border: 1px solid #d1d5db; padding: 4px; background: #fff;">
                                <img src="{{ asset('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 100%; height: auto; display: block; max-height: 200px; object-fit: contain;">
                            </div>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="bg-label">Spesifikasi Jaminan</td>
                    <td colspan="9" class="whitespace-pre-line font-medium">{{ $agunan->spesifikasi ?? '-' }}</td>
                </tr>

                <tr>
                    <td colspan="12" class="sub-header">Informasi Harga</td>
                </tr>
                <tr>
                    <td class="bg-label text-center" style="width: 6%;">1</td>
                    <td colspan="11" class="whitespace-pre-line font-medium">{{ $agunan->info_harga1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">2</td>
                    <td colspan="11" class="whitespace-pre-line font-medium">{{ $agunan->info_harga2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">3</td>
                    <td colspan="11" class="whitespace-pre-line font-medium">{{ $agunan->info_harga3 ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- C. ANALISIS JAMINAN -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">C. Analisis Jaminan</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->analisis_jaminan ?? '-' }}</td>
            </tr>
        </table>

        <!-- D. ANALISIS SLIK -->
        <table class="export-table">
            <thead>
                <tr>
                    <th colspan="12" class="section-header">D. Analisis SLIK</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-label text-center" style="width: 6%;">D.1</td>
                    <td colspan="3" class="bg-label" style="width: 24%;">Informasi Penghasilan Utama menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 70%;">{{ $data->dataslik->penghasilan_utama ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">D.2</td>
                    <td colspan="3" class="bg-label">Informasi Penghasilan Pendukung menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->dataslik->penghasilan_pendukung ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">D.3</td>
                    <td colspan="3" class="bg-label text-center font-bold">Pengeluaran Rumah Tangga</td>
                    <td colspan="4" class="bg-label text-center font-bold">Angsuran Bank Lain</td>
                    <td colspan="4" class="bg-label text-center font-bold">Angsuran BPR</td>
                </tr>
                <tr>
                    <td class="bg-label text-center"></td>
                    <td colspan="3" class="text-center font-medium">{{ $data->dataslik->pengeluaran_rumah_tangga ?? '-' }}</td>
                    <td colspan="4" class="text-center font-medium">{{ $data->dataslik->angsuran_bank_lain ?? '-' }}</td>
                    <td colspan="4" class="text-center font-medium">{{ $data->dataslik->angsuran_bpr ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">D.4</td>
                    <td colspan="3" class="bg-label">Analisis Kapasitas CA</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->dataslik->analisis_kapasitas_ca ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">D.5</td>
                    <td colspan="3" class="bg-label">Kelengkapan Berkas</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->dataslik->kelengkapan_berkas ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- E. DESKRIPSI USAHA -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">E. Deskripsi Usaha</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->capacity->deskripsi_usaha ?? '-' }}</td>
            </tr>
        </table>

        <!-- F. ANALISIS CAPITAL -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">F. Analisis Capital</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->capital->analisis_aset ?? '-' }}</td>
            </tr>
        </table>

        <!-- G. ANALISIS TAKE OVER -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">G. Analisis Take Over</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->kondisi->analisis_take_over ?? '-' }}</td>
            </tr>
        </table>

        <!-- H. ANALISIS KELENGKAPAN BERKAS -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">H. Analisis Kelengkapan Berkas</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}</td>
            </tr>
        </table>

        <!-- I. ANALISIS BADAN USAHA -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">I. Analisis Badan Usaha</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->badanusaha->analisa_badan_usaha ?? '-' }}</td>
            </tr>
        </table>

        <!-- J. ANALISIS SWOT -->
        <table class="export-table">
            <thead>
                <tr>
                    <th colspan="12" class="section-header">J. Analisis SWOT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-label text-center" style="width: 6%;">J.1</td>
                    <td colspan="3" class="bg-label" style="width: 24%;">Strengths (Kekuatan)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 70%;">{{ $data->swot->kekuatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">J.2</td>
                    <td colspan="3" class="bg-label">Weaknesses (Kelemahan) dan Mitigasi</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->swot->kelemahan ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">J.3</td>
                    <td colspan="3" class="bg-label">Opportunities (Peluang)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->swot->peluang ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-label text-center">J.4</td>
                    <td colspan="3" class="bg-label">Threats (Ancaman)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->swot->ancaman ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="12" class="sub-header">Kesimpulan</td>
                </tr>
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="padding: 8px;">{{ $data->swot->kesimpulan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- K. REKOMENDASI -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">K. Rekomendasi</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->swot->rekomendasi ?? '-' }}</td>
            </tr>
        </table>

        <!-- L. SYARAT DAN CATATAN LAINNYA -->
        <table class="export-table">
            <tr>
                <th colspan="12" class="section-header">L. Syarat dan Catatan Lainnya</th>
            </tr>
            <tr>
                <td colspan="12" class="whitespace-pre-line" style="padding: 8px;">{{ $data->swot->syarat_catatan ?? '-' }}</td>
            </tr>
        </table>

    </div>

</body>
</html>