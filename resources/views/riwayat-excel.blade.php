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
            <th colspan="6" class="header-section header-center" style="font-size: 12pt; padding: 8px;">FORM PRA SURVEY</th>
        </tr>

        <!-- A. DATA DEBITUR -->
        <tr><th colspan="6" class="header-section" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">A. DATA DEBITUR</th></tr>
        <tr>
            <td class="bg-label" style="width: 20%;">Nomor Register</td>
            <td colspan="2" style="width: 30%;"><b>{{ $data->no_register ?? '-' }}</b></td>
            <td class="bg-label" style="width: 20%;">Nama Marketing</td>
            <td colspan="2" style="width: 30%;">{{ $data->nama_marketing ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">1. Nama Debitur</td>
            <td colspan="2"><b>{{ $data->nama ?? '-' }}</b></td>
            <td class="bg-label">Nama Pasangan</td>
            <td colspan="2"><b>{{ $data->nama_pasangan ?? '-' }}</b></td>
        </tr>
        <tr>
            <td class="bg-label">Usia</td>
            <td colspan="2">{{ $data->usia ?? '-' }}</td>
            <td class="bg-label">Usia Pasangan</td>
            <td colspan="2">{{ $data->usia_pasangan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">2. Usaha</td>
            <td colspan="2">{{ $data->usaha ?? '-' }}</td>
            <td class="bg-label">Lama Usaha</td>
            <td colspan="2">{{ $data->lama_usaha ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">3. Alamat Debitur</td>
            <td colspan="5">{{ $data->alamat_ktp ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">Alamat Domisili</td>
            <td colspan="5">{{ $data->alamat_domisili ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label">4. Plafon</td>
            <td colspan="2" style="color: #000000; font-weight: bold;">Rp {{ number_format($data->plafon ?? 0, 0, ',', '.') }}</td>
            <td class="bg-label">JKW</td>
            <td colspan="2">{{ $data->jangka_waktu ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-label" rowspan="2" style="vertical-align: top !important;">5. Tujuan Penggunaan</td>
            <td colspan="2" rowspan="2" style="vertical-align: top !important; word-break: break-word;">{{ $data->tujuan_penggunaan ?? '-' }}</td>
            <td class="bg-label">Angsuran</td>
            <td colspan="2" style="color: #000000; font-weight: bold;">Rp {{ number_format($data->estimasi_kewajiban ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="bg-label">Type Fasilitas</td>
            <td colspan="2">
                {{ is_array($data->tipe_fasilitas ?? null) ? implode(', ', $data->tipe_fasilitas) : ($data->tipe_fasilitas ?? '-') }}
            </td>
        </tr>

        @php $agunan = $data->agunan_tanah->first() ?? null; @endphp

        <!-- B. DATA JAMINAN -->
        <tr><th colspan="6" class="header-section" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">B. DATA JAMINAN</th></tr>
        <tr><td class="bg-label"><b>Kepemilikan</b></td><td colspan="5"><b>{{ $agunan->kepemilikan ?? '-' }}</b></td></tr>
        <tr><td class="bg-label">Alamat</td><td colspan="5">{{ $agunan->alamat ?? '-' }}</td></tr>
        <tr><td class="bg-label">Share Loc</td><td colspan="5">{{ $agunan->share_location ?? '-' }}</td></tr>
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
        <tr class="bg-label text-center">
            <td style="width: 15%; text-align: center; font-weight: bold;">Uraian</td>
            <td style="width: 10%; text-align: center; font-weight: bold;">Luas (m2)</td>
            <td style="width: 15%; text-align: center; font-weight: bold;">Harga</td>
            <td style="width: 20%; text-align: center; font-weight: bold;">Nilai Pasar</td>
            <td style="width: 20%; text-align: center; font-weight: bold;">Nilai Taksasi</td>
            <td style="width: 20%; text-align: center; font-weight: bold;">Nilai Likuidasi</td>
        </tr>
        <tr>
            <td class="bg-label" style="width: 15%; text-align: left; padding-left: 8px;">Tanah</td>
            <td class="text-center" style="width: 10%;">{{ $agunan->luas_tanah ?? '-' }}</td>
            <td class="text-right" style="width: 15%; padding-right: 8px;">Rp {{ number_format($hargaTanah, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($tanahPasar, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($tanahTaksasi, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($tanahLikuidasi, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="bg-label" style="width: 15%; text-align: left; padding-left: 8px;">Bangunan</td>
            <td class="text-center" style="width: 10%;">{{ $agunan->luas_bangunan ?? '-' }}</td>
            <td class="text-right" style="width: 15%; padding-right: 8px;">Rp {{ number_format($hargaBangunan, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($bangunanPasar, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($bangunanTaksasi, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($bangunanLikuidasi, 0, ',', '.') }}</td>
        </tr>
        <tr style="font-weight: bold;" class="bg-label">
            <td colspan="3" class="text-center" style="text-align: center; width: 40%;">TOTAL</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($tanahPasar + $bangunanPasar, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($tanahTaksasi + $bangunanTaksasi, 0, ',', '.') }}</td>
            <td class="text-right" style="width: 20%; padding-right: 8px;">Rp {{ number_format($tanahLikuidasi + $bangunanLikuidasi, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="bg-label">Spesifikasi Jaminan</td>
            <td colspan="5" style="white-space: pre-line; text-align: justify; mso-element-para-indent-alt: 0;">{{ $agunan->spesifikasi ?? '-' }}</td>
        </tr>

        <!-- Denah -->
        <tr>
            <td class="bg-label" style="background-color: #f2f2f2 !important; border: 1px solid #d9d9d9 !important; font-weight: bold; padding: 5px 8px; vertical-align: top;">Denah</td>
            <td colspan="5" style="border: 1px solid #d9d9d9 !important; padding: 5px 8px;">
                @if(!empty($agunan->denah) && $agunan->denah !== '-')
                    <a href="{{ asset('storage/' . $agunan->denah) }}" target="_blank" style="font-size: 11px; color: #000000; text-decoration: none;">
                        {{ asset('storage/' . $agunan->denah) }}
                    </a>
                @else
                    -
                @endif
            </td>
        </tr>

        <!-- Informasi Harga -->
        <tr>
            <td class="bg-label" rowspan="3" style="background-color: #f2f2f2 !important; border: 1px solid #d9d9d9 !important; font-weight: bold; padding: 5px 8px; vertical-align: top; width: 22%;">Informasi Harga</td>
            <td style="width: 8%; border: 1px solid #d9d9d9 !important; text-align: center; font-weight: bold; background-color: #f2f2f2; vertical-align: top; padding: 5px 8px;">1</td>
            <td colspan="4" style="border: 1px solid #d9d9d9 !important; padding: 5px 8px; vertical-align: top; word-break: break-word; text-align: justify; mso-element-para-indent-alt: 0;">{{ !empty(trim($agunan->info_harga1)) ? $agunan->info_harga1 : '-' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #d9d9d9 !important; text-align: center; font-weight: bold; background-color: #f2f2f2; vertical-align: top; padding: 5px 8px;">2</td>
            <td colspan="4" style="border: 1px solid #d9d9d9 !important; padding: 5px 8px; vertical-align: top; word-break: break-word; text-align: justify; mso-element-para-indent-alt: 0;">{{ !empty(trim($agunan->info_harga2)) ? $agunan->info_harga2 : '-' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #d9d9d9 !important; text-align: center; font-weight: bold; background-color: #f2f2f2; vertical-align: top; padding: 5px 8px;">3</td>
            <td colspan="4" style="border: 1px solid #d9d9d9 !important; padding: 5px 8px; vertical-align: top; word-break: break-word; text-align: justify; mso-element-para-indent-alt: 0;">{{ !empty(trim($agunan->info_harga3)) ? $agunan->info_harga3 : '-' }}</td>
        </tr>

        <!-- C. SLIK -->
        <tr><th colspan="6" class="header-section" style="background-color: #0A3370; color: #FFFFFF; font-weight: bold; padding: 5px 8px; text-transform: uppercase;">C. SLIK</th></tr>
        <tr class="bg-label" style="text-align: center;">
            <td style="text-align: center; font-weight: bold; width: 22%;">Nama Bank</td>
            <td style="text-align: center; font-weight: bold; width: 15%;">Plafon</td>
            <td style="text-align: center; font-weight: bold; width: 15%;">Outstanding</td>
            <td style="text-align: center; font-weight: bold; width: 8%;">KOL</td>
            <td style="text-align: center; font-weight: bold; width: 15%;">Angsuran</td>
            <td style="padding: 0; width: 25%;">
                <table style="width: 100%; border-collapse: collapse; border: none; background: transparent; margin: 0;">
                    <tr>
                        <td style="width: 50%; text-align: center; font-weight: bold; border: none; border-right: 1px solid #d9d9d9; padding: 5px 4px;">JKW</td>
                        <td style="width: 50%; text-align: center; font-weight: bold; border: none; padding: 5px 4px;">Keterangan</td>
                    </tr>
                </table>
            </td>
        </tr>
        @forelse($data->pinjaman ?? [] as $slik)
        <tr>
            <td style="text-align: center;">{{ $slik->nama_ljk ?? '-' }}</td>
            <td class="text-right">Rp {{ number_format($slik->plafon ?? 0, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($slik->outstanding ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">{{ $slik->kolekbilitas ?? $slik->kolektibilitas ?? '-' }}</td>
            <td class="text-right">Rp {{ number_format($slik->angsuran ?? 0, 0, ',', '.') }}</td>
            <td style="padding: 0;">
                <table style="width: 100%; border-collapse: collapse; border: none; background: transparent; margin: 0;">
                    <tr>
                        <td style="width: 50%; text-align: center; border: none; border-right: 1px solid #d9d9d9; padding: 5px 4px;">{{ $slik->jkw ?? '-' }}</td>
                        <td style="width: 50%; text-align: center; border: none; padding: 5px 4px;">{{ $slik->keterangan ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center" style="text-align: center; padding: 8px;">Tidak ada data SLIK.</td></tr>
        @endforelse
        <tr style="font-weight: bold;" class="bg-label">
            <td style="text-align: center;">TOTAL</td>
            <td class="text-right">Rp {{ number_format($data->pinjaman->sum('plafon') ?? 0, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($data->pinjaman->sum('outstanding') ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">-</td>
            <td class="text-right">Rp {{ number_format($data->pinjaman->sum('angsuran') ?? 0, 0, ',', '.') }}</td>
            <td style="padding: 0;">
                <table style="width: 100%; border-collapse: collapse; border: none; background: transparent; margin: 0;">
                    <tr>
                        <td style="width: 50%; text-align: center; border: none; border-right: 1px solid #d9d9d9; padding: 5px 4px;">-</td>
                        <td style="width: 50%; text-align: center; border: none; padding: 5px 4px;">-</td>
                    </tr>
                </table>
            </td>
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
            <td colspan="2" style="width: 40%;">1. Omset Usaha</td>
            <td style="width: 5%;">Rp</td>
            <td style="text-align: right; width: 15%;">{{ number_format($omset, 0, ',', '.') }}</td>
            <td colspan="2" rowspan="11" style="vertical-align: top; width: 40%;">
                <div style="font-weight: bold; padding-bottom: 2px; margin-bottom: 6px; padding-top: 4px;">Deskripsi Usaha :</div>
                <div style="white-space: pre-line; font-size: 10pt; text-align: justify;">{{ optional($data->infousaha)->deskripsi_usaha ?? '-' }}</div>
            </td>
        </tr>
        <tr><td colspan="2">2. Biaya Operasional</td><td>Rp</td><td style="text-align: right;">{{ number_format($biaya, 0, ',', '.') }}</td></tr>
        <tr class="bg-label" style="font-weight: bold;"><td colspan="2">Penghasilan Kotor</td><td>Rp</td><td style="text-align: right;">{{ number_format($penghasilanKotor, 0, ',', '.') }}</td></tr>
        <tr><td colspan="2">3. Penghasilan Tambahan</td><td>Rp</td><td style="text-align: right;">{{ number_format($tambahan, 0, ',', '.') }}</td></tr>
        <tr class="bg-label" style="font-weight: bold;"><td colspan="2">Total Pendapatan</td><td>Rp</td><td style="text-align: right;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td></tr>
        <tr><td colspan="2">4. Pengeluaran Rumah Tangga</td><td>Rp</td><td style="text-align: right;">{{ number_format($pengeluaranRT, 0, ',', '.') }}</td></tr>
        <tr class="bg-label" style="font-weight: bold;"><td colspan="2">Penghasilan Bersih</td><td>Rp</td><td style="text-align: right; color: #000000;">{{ number_format($penghasilanBersih, 0, ',', '.') }}</td></tr>
        <tr><td colspan="2">5. Angsuran Bank Lain</td><td>Rp</td><td style="text-align: right;">{{ number_format($angsuranBankLain, 0, ',', '.') }}</td></tr>
        <tr class="bg-label" style="font-weight: bold;"><td colspan="2">Sisa Penghasilan</td><td>Rp</td><td style="text-align: right;">{{ number_format($sisaPenghasilan, 0, ',', '.') }}</td></tr>
        <tr><td colspan="2">6. Angsuran BPR</td><td>Rp</td><td style="text-align: right;">{{ number_format($angsuranBpr, 0, ',', '.') }}</td></tr>
        <tr class="bg-label" style="font-weight: bold;"><td colspan="2">Sisa Penghasilan Bersih</td><td>Rp</td><td style="text-align: right; color: #000000;">{{ number_format($sisaPenghasilanBersih, 0, ',', '.') }}</td></tr>
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
            <td colspan="5" style="white-space: pre-line; text-align: justify; mso-element-para-indent-alt: 0;">{{ trim($aset) !== '' ? $aset : '-' }}</td>
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