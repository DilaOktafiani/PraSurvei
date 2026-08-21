<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebiturController extends Controller
{
    // =========================================================================
    // 1PRA-SURVEI
    // =========================================================================

    // 1. Tampilkan Halaman Step 1 (dengan data lama jika ada)
    public function createAlur1(Request $request)
    {
        $debitur = null;

        // Jika ada ID dari tombol edit, simpan ke session & ambil datanya
        if ($request->has('id')) {
            session(['debitur_id' => $request->id]);
        }

        // Ambil data berdasarkan session yang aktif
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

        return redirect()->route('z2-surveica');
    }
}