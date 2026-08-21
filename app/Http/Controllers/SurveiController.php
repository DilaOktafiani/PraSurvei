<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Survei\Debitur;
use App\Models\Survei\Agunan;
use App\Models\Survei\AgunanTanah;
use App\Models\Survei\AgunanKendaraan;
use App\Models\Survei\AgunanSimpanan;
use App\Models\Survei\AgunanLogam;
use App\Models\Survei\YangLain;
use App\Models\Survei\AnalisisJaminan;

class SurveiController extends Controller
{
    // =========================================================================
    // Z1-SURVEICA
    // =========================================================================

    public function createAlur1(Request $request)
    {
        $debitur = null;

        // Jika ada ID baru yang dikirim, update session
        if ($request->has('id')) {
            session(['debitur_id' => $request->id]);
        }

        // AMAN: Ambil data berdasarkan session, tapi pastikan ini khusus survei CA
        if (session()->has('debitur_id')) {
            $debitur = Debitur::find(session('debitur_id'));
        }

        return view('z1-surveica', compact('debitur'));
    }

    public function storeAlur1(Request $request)
    {
        $validated = $request->validate([
            'no_register'           => 'required|string|max:100',
            'nama'                  => 'required|string|max:255',
            'temuan_ca'             => 'required|string',
            'plafon'                => 'required|numeric',
            'tujuan_penggunaan'     => 'required|string',
            'jangka_waktu'          => 'required|string|max:100',
            'estimasi_kewajiban'    => 'required|numeric',
            'tipe_fasilitas'        => 'required|array',
            'tipe_fasilitas.*'      => 'required|string',
            'tipe_fasilitas_lain'   => 'nullable|string|max:255',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric'  => 'Kolom :attribute harus berupa angka.',
            'array'    => 'Format pilihan :attribute tidak valid.',
        ]);

        $data = $request->except(['tipe_fasilitas_lain']);
        $fasilitas = $request->tipe_fasilitas;

        if ($request->filled('tipe_fasilitas_lain')) {
            $key = array_search('Yang Lain', $fasilitas);
            
            if ($key !== false) {
                $fasilitas[$key] = $request->tipe_fasilitas_lain;
            } else {
                $fasilitas[] = $request->tipe_fasilitas_lain;
            }
        } else {
            $fasilitas = array_filter($fasilitas, function($value) {
                return $value !== 'Yang Lain';
            });
        }

        $data['tipe_fasilitas'] = array_values($fasilitas);

        // LOGIKA UPDATE / CREATE (Simpan ke database survei)
        if (session()->has('debitur_id')) {
            $debitur = Debitur::find(session('debitur_id'));
            if ($debitur) {
                $debitur->update($data);
            } else {
                $debitur = Debitur::create($data);
                session(['debitur_id' => $debitur->id]);
            }
        } else {
            $debitur = Debitur::create($data);
            session(['debitur_id' => $debitur->id]);
        }

        return redirect()->route('z2-surveica');
    }

    // =========================================================================
    // JAMINAN / COLLATERAL
    // =========================================================================

    public function createAlur2()
    {
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            // Ubah arah redirect jika sesi habis agar kembali ke survei CA, bukan ke pra-survei
            return redirect()->route('z1-surveica')->with('error', 'Sesi telah berakhir. Silakan isi dari awal.');
        }

        // PERBAIKAN: Gunakan model dari folder Survei\Agunan
        $data = Agunan::where('debitur_id', $debiturId)->first();

        if ($data) {
            session(['agunan_id' => $data->id]);
        }

        return view('z2-surveica', compact('debiturId', 'data'));
    }

    public function storeAlur2(Request $request)
    {
        $request->validate([
            'jenis_agunan' => 'required',
            'jenis_agunan_lainnya' => 'required_if:jenis_agunan,yang_lain|nullable|string|max:255',
        ]);

        $debiturId = session('debitur_id');
        $agunanId = session('agunan_id'); 

        // PERBAIKAN: Gunakan model dari folder Survei\Agunan
        $agunan = Agunan::updateOrCreate(
            [
                'debitur_id' => $debiturId
            ],
            [
                'jenis_agunan' => $request->jenis_agunan,
                'jenis_agunan_lainnya' => $request->jenis_agunan == 'yang_lain' ? $request->jenis_agunan_lainnya : null,
            ]
        );

        session(['agunan_id' => $agunan->id]);

        switch ($request->jenis_agunan) {
            case 'tanah_sawah':
            case 'tanah_pekarangan_kosong':
            case 'tanah_pekarangan_bangunan':
                return redirect()->route('z3-1tanah');
            
            case 'kendaraan_bermotor':
                return redirect()->route('z3-2kendaraan');
                
            case 'simpanan':
                return redirect()->route('z3-3simpanan');
                
            case 'logam_mulia':
                return redirect()->route('z3-4logam');
                
            case 'yang_lain':
                return redirect()->route('z4-jaminan');
                
            default:
                return back()->withErrors(['jenis_agunan' => 'Pilihan tidak valid']);
        }
    }

    // ==========================================
    // TANAH
    // ==========================================

    public function createAlur3_1(Request $request)
    {
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('z1-surveica')->with('error', 'Sesi telah berakhir. Silakan isi dari awal.');
        }

        $urutan = $request->query('urutan', 1);

        // Cari data agunan tanah berdasarkan debitur
        $agunan = Agunan::where('debitur_id', $debiturId)->where('jenis_agunan', 'tanah')->first();
        
        $tanah = null;
        if ($agunan) {
            // Ambil data berdasarkan urutan jaminan yang sedang dibuka
            $tanah = AgunanTanah::where('agunan_id', $agunan->id)->where('urutan', $urutan)->first();
        }

        return view('z3-1tanah', compact('debiturId', 'urutan', 'tanah')); 
    }

    public function storeAlur3_1(Request $request)
    {
        $request->validate([
            'debitur_id'         => 'required|exists:debiturs,id',
            'urutan'             => 'required|integer', 
            'kepemilikan'        => 'nullable|string|max:500',
            'alamat'             => 'nullable|string|max:500',
            'share_location'     => 'nullable|url',
            'luas_tanah'         => 'nullable|integer',
            'luas_bangunan'      => 'nullable|integer',
            'spesifikasi'        => 'nullable|string',
            'file_denah'         => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240', 
            'harga_tanah'        => 'nullable|integer',
            'harga_bangunan'     => 'nullable|integer',
            'info_harga1'        => 'nullable|string',
            'info_harga2'        => 'nullable|string',
            'info_harga3'        => 'nullable|string',
            'jaminan_lain_input' => 'nullable|string', 
        ]);

        DB::beginTransaction();
        try {
            $urutanJaminan = (int) $request->urutan;

            $agunan = Agunan::firstOrCreate([
                'debitur_id'   => $request->debitur_id,
                'jenis_agunan' => 'tanah'
            ]);

            // Pertahankan file denah lama jika tidak mengupload file baru
            $existingTanah = AgunanTanah::where('agunan_id', $agunan->id)->where('urutan', $urutanJaminan)->first();
            $pathDenah = $existingTanah ? $existingTanah->denah : null;

            if ($request->hasFile('file_denah')) {
                $pathDenah = $request->file('file_denah')->store('denah_agunan', 'public');
            }

            AgunanTanah::updateOrCreate(
                [
                    'agunan_id' => $agunan->id,
                    'urutan'    => $urutanJaminan
                ],
                [
                    'kepemilikan'    => $request->kepemilikan,
                    'alamat'         => $request->alamat,
                    'share_location' => $request->share_location,
                    'luas_tanah'     => $request->luas_tanah,
                    'luas_bangunan'  => $request->luas_bangunan,
                    'spesifikasi'    => $request->spesifikasi,
                    'denah'          => $pathDenah, 
                    'harga_tanah'    => $request->harga_tanah,
                    'harga_bangunan' => $request->harga_bangunan,
                    'info_harga1'    => $request->info_harga1,
                    'info_harga2'    => $request->info_harga2,
                    'info_harga3'    => $request->info_harga3,
                    'jaminan_lain'   => $request->jaminan_lain_input, 
                ]
            );

            DB::commit();

            // KONDISI JIKA SUDAH DI JAMINAN 3
            if ($urutanJaminan >= 3) {
                return redirect()->route('z3-2kendaraan')
                                ->with('success', 'Data jaminan tanah (1-3) selesai. Silakan lanjut ke data kendaraan.');
            }

            $pilihan = $request->jaminan_lain_input;

            if ($pilihan === 'ADA SELAIN HM/HGB') {
                return redirect()->route('z2-surveica')
                                ->with('success', 'Data agunan tanah berhasil disimpan.');
            } 
            elseif ($pilihan === 'ADA') {
                return redirect()->route('z3-1tanah', ['urutan' => $urutanJaminan + 1])
                                ->with('success', 'Data jaminan tanah ' . $urutanJaminan . ' berhasil disimpan. Silakan isi jaminan berikutnya.');
            } 
            else {
                return redirect()->route('z5infousaha')
                                ->with('success', 'Data agunan tanah selesai.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // KENDARAAN
    // ==========================================

    public function createAlur3_2($debitur_id = null)
    {
        $debitur_id = $debitur_id ?? session('debitur_id');
        $agunan = Agunan::where('debitur_id', $debitur_id)->where('jenis_agunan', 'kendaraan')->first();
        $data = $agunan ? $agunan->kendaraan : null; // Asumsi ada relasi 'kendaraan' di model Agunan

        return view('z3-2kendaraan', compact('debitur_id', 'data'));
    }

    public function storeAlur3_2(Request $request)
    {
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
        ]);

        // Ambil atau buat agunan
        $agunan = Agunan::updateOrCreate(
            ['debitur_id' => $request->debitur_id, 'jenis_agunan' => 'kendaraan'],
            ['updated_at' => now()]
        );

        // Update atau buat detail kendaraan
        AgunanKendaraan::updateOrCreate(
            ['agunan_id' => $agunan->id],
            [
                'spesifikasi' => $request->spesifikasi,
                'status_kepemilikan' => ($request->status_kepemilikan === 'yang_lain') ? $request->status_kepemilikan_lainnya : $request->status_kepemilikan,
                'harga_taksasi' => $request->harga_taksasi,
                'harga_taksasi_sumber_lain' => $request->harga_taksasi_sumber_lain,
            ]
        );

        return redirect()->route('z3-3simpanan')->with('success', 'Data tersimpan.');
    }

    // ==========================================
    // SIMPANAN
    // ==========================================

    public function createAlur3_3($debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL atau dari session
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Simpan juga ke session agar aman saat perpindahan halaman
        session(['debitur_id' => $debitur_id]);

        // Ambil data agunan simpanan yang sudah pernah disimpan sebelumnya (jika ada)
        $agunan = Agunan::where('debitur_id', $debitur_id)->where('jenis_agunan', 'simpanan')->first();
        $data = $agunan ? $agunan->simpanan : null; // Asumsi relasi di model Agunan bernama 'simpanan'

        return view('z3-3simpanan', compact('debitur_id', 'data'));
    }

    public function storeAlur3_3(Request $request)
    {
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'jenis_simpanan' => 'required|string',
            'jenis_simpanan_lainnya' => 'nullable|string',
            'nilai_simpanan' => 'required|numeric',
        ]);

        // Tangani jika user memilih "yang_lain"
        $jenisSimpananFinal = $request->jenis_simpanan;
        if ($request->jenis_simpanan === 'yang_lain') {
            $jenisSimpananFinal = $request->jenis_simpanan_lainnya ?? 'Lainnya';
        }

        DB::beginTransaction();
        try {
            // Gunakan updateOrCreate untuk agunan utama
            $agunan = Agunan::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id, 
                    'jenis_agunan' => 'simpanan'
                ],
                [
                    'updated_at' => now()
                ]
            );

            // Gunakan updateOrCreate untuk detail agunan simpanan
            AgunanSimpanan::updateOrCreate(
                [
                    'agunan_id' => $agunan->id
                ],
                [
                    'jenis_simpanan' => $jenisSimpananFinal,
                    'nilai_simpanan' => $request->nilai_simpanan,
                ]
            );

            DB::commit();
            return redirect()->route('z3-4logam')->with('success', 'Data agunan simpanan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // LOGAM MULIA (Step 3-4)
    // ==========================================

    public function createAlur3_4($debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL atau dari session
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Simpan juga ke session agar aman saat perpindahan halaman
        session(['debitur_id' => $debitur_id]);

        // Ambil data agunan logam mulia yang sudah pernah disimpan sebelumnya (jika ada)
        $agunan = Agunan::where('debitur_id', $debitur_id)->where('jenis_agunan', 'logam_mulia')->first();
        $data = $agunan ? $agunan->logamMulia : null; 

        // Daftar opsi standar logam mulia yang ada di dropdown HTML Anda
        $opsiStandar = ['Antam', 'UBS', 'Lotus Archi', 'Goldber']; // Sesuaikan dengan <option> di Blade Anda

        $isLainnya = false;
        $jenisLogamVal = '';
        $jenisLogamLainVal = '';

        if ($data) {
            if (in_array($data->jenis_logam, $opsiStandar)) {
                $jenisLogamVal = $data->jenis_logam;
            } else {
                // Jika tidak ada di opsi standar, berarti itu dulunya "yang_lain"
                $jenisLogamVal = 'yang_lain';
                $jenisLogamLainVal = $data->jenis_logam;
            }
        }

        return view('z3-4logam', compact('debitur_id', 'data', 'jenisLogamVal', 'jenisLogamLainVal'));
    }

    public function storeAlur3_4(Request $request)
    {
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'jenis_logam' => 'required|string',
            'jenis_logam_lain' => 'nullable|string',
            'berat' => 'required|numeric',
            'harga_beli_tahun_perolehan' => 'required|string',
            'harga_saatini' => 'required|numeric',
        ]);

        // Tangani jika user memilih "yang_lain"
        $jenisLogamFinal = $request->jenis_logam;
        if ($request->jenis_logam === 'yang_lain') {
            $jenisLogamFinal = $request->jenis_logam_lain ?? 'Lainnya';
        }

        DB::beginTransaction();
        try {
            // Gunakan updateOrCreate untuk agunan utama
            $agunan = Agunan::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id, 
                    'jenis_agunan' => 'logam_mulia'
                ],
                [
                    'updated_at' => now()
                ]
            );

            // Gunakan updateOrCreate untuk detail agunan logam mulia
            AgunanLogam::updateOrCreate(
                [
                    'agunan_id' => $agunan->id
                ],
                [
                    'jenis_logam' => $jenisLogamFinal,
                    'berat' => $request->berat,
                    'harga_beli_tahun_perolehan' => $request->harga_beli_tahun_perolehan,
                    'harga_saatini' => $request->harga_saatini,
                ]
            );

            DB::commit();
            return redirect()->route('z4-jaminan')->with('success', 'Data agunan logam mulia berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // JAMINAN LAIN / YANG LAIN
    // ==========================================

    public function createAlur4()
    {
        $debiturId = session('debitur_id'); // Sesuaikan dengan cara Anda menyimpan session
        $yangLain = null;

        if ($debiturId) {
            // Cari agunan dengan jenis 'lainnya' untuk debitur ini
            $agunan = Agunan::where('debitur_id', $debiturId)->where('jenis_agunan', 'lainnya')->first();
            if ($agunan) {
                $yangLain = YangLain::where('agunan_id', $agunan->id)->first();
            }
        }

        return view('z4-jaminan', compact('yangLain'));
    }

    public function storeAlur4(Request $request)
    {

        DB::beginTransaction();
        try {
            $agunan = Agunan::updateOrCreate(
                ['debitur_id' => $request->debitur_id, 'jenis_agunan' => 'lainnya']
            );

            YangLain::updateOrCreate(
                ['agunan_id' => $agunan->id],
                ['jaminan_lainnya_jikaada' => $request->jaminan_lainnya_jikaada]
            );

            DB::commit();
            return redirect()->route('z5-jaminan-analisis')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // ANALISIS SEMUA JAMINAN
    // ==========================================

    public function createAlur5()
    {
        $debiturId = session('debitur_id'); // atau ambil dari parameter request jika ada
        $yangLain = null;

        if ($debiturId) {
            // Langsung cari berdasarkan debitur_id karena tidak melalui tabel agunan
            $yangLain = AnalisisJaminan::where('debitur_id', $debiturId)->first();
        }

        return view('z5-jaminan-analisis', compact('yangLain')); // Sesuaikan nama view Anda
    }

    public function storeAlur5(Request $request)
    {
        // Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'analisis_jaminan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // Simpan atau perbarui data langsung berdasarkan debitur_id
            AnalisisJaminan::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                ['analisis_jaminan' => $request->analisis_jaminan]
            );

            DB::commit();
            // Arahkan ke alur / step berikutnya
            return redirect()->route('z5-jaminan-analisis')->with('success', 'Analisis jaminan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }
}