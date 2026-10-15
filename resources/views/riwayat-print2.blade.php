<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Analisa Kredit - {{ $data->nama ?? '-' }}</title>
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
        padding-left: 3%;
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

    .page-break {
    page-break-before: always;
    break-before: page;
    }
</style>
</head>

<body onload="window.print()">

    <div class="page-container">
        <h2 class="main-title">ANALISA KREDIT</h2>

        <!-- A. DATA DEBITUR -->
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header">
                    A. DATA DEBITUR
                </div>
                
                <div class="text-sm">
                    <table class="table-form">
                        <!-- 1. Nama Debitur -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">1.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Nama Debitur</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%; font-weight: normal;">{{ $data->nama ?? '-' }}</td>
                        </tr>

                        <!-- 2. Tempat / Tanggal Lahir -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">2.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Tempat / Tgl Lahir</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->tempat_tanggal_lahir ?? '-' }}</td>
                        </tr>

                        <!-- 3. Nama Ibu Kandung -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">3.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Nama Ibu Kandung</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->nama_ibu_kandung ?? '-' }}</td>
                        </tr>

                        <!-- 4. Nama Istri / Penjamin -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">4.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Nama Istri / Penjamin</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->nama_istri_penjamin ?? '-' }}</td>
                        </tr>

                        <!-- 5. Alamat KTP -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">5.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Alamat KTP</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->alamat_ktp ?? '-' }}</td>
                        </tr>

                        <!-- 6. Alamat Domisili -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">6.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Alamat Domisili</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->alamat_domisili ?? '-' }}</td>
                        </tr>

                        <!-- 7. Telp / HP -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">7.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Telp / HP</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->no_hp ?? '-' }}</td>
                        </tr>

                        <!-- 8. Pekerjaan -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">8.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Pekerjaan</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->pekerjaan ?? '-' }}</td>
                        </tr>

                        <!-- 9. Bidang Usaha -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">9.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Bidang Usaha</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->bidang_usaha ?? '-' }}</td>
                        </tr>

                        <!-- 10. Alamat Kerja / Usaha -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">10.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Alamat Kerja / Usaha</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->alamat_usaha ?? '-' }}</td>
                        </tr>

                        <!-- 11. Telp / HP Usaha -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">11.</td>
                            <td style="width: 35%; font-weight: normal; padding-left: 3%;">Telp / HP Usaha</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 57%;">{{ $data->kontak ?? '-' }}</td>
                        </tr>

                        <!-- 12. IDI di Bank Lain -->
                        <tr>
                            <td style="width: 5%; text-align: center; font-weight: normal; padding-left: 5%; padding-right: 5%;">12.</td>
                            <td style="width: 30%; font-weight: normal; padding-left: 3%;">IDI di Bank Lain</td>
                            <td style="width: 3%; text-align: center; font-weight: normal;">:</td>
                            <td style="width: 62%;"></td>
                        </tr>
                    </table>

                    <!-- Hasil Slik & Gambar -->
                    <div style="padding-left: 5%; margin-top: 10px;">
                        <div style="font-weight: normal;">
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
                    <div style="padding-left: 5%; margin-top: 10px; padding-right: 5%;">
                        <div style="font-weight: bold;">
                            Keterangan :
                        </div>
                        <div style="margin-top: 3px; text-align: justify; margin-bottom: 15px;">
                            {{ $data->keterangan ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

        <!-- B. PENGAJUAN PLAFON KREDIT -->
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header">
                    B. PENGAJUAN PLAFON KREDIT
                </div>
                
                <div class="text-sm">
                    <!-- Plafon Kredit -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 5px;">
                        <div style="margin-top: 5px;">
                            @if(!empty($data->pengajuan_plafon_kredit->pengajuan_plafon_kredit) && $data->pengajuan_plafon_kredit->pengajuan_plafon_kredit !== '-')
                                <div style="display: inline-block; padding: 2px;">
                                    <img 
                                        src="{{ asset('storage/' . $data->pengajuan_plafon_kredit->pengajuan_plafon_kredit) }}" 
                                        alt="Plafon Kredit"
                                        style="max-width: 100%; height: auto; display: block;"
                                    >
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Tujuan Penggunaan -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold;">
                            Tujuan Penggunaan :
                        </div>
                        <div style="margin-top: 3px; text-align: justify; margin-bottom: 15px;">
                            {{ $data->pengajuan_plafon_kredit->tujuan_penggunaan ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

        <!-- C. INFORMASI MENGENAI USAHA -->
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header">
                    C. INFORMASI MENGENAI USAHA
                </div>

                <div class="text-sm">
                    @php
                        // Ambil data yang diurutkan
                        $listUsaha = $data->informasi_usaha->sortBy('urutan');
                        $usahaUtama = $listUsaha->where('urutan', 1)->first();
                        $usahaLainnya = $listUsaha->where('urutan', '>', 1);
                    @endphp

                    {{-- 1. BAGIAN UTAMA (Gambaran Pekerjaan Debitur) --}}
                    @if($usahaUtama && (!empty($usahaUtama->gambaran_pekerjaan_debitur) || !empty($usahaUtama->perhitungan_omset_usaha)))
                        <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                            <div style="font-weight: bold;">
                                1. Gambaran Pekerjaan Debitur
                            </div>
                            <div style="margin-top: 3px; font-weight: normal; text-align: justify;">
                                {{ $usahaUtama->gambaran_pekerjaan_debitur ?? '-' }}
                            </div>

                            @if(!empty($usahaUtama->perhitungan_omset_usaha) && $usahaUtama->perhitungan_omset_usaha !== '-')
                                <div style="margin-top: 5px;">
                                    <div style="display: inline-block; padding: 2px;">
                                        <img 
                                            src="{{ asset('storage/' . $usahaUtama->perhitungan_omset_usaha) }}" 
                                            alt="Perhitungan Omset Usaha"
                                            style="max-width: 100%; height: auto; display: block;"
                                        >
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- 2. BAGIAN USAHA TAMBAHAN (Urutan 2 dan seterusnya) --}}
                    @foreach($usahaLainnya as $usaha)
                        @if(!empty($usaha->gambaran_pekerjaan_debitur) || !empty($usaha->perhitungan_omset_usaha))
                            <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                                <div style="margin-top: 3px; font-weight: normal; text-align: justify;">
                                    {{ $usaha->gambaran_pekerjaan_debitur ?? '-' }}
                                </div>

                                @if(!empty($usaha->perhitungan_omset_usaha) && $usaha->perhitungan_omset_usaha !== '-')
                                    <div style="margin-top: 5px;">
                                        <div style="display: inline-block; padding: 2px;">
                                            <img 
                                                src="{{ asset('storage/' . $usaha->perhitungan_omset_usaha) }}" 
                                                alt="Perhitungan Omset Usaha"
                                                style="max-width: 100%; height: auto; display: block;"
                                            >
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach

                    {{-- 3. USAHA PENDUKUNG LAIN --}}
                    @if($usahaUtama && !empty($usahaUtama->usaha_pendukung))
                        <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                            <div style="font-weight: bold;">
                                2. Usaha Pendukung Lain
                            </div>
                            <div style="margin-top: 3px; font-weight: normal; text-align: justify;">
                                {{ $usahaUtama->usaha_pendukung ?? '-' }}
                            </div>

                            @if(!empty($usahaUtama->perhitungan_omset_pendukung) && $usahaUtama->perhitungan_omset_pendukung !== '-')
                                <div style="margin-top: 5px;">
                                    <div style="display: inline-block; padding: 2px;">
                                        <img 
                                            src="{{ asset('storage/' . $usahaUtama->perhitungan_omset_pendukung) }}" 
                                            alt="Perhitungan Omset Pendukung"
                                            style="max-width: 100%; height: auto; display: block;"
                                        >
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>

        <!-- D. URAIAN SINGKAT MENGENAI 5 C -->
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header">
                    D. URAIAN SINGKAT MENGENAI 5 C
                </div>
                
                <div class="text-sm">

                    <!-- 1. CAPITAL -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold;">
                            1. CAPITAL
                        </div>
                        <div style="margin-top: 3px; font-weight: normal; text-align: justify;">
                            {{ $data->limac->capital ?? '-' }}
                        </div>
                    </div>

                    <!-- 2. COLLATERAL -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold;">
                            2. COLLATERAL
                        </div>
                        <div style="margin-top: 5px;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="width: 25%; font-weight: normal; padding-bottom: 3px;">No.SHM</td>
                                    <td style="width: 3%; text-align: center; padding-bottom: 3px;">:</td>
                                    <td style="width: 72%; font-weight: normal; padding-bottom: 3px;">{{ $data->limac->no_shm ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: normal; padding-bottom: 3px;">Luas</td>
                                    <td style="text-align: center; padding-bottom: 3px;">:</td>
                                    <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->limac->luas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: normal; padding-bottom: 3px;">Nama Pemilik</td>
                                    <td style="text-align: center; padding-bottom: 3px;">:</td>
                                    <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->limac->pemilik ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: normal; padding-bottom: 3px;">Letak SHM</td>
                                    <td style="text-align: center; padding-bottom: 3px;">:</td>
                                    <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->limac->letak_shm ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Gambar Ringkasan Penilaian Jaminan -->
                        <div style="padding-left: 0%; margin-top: 10px;">
                            <div style="font-weight: normal;">
                                Ringkasan Penilaian Jaminan, Tanggal {{ $data->limac->tanggal ?? '-' }}
                            </div>
                            <div style="margin-top: 5px;">
                                @if(!empty($data->limac->ringkasan_penilaian_jaminan) && $data->limac->ringkasan_penilaian_jaminan !== '-')
                                    <div style="display: inline-block; padding: 2px;">
                                        <img 
                                            src="{{ asset('storage/' . $data->limac->ringkasan_penilaian_jaminan) }}" 
                                            alt="Ringkasan Penilaian Jaminan"
                                            style="max-width: 100%; height: auto; display: block;"
                                        >
                                    </div>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                        </div>

                        <!-- Informasi Harga Tanah -->
                        <div style="margin-top: 10px; font-weight: bold;">
                            Informasi Harga Tanah :
                        </div>
                        <div style="margin-top: 3px; padding-left: 15px; margin-bottom: 5px;">
                            <div style="margin-left: 0%;">1. {{ $data->limac->info_harga_tanah1 ?? '-' }}</div><br>
                            <div style="margin-left: 0%;">2. {{ $data->limac->info_harga_tanah2 ?? '-' }}</div><br>
                            <div style="margin-left: 0%;">3. {{ $data->limac->info_harga_tanah3 ?? '-' }}</div>
                        </div>

                        <!-- Batas Objek Jaminan -->
                        <div style="margin-top: 10px; font-weight: bold; ">
                            Batas Objek Jaminan :
                        </div>
                        <div style="margin-top: 3px; text-align: justify;">
                            {{ $data->limac->batas_objek_jaminan ?? '-' }}
                        </div>

                        <!-- Catatan Khusus Objek Jaminan -->
                        <div style="margin-top: 10px; font-weight: bold;">
                            Catatan Khusus Objek Jaminan :
                        </div>
                        <div style="margin-top: 3px; text-align: justify;">
                            {{ $data->limac->catatan_khusus ?? '-' }}
                        </div>
                    </div>

                    <!-- 3. CONDITION -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold;">
                            3. CONDITION
                        </div>
                        <div style="margin-top: 3px; font-weight: normal; text-align: justify;">
                            {{ $data->limac->condition ?? '-' }}
                        </div>
                    </div>

                    <!-- 4. CAPACITY -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold;">
                            4. CAPACITY
                        </div>
                        
                        <!-- Gambar Capacity -->
                        <div style="margin-top: 5px;">
                            @if(!empty($data->limac->capacity) && $data->limac->capacity !== '-')
                                <div style="display: inline-block; padding: 2px;">
                                    <img 
                                        src="{{ asset('storage/' . $data->limac->capacity) }}" 
                                        alt="Perhitungan Capacity"
                                        style="max-width: 100%; height: auto; display: block;"
                                    >
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </div>

                        <div style="margin-top: 10px; font-weight: bold;">
                            Tanggungan
                        </div>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 3px; padding-left: 15px;">
                            <tr>
                                <td style="width: 25%; font-weight: normal; padding-bottom: 3px;">Tanggungan Keluarga</td>
                                <td style="width: 3%; text-align: center; padding-bottom: 3px;">:</td>
                                <td style="width: 72%; font-weight: normal; padding-bottom: 3px;">{{ $data->limac->keluarga ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: normal; padding-bottom: 3px;">Tanggungan Anak</td>
                                <td style="text-align: center; padding-bottom: 3px;">:</td>
                                <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->limac->anak ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: normal; padding-bottom: 3px;">Tanggungan Pendidikan</td>
                                <td style="text-align: center; padding-bottom: 3px;">:</td>
                                <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->limac->pendidikan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- 5. CHARACTER -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold;">
                            5. CHARACTER
                        </div>
                        <div style="margin-top: 5px; font-weight: bold;">
                            Internal :
                        </div>
                        <div style="margin-top: 3px; font-weight: normal; text-align: justify;">
                            {{ $data->limac->internal ?? '-' }}
                        </div>

                        <div style="margin-top: 8px; font-weight: bold;">
                            Eksternal :
                        </div>
                        <div style="margin-top: 3px; font-weight: normal; text-align: justify; margin-bottom: 15px;">
                            {{ $data->limac->eksternal ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

        <!-- E. REFERENSI CREDIT ANALIST -->
            <div class="mb-6">
                <div class="section-header">
                    E. REFERENSI CREDIT ANALIST
                </div>
                <div class="text-sm">
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="margin-top: 3px; font-weight: normal; text-align: justify; margin-bottom: 15px;">
                            {{ $data->referensi_ca->referensi_ca ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

        <!-- F. DEVIASI -->
            <div class="mb-6">
                <div class="section-header">
                    F. DEVIASI
                </div>
                <div class="text-sm">
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="margin-top: 3px; font-weight: normal; text-align: justify; margin-bottom: 15px;">
                            {{ $data->deviasi->deviasi ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

        <!-- G. KESIMPULAN -->
            <div class="mb-6">
                <div class="section-header">
                    G. KESIMPULAN
                </div>
                <div class="text-sm">
                    <!-- Keterangan Kesimpulan -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="margin-top: 3px; font-weight: normal; text-align: justify;">
                            {{ $data->kesimpulan->kesimpulan ?? '-' }}
                        </div>
                    </div>

                    <!-- Gambar Plafon / Kesimpulan -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        @if(!empty($data->kesimpulan) && !empty($data->kesimpulan->plafon) && $data->kesimpulan->plafon !== '-')
                            <div style="display: inline-block; padding: 2px;">
                                <img 
                                    src="{{ asset('storage/' . $data->kesimpulan->plafon) }}" 
                                    alt="Plafon Kredit"
                                    style="max-width: 100%; height: auto; display: block;"
                                >
                            </div>
                        @else
                            <span>-</span>
                        @endif
                    </div>

                    <!-- Tabel Detail Kesimpulan (Provisi, Biaya Administrasi, dll) -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="width: 25%; font-weight: normal; padding-bottom: 3px;">Provisi</td>
                                <td style="width: 3%; text-align: center; padding-bottom: 3px;">:</td>
                                <td style="width: 72%; font-weight: normal; padding-bottom: 3px;">{{ $data->kesimpulan->provisi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: normal; padding-bottom: 3px;">Biaya Administrasi</td>
                                <td style="text-align: center; padding-bottom: 3px;">:</td>
                                <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->kesimpulan->biaya_administrasi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: normal; padding-bottom: 3px;">Jaminan</td>
                                <td style="text-align: center; padding-bottom: 3px;">:</td>
                                <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->kesimpulan->jaminan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: normal; padding-bottom: 3px;">Blokir</td>
                                <td style="text-align: center; padding-bottom: 3px;">:</td>
                                <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->kesimpulan->blokir ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: normal; padding-bottom: 3px;">Keterangan</td>
                                <td style="text-align: center; padding-bottom: 3px;">:</td>
                                <td style="font-weight: normal; padding-bottom: 3px;">{{ $data->kesimpulan->keterangan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

        <!-- GAMBAR JAMINAN, TEMPAT USAHA & TEMPAT TINGGAL -->
        <div class="page-container" style="page-break-before: always; break-before: page;">  
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header" style="text-align: center;">
                    GAMBAR JAMINAN, TEMPAT USAHA & TEMPAT TINGGAL
                </div>

                <div class="text-sm">
                    <!-- 1. Lokasi dan Foto Jaminan -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold; margin-bottom: 8px;">
                            1. Lokasi dan Foto Jaminan
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <!-- Tambahkan style untuk mencegah tabel terpotong buruk & mematikan repeat header -->
                            <table style="width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 0.875rem; page-break-inside: auto;">
                                
                                <!-- Tambahkan CSS agar theader TIDAK BERULANG di halaman baru -->
                                <style>
                                    thead { display: table-row-group; } /* Mencegah thead muncul otomatis di halaman berikutnya */
                                    tr { page-break-inside: avoid; page-break-after: auto; } /* Mencegah baris tabel terpotong */
                                </style>

                                <thead>
                                    <tr style="background-color: #f3f4f6;">
                                        <th style="border: 1px solid black; padding: 8px; text-align: left; width: 50%;">Gambar</th>
                                        <th style="border: 1px solid black; padding: 8px; text-align: left; width: 50%;">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Baris 1: Google Map di Kiri, Link & QR Code di Kanan -->
                                    <tr>
                                        <td style="border: 1px solid black; padding: 8px; vertical-align: top;">
                                            <div style="font-weight: bold; margin-bottom: 4px;">Google Map</div>
                                            @if(!empty($data->jaminan->google_maps) && $data->jaminan->google_maps !== '-')
                                                <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                    <img 
                                                        src="{{ asset('storage/' . $data->jaminan->google_maps) }}" 
                                                        alt="Google Map" 
                                                        style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                    >
                                                </div>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td style="border: 1px solid black; padding: 8px; vertical-align: top;">
                                            <!-- Link Share Location -->
                                            <div style="margin-bottom: 16px;">
                                                <div style="font-weight: bold; margin-bottom: 4px;">Link Share Location</div>
                                                @if(!empty($data->jaminan->share_location))
                                                    <a href="{{ $data->jaminan->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline; word-break: break-all;">
                                                        {{ $data->jaminan->share_location }}
                                                    </a>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>

                                            <!-- Kode QR Maps -->
                                            <div>
                                                <div style="font-weight: bold; margin-bottom: 4px;">Kode QR Maps</div>
                                                @if(!empty($data->jaminan->kode_qr) && $data->jaminan->kode_qr !== '-')
                                                    <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                        <img 
                                                            src="{{ asset('storage/' . $data->jaminan->kode_qr) }}" 
                                                            alt="Kode QR Maps" 
                                                            style="width: 150px; height: auto; display: block;"
                                                        >
                                                    </div>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Baris Berikutnya: Foto Jaminan (Berpasangan / 2 Kolom) -->
                                    @php
                                        $fotoJaminans = !empty($data->jaminan->foto_jaminan) ? json_decode($data->jaminan->foto_jaminan, true) : [];
                                        $chunks = array_chunk($fotoJaminans, 2);
                                    @endphp

                                    @foreach($chunks as $chunk)
                                        <tr>
                                            <!-- Kolom Kiri -->
                                            <td style="border: 1px solid black; padding: 8px; vertical-align: top; width: 50%;">
                                                @if(isset($chunk[0]))
                                                    <div style="font-weight: bold; margin-bottom: 4px;">Foto Jaminan</div>
                                                    <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                        <img 
                                                            src="{{ asset('storage/' . $chunk[0]) }}" 
                                                            alt="Foto Jaminan" 
                                                            style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                        >
                                                    </div>
                                                @else
                                                    &nbsp;
                                                @endif
                                            </td>

                                            <!-- Kolom Kanan -->
                                            <td style="border: 1px solid black; padding: 8px; vertical-align: top; width: 50%;">
                                                @if(isset($chunk[1]))
                                                    <div style="font-weight: bold; margin-bottom: 4px;">Foto Jaminan</div>
                                                    <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                        <img 
                                                            src="{{ asset('storage/' . $chunk[1]) }}" 
                                                            alt="Foto Jaminan" 
                                                            style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                        >
                                                    </div>
                                                @else
                                                    &nbsp;
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 2. Lokasi dan Foto Tempat Usaha -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <div style="font-weight: bold; margin-bottom: 8px;">
                            2. Lokasi dan Foto Tempat Usaha
                        </div>

                        @php
                            $listUsaha = $data->usaha ? $data->usaha->sortBy('urutan') : collect();
                        @endphp

                        @foreach($listUsaha as $usahaItem)
                            @php
                                $hurufUrutan = chr(96 + $loop->iteration); 
                            @endphp

                            <!-- Judul Bagian dengan Penomoran Huruf (a, b, c) -->
                            <div style="font-weight: bold; margin-top: 10px; margin-bottom: 6px;">
                                {{ $hurufUrutan }}. Lokasi dan Foto Tempat Usaha {{ $usahaItem->nama_usaha }}
                            </div>

                            <!-- Tabel Detail Lokasi & Foto Usaha -->
                            <div style="margin-bottom: 20px;">
                                <table style="width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 0.875rem;">
                                    <thead>
                                        <tr style="background-color: #f3f4f6;">
                                            <th style="border: 1px solid black; padding: 8px; text-align: left; width: 50%;">Gambar</th>
                                            <th style="border: 1px solid black; padding: 8px; text-align: left; width: 50%;">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Baris 1: Google Map di Kiri, Link & QR Code di Kanan -->
                                        <tr>
                                            <td style="border: 1px solid black; padding: 8px; vertical-align: top;">
                                                <div style="font-weight: bold; margin-bottom: 4px;">Google Map</div>
                                                @if(!empty($usahaItem->google_maps) && $usahaItem->google_maps !== '-')
                                                    <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                        <img 
                                                            src="{{ asset('storage/' . $usahaItem->google_maps) }}" 
                                                            alt="Google Map" 
                                                            style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                        >
                                                    </div>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td style="border: 1px solid black; padding: 8px; vertical-align: top;">
                                                <!-- Link Share Location -->
                                                <div style="margin-bottom: 16px;">
                                                    <div style="font-weight: bold; margin-bottom: 4px;">Link Share Location</div>
                                                    @if(!empty($usahaItem->share_location))
                                                        <a href="{{ $usahaItem->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline; word-break: break-all;">
                                                            {{ $usahaItem->share_location }}
                                                        </a>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </div>

                                                <!-- Kode QR Maps -->
                                                <div>
                                                    <div style="font-weight: bold; margin-bottom: 4px;">Kode QR Maps</div>
                                                    @if(!empty($usahaItem->kode_qr) && $usahaItem->kode_qr !== '-')
                                                        <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                            <img 
                                                                src="{{ asset('storage/' . $usahaItem->kode_qr) }}" 
                                                                alt="Kode QR Maps" 
                                                                style="width: 150px; height: auto; display: block;"
                                                            >
                                                        </div>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Baris Berikutnya: Foto Usaha (Berpasangan / 2 Kolom ke Bawah) -->
                                        @php
                                            $fotoUsahas = !empty($usahaItem->foto_usaha) ? json_decode($usahaItem->foto_usaha, true) : [];
                                            $chunks = array_chunk($fotoUsahas, 2);
                                        @endphp

                                        @foreach($chunks as $chunk)
                                            <tr>
                                                <!-- Kolom Kiri -->
                                                <td style="border: 1px solid black; padding: 8px; vertical-align: top; width: 50%;">
                                                    @if(isset($chunk[0]))
                                                        <div style="font-weight: bold; margin-bottom: 4px;">Foto Usaha</div>
                                                        <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                            <img 
                                                                src="{{ asset('storage/' . $chunk[0]) }}" 
                                                                alt="Foto Usaha" 
                                                                style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                            >
                                                        </div>
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </td>

                                                <!-- Kolom Kanan -->
                                                <td style="border: 1px solid black; padding: 8px; vertical-align: top; width: 50%;">
                                                    @if(isset($chunk[1]))
                                                        <div style="font-weight: bold; margin-bottom: 4px;">Foto Usaha</div>
                                                        <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                            <img 
                                                                src="{{ asset('storage/' . $chunk[1]) }}" 
                                                                alt="Foto Usaha" 
                                                                style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                            >
                                                        </div>
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>

                    <!-- 3. Lokasi dan Foto Tempat Tinggal -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px; margin-bottom: 40px;">
                        <div style="font-weight: bold; margin-bottom: 8px;">
                            3. Lokasi dan Foto Tempat Tinggal
                        </div>
                        
                        <div>
                            <table style="width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 0.875rem;">
                                
                                <!-- CSS untuk mematikan repeat header & mencegah baris terpotong -->
                                <style>
                                    thead { display: table-row-group; } 
                                    tr { page-break-inside: avoid; page-break-after: auto; } 
                                </style>

                                <thead>
                                    <tr style="background-color: #f3f4f6;">
                                        <th style="border: 1px solid black; padding: 8px; text-align: left; width: 50%;">Gambar</th>
                                        <th style="border: 1px solid black; padding: 8px; text-align: left; width: 50%;">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Baris 1: Google Map di Kiri, Link & QR Code di Kanan -->
                                    <tr>
                                        <td style="border: 1px solid black; padding: 8px; vertical-align: top;">
                                            <div style="font-weight: bold; margin-bottom: 4px;">Google Map</div>
                                            @if(!empty($data->rumah->google_maps) && $data->rumah->google_maps !== '-')
                                                <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                    <img 
                                                        src="{{ asset('storage/' . $data->rumah->google_maps) }}" 
                                                        alt="Google Map" 
                                                        style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                    >
                                                </div>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td style="border: 1px solid black; padding: 8px; vertical-align: top;">
                                            <!-- Link Share Location -->
                                            <div style="margin-bottom: 16px;">
                                                <div style="font-weight: bold; margin-bottom: 4px;">Link Share Location</div>
                                                @if(!empty($data->rumah->share_location))
                                                    <a href="{{ $data->rumah->share_location }}" target="_blank" style="color: #2563eb; text-decoration: underline; word-break: break-all;">
                                                        {{ $data->rumah->share_location }}
                                                    </a>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>

                                            <!-- Kode QR Maps -->
                                            <div>
                                                <div style="font-weight: bold; margin-bottom: 4px;">Kode QR Maps</div>
                                                @if(!empty($data->rumah->kode_qr) && $data->rumah->kode_qr !== '-')
                                                    <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                        <img 
                                                            src="{{ asset('storage/' . $data->rumah->kode_qr) }}" 
                                                            alt="Kode QR Maps" 
                                                            style="width: 150px; height: auto; display: block;"
                                                        >
                                                    </div>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Baris Berikutnya: Foto Tempat Tinggal (Berpasangan / 2 Kolom) -->
                                    @php
                                        $fotoTinggals = !empty($data->rumah->foto_tempat_tinggal) ? json_decode($data->rumah->foto_tempat_tinggal, true) : [];
                                        $chunks = array_chunk($fotoTinggals, 2);
                                    @endphp

                                    @foreach($chunks as $chunk)
                                        <tr>
                                            <!-- Kolom Kiri -->
                                            <td style="border: 1px solid black; padding: 8px; vertical-align: top; width: 50%;">
                                                @if(isset($chunk[0]))
                                                    <div style="font-weight: bold; margin-bottom: 4px;">Foto Tempat Tinggal</div>
                                                    <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                        <img 
                                                            src="{{ asset('storage/' . $chunk[0]) }}" 
                                                            alt="Foto Tempat Tinggal" 
                                                            style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                        >
                                                    </div>
                                                @else
                                                    &nbsp;
                                                @endif
                                            </td>

                                            <!-- Kolom Kanan -->
                                            <td style="border: 1px solid black; padding: 8px; vertical-align: top; width: 50%;">
                                                @if(isset($chunk[1]))
                                                    <div style="font-weight: bold; margin-bottom: 4px;">Foto Tempat Tinggal</div>
                                                    <div style="border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 6px; display: inline-block;">
                                                        <img 
                                                            src="{{ asset('storage/' . $chunk[1]) }}" 
                                                            alt="Foto Tempat Tinggal" 
                                                            style="width: 100%; max-width: 350px; height: auto; display: block;"
                                                        >
                                                    </div>
                                                @else
                                                    &nbsp;
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- SPESIFIKASI JAMINAN KREDIT -->
        <div class="page-container" style="page-break-before: always; break-before: page;">
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header" style="text-align: center;">
                    SPESIFIKASI JAMINAN KREDIT, MELIPUTI
                </div>
                
                <div class="text-sm">
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <!-- 1. Sertifikat -->
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal; padding-bottom: 4px;">1.</td>
                                <td style="width: 33%; font-weight: normal; padding-bottom: 4px;">Sertifikat</td>
                                <td style="width: 3%; text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="width: 59%; font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->sertifikat ?? '-' }}</td>
                            </tr>

                            <!-- 2. Nomor / NIB -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">2.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Nomor / NIB</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->nomor_nib ?? '-' }}</td>
                            </tr>

                            <!-- 3. Luas Tanah (P x L) -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">3.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Luas Tanah (p x l)</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->luas_tanah ?? '-' }}</td>
                            </tr>

                            <!-- 4. Luas Bangunan (P x L) -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">4.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Luas Bangunan (p x l)</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->luas_bangunan ?? '-' }}</td>
                            </tr>

                            <!-- 5. Lebar Depan -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">5.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Lebar Depan</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->lebar_depan ?? '-' }}</td>
                            </tr>

                            <!-- 6. PBG -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">6.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">PBG</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->pbg ?? '-' }}</td>
                            </tr>

                            <!-- 7. Orientasi -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">7.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Orientasi</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->orientasi ?? '-' }}</td>
                            </tr>

                            <!-- 8. Jumlah Ruangan -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; vertical-align: top; padding-bottom: 4px;">8.</td>
                                <td style="font-weight: normal; vertical-align: top; padding-bottom: 4px;">Jumlah Ruangan</td>
                                <td style="text-align: center; font-weight: normal; vertical-align: top; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <td style="width: 15%; border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->kamar_tidur ?? '-' }}</td>
                                            <td style="width: 35%; padding-left: 6px; font-weight: normal;">Kamar Tidur</td>
                                            <td style="width: 15%; border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->kamar_mandi ?? '-' }}</td>
                                            <td style="width: 35%; padding-left: 6px; font-weight: normal;">Kamar Mandi</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px; margin-top: 2px;">{{ $data->spesifikasi->ruang_keluarga ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Ruang Keluarga</td>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->ruang_makan ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Ruang Makan</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->ruang_tamu ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Ruang Tamu</td>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->dapur ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Dapur</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->kamar_pembantu ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Kamar Pembantu</td>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->pekarangan ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Taman / Pekarangan</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->gudang ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Gudang</td>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->carport ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Carport</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->garasi ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">Garasi</td>
                                            <td style="border: 1px solid black; text-align: center; font-weight: normal; background: white; padding: 2px;">{{ $data->spesifikasi->ruangan_lain ?? '-' }}</td>
                                            <td style="padding-left: 6px; font-weight: normal;">.....</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <!-- 9. Fasilitas Lainnya -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-top: 4px; padding-bottom: 4px;">9.</td>
                                <td style="font-weight: normal; padding-top: 4px; padding-bottom: 4px;">Fasilitas Lainnya</td>
                                <td style="text-align: center; font-weight: normal; padding-top: 4px; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-top: 4px; padding-bottom: 4px;">{{ $data->spesifikasi->fasilitas_lain ?? '-' }}</td>
                            </tr>

                            <!-- 10. Kondisi Bangunan -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">10.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Kondisi Bangunan</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->kondisi_bangunan ?? '-' }}</td>
                            </tr>

                            <!-- 11. Kondisi Lantai -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">11.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Kondisi Lantai</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->kondisi_lantai ?? '-' }}</td>
                            </tr>

                            <!-- 12. Kondisi Plafon -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">12.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Kondisi Plafon</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->kondisi_plafon ?? '-' }}</td>
                            </tr>

                            <!-- 13. Bahan Atap -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">13.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Bahan Atap</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->bahan_atap ?? '-' }}</td>
                            </tr>

                            <!-- 14. Struktur Atap -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">14.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Struktur Atap</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->struktur_atap ?? '-' }}</td>
                            </tr>

                            <!-- 15. Listrik -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">15.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Listrik</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->listrik ?? '-' }}</td>
                            </tr>

                            <!-- 16. Air -->
                            <tr>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">16.</td>
                                <td style="font-weight: normal; padding-bottom: 4px;">Air</td>
                                <td style="text-align: center; font-weight: normal; padding-bottom: 4px;">:</td>
                                <td style="font-weight: normal; color: #000000; padding-bottom: 4px;">{{ $data->spesifikasi->air ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- DENAH JAMINAN -->
        <div class="page-container" style="page-break-before: always; break-before: page;">   
            <div class="mb-6">
                <!-- Header Section -->
                <div class="section-header" style="text-align: center;">
                    DENAH JAMINAN
                </div>
                
                <div class="text-sm">
                    <!-- Denah -->
                    <div style="padding-left: 5%; padding-right: 5%; margin-top: 10px;">
                        @if(!empty($data->denah) && !empty($data->denah->denah_jaminan) && $data->denah->denah_jaminan !== '-')
                            <div style="display: inline-block; padding: 2px;">
                                <img 
                                    src="{{ asset('storage/' . $data->denah->denah_jaminan) }}" 
                                    alt="Denah"
                                    style="max-width: 100%; height: auto; display: block;"
                                >
                            </div>
                        @else
                            <span>-</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>