<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pra Survey - {{ $data->nama ?? '-' }}</title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10pt;
            color: #000;
            line-height: 1.2;
            margin: 0;
            padding: 0;
        }

        .page-container {
            width: 100%;
        }

        h2 {
            text-align: center;
            font-size: 14pt;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table td {
            border: 0.5pt solid #000;
            padding: 5px;
            vertical-align: top;
        }

        /* HEADER TABEL BERWARNA BIRU TUA SESUAI GAMBAR */
        .header-title {
            background-color: #0A3370 !important;
            color: #ffffff !important;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
            text-align: left;
            padding: 6px 8px;
            -webkit-print-color-adjust: exact;
        }

        .bg-label {
            background-color: #f3f4f6 !important;
            font-weight: bold;
            width: 25%;
            -webkit-print-color-adjust: exact;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body onload="window.print()">

    <div class="page-container">
        <h2>FORM PRA SURVEY (MARKETING)</h2>

        <!-- A. DATA DEBITUR -->
        <table>
            <tr><td colspan="4" class="header-title">A. DATA DEBITUR</td></tr>
            <tr>
                <td class="bg-label">Nomor Register</td>
                <td>{{ $data->no_register ?? '-' }}</td>
                <td class="bg-label">Nama Marketing</td>
                <td>{{ $data->nama_marketing ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">1. Nama Debitur</td>
                <td class="font-bold">{{ $data->nama ?? '-' }}</td>
                <td class="bg-label">Nama Pasangan</td>
                <td>{{ $data->datalengkap->nama_pasangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">Usia</td>
                <td>{{ optional($data->datalengkap)->usia ? $data->datalengkap->usia . ' Tahun' : '-' }}</td>
                <td class="bg-label">Usia Pasangan</td>
                <td>{{ optional($data->datalengkap)->usia_pasangan ? $data->datalengkap->usia_pasangan . ' Tahun' : '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">2. Usaha</td>
                <td>{{ optional($data->infousaha)->jenis_usaha ?? '-' }}</td>
                <td class="bg-label">Lama Usaha</td>
                <td>{{ optional($data->infousaha)->lama_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">3. Alamat Debitur</td>
                <td colspan="3" class="font-bold">{{ $data->alamat_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">Alamat Domisili</td>
                <td colspan="3" class="font-bold">{{ $data->alamat_domisili ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">4. Plafon</td>
                <td class="font-bold">Rp {{ number_format(optional($data->pinjaman_utama)->plafon ?? 0, 0, ',', '.') }}</td>
                <td class="bg-label">JKW</td>
                <td>{{ optional($data->pinjaman_utama)->jangka_waktu ? optional($data->pinjaman_utama)->jangka_waktu . ' Bulan' : '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">5. Tujuan Penggunaan</td>
                <td>{{ optional($data->pinjaman_utama)->tujuan_penggunaan ?? '-' }}</td>
                <td class="bg-label">Angsuran</td>
                <td class="font-bold">Rp {{ number_format(optional($data->pinjaman_utama)->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- B. DATA JAMINAN -->
        @php $agunan = $data->agunan_tanah->first() ?? null; @endphp
        <table>
            <tr><td colspan="6" class="header-title">B. DATA JAMINAN</td></tr>
            <tr>
                <td class="bg-label" style="width: 20%;">Kepemilikan</td>
                <td colspan="5">{{ $agunan->kepemilikan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">Alamat</td>
                <td colspan="5">{{ $agunan->alamat ?? '-' }}</td>
            </tr>
            <tr style="background-color: #0A3370; color: white;">
                <td style="border: 0.5pt solid #000; padding: 5px; font-weight: bold;">Uraian</td>
                <td style="border: 0.5pt solid #000; padding: 5px; font-weight: bold;">Luas (m2)</td>
                <td style="border: 0.5pt solid #000; padding: 5px; font-weight: bold;">Harga</td>
                <td style="border: 0.5pt solid #000; padding: 5px; font-weight: bold;">Nilai Pasar</td>
                <td style="border: 0.5pt solid #000; padding: 5px; font-weight: bold;">Nilai Taksasi</td>
                <td style="border: 0.5pt solid #000; padding: 5px; font-weight: bold;">Nilai Likuidasi</td>
            </tr>
            <tr>
                <td class="bg-label">Tanah</td>
                <td class="text-center">{{ $agunan->luas_tanah ?? '-' }}</td>
                <td class="text-right">{{ number_format($agunan->harga_tanah ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($agunan->tanah_pasar ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($agunan->tanah_taksasi ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($agunan->tanah_likuidasi ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bg-label">Bangunan</td>
                <td class="text-center">{{ $agunan->luas_bangunan ?? '-' }}</td>
                <td class="text-right">{{ number_format($agunan->harga_bangunan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($agunan->bangunan_pasar ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($agunan->bangunan_taksasi ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($agunan->bangunan_likuidasi ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- C. SLIK -->
        <table class="export-table">
            <tr>
                <td colspan="7" class="header-title">C. SLIK</td>
            </tr>
            <tr class="bg-label text-center">
                <td style="width: 22%;">Nama Bank</td>
                <td style="width: 14%;">Plafon</td>
                <td style="width: 14%;">Outstanding</td>
                <td style="width: 8%;">KOL</td>
                <td style="width: 14%;">Angsuran</td>
                <td style="width: 8%;">JKW</td>
                <td style="width: 20%;">Keterangan</td>
            </tr>
            @forelse($data->pinjaman ?? [] as $slik)
            <tr>
                <td>{{ $slik->nama_ljk ?? '-' }}</td>
                <td class="text-right">{{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $slik->kolekbilitas ?? $slik->kolektibilitas ?? '-' }}</td>
                <td class="text-right">{{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $slik->jkw ?? '-' }}</td>
                <td>{{ $slik->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Tidak ada data SLIK.</td></tr>
            @endforelse
            <tr class="font-bold bg-label">
                <td class="text-center">TOTAL</td>
                <td class="text-right">{{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">-</td>
                <td class="text-right">{{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">-</td>
                <td>-</td>
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

        <table class="export-table">
            <tr>
                <td colspan="6" class="header-title">D. INFORMASI USAHA</td>
            </tr>
            <tr>
                <td style="width: 5%; padding: 2.5px;">1.</td>
                <td style="width: 32%; padding: 2.5px;">Omset Usaha</td>
                <td style="width: 6%; padding: 2.5px; text-align: right;">Rp</td>
                <td style="width: 17%; padding: 2.5px; text-align: right; font-weight: bold; border-right: 1px solid #444444;">{{ number_format($omset, 0, ',', '.') }}</td>
                <td colspan="2" rowspan="12" style="vertical-align: top; padding: 4px; width: 40%; background-color: #fff;">
                    <div class="font-bold" style="margin-bottom: 2px; border-bottom: 1px solid #ddd;">Deskripsi Usaha :</div>
                    <div style="white-space: pre-line; color: #333; font-size: 7.5pt;">
                        {{ optional($data->infousaha)->deskripsi_usaha ?? '-' }}
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 2.5px;">2.</td>
                <td style="padding: 2.5px;">Biaya Operasional</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; font-weight: bold; border-right: 1px solid #444444;">{{ number_format($biaya, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 2.5px;"></td>
                <td style="padding: 2.5px;">Penghasilan Kotor</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; border-right: 1px solid #444444;">{{ number_format($penghasilanKotor, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 2.5px;">3.</td>
                <td style="padding: 2.5px;">Penghasilan Tambahan</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; font-weight: bold; border-right: 1px solid #444444;">{{ number_format($tambahan, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 2.5px;"></td>
                <td style="padding: 2.5px;">Total Pendapatan</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; border-right: 1px solid #444444;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 2.5px;">4.</td>
                <td style="padding: 2.5px;">Pengeluaran Rumah Tangga</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; font-weight: bold; border-right: 1px solid #444444;">{{ number_format($pengeluaranRT, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 2.5px;"></td>
                <td style="padding: 2.5px;">Penghasilan Bersih</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; border-right: 1px solid #444444;">{{ number_format($penghasilanBersih, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 2.5px;">5.</td>
                <td style="padding: 2.5px;">Angsuran Bank Lain</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; font-weight: bold; border-right: 1px solid #444444;">{{ number_format($angsuranBankLain, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 2.5px;"></td>
                <td style="padding: 2.5px;">Sisa Penghasilan</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; border-right: 1px solid #444444;">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 2.5px;">6.</td>
                <td style="padding: 2.5px;">Angsuran BPR</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; font-weight: bold; border-right: 1px solid #444444;">{{ number_format($angsuranBpr, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label font-bold">
                <td style="padding: 2.5px;"></td>
                <td style="padding: 2.5px;">Sisa Penghasilan Bersih</td>
                <td style="padding: 2.5px; text-align: right;">Rp</td>
                <td style="padding: 2.5px; text-align: right; border-right: 1px solid #444444;">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- E. LEGALITAS -->
        @forelse($data->agunan_tanah ?? [] as $tanah)
        <table class="export-table">
            <tr>
                <td class="header-title">E. LEGALITAS {{ $tanah->urutan ? '- ' . $tanah->urutan : '' }}</td>
            </tr>
            <tr>
                <td style="padding: 4px 6px; white-space: pre-line;">{{ $tanah->kepemilikan ?? '-' }}</td>
            </tr>
        </table>
        @empty
        <table class="export-table">
            <tr>
                <td class="header-title">E. LEGALITAS</td>
            </tr>
            <tr>
                <td style="padding: 4px 6px;">-</td>
            </tr>
        </table>
        @endforelse

        <!-- F. CAPITAL -->
        <table class="export-table">
            <tr>
                <td colspan="2" class="header-title">F. CAPITAL / ASET YANG DIMILIKI</td>
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
                <td class="bg-label" style="width: 20%;">ASET {{ $index + 1 }}</td>
                <td style="white-space: pre-line;">{{ !empty(trim($aset)) ? $aset : '-' }}</td>
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
        <table class="export-table">
            <tr>
                <td class="header-title">{{ $sec['title'] }}</td>
            </tr>
            <tr>
                <td style="padding: 4px 6px; white-space: pre-line;">
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