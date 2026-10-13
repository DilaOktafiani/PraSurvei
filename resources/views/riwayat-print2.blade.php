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
        color: #000000;
        line-height: 1.2;
        margin: 0;
        padding: 0;
        background-color: #ffffff;
    }

    .page-container {
        width: 100%;
        max-width: 210mm;
        min-height: 100vh;
        padding: 10mm;
        margin: 20px auto;
        background: white;
        box-sizing: border-box;
    }

    h2.main-title {
        text-align: center;
        font-size: 12pt;
        margin: 0 0 15px 0;
        color: #000000;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Bagian section header minimalis dengan garis bawah */
    .section-header {
        font-weight: bold;
        font-size: 10pt;
        padding: 5px 0;
        text-transform: uppercase;
        margin-bottom: 5px;
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

    .whitespace-pre {
        white-space: pre-line;
    }

    @media print {
        body {
            background-color: white;
        }
        .page-container {
            margin: 0;
            padding: 0;
            width: 100% !important;
            max-width: none;
        }
    }

    /* Styling tabel transparan tanpa border untuk layout data agar stabil di PDF */
    table.table-form {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 5px;
    }
    table.table-form td {
        border: none !important;
        padding: 3px 0;
        vertical-align: top;
    }
</style>
</head>

<body onload="window.print()">

    <div class="page-container">
        <h2 class="main-title">ANALISA KREDIT</h2>

        <!-- A. DATA DEBITUR -->
        <div class="page-container">
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header">
                    A. Data Debitur
                </div>
                
                <div class="text-sm">
                    <table class="table-form">
                        <!-- 1. Nama Debitur -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">1</td>
                            <td style="width: 35%; font-weight: 600;">Nama Debitur</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%; font-weight: normal;">{{ $data->nama ?? '-' }}</td>
                        </tr>

                        <!-- 2. Tempat / Tanggal Lahir -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">2</td>
                            <td style="width: 35%; font-weight: 600;">Tempat / Tgl Lahir</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->tempat_tanggal_lahir ?? '-' }}</td>
                        </tr>

                        <!-- 3. Nama Ibu Kandung -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">3</td>
                            <td style="width: 35%; font-weight: 600;">Nama Ibu Kandung</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->nama_ibu_kandung ?? '-' }}</td>
                        </tr>

                        <!-- 4. Nama Istri / Penjamin -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">4</td>
                            <td style="width: 35%; font-weight: 600;">Nama Istri / Penjamin</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->nama_istri_penjamin ?? '-' }}</td>
                        </tr>

                        <!-- 5. Alamat KTP -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">5</td>
                            <td style="width: 35%; font-weight: 600;">Alamat KTP</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->alamat_ktp ?? '-' }}</td>
                        </tr>

                        <!-- 6. Alamat Domisili -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">6</td>
                            <td style="width: 35%; font-weight: 600;">Alamat Domisili</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->alamat_domisili ?? '-' }}</td>
                        </tr>

                        <!-- 7. Telp / HP -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">7</td>
                            <td style="width: 35%; font-weight: 600;">Telp / HP</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->no_hp ?? '-' }}</td>
                        </tr>

                        <!-- 8. Pekerjaan -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">8</td>
                            <td style="width: 35%; font-weight: 600;">Pekerjaan</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->pekerjaan ?? '-' }}</td>
                        </tr>

                        <!-- 9. Bidang Usaha -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">9</td>
                            <td style="width: 35%; font-weight: 600;">Bidang Usaha</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->bidang_usaha ?? '-' }}</td>
                        </tr>

                        <!-- 10. Alamat Kerja / Usaha -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">10</td>
                            <td style="width: 35%; font-weight: 600;">Alamat Kerja / Usaha</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->alamat_usaha ?? '-' }}</td>
                        </tr>

                        <!-- 11. Telp / HP Usaha -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">11</td>
                            <td style="width: 35%; font-weight: 600;">Telp / HP Usaha</td>
                            <td style="width: 3%; text-align: center; font-weight: 600;">:</td>
                            <td style="width: 57%;">{{ $data->kontak ?? '-' }}</td>
                        </tr>

                        <!-- 12. IDI di Bank Lain -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: 600;">12</td>
                            <td colspan="3" style="font-weight: 600;">IDI di Bank Lain</td>
                        </tr>
                    </table>

                    <!-- Hasil Slik & Gambar -->
                    <div style="padding-left: 5%; margin-top: 5px;">
                        <div style="font-weight: bold;">
                            Hasil Slik, Tanggal {{ $data->tanggal_slik ?? '-' }}
                        </div>
                        <div style="margin-top: 5px;">
                            @if(!empty($data->idi_di_bank_lain) && $data->idi_di_bank_lain !== '-')
                                <div style="display: inline-block; padding: 2px;">
                                    <img 
                                        src="{{ asset('storage/' . $data->idi_di_bank_lain) }}" 
                                        alt="IDI di Bank Lain"
                                        style="max-width: 100%; height: auto; display: block;"
                                    >
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div style="padding-left: 5%; margin-top: 10px;">
                        <div style="font-weight: bold;">
                            Keterangan :
                        </div>
                        <div style="margin-top: 3px;">
                            {{ $data->keterangan ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

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