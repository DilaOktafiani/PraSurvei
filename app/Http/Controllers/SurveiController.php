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
use App\Models\Survei\Capacity;
use App\Models\Survei\DataSlik;
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

class SurveiController extends Controller
{
    // =========================================================================
    // Z1-SURVEICA
    // =========================================================================

    public function createAlur1(Request $request)
    {
        $debitur = null;

        // KASUS A: Jika diakses dari Dashboard (biasanya URL-nya bersih tanpa parameter ?id=...)
        // Kita wajib membersihkan session 'debitur_id' agar form kembali KOSONG.
        if (!$request->has('id') && !$request->isMethod('post')) {
            session()->forget('debitur_id');
        }

        // KASUS B: Jika ada parameter ID yang dikirim (artinya dari tombol EDIT di riwayat)
        if ($request->has('id')) {
            session(['debitur_id' => $request->id]);
        }

        // AMAN: Ambil data jika session 'debitur_id' tersedia
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

        // Tentukan rute tombol kembali ke Halaman 1 Survei
        $backRoute = route('z1-surveica');

        return view('z2-surveica', compact('debiturId', 'data', 'backRoute'));
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

        $urutan = (int) $request->query('urutan', 1);

        // Cari data agunan tanah berdasarkan debitur
        $agunan = Agunan::where('debitur_id', $debiturId)->where('jenis_agunan', 'tanah')->first();
        
        $tanah = null;
        if ($agunan) {
            // Ambil data berdasarkan urutan jaminan yang sedang dibuka
            $tanah = AgunanTanah::where('agunan_id', $agunan->id)->where('urutan', $urutan)->first();
        }

        // Tentukan rute tombol kembali secara dinamis berdasarkan urutan tanah
        if ($urutan > 1) {
            // Jika berada di urutan 2 atau 3, tombol kembali mengarah ke urutan sebelumnya
            $backRoute = route('z3-1tanah', ['urutan' => $urutan - 1]);
        } else {
            // Jika berada di urutan 1, tombol kembali mengarah ke Halaman 2 Survei
            $backRoute = route('z2-surveica');
        }

        return view('z3-1tanah', compact('debiturId', 'urutan', 'tanah', 'backRoute')); 
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
                return redirect()->route('z6-capacity')
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

        // Tentukan rute tombol kembali secara dinamis
        $previousUrl = url()->previous();

        if (str_contains($previousUrl, 'z3-1tanah')) {
            // Jika pengguna datang dari halaman Tanah (misal urutan 3 atau lainnya)
            // Kita bisa arahkan kembali ke tanah urutan 3 atau mempertahankan URL sebelumnya
            $backRoute = $previousUrl; 
        } elseif (str_contains($previousUrl, 'z2-surveica')) {
            // Jika pengguna datang dari Halaman 2 Survei
            $backRoute = route('z2-surveica');
        } else {
            // Fallback default jika diakses langsung (misal diarahkan dari tanah urutan >= 3)
            $backRoute = route('z3-1tanah', ['urutan' => 3]); 
        }

        return view('z3-2kendaraan', compact('debitur_id', 'data', 'backRoute'));
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
        // Ambil debitur_id dari parameter URL atau dari session (tanpa redirect paksa)
        $debitur_id = $debitur_id ?? session('debitur_id');

        if ($debitur_id) {
            session(['debitur_id' => $debitur_id]);
        }

        $agunan = null;
        $data = null;

        if ($debitur_id) {
            $agunan = Agunan::where('debitur_id', $debitur_id)->where('jenis_agunan', 'simpanan')->first();
            $data = $agunan ? $agunan->simpanan : null;
        }

        // Tentukan rute tombol kembali secara dinamis
        $previousUrl = url()->previous();

        if (str_contains($previousUrl, 'z3-2kendaraan')) {
            // Jika pengguna datang dari halaman Kendaraan
            $backRoute = route('z3-2kendaraan');
        } elseif (str_contains($previousUrl, 'z2-surveica')) {
            // Jika pengguna datang dari Halaman 2 Survei
            $backRoute = route('z2-surveica');
        } else {
            // Fallback default jika diakses langsung atau dari rute lain
            $backRoute = route('z2-surveica'); 
        }

        return view('z3-3simpanan', compact('debitur_id', 'data', 'backRoute'));
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

        if ($debitur_id) {
            session(['debitur_id' => $debitur_id]);
        }

        $agunan = null;
        $data = null;
        $opsiStandar = ['Antam', 'UBS', 'Lotus Archi', 'Goldber'];
        $jenisLogamVal = '';
        $jenisLogamLainVal = '';

        if ($debitur_id) {
            // Ambil data agunan logam mulia yang sudah pernah disimpan sebelumnya (jika ada)
            $agunan = Agunan::where('debitur_id', $debitur_id)->where('jenis_agunan', 'logam_mulia')->first();
            $data = $agunan ? $agunan->logamMulia : null; 

            if ($data) {
                if (in_array($data->jenis_logam, $opsiStandar)) {
                    $jenisLogamVal = $data->jenis_logam;
                } else {
                    // Jika tidak ada di opsi standar, berarti itu dulunya "yang_lain"
                    $jenisLogamVal = 'yang_lain';
                    $jenisLogamLainVal = $data->jenis_logam;
                }
            }
        }

        // Tentukan rute tombol kembali secara dinamis
        $previousUrl = url()->previous();

        if (str_contains($previousUrl, 'z3-3simpanan')) {
            // Jika pengguna datang dari halaman Simpanan
            $backRoute = route('z3-3simpanan');
        } elseif (str_contains($previousUrl, 'z2-surveica')) {
            // Jika pengguna datang dari Halaman 2 Survei
            $backRoute = route('z2-surveica');
        } else {
            // Fallback default jika diakses langsung atau dari rute lain
            $backRoute = route('z2-surveica'); 
        }

        return view('z3-4logam', compact('debitur_id', 'data', 'jenisLogamVal', 'jenisLogamLainVal', 'backRoute'));
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
    // JAMINAN LAIN / YANG LAIN (z4-jaminan)
    // ==========================================

    public function createAlur4()
    {
        $debiturId = session('debitur_id');
        $yangLain = null;

        if ($debiturId) {
            // Cari agunan dengan jenis 'yang_lain' (sesuaikan dengan nilai storeAlur2 yaitu 'yang_lain')
            $agunan = Agunan::where('debitur_id', $debiturId)
                            ->whereIn('jenis_agunan', ['lainnya', 'yang_lain'])
                            ->first();
            if ($agunan) {
                $yangLain = YangLain::where('agunan_id', $agunan->id)->first();
            }
        }

        // Tentukan rute tombol kembali secara dinamis berdasarkan halaman sebelumnya
        $previousUrl = url()->previous();

        if (str_contains($previousUrl, 'z3-4logam')) {
            // Jika pengguna datang dari halaman Logam Mulia
            $backRoute = route('z3-4logam');
        } else {
            // Default kembali ke Halaman 2 Survei (tempat pemilihan jenis agunan)
            $backRoute = route('z2-surveica');
        }

        return view('z4-jaminan', compact('yangLain', 'backRoute'));
    }

    public function storeAlur4(Request $request)
    {
        $request->validate([
            'jaminan_lainnya_jikaada' => 'required|string',
        ]);

        $debiturId = session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('z1-surveica')->with('error', 'Sesi telah berakhir. Silakan isi dari awal.');
        }

        DB::beginTransaction();
        try {
            // Pastikan konsisten menggunakan 'yang_lain' sesuai switch case di storeAlur2
            $agunan = Agunan::updateOrCreate(
                ['debitur_id' => $debiturId],
                ['jenis_agunan' => 'yang_lain']
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
        $debiturId = session('debitur_id'); 
        $data = null; 

        if ($debiturId) {
            $data = AnalisisJaminan::where('debitur_id', $debiturId)->first();
        }

        // Tentukan rute tombol kembali secara dinamis ke halaman Analisis Jaminan Lainnya (z4-jaminan)
        $backRoute = route('z4-jaminan');

        return view('z5-jaminan-analisis', compact('data', 'backRoute')); 
    }

    public function storeAlur5(Request $request)
    {
        // Validasi input (ubah 'exists:debiturs,id' cukup menjadi 'required')
        $request->validate([
            'debitur_id' => 'required', // <- Hapus bagian exists:debiturs,id sementara
            'analisis_jaminan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            AnalisisJaminan::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                ['analisis_jaminan' => $request->analisis_jaminan]
            );

            DB::commit();
            return redirect()->route('z6-capacity')->with('success', 'Analisis jaminan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // ANALISIS CAPACITY
    // ==========================================

    public function createAlur6()
    {
        $debiturId = session('debitur_id'); 
        $capacity = null;

        if ($debiturId) {
            $capacity = Capacity::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;
        $infoUsaha = null;
        $tanah = null;

        // LOGIKA PENENTUAN TOMBOL KEMBALI YANG AKURAT:
        $hasAnalisisJaminan = false;
        $lastTanahUrutan = 1;

        if ($debiturId) {
            $hasAnalisisJaminan = AnalisisJaminan::where('debitur_id', $debiturId)->exists();

            if (!$hasAnalisisJaminan) {
                $agunanTanah = Agunan::where('debitur_id', $debiturId)->where('jenis_agunan', 'tanah')->first();
                if ($agunanTanah) {
                    $maxUrutan = AgunanTanah::where('agunan_id', $agunanTanah->id)->max('urutan');
                    if ($maxUrutan) {
                        $lastTanahUrutan = $maxUrutan;
                    }
                }
            }
        }

        if ($hasAnalisisJaminan) {
            $backRoute = route('z5-jaminan-analisis');
        } else {
            $backRoute = route('z3-1tanah', ['urutan' => $lastTanahUrutan]);
        }

        return view('z6-capacity', compact('capacity', 'debitur', 'infoUsaha', 'tanah', 'backRoute')); 
    }

    public function storeAlur6(Request $request)
    {
        // PENGAMAN: Jika debitur_id dari form kosong, ambil dari session. Jika session kosong, paksa ke ID 1.
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (DIAMANKAN: Hapus 'exists:debiturs,id' & ubah numeric ke string agar bebas dari error titik/koma format rupiah)
        $request->validate([
            'deskripsi_usaha' => 'required|string',
            'informasi_penghasilan_utama' => 'required|string',
            'informasi_penghasilan_pendukung' => 'nullable|string',
            'pengeluaran_rumah_tangga' => 'required', 
            'angsuran_bank_lain' => 'required',
            'angsuran_bpr' => 'required',
            'analisis_kapasitas' => 'required|string',
            'file_mutasi_rekening' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', 
            'kelengkapan_berkas' => 'nullable|array',
            'berkas_lainnya_detail' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file mutasi rekening
            $capacity = Capacity::where('debitur_id', $debiturId)->first();
            $filePath = $capacity ? $capacity->mutasi_rekening : null;

            // 3. Handle Upload File Mutasi Rekening baru jika diunggah
            if ($request->hasFile('file_mutasi_rekening')) {
                if ($filePath && \Storage::disk('public')->exists($filePath)) {
                    \Storage::disk('public')->delete($filePath);
                }
                $filePath = $request->file('file_mutasi_rekening')->store('mutasi_rekening', 'public');
            }

            // 4. Handle Kelengkapan Berkas & Format "Yang Lain"
            $berkas = $request->input('kelengkapan_berkas', []);
            if (in_array('yang_lain', $berkas) && $request->filled('berkas_lainnya_detail')) {
                $berkas = array_map(function($item) use ($request) {
                    return $item === 'yang_lain' ? 'Lainnya: ' . $request->input('berkas_lainnya_detail') : $item;
                }, $berkas);
            }

            // 5. Bersihkan format angka (hapus titik/koma rupiah sebelum masuk database)
            $pengeluaran = str_replace(['.', ','], ['', '.'], $request->pengeluaran_rumah_tangga);
            $angsuranLain = str_replace(['.', ','], ['', '.'], $request->angsuran_bank_lain);
            $angsuranBpr = str_replace(['.', ','], ['', '.'], $request->angsuran_bpr);

            // 6. Simpan atau perbarui data menggunakan updateOrCreate
            Capacity::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'deskripsi_usaha' => $request->deskripsi_usaha,
                    'informasi_penghasilan_utama' => $request->informasi_penghasilan_utama,
                    'informasi_penghasilan_pendukung' => $request->informasi_penghasilan_pendukung,
                    'pengeluaran_rumah_tangga' => is_numeric($pengeluaran) ? $pengeluaran : 0,
                    'angsuran_bank_lain' => is_numeric($angsuranLain) ? $angsuranLain : 0,
                    'angsuran_bpr' => is_numeric($angsuranBpr) ? $angsuranBpr : 0,
                    'analisis_kapasitas' => $request->analisis_kapasital ?? $request->analisis_kapasitas,
                    'mutasi_rekening' => $filePath, 
                    'kelengkapan_berkas' => $berkas,
                ]
            );

            DB::commit();

            // Arahkan ke rute berikutnya
            return redirect()->route('z7-dataslik')->with('success', 'Data Capacity berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // DATA SLIK
    // ==========================================

    public function createAlur7()
    {
        // PENGAMAN: Deteksi ID dari session, jika kosong paksa ke ID 1
        $debiturId = session('debitur_id');
        if (!$debiturId) {
            $firstDebitur = \App\Models\Debitur::first();
            $debiturId = $firstDebitur ? $firstDebitur->id : 1;
            session(['debitur_id' => $debiturId]);
        }

        $dataslik = DataSlik::where('debitur_id', $debiturId)->first();
        $debitur = \App\Models\Debitur::find($debiturId);

        // Atur tombol kembali secara pasti ke halaman Capacity (z6)
        $backRoute = route('z6-capacity');

        return view('z7-dataslik', compact('dataslik', 'debitur', 'backRoute')); 
    }

    public function storeAlur7(Request $request)
    {
        // PENGAMAN: Ambil ID dari request form, fallback ke session, terakhir ke ID 1
        $debiturId = $request->debitur_id ?? session('debitur_id', 1);

        // 1. Validasi input (HAPUS 'exists:debiturs,id' agar tidak rewel, izinkan dwg/pdf/img)
        $request->validate([
            'file_slik' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240', 
            'analisis_slik' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file
            $dataslik = DataSlik::where('debitur_id', $debiturId)->first();
            $filePath = $dataslik ? $dataslik->file_slik : null;

            // 3. Handle Upload File SLIK baru jika diunggah
            if ($request->hasFile('file_slik')) {
                if ($filePath && \Storage::disk('public')->exists($filePath)) {
                    \Storage::disk('public')->delete($filePath);
                }
                $filePath = $request->file('file_slik')->store('slik_ojk', 'public');
            }

            // 4. Simpan atau perbarui data menggunakan updateOrCreate
            DataSlik::updateOrCreate(
                ['debitur_id' => $debiturId],
                [
                    'file_slik' => $filePath,
                    'analisis_slik' => $request->analisis_slik,
                ]
            );

            DB::commit();

            return redirect()->route('z8-capital')->with('success', 'Data SLIK berhasil disimpan.');
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
            'syarat_catatan' => 'required|string',
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
                    'syarat_catatan' => $request->syarat_catatan,
                ]
            );

            DB::commit();

            return redirect()->route('z14-data-tambahan')->with('success', 'Analisis SWOT berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
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
        $dataSurveiCa = \App\Models\Survei\Debitur::latest()->get(); 

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