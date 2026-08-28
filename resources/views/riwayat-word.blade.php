<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pra Survey - {{ $data->nama ?? '-' }}</title>
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
        <h2>FORM PRA SURVEY (MARKETING)</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table">
            <tr>
                <td colspan="4" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">A. DATA DEBITUR</td>
            </tr>
            <tr>
                <!-- Ditambahkan padding-left: 16px di sini -->
                <td class="bg-label" style="width: 20%; padding-left: 16px;">Nomor Register</td>
                <td style="width: 30%; font-weight: bold;">{{ $data->no_register ?? '-' }}</td>
                <td class="bg-label" style="width: 20%;">Nama Marketing</td>
                <td style="width: 30%;">{{ $data->nama_marketing ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">1. Nama Debitur</td>
                <td class="font-bold">{{ $data->nama ?? '-' }}</td>
                <td class="bg-label">Nama Pasangan</td>
                <td>{{ $data->nama_pasangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding-left: 16px;">Usia</td>
                <td>{{ $data->usia ?? '-' }}</td>
                <td class="bg-label">Usia Pasangan</td>
                <td>{{ $data->usia_pasangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">2. Usaha</td>
                <td>{{ $data->usaha ?? '-' }}</td>
                <td class="bg-label">Lama Usaha</td>
                <td>{{ $data->lama_usaha ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">3. Alamat Debitur</td>
                <td colspan="3" class="font-bold">{{ $data->alamat_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding-left: 15px;">Alamat Domisili</td>
                <td colspan="3" class="font-bold">{{ $data->alamat_domisili ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">4. Plafon</td>
                <td class="text-emerald">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
                <td class="bg-label">JKW</td>
                <td>{{ $data->jangka_waktu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" rowspan="2">5. Tujuan Penggunaan</td>
                <td rowspan="2" style="vertical-align: top;">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                <td class="bg-label">Angsuran</td>
                <td class="text-emerald">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bg-label">Type Fasilitas</td>
                <td>{{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}</td>
            </tr>
        </table>

        @php $agunan = $data->agunan_tanah->first() ?? null; @endphp

        <!-- B. DATA JAMINAN -->
        <table class="export-table" style="margin-top: 10px; margin-bottom: 5px;">
            <!-- Header Utama -->
            <tr>
                <td colspan="6" class="section-header-jaminan">
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
                <td class="bg-label-jaminan">Alamat</td>
                <td colspan="5" class="cell-jaminan">{{ $agunan->alamat ?? '-' }}</td>
            </tr>
            
            <!-- Share Loc -->
            <tr>
                <td class="bg-label-jaminan">Share Loc</td>
                <td colspan="5" class="cell-jaminan">
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
            <tr>
                <td class="bg-label-jaminan text-center" style="width: 20%; text-align: center;">Uraian</td>
                <td class="bg-label-jaminan text-center" style="width: 10%; text-align: center;">Luas (m2)</td>
                <td class="bg-label-jaminan text-center" style="width: 14%; text-align: center;">Harga</td>
                <td class="bg-label-jaminan text-center" style="width: 18%; text-align: center;">Nilai Pasar</td>
                <td class="bg-label-jaminan text-center" style="width: 19%; text-align: center;">Nilai Taksasi</td>
                <td class="bg-label-jaminan text-center" style="width: 19%; text-align: center;">Nilai Likuidasi</td>
            </tr>
            <tr>
                <td class="bg-label-jaminan" style="text-align: left; padding-left: 8px;">Tanah</td>
                <td class="cell-jaminan text-center" style="text-align: center;">{{ $agunan->luas_tanah ?? '-' }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->harga_tanah ?? 0, 0, ',', '.') }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->tanah_pasar ?? 0, 0, ',', '.') }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->tanah_taksasi ?? 0, 0, ',', '.') }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->tanah_likuidasi ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bg-label-jaminan" style="text-align: left; padding-left: 8px;">Bangunan</td>
                <td class="cell-jaminan text-center" style="text-align: center;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->harga_bangunan ?? 0, 0, ',', '.') }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->bangunan_pasar ?? 0, 0, ',', '.') }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->bangunan_taksasi ?? 0, 0, ',', '.') }}</td>
                <td class="cell-jaminan text-right">Rp {{ number_format($agunan->bangunan_likuidasi ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="bg-label-jaminan" style="text-align: center; font-weight: bold;">TOTAL</td>
                <td class="bg-label-jaminan text-right">Rp {{ number_format(($agunan->tanah_pasar ?? 0) + ($agunan->bangunan_pasar ?? 0), 0, ',', '.') }}</td>
                <td class="bg-label-jaminan text-right">Rp {{ number_format(($agunan->tanah_taksasi ?? 0) + ($agunan->bangunan_taksasi ?? 0), 0, ',', '.') }}</td>
                <td class="bg-label-jaminan text-right">Rp {{ number_format(($agunan->tanah_likuidasi ?? 0) + ($agunan->bangunan_likuidasi ?? 0), 0, ',', '.') }}</td>
            </tr>

            <!-- Spesifikasi Jaminan -->
            <tr>
                <td class="bg-label-jaminan" style="vertical-align: top;">Spesifikasi Jaminan</td>
                <td colspan="5" class="cell-jaminan" style="white-space: pre-line;">{{ $agunan->spesifikasi ?? '-' }}</td>
            </tr>

            <!-- Denah -->
            <tr>
                <td class="bg-label-jaminan" style="vertical-align: top;">Denah</td>
                <td colspan="5" class="cell-jaminan">
                    @if(!empty($agunan->denah_base64))
                        <!-- text-align diubah jadi left, dan margin di-reset agar rata kiri -->
                        <div style="width: 230px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff; padding: 4px; text-align: left;">
                            <img src="{{ $agunan->denah_base64 }}" alt="Denah Lokasi" width="220" style="width: 220px; display: block; margin: 0;">
                        </div>
                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>

            <!-- Informasi Harga -->
            <tr>
                <td class="bg-label-jaminan" style="vertical-align: top;">Informasi Harga</td>
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
                                <td style="width: 10%; border-top: {{ $loop->first ? '1px solid #0A3370' : 'none' }}; border-bottom: {{ !$loop->last ? '1px solid #d1d5db' : 'none' }}; border-right: 1px solid #d1d5db; border-left: none; text-align: center; padding: 8px; background-color: #f9fafb; font-weight: 500; vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="width: 90%; border-top: {{ $loop->first ? '1px solid #0A3370' : 'none' }}; border-bottom: {{ !$loop->last ? '1px solid #d1d5db' : 'none' }}; border-right: none; border-left: none; padding: 8px; white-space: pre-line; vertical-align: middle;">{{ !empty(trim($info)) ? $info : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>

        <!-- C. SLIK -->
        <table class="export-table" style="margin-top: 8px; width: 100%; border-collapse: collapse;">
            <tr>
                <td colspan="7" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">C. SLIK</td>
            </tr>
            <tr class="bg-label text-center">
                <td style="text-align: center; font-weight: bold;">Nama Bank</td>
                <td style="text-align: center; font-weight: bold;">Plafon</td>
                <td style="text-align: center; font-weight: bold;">Outstanding</td>
                <td style="text-align: center; font-weight: bold;">KOL</td>
                <td style="text-align: center; font-weight: bold;">Angsuran</td>
                <td style="text-align: center; font-weight: bold;">JKW</td>
                <td style="text-align: center; font-weight: bold;">Keterangan</td>
            </tr>
            @forelse($data->pinjaman ?? [] as $slik)
            <tr>
                <td class="text-center" style="text-align: center;">{{ $slik->nama_ljk ?? '-' }}</td>
                <td class="text-right" style="text-align: right;">Rp {{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="text-align: right;">Rp {{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</td>
                <td class="text-center" style="text-align: center;">{{ $slik->kolekbilitas ?? $slik->kolektibilitas ?? '-' }}</td>
                <td class="text-right" style="text-align: right;">Rp {{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</td>
                <td class="text-center" style="text-align: center;">{{ $slik->jkw ?? '-' }}</td>
                <td class="text-center" style="text-align: center;">{{ $slik->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center" style="text-align: center;">Tidak ada data SLIK.</td></tr>
            @endforelse
            <tr class="font-bold bg-label">
                <td class="text-center" style="text-align: center;">TOTAL</td>
                <td class="text-right" style="text-align: right;">Rp {{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</td>
                <td class="text-right" style="text-align: right;">Rp {{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</td>
                <td class="text-center" style="text-align: center;">-</td>
                <td class="text-right" style="text-align: right;">Rp {{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</td>
                <td class="text-center" style="text-align: center;">-</td>
                <td class="text-center" style="text-align: center;">-</td>
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
                <td colspan="6" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">D. INFORMASI USAHA</td>
            </tr>
            <tr>
                <td style="width: 4%; text-align: center;">1.</td>
                <td style="width: 31%;">Omset Usaha</td>
                <td style="width: 5%; border-right: none;">Rp</td>
                <td style="width: 20%; text-align: right; font-weight: bold; border-left: none;">{{ number_format($omset, 0, ',', '.') }}</td>
                <td colspan="2" rowspan="11" style="vertical-align: top; width: 40%; background: #fff;">
                    <div class="font-bold" style="border-bottom: 1px solid #0A3370; padding-bottom: 2px; margin-bottom: 3px;">Deskripsi Usaha :</div>
                    <div style="white-space: pre-line; font-size: 7.5pt;">{{ optional($data->infousaha)->deskripsi_usaha ?? '-' }}</div>
                </td>
            </tr>
            <tr><td style="text-align: center;">2.</td><td>Biaya Operasional</td><td style="border-right: none;">Rp</td><td style="text-align: right; font-weight: bold; border-left: none;">{{ number_format($biaya, 0, ',', '.') }}</td></tr>
            <tr class="bg-label font-bold"><td></td><td>Penghasilan Kotor</td><td style="border-right: none;">Rp</td><td style="text-align: right; border-left: none;">{{ number_format($penghasilanKotor, 0, ',', '.') }}</td></tr>
            <tr><td style="text-align: center;">3.</td><td>Penghasilan Tambahan</td><td style="border-right: none;">Rp</td><td style="text-align: right; font-weight: bold; border-left: none;">{{ number_format($tambahan, 0, ',', '.') }}</td></tr>
            <tr class="bg-label font-bold"><td></td><td>Total Pendapatan</td><td style="border-right: none;">Rp</td><td style="text-align: right; border-left: none;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td></tr>
            <tr><td style="text-align: center;">4.</td><td>Pengeluaran Rumah Tangga</td><td style="border-right: none;">Rp</td><td style="text-align: right; font-weight: bold; border-left: none;">{{ number_format($pengeluaranRT, 0, ',', '.') }}</td></tr>
            <tr class="bg-label font-bold"><td></td><td>Penghasilan Bersih</td><td style="border-right: none;">Rp</td><td class="text-emerald" style="text-align: right; border-left: none;">{{ number_format($penghasilanBersih, 0, ',', '.') }}</td></tr>
            <tr><td style="text-align: center;">5.</td><td>Angsuran Bank Lain</td><td style="border-right: none;">Rp</td><td style="text-align: right; font-weight: bold; border-left: none;">{{ number_format($angsuranBankLain, 0, ',', '.') }}</td></tr>
            <tr class="bg-label font-bold"><td></td><td>Sisa Penghasilan</td><td style="border-right: none;">Rp</td><td style="text-align: right; border-left: none;">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</td></tr>
            <tr><td style="text-align: center;">6.</td><td>Angsuran BPR</td><td style="border-right: none;">Rp</td><td style="text-align: right; font-weight: bold; border-left: none;">{{ number_format($angsuranBpr, 0, ',', '.') }}</td></tr>
            <tr class="bg-label font-bold"><td></td><td>Sisa Penghasilan Bersih</td><td style="border-right: none;">Rp</td><td class="text-emerald" style="text-align: right; border-left: none;">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</td></tr>
        </table>

        <!-- E. LEGALITAS -->
        <table class="export-table" style="margin-top: 8px;">
            <tr><td style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">E. LEGALITAS</td></tr>
            <tr>
                <td style="padding: 5px 8px;">
                    @forelse($data->agunan_tanah ?? [] as $tanah)
                        <div>{{ $tanah->kepemilikan ?? '-' }}</div>
                    @empty
                        -
                    @endforelse
                </td>
            </tr>
        </table>

        <!-- F. CAPITAL -->
        <table class="export-table" style="margin-top: 8px;">
            <tr><td colspan="2" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">F. CAPITAL / ASET YANG DIMILIKI</td></tr>
            @php 
                $capital = $data->capital;
                $asets = [
                    optional($capital)->aset1 ?? '-', 
                    optional($capital)->aset2 ?? '-', 
                    optional($capital)->aset3 ?? '-', 
                    optional($capital)->aset4 ?? '-', 
                    optional($capital)->aset5 ?? '-'
                ];
            @endphp
            @foreach($asets as $index => $aset)
            <tr>
                <td class="bg-label" style="width: 20%;">ASET {{ $index + 1 }}</td>
                <td style="white-space: pre-line; padding: 4px 6px;">{{ trim($aset) !== '' ? $aset : '-' }}</td>
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
        <table class="export-table" style="margin-top: 8px;">
            <tr><td style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">{{ $sec['title'] }}</td></tr>
            <tr>
                <td style="padding: 5px 8px; white-space: pre-line;">
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