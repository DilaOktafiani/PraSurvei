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
        $debiturId = session('debitur_id'); 
        $data = null; // Gunakan variabel $data

        if ($debiturId) {
            // Ambil langsung baris datanya dari tabel analisis_jaminan
            $data = AnalisisJaminan::where('debitur_id', $debiturId)->first();
        }

        // Kirim sebagai 'data' agar cocok dengan {{ $data->analisis_jaminan }}
        return view('z5-jaminan-analisis', compact('data')); 
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
        $debiturId = session('debitur_id'); // Mengambil debitur_id dari session
        $capacity = null;

        if ($debiturId) {
            // Mencari data berdasarkan debitur_id jika sudah pernah diisi sebelumnya
            $capacity = Capacity::where('debitur_id', $debiturId)->first();
        }

        // Contoh variabel tambahan jika dibutuhkan di view (sesuaikan dengan controller Anda sebelumnya)
        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;
        $infoUsaha = null;
        $tanah = null;

        return view('z6-capacity', compact('capacity', 'debitur', 'infoUsaha', 'tanah')); 
    }

    public function storeAlur6(Request $request)
    {
        // 1. Validasi input termasuk debitur_id
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'deskripsi_usaha' => 'required|string',
            'informasi_penghasilan_utama' => 'required|string',
            'informasi_penghasilan_pendukung' => 'nullable|string',
            'pengeluaran_rumah_tangga' => 'required|numeric',
            'angsuran_bank_lain' => 'required|numeric',
            'angsuran_bpr' => 'required|numeric',
            'analisis_kapasitas' => 'required|string',
            'file_mutasi_rekening' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // Diubah dari file_denah & hapus dwg
            'kelengkapan_berkas' => 'nullable|array',
            'berkas_lainnya_detail' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file mutasi rekening
            $capacity = Capacity::where('debitur_id', $request->debitur_id)->first();
            $filePath = $capacity ? $capacity->mutasi_rekening : null;

            // 3. Handle Upload File Mutasi Rekening baru jika diunggah
            if ($request->hasFile('file_mutasi_rekening')) {
                // Hapus file lama jika ada
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

            // 5. Simpan atau perbarui data menggunakan updateOrCreate
            Capacity::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'deskripsi_usaha' => $request->deskripsi_usaha,
                    'informasi_penghasilan_utama' => $request->informasi_penghasilan_utama,
                    'informasi_penghasilan_pendukung' => $request->informasi_penghasilan_pendukung,
                    'pengeluaran_rumah_tangga' => $request->pengeluaran_rumah_tangga,
                    'angsuran_bank_lain' => $request->angsuran_bank_lain,
                    'angsuran_bpr' => $request->angsuran_bpr,
                    'analisis_kapasitas' => $request->analisis_kapasitas,
                    'mutasi_rekening' => $filePath, // Diubah dari file_denah
                    'kelengkapan_berkas' => $berkas,
                ]
            );

            DB::commit();

            // Arahkan ke rute berikutnya atau kembali dengan pesan sukses
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
        $debiturId = session('debitur_id');
        $dataslik = null;

        if ($debiturId) {
            $dataslik = DataSlik::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Mengirimkan variabel '$dataslik' agar sesuai dengan yang digunakan di view
        return view('z7-dataslik', compact('dataslik', 'debitur')); 
    }

    public function storeAlur7(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'file_slik' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240', // Maksimal 10MB
            'analisis_slik' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Ambil data lama jika ada untuk pengecekan file
            $dataslik = DataSlik::where('debitur_id', $request->debitur_id)->first();
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
                ['debitur_id' => $request->debitur_id],
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
        $debiturId = session('debitur_id');
        $capital = null;

        if ($debiturId) {
            // Mencari data berdasarkan debitur_id
            $capital = Capital::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        return view('z8-capital', compact('capital', 'debitur')); // Sesuaikan nama view Anda
    }

    public function storeAlur8(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'analisis_aset' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate
            Capital::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
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
        $debiturId = session('debitur_id');
        $takeover = null;

        if ($debiturId) {
            // Mencari data berdasarkan debitur_id
            $takeover = TakeOver::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        return view('z9-takeover', compact('takeover', 'debitur')); // Sesuaikan nama view Anda
    }

    public function storeAlur9(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'apakah_kredit_take_over' => 'required|in:YA,TIDAK',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate
            TakeOver::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'apakah_kredit_take_over' => $request->apakah_kredit_take_over,
                ]
            );

            DB::commit();

            // 3. Logika redirect bercabang berdasarkan pilihan user
            if ($request->apakah_kredit_take_over === 'YA') {
                // Jika pilih YA, arahkan ke halaman kondisi (z10-kondisi)
                return redirect()->route('z10-kondisi')->with('success', 'Data berhasil disimpan. Silakan lanjutkan ke Kondisi Take Over.');
            } else {
                // Jika pilih TIDAK, lewati ke halaman berkas lengkap (z11-berkas-lengkap)
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
        $debiturId = session('debitur_id');
        $analisisTakeOver = null;

        if ($debiturId) {
            // Mencari data berdasarkan debitur_id
            $analisisTakeOver = Kondisi::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        return view('z10-kondisi', compact('analisisTakeOver', 'debitur')); // Sesuaikan nama view Anda
    }

    public function storeAlur10(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'analisis_take_over' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate
            Kondisi::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
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
        $debiturId = session('debitur_id');
        $kelengkapan = null;

        if ($debiturId) {
            $kelengkapan = BerkasLengkap::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        return view('z11-berkas-lengkap', compact('kelengkapan', 'debitur')); // Sesuaikan nama view Anda
    }

    public function storeAlur11(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'analisis_kelengkapan_berkas' => 'required|string',
            'apakah_badan_usaha' => 'required|in:YA,TIDAK',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate
            BerkasLengkap::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'analisis_kelengkapan_berkas' => $request->analisis_kelengkapan_berkas,
                    'apakah_badan_usaha' => $request->apakah_badan_usaha,
                ]
            );

            DB::commit();

            // 3. Logika redirect bercabang berdasarkan pilihan Badan Usaha
            if ($request->apakah_badan_usaha === 'YA') {
                // Jika pilih YA, arahkan ke halaman Badan Usaha (z12-badanusaha)
                return redirect()->route('z12-badanusaha')->with('success', 'Kelengkapan Berkas berhasil disimpan. Silakan lanjutkan ke Badan Usaha.');
            } else {
                // Jika pilih TIDAK, lewati langsung ke halaman SWOT (z13-swot)
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
        $debiturId = session('debitur_id');
        $kelengkapanBadanUsaha = null;

        if ($debiturId) {
            $kelengkapanBadanUsaha = BadanUsaha::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Diperbaiki: menggunakan '$kelengkapanBadanUsaha' agar sinkron
        return view('z12-badanusaha', compact('kelengkapanBadanUsaha', 'debitur')); 
    }

    public function storeAlur12(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'analisa_badan_usaha' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate
            BadanUsaha::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
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
        $debiturId = session('debitur_id');
        $swot = null;

        if ($debiturId) {
            // Menggunakan Model Swot
            $swot = \App\Models\Survei\Swot::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        // Menggunakan compact('swot') agar sinkron
        return view('z13-swot', compact('swot', 'debitur')); 
    }

    public function storeAlur13(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
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
            // 2. Simpan atau perbarui data menggunakan model Swot
            \App\Models\Survei\Swot::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
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
        $debiturId = session('debitur_id');
        $takeover = null;

        if ($debiturId) {
            $takeover = DataTambahan::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        $backRoute = url()->previous() !== url()->current() ? url()->previous() : route('z13-swot');

        return view('z14-data-tambahan', compact('takeover', 'debitur', 'backRoute'));
    }

    public function storeAlur14(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'menambahkan_data_slik' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data ke database
            DataTambahan::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
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
                // Jika memilih opsi teks panjang "Tidak (saya mengisi data manual di excel)"
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
        $debiturId = session('debitur_id');
        $urutan = $request->query('urutan', 1); // Default ke urutan 1 jika tidak ada
        $pinjaman = null;

        if ($debiturId) {
            $pinjaman = Pinjaman::where('debitur_id', $debiturId)
                                         ->where('urutan', $urutan)
                                         ->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        return view('z15-pinjaman', compact('pinjaman', 'debitur', 'urutan')); // Sesuaikan nama view Blade Anda
    }

    public function storeAlur15(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'urutan' => 'required|integer|min:1',
            'nama_ljk' => 'required|string',
            'plafond' => 'required|numeric|min:0',
            'outstanding' => 'required|numeric|min:0',
            'kolekbilitas' => 'required|string',
            'angsuran' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'jkw' => 'nullable|string',
            'jalan' => 'required|string',
            'bunga' => 'nullable|string',
            'apakah_ada_pinjaman_lain' => 'nullable|in:YA,TIDAK ADA',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data berdasarkan debitur_id dan urutan
            Pinjaman::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id,
                    'urutan' => $request->urutan
                ],
                [
                    'nama_ljk' => $request->nama_ljk,
                    'plafond' => $request->plafond,
                    'outstanding' => $request->outstanding,
                    'kolekbilitas' => $request->kolekbilitas,
                    'angsuran' => $request->angsuran,
                    'keterangan' => $request->keterangan,
                    'jkw' => $request->jkw,
                    'jalan' => $request->jalan,
                    'bunga' => $request->bunga,
                    'apakah_ada_pinjaman_lain' => $request->apakah_ada_pinjaman_lain,
                ]
            );

            DB::commit();

            // 3. Logika Navigasi Lanjutan Berdasarkan Pilihan "Apakah ada pinjaman lain"
            if ($request->apakah_ada_pinjaman_lain === 'YA' && $request->urutan < 20) {
                // Jika user memilih ADA, arahkan ke form urutan berikutnya
                $nextUrutan = $request->urutan + 1;
                return redirect()->route('z15-pinjaman', ['urutan' => $nextUrutan])
                                 ->with('success', 'Data pinjaman ' . $request->urutan . ' berhasil disimpan. Silakan isi data pinjaman berikutnya.');
            } else {
                // Jika TIDAK ADA atau mencapai batas maksimal, arahkan ke alur/langkah berikutnya (sesuaikan routenya)
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
        $debiturId = session('debitur_id');
        $takeover = null;

        if ($debiturId) {
            $takeover = MutasiRekening::where('debitur_id', $debiturId)->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        return view('z16-mutasi-rekening', compact('takeover', 'debitur')); // Sesuaikan nama view Blade Anda
    }

    public function storeAlur16(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'detail_mutasi_tabungan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan updateOrCreate
            $mutasi = MutasiRekening::updateOrCreate(
                ['debitur_id' => $request->debitur_id],
                [
                    'detail_mutasi_tabungan' => $request->detail_mutasi_tabungan,
                    // Jika kolom di database Anda menggunakan 'apakah_badan_usaha', sesuaikan di sini:
                    'apakah_badan_usaha' => $request->detail_mutasi_tabungan, 
                ]
            );

            DB::commit();

            // 3. Logika Navigasi Kondisional yang Lebih Aman
            // Cek apakah pengguna menekan tombol khusus atau berdasarkan nilai input
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
        $debiturId = session('debitur_id');
        $urutan = $request->query('urutan', 1); // Default ke urutan 1 jika tidak ada
        $pinjaman = null; // Menggunakan nama variabel $pinjaman agar sesuai dengan Blade yang Anda sediakan

        if ($debiturId) {
            // Perbaikan: Gunakan MutasiRekening1 (sesuai nama model dan tabel)
            $pinjaman = \App\Models\Survei\MutasiRekening1::where('debitur_id', $debiturId)
                                                          ->where('urutan', $urutan)
                                                          ->first();
        }

        $debitur = $debiturId ? \App\Models\Debitur::find($debiturId) : null;

        return view('z17-mutasi-rekening1', compact('pinjaman', 'debitur', 'urutan'));
    }

    public function storeAlur17(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
            'urutan' => 'required|integer|min:1',
            'nama_bank' => 'required|string',
            'bulan' => 'required|string',
            'debet' => 'required|numeric|min:0',
            'kredit' => 'required|numeric|min:0',
            'saldo' => 'required|string',
            'apakah_masih_ada_mutasi_tabungan' => 'nullable|in:YA,TIDAK ADA',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan atau perbarui data menggunakan model MutasiRekening1
            \App\Models\Survei\MutasiRekening1::updateOrCreate(
                [
                    'debitur_id' => $request->debitur_id,
                    'urutan' => $request->urutan
                ],
                [
                    'nama_bank' => $request->nama_bank,
                    'bulan' => $request->bulan,
                    'debet' => $request->debet,
                    'kredit' => $request->kredit,
                    'saldo' => $request->saldo,
                    'apakah_masih_ada_mutasi_tabungan' => $request->apakah_masih_ada_mutasi_tabungan,
                ]
            );

            DB::commit();

            // 3. Logika Navigasi Lanjutan Berdasarkan Pilihan "Apakah masih ada mutasi tabungan"
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
        $debitur_id = session('debitur_id');

        if (!$debitur_id) {
            return redirect()->route('step1')->with('error', 'Silakan isi data debitur terlebih dahulu.');
        }

        // Mengambil URL halaman sebelumnya secara otomatis dari browser
        $backRoute = url()->previous();

        return view('z18-selesai', compact('debitur_id', 'backRoute'));
    }

    public function storeAlur18(Request $request)
    {
        $request->validate([
            'debitur_id' => 'required|exists:debiturs,id',
        ]);

        $debiturId = $request->debitur_id;
        
        // Mengambil data debitur dari model Survei CA atau model utama menggunakan path lengkap
        $debitur = \App\Models\Survei\Debitur::find($debiturId) ?? \App\Models\Debitur::find($debiturId);

        DB::beginTransaction();
        try {
            // Proses simpan atau update status akhir jika ada
            if ($debitur) {
                // Contoh: $debitur->status = 'selesai';
                // $debitur->save();
            }

            DB::commit();
            
            // Hapus session formulir setelah sukses
            session()->forget(['debitur_id']);

            // Redirect ke halaman riwayat utama
            return redirect()->route('riwayat.detail2')
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