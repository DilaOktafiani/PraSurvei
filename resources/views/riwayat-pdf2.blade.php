<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pra Survey - {{ $data->nama ?? '-' }}</title>
    <style>
        @page {
            size: A4;
            margin: 10mm 12mm 10mm 12mm; /* Mengatur margin kertas langsung dari PDF-nya */
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
        <h2 class="main-title">FORM CREDIT ANALYSIS</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table" style="table-layout: fixed;">
            <thead>
                <tr>
                    <!-- Background biru ditambahkan di sini dengan colspan="12" -->
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        A. Data Debitur
                    </th>
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
                    <td colspan="2" class="font-bold">{{ $data->nama_marketing ?? '-' }}</td>
                </tr>
                <!-- Tanggal OTS -->
                <tr>
                    <td class="bg-label text-center"></td>
                    <td colspan="3" class="bg-label">Tanggal OTS</td>
                    <td colspan="8">{{ $data->tanggal_ots ?? '-' }}</td>
                </tr>
                <!-- Plafon & JKW -->
                <tr>
                    <td class="bg-label text-center">2</td>
                    <td colspan="3" class="bg-label">Plafon</td>
                    <td colspan="4" class="text-emerald font-bold">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                    <td colspan="2" class="bg-label">JKW</td>
                    <td colspan="2" class="font-bold">{{ $data->jangka_waktu ?? '-' }}</td>
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
                    <td colspan="8">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
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
                    <td colspan="8">{{ $data->temuan_ca ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- B. DATA JAMINAN -->
        @php
            $agunan = $data->agunan_tanah->first() ?? null;
        @endphp
        <table class="export-table" style="width: 100%; border-collapse: collapse; border: 1px solid #0A3370 !important; margin-top: 10px; margin-bottom: 5px;">
            <!-- Header Utama -->
            <tr>
                <td colspan="6" style="background-color: #0A3370 !important; color: #FFFFFF !important; font-weight: bold; padding: 6px 10px; text-transform: uppercase; border: 1px solid #0A3370 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    B. DATA JAMINAN
                </td>
            </tr>
            
            <!-- Kepemilikan -->
            <tr>
                <td class="bg-label" style="width: 20%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Kepemilikan</td>
                <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 8px; font-weight: bold;">{{ $agunan->kepemilikan ?? '-' }}</td>
            </tr>
            
            <!-- Alamat -->
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Alamat</td>
                <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 8px;">{{ $agunan->alamat ?? '-' }}</td>
            </tr>
            
            <!-- Share Loc -->
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Share Loc</td>
                <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 8px;">
                    @if(!empty($agunan->share_location) && $agunan->share_location !== '-')
                        <a href="{{ $agunan->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline; font-weight: 500;">
                            📍 Lihat Lokasi di Peta
                        </a>
                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>

            <!-- TABEL RINCIAN NILAI JAMINAN -->
            <tr class="bg-label text-center">
                <td style="width: 20%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Uraian</td>
                <td style="width: 10%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Luas (m2)</td>
                <td style="width: 14%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Harga</td>
                <td style="width: 18%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Nilai Pasar</td>
                <td style="width: 19%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Nilai Taksasi</td>
                <td style="width: 19%; background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Nilai Likuidasi</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Tanah</td>
                <td class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 8px;">{{ $agunan->luas_tanah ?? '-' }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->harga_tanah ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->tanah_pasar ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->tanah_taksasi ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->tanah_likuidasi ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Bangunan</td>
                <td class="text-center" style="border: 1px solid #0A3370 !important; text-align: center; padding: 8px;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->harga_bangunan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->bangunan_pasar ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->bangunan_taksasi ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="border: 1px solid #0A3370 !important; text-align: right; padding: 8px;">Rp {{ number_format($agunan->bangunan_likuidasi ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="font-bold bg-label">
                <td colspan="3" class="text-center" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; text-align: center; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">TOTAL</td>
                <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Rp {{ number_format(($agunan->tanah_pasar ?? 0) + ($agunan->bangunan_pasar ?? 0), 0, ',', '.') }}</td>
                <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Rp {{ number_format(($agunan->tanah_taksasi ?? 0) + ($agunan->bangunan_taksasi ?? 0), 0, ',', '.') }}</td>
                <td class="text-right" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; text-align: right; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px;">Rp {{ number_format(($agunan->tanah_likuidasi ?? 0) + ($agunan->bangunan_likuidasi ?? 0), 0, ',', '.') }}</td>
            </tr>

            <!-- Spesifikasi Jaminan -->
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Spesifikasi Jaminan</td>
                <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line;">{{ $agunan->spesifikasi ?? '-' }}</td>
            </tr>

            <!-- Denah -->
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Denah</td>
                <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 8px;">
                    @if(!empty($agunan->denah) && $agunan->denah !== '-')
                        <div style="width: 100%; max-width: 250px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff;">
                            <img src="{{ public_path('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 100%; height: auto; display: block;">
                        </div>
                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>

            <!-- Informasi Harga -->
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Informasi Harga</td>
                <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 0 !important;">
                    @php
                        $infoList = [
                            $agunan->info_harga1 ?? '-',
                            $agunan->info_harga2 ?? '-',
                            $agunan->info_harga3 ?? '-'
                        ];
                    @endphp
                    <table style="width: 100%; border-collapse: collapse; border: none !important;">
                        @foreach($infoList as $index => $info)
                            <tr>
                                <td style="width: 10%; border-top: {{ $loop->first ? 'none' : '1px solid #d1d5db' }}; border-bottom: {{ $loop->last ? 'none' : '1px solid #d1d5db' }}; border-right: 1px solid #d1d5db; border-left: none; text-align: center; padding: 8px; background-color: #f9fafb; font-weight: 500;">{{ $index + 1 }}</td>
                                <td style="width: 90%; border-top: {{ $loop->first ? 'none' : '1px solid #d1d5db' }}; border-bottom: {{ $loop->last ? 'none' : '1px solid #d1d5db' }}; border-right: none; border-left: none; padding: 8px; white-space: pre-line;">{{ !empty(trim($info)) ? $info : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
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
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->analisis_jaminan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- D. ANALISIS SLIK -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        D. Analisis SLIK
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- D.1 Penghasilan Utama -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%;">D.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%;">Informasi Penghasilan Utama menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%;">{{ $data->dataslik->penghasilan_utama ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <!-- D.2 Penghasilan Pendukung -->
                <tr>
                    <td class="bg-label text-center">D.2</td>
                    <td colspan="3" class="bg-label">Informasi Penghasilan Pendukung menurut nasabah</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->dataslik->penghasilan_pendukung ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <!-- D.3 Header Data Keuangan -->
                <tr>
                    <td class="bg-label text-center">D.3</td>
                    <td colspan="3" class="bg-label text-left font-semibold" style="padding-left: 4px;">Pengeluaran Rumah Tangga</td><td colspan="4" class="bg-label text-center font-semibold">Angsuran Bank Lain</td>
                    <td colspan="4" class="bg-label text-center font-semibold">Angsuran BPR</td>
                </tr>
                <!-- D.3 Isi Data Keuangan -->
                <tr>
                    <td class="bg-label text-center"></td>
                    <td colspan="3" class="text-center font-medium">{{ $data->dataslik->pengeluaran_rumah_tangga ?? '-' }}</td>
                    <td colspan="4" class="text-center font-medium">{{ $data->dataslik->angsuran_bank_lain ?? '-' }}</td>
                    <td colspan="4" class="text-center font-medium">{{ $data->dataslik->angsuran_bpr ?? '-' }}</td>
                </tr>
                <!-- D.4 Analisis Kapasitas CA -->
                <tr>
                    <td class="bg-label text-center">D.4</td>
                    <td colspan="3" class="bg-label">Analisis Kapasitas CA</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->dataslik->analisis_kapasitas_ca ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <!-- D.5 Kelengkapan Berkas -->
                <tr>
                    <td class="bg-label text-center">D.5</td>
                    <td colspan="3" class="bg-label">Kelengkapan Berkas</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->dataslik->kelengkapan_berkas ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- E. DESKRIPSI USAHA -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        E. Deskripsi Usaha
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->capacity->deskripsi_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- F. ANALISIS CAPITAL -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        F. Analisis Capital
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->capital->analisis_aset ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- G. ANALISIS TAKE OVER -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        G. Analisis Take Over
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->kondisi->analisis_take_over ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- H. ANALISIS KELENGKAPAN BERKAS -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        H. Analisis Kelengkapan Berkas
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- I. ANALISIS BADAN USAHA -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        I. Analisis Badan Usaha
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->badanusaha->analisa_badan_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- J. ANALISIS SWOT -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        J. Analisis SWOT
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- J.1 Strengths (Kekuatan) -->
                <tr>
                    <td class="bg-label text-center" style="width: 8%;">J.1</td>
                    <td colspan="3" class="bg-label" style="width: 25%;">Strengths (Kekuatan)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium" style="width: 67%;">{{ $data->swot->kekuatan ?? '-' }}</td>
                </tr>
                <!-- J.2 Weaknesses (Kelemahan) dan Mitigasi -->
                <tr>
                    <td class="bg-label text-center">J.2</td>
                    <td colspan="3" class="bg-label">Weaknesses (Kelemahan) dan Mitigasi</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->swot->kelemahan ?? '-' }}</td>
                </tr>
                <!-- J.3 Opportunities (Peluang) -->
                <tr>
                    <td class="bg-label text-center">J.3</td>
                    <td colspan="3" class="bg-label">Opportunities (Peluang)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->swot->peluang ?? '-' }}</td>
                </tr>
                <!-- J.4 Threats (Ancaman) -->
                <tr>
                    <td class="bg-label text-center">J.4</td>
                    <td colspan="3" class="bg-label">Threats (Ancaman)</td>
                    <td colspan="8" class="whitespace-pre-line font-medium">{{ $data->swot->ancaman ?? '-' }}</td>
                </tr>
                <!-- Sub Header Kesimpulan -->
                <tr>
                    <td colspan="12" class="sub-header" style="text-align: left; background-color: #f3f4f6; color: #0A3370; font-weight: bold; text-transform: uppercase;">Kesimpulan</td>
                </tr>
                <!-- Isi Kesimpulan -->
                <tr>
                    <td colspan="12" class="whitespace-pre-line font-medium" style="padding: 10px 14px;">{{ $data->swot->kesimpulan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- K. REKOMENDASI -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        K. Rekomendasi
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->swot->rekomendasi ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- L. SYARAT DAN CATATAN LAINNYA -->
        <table class="export-table" style="table-layout: fixed; margin-top: 10px; margin-bottom: 5px;">
            <thead>
                <tr>
                    <th colspan="12" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-align: left; text-transform: uppercase;">
                        L. Syarat dan Catatan Lainnya
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="12" class="whitespace-pre" style="padding: 6px;">{{ $data->swot->syarat_catatan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>