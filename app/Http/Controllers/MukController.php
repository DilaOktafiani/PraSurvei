<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;            
use App\Models\Muk\Debitur;  
use App\Models\Muk\PlafonKredit;
use App\Models\Muk\InformasiUsaha;
use App\Models\Muk\LimaC;
use App\Models\Muk\ReferensiCA;
use App\Models\Muk\Deviasi;
use App\Models\Muk\Kesimpulan;
use App\Models\Muk\Jaminan;
use App\Models\Muk\Usaha;
use App\Models\Muk\Rumah;
use App\Models\Muk\Spesifikasi;
use App\Models\Muk\Denah;
use Barryvdh\DomPDF\Facade\Pdf;

class MukController extends Controller
{
    // =========================================================================
    // DATA DEBITUR
    // =========================================================================

    public function createAlur1(Request $request)
    {
        $debitur = null;

        // Jika ada parameter 'new=true' (artinya diklik murni dari Dashboard menu utama)
        if ($request->has('new') && $request->new == 'true') {
            session()->forget('debitur_id');
        }

        // Jika ada parameter 'id' (artinya diklik dari tombol Edit di riwayat)
        if ($request->has('id')) {
            session(['debitur_id' => $request->id]);
        }

        // Ambil data jika session 'debitur_id' tersedia (baik dari Edit maupun sisa dari Alur 2)
        if (session()->has('debitur_id')) {
            $debitur = Debitur::find(session('debitur_id'));
        }

        return view('z1-muk', compact('debitur'));
    }
    
    public function storeAlur1(Request $request)
    {
        // 1. Cek apakah debitur sudah tersimpan berdasarkan session
        $debiturId = session('debitur_id');
        $existingDebitur = $debiturId ? Debitur::find($debiturId) : null;
        
        // 2. Jika file di database sudah ada, buat jadi 'nullable' (tidak wajib upload ulang). 
        // Jika belum ada sama sekali, jadikan 'required'.
        $idiRule = ($existingDebitur && $existingDebitur->idi_di_bank_lain) ? 'nullable' : 'required';

        $validated = $request->validate([
            'no_register'          => 'required|string|max:100',
            'nama'                 => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'nama_ibu_kandung'     => 'required|string|max:255',
            'nama_istri_penjamin'  => 'required|string|max:255',
            'alamat_ktp'           => 'required|string',
            'alamat_domisili'      => 'required|string',
            'no_hp'                => 'required|string|max:50',
            'pekerjaan'            => 'required|string|max:255',
            'bidang_usaha'         => 'required|string|max:255',
            'alamat_usaha'         => 'required|string',
            'kontak'               => 'required|string|max:50',
            'idi_di_bank_lain'     => "$idiRule|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240",
            'keterangan'           => 'required|string',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string'   => 'Kolom :attribute harus berupa teks.',
            'max'      => 'Kolom :attribute melebihi batas maksimal karakter.',
            'file'     => 'Kolom :attribute harus berupa sebuah berkas.',
            'mimes'    => 'Format file IDI di bank lain harus berupa PDF, JPG, JPEG, PNG, atau DWG.',
            'idi_di_bank_lain.max' => 'Ukuran file IDI di bank lain maksimal adalah 10 MB.',
        ]);

        $data = $request->except(['idi_di_bank_lain']);

        // Handle Upload File IDI di Bank Lain
        if ($request->hasFile('idi_di_bank_lain')) {
            $pathIdi = $request->file('idi_di_bank_lain')
                ->store('idi_bank_lain', 'public');

            // Simpan path relatif ke database
            $data['idi_di_bank_lain'] = $pathIdi;
        }

        // LOGIKA UPDATE / CREATE
        if ($existingDebitur) {
            // Jika ada file baru dan file lama ada, hapus file lama
            if (
                $request->hasFile('idi_di_bank_lain') &&
                $existingDebitur->idi_di_bank_lain
            ) {
                Storage::disk('public')->delete(
                    $existingDebitur->idi_di_bank_lain
                );
            }

            $existingDebitur->update($data);
            $debitur = $existingDebitur;

        } else {
            $debitur = Debitur::create($data);

            session([
                'debitur_id' => $debitur->id
            ]);
        }

        return redirect()->route('z2-muk');
    }

    // ==========================================
    // PENGAJUAN PLAFON KREDIT
    // ==========================================

    public function createAlur2()
    {
        $debiturId = session('debitur_id'); 
        $data = null; 

        if ($debiturId) {
            // Mengambil data berdasarkan debitur_id menggunakan model PlafonKredit
            $data = PlafonKredit::where('debitur_id', $debiturId)->first();
        }

        // Tentukan rute tombol kembali secara dinamis (sesuaikan dengan rute alur sebelumnya, misal z1-muk)
        $backRoute = route('z1-muk'); 

        return view('z2-muk', compact('data', 'backRoute')); 
    }

    public function storeAlur2(Request $request)
    {
        // Cek apakah data plafon kredit sudah ada berdasarkan debitur_id
        $plafonExisting = PlafonKredit::where('debitur_id', $request->debitur_id)->first();
        
        // Jika file lama sudah ada di database, buat jadi 'nullable' (tidak wajib upload ulang)
        $fileRule = ($plafonExisting && $plafonExisting->pengajuan_plafon_kredit) ? 'nullable' : 'required';

        // 1. Validasi input sesuai dengan form & model PlafonKredit
        $request->validate([
            'debitur_id'              => 'required',
            'pengajuan_plafon_kredit' => "$fileRule|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240",
            'tujuan_penggunaan'       => 'required|string',
        ], [
            'required'                    => 'Kolom :attribute wajib diisi.',
            'string'                      => 'Kolom :attribute harus berupa teks.',
            'file'                        => 'Kolom :attribute harus berupa sebuah berkas.',
            'mimes'                       => 'Format file harus berupa PDF, JPG, JPEG, PNG, atau DWG.',
            'pengajuan_plafon_kredit.max' => 'Ukuran file maksimal adalah 10 MB.',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file
            $pathFile = $plafonExisting ? $plafonExisting->pengajuan_plafon_kredit : null;

            // 3. Handle upload file baru jika di-upload user
            if ($request->hasFile('pengajuan_plafon_kredit')) {
                // Hapus file lama fisik jika ada di storage
                if ($pathFile && Storage::disk('public')->exists($pathFile)) {
                    Storage::disk('public')->delete($pathFile);
                }

                $file = $request->file('pengajuan_plafon_kredit');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                
                // Simpan ke storage (disk public)
                $pathFile = $file->storeAs('pengajuan_plafon', $filename, 'public');
            }

            // 4. Simpan atau update data menggunakan model PlafonKredit
            PlafonKredit::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'pengajuan_plafon_kredit' => $pathFile,
                    'tujuan_penggunaan'       => $request->tujuan_penggunaan,
                ]
            );

            DB::commit();
            
            return redirect()->route('z3-muk')->with('success', 'Data plafon kredit berhasil disimpan.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // INFORMASI USAHA
    // ==========================================

    public function createAlur3(Request $request, $debitur_id = null)
    {
        $debiturId = $debitur_id ?? $request->input('debitur_id') ?? session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        session(['debitur_id' => $debiturId]);

        $debitur = Debitur::find($debiturId);
        
        // Ambil data usaha utama (urutan 1)
        $infoUtama = InformasiUsaha::where('debitur_id', $debiturId)->where('urutan', 1)->first();
        
        // Ambil data usaha dinamis (urutan 2 sampai 10)
        $infoLainnya = InformasiUsaha::where('debitur_id', $debiturId)->where('urutan', '>', 1)->orderBy('urutan', 'asc')->get();

        // Tentukan rute tombol kembali
        $backRoute = session('informasi_usaha_back', route('z2-muk')); 

        return view('z3-muk', compact('debitur', 'infoUtama', 'infoLainnya', 'debiturId', 'backRoute')); 
    }

    public function storeAlur3(Request $request)
    {
        $debiturId = $request->debitur_id ?? session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('step1')
                ->with('error', 'Data debitur tidak ditemukan.');
        }

        session(['debitur_id' => $debiturId]);

        // Ambil data usaha utama (urutan 1) yang sudah ada di database (jika ada)
        $infoUtama = InformasiUsaha::where('debitur_id', $debiturId)->where('urutan', 1)->first();
        $hasExistingFile = $infoUtama && !empty($infoUtama->perhitungan_omset_usaha);

        // 1. Validasi Input Utama & Dinamis
        $rules = [
            'gambaran_pekerjaan_debitur' => 'required|string',
            'perhitungan_omset_usaha' => $hasExistingFile 
                ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' 
                : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'usaha_pendukung' => 'nullable|string',
            'perhitungan_omset_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
        ];

        for ($i = 2; $i <= 10; $i++) {
            $rules["gambaran_pekerjaan_debitur_{$i}"] = 'nullable|string';
            $rules["perhitungan_omset_usaha_{$i}"] = 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';
        }

        $request->validate($rules);

        DB::beginTransaction();

        try {
            // ==========================================
            // 2. SIMPAN USAHA UTAMA (Urutan = 1)
            // ==========================================
            $infoUtama = InformasiUsaha::firstOrNew([
                'debitur_id' => $debiturId,
                'urutan' => 1
            ]);

            $infoUtama->gambaran_pekerjaan_debitur = $request->gambaran_pekerjaan_debitur;
            $infoUtama->usaha_pendukung = $request->input('usaha_pendukung') ?? '';

            // Handle file omset usaha 1
            if ($request->hasFile('perhitungan_omset_usaha')) {
                if ($infoUtama->perhitungan_omset_usaha && \Storage::disk('public')->exists($infoUtama->perhitungan_omset_usaha)) {
                    \Storage::disk('public')->delete($infoUtama->perhitungan_omset_usaha);
                }
                $infoUtama->perhitungan_omset_usaha = $request->file('perhitungan_omset_usaha')->store('informasi_usaha', 'public');
            }

            // Handle file omset pendukung (DIREVISI AGAR MASUK KE KOLOM YANG BENAR)
            if ($request->hasFile('perhitungan_omset_pendukung')) {
                if ($infoUtama->perhitungan_omset_pendukung && \Storage::disk('public')->exists($infoUtama->perhitungan_omset_pendukung)) {
                    \Storage::disk('public')->delete($infoUtama->perhitungan_omset_pendukung);
                }
                // Ubah dari perhitungan_omset_usaha menjadi perhitungan_omset_pendukung
                $infoUtama->perhitungan_omset_pendukung = $request->file('perhitungan_omset_pendukung')->store('informasi_usaha', 'public');
            }

            $infoUtama->save();


            // ==========================================
            // 3. SIMPAN USAHA DINAMIS (Urutan 2 sampai 10)
            // ==========================================
            $oldDetails = InformasiUsaha::where('debitur_id', $debiturId)->where('urutan', '>', 1)->get();
            
            // Hapus data lama dari database untuk urutan > 1 agar nanti diganti dengan inputan terbaru
            InformasiUsaha::where('debitur_id', $debiturId)->where('urutan', '>', 1)->delete();

            for ($i = 2; $i <= 10; $i++) {
                $fieldPekerjaan = "gambaran_pekerjaan_debitur_{$i}";
                $fieldOmset = "perhitungan_omset_usaha_{$i}";

                $pekerjaanVal = $request->input($fieldPekerjaan);
                $hasFile = $request->hasFile($fieldOmset);

                // Jika user mengisi teks atau mengupload file pada baris dinamis ini
                if (!empty($pekerjaanVal) || $hasFile) {
                    $filePath = null;

                    if ($hasFile) {
                        $filePath = $request->file($fieldOmset)->store('informasi_usaha', 'public');
                    } else {
                        // Pertahankan file lama jika user tidak mengupload ulang di baris tersebut
                        $oldItem = $oldDetails->where('urutan', $i)->first();
                        if ($oldItem) {
                            $filePath = $oldItem->perhitungan_omset_usaha;
                        }
                    }

                    InformasiUsaha::create([
                        'debitur_id' => $debiturId,
                        'urutan' => $i,
                        'gambaran_pekerjaan_debitur' => $pekerjaanVal ?? '',
                        'perhitungan_omset_usaha' => $filePath,
                        'usaha_pendukung' => null, 
                        'perhitungan_omset_pendukung' => null,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('z4-muk')
                ->with('success', 'Informasi Usaha berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Gagal: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // ==========================================
    // URAIAN SINGKAT MENGENAI 5 C
    // ==========================================

    public function createAlur4()
    {
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('step1')
                ->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        $data = \App\Models\Muk\LimaC::where(
            'debitur_id',
            $debiturId
        )->first();

        $debitur = \App\Models\Debitur::find($debiturId);

        // Tombol kembali ke halaman z3-muk
        $backRoute = route('z3-muk');

        return view(
            'z4-muk',
            compact('data', 'debitur', 'backRoute')
        );
    }

    public function storeAlur4(Request $request)
    {
        // Ambil debitur_id dari form atau session
        $debiturId = $request->debitur_id ?? session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('step1')
                ->with('error', 'Data debitur tidak ditemukan.');
        }

        // Simpan ke session
        session(['debitur_id' => $debiturId]);


        // ==========================================
        // 1. VALIDASI
        // ==========================================
        // Ambil data lama untuk pengecekan file
        $existingData = \App\Models\Muk\LimaC::where('debitur_id', $debiturId)->first();

        $request->validate([
            // CAPITAL
            'capital' => 'required|string',

            // COLLATERAL
            'no_shm' => 'required|string',
            'luas' => 'required|string',
            'pemilik' => 'required|string',
            'letak_shm' => 'required|string',

            // Jika file lama belum ada, maka wajib upload. Jika sudah ada, jadi nullable.
            'ringkasan_penilaian_jaminan' => ($existingData && $existingData->ringkasan_penilaian_jaminan) 
                ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' 
                : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',

            'tanggal' => 'nullable|string',
            'info_harga_tanah1' => 'required|string',
            'info_harga_tanah2' => 'nullable|string',
            'info_harga_tanah3' => 'nullable|string',
            'batas_objek_jaminan' => 'required|string',
            'catatan_khusus' => 'required|string',

            // CONDITION
            'condition' => 'required|string',

            // CAPACITY
            'capacity' => ($existingData && $existingData->capacity) 
                ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' 
                : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',

            'keluarga' => 'required|string',
            'anak' => 'required|string',
            'pendidikan' => 'required|string',

            // CHARACTER
            'internal' => 'required|string',
            'eksternal' => 'required|string',
        ]);


        DB::beginTransaction();

        try {

            // ==========================================
            // 2. AMBIL DATA LAMA
            // ==========================================
            $data = \App\Models\Muk\LimaC::where(
                'debitur_id',
                $debiturId
            )->first();


            // ==========================================
            // 3. FILE RINGKASAN PENILAIAN JAMINAN
            // ==========================================
            $fileRingkasan = $data
                ? $data->ringkasan_penilaian_jaminan
                : null;

            if ($request->hasFile('ringkasan_penilaian_jaminan')) {

                if (
                    $fileRingkasan &&
                    \Storage::disk('public')->exists($fileRingkasan)
                ) {
                    \Storage::disk('public')->delete($fileRingkasan);
                }

                $fileRingkasan =
                    $request->file('ringkasan_penilaian_jaminan')
                        ->store('penilaian_jaminan', 'public');
            }


            // ==========================================
            // 4. FILE CAPACITY
            // ==========================================
            $fileCapacity = $data
                ? $data->capacity
                : null;

            if ($request->hasFile('capacity')) {

                if (
                    $fileCapacity &&
                    \Storage::disk('public')->exists($fileCapacity)
                ) {
                    \Storage::disk('public')->delete($fileCapacity);
                }

                $fileCapacity =
                    $request->file('capacity')
                        ->store('capacity', 'public');
            }


            // ==========================================
            // 5. SIMPAN / UPDATE DATA
            // ==========================================
            \App\Models\Muk\LimaC::updateOrCreate(

                ['debitur_id' => $debiturId],

                [
                    // CAPITAL
                    'capital' =>
                        $request->capital,


                    // COLLATERAL (Rincian Jaminan)
                    'no_shm' =>
                        $request->no_shm,

                    'luas' =>
                        $request->luas,

                    'pemilik' =>
                        $request->pemilik,

                    'letak_shm' =>
                        $request->letak_shm,

                    'ringkasan_penilaian_jaminan' =>
                        $fileRingkasan,

                    'tanggal' =>
                        $request->tanggal,

                    'info_harga_tanah1' =>
                        $request->info_harga_tanah1,

                    'info_harga_tanah2' =>
                        $request->info_harga_tanah2,

                    'info_harga_tanah3' =>
                        $request->info_harga_tanah3,

                    'batas_objek_jaminan' =>
                        $request->batas_objek_jaminan,

                    'catatan_khusus' =>
                        $request->catatan_khusus,


                    // CONDITION
                    'condition' =>
                        $request->condition,


                    // CAPACITY
                    'capacity' =>
                        $fileCapacity,

                    'keluarga' =>
                        $request->keluarga,

                    'anak' =>
                        $request->anak,

                    'pendidikan' =>
                        $request->pendidikan,


                    // CHARACTER
                    'internal' =>
                        $request->internal,

                    'eksternal' =>
                        $request->eksternal,
                ]
            );


            DB::commit();


            // ==========================================
            // 6. KE HALAMAN BERIKUTNYA
            // ==========================================
            return redirect()
                ->route('z5-muk')
                ->with(
                    'success',
                    'Data 5C berhasil disimpan.'
                );


        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => 'Gagal: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    // ==========================================
    // REFERENSI CA
    // ==========================================

    public function createAlur5()
    {
        // PENGAMAN: Ambil ID debitur dari session
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();

            $debiturId = $firstDebitur ? $firstDebitur->id : 1;

            session(['debitur_id' => $debiturId]);
        }

        // Ambil data Referensi Credit Analyst berdasarkan debitur
        $data = ReferensiCA::where('debitur_id', $debiturId)->first();

        // Ambil data debitur
        $debitur = \App\Models\Debitur::find($debiturId);

        // Tombol kembali ke halaman Data SLIK
        $backRoute = route('z4-muk');

        return view('z5-muk', compact(
            'data',
            'debitur',
            'backRoute'
        ));
    }

    public function storeAlur5(Request $request)
    {
        // Ambil ID debitur dari form
        // Jika tidak ada, ambil dari session
        $debiturId = $request->debitur_id ?? session('debitur_id');

        // Pastikan ada ID debitur
        if (!$debiturId) {
            return back()
                ->withErrors(['error' => 'ID debitur tidak ditemukan.'])
                ->withInput();
        }

        // Validasi input
        $request->validate([
            'debitur_id' => 'required',
            'referensi_ca' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            // Simpan atau update Referensi Credit Analyst
            ReferensiCA::updateOrCreate(
                [
                    'debitur_id' => $debiturId
                ],
                [
                    'referensi_ca' => $request->referensi_ca,
                ]
            );

            // Simpan ID debitur ke session
            session(['debitur_id' => $debiturId]);

            DB::commit();

            return redirect()
                ->route('z6-muk')
                ->with(
                    'success',
                    'Referensi Credit Analyst berhasil disimpan.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => 'Gagal menyimpan Referensi Credit Analyst: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    // ==========================================
    // DEVIASI
    // ==========================================

    public function createAlur6()
    {
        // PENGAMAN: Ambil ID debitur dari session
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();

            $debiturId = $firstDebitur ? $firstDebitur->id : 1;

            session(['debitur_id' => $debiturId]);
        }

        // Ambil data Deviasi berdasarkan debitur_id
        $data = \App\Models\Muk\Deviasi::where(
            'debitur_id',
            $debiturId
        )->first();

        // Ambil data debitur
        $debitur = \App\Models\Debitur::find($debiturId);

        // Tombol kembali ke halaman sebelumnya
        $backRoute = route('z5-muk');

        return view('z6-muk', compact(
            'data',
            'debitur',
            'backRoute'
        ));
    }

    public function storeAlur6(Request $request)
    {
        // Ambil ID debitur dari form
        // Jika tidak ada, ambil dari session
        $debiturId = $request->debitur_id ?? session('debitur_id');

        // Pastikan ID debitur tersedia
        if (!$debiturId) {
            return back()
                ->withErrors([
                    'error' => 'ID debitur tidak ditemukan.'
                ])
                ->withInput();
        }

        // Validasi input
        $request->validate([
            'debitur_id' => 'required',
            'deviasi' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            // Simpan atau update data Deviasi
            \App\Models\Muk\Deviasi::updateOrCreate(
                [
                    'debitur_id' => $debiturId
                ],
                [
                    'deviasi' => $request->deviasi,
                ]
            );

            // Simpan ID debitur ke session
            session([
                'debitur_id' => $debiturId
            ]);

            DB::commit();

            return redirect()
                ->route('z7-muk')
                ->with(
                    'success',
                    'Deviasi berhasil disimpan.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => 'Gagal menyimpan Deviasi: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }
    
    // ==========================================
    // KESIMPULAN
    // ==========================================

    public function createAlur7(Request $request)
    {
        // Cek debitur_id dari request (jika dikirim via URL), lalu dari session
        $debiturId = $request->input('debitur_id') ?? session('debitur_id');
        
        $data = null;

        if ($debiturId) {
            // Ambil data kesimpulan berdasarkan debitur_id
            $data = Kesimpulan::where('debitur_id', $debiturId)->first();
        }

        // Tombol kembali ke alur sebelumnya
        $backRoute = route('z6-muk');

        return view('z7-muk', compact('data', 'backRoute', 'debiturId'));
    }


    public function storeAlur7(Request $request)
    {
        // 1. Validasi input sesuai dengan form & model Kesimpulan
        $request->validate([
            'debitur_id'         => 'required',
            'kesimpulan'         => 'required|string',
            'plafon'             => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'provisi'            => 'required|string',
            'biaya_administrasi' => 'required|string',
            'jaminan'            => 'required|string',
            'blokir'             => 'required|string',
            'keterangan'         => 'string',
        ], [
            'required'              => 'Kolom :attribute wajib diisi.',
            'string'                => 'Kolom :attribute harus berupa teks.',
            'file'                  => 'Kolom :attribute harus berupa sebuah berkas.',
            'mimes'                 => 'Format file harus berupa PDF, JPG, JPEG, PNG, atau DWG.',
            'plafon.max'            => 'Ukuran file plafon maksimal adalah 10 MB.',
        ]);

        DB::beginTransaction();

        try {

            // 2. Ambil data Kesimpulan lama jika ada
            $kesimpulan = Kesimpulan::where(
                'debitur_id',
                $request->debitur_id
            )->first();

            // Ambil path file plafon lama
            $pathFile = $kesimpulan
                ? $kesimpulan->plafon
                : null;


            // 3. Handle upload file plafon baru
            if ($request->hasFile('plafon')) {

                // Hapus file plafon lama jika ada
                if ($pathFile && Storage::disk('public')->exists($pathFile)) {
                    Storage::disk('public')->delete($pathFile);
                }

                $file = $request->file('plafon');

                $filename = time() . '_' .
                    preg_replace(
                        '/\s+/',
                        '_',
                        $file->getClientOriginalName()
                    );

                // Simpan file baru ke folder plafon
                $pathFile = $file->storeAs(
                    'plafon',
                    $filename,
                    'public'
                );
            }


            // 4. Simpan atau update data Kesimpulan
            Kesimpulan::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'kesimpulan'         => $request->kesimpulan,
                    'plafon'             => $pathFile,
                    'provisi'            => $request->provisi,
                    'biaya_administrasi' => $request->biaya_administrasi,
                    'jaminan'            => $request->jaminan,
                    'blokir'             => $request->blokir,
                    'keterangan'         => $request->keterangan,
                ]
            );

            // Simpan debitur_id ke session
            session([
                'debitur_id' => $request->debitur_id
            ]);

            DB::commit();

            // Redirect tetap ke alur berikutnya setelah Kesimpulan
            return redirect()
                ->route('z8-muk')
                ->with('success', 'Data Kesimpulan berhasil disimpan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => 'Gagal menyimpan Kesimpulan: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    // ==========================================
    // JAMINAN
    // ==========================================

    public function createAlur8()
    {
        $debiturId = session('debitur_id');

        $data = null;

        if ($debiturId) {
            // Mengambil data berdasarkan debitur_id menggunakan model Jaminan
            $data = Jaminan::where('debitur_id', $debiturId)->first();
        }

        // Tentukan rute tombol kembali secara dinamis
        $backRoute = route('z7-muk');

        return view('z8-muk', compact('data', 'backRoute'));
    }

    public function storeAlur8(Request $request)
    {
        $debiturId = $request->debitur_id;
        $jaminan = Jaminan::where('debitur_id', $debiturId)->first();

        // Tentukan apakah file wajib diisi (jika belum ada data sama sekali di database)
        $fileValidation = ($jaminan && $jaminan->google_maps) ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';
        $fileQrValidation = ($jaminan && $jaminan->kode_qr) ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';
        
        // Validasi Foto Jaminan sebagai array (maksimal 50 file)
        $hasExistingFotoJaminan = $jaminan && !empty($jaminan->foto_jaminan);
        $fileFotoValidation = $hasExistingFotoJaminan ? 'nullable|array|max:50' : 'required|array|max:50';
        $fileFotoItemValidation = 'file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';

        // 1. Validasi input sesuai dengan form & kondisi file
        $request->validate([
            'debitur_id'       => 'required',
            'google_maps'      => $fileValidation,
            'share_location'   => 'required|url',
            'kode_qr'          => $fileQrValidation,
            'foto_jaminan'     => $fileFotoValidation,
            'foto_jaminan.*'   => $fileFotoItemValidation, // Validasi untuk setiap file di dalam array
        ]);

        DB::beginTransaction();

        try {
            // Ambil path file lama jika data sudah ada
            $pathGoogleMaps = $jaminan ? $jaminan->google_maps : null;
            $pathQR = $jaminan ? $jaminan->kode_qr : null;
            
            // Untuk foto jaminan (multiple), decode dari JSON jika sudah ada
            $pathJaminan = ($jaminan && $jaminan->foto_jaminan) ? json_decode($jaminan->foto_jaminan, true) : [];

            // ==========================================
            // 2. HANDLE GOOGLE MAPS
            // ==========================================
            if ($request->hasFile('google_maps')) {
                if ($pathGoogleMaps && Storage::disk('public')->exists($pathGoogleMaps)) {
                    Storage::disk('public')->delete($pathGoogleMaps);
                }

                $file = $request->file('google_maps');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $pathGoogleMaps = $file->storeAs('google_maps', $filename, 'public');
            }

            // ==========================================
            // 3. HANDLE KODE QR
            // ==========================================
            if ($request->hasFile('kode_qr')) {
                if ($pathQR && Storage::disk('public')->exists($pathQR)) {
                    Storage::disk('public')->delete($pathQR);
                }

                $file = $request->file('kode_qr');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $pathQR = $file->storeAs('kode_qr', $filename, 'public');
            }

            // ==========================================
            // 4. HANDLE FOTO JAMINAN (MULTIPLE)
            // ==========================================
            if ($request->hasFile('foto_jaminan')) {
                // Hapus file-file lama jika ada
                if (!empty($pathJaminan) && is_array($pathJaminan)) {
                    foreach ($pathJaminan as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                $pathJaminan = [];
                foreach ($request->file('foto_jaminan') as $file) {
                    $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $pathJaminan[] = $file->storeAs('foto_jaminan', $filename, 'public');
                }
            }

            // ==========================================
            // 5. SIMPAN / UPDATE DATA JAMINAN
            // ==========================================
            Jaminan::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'google_maps'    => $pathGoogleMaps,
                    'kode_qr'        => $pathQR,
                    'foto_jaminan'   => !empty($pathJaminan) ? json_encode($pathJaminan) : ($jaminan->foto_jaminan ?? null),
                    'share_location' => $request->share_location,
                ]
            );

            DB::commit();

            return redirect()->route('z9-muk')
                ->with('success', 'Data berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Gagal: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // ==========================================
    // USAHA
    // ==========================================

    public function createAlur9(Request $request)
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        // Ambil urutan usaha dari URL
        $urutan = $request->query('urutan', 1);

        // Ambil data usaha berdasarkan debitur dan urutan
        $data = Usaha::where('debitur_id', $debiturId)
            ->where('urutan', $urutan)
            ->first();

        $debitur = \App\Models\Debitur::find($debiturId);

        return view('z9-muk', compact('data', 'debitur', 'urutan'));
    }

    public function storeAlur9(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // Cari data usaha yang sudah ada berdasarkan debitur dan urutan
        $usaha = Usaha::where('debitur_id', $debiturId)
            ->where('urutan', $request->urutan)
            ->first();

        // Tentukan apakah file wajib diisi (jika belum ada data sama sekali di database untuk urutan ini)
        $fileGoogleMapsValidation = ($usaha && $usaha->google_maps) ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';
        $fileKodeQrValidation = ($usaha && $usaha->kode_qr) ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';
        
        // Validasi Foto Usaha sebagai array (maksimal 50 file)
        $hasExistingFotoUsaha = $usaha && !empty($usaha->foto_usaha);
        $fileFotoValidation = $hasExistingFotoUsaha ? 'nullable|array|max:50' : 'required|array|max:50';
        $fileFotoItemValidation = 'file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';

        // Validasi input (maksimal urutan disesuaikan menjadi 10)
        $request->validate([
            'debitur_id'            => 'required',
            'urutan'                => 'required|integer|min:1|max:10',
            'nama_usaha'            => 'required|string',
            'google_maps'           => $fileGoogleMapsValidation,
            'share_location'        => 'required|string',
            'kode_qr'               => $fileKodeQrValidation,
            'foto_usaha'            => $fileFotoValidation,
            'foto_usaha.*'          => $fileFotoItemValidation,
            'apakah_ada_usaha_lain' => 'nullable|in:YA,TIDAK ADA',
        ]);

        DB::beginTransaction();

        try {
            // Ambil path file lama jika data sudah ada
            $pathGoogleMaps = $usaha ? $usaha->google_maps : null;
            $pathQR = $usaha ? $usaha->kode_qr : null;
            
            // Untuk foto usaha (multiple), decode dari JSON jika sudah ada
            $pathFotoUsaha = ($usaha && $usaha->foto_usaha) ? json_decode($usaha->foto_usaha, true) : [];

            /*
            |--------------------------------------------------------------------------
            | 1. HANDLE GOOGLE MAPS
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('google_maps')) {
                if ($pathGoogleMaps && Storage::disk('public')->exists($pathGoogleMaps)) {
                    Storage::disk('public')->delete($pathGoogleMaps);
                }

                $file = $request->file('google_maps');
                // Format penamaan seragam dengan timestamp agar unik & bersih
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $pathGoogleMaps = $file->storeAs('usaha/google_maps', $filename, 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | 2. HANDLE KODE QR
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('kode_qr')) {
                if ($pathQR && Storage::disk('public')->exists($pathQR)) {
                    Storage::disk('public')->delete($pathQR);
                }

                $file = $request->file('kode_qr');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $pathQR = $file->storeAs('usaha/kode_qr', $filename, 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | 3. HANDLE FOTO USAHA (Multiple File)
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('foto_usaha')) {
                // Hapus file-file lama jika ada
                if (!empty($pathFotoUsaha) && is_array($pathFotoUsaha)) {
                    foreach ($pathFotoUsaha as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                $pathFotoUsaha = [];
                foreach ($request->file('foto_usaha') as $file) {
                    // Menggunakan timestamp + uniqid agar file multiple tidak bentrok namanya
                    $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $pathFotoUsaha[] = $file->storeAs('usaha/foto_usaha', $filename, 'public');
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 4. Simpan / Update Data Usaha
            |--------------------------------------------------------------------------
            */
            Usaha::updateOrCreate(
                [
                    'debitur_id' => $debiturId,
                    'urutan' => $request->urutan
                ],
                [
                    'nama_usaha' => $request->nama_usaha,
                    'google_maps' => $pathGoogleMaps,
                    'share_location' => $request->share_location,
                    'kode_qr' => $pathQR,
                    'foto_usaha' => !empty($pathFotoUsaha) ? json_encode($pathFotoUsaha) : ($usaha->foto_usaha ?? null),
                    'apakah_ada_usaha_lain' => $request->apakah_ada_usaha_lain,
                ]
            );

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | Navigasi (Batas Maksimal 10)
            |--------------------------------------------------------------------------
            */
            if (
                $request->urutan < 10 &&
                $request->apakah_ada_usaha_lain === 'YA'
            ) {
                $nextUrutan = $request->urutan + 1;

                return redirect()
                    ->route('z9-muk', ['urutan' => $nextUrutan])
                    ->with(
                        'success',
                        'Data usaha ' . $request->urutan . ' berhasil disimpan. Silakan isi data usaha berikutnya.'
                    );
            }

            return redirect()
                ->route('z10-muk')
                ->with(
                    'success',
                    'Data usaha berhasil disimpan.'
                );

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => 'Gagal menyimpan data usaha: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    // ==========================================
    // RUMAH
    // ==========================================

    public function createAlur10()
    {
        $debiturId = session('debitur_id');

        $data = null;

        if ($debiturId) {
            // Mengambil data berdasarkan debitur_id menggunakan model Rumah
            $data = Rumah::where('debitur_id', $debiturId)->first();
        }

        // Tentukan rute tombol kembali secara dinamis
        $backRoute = route('z9-muk');

        return view('z10-muk', compact('data', 'backRoute'));
    }

    public function storeAlur10(Request $request)
    {
        $debiturId = $request->debitur_id;
        $rumah = Rumah::where('debitur_id', $debiturId)->first();

        // Tentukan apakah file wajib diisi (jika belum ada data sama sekali di database)
        $fileValidation   = ($rumah && $rumah->google_maps) ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';
        $fileQrValidation = ($rumah && $rumah->kode_qr) ? 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240' : 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';
        
        // Validasi Foto Tempat Tinggal sebagai array (maksimal 50 file)
        $hasExistingFoto   = $rumah && !empty($rumah->foto_tempat_tinggal);
        $fileFotoValidation = $hasExistingFoto ? 'nullable|array|max:50' : 'required|array|max:50';
        $fileFotoItemValidation = 'file|mimes:pdf,jpg,jpeg,png,dwg|max:10240';

        // 1. Validasi input sesuai dengan form & kondisi file
        $request->validate([
            'debitur_id'            => 'required',
            'google_maps'           => $fileValidation,
            'share_location'        => 'required|url',
            'kode_qr'               => $fileQrValidation,
            'foto_tempat_tinggal'   => $fileFotoValidation,
            'foto_tempat_tinggal.*' => $fileFotoItemValidation, // Validasi untuk setiap file di dalam array
        ]);

        DB::beginTransaction();

        try {
            // Ambil path file lama jika data sudah ada
            $pathGoogleMaps  = $rumah ? $rumah->google_maps : null;
            $pathQR          = $rumah ? $rumah->kode_qr : null;
            
            // Untuk foto tempat tinggal (multiple), decode dari JSON jika sudah ada
            $pathFotoTinggal = ($rumah && $rumah->foto_tempat_tinggal) ? json_decode($rumah->foto_tempat_tinggal, true) : [];

            // ==========================================
            // 2. HANDLE GOOGLE MAPS
            // ==========================================
            if ($request->hasFile('google_maps')) {
                if ($pathGoogleMaps && Storage::disk('public')->exists($pathGoogleMaps)) {
                    Storage::disk('public')->delete($pathGoogleMaps);
                }

                $file = $request->file('google_maps');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $pathGoogleMaps = $file->storeAs('google_maps', $filename, 'public');
            }

            // ==========================================
            // 3. HANDLE KODE QR
            // ==========================================
            if ($request->hasFile('kode_qr')) {
                if ($pathQR && Storage::disk('public')->exists($pathQR)) {
                    Storage::disk('public')->delete($pathQR);
                }

                $file = $request->file('kode_qr');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $pathQR = $file->storeAs('kode_qr', $filename, 'public');
            }

            // ==========================================
            // 4. HANDLE FOTO TEMPAT TINGGAL (MULTIPLE)
            // ==========================================
            if ($request->hasFile('foto_tempat_tinggal')) {
                // Hapus file-file lama jika ada
                if (!empty($pathFotoTinggal) && is_array($pathFotoTinggal)) {
                    foreach ($pathFotoTinggal as $oldFile) {
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }
                }

                $pathFotoTinggal = [];
                foreach ($request->file('foto_tempat_tinggal') as $file) {
                    $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $pathFotoTinggal[] = $file->storeAs('foto_tempat_tinggal', $filename, 'public');
                }
            }

            // ==========================================
            // 5. SIMPAN / UPDATE DATA RUMAH
            // ==========================================
            Rumah::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'google_maps'         => $pathGoogleMaps,
                    'kode_qr'             => $pathQR,
                    'foto_tempat_tinggal' => !empty($pathFotoTinggal) ? json_encode($pathFotoTinggal) : ($rumah->foto_tempat_tinggal ?? null),
                    'share_location'      => $request->share_location,
                ]
            );

            DB::commit();

            return redirect()->route('z11-muk')
                ->with('success', 'Data berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Gagal: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // ==========================================
    // SPESIFIKASI
    // ==========================================

    public function createAlur11()
    {
        // PENGAMAN: Ambil ID debitur dari session
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();

            $debiturId = $firstDebitur ? $firstDebitur->id : 1;

            session(['debitur_id' => $debiturId]);
        }

        // Ambil data Spesifikasi berdasarkan debitur_id
        $data = \App\Models\Muk\Spesifikasi::where(
            'debitur_id',
            $debiturId
        )->first();

        // Ambil data debitur
        $debitur = \App\Models\Debitur::find($debiturId);

        // Tombol kembali ke halaman sebelumnya
        $backRoute = route('z10-muk');

        return view('z11-muk', compact(
            'data',
            'debitur',
            'backRoute'
        ));
    }


    public function storeAlur11(Request $request)
    {
        // Ambil ID debitur dari form
        // Jika tidak ada, ambil dari session
        $debiturId = $request->debitur_id ?? session('debitur_id');

        // Pastikan ID debitur tersedia
        if (!$debiturId) {
            return back()
                ->withErrors([
                    'error' => 'ID debitur tidak ditemukan.'
                ])
                ->withInput();
        }

        // Validasi input (diubah menjadi nullable agar opsional)
        $request->validate([
            'debitur_id' => 'required',

            // SPESIFIKASI JAMINAN KREDIT
            'sertifikat' => 'nullable|string',
            'nomor_nib' => 'nullable|string',
            'luas_tanah' => 'nullable|string',
            'luas_bangunan' => 'nullable|string',
            'lebar_depan' => 'nullable|string',
            'pbg' => 'nullable|string',
            'orientasi' => 'nullable|string',

            // JUMLAH RUANGAN
            'kamar_tidur' => 'nullable|string',
            'ruang_keluarga' => 'nullable|string',
            'ruang_tamu' => 'nullable|string',
            'kamar_pembantu' => 'nullable|string',
            'gudang' => 'nullable|string',
            'garasi' => 'nullable|string',
            'kamar_mandi' => 'nullable|string',
            'ruang_makan' => 'nullable|string',
            'dapur' => 'nullable|string',
            'pekarangan' => 'nullable|string',
            'carport' => 'nullable|string',
            'ruangan_lain' => 'nullable|string',
            'fasilitas_lain' => 'nullable|string',

            // KONDISI
            'kondisi_bangunan' => 'nullable|string',
            'kondisi_lantai' => 'nullable|string',
            'kondisi_plafon' => 'nullable|string',
            'bahan_atap' => 'nullable|string',
            'struktur_atap' => 'nullable|string',
            'listrik' => 'nullable|string',
            'air' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Simpan atau update data Spesifikasi
            \App\Models\Muk\Spesifikasi::updateOrCreate(
                [
                    'debitur_id' => $debiturId
                ],
                [
                    // SPESIFIKASI JAMINAN KREDIT
                    'sertifikat' => $request->sertifikat,
                    'nomor_nib' => $request->nomor_nib,
                    'luas_tanah' => $request->luas_tanah,
                    'luas_bangunan' => $request->luas_bangunan,
                    'lebar_depan' => $request->lebar_depan,
                    'pbg' => $request->pbg,
                    'orientasi' => $request->orientasi,

                    // JUMLAH RUANGAN
                    'kamar_tidur' => $request->kamar_tidur,
                    'ruang_keluarga' => $request->ruang_keluarga,
                    'ruang_tamu' => $request->ruang_tamu,
                    'kamar_pembantu' => $request->kamar_pembantu,
                    'gudang' => $request->gudang,
                    'garasi' => $request->garasi,
                    'kamar_mandi' => $request->kamar_mandi,
                    'ruang_makan' => $request->ruang_makan,
                    'dapur' => $request->dapur,
                    'pekarangan' => $request->pekarangan,
                    'carport' => $request->carport,
                    'ruangan_lain' => $request->ruangan_lain,
                    'fasilitas_lain' => $request->fasilitas_lain,

                    // KONDISI
                    'kondisi_bangunan' => $request->kondisi_bangunan,
                    'kondisi_lantai' => $request->kondisi_lantai,
                    'kondisi_plafon' => $request->kondisi_plafon,
                    'bahan_atap' => $request->bahan_atap,
                    'struktur_atap' => $request->struktur_atap,
                    'listrik' => $request->listrik,
                    'air' => $request->air,
                ]
            );

            // Simpan ID debitur ke session
            session([
                'debitur_id' => $debiturId
            ]);

            DB::commit();

            return redirect()
                ->route('z12-muk')
                ->with(
                    'success',
                    'Spesifikasi berhasil disimpan.'
                );

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => 'Gagal menyimpan Spesifikasi: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    // ==========================================
    // DENAH JAMINAN
    // ==========================================

    public function createAlur12()
    {
        $debiturId = session('debitur_id');

        $data = null;

        if ($debiturId) {
            // Mengambil data Denah berdasarkan debitur_id
            $data = Denah::where('debitur_id', $debiturId)->first();
        }

        // Tombol kembali ke Alur 11
        $backRoute = route('z11-muk');

        return view('z12-muk', compact('data', 'backRoute'));
    }

    public function storeAlur12(Request $request)
    {
        // ==========================================
        // 1. VALIDASI INPUT (Wajib Diisi)
        // ==========================================

        $request->validate([
            'debitur_id'    => 'required',
            'denah_jaminan' => 'required|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
        ], [
            'debitur_id.required'    => 'Data debitur wajib tersedia.',
            'denah_jaminan.required' => 'Denah Jaminan wajib diunggah.',
            'denah_jaminan.file'     => 'Denah Jaminan harus berupa file.',
            'denah_jaminan.mimes'    => 'Format file harus berupa PDF, JPG, JPEG, PNG, atau DWG.',
            'denah_jaminan.max'      => 'Ukuran file maksimal adalah 10 MB.',
        ]);

        DB::beginTransaction();

        try {
            // ==========================================
            // 2. AMBIL DATA LAMA
            // ==========================================

            $denah = Denah::where(
                'debitur_id',
                $request->debitur_id
            )->first();

            // Simpan path file lama
            $pathFile = $denah ? $denah->denah_jaminan : null;


            // ==========================================
            // 3. HANDLE UPLOAD FILE BARU
            // ==========================================

            if ($request->hasFile('denah_jaminan')) {

                // Hapus file lama jika ada
                if ($pathFile && Storage::disk('public')->exists($pathFile)) {
                    Storage::disk('public')->delete($pathFile);
                }

                $file = $request->file('denah_jaminan');

                // Bersihkan nama file
                $originalName = $file->getClientOriginalName();

                $cleanName = preg_replace(
                    '/\s+/',
                    '_',
                    $originalName
                );

                // Buat nama file unik
                $filename = time() . '_' . $cleanName;

                // Simpan ke storage
                $pathFile = $file->storeAs(
                    'denah_jaminan',
                    $filename,
                    'public'
                );
            }


            // ==========================================
            // 4. SIMPAN / UPDATE DATA DENAH
            // ==========================================

            Denah::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id
                ],
                [
                    'denah_jaminan' => $pathFile
                ]
            );


            // ==========================================
            // 5. COMMIT TRANSACTION
            // ==========================================

            DB::commit();


            // ==========================================
            // 6. REDIRECT
            // ==========================================

            return redirect()
                ->route('z13-selesai')
                ->with(
                    'success',
                    'Data Denah Jaminan berhasil disimpan.'
                );

        } catch (\Exception $e) {

            // Batalkan transaksi jika terjadi error
            DB::rollBack();

            return back()
                ->withErrors([
                    'error' => 'Gagal menyimpan Denah Jaminan: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    // ==========================================
    // Selesai
    // ==========================================
    public function createAlur13()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $debitur_id = $debiturId;

        // Mengambil URL halaman sebelumnya secara otomatis dari browser
        $backRoute = url()->previous();

        return view('z13-selesai', compact('debitur_id', 'backRoute'));
    }

    public function storeAlur13(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);
        
        $debitur = \App\Models\Debitur::find($debiturId);

        DB::beginTransaction();
        try {
            if ($debitur) {
                // $debitur->status = 'selesai';
                // $debitur->save();
            }

            DB::commit();
            
            // Hapus session formulir setelah sukses
            session()->forget(['debitur_id']);

            // Redirect ke route riwayat.detail2 dengan menyertakan parameter ID
            return redirect()->route('riwayat.detail2', ['id' => $debiturId])
                           ->with('success', 'Data berhasil disimpan ke Survei CA!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    
    // ==========================================
    // RIWAYAT
    // ==========================================

    public function createAlurRiwayat()
    {
        // Tab 1: Mengambil data Pra-Survei AO (Model utama)
        $dataDebitur = \App\Models\Debitur::latest()->get(); 

        // Tab 2: Mengambil data Survei CA (Model dari folder Survei)
        $dataSurveiCa = \App\Models\Muk\Debitur::latest()->get(); 

        // Kirim kedua variabel ke file blade riwayat
        return view('riwayat', compact('dataDebitur', 'dataSurveiCa'));
    }

    // 6. Detail Riwayat (Menampilkan detail berdasarkan ID)
    public function detailRiwayat($id)
    {
        // Mencari data debitur berdasarkan ID (Model utama)
        $item = \App\Models\Debitur::findOrFail($id);

        return view('detail-riwayat2', compact('item'));
    }

    // ==========================================
    // DETAIL RIWAYAT (Untuk Tampilan Web Normal)
    // ==========================================
    public function show($id)
    {
        $data = Debitur::with([
            'pengajuan_plafon_kredit',
            'informasi_usaha',
            'limac',      
        ])->findOrFail($id);

        $agunan = $data->pengajuan_plafon_kredit;

        return view('riwayat-detail2', compact('data'));
    }

    // ==========================================
    // METHOD CETAK (PRINT LANGSUNG)
    // ==========================================
    public function printPage2($id)
    {
        $data = Debitur::with([
            'agunans',            
            'agunan_kendaraan',
            'agunan_logam',
            'agunan_simpanan',
            'agunan_tanah',
            'yang_lain',
            'analisis_jaminan',
            'badanusaha',
            'berkas_lengkap',      
            'capacity',
            'capital',
            'dataslik',
            'data_tambahan',          
            'kondisi',
            'mutasi_rekening',
            'mutasi_rekening1',
            'pinjaman',
            'swot',
            'takeover'
        ])->findOrFail($id);

        return view('riwayat-print2', compact('data'));
    }            

    // ==========================================
    // METHOD EXPORT PDF
    // ==========================================
    public function exportPdf2($id)
    {
        $data = Debitur::with([
            'agunans',            
            'agunan_kendaraan',
            'agunan_logam',
            'agunan_simpanan',
            'agunan_tanah',
            'yang_lain',
            'analisis_jaminan',
            'badanusaha',
            'berkas_lengkap',      
            'capacity',
            'capital',
            'dataslik',
            'data_tambahan',          
            'kondisi',
            'mutasi_rekening',
            'mutasi_rekening1',
            'pinjaman',
            'swot',
            'takeover'
        ])->findOrFail($id);

        // Diubah ke riwayat-pdf2
        $view = view('riwayat-pdf2', compact('data'))->render();
        $pdf = Pdf::loadHtml($view);
        
        return $pdf->download('Survei ' . $data->nama . '.pdf');
    }

    // ==========================================
    // METHOD EXPORT WORD
    // ==========================================
    public function exportWord2($id)
    {
        $data = Debitur::with([
            'agunans',            
            'agunan_kendaraan',
            'agunan_logam',
            'agunan_simpanan',
            'agunan_tanah',
            'yang_lain',
            'analisis_jaminan',
            'badanusaha',
            'berkas_lengkap',      
            'capacity',
            'capital',
            'dataslik',
            'data_tambahan',          
            'kondisi',
            'mutasi_rekening',
            'mutasi_rekening1',
            'pinjaman',
            'swot',
            'takeover'
        ])->findOrFail($id);

        // --- UBAH GAMBAR MENJADI BASE64 AGAR MUNCUL DI WORD ---
        // Proses agunan_tanah (karena ini yang dipakai pada Blade agunan)
        $agunanTanahList = $data->agunan_tanah;
        if ($agunanTanahList) {
            if ($agunanTanahList instanceof \Illuminate\Database\Eloquent\Collection) {
                foreach ($agunanTanahList as $agunan) {
                    $this->convertDenahToBase64($agunan);
                }
            } else {
                $this->convertDenahToBase64($agunanTanahList);
            }
        }

        // Proses juga agunans untuk mengantisipasi bagian lain
        $agunanList = $data->agunans;
        if ($agunanList) {
            if ($agunanList instanceof \Illuminate\Database\Eloquent\Collection) {
                foreach ($agunanList as $agunan) {
                    $this->convertDenahToBase64($agunan);
                }
            } else {
                $this->convertDenahToBase64($agunanList);
            }
        }
        // ----------------------------------------------------

        // Diubah ke riwayat-word2
        $view = view('riwayat-word2', compact('data'))->render();

        return response($view)
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment; filename="Survei ' . $data->nama . '.doc"');
    }

    // Fungsi pembantu untuk konversi base64 agar kodingan tidak duplikat
    private function convertDenahToBase64($agunan)
    {
        if (!empty($agunan->denah) && $agunan->denah !== '-') {
            $pathFisik = storage_path('app/public/' . $agunan->denah);
            if (file_exists($pathFisik)) {
                $type = pathinfo($pathFisik, PATHINFO_EXTENSION);
                $type = strtolower($type);
                
                list($origWidth, $origHeight) = getimagesize($pathFisik);
                
                $maxSize = 450; // Ukuran kotak maksimal
                
                if ($origWidth > $origHeight) {
                    $newWidth = $maxSize;
                    $newHeight = round($origHeight * ($maxSize / $origWidth));
                } else {
                    $newHeight = $maxSize;
                    $newWidth = round($origWidth * ($maxSize / $origHeight));
                }

                $imageCreate = match($type) {
                    'jpg', 'jpeg' => imagecreatefromjpeg($pathFisik),
                    'png' => imagecreatefrompng($pathFisik),
                    'webp' => imagecreatefromwebp($pathFisik),
                    default => null
                };

                if ($imageCreate) {
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    
                    if ($type == 'png') {
                        imagealphablending($newImage, false);
                        imagesavealpha($newImage, true);
                    }

                    imagecopyresampled($newImage, $imageCreate, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

                    ob_start();
                    match($type) {
                        'jpg', 'jpeg' => imagejpeg($newImage, null, 100),
                        'png' => imagepng($newImage, null, 0),
                        'webp' => imagewebp($newImage, 100),
                        default => imagejpeg($newImage, null, 100)
                    };
                    $imgData = ob_get_clean();

                    imagedestroy($imageCreate);
                    imagedestroy($newImage);

                    $agunan->denah_base64 = 'data:image/' . ($type == 'jpg' ? 'jpeg' : $type) . ';base64,' . base64_encode($imgData);
                } else {
                    $agunan->denah_base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($pathFisik));
                }
            } else {
                $agunan->denah_base64 = null;
            }
        } else {
            $agunan->denah_base64 = null;
        }
    }

    // ==========================================
    // METHOD EXPORT EXCEL
    // ==========================================
    public function exportExcel2($id)
    {
        $data = Debitur::with([
            'agunans',            
            'agunan_kendaraan',
            'agunan_logam',
            'agunan_simpanan',
            'agunan_tanah',
            'yang_lain',
            'analisis_jaminan',
            'badanusaha',
            'berkas_lengkap',      
            'capacity',
            'capital',
            'dataslik',
            'data_tambahan',          
            'kondisi',
            'mutasi_rekening',
            'mutasi_rekening1',
            'pinjaman',
            'swot',
            'takeover'
        ])->findOrFail($id);

        // Diubah ke riwayat-excel2
        $view = view('riwayat-excel2', compact('data'))->render();

        return response($view)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="Survei ' . $data->nama . '.xls"');
    }
}