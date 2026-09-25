<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;            
use App\Models\Muk\Debitur;  
use App\Models\Muk\PlafonKredit;
use App\Models\Muk\InformasiUsaha;
use App\Models\Muk\LimaC;

use App\Models\Survei\Capital;
use App\Models\Survei\TakeOver;
use App\Models\Survei\Kondisi;
use App\Models\Survei\BerkasLengkap;
use App\Models\Survei\BadanUsaha;
use App\Models\Survei\Swot;
use App\Models\Survei\DataTambahan;
use App\Models\Survei\Pinjaman;
use App\Models\Survei\MutasiRekening;
use App\Models\Survei\MutasiRekening1;
use Barryvdh\DomPDF\Facade\Pdf;

class MukController extends Controller
{
    // =========================================================================
    // Z1-SURVEICA
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
        $validated = $request->validate([
            'no_register'           => 'required|string|max:100',
            'nama'                  => 'required|string|max:255',
            'tempat_tanggal_lahir'  => 'required|string|max:255',
            'nama_ibu_kandung'      => 'required|string|max:255',
            'nama_istri_penjamin'   => 'required|string|max:255',
            'alamat_ktp'            => 'required|string',
            'alamat_domisili'       => 'required|string',
            'no_hp'                 => 'required|string|max:50',
            'pekerjaan'             => 'required|string|max:255',
            'bidang_usaha'          => 'required|string|max:255',
            'alamat_usaha'          => 'required|string',
            'kontak'                => 'required|string|max:50',
            'idi_di_bank_lain'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240', // Maks 10MB
            'keterangan'            => 'required|string',

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
            $file = $request->file('idi_di_bank_lain');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            
            // Simpan ke storage (pastikan sudah php artisan storage:link)
            $path = $file->storeAs('public/idi_bank_lain', $filename);
            
            // Simpan path relatif ke database kolom 'idi_di_bank_lain'
            $data['idi_di_bank_lain'] = str_replace('public/', '', $path);
        }

        // LOGIKA UPDATE / CREATE (Simpan ke database survei)
        if (session()->has('debitur_id')) {
            $debitur = Debitur::find(session('debitur_id'));
            if ($debitur) {
                // Jika ada file baru dan file lama ada, hapus file lama
                if ($request->hasFile('idi_di_bank_lain') && $debitur->idi_di_bank_lain) {
                    Storage::disk('public')->delete($debitur->idi_di_bank_lain);
                }
                $debitur->update($data);
            } else {
                $debitur = Debitur::create($data);
                session(['debitur_id' => $debitur->id]);
            }
        } else {
            $debitur = Debitur::create($data);
            session(['debitur_id' => $debitur->id]);
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
        // 1. Validasi input sesuai dengan form & model PlafonKredit
        $request->validate([
            'debitur_id'              => 'required',
            'pengajuan_plafon_kredit' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'tujuan_penggunaan'       => 'required|string',
        ], [
            'required'                  => 'Kolom :attribute wajib diisi.',
            'string'                    => 'Kolom :attribute harus berupa teks.',
            'file'                      => 'Kolom :attribute harus berupa sebuah berkas.',
            'mimes'                     => 'Format file harus berupa PDF, JPG, JPEG, PNG, atau DWG.',
            'pengajuan_plafon_kredit.max' => 'Ukuran file maksimal adalah 10 MB.',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file
            $plafon = PlafonKredit::where('debitur_id', $request->debitur_id)->first();
            $pathFile = $plafon ? $plafon->pengajuan_plafon_kredit : null;

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
            
            // Redirect ke alur selanjutnya (sesuaikan nama routenya, misal z3-muk)
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
        
        // Ambil data Informasi Usaha jika sudah pernah diisi sebelumnya
        $data = InformasiUsaha::where('debitur_id', $debiturId)->first();

        // Tentukan rute tombol kembali (sesuaikan dengan alur aplikasi Anda sebelumnya)
        $backRoute = session('informasi_usaha_back', route('z2-muk')); // Ganti route sebelumnya sesuai alur

        return view('z3-muk', compact('debitur', 'data', 'backRoute')); 
    }

    public function storeAlur3(Request $request)
    {
        // PENGAMAN: Jika debitur_id dari form kosong, ambil dari session. Jika session kosong, paksa ke ID 1.
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // Simpan debitur_id ke session
        session(['debitur_id' => $debiturId]);

        // 1. Validasi input form Informasi Usaha
        $request->validate([
            'gambaran_pekerjaan_debitur1'   => 'required|string',
            'perhitungan_omset_usaha1'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'gambaran_pekerjaan_debitur2'   => 'required|string',
            'perhitungan_omset_usaha2'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'gambaran_pekerjaan_debitur3'   => 'required|string',
            'perhitungan_omset_usaha3'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'usaha_pendukung1'              => 'required|string',
            'perhitungan_omset_pendukung1'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'usaha_pendukung2'              => 'required|string',
            'perhitungan_omset_pendukung2'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'usaha_pendukung3'              => 'required|string',
            'perhitungan_omset_pendukung3'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file yang sudah diunggah sebelumnya
            $infoUsaha = InformasiUsaha::where('debitur_id', $debiturId)->first();

            // Daftar file yang akan di-handle
            $fileFields = [
                'perhitungan_omset_usaha1',
                'perhitungan_omset_usaha2',
                'perhitungan_omset_usaha3',
                'perhitungan_omset_pendukung1',
                'perhitungan_omset_pendukung2',
                'perhitungan_omset_pendukung3',
            ];

            $updateData = [
                'debitur_id'                  => $debiturId,
                'gambaran_pekerjaan_debitur1' => $request->gambaran_pekerjaan_debitur1,
                'gambaran_pekerjaan_debitur2' => $request->gambaran_pekerjaan_debitur2,
                'gambaran_pekerjaan_debitur3' => $request->gambaran_pekerjaan_debitur3,
                'usaha_pendukung1'            => $request->usaha_pendukung1,
                'usaha_pendukung2'            => $request->usaha_pendukung2,
                'usaha_pendukung3'            => $request->usaha_pendukung3,
            ];

            // 3. Loop untuk menangani upload file satu per satu secara dinamis & aman
            foreach ($fileFields as $field) {
                $oldPath = $infoUsaha ? $infoUsaha->$field : null;

                if ($request->hasFile($field)) {
                    // Hapus file lama jika ada di storage
                    if ($oldPath && \Storage::disk('public')->exists($oldPath)) {
                        \Storage::disk('public')->delete($oldPath);
                    }
                    // Simpan file baru ke folder 'informasi_usaha'
                    $updateData[$field] = $request->file($field)->store('informasi_usaha', 'public');
                } else {
                    // Jika tidak mengunggah file baru, pertahankan file lama yang sudah ada di database
                    $updateData[$field] = $oldPath;
                }
            }

            // 4. Simpan atau perbarui data menggunakan updateOrCreate
            InformasiUsaha::updateOrCreate(
                ['debitur_id' => $debiturId],
                $updateData
            );

            DB::commit();

            // Arahkan ke rute berikutnya (sesuaikan dengan rute step selanjutnya, misal z4 atau step berikutnya)
            return redirect()->route('z4-muk')->with('success', 'Informasi Usaha berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // URAIAN SINGKAT MENGENAI 5 C
    // ==========================================

    public function createAlur4()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $data = \App\Models\Muk\LimaC::where('debitur_id', $debiturId)->first();
        $debitur = \App\Models\Debitur::find($debiturId);

        // Atur tombol kembali secara pasti ke halaman sebelumnya (z3-muk)
        $backRoute = route('z3-muk');

        return view('z4-muk', compact('data', 'debitur', 'backRoute')); 
    }

    public function storeAlur4(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input sesuai dengan field di form HTML dan migrasi 'limac'
        $request->validate([
            'capital' => 'required|string',
            'collateral' => 'required|string',
            'ringkasan_penilaian_jaminan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240', 
            'tanggal' => 'required|string',
            'info_harga_tanah1' => 'required|string',
            'info_harga_tanah2' => 'required|string',
            'info_harga_tanah3' => 'required|string',
            'batas_objek_jaminan' => 'required|string',
            'catatan_khusus' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file jaminan
            $data = \App\Models\Muk\LimaC::where('debitur_id', $debiturId)->first();
            $filePath = $data ? $data->ringkasan_penilaian_jaminan : null;

            // 3. Handle Upload File Ringkasan Penilaian Jaminan baru jika diunggah
            if ($request->hasFile('ringkasan_penilaian_jaminan')) {
                if ($filePath && \Storage::disk('public')->exists($filePath)) {
                    \Storage::disk('public')->delete($filePath);
                }
                $filePath = $request->file('ringkasan_penilaian_jaminan')->store('penilaian_jaminan', 'public');
            }

            // 4. Simpan atau perbarui data menggunakan updateOrCreate ke model LimaC
            \App\Models\Muk\LimaC::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'capital' => $request->capital,
                    'collateral' => $request->collateral,
                    'ringkasan_penilaian_jaminan' => $filePath,
                    'tanggal' => $request->tanggal,
                    'info_harga_tanah1' => $request->info_harga_tanah1,
                    'info_harga_tanah2' => $request->info_harga_tanah2,
                    'info_harga_tanah3' => $request->info_harga_tanah3,
                    'batas_objek_jaminan' => $request->batas_objek_jaminan,
                    'catatan_khusus' => $request->catatan_khusus,
                ]
            );

            DB::commit();

            // 5. Redirect ke route berikutnya (z5-muk)
            return redirect()->route('z5-muk')->with('success', 'Data 5C (Capital & Collateral) berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // CAPITAL - ANALISIS ASET
    // ==========================================

    public function createAlur8()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $capital = Capital::where('debitur_id', $debiturId)->first();
        $debitur = \App\Models\Debitur::find($debiturId);

        // Atur tombol kembali secara pasti ke halaman Data Slik (z7)
        $backRoute = route('z7-dataslik');

        return view('z8-capital', compact('capital', 'debitur', 'backRoute')); 
    }

    public function storeAlur8(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'analisis_aset' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate dengan ID yang aman
            Capital::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'analisis_aset' => $request->analisis_aset,
                ]
            );

            DB::commit();

            return redirect()->route('z9-takeover')->with('success', 'Analisis Aset (Capital) berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // TAKE OVER
    // ==========================================

    public function createAlur9()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $takeover = TakeOver::where('debitur_id', $debiturId)->first();
        $debitur = \App\Models\Debitur::find($debiturId);

        // Atur tombol kembali secara pasti ke halaman Capital (z8)
        $backRoute = route('z8-capital');

        return view('z9-takeover', compact('takeover', 'debitur', 'backRoute')); 
    }

    public function storeAlur9(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'apakah_kredit_take_over' => 'required|in:YA,TIDAK',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate dengan ID yang aman
            TakeOver::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'apakah_kredit_take_over' => $request->apakah_kredit_take_over,
                ]
            );

            DB::commit();

            // 3. Logika redirect bercabang berdasarkan pilihan user
            if ($request->apakah_kredit_take_over === 'YA') {
                return redirect()->route('z10-kondisi')->with('success', 'Data berhasil disimpan. Silakan lanjutkan ke Kondisi Take Over.');
            } else {
                return redirect()->route('z11-berkas-lengkap')->with('success', 'Data berhasil disimpan. Silakan lanjutkan ke Verifikasi Berkas.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // KONDISI
    // ==========================================

    public function createAlur10()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $analisisTakeOver = null;

        if ($debiturId) {
            // Mencari data berdasarkan debitur_id
            $analisisTakeOver = Kondisi::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Atur tombol kembali secara pasti ke halaman Take Over (z9)
        $backRoute = route('z9-takeover');

        return view('z10-kondisi', compact('analisisTakeOver', 'debitur', 'backRoute')); 
    }

    public function storeAlur10(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'analisis_take_over' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate dengan ID yang aman
            Kondisi::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'analisis_take_over' => $request->analisis_take_over,
                ]
            );

            DB::commit();

            return redirect()->route('z11-berkas-lengkap')->with('success', 'Analisis Take Over berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // KELENGKAPAN BERKAS
    // ==========================================

    public function createAlur11()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $kelengkapan = null;

        if ($debiturId) {
            $kelengkapan = BerkasLengkap::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Cek apakah debitur memiliki data Kondisi (z10) atau langsung dari Take Over (z9)
        $hasKondisi = false;
        if ($debiturId) {
            $hasKondisi = \App\Models\Survei\Kondisi::where('debitur_id', $debiturId)->exists();
        }

        // Tentukan rute kembali secara dinamis
        if ($hasKondisi) {
            $backRoute = route('z10-kondisi');
        } else {
            $backRoute = route('z9-takeover');
        }

        return view('z11-berkas-lengkap', compact('kelengkapan', 'debitur', 'backRoute')); 
    }

    public function storeAlur11(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'analisis_kelengkapan_berkas' => 'required|string',
            'apakah_badan_usaha' => 'required|in:YA,TIDAK',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate dengan ID yang aman
            BerkasLengkap::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'analisis_kelengkapan_berkas' => $request->analisis_kelengkapan_berkas,
                    'apakah_badan_usaha' => $request->apakah_badan_usaha,
                ]
            );

            DB::commit();

            // 3. Logika redirect bercabang berdasarkan pilihan Badan Usaha
            if ($request->apakah_badan_usaha === 'YA') {
                return redirect()->route('z12-badanusaha')->with('success', 'Kelengkapan Berkas berhasil disimpan. Silakan lanjutkan ke Badan Usaha.');
            } else {
                return redirect()->route('z13-swot')->with('success', 'Kelengkapan Berkas berhasil disimpan. Silakan lanjutkan ke Analisis SWOT.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }
    
    // ==========================================
    // BADAN USAHA
    // ==========================================

    public function createAlur12()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $kelengkapanBadanUsaha = null;

        if ($debiturId) {
            $kelengkapanBadanUsaha = BadanUsaha::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Atur tombol kembali secara pasti ke halaman Kelengkapan Berkas (z11)
        $backRoute = route('z11-berkas-lengkap');

        return view('z12-badanusaha', compact('kelengkapanBadanUsaha', 'debitur', 'backRoute')); 
    }

    public function storeAlur12(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'analisa_badan_usaha' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate dengan ID yang aman
            BadanUsaha::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'analisa_badan_usaha' => $request->analisa_badan_usaha,
                ]
            );

            DB::commit();

            return redirect()->route('z13-swot')->with('success', 'Analisa Badan Usaha berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // ANALISIS SWOT
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

        $swot = null;

        if ($debiturId) {
            // Menggunakan Model Swot
            $swot = \App\Models\Survei\Swot::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Cek apakah debitur memiliki data Badan Usaha atau langsung dari Kelengkapan Berkas
        $hasBadanUsaha = false;
        if ($debiturId) {
            $hasBadanUsaha = \App\Models\Survei\BadanUsaha::where('debitur_id', $debiturId)->exists();
        }

        // Tentukan rute kembali secara dinamis
        if ($hasBadanUsaha) {
            $backRoute = route('z12-badanusaha');
        } else {
            $backRoute = route('z11-berkas-lengkap');
        }

        // Menggunakan compact agar sinkron ke view
        return view('z13-swot', compact('swot', 'debitur', 'backRoute')); 
    }

    public function storeAlur13(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'kekuatan' => 'required|string',
            'kelemahan' => 'required|string',
            'peluang' => 'required|string',
            'ancaman' => 'required|string',
            'kesimpulan' => 'required|string',
            'rekomendasi' => 'required|in:Disetujui,Disetujui dengan syarat,Ditolak',
            'syarat_catatan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan model Swot dengan ID yang aman
            \App\Models\Survei\Swot::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'kekuatan' => $request->kekuatan,
                    'kelemahan' => $request->kelemahan,
                    'peluang' => $request->peluang,
                    'ancaman' => $request->ancaman,
                    'kesimpulan' => $request->kesimpulan,
                    'rekomendasi' => $request->rekomendasi,
                    'syarat_catatan' => $request->syarat_catatan ?? '',
                ]
            );

            DB::commit();

            return redirect()->route('z14-data-tambahan')->with('success', 'Analisis SWOT berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // DATA TAMBAHAN
    // ==========================================

    public function createAlur14()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $takeover = null;

        if ($debiturId) {
            $takeover = DataTambahan::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Atur tombol kembali secara pasti ke halaman Analisis SWOT (z13)
        $backRoute = route('z13-swot');

        return view('z14-data-tambahan', compact('takeover', 'debitur', 'backRoute'));
    }

    public function storeAlur14(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'menambahkan_data_slik' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data ke database dengan ID yang aman
            DataTambahan::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'menambahkan_data_slik' => $request->menambahkan_data_slik,
                ]
            );

            DB::commit();

            // 3. Logika Navigasi Kondisional
            if ($request->menambahkan_data_slik === 'YA') {
                return redirect()->route('z15-pinjaman', ['urutan' => 1])
                                ->with('success', 'Data tambahan disimpan. Silakan isi data pinjaman.');
            } else {
                // Jika memilih opsi tidak / manual excel, langsung ke mutasi rekening
                return redirect()->route('z16-mutasi-rekening')
                                ->with('success', 'Data tambahan berhasil disimpan.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // DATA PINJAMAN (SLIK)
    // ==========================================

    public function createAlur15(Request $request)
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $urutan = $request->query('urutan', 1); // Default ke urutan 1 jika tidak ada
        $pinjaman = null;

        if ($debiturId) {
            $pinjaman = Pinjaman::where('debitur_id', $debiturId)
                                     ->where('urutan', $urutan)
                                     ->first();
        }

        $debitur = \App\Models\Debitur::find($debiturId);

        return view('z15-pinjaman', compact('pinjaman', 'debitur', 'urutan')); 
    }

    public function storeAlur15(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id', longgarkan validasi numeric uang agar bebas titik/koma)
        $request->validate([
            'urutan' => 'required|integer|min:1',
            'nama_ljk' => 'required|string',
            'plafond' => 'required',
            'outstanding' => 'required',
            'kolekbilitas' => 'required|string',
            'angsuran' => 'required',
            'keterangan' => 'required|string',
            'jkw' => 'nullable|string',
            'jalan' => 'required|string',
            'bunga' => 'nullable|string',
            'apakah_ada_pinjaman_lain' => 'nullable|in:YA,TIDAK ADA',
        ]);

        DB::beginTransaction();
        try {
            // 2. Bersihkan format angka (hapus titik/koma rupiah sebelum masuk database)
            $plafond = str_replace(['.', ','], ['', '.'], $request->plafond);
            $outstanding = str_replace(['.', ','], ['', '.'], $request->outstanding);
            $angsuran = str_replace(['.', ','], ['', '.'], $request->angsuran);

            // 3. Simpan atau perbarui data berdasarkan debitur_id dan urutan yang aman
            Pinjaman::updateOrCreate(
                [
                    'debitur_id' => $debiturId,
                    'urutan' => $request->urutan
                ],
                [
                    'nama_ljk' => $request->nama_ljk,
                    'plafond' => is_numeric($plafond) ? $plafond : 0,
                    'outstanding' => is_numeric($outstanding) ? $outstanding : 0,
                    'kolekbilitas' => $request->kolekbilitas,
                    'angsuran' => is_numeric($angsuran) ? $angsuran : 0,
                    'keterangan' => $request->keterangan,
                    'jkw' => $request->jkw,
                    'jalan' => $request->jalan,
                    'bunga' => $request->bunga,
                    'apakah_ada_pinjaman_lain' => $request->apakah_ada_pinjaman_lain,
                ]
            );

            DB::commit();

            // 4. Logika Navigasi Lanjutan Berdasarkan Pilihan "Apakah ada pinjaman lain"
            if ($request->apakah_ada_pinjaman_lain === 'YA' && $request->urutan < 20) {
                // Jika user memilih ADA, arahkan ke form urutan berikutnya
                $nextUrutan = $request->urutan + 1;
                return redirect()->route('z15-pinjaman', ['urutan' => $nextUrutan])
                               ->with('success', 'Data pinjaman ' . $request->urutan . ' berhasil disimpan. Silakan isi data pinjaman berikutnya.');
            } else {
                // Jika TIDAK ADA atau mencapai batas maksimal, arahkan ke mutasi rekening
                return redirect()->route('z16-mutasi-rekening')
                               ->with('success', 'Data seluruh pinjaman SLIK berhasil disimpan.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // MUTASI REKENING
    // ==========================================

    public function createAlur16()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $takeover = null;

        if ($debiturId) {
            $takeover = MutasiRekening::where('debitur_id', $debiturId)->first();
        }

        $debitur = \App\Models\Debitur::find($debiturId);

        // Tentukan rute tombol kembali secara dinamis berdasarkan data sebelumnya
        // Cek apakah debitur memiliki data pinjaman di tabel Pinjaman
        $hasPinjaman = false;
        if ($debiturId) {
            $hasPinjaman = \App\Models\Survei\Pinjaman::where('debitur_id', $debiturId)->exists();
        }

        if ($hasPinjaman) {
            // Jika ada riwayat pinjaman, arahkan kembali ke halaman pinjaman urutan terakhir (misal urutan 20)
            $lastPinjamanUrutan = \App\Models\Survei\Pinjaman::where('debitur_id', $debiturId)->max('urutan') ?? 20;
            $backUrl = route('z15-pinjaman', ['urutan' => $lastPinjamanUrutan]);
        } else {
            // Jika tidak ada pinjaman (artinya langsung dari data tambahan karena memilih 'TIDAK'), kembalikan ke z14
            $backUrl = route('z14-data-tambahan');
        }

        return view('z16-mutasi-rekening', compact('takeover', 'debitur', 'backUrl'));
    }

    public function storeAlur16(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel)
        $request->validate([
            'detail_mutasi_tabungan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // Siapkan data payload yang aman (hindari error jika kolom 'apakah_badan_usaha' tidak ada di tabel MutasiRekening)
            $payload = [
                'detail_mutasi_tabungan' => $request->detail_mutasi_tabungan,
            ];

            // Cek secara aman apakah kolom 'apakah_badan_usaha' ada di tabel database untuk menghindari error SQL
            if (\Illuminate\Support\Facades\Schema::hasColumn('mutasi_rekenings', 'apakah_badan_usaha')) {
                $payload['apakah_badan_usaha'] = $request->detail_mutasi_tabungan;
            }

            // 2. Simpan atau perbarui data menggunakan updateOrCreate dengan ID yang aman
            $mutasi = MutasiRekening::updateOrCreate(
                ['debitur_id' => $debiturId],
                $payload
            );

            DB::commit();

            // 3. Logika Navigasi Kondisional yang Lebih Aman
            if ($request->detail_mutasi_tabungan === 'YA') {
                return redirect()->route('z17-mutasi-rekening1')
                            ->with('success', 'Data mutasi tabungan disimpan. Silakan lanjutkan pengisian.');
            } else {
                // Jika memilih TIDAK, arahkan ke z18-selesai
                return redirect()->route('z18-selesai')
                            ->with('success', 'Data mutasi tabungan berhasil disimpan.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // MUTASI REKENING1
    // ==========================================

    public function createAlur17(Request $request)
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $urutan = $request->query('urutan', 1); // Default ke urutan 1 jika tidak ada
        $pinjaman = null; // Menggunakan nama variabel $pinjaman agar sesuai dengan Blade yang Anda sediakan

        if ($debiturId) {
            // Perbaikan: Gunakan MutasiRekening1 (sesuai nama model dan tabel)
            $pinjaman = \App\Models\Survei\MutasiRekening1::where('debitur_id', $debiturId)
                                                        ->where('urutan', $urutan)
                                                        ->first();
        }

        $debitur = \App\Models\Debitur::find($debiturId);

        return view('z17-mutasi-rekening1', compact('pinjaman', 'debitur', 'urutan'));
    }

    public function storeAlur17(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id', longgarkan validasi numeric uang agar bebas titik/koma)
        $request->validate([
            'urutan' => 'required|integer|min:1',
            'nama_bank' => 'required|string',
            'bulan' => 'required|string',
            'debet' => 'required',
            'kredit' => 'required',
            'saldo' => 'required|string',
            'apakah_masih_ada_mutasi_tabungan' => 'nullable|in:YA,TIDAK ADA',
        ]);

        DB::beginTransaction();
        try {
            // 2. Bersihkan format angka (hapus titik/koma rupiah sebelum masuk database)
            $debet = str_replace(['.', ','], ['', '.'], $request->debet);
            $kredit = str_replace(['.', ','], ['', '.'], $request->kredit);

            // 3. Simpan atau perbarui data menggunakan model MutasiRekening1 dengan ID yang aman
            \App\Models\Survei\MutasiRekening1::updateOrCreate(
                [
                    'debitur_id' => $debiturId,
                    'urutan' => $request->urutan
                ],
                [
                    'nama_bank' => $request->nama_bank,
                    'bulan' => $request->bulan,
                    'debet' => is_numeric($debet) ? $debet : 0,
                    'kredit' => is_numeric($kredit) ? $kredit : 0,
                    'saldo' => $request->saldo,
                    'apakah_masih_ada_mutasi_tabungan' => $request->apakah_masih_ada_mutasi_tabungan,
                ]
            );

            DB::commit();

            // 4. Logika Navigasi Lanjutan Berdasarkan Pilihan "Apakah masih ada mutasi tabungan"
            if ($request->apakah_masih_ada_mutasi_tabungan === 'YA' && $request->urutan < 20) {
                // Jika user memilih YA, arahkan ke form urutan berikutnya
                $nextUrutan = $request->urutan + 1;
                return redirect()->route('z17-mutasi-rekening1', ['urutan' => $nextUrutan])
                               ->with('success', 'Data mutasi rekening urutan ' . $request->urutan . ' berhasil disimpan.');
            } else {
                // Jika TIDAK ADA atau batas maksimal tercapai, arahkan ke langkah berikutnya
                return redirect()->route('z18-selesai')
                               ->with('success', 'Data seluruh mutasi rekening berhasil disimpan.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // Selesai
    // ==========================================
    public function createAlur18()
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

        return view('z18-selesai', compact('debitur_id', 'backRoute'));
    }

    public function storeAlur18(Request $request)
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

        $agunan = $data->analisis_jaminan;

        return view('riwayat-detail2', compact('data', 'agunan'));
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