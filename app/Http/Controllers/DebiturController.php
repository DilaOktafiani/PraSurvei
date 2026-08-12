<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Debitur;
use App\Models\Agunan;
use App\Models\AgunanTanah;
use App\Models\AgunanKendaraan;
use App\Models\AgunanSimpanan;
use App\Models\AgunanLogam;
use App\Models\YangLain;
use App\Models\InfoUsaha;
use App\Models\DataSlik;
use App\Models\Pinjaman;
use App\Models\Capital;
use App\Models\TakeOver;
use App\Models\Kondisi;
use App\Models\DataLengkap;
use App\Models\BadanUsaha;


class DebiturController extends Controller
{
    // =========================================================================
    // 1PRA-SURVEI
    // =========================================================================

    // 1. Tampilkan Halaman Step 1 (dengan data lama jika ada)
    public function createStep1()
    {
        $debitur = null;
        
        // Cek apakah di session sudah ada ID debitur
        if (session()->has('debitur_id')) {
            $debitur = Debitur::find(session('debitur_id'));
        }

        return view('1pra-survei', compact('debitur'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'no_register'           => 'required|string|max:100',
            'nama'                  => 'required|string|max:255',
            'usia'                  => 'required|string|max:50',
            'usaha'                 => 'required|string|max:255',
            'lama_usaha'            => 'required|string|max:100',
            'alamat_ktp'            => 'required|string',
            'alamat_domisili'       => 'required|string',
            'nama_pasangan'         => 'required|string|max:255',
            'usia_pasangan'         => 'required|string|max:50',
            'plafon'                => 'required|numeric',
            'plafon_terbilang'      => 'required|string|max:255',
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

        // Cek jika user mengisi input teks "Yang Lain"
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

        // Bersihkan array dari indeks yang bolong
        $data['tipe_fasilitas'] = array_values($fasilitas);

        // LOGIKA UPDATE / CREATE
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

        return redirect()->route('2pra-survei');
    }

    // =========================================================================
    // JAMINAN / COLLATERAL
    // =========================================================================

    // 1. Tampilkan Halaman Step 2
    public function createStep2()
    {
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('1pra-survei')->with('error', 'Sesi telah berakhir. Silakan isi dari awal.');
        }

        $jaminanId = session('jaminan_id');
        $data = $jaminanId ? Jaminan::find($jaminanId) : null;

        return view('2pra-survei', compact('debiturId', 'data'));
    }

    // 2. Simpan / Update Data Step 2
    public function storeStep2(Request $request)
    {
        $request->validate([
            'jenis_agunan' => 'required',
            'jenis_agunan_lainnya' => 'required_if:jenis_agunan,yang_lain|nullable|string|max:255',
        ]);

        $debiturId = session('debitur_id');
        $agunanId = session('agunan_id'); // Pastikan key session konsisten

        // Update jika sudah ada, Create jika belum
        $agunan = \App\Models\Agunan::updateOrCreate(
            ['id' => $agunanId, 'debitur_id' => $debiturId],
            [
                'jenis_agunan' => $request->jenis_agunan,
                'jenis_agunan_lainnya' => $request->jenis_agunan == 'yang_lain' ? $request->jenis_agunan_lainnya : null,
            ]
        );

        session(['agunan_id' => $agunan->id]);

        // Logika Percabangan Route
        switch ($request->jenis_agunan) {
            case 'tanah_sawah':
            case 'tanah_pekarangan_kosong':
            case 'tanah_pekarangan_bangunan':
                return redirect()->route('3-1tanah');
            
            case 'kendaraan_bermotor':
                return redirect()->route('3-2kendaraan');
                
            case 'simpanan':
                return redirect()->route('3-3simpanan');
                
            case 'logam_mulia':
                return redirect()->route('3-4logam');
                
            case 'yang_lain':
                return redirect()->route('4jaminan');
                
            default:
                return back()->withErrors(['jenis_agunan' => 'Pilihan tidak valid']);
        }
    }

    // ==========================================
    // TANAH (Step 3-1)
    // ==========================================
    public function createStep3_1(Request $request)
    {
        $debiturId = session('debitur_id');

        if (!$debiturId) {
            return redirect()->route('1pra-survei')->with('error', 'Sesi telah berakhir. Silakan isi dari awal.');
        }

        $urutan = $request->query('urutan', 1);

        // Cari data agunan tanah berdasarkan debitur
        $agunan = Agunan::where('debitur_id', $debiturId)->where('jenis_agunan', 'tanah')->first();
        
        $tanah = null;
        if ($agunan) {
            // Ambil data berdasarkan urutan jaminan yang sedang dibuka
            $tanah = AgunanTanah::where('agunan_id', $agunan->id)->where('urutan', $urutan)->first();
        }

        return view('3-1tanah', compact('debiturId', 'urutan', 'tanah')); 
    }

    public function storeStep3_1(Request $request)
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
                return redirect()->route('3-2kendaraan')
                                ->with('success', 'Data jaminan tanah (1-3) selesai. Silakan lanjut ke data kendaraan.');
            }

            $pilihan = $request->jaminan_lain_input;

            if ($pilihan === 'ADA SELAIN HM/HGB') {
                return redirect()->route('2pra-survei')
                                ->with('success', 'Data agunan tanah berhasil disimpan.');
            } 
            elseif ($pilihan === 'ADA') {
                return redirect()->route('3-1tanah', ['urutan' => $urutanJaminan + 1])
                                ->with('success', 'Data jaminan tanah ' . $urutanJaminan . ' berhasil disimpan. Silakan isi jaminan berikutnya.');
            } 
            else {
                return redirect()->route('5infousaha')
                                ->with('success', 'Data agunan tanah selesai.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // KENDARAAN (Step 3-2)
    // ==========================================
    public function createStep3_2($debitur_id = null)
    {
        $debitur_id = $debitur_id ?? session('debitur_id');
        $agunan = Agunan::where('debitur_id', $debitur_id)->where('jenis_agunan', 'kendaraan')->first();
        $data = $agunan ? $agunan->kendaraan : null; // Asumsi ada relasi 'kendaraan' di model Agunan

        return view('3-2kendaraan', compact('debitur_id', 'data'));
    }

    public function storeStep3_2(Request $request)
    {
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            // ... validasi lainnya
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

        return redirect()->route('3-3simpanan')->with('success', 'Data tersimpan.');
    }

    // ==========================================
    // SIMPANAN (Step 3-3)
    // ==========================================
    public function createStep3_3($debitur_id = null)
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

        return view('3-3simpanan', compact('debitur_id', 'data'));
    }

    public function storeStep3_3(Request $request)
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
            return redirect()->route('3-4logam')->with('success', 'Data agunan simpanan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // LOGAM MULIA (Step 3-4)
    // ==========================================
    public function createStep3_4($debitur_id = null)
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
        $data = $agunan ? $agunan->logamMulia : null; // Asumsi relasi di model Agunan bernama 'logamMulia'

        return view('3-4logam', compact('debitur_id', 'data'));
    }

    public function storeStep3_4(Request $request)
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
            return redirect()->route('4jaminan')->with('success', 'Data agunan logam mulia berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // JAMINAN LAIN / YANG LAIN (Step 4)
    // ==========================================
    public function createStep4()
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

        return view('4jaminan', compact('yangLain'));
    }

    public function storeStep4(Request $request)
    {
        // ... (validasi tetap sama)

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
            return redirect()->route('5infousaha')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // INFORMASI USAHA
    // ==========================================
    public function createStep5(Request $request, $debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL, atau dari session
        $debitur_id = $debitur_id ?? $request->input('debitur_id') ?? session('debitur_id');

        // Jika tidak ada debitur_id sama sekali, berarti sesi baru/sudah direset
        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Amankan kembali ke session
        session(['debitur_id' => $debitur_id]);

        $debitur = Debitur::find($debitur_id);
        
        if (!$debitur) {
            return redirect()->route('step1')->with('error', 'Data debitur tidak ditemukan.');
        }
        
        // Ambil data info usaha (jika sedang dalam proses edit sebelum disubmit total)
        $infoUsaha = InfoUsaha::where('debitur_id', $debitur_id)->first();

        return view('5infousaha', compact('debitur', 'infoUsaha'));
    }

    public function storeStep5(Request $request)
    {
        $request->validate([
            'debitur_id'               => 'required|exists:debiturs,id',
            'omset_usaha'              => 'required',
            'biaya_operasional'        => 'required',
            'penghasilan_tambahan'     => 'required',
            'pengeluaran_rumah_tangga' => 'required',
            'angsuran_bank_lain'       => 'required',
            'angsuran_bpr'             => 'required',
            'deskripsi_usaha'          => 'required|string',
            'kelengkapan_berkas'       => 'nullable|array',
            'berkas_lainnya_detail'    => 'nullable|string',
        ]);

        // Simpan debitur_id ke session agar step berikutnya aman
        session(['debitur_id' => $request->debitur_id]);

        DB::beginTransaction();
        try {
            $kelengkapan = $request->input('kelengkapan_berkas', []);
            if ($request->filled('berkas_lainnya_detail')) {
                $kelengkapan[] = 'Lainnya: ' . $request->input('berkas_lainnya_detail');
            }

            $cleanNumber = function($value) {
                $clean = preg_replace('/[^\d]/', '', $value);
                return $clean === '' ? 0 : $clean;
            };

            InfoUsaha::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'omset_usaha'              => $cleanNumber($request->omset_usaha),
                    'biaya_operasional'        => $cleanNumber($request->biaya_operasional),
                    'penghasilan_tambahan'     => $cleanNumber($request->penghasilan_tambahan),
                    'pengeluaran_rumah_tangga' => $cleanNumber($request->pengeluaran_rumah_tangga),
                    'angsuran_bank_lain'       => $cleanNumber($request->angsuran_bank_lain),
                    'angsuran_bpr'             => $cleanNumber($request->angsuran_bpr),
                    'deskripsi_usaha'          => $request->deskripsi_usaha,
                    'kelengkapan_berkas'       => $kelengkapan,
                ]
            );

            DB::commit();
            
            return redirect()->route('6-1dataslik')->with('success', 'Data pra-survei berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // DATA SLIK
    // ==========================================

    public function createStep6_1($debitur_id = null)
    {
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        session(['debitur_id' => $debitur_id]);

        $debitur = Debitur::findOrFail($debitur_id);
        
        // TAMBAHKAN INI: Cari data yang sudah ada (jika ada)
        $dataSlik = DataSlik::where('debitur_id', $debitur_id)->first();

        // Kirim $dataSlik ke view
        return view('6-1dataslik', compact('debitur', 'dataSlik'));
    }

    public function storeStep6_1(Request $request)
    {
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'apakah_debitur_memiliki_pinjaman' => 'required|in:YA,TIDAK ADA',
        ]);

        DB::beginTransaction();
        try {
            // Menggunakan updateOrCreate agar jika data sudah ada, sistem melakukan update (mencegah duplikasi data)
            DataSlik::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                ['apakah_debitur_memiliki_pinjaman' => $request->apakah_debitur_memiliki_pinjaman]
            );

            DB::commit();
            
            // ==========================================
            // LOGIKA Kondisi Redirect Berdasarkan Pilihan
            // ==========================================
            if ($request->apakah_debitur_memiliki_pinjaman === 'YA') {
                // Jika memilih YA, arahkan ke halaman input pinjaman pertama
                return redirect()->route('6-1pinjaman1')->with('success', 'Data SLIK berhasil disimpan.');
            } else {
                // Jika memilih TIDAK ADA, langsung loncat ke halaman 7capital
                return redirect()->route('7capital')->with('success', 'Data SLIK berhasil disimpan.');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // PINJAMAN
    // ==========================================

    public function createStep6_11($debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL atau dari session
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Simpan juga ke session agar aman saat perpindahan halaman
        session(['debitur_id' => $debitur_id]);

        // Cari data debiturnya agar bisa dikirim ke view
        $debitur = Debitur::findOrFail($debitur_id);

        // Ambil nomor urutan dari query string (default 1, maksimal 20)
        $urutan = request()->query('urutan', 1);
        if ($urutan < 1 || $urutan > 20) {
            $urutan = 1;
        }

        // Ambil data pinjaman yang sudah tersimpan sebelumnya (jika ada) berdasarkan urutan
        $pinjaman = Pinjaman::where('debitur_id', $debitur_id)
                            ->where('urutan', $urutan)
                            ->first();

        return view('6-1pinjaman1', compact('debitur', 'pinjaman', 'urutan'));
    }

    public function storeStep6_11(Request $request)
    {
        $urutan = (int) $request->urutan;

        $rules = [
            'debitur_id'   => 'required|exists:debiturs,id',
            'nama_ljk'     => 'required|string',
            'plafon'       => 'required|numeric', // Ubah ke numeric
            'outstanding'  => 'required|numeric', // Ubah ke numeric
            'kolekbilitas' => 'required|string',
            'angsuran'     => 'required|numeric', // Ubah ke numeric
            'keterangan'   => 'required|string',
        ];

        if ($urutan < 20) {
            $rules['apakah_ada_pinjaman_dibank_lain'] = 'required|in:YA,TIDAK ADA';
        }

        $request->validate($rules);

        // Simpan data
        Pinjaman::updateOrCreate(
            ['debitur_id' => $request->debitur_id, 'urutan' => $urutan],
            [
                'nama_ljk'     => $request->nama_ljk,
                'plafon'       => $request->plafon,
                'outstanding'  => $request->outstanding,
                'kolekbilitas' => $request->kolekbilitas,
                'angsuran'     => $request->angsuran,
                'jkw'          => $request->jkw,
                'keterangan'   => $request->keterangan,
                'apakah_ada_pinjaman_dibank_lain' => ($urutan >= 20) ? 'TIDAK ADA' : $request->apakah_ada_pinjaman_dibank_lain,
            ]
        );

        // Logic redirect tetap sama
        if ($request->apakah_ada_pinjaman_dibank_lain === 'YA' && $urutan < 20) {
            return redirect()->route('6-1pinjaman1', ['urutan' => $urutan + 1]);
        } 
        return redirect()->route('7capital');
    }

    // ==========================================
    // CAPITAL
    // ==========================================

    /**
     * Menampilkan halaman formulir (Capital)
     */
    public function createStep7($debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL atau dari session
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Simpan ke session agar aman saat perpindahan halaman
        session(['debitur_id' => $debitur_id]);

        // Cari data debiturnya
        $debitur = Debitur::findOrFail($debitur_id);

        // Ambil data capital yang sudah pernah disimpan sebelumnya (jika ada)
        $capital = Capital::where('debitur_id', $debitur_id)->first();

        return view('7capital', compact('debitur', 'capital'));
    }

    /**
     * Menyimpan data dari formulir Step 7 (Capital)
     */
    public function storeStep7(Request $request)
    {
        // Validasi input data dari form
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'aset1'      => 'required|string',
            'aset2'      => 'nullable|string',
            'aset3'      => 'nullable|string',
            'aset4'      => 'nullable|string',
            'aset5'      => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Menggunakan updateOrCreate agar data di-update jika sudah ada, atau dibuat baru jika belum ada
            Capital::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id
                ],
                [
                    'aset1' => $request->aset1,
                    'aset2' => $request->aset2,
                    'aset3' => $request->aset3,
                    'aset4' => $request->aset4,
                    'aset5' => $request->aset5,
                ]
            );

            DB::commit();
            
            return redirect()->route('8-1takeover')->with('success', 'Data aset capital berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // 8-1 TAKE OVER
    // ==========================================

    public function createStep8_1($debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL atau dari session
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Simpan juga ke session agar aman saat perpindahan halaman
        session(['debitur_id' => $debitur_id]);

        // Cari data debiturnya agar bisa dikirim ke view
        $debitur = Debitur::findOrFail($debitur_id);

        // Ambil data take over yang sudah pernah disimpan sebelumnya (jika ada)
        $takeover = TakeOver::where('debitur_id', $debitur_id)->first();

        return view('8-1takeover', compact('debitur', 'takeover'));
    }

    public function storeStep8_1(Request $request)
    {
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'apakah_kredit_take_over' => 'required|in:YA,TIDAK',
        ]);

        DB::beginTransaction();
        try {
            // Menggunakan updateOrCreate agar jika data sudah ada, sistem melakukan update (mencegah duplikasi data)
            TakeOver::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                ['apakah_kredit_take_over' => $request->apakah_kredit_take_over]
            );

            DB::commit();
            
            // ==========================================
            // LOGIKA Kondisi Redirect Berdasarkan Pilihan
            // ==========================================
            if ($request->apakah_kredit_take_over === 'YA') {
                // Jika memilih YA, arahkan ke halaman input detail kondisi take-over
                return redirect()->route('8-2kondisi')->with('success', 'Data take over berhasil disimpan.');
            } else {
                // Jika memilih TIDAK, langsung loncat ke halaman 9datalengkap
                return redirect()->route('9datalengkap')->with('success', 'Data take over berhasil disimpan.');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // 8-2 KONDISI
    // ==========================================

    public function createStep8_2($debitur_id = null)
    {
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        session(['debitur_id' => $debitur_id]);
        $debitur = Debitur::findOrFail($debitur_id);
        
        // Ambil data kondisi yang sudah ada
        $kondisi = Kondisi::where('debitur_id', $debitur_id)->first();

        return view('8-2kondisi', compact('debitur', 'kondisi'));
    }

    public function storeStep8_2(Request $request)
    {
        // Validasi hanya berkas_take_over sebagai array
        $request->validate([
            'debitur_id'       => 'required|exists:debiturs,id',
            'berkas_take_over' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            Kondisi::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    // Langsung simpan array berkas_take_over ke database
                    'berkas_take_over' => $request->berkas_take_over,
                ]
            );

            DB::commit();
            return redirect()->route('9datalengkap')->with('success', 'Data kondisi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // KELENGKAPAN DATA
    // ==========================================

    public function createStep9($debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL atau dari session
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Simpan ke session agar aman saat perpindahan halaman
        session(['debitur_id' => $debitur_id]);

        // Cari data debiturnya agar bisa dikirim ke view
        $debitur = Debitur::findOrFail($debitur_id);

        // Ambil data kelengkapan yang sudah pernah disimpan sebelumnya (jika ada)
        $dataLengkap = DataLengkap::where('debitur_id', $debitur_id)->first();

        return view('9datalengkap', compact('debitur', 'dataLengkap'));
    }

    public function storeStep9(Request $request)
    {
        // Validasi input data dari form (dibuat nullable agar tidak wajib diisi)
        $request->validate([
            'debitur_id'    => 'required|exists:debiturs,id',
            'ktp'           => 'nullable|array',
            'ktp.*'         => 'string',
            'slik'          => 'nullable|array',
            'slik.*'        => 'string',
            'kk'            => 'nullable|array',
            'kk.*'          => 'string',
            'surat_nikah'   => 'nullable|array',
            'surat_nikah.*' => 'string',
        ]);

        DB::beginTransaction();
        try {
            // Menggunakan updateOrCreate agar data di-update jika sudah ada, atau dibuat baru jika belum
            DataLengkap::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id
                ],
                [
                    'ktp'         => $request->ktp,
                    'slik'        => $request->slik,
                    'kk'          => $request->kk,
                    'surat_nikah' => $request->surat_nikah,
                ]
            );

            DB::commit();
            
            return redirect()->route('10badanusaha')->with('success', 'Kelengkapan data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // BADAN USAHA
    // ==========================================

    public function createStep10($debitur_id = null)
    {
        // Ambil debitur_id dari parameter URL atau dari session
        $debitur_id = $debitur_id ?? session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Simpan ke session agar aman saat perpindahan halaman
        session(['debitur_id' => $debitur_id]);

        // Cari data debitur
        $debitur = Debitur::findOrFail($debitur_id);

        // Ambil data badan usaha yang sudah pernah disimpan sebelumnya (jika ada)
        $badanUsaha = BadanUsaha::where('debitur_id', $debitur_id)->first();

        return view('10badanusaha', compact('debitur', 'badanUsaha'));
    }

    public function storeStep10(Request $request)
    {
        $request->validate([
            'debitur_id'           => 'required|exists:debiturs,id',
            'berkas_badan_usaha'   => 'nullable|array',
            'berkas_badan_usaha.*' => 'string',
        ]);

        DB::beginTransaction();
        try {
            // Menggunakan updateOrCreate agar data ter-update jika sudah ada, atau dibuat baru jika belum
            BadanUsaha::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id
                ],
                [
                    'berkas_badan_usaha' => $request->berkas_badan_usaha,
                ]
            );

            DB::commit();
            
            // Hapus session formulir secara keseluruhan agar kembali kosong saat input baru lagi
            session()->forget([
                'debitur_id', 
                // Tambahkan key session lain milik step sebelumnya jika ada, contoh:
                // 'step_1_data', 'step_2_data', dst.
            ]);

            // Arahkan ke halaman utama/dashboard dengan pesan sukses
            return redirect('/0dashboard')->with('success', 'Data Anda berhasil tersimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // ==========================================
    // RIWAYAT
    // ==========================================

    // 1. Menampilkan Halaman Riwayat dengan Data dari Database
    public function createStepRiwayat()
    {
        // Mengambil semua data debitur dari database, diurutkan dari yang terbaru
        $dataDebitur = Debitur::latest()->get(); 

        // Jika kamu punya model khusus untuk survei CA, ambil juga datanya di sini
        // $dataSurveiCa = SurveiCa::latest()->get();
        $dataSurveiCa = []; // Kosongkan dulu jika belum ada tabelnya

        return view('riwayat', compact('dataDebitur', 'dataSurveiCa'));
    }

    // 6. Detail Riwayat (Menampilkan detail berdasarkan ID)
    public function detailRiwayat($id)
    {
        // Mencari data debitur berdasarkan ID, jika tidak ketemu akan otomatis memunculkan error 404
        $item = Debitur::findOrFail($id);

        // Di sini nanti kamu bisa mengarahkan ke halaman detail khusus (misal: view('riwayat-detail'))
        // Untuk sekarang kita tampilkan datanya dulu atau kembalikan ke view detail
        return view('detail-riwayat', compact('item'));
    }

    // ==========================================
    //  DETAIL RIWAYAT
    // ==========================================
    public function show($id)
    {
        // Mengambil data berdasarkan ID atau memunculkan error 404 jika tidak ada
        $data = Debitur::findOrFail($id); 

        // Mengirim data ke view 'riwayat-detail'
        return view('riwayat-detail', compact('data'));
    }
}