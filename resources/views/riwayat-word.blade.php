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
        <h2>FORM PRA SURVEY</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table">
            <tr>
                <td colspan="4" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">A. DATA DEBITUR</td>
            </tr>
            <tr>
                <td class="bg-label" style="width: 20%; padding-left: 16px;">Nomor Register</td>
                <td style="width: 30%; font-weight: bold;">{{ $data->no_register ?? '-' }}</td>
                <td class="bg-label" style="width: 20%;">Nama Marketing</td>
                <td style="width: 30%;">{{ $data->nama_marketing ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">1. Nama Debitur</td>
                <td class="font-bold">{{ $data->nama ?? '-' }}</td>
                <td class="bg-label">Nama Pasangan</td>
                <td class="font-bold">{{ $data->nama_pasangan ?? '-' }}</td>
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
                <td colspan="3" class="font-normal">{{ $data->alamat_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" style="padding-left: 15px;">Alamat Domisili</td>
                <td colspan="3" class="font-normal">{{ $data->alamat_domisili ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label">4. Plafon</td>
                <td class="font-bold text-black">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td><td class="bg-label">JKW</td>
                <td>{{ $data->jangka_waktu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="bg-label" rowspan="2">5. Tujuan Penggunaan</td>
                <td rowspan="2" style="vertical-align: top;">{{ $data->tujuan_penggunaan ?? '-' }}</td>
                <td class="bg-label">Angsuran</td>
                <td class="font-bold text-black">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td></tr>
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
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</td>
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</td>
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</td>
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bg-label-jaminan" style="text-align: left; padding-left: 8px;">Bangunan</td>
                <td class="cell-jaminan text-center" style="text-align: center;">{{ $agunan->luas_bangunan ?? '-' }}</td>
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</td>
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</td>
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</td>
                <td class="cell-jaminan" style="text-align: right; padding-right: 8px;">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="bg-label-jaminan" style="text-align: center; font-weight: bold;">TOTAL</td>
                <td class="bg-label-jaminan" style="text-align: right; padding-right: 8px; font-weight: bold;">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</td>
                <td class="bg-label-jaminan" style="text-align: right; padding-right: 8px; font-weight: bold;">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</td>
                <td class="bg-label-jaminan" style="text-align: right; padding-right: 8px; font-weight: bold;">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</td>
            </tr>

            <!-- Spesifikasi Jaminan -->
            <tr>
                <td class="bg-label" style="background-color: #f3f4f6 !important; border: 1px solid #0A3370 !important; font-weight: bold; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 8px; vertical-align: top;">Spesifikasi Jaminan</td>
                <td colspan="5" style="border: 1px solid #0A3370 !important; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word;">{{ $agunan->spesifikasi ?? '-' }}</td>
            </tr>

            <!-- Denah -->
            <tr>
                <td class="bg-label-jaminan" style="vertical-align: top;">Denah</td>
                <td colspan="5" class="cell-jaminan">
                    @if(!empty($agunan->denah_base64))
                        <!-- Gunakan max-width dan height: auto agar aspek rasio asli terjaga -->
                        <div style="max-width: 230px; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden; background: #fff; padding: 4px; text-align: left;">
                            <img src="{{ $agunan->denah_base64 }}" alt="Denah Lokasi" style="max-width: 100%; height: auto; display: block; margin: 0;">
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
                                <td style="width: 90%; border-top: {{ $loop->first ? 'none' : '1px solid #d1d5db' }}; border-bottom: {{ $loop->last ? 'none' : '1px solid #d1d5db' }}; border-right: none; border-left: none; padding: 8px; white-space: pre-line; text-align: justify; text-justify: inter-word;">{{ !empty(trim($info)) ? $info : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>

        <!-- C. SLIK -->
        <table class="export-table" style="margin-top: 8px; table-layout: fixed; width: 100%;">
            <tr>
                <td colspan="7" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">C. SLIK</td>
            </tr>
            <tr class="bg-label text-center">
                <td style="width: 21%; text-align: center;">Nama Bank</td>
                <td style="width: 11%; text-align: center;">Plafon</td>
                <td style="width: 11%; text-align: center;">Outstanding</td>
                <td style="width: 5%; text-align: center;">KOL</td>
                <td style="width: 11%; text-align: center;">Angsuran</td>
                <td style="width: 4%; text-align: center;">JKW</td>
                <td style="width: 36%; text-align: center;">Keterangan</td>
            </tr>
            @forelse($data->pinjaman ?? [] as $slik)
            <tr>
                <td class="text-center" style="word-wrap: break-word;">{{ $slik->nama_ljk ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $slik->kolekbilitas ?? $slik->kolektibilitas ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $slik->jkw ?? '-' }}</td>
                <td class="text-center" style="word-wrap: break-word;">{{ $slik->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Tidak ada data SLIK.</td></tr>
            @endforelse
            <tr class="font-bold bg-label">
                <td class="text-center">TOTAL</td>
                <td class="text-right">Rp {{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">-</td>
                <td class="text-right">Rp {{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
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
                <td style="width: 31%; font-weight: normal;">Omset Usaha</td>
                <td style="width: 5%; border-right: none; font-weight: normal;">Rp</td>
                <td style="width: 20%; text-align: right; font-weight: normal; border-left: none;">{{ number_format($omset, 0, ',', '.') }}</td>
                <td colspan="2" rowspan="11" style="vertical-align: top; width: 40%; background: #fff;">
                    <div class="font-bold" style="padding-bottom: 2px; margin-bottom: 6px; padding-top: 4px;">Deskripsi Usaha :</div>
                    <div style="white-space: pre-line; font-size: 8pt; text-align: justify;">{{ optional($data->infousaha)->deskripsi_usaha ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal;">2.</td>
                <td style="font-weight: normal;">Biaya Operasional</td>
                <td style="border-right: none; font-weight: normal;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none;">{{ number_format($biaya, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal;"></td>
                <td class="text-black font-bold">Penghasilan Kotor</td>
                <td style="border-right: none;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none;" class="text-black font-bold">{{ number_format($penghasilanKotor, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal;">3.</td>
                <td style="font-weight: normal;">Penghasilan Tambahan</td>
                <td style="border-right: none; font-weight: normal;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none;">{{ number_format($tambahan, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal;"></td>
                <td class="text-black font-bold">Total Pendapatan</td>
                <td style="border-right: none;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none;" class="text-black font-bold">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal;">4.</td>
                <td style="font-weight: normal;">Pengeluaran Rumah Tangga</td>
                <td style="border-right: none; font-weight: normal;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none;">{{ number_format($pengeluaranRT, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal;"></td>
                <td class="text-black font-bold">Penghasilan Bersih</td>
                <td style="border-right: none;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none;" class="text-black font-bold">{{ number_format($penghasilanBersih, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal;">5.</td>
                <td style="font-weight: normal;">Angsuran Bank Lain</td>
                <td style="border-right: none; font-weight: normal;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none;">{{ number_format($angsuranBankLain, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal;"></td>
                <td class="text-black font-bold">Sisa Penghasilan</td>
                <td style="border-right: none;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none;" class="text-black font-bold">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: normal;">6.</td>
                <td style="font-weight: normal;">Angsuran BPR</td>
                <td style="border-right: none; font-weight: normal;">Rp</td>
                <td style="text-align: right; font-weight: normal; border-left: none;">{{ number_format($angsuranBpr, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-label">
                <td style="font-weight: normal;"></td>
                <td class="text-black font-bold">Sisa Penghasilan Bersih</td>
                <td style="border-right: none;" class="text-black font-bold">Rp</td>
                <td style="text-align: right; border-left: none;" class="text-black font-bold">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</td>
            </tr>
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
                <td style="white-space: pre-line; padding: 4px 6px; text-align: justify; text-justify: inter-word;">{{ trim($aset) !== '' ? $aset : '-' }}</td>
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