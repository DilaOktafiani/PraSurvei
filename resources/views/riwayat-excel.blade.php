<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pra Survey - {{ $data->nama ?? '-' }}</title>
    <style>
        /* Mengatur agar tabel benar-benar mirip grid Excel */
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Calibri', 'Arial', sans-serif; /* Font standar Excel */
            font-size: 10pt;
            background-color: #ffffff;
        }
        th, td {
            border: 1px solid #d9d9d9; /* Warna garis grid tipis ala Excel */
            padding: 5px 8px;
            vertical-align: middle;
        }
        .header-section {
            background-color: #1f4e78; /* Warna biru gelap ala Excel header */
            color: #FFFFFF;
            font-weight: bold;
            text-transform: uppercase;
            text-align: left;
            padding-left: 8px;
            border: 1px solid #1f4e78;
        }
        .header-center {
            text-align: center !important;
        }
        .bg-label {
            background-color: #f2f2f2; /* Warna abu-abu terang ala header kolom Excel */
            font-weight: bold;
            color: #333333;
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
        .font-bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <th colspan="6" class="header-section header-center" style="font-size: 12pt; padding: 8px;">FORM PRA SURVEY (MARKETING)</th>
        </tr>

        <!-- A. DATA DEBITUR -->
        <tr><th colspan="6" class="header-section">A. DATA DEBITUR</th></tr>
        <tr>
            <td class="bg-label" style="width: 20%;">Nomor Register</td>
            <td colspan="2" style="width: 30%;">{{ $data->no_register ?? '-' }}</td>
            <td class="bg-label" style="width: 20%;">Nama Marketing</td>
            <td colspan="2" style="width: 30%;">{{ $data->nama_marketing ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">1. Nama Debitur</td>
            <td colspan="2"><b>{{ $data->nama ?? '-' }}</b></td>
            <td class="bg-label">Nama Pasangan</td>
            <td colspan="2">{{ optional($data->datalengkap)->nama_pasangan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label" style="padding-left: 18px;">Usia</td>
            <td colspan="2">{{ optional($data->datalengkap)->usia ? $data->datalengkap->usia . ' Tahun' : '-' }}</td>
            <td class="bg-label">Usia Pasangan</td>
            <td colspan="2">{{ optional($data->datalengkap)->usia_pasangan ? $data->datalengkap->usia_pasangan . ' Tahun' : '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">2. Usaha</td>
            <td colspan="2">{{ optional($data->infousaha)->jenis_usaha ?? '-' }}</td>
            <td class="bg-label">Lama Usaha</td>
            <td colspan="2">{{ optional($data->infousaha)->lama_usaha ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">3. Alamat Debitur</td>
            <td colspan="5"><b>{{ $data->alamat_ktp ?? '-' }}</b></td>
        </tr>
        <tr>
            <td class="bg-label" style="padding-left: 17px;">Alamat Domisili</td>
            <td colspan="5"><b>{{ $data->alamat_domisili ?? '-' }}</b></td>
        </tr>
        <tr>
            <td class="bg-label">4. Plafon</td>
            <td colspan="2" class="text-emerald">{{ optional($data->pinjaman_utama)->plafon ?? 0 }}</td>
            <td class="bg-label">JKW</td>
            <td colspan="2">{{ optional($data->pinjaman_utama)->jangka_waktu ? optional($data->pinjaman_utama)->jangka_waktu . ' Bulan' : '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label" rowspan="2">5. Tujuan Penggunaan</td>
            <td colspan="2" rowspan="2" style="vertical-align: top;">{{ optional($data->pinjaman_utama)->tujuan_penggunaan ?? '-' }}</td>
            <td class="bg-label">Angsuran</td>
            <td colspan="2" class="text-emerald">{{ optional($data->pinjaman_utama)->estimasi_kewajiban ?? 0 }}</td>
        </tr>
        <tr>
            <td class="bg-label">Type Fasilitas</td>
            <td colspan="2">
                @php $tf = optional($data->pinjaman_utama)->tipe_fasilitas; @endphp
                {{ is_array($tf) ? implode(', ', $tf) : ($tf ?? '-') }}
            </td>
        </tr>

        @php $agunan = $data->agunan_tanah->first() ?? null; @endphp

        <!-- B. DATA JAMINAN -->
        <tr><th colspan="6" class="header-section">B. DATA JAMINAN</th></tr>
        <tr><td class="bg-label">1. Kepemilikan</td><td colspan="5">{{ $agunan->kepemilikan ?? '-' }}</td></tr>
        <tr><td class="bg-label">Alamat</td><td colspan="5">{{ $agunan->alamat ?? '-' }}</td></tr>
        <tr><td class="bg-label">Share Loc</td><td colspan="5">{{ $agunan->share_location ?? '-' }}</td></tr>
        <tr class="bg-label" style="text-align: center;">
            <td style="text-align: center;">Uraian</td>
            <td style="text-align: center;">Luas (m2)</td>
            <td style="text-align: center;">Harga</td>
            <td style="text-align: center;">Nilai Pasar</td>
            <td style="text-align: center;">Nilai Taksasi</td>
            <td style="text-align: center;">Nilai Likuidasi</td>
        </tr>
        <tr>
            <td class="bg-label">Tanah</td>
            <td class="text-center">{{ $agunan->luas_tanah ?? '-' }}</td>
            <td class="text-right">{{ $agunan->harga_tanah ?? 0 }}</td>
            <td class="text-right">{{ $agunan->tanah_pasar ?? 0 }}</td>
            <td class="text-right">{{ $agunan->tanah_taksasi ?? 0 }}</td>
            <td class="text-right">{{ $agunan->tanah_likuidasi ?? 0 }}</td>
        </tr>
        <tr>
            <td class="bg-label">Bangunan</td>
            <td class="text-center">{{ $agunan->luas_bangunan ?? '-' }}</td>
            <td class="text-right">{{ $agunan->harga_bangunan ?? 0 }}</td>
            <td class="text-right">{{ $agunan->bangunan_pasar ?? 0 }}</td>
            <td class="text-right">{{ $agunan->bangunan_taksasi ?? 0 }}</td>
            <td class="text-right">{{ $agunan->bangunan_likuidasi ?? 0 }}</td>
        </tr>
        <tr style="font-weight: bold;" class="bg-label">
            <td colspan="3" class="text-center">TOTAL</td>
            <td class="text-right">{{ ($agunan->tanah_pasar ?? 0) + ($agunan->bangunan_pasar ?? 0) }}</td>
            <td class="text-right">{{ ($agunan->tanah_taksasi ?? 0) + ($agunan->bangunan_taksasi ?? 0) }}</td>
            <td class="text-right">{{ ($agunan->tanah_likuidasi ?? 0) + ($agunan->bangunan_likuidasi ?? 0) }}</td>
        </tr>
        <tr>
            <td class="bg-label">Spesifikasi Jaminan</td>
            <td colspan="5" style="white-space: pre-line;">{{ $agunan->spesifikasi ?? '-' }}</td>
        </tr>

        <!-- Denah -->
        <tr>
            <td class="bg-label" style="background-color: #f2f2f2 !important; border: 1px solid #d9d9d9 !important; font-weight: bold; padding: 5px 8px; vertical-align: top;">Denah</td>
            <td colspan="5" style="border: 1px solid #d9d9d9 !important; padding: 5px 8px;">
                @if(!empty($agunan->denah) && $agunan->denah !== '-')
                    <div style="width: 100%; max-width: 300px; border: 1px solid #d9d9d9; border-radius: 2px; overflow: hidden; background: #fff;">
                        <img src="{{ asset('storage/' . $agunan->denah) }}" alt="Denah Lokasi" style="width: 100%; height: auto; max-height: 250px; object-fit: cover;">
                    </div>
                @else
                    <div style="padding: 4px 0;">-</div>
                @endif
            </td>
        </tr>

        <!-- Informasi Harga -->
        <tr>
            <td class="bg-label" style="background-color: #f2f2f2 !important; border: 1px solid #d9d9d9 !important; font-weight: bold; padding: 5px 8px; vertical-align: top;">Informasi Harga</td>
            <td colspan="5" style="border: 1px solid #d9d9d9 !important; padding: 0 !important;">
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
                            <td style="width: 10%; border-top: {{ $loop->first ? 'none' : '1px solid #d9d9d9' }}; border-bottom: none; border-right: 1px solid #d9d9d9; border-left: none; text-align: center; padding: 5px 8px; background-color: #f2f2f2; font-weight: bold; vertical-align: middle;">{{ $index + 1 }}</td>
                            <td style="width: 90%; border-top: {{ $loop->first ? 'none' : '1px solid #d9d9d9' }}; border-bottom: none; border-right: none; border-left: none; padding: 5px 8px; white-space: pre-line; vertical-align: middle;">{{ !empty(trim($info)) ? $info : '-' }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

        <!-- C. SLIK -->
        <tr><th colspan="6" class="header-section">C. SLIK</th></tr>
        <tr class="bg-label" style="text-align: center;">
            <td style="text-align: center;">Nama Bank</td>
            <td style="text-align: center;">Plafon</td>
            <td style="text-align: center;">Outstanding</td>
            <td style="text-align: center;">KOL</td>
            <td style="text-align: center;">Angsuran</td>
            <td style="text-align: center;">JKW / Keterangan</td>
        </tr>
        @forelse($data->pinjaman ?? [] as $slik)
        <tr>
            <td>{{ $slik->nama_ljk ?? '-' }}</td>
            <td class="text-right">{{ $slik->plafon ?? 0 }}</td>
            <td class="text-right">{{ $slik->outstanding ?? 0 }}</td>
            <td class="text-center">{{ $slik->kolekbilitas ?? $slik->kolektibilitas ?? '-' }}</td>
            <td class="text-right">{{ $slik->angsuran ?? 0 }}</td>
            <td>{{ $slik->jkw ?? '-' }} - {{ $slik->keterangan ?? '-' }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Tidak ada data SLIK.</td></tr>
        @endforelse
        <tr style="font-weight: bold;" class="bg-label">
            <td class="text-center">TOTAL</td>
            <td class="text-right">{{ $data->pinjaman->sum('plafon') ?? 0 }}</td>
            <td class="text-right">{{ $data->pinjaman->sum('outstanding') ?? 0 }}</td>
            <td class="text-center">-</td>
            <td class="text-right">{{ $data->pinjaman->sum('angsuran') ?? 0 }}</td>
            <td>-</td>
        </tr>

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
        <tr><th colspan="6" class="header-section">D. INFORMASI USAHA</th></tr>
        <tr>
            <td style="text-align: center; width: 5%;">1.</td>
            <td style="width: 35%;">Omset Usaha</td>
            <td style="width: 5%;">Rp</td>
            <td style="text-align: right; width: 15%;" class="font-bold">{{ $omset }}</td>
            <td colspan="2" rowspan="11" style="vertical-align: top; width: 40%;">
                <div style="font-weight: bold; border-bottom: 1px solid #d9d9d9; padding-bottom: 2px; margin-bottom: 3px;">Deskripsi Usaha :</div>
                <div style="white-space: pre-line;">{{ optional($data->infousaha)->deskripsi_usaha ?? '-' }}</div>
            </td>
        </tr>
        <tr><td style="text-align: center;">2.</td><td>Biaya Operasional</td><td>Rp</td><td style="text-align: right;" class="font-bold">{{ $biaya }}</td></tr>
        <tr class="bg-label font-bold"><td></td><td>Penghasilan Kotor</td><td>Rp</td><td style="text-align: right;">{{ $penghasilanKotor }}</td></tr>
        <tr><td style="text-align: center;">3.</td><td>Penghasilan Tambahan</td><td>Rp</td><td style="text-align: right;" class="font-bold">{{ $tambahan }}</td></tr>
        <tr class="bg-label font-bold"><td></td><td>Total Pendapatan</td><td>Rp</td><td style="text-align: right;">{{ $totalPendapatan }}</td></tr>
        <tr><td style="text-align: center;">4.</td><td>Pengeluaran Rumah Tangga</td><td>Rp</td><td style="text-align: right;" class="font-bold">{{ $pengeluaranRT }}</td></tr>
        <tr class="bg-label font-bold"><td></td><td>Penghasilan Bersih</td><td>Rp</td><td style="text-align: right;" class="text-emerald">{{ $penghasilanBersih }}</td></tr>
        <tr><td style="text-align: center;">5.</td><td>Angsuran Bank Lain</td><td>Rp</td><td style="text-align: right;" class="font-bold">{{ $angsuranBankLain }}</td></tr>
        <tr class="bg-label font-bold"><td></td><td>Sisa Penghasilan</td><td>Rp</td><td style="text-align: right;">{{ $sisaPenghasilan }}</td></tr>
        <tr><td style="text-align: center;">6.</td><td>Angsuran BPR</td><td>Rp</td><td style="text-align: right;" class="font-bold">{{ $angsuranBpr }}</td></tr>
        <tr class="bg-label font-bold"><td></td><td>Sisa Penghasilan Bersih</td><td>Rp</td><td style="text-align: right;" class="text-emerald">{{ $sisaPenghasilanBersih }}</td></tr>

        <!-- E. LEGALITAS -->
        <tr><th colspan="6" class="header-section">E. LEGALITAS</th></tr>
        <tr>
            <td colspan="6">
                @forelse($data->agunan_tanah ?? [] as $tanah)
                    <div>{{ $tanah->kepemilikan ?? '-' }}</div>
                @empty
                    -
                @endforelse
            </td>
        </tr>

        <!-- F. CAPITAL -->
        <tr><th colspan="6" class="header-section">F. CAPITAL / ASET YANG DIMILIKI</th></tr>
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
            <td class="bg-label">ASET {{ $index + 1 }}</td>
            <td colspan="5" style="white-space: pre-line;">{{ trim($aset) !== '' ? $aset : '-' }}</td>
        </tr>
        @endforeach

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
        <tr><th colspan="6" class="header-section">{{ $sec['title'] }}</th></tr>
        <tr>
            <td colspan="6" style="white-space: pre-line;">
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
        @endforeach
    </table>

</body>
</html>