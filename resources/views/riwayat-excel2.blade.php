<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Analisa Kredit - {{ $data->nama ?? '-' }}</title>
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
        <h2 class="main-title">ANALISA KREDIT</h2>

        <!-- A. DATA DEBITUR -->
        <table class="export-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; padding: 6px;">A. DATA DEBITUR</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1. Nama Debitur -->
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%;">Nama Debitur</td>
                    <td colspan="7" class="font-bold" style="width: 70%;">{{ $data->nama ?? '-' }}</td>
                </tr>

                <!-- 2. Tempat / Tanggal Lahir -->
                <tr>
                    <td colspan="1" style="text-align: center;">2.</td>
                    <td colspan="2" class="bg-label">Tempat / Tgl Lahir</td>
                    <td colspan="7">{{ $data->tempat_tanggal_lahir ?? '-' }}</td>
                </tr>

                <!-- 3. Nama Ibu Kandung -->
                <tr>
                    <td colspan="1" style="text-align: center;">3.</td>
                    <td colspan="2" class="bg-label">Nama Ibu Kandung</td>
                    <td colspan="7">{{ $data->nama_ibu_kandung ?? '-' }}</td>
                </tr>

                <!-- 4. Nama Istri / Penjamin -->
                <tr>
                    <td colspan="1" style="text-align: center;">4.</td>
                    <td colspan="2" class="bg-label">Nama Istri / Penjamin</td>
                    <td colspan="7">{{ $data->nama_istri_penjamin ?? '-' }}</td>
                </tr>

                <!-- 5. Alamat KTP -->
                <tr>
                    <td colspan="1" style="text-align: center;">5.</td>
                    <td colspan="2" class="bg-label">Alamat KTP</td>
                    <td colspan="7" style="word-break: break-word;">{{ $data->alamat_ktp ?? '-' }}</td>
                </tr>

                <!-- 6. Alamat Domisili -->
                <tr>
                    <td colspan="1" style="text-align: center;">6.</td>
                    <td colspan="2" class="bg-label">Alamat Domisili</td>
                    <td colspan="7" style="word-break: break-word;">{{ $data->alamat_domisili ?? '-' }}</td>
                </tr>

                <!-- 7. Telp / HP -->
                <tr>
                    <td colspan="1" style="text-align: center;">7.</td>
                    <td colspan="2" class="bg-label">Telp / HP</td>
                    <td colspan="7">{{ $data->no_hp ? "'" . $data->no_hp : '-' }}</td>
                </tr>

                <!-- 8. Pekerjaan -->
                <tr>
                    <td colspan="1" style="text-align: center;">8.</td>
                    <td colspan="2" class="bg-label">Pekerjaan</td>
                    <td colspan="7">{{ $data->pekerjaan ?? '-' }}</td>
                </tr>

                <!-- 9. Bidang Usaha -->
                <tr>
                    <td colspan="1" style="text-align: center;">9.</td>
                    <td colspan="2" class="bg-label">Bidang Usaha</td>
                    <td colspan="7">{{ $data->bidang_usaha ?? '-' }}</td>
                </tr>

                <!-- 10. Alamat Kerja / Usaha -->
                <tr>
                    <td colspan="1" style="text-align: center;">10.</td>
                    <td colspan="2" class="bg-label">Alamat Kerja / Usaha</td>
                    <td colspan="7" style="word-break: break-word;">{{ $data->alamat_usaha ?? '-' }}</td>
                </tr>

                <!-- 11. Telp / HP Usaha -->
                <tr>
                    <td colspan="1" style="text-align: center;">11.</td>
                    <td colspan="2" class="bg-label">Telp / HP Usaha</td>
                    <td colspan="7">{{ $data->kontak ? "'" . $data->kontak : '-' }}</td>
                </tr>

                <!-- 12. IDI di Bank Lain (Hasil SLIK & Lampiran) -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">12.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">IDI di Bank Lain</td>
                    <td colspan="7" style="vertical-align: top;">
                        <!-- Teks Hasil Slik di atas -->
                        <div style="font-weight: normal; margin-bottom: 6px;">
                            Hasil Slik, Tanggal {{ $data->tanggal_slik ?? '-' }}
                        </div>
                        
                        <!-- Lampiran File / Gambar -->
                        <div>
                            @if(!empty($data->idi_di_bank_lain) && $data->idi_di_bank_lain !== '-')
                                @php
                                    $fileSlik = $data->idi_di_bank_lain;
                                    $extSlik = strtolower(pathinfo($fileSlik, PATHINFO_EXTENSION));
                                @endphp

                                {{-- JIKA FILE BERUPA PDF ATAU DWG: Tampilkan sebagai Kotak/Tulisan Lampiran --}}
                                @if(in_array($extSlik, ['pdf', 'dwg']))
                                    <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                        [Lampiran Dokumen {{ strtoupper($extSlik) }}: {{ basename($fileSlik) }}]
                                    </div>

                                {{-- JIKA FILE BERUPA GAMBAR (JPG, JPEG, PNG): Tampilkan sebagai Link URL (seperti Denah) --}}
                                @elseif(in_array($extSlik, ['jpg', 'jpeg', 'png']))
                                    <a href="{{ asset('storage/' . $fileSlik) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileSlik) }}
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $fileSlik) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileSlik) }}
                                    </a>
                                @endif
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- Keterangan -->
                <tr>
                    <td colspan="1" style="vertical-align: top;"></td>
                    <td colspan="2" class="bg-label" style="font-weight: bold; vertical-align: top;">Keterangan :</td>
                    <td colspan="7" style="text-align: justify; vertical-align: top; white-space: pre-line;">
                        {{ $data->keterangan ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- B. PENGAJUAN PLAFON KREDIT -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; padding: 6px;">B. PENGAJUAN PLAFON KREDIT</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris Lampiran Pengajuan Plafon Kredit -->
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top;">Pengajuan Plafon Kredit</td>
                    <td colspan="7" style="width: 70%; vertical-align: top;">
                        @if(!empty($data->pengajuan_plafon_kredit->pengajuan_plafon_kredit) && $data->pengajuan_plafon_kredit->pengajuan_plafon_kredit !== '-')
                            @php
                                $filePlafon = $data->pengajuan_plafon_kredit->pengajuan_plafon_kredit;
                                $extPlafon = strtolower(pathinfo($filePlafon, PATHINFO_EXTENSION));
                            @endphp

                            {{-- JIKA FILE BERUPA PDF ATAU DWG: Tampilkan sebagai kotak/tulisan lampiran --}}
                            @if(in_array($extPlafon, ['pdf', 'dwg']))
                                <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                    [Lampiran Dokumen {{ strtoupper($extPlafon) }}: {{ basename($filePlafon) }}]
                                </div>

                            {{-- JIKA FILE BERUPA GAMBAR (JPG, JPEG, PNG): Tampilkan sebagai Link URL --}}
                            @elseif(in_array($extPlafon, ['jpg', 'jpeg', 'png']))
                                <a href="{{ asset('storage/' . $filePlafon) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $filePlafon) }}
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $filePlafon) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $filePlafon) }}
                                </a>
                            @endif
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>

                <!-- Baris Tujuan Penggunaan -->
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">2.</td>
                    <td colspan="2" class="bg-label" style="font-weight: bold; vertical-align: top;">Tujuan Penggunaan :</td>
                    <td colspan="7" style="text-align: justify; vertical-align: top; white-space: pre-line;">
                        {{ $data->pengajuan_plafon_kredit->tujuan_penggunaan ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- C. INFORMASI MENGENAI USAHA -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; padding: 6px;">C. INFORMASI MENGENAI USAHA</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $listUsaha = $data->informasi_usaha->sortBy('urutan');
                    $usahaUtama = $listUsaha->where('urutan', 1)->first();
                    $usahaLainnya = $listUsaha->where('urutan', '>', 1);
                @endphp

                {{-- 1. BAGIAN UTAMA (Gambaran Pekerjaan Debitur) --}}
                @if($usahaUtama && (!empty($usahaUtama->gambaran_pekerjaan_debitur) || !empty($usahaUtama->perhitungan_omset_usaha)))
                    <tr>
                        <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                        <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top; font-weight: bold;">Gambaran Pekerjaan Debitur</td>
                        <td colspan="7" style="width: 70%; vertical-align: top;">
                            <div style="text-align: justify; margin-bottom: 6px; white-space: pre-line;">
                                {{ $usahaUtama->gambaran_pekerjaan_debitur ?? '-' }}
                            </div>

                            @if(!empty($usahaUtama->perhitungan_omset_usaha) && $usahaUtama->perhitungan_omset_usaha !== '-')
                                @php
                                    $fileOmsetUtama = $usahaUtama->perhitungan_omset_usaha;
                                    $extOmsetUtama = strtolower(pathinfo($fileOmsetUtama, PATHINFO_EXTENSION));
                                @endphp

                                <div>
                                    @if(in_array($extOmsetUtama, ['pdf', 'dwg']))
                                        <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                            [Lampiran Dokumen {{ strtoupper($extOmsetUtama) }}: {{ basename($fileOmsetUtama) }}]
                                        </div>
                                    @elseif(in_array($extOmsetUtama, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ asset('storage/' . $fileOmsetUtama) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                            {{ asset('storage/' . $fileOmsetUtama) }}
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $fileOmsetUtama) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                            {{ asset('storage/' . $fileOmsetUtama) }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                @endif

                {{-- 2. BAGIAN USAHA TAMBAHAN (Urutan 2 dan seterusnya) --}}
                @foreach($usahaLainnya as $index => $usaha)
                    @if(!empty($usaha->gambaran_pekerjaan_debitur) || !empty($usaha->perhitungan_omset_usaha))
                        <tr>
                            <td colspan="1" style="text-align: center; vertical-align: top;">{{ $index + 1 }}.</td>
                            <td colspan="2" class="bg-label" style="vertical-align: top; font-weight: bold;">Usaha Tambahan</td>
                            <td colspan="7" style="vertical-align: top;">
                                <div style="text-align: justify; margin-bottom: 6px; white-space: pre-line;">
                                    {{ $usaha->gambaran_pekerjaan_debitur ?? '-' }}
                                </div>

                                @if(!empty($usaha->perhitungan_omset_usaha) && $usaha->perhitungan_omset_usaha !== '-')
                                    @php
                                        $fileOmsetLain = $usaha->perhitungan_omset_usaha;
                                        $extOmsetLain = strtolower(pathinfo($fileOmsetLain, PATHINFO_EXTENSION));
                                    @endphp

                                    <div>
                                        @if(in_array($extOmsetLain, ['pdf', 'dwg']))
                                            <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                                [Lampiran Dokumen {{ strtoupper($extOmsetLain) }}: {{ basename($fileOmsetLain) }}]
                                            </div>
                                        @elseif(in_array($extOmsetLain, ['jpg', 'jpeg', 'png']))
                                            <a href="{{ asset('storage/' . $fileOmsetLain) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                                {{ asset('storage/' . $fileOmsetLain) }}
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $fileOmsetLain) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                                {{ asset('storage/' . $fileOmsetLain) }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach

                {{-- 3. USAHA PENDUKUNG LAIN --}}
                @if($usahaUtama && !empty($usahaUtama->usaha_pendukung))
                    <tr>
                        <td colspan="1" style="text-align: center; vertical-align: top;">*</td>
                        <td colspan="2" class="bg-label" style="vertical-align: top; font-weight: bold;">Usaha Pendukung Lain</td>
                        <td colspan="7" style="vertical-align: top;">
                            <div style="text-align: justify; margin-bottom: 6px; white-space: pre-line;">
                                {{ $usahaUtama->usaha_pendukung ?? '-' }}
                            </div>

                            @if(!empty($usahaUtama->perhitungan_omset_pendukung) && $usahaUtama->perhitungan_omset_pendukung !== '-')
                                @php
                                    $filePendukung = $usahaUtama->perhitungan_omset_pendukung;
                                    $extPendukung = strtolower(pathinfo($filePendukung, PATHINFO_EXTENSION));
                                @endphp

                                <div>
                                    @if(in_array($extPendukung, ['pdf', 'dwg']))
                                        <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                            [Lampiran Dokumen {{ strtoupper($extPendukung) }}: {{ basename($filePendukung) }}]
                                        </div>
                                    @elseif(in_array($extPendukung, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ asset('storage/' . $filePendukung) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                            {{ asset('storage/' . $filePendukung) }}
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $filePendukung) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                            {{ asset('storage/' . $filePendukung) }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- D. URAIAN SINGKAT MENGENAI 5 C -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; padding: 6px;">D. URAIAN SINGKAT MENGENAI 5 C</th>
                </tr>
            </thead>
            <tbody>
                {{-- 1. CAPITAL --}}
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top; font-weight: bold;">CAPITAL</td>
                    <td colspan="7" style="width: 70%; vertical-align: top; text-align: justify; white-space: pre-line;">
                        {{ $data->limac->capital ?? '-' }}
                    </td>
                </tr>

                {{-- 2. COLLATERAL --}}
                @php
                    $listCollaterals = ($data && $data->limac_collaterals) 
                        ? $data->limac_collaterals->sortBy('urutan') 
                        : collect();
                @endphp

                @foreach($listCollaterals as $index => $collateral)
                    <tr>
                        <td colspan="1" style="text-align: center; vertical-align: top;">{{ 2 + $index }}.</td>
                        <td colspan="2" class="bg-label" style="vertical-align: top; font-weight: bold;">
                            COLLATERAL {{ $listCollaterals->count() > 1 ? '(' . chr(96 + $loop->iteration) . ')' : '' }}
                        </td>
                        <td colspan="7" style="vertical-align: top;">
                            <!-- Detail Tabel Collateral (Diatur width 100% agar merentang penuh menutupi colspan 7 sampai kolom J) -->
                            <table class="bg-label" style="width: 100%; table-layout: fixed; border-collapse: collapse; margin-bottom: 6px;">
                                <tr>
                                    <td class="bg-label" style="width: 25%; font-weight: normal; padding-bottom: 2px;">No.SHM</td>
                                    <td class="bg-label" style="width: 3%; text-align: center; padding-bottom: 2px;">:</td>
                                    <td class="bg-label" style="width: 72%; font-weight: normal; padding-bottom: 2px;">{{ $collateral->no_shm ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Luas</td>
                                    <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                    <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $collateral->luas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Nama Pemilik</td>
                                    <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                    <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $collateral->pemilik ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Letak SHM</td>
                                    <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                    <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $collateral->letak_shm ?? '-' }}</td>
                                </tr>
                            </table>

                            <!-- Ringkasan Penilaian Jaminan -->
                            <div style="font-weight: normal; margin-top: 4px; margin-bottom: 2px;">
                                Ringkasan Penilaian Jaminan, Tanggal {{ $collateral->tanggal ?? '-' }}
                            </div>
                            <div style="margin-bottom: 6px;">
                                @if(!empty($collateral->ringkasan_penilaian_jaminan) && $collateral->ringkasan_penilaian_jaminan !== '-')
                                    @php
                                        $fileCollateral = $collateral->ringkasan_penilaian_jaminan;
                                        $extCollateral = strtolower(pathinfo($fileCollateral, PATHINFO_EXTENSION));
                                    @endphp

                                    @if(in_array($extCollateral, ['pdf', 'dwg']))
                                        <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                            [Lampiran Dokumen {{ strtoupper($extCollateral) }}: {{ basename($fileCollateral) }}]
                                        </div>
                                    @elseif(in_array($extCollateral, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ asset('storage/' . $fileCollateral) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                            {{ asset('storage/' . $fileCollateral) }}
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $fileCollateral) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                            {{ asset('storage/' . $fileCollateral) }}
                                        </a>
                                    @endif
                                @else
                                    <span>-</span>
                                @endif
                            </div>

                            <!-- Informasi Harga Tanah -->
                            <div style="font-weight: bold; margin-top: 4px;">Informasi Harga Tanah :</div>
                            <div style="padding-left: 10px; margin-bottom: 4px;">
                                <div>1. {{ $collateral->info_harga_tanah1 ?? '-' }}</div>
                                @if(!empty($collateral->info_harga_tanah2) && $collateral->info_harga_tanah2 !== '-')
                                    <div>2. {{ $collateral->info_harga_tanah2 }}</div>
                                @endif
                                @if(!empty($collateral->info_harga_tanah3) && $collateral->info_harga_tanah3 !== '-')
                                    <div>3. {{ $collateral->info_harga_tanah3 }}</div>
                                @endif
                            </div>

                            <!-- Batas Objek Jaminan -->
                            <div style="font-weight: bold; margin-top: 4px;">Batas Objek Jaminan :</div>
                            <div style="text-align: justify; margin-bottom: 4px;">{{ $collateral->batas_objek_jaminan ?? '-' }}</div>

                            <!-- Catatan Khusus Objek Jaminan -->
                            <div style="font-weight: bold; margin-top: 4px;">Catatan Khusus Objek Jaminan :</div>
                            <div style="text-align: justify;">{{ $collateral->catatan_khusus ?? '-' }}</div>
                        </td>
                    </tr>
                @endforeach

                {{-- 3. CONDITION --}}
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">3.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top; font-weight: bold;">CONDITION</td>
                    <td colspan="7" style="vertical-align: top; text-align: justify; white-space: pre-line;">
                        {{ $data->limac->condition ?? '-' }}
                    </td>
                </tr>

                {{-- 4. CAPACITY --}}
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">4.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top; font-weight: bold;">CAPACITY</td>
                    <td colspan="7" style="vertical-align: top;">
                        <!-- File/Gambar Capacity -->
                        <div style="margin-bottom: 6px;">
                            @if(!empty($data->limac->capacity) && $data->limac->capacity !== '-')
                                @php
                                    $fileCapacity = $data->limac->capacity;
                                    $extCapacity = strtolower(pathinfo($fileCapacity, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($extCapacity, ['pdf', 'dwg']))
                                    <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                        [Lampiran Dokumen {{ strtoupper($extCapacity) }}: {{ basename($fileCapacity) }}]
                                    </div>
                                @elseif(in_array($extCapacity, ['jpg', 'jpeg', 'png']))
                                    <a href="{{ asset('storage/' . $fileCapacity) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileCapacity) }}
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $fileCapacity) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileCapacity) }}
                                    </a>
                                @endif
                            @else
                                <span>-</span>
                            @endif
                        </div>

                        <!-- Tabel Tanggungan dengan background bg-label -->
                        <div style="font-weight: bold; margin-top: 4px; margin-bottom: 2px;">Tanggungan</div>
                        <table class="bg-label" style="width: 100%; table-layout: fixed; border-collapse: collapse; margin-bottom: 6px;">
                            <tr>
                                <td class="bg-label" style="width: 25%; font-weight: normal; padding-bottom: 2px;">Tanggungan Keluarga</td>
                                <td class="bg-label" style="width: 3%; text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="width: 72%; font-weight: normal; padding-bottom: 2px;">{{ $data->limac->keluarga ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Tanggungan Anak</td>
                                <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $data->limac->anak ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Tanggungan Pendidikan</td>
                                <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $data->limac->pendidikan ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- 5. CHARACTER --}}
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">5.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top; font-weight: bold;">CHARACTER</td>
                    <td colspan="7" style="vertical-align: top;">
                        <div style="font-weight: bold; margin-bottom: 2px;">Internal :</div>
                        <div style="text-align: justify; margin-bottom: 6px; white-space: pre-line;">
                            {{ $data->limac->internal ?? '-' }}
                        </div>

                        <div style="font-weight: bold; margin-bottom: 2px;">Eksternal :</div>
                        <div style="text-align: justify; white-space: pre-line;">
                            {{ $data->limac->eksternal ?? '-' }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- E. REFERENSI CREDIT ANALIST -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; padding: 6px;">E. REFERENSI CREDIT ANALIST</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top; font-weight: bold;">Referensi CA</td>
                    <td colspan="7" style="width: 70%; vertical-align: top; text-align: justify; white-space: pre-line;">
                        {{ $data->referensi_ca->referensi_ca ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- F. DEVIASI -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; padding: 6px;">F. DEVIASI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top; font-weight: bold;">Deviasi</td>
                    <td colspan="7" style="width: 70%; vertical-align: top; text-align: justify; white-space: pre-line;">
                        {{ $data->deviasi->deviasi ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- G. KESIMPULAN -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; padding: 6px;">G. KESIMPULAN</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris Keterangan Kesimpulan -->
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top; font-weight: bold;">Kesimpulan</td>
                    <td colspan="7" style="width: 70%; vertical-align: top;">
                        <div style="text-align: justify; margin-bottom: 8px; white-space: pre-line;">
                            {{ $data->kesimpulan->kesimpulan ?? '-' }}
                        </div>

                        <!-- Lampiran / Link Plafon Kesimpulan -->
                        <div style="margin-bottom: 8px;">
                            @if(!empty($data->kesimpulan) && !empty($data->kesimpulan->plafon) && $data->kesimpulan->plafon !== '-')
                                @php
                                    $fileKesimpulanPlafon = $data->kesimpulan->plafon;
                                    $extKesimpulanPlafon = strtolower(pathinfo($fileKesimpulanPlafon, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($extKesimpulanPlafon, ['pdf', 'dwg']))
                                    <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                        [Lampiran Dokumen {{ strtoupper($extKesimpulanPlafon) }}: {{ basename($fileKesimpulanPlafon) }}]
                                    </div>
                                @elseif(in_array($extKesimpulanPlafon, ['jpg', 'jpeg', 'png']))
                                    <a href="{{ asset('storage/' . $fileKesimpulanPlafon) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileKesimpulanPlafon) }}
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $fileKesimpulanPlafon) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileKesimpulanPlafon) }}
                                    </a>
                                @endif
                            @else
                                <span>-</span>
                            @endif
                        </div>

                        <!-- Tabel Detail Kesimpulan dengan background bg-label -->
                        <table class="bg-label" style="width: 100%; table-layout: fixed; border-collapse: collapse; margin-top: 4px;">
                            <tr>
                                <td class="bg-label" style="width: 28%; font-weight: normal; padding-bottom: 2px;">Provisi</td>
                                <td class="bg-label" style="width: 3%; text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="width: 69%; font-weight: normal; padding-bottom: 2px;">{{ $data->kesimpulan->provisi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Biaya Administrasi</td>
                                <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $data->kesimpulan->biaya_administrasi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Jaminan</td>
                                <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $data->kesimpulan->jaminan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Blokir</td>
                                <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">{{ $data->kesimpulan->blokir ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px;">Keterangan</td>
                                <td class="bg-label" style="text-align: center; padding-bottom: 2px;">:</td>
                                <td class="bg-label" style="font-weight: normal; padding-bottom: 2px; white-space: pre-line;">{{ $data->kesimpulan->keterangan ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- GAMBAR JAMINAN, TEMPAT USAHA & TEMPAT TINGGAL -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; text-align: center; padding: 6px;">GAMBAR JAMINAN, TEMPAT USAHA & TEMPAT TINGGAL</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1. LOKASI DAN FOTO JAMINAN -->
                <tr>
                    <td colspan="10" class="bg-label" style="width: 100%; text-align: center; vertical-align: top; font-weight: bold; padding: 6px;">
                        Lokasi dan Foto Jaminan
                    </td>
                </tr>

                <!-- Baris Google Map & Detail Lokasi Jaminan -->
                <tr>
                    <td colspan="5" style="width: 47%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                        <div style="font-weight: bold; margin-bottom: 4px;">Google Map</div>
                        @if(!empty($data->jaminan->google_maps) && $data->jaminan->google_maps !== '-')
                            @php
                                $fileGmap = $data->jaminan->google_maps;
                            @endphp
                            <a href="{{ asset('storage/' . $fileGmap) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                {{ asset('storage/' . $fileGmap) }}
                            </a>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td colspan="5" style="width: 48%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                        <!-- Link Share Location -->
                        <div style="margin-bottom: 10px;">
                            <div style="font-weight: bold; margin-bottom: 2px;">Link Share Location</div>
                            @if(!empty($data->jaminan->share_location))
                                <a href="{{ $data->jaminan->share_location }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ $data->jaminan->share_location }}
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </div>

                        <!-- Kode QR Maps -->
                        <div>
                            <div style="font-weight: bold; margin-bottom: 2px;">Kode QR Maps</div>
                            @if(!empty($data->jaminan->kode_qr) && $data->jaminan->kode_qr !== '-')
                                @php
                                    $fileQr = $data->jaminan->kode_qr;
                                @endphp
                                <a href="{{ asset('storage/' . $fileQr) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileQr) }}
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- Baris Foto Jaminan (Berpasangan / 2 Kolom) -->
                @php
                    $fotoJaminans = !empty($data->jaminan->foto_jaminan) ? json_decode($data->jaminan->foto_jaminan, true) : [];
                    $chunksJaminan = array_chunk($fotoJaminans, 2);
                @endphp

                @foreach($chunksJaminan as $chunkJaminan)
                    <tr>
                        <!-- Kolom Kiri Foto Jaminan -->
                        <td colspan="5" style="width: 47%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                            @if(isset($chunkJaminan[0]))
                                @php
                                    $fileLeft = $chunkJaminan[0];
                                @endphp
                                <div style="font-weight: bold; margin-bottom: 4px;">Foto Jaminan</div>
                                <a href="{{ asset('storage/' . $fileLeft) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileLeft) }}
                                </a>
                            @else
                                <span>&nbsp;</span>
                            @endif
                        </td>

                        <!-- Kolom Kanan Foto Jaminan -->
                        <td colspan="5" style="width: 48%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                            @if(isset($chunkJaminan[1]))
                                @php
                                    $fileRight = $chunkJaminan[1];
                                @endphp
                                <div style="font-weight: bold; margin-bottom: 4px;">Foto Jaminan</div>
                                <a href="{{ asset('storage/' . $fileRight) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileRight) }}
                                </a>
                            @else
                                <span>&nbsp;</span>
                            @endif
                        </td>
                    </tr>
                @endforeach


                <!-- LOKASI DAN FOTO TEMPAT USAHA -->
                <tr>
                    <td colspan="10" class="bg-label" style="width: 100%; text-align: center; vertical-align: top; font-weight: bold; padding-top: 15px; padding-bottom: 6px;">
                        Lokasi dan Foto Tempat Usaha
                    </td>
                </tr>

                @php
                    $listUsaha = $data->usaha ? $data->usaha->sortBy('urutan') : collect();
                @endphp

                @foreach($listUsaha as $usahaItem)
                    @php
                        $hurufUrutan = chr(96 + $loop->iteration); 
                    @endphp

                    <!-- Sub Header Nama Usaha (a, b, c) -->
                    <tr>
                        <td colspan="10" style="font-weight: bold; padding-top: 6px; padding-bottom: 4px; background-color: #fafafa;">
                            {{ $hurufUrutan }}. Lokasi dan Foto Tempat Usaha {{ $usahaItem->nama_usaha }}
                        </td>
                    </tr>

                    <!-- Baris Google Map & Detail Lokasi Usaha -->
                    <tr>
                        <td colspan="5" style="width: 47%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                            <div style="font-weight: bold; margin-bottom: 4px;">Google Map</div>
                            @if(!empty($usahaItem->google_maps) && $usahaItem->google_maps !== '-')
                                @php
                                    $fileUsahaMap = $usahaItem->google_maps;
                                @endphp
                                <a href="{{ asset('storage/' . $fileUsahaMap) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileUsahaMap) }}
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td colspan="5" style="width: 48%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                            <!-- Link Share Location -->
                            <div style="margin-bottom: 10px;">
                                <div style="font-weight: bold; margin-bottom: 2px;">Link Share Location</div>
                                @if(!empty($usahaItem->share_location))
                                    <a href="{{ $usahaItem->share_location }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ $usahaItem->share_location }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>

                            <!-- Kode QR Maps -->
                            <div>
                                <div style="font-weight: bold; margin-bottom: 2px;">Kode QR Maps</div>
                                @if(!empty($usahaItem->kode_qr) && $usahaItem->kode_qr !== '-')
                                    @php
                                        $fileUsahaQr = $usahaItem->kode_qr;
                                    @endphp
                                    <a href="{{ asset('storage/' . $fileUsahaQr) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileUsahaQr) }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Baris Foto Tempat Usaha (Berpasangan / 2 Kolom) -->
                    @php
                        $fotoUsahas = !empty($usahaItem->foto_usaha) ? json_decode($usahaItem->foto_usaha, true) : [];
                        $chunksUsaha = array_chunk($fotoUsahas, 2);
                    @endphp

                    @foreach($chunksUsaha as $chunkUsaha)
                        <tr>
                            <!-- Kolom Kiri Foto Usaha -->
                            <td colspan="5" style="width: 47%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                                @if(isset($chunkUsaha[0]))
                                    @php
                                        $fileUsahaLeft = $chunkUsaha[0];
                                    @endphp
                                    <div style="font-weight: bold; margin-bottom: 4px;">Foto Usaha</div>
                                    <a href="{{ asset('storage/' . $fileUsahaLeft) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileUsahaLeft) }}
                                    </a>
                                @else
                                    <span>&nbsp;</span>
                                @endif
                            </td>

                            <!-- Kolom Kanan Foto Usaha -->
                            <td colspan="5" style="width: 48%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                                @if(isset($chunkUsaha[1]))
                                    @php
                                        $fileUsahaRight = $chunkUsaha[1];
                                    @endphp
                                    <div style="font-weight: bold; margin-bottom: 4px;">Foto Usaha</div>
                                    <a href="{{ asset('storage/' . $fileUsahaRight) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                        {{ asset('storage/' . $fileUsahaRight) }}
                                    </a>
                                @else
                                    <span>&nbsp;</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach


                <!-- LOKASI DAN FOTO TEMPAT TINGGAL -->
                <tr>
                    <td colspan="10" class="bg-label" style="width: 100%; text-align: center; vertical-align: top; font-weight: bold; padding-top: 15px; padding-bottom: 6px;">
                        Lokasi dan Foto Tempat Tinggal
                    </td>
                </tr>

                <!-- Baris Google Map & Detail Lokasi Tempat Tinggal -->
                <tr>
                    <td colspan="5" style="width: 47%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                        <div style="font-weight: bold; margin-bottom: 4px;">Google Map</div>
                        @if(!empty($data->rumah->google_maps) && $data->rumah->google_maps !== '-')
                            @php
                                $fileRumahMap = $data->rumah->google_maps;
                            @endphp
                            <a href="{{ asset('storage/' . $fileRumahMap) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                {{ asset('storage/' . $fileRumahMap) }}
                            </a>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td colspan="5" style="width: 48%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                        <!-- Link Share Location -->
                        <div style="margin-bottom: 10px;">
                            <div style="font-weight: bold; margin-bottom: 2px;">Link Share Location</div>
                            @if(!empty($data->rumah->share_location))
                                <a href="{{ $data->rumah->share_location }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ $data->rumah->share_location }}
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </div>

                        <!-- Kode QR Maps -->
                        <div>
                            <div style="font-weight: bold; margin-bottom: 2px;">Kode QR Maps</div>
                            @if(!empty($data->rumah->kode_qr) && $data->rumah->kode_qr !== '-')
                                @php
                                    $fileRumahQr = $data->rumah->kode_qr;
                                @endphp
                                <a href="{{ asset('storage/' . $fileRumahQr) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileRumahQr) }}
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- Baris Foto Tempat Tinggal (Berpasangan / 2 Kolom) -->
                @php
                    $fotoTinggals = !empty($data->rumah->foto_tempat_tinggal) ? json_decode($data->rumah->foto_tempat_tinggal, true) : [];
                    $chunksRumah = array_chunk($fotoTinggals, 2);
                @endphp

                @foreach($chunksRumah as $chunkRumah)
                    <tr>
                        <!-- Kolom Kiri Foto Tempat Tinggal -->
                        <td colspan="5" style="width: 47%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                            @if(isset($chunkRumah[0]))
                                @php
                                    $fileRumahLeft = $chunkRumah[0];
                                @endphp
                                <div style="font-weight: bold; margin-bottom: 4px;">Foto Tempat Tinggal</div>
                                <a href="{{ asset('storage/' . $fileRumahLeft) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileRumahLeft) }}
                                </a>
                            @else
                                <span>&nbsp;</span>
                            @endif
                        </td>

                        <!-- Kolom Kanan Foto Tempat Tinggal -->
                        <td colspan="5" style="width: 48%; vertical-align: top; border: 1px solid #d9d9d9; padding: 6px; background-color: #ffffff;">
                            @if(isset($chunkRumah[1]))
                                @php
                                    $fileRumahRight = $chunkRumah[1];
                                @endphp
                                <div style="font-weight: bold; margin-bottom: 4px;">Foto Tempat Tinggal</div>
                                <a href="{{ asset('storage/' . $fileRumahRight) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileRumahRight) }}
                                </a>
                            @else
                                <span>&nbsp;</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- SPESIFIKASI JAMINAN KREDIT -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; text-align: center; padding: 6px;">SPESIFIKASI JAMINAN KREDIT, MELIPUTI</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1. Sertifikat -->
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top;">Sertifikat</td>
                    <td colspan="7" style="width: 70%; vertical-align: top;">{{ $data->spesifikasi->sertifikat ?? '-' }}</td>
                </tr>

                <!-- 2. Nomor / NIB -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">2.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Nomor / NIB</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->nomor_nib ?? '-' }}</td>
                </tr>

                <!-- 3. Luas Tanah (P x L) -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">3.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Luas Tanah (p x l)</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->luas_tanah ?? '-' }}</td>
                </tr>

                <!-- 4. Luas Bangunan (P x L) -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">4.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Luas Bangunan (p x l)</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->luas_bangunan ?? '-' }}</td>
                </tr>

                <!-- 5. Lebar Depan -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">5.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Lebar Depan</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->lebar_depan ?? '-' }}</td>
                </tr>

                <!-- 6. PBG -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">6.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">PBG</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->pbg ?? '-' }}</td>
                </tr>

                <!-- 7. Orientasi -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">7.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Orientasi</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->orientasi ?? '-' }}</td>
                </tr>

                <!-- 8. Jumlah Ruangan -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">8.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top; font-weight: normal;">Jumlah Ruangan</td>
                    <td colspan="7" style="vertical-align: top; padding: 0;">
                        <table class="bg-label" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td colspan="1" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->kamar_tidur ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Kamar Tidur</td>
                                <td colspan="2" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->kamar_mandi ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Kamar Mandi</td>
                            </tr>
                            <tr>
                                <td colspan="1" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->ruang_keluarga ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Ruang Keluarga</td>
                                <td colspan="2" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->ruang_makan ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Ruang Makan</td>
                            </tr>
                            <tr>
                                <td colspan="1" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->ruang_tamu ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Ruang Tamu</td>
                                <td colspan="2" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->dapur ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Dapur</td>
                            </tr>
                            <tr>
                                <td colspan="1" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->kamar_pembantu ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Kamar Pembantu</td>
                                <td colspan="2" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->pekarangan ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Taman / Pekarangan</td>
                            </tr>
                            <tr>
                                <td colspan="1" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->gudang ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Gudang</td>
                                <td colspan="2" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->carport ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Carport</td>
                            </tr>
                            <tr>
                                <td colspan="1" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->garasi ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">Garasi</td>
                                <td colspan="2" class="bg-label" style="border: 1px solid #d9d9d9; text-align: center; padding: 2px; font-weight: normal;">{{ $data->spesifikasi->ruangan_lain ?? '-' }}</td>
                                <td colspan="2" class="bg-label" style="padding-left: 6px; font-weight: normal;">.....</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- 9. Fasilitas Lainnya -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">9.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Fasilitas Lainnya</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->fasilitas_lain ?? '-' }}</td>
                </tr>

                <!-- 10. Kondisi Bangunan -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">10.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Kondisi Bangunan</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->kondisi_bangunan ?? '-' }}</td>
                </tr>

                <!-- 11. Kondisi Lantai -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">11.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Kondisi Lantai</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->kondisi_lantai ?? '-' }}</td>
                </tr>

                <!-- 12. Kondisi Plafon -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">12.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Kondisi Plafon</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->kondisi_plafon ?? '-' }}</td>
                </tr>

                <!-- 13. Bahan Atap -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">13.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Bahan Atap</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->bahan_atap ?? '-' }}</td>
                </tr>

                <!-- 14. Struktur Atap -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">14.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Struktur Atap</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->struktur_atap ?? '-' }}</td>
                </tr>

                <!-- 15. Listrik -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">15.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Listrik</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->listrik ?? '-' }}</td>
                </tr>

                <!-- 16. Air -->
                <tr>
                    <td colspan="1" style="text-align: center; vertical-align: top;">16.</td>
                    <td colspan="2" class="bg-label" style="vertical-align: top;">Air</td>
                    <td colspan="7" style="vertical-align: top;">{{ $data->spesifikasi->air ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- DENAH JAMINAN -->
        <table class="export-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left;">
                    <th colspan="10" class="section-header" style="background-color: #f3f4f6; font-weight: bold; text-align: center; padding: 6px;">DENAH JAMINAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="1" style="width: 5%; text-align: center; vertical-align: top;">1.</td>
                    <td colspan="2" class="bg-label" style="width: 25%; vertical-align: top; font-weight: bold;">Denah Jaminan</td>
                    <td colspan="7" style="width: 70%; vertical-align: top;">
                        @if(!empty($data->denah) && !empty($data->denah->denah_jaminan) && $data->denah->denah_jaminan !== '-')
                            @php
                                $fileDenah = $data->denah->denah_jaminan;
                                $extDenah = strtolower(pathinfo($fileDenah, PATHINFO_EXTENSION));
                            @endphp

                            @if(in_array($extDenah, ['pdf', 'dwg']))
                                <div style="font-size: 11px; font-style: italic; color: #374151; border: 1px dashed #9ca3af; padding: 4px 8px; background-color: #f9fafb; display: inline-block;">
                                    [Lampiran Dokumen {{ strtoupper($extDenah) }}: {{ basename($fileDenah) }}]
                                </div>
                            @elseif(in_array($extDenah, ['jpg', 'jpeg', 'png']))
                                <a href="{{ asset('storage/' . $fileDenah) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileDenah) }}
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $fileDenah) }}" target="_blank" style="font-size: 12px; color: #000000; text-decoration: none;">
                                    {{ asset('storage/' . $fileDenah) }}
                                </a>
                            @endif
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>