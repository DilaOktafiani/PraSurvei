<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Survei - {{ $data->nama ?? '-' }}</title>
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 10px;
            font-family: 'Calibri', 'Arial', sans-serif;
            font-size: 12pt; /* Diubah ke 12pt */
            color: #000000;
        }
        .page-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }
        .main-title {
            font-size: 14pt; /* Diubah ke 14pt */
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
            font-size: 12pt; /* Diubah ke 12pt */
        }
        table.export-table th, 
        table.export-table td {
            border: 1px solid #d9d9d9 !important;
            padding: 5px 8px;
            vertical-align: middle;
            font-size: 12pt; /* Diubah ke 12pt */
        }
        .section-header {
            background-color: #0A3370 !important;
            color: #FFFFFF !important;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12pt; /* Diubah ke 12pt */
            padding: 6px 8px;
            border: 1px solid #0A3370 !important;
            text-align: left;
        }
        .sub-header {
            background-color: #f3f4f6 !important;
            color: #0A3370 !important;
            font-weight: bold;
        }
        .bg-label {
            background-color: #f2f2f2 !important;
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
        <h2 class="main-title">FORM SURVEI</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">A. DATA DEBITUR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" class="bg-label" style="width: 30%;">Nomor Register</td>
                    <td colspan="5" class="font-bold" style="width: 70%;">{{ $data->no_register ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label">1. Nama Debitur</td>
                    <td colspan="2" class="font-bold">{{ $data->nama ?? '-' }}</td>
                    <td colspan="1" class="bg-label">Nama Marketing</td>
                    <td colspan="2" class="font-bold">{{ $data->nama_marketing ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label">Tanggal OTS</td>
                    <td colspan="5">{{ $data->tanggal_ots ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label">2. Plafon</td>
                    <td colspan="2" class="text-emerald font-bold" style="font-weight: bold; color: black;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                    <td colspan="1" class="bg-label">JKW</td>
                    <td colspan="2" class="whitespace-pre-line">{{ $data->jangka_waktu ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label">3. Tujuan Penggunaan</td>
                    <td colspan="5" class="whitespace-pre-line">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label">4. Estimasi Kewajiban</td>
                    <td colspan="5" style="font-weight: bold;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label">5. Type Fasilitas</td>
                    <td colspan="5">
                        {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label">6. Temuan CA</td>
                    <td colspan="5" class="whitespace-pre-line text-justify">{{ $data->temuan_ca ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- C. ANALISIS JAMINAN -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">C. ANALISIS JAMINAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify" style="padding: 8px;">{{ $data->analisis_jaminan->analisis_jaminan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- D. ANALISIS SLIK -->
        @php
            $capacity = $data->capacity ?? $data->dataslik ?? null;
        @endphp
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left; font-weight: bold; color: #FFFFFF;">D. ANALISIS SLIK</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="width: 10%; font-weight: bold; color: #000000;">D.1</td>
                    <td colspan="2" class="bg-label align-middle" style="width: 30%; font-weight: bold; color: #000000;">Informasi Penghasilan Utama menurut nasabah</td>
                    <td colspan="4" class="whitespace-pre-line font-medium text-justify align-middle" style="width: 60%;">{{ $capacity->informasi_penghasilan_utama ?? $capacity->penghasilan_utama ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="font-weight: bold; color: #000000;">D.2</td>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Informasi Penghasilan Pendukung menurut nasabah</td>
                    <td colspan="4" class="whitespace-pre-line font-medium text-justify align-middle">{{ $capacity->informasi_penghasilan_pendukung ?? $capacity->penghasilan_pendukung ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" rowspan="3" class="bg-label text-center align-middle" style="font-weight: bold; color: #000000;">D.3</td>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Pengeluaran Rumah Tangga</td>
                    <td colspan="4" class="font-medium align-middle">
                        @php $valD3 = $capacity->pengeluaran_rumah_tangga ?? 0; @endphp
                        Rp {{ is_numeric($valD3) ? number_format($valD3, 0, ',', '.') : $valD3 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Angsuran Bank Lain</td>
                    <td colspan="4" class="font-medium align-middle">
                        @php $valBankLain = $capacity->angsuran_bank_lain ?? 0; @endphp
                        Rp {{ is_numeric($valBankLain) ? number_format($valBankLain, 0, ',', '.') : $valBankLain }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Angsuran BPR</td>
                    <td colspan="4" class="font-medium align-middle">
                        @php $valBPR = $capacity->angsuran_bpr ?? 0; @endphp
                        Rp {{ is_numeric($valBPR) ? number_format($valBPR, 0, ',', '.') : $valBPR }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="font-weight: bold; color: #000000;">D.4</td>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Analisis Kapasitas CA</td>
                    <td colspan="4" class="whitespace-pre-line font-medium text-justify align-middle">{{ $capacity->analisis_kapasitas ?? $capacity->analisis_kapasitas_ca ?? $data->analisis_slik ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="font-weight: bold; color: #000000;">D.5</td>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Kelengkapan Berkas</td>
                    <td colspan="4" class="whitespace-pre-line font-medium align-middle">
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
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">E. DESKRIPSI USAHA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify font-medium" style="padding: 8px;">{{ $data->capacity->deskripsi_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- F. ANALISIS CAPITAL -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">F. ANALISIS CAPITAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify font-medium" style="padding: 8px;">{{ $data->capital->analisis_aset ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- G. ANALISIS TAKE OVER -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">G. ANALISIS TAKE OVER</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify font-medium" style="padding: 8px;">{{ $data->kondisi->analisis_take_over ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- H. ANALISIS KELENGKAPAN BERKAS -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">H. ANALISIS KELENGKAPAN BERKAS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify font-medium" style="padding: 8px;">{{ $data->berkas_lengkap->analisis_kelengkapan_berkas ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- I. ANALISIS BADAN USAHA -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">I. ANALISIS BADAN USAHA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify font-medium" style="padding: 8px;">{{ $data->badanusaha->analisa_badan_usaha ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- J. ANALISIS SWOT -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">J. ANALISIS SWOT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="width: 10%; font-weight: bold; color: #000000;">J.1</td>
                    <td colspan="2" class="bg-label align-middle" style="width: 30%; font-weight: bold; color: #000000;">Strengths (Kekuatan)</td>
                    <td colspan="4" class="whitespace-pre-line font-medium text-justify align-middle" style="width: 60%;">{{ $data->swot->kekuatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="font-weight: bold; color: #000000;">J.2</td>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Weaknesses (Kelemahan) dan Mitigasi</td>
                    <td colspan="4" class="whitespace-pre-line font-medium text-justify align-middle">{{ $data->swot->kelemahan ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="font-weight: bold; color: #000000;">J.3</td>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Opportunities (Peluang)</td>
                    <td colspan="4" class="whitespace-pre-line font-medium text-justify align-middle">{{ $data->swot->peluang ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" class="bg-label text-center align-middle" style="font-weight: bold; color: #000000;">J.4</td>
                    <td colspan="2" class="bg-label align-middle" style="font-weight: bold; color: #000000;">Threats (Ancaman)</td>
                    <td colspan="4" class="whitespace-pre-line font-medium text-justify align-middle">{{ $data->swot->ancaman ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="7" class="sub-header">KESIMPULAN</td>
                </tr>
                <tr>
                    <td colspan="7" class="whitespace-pre-line font-medium text-justify" style="padding: 8px;">{{ $data->swot->kesimpulan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- K. REKOMENDASI -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">K. REKOMENDASI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify font-medium" style="padding: 8px;">{{ $data->swot->rekomendasi ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- L. SYARAT DAN CATATAN LAINNYA -->
        <table class="export-table">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="7" class="section-header" style="text-align: left;">L. SYARAT DAN CATATAN LAINNYA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="whitespace-pre-line text-justify font-medium" style="padding: 8px;">{{ $data->swot->syarat_catatan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>