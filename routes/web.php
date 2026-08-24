<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebiturController;
use App\Http\Controllers\SurveiController;

// =========================================================================
// PRA-SURVEI
// =========================================================================

// Route Halaman 1
Route::get('/z1-surveica', [DebiturController::class, 'createAlur1'])->name('z1-surveica');
Route::post('/z1-surveica', [DebiturController::class, 'storeAlur1'])->name('storeAlur1');

// Dashboard
Route::view('/', '0dashboard');
Route::view('/0dashboard', '0dashboard');

// Route Halaman 1
Route::get('/1pra-survei', [DebiturController::class, 'createStep1'])->name('1pra-survei');
Route::post('/1pra-survei', [DebiturController::class, 'storeStep1'])->name('storeStep1');

// Route Halaman 2
Route::get('/2pra-survei', [DebiturController::class, 'createStep2'])->name('2pra-survei');
Route::post('/2pra-survei', [DebiturController::class, 'storeStep2'])->name('storeStep2');

// Route Halaman 3 Jika Pengguna Memilih Opsi Tanah Sawah, Tanah Pekarangan, dan Tanah Bangunan di Jenis Agunan
Route::get('/3-1tanah', [DebiturController::class, 'createStep3_1'])->name('3-1tanah');
Route::post('/3-1tanah', [DebiturController::class, 'storeStep3_1'])->name('storeStep3-1');

// Route Halaman 3 Jika Pengguna Memilih Opsi Kendaraan di Jenis Agunan
Route::get('/3-2kendaraan', [DebiturController::class, 'createStep3_2'])->name('3-2kendaraan');
Route::post('/3-2kendaraan', [DebiturController::class, 'storeStep3_2'])->name('storeStep3-2');

// Route Halaman 3 Jika Pengguna Memilih Opsi Simpanan di Jenis Agunan
Route::get('/3-3simpanan', [DebiturController::class, 'createStep3_3'])->name('3-3simpanan');
Route::post('/3-3simpanan', [DebiturController::class, 'storeStep3_3'])->name('storeStep3-3');

// Route Halaman 3 Jika Pengguna Memilih Opsi Logam Mulia di Jenis Agunan
Route::get('/3-4logam', [DebiturController::class, 'createStep3_4'])->name('3-4logam');
Route::post('/3-4logam', [DebiturController::class, 'storeStep3_4'])->name('storeStep3-4');

// Route Halaman 3 Jika Pengguna Memilih Opsi Jaminan di Jenis Agunan
Route::get('/4jaminan', [DebiturController::class, 'createStep4'])->name('4jaminan');
Route::post('/4jaminan', [DebiturController::class, 'storeStep4'])->name('storeStep4');

// Route Halaman 5 Informasi Usaha
Route::get('/5infousaha', [DebiturController::class, 'createStep5'])->name('5infousaha');
Route::post('/5infousaha', [DebiturController::class, 'storeStep5'])->name('storeStep5');

// Route Halaman 6 Data Slik
Route::get('/6-1dataslik', [DebiturController::class, 'createStep6_1'])->name('6-1dataslik');
Route::post('/6-1dataslik', [DebiturController::class, 'storeStep6_1'])->name('storeStep6-1');

// Route Halaman 6 Pinjaman
Route::get('/6-1pinjaman1', [DebiturController::class, 'createStep6_11'])->name('6-1pinjaman1');
Route::post('/6-1pinjaman1', [DebiturController::class, 'storeStep6_11'])->name('storeStep6-11');

// Route Halaman 7 Capital
Route::get('/7capital', [DebiturController::class, 'createStep7'])->name('7capital');
Route::post('/7capital', [DebiturController::class, 'storeStep7'])->name('storeStep7');

// Route Halaman 8 Take Over
Route::get('/8-1takeover', [DebiturController::class, 'createStep8_1'])->name('8-1takeover');
Route::post('/8-1takeover', [DebiturController::class, 'storeStep8_1'])->name('storeStep8-1');

// Route Halaman 8 Kondisi
Route::get('/8-2kondisi', [DebiturController::class, 'createStep8_2'])->name('8-2kondisi');
Route::post('/8-2kondisi', [DebiturController::class, 'storeStep8_2'])->name('storeStep8-2');

// Route Halaman 9 Kelengkapan Data
Route::get('/9datalengkap', [DebiturController::class, 'createStep9'])->name('9datalengkap');
Route::post('/9datalengkap', [DebiturController::class, 'storeStep9'])->name('storeStep9');

// Route Halaman 10 Badan Usaha
Route::get('/10badanusaha', [DebiturController::class, 'createStep10'])->name('10badanusaha');
Route::post('/10badanusaha', [DebiturController::class, 'storeStep10'])->name('storeStep10');

// Route Halaman 11 Final
Route::get('/11final', [DebiturController::class, 'createStep11'])->name('11final');
Route::post('/11final', [DebiturController::class, 'storeStep11'])->name('storeStep11');



// 1. Route untuk Menampilkan Daftar Riwayat
Route::get('/riwayat', [DebiturController::class, 'createStepRiwayat'])->name('riwayat');

// 2. Route untuk Proses Simpan (jika ada)
Route::post('/riwayat', [DebiturController::class, 'storeStepRiwayat'])->name('storeStepRiwayat');

// Route Detail
Route::get('/riwayat/detail/{id}', [DebiturController::class, 'show'])->name('riwayat.detail');

// Route Export Terpisah
Route::get('/riwayat/detail/{id}/export/pdf', [DebiturController::class, 'exportPdf'])->name('riwayat.pdf');
Route::get('/riwayat/detail/{id}/export/word', [DebiturController::class, 'exportWord'])->name('riwayat.word');
Route::get('/riwayat/detail/{id}/export/excel', [DebiturController::class, 'exportExcel'])->name('riwayat.excel');

Route::get('/riwayat/detail/{id}/print', [DebiturController::class, 'printPage'])->name('riwayat.print');



// =========================================================================
// SURVEI
// =========================================================================

// Route Halaman 1
Route::get('/z1-surveica', [SurveiController::class, 'createAlur1'])->name('z1-surveica');
Route::post('/z1-surveica', [SurveiController::class, 'storeAlur1'])->name('storeAlur1');

// Route Halaman 2
Route::get('/z2-surveica', [SurveiController::class, 'createAlur2'])->name('z2-surveica');
Route::post('/z2-surveica', [SurveiController::class, 'storeAlur2'])->name('storeAlur2');

// Route Halaman 3 Jika Pengguna Memilih Opsi Tanah Sawah, Tanah Pekarangan, dan Tanah Bangunan di Jenis Agunan
Route::get('/z3-1tanah', [SurveiController::class, 'createAlur3_1'])->name('z3-1tanah');
Route::post('/z3-1tanah', [SurveiController::class, 'storeAlur3_1'])->name('storeAlur3-1');

// Route Halaman 3 Jika Pengguna Memilih Opsi Kendaraan di Jenis Agunan
Route::get('/z3-2kendaraan', [SurveiController::class, 'createAlur3_2'])->name('z3-2kendaraan');
Route::post('/z3-2kendaraan', [SurveiController::class, 'storeAlur3_2'])->name('storeAlur3-2');

// Route Halaman 3 Jika Pengguna Memilih Opsi Simpanan di Jenis Agunan
Route::get('/z3-3simpanan', [SurveiController::class, 'createAlur3_3'])->name('z3-3simpanan');
Route::post('/z3-3simpanan', [SurveiController::class, 'storeAlur3_3'])->name('storeAlur3-3');

// Route Halaman 3 Jika Pengguna Memilih Opsi Logam Mulia di Jenis Agunan
Route::get('/z3-4logam', [SurveiController::class, 'createAlur3_4'])->name('z3-4logam');
Route::post('/z3-4logam', [SurveiController::class, 'storeAlur3_4'])->name('storeAlur3-4');

// Route Halaman 3 Jika Pengguna Memilih Opsi Jaminan di Jenis Agunan
Route::get('/z4-jaminan', [SurveiController::class, 'createAlur4'])->name('z4-jaminan');
Route::post('/z4-jaminan', [SurveiController::class, 'storeAlur4'])->name('storeAlur4');

Route::get('/z5-jaminan-analisis', [SurveiController::class, 'createAlur5'])->name('z5-jaminan-analisis');
Route::post('/z5-jaminan-analisis', [SurveiController::class, 'storeAlur5'])->name('storeAlur5');

Route::get('/z6-capacity', [SurveiController::class, 'createAlur6'])->name('z6-capacity');
Route::post('/z6-capacity', [SurveiController::class, 'storeAlur6'])->name('storeAlur6');

Route::get('/z7-dataslik', [SurveiController::class, 'createAlur7'])->name('z7-dataslik');
Route::post('/z7-dataslik', [SurveiController::class, 'storeAlur7'])->name('storeAlur7');

Route::get('/z8-capital', [SurveiController::class, 'createAlur8'])->name('z8-capital');
Route::post('/z8-capital', [SurveiController::class, 'storeAlur8'])->name('storeAlur8');

Route::get('/z9-takeover', [SurveiController::class, 'createAlur9'])->name('z9-takeover');
Route::post('/z9-takeover', [SurveiController::class, 'storeAlur9'])->name('storeAlur9');

Route::get('/z10-kondisi', [SurveiController::class, 'createAlur10'])->name('z10-kondisi');
Route::post('/z10-kondisi', [SurveiController::class, 'storeAlur10'])->name('storeAlur10');

Route::get('/z11-berkas-lengkap', [SurveiController::class, 'createAlur11'])->name('z11-berkas-lengkap');
Route::post('/z11-berkas-lengkap', [SurveiController::class, 'storeAlur11'])->name('storeAlur11');

Route::get('/z12-badanusaha', [SurveiController::class, 'createAlur12'])->name('z12-badanusaha');
Route::post('/z12-badanusaha', [SurveiController::class, 'storeAlur12'])->name('storeAlur12');

Route::get('/z13-swot', [SurveiController::class, 'createAlur13'])->name('z13-swot');
Route::post('/z13-swot', [SurveiController::class, 'storeAlur13'])->name('storeAlur13');

Route::get('/z14-data-tambahan', [SurveiController::class, 'createAlur14'])->name('z14-data-tambahan');
Route::post('/z14-data-tambahan', [SurveiController::class, 'storeAlur14'])->name('storeAlur14');

Route::get('/z15-pinjaman', [SurveiController::class, 'createAlur15'])->name('z15-pinjaman');
Route::post('/z15-pinjaman', [SurveiController::class, 'storeAlur15'])->name('storeAlur15');

Route::get('/z16-mutasi-rekening', [SurveiController::class, 'createAlur16'])->name('z16-mutasi-rekening');
Route::post('/z16-mutasi-rekening', [SurveiController::class, 'storeAlur16'])->name('storeAlur16');

Route::get('/z17-mutasi-rekening1', [SurveiController::class, 'createAlur17'])->name('z17-mutasi-rekening1');
Route::post('/z17-mutasi-rekening1', [SurveiController::class, 'storeAlur17'])->name('storeAlur17');

Route::get('/z18-selesai', [SurveiController::class, 'createAlur18'])->name('z18-selesai');
Route::post('/z18-selesai', [SurveiController::class, 'storeAlur18'])->name('storeAlur18');
