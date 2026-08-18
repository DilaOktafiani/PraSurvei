<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebiturController;

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

// Route Export (SATU ROUTE UNTUK SEMUA)
// Contoh: /riwayat/detail/1/export/pdf
// Contoh: /riwayat/detail/1/export/word
Route::get('/riwayat/detail/{id}/export/{type}', [DebiturController::class, 'export'])->name('riwayat.export');

Route::get('/riwayat/detail/{id}/print', [DebiturController::class, 'printPage'])->name('riwayat.print');