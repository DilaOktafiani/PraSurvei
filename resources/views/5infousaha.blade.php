<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pra-Survei - PT BPR Adipura Santosa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/js/rupiah-formatter.js'])
</head>
<body class="bg-[#F8FAFC] font-sans min-h-screen flex flex-col">
    <!-- HEADER -->
    <header class="bg-[#0A3370] text-white shadow-md py-4 border-b-4 border-[#0082CB] sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BPR Adipura Santosa" class="h-9 w-auto bg-white p-1 rounded object-contain">
                <h1 class="text-xl font-bold tracking-wide">BPR ADIPURA SANTOSA</h1>
            </div>
            <!-- Menggunakan link langsung ke beranda -->
            <a href="/" class="inline-flex items-center justify-center gap-2 text-sm text-white font-medium px-4 py-1.5 rounded-full border-2 border-white hover:bg-white/10 transition"> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"> 
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /> 
                </svg> 
                <span>Beranda</span> 
            </a>
        </div> 
    </header>

    <!-- CONTAINER UTAMA -->
    <main class="max-w-3xl mx-auto mt-8 px-4 w-full flex-grow mb-12">
        
        <div class="bg-white rounded-lg shadow-sm border-t-8 border-[#0082CB] border-x border-b border-gray-200 p-6 mb-6">
            <div class="flex justify-between items-start gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Formulir Pra-Survei AO</h2>
                    <p class="text-gray-500 mt-1 text-sm">Silakan masukkan data awal calon nasabah hasil kunjungan lapangan secara akurat.</p>
                </div>
            </div>
            <p class="text-xs text-red-500 mt-4 font-medium flex items-center gap-1 border-t border-gray-100 pt-3">
                <span>*</span> Menunjukkan pertanyaan yang wajib diisi
            </p>
        </div>

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeStep5') }}" method="POST" class="space-y-6" novalidate>
            @csrf <!-- Security Token Laravel -->

            <!-- PENTING: Tambahkan debitur_id (sesuaikan nilainya dari controller/variabel Anda) -->
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? 1 }}">
        
            <!-- INFORMASI USAHA -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">INFORMASI USAHA</h3>

                <!-- Omset Usaha -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Omset Usaha <span class="text-red-500">*</span>
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 200000000" 
                        value="{{ old('omset_usaha', isset($infoUsaha->omset_usaha) ? number_format($infoUsaha->omset_usaha, 0, ',', '.') : '') }}" 
                        required>
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="omset_usaha" value="{{ old('omset_usaha', $infoUsaha->omset_usaha ?? '') }}">
                </div>

                <!-- Biaya Operasional -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Biaya Operasional <span class="text-red-500">*</span>
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 100000000" 
                        value="{{ old('biaya_operasional', isset($infoUsaha->biaya_operasional) ? number_format($infoUsaha->biaya_operasional, 0, ',', '.') : '') }}" 
                        required>
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="biaya_operasional" value="{{ old('biaya_operasional', $infoUsaha->biaya_operasional ?? '') }}">
                </div>

                <!-- Penghasilan Tambahan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Penghasilan Tambahan <span class="text-red-500">*</span>
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 25000000" 
                        value="{{ old('penghasilan_tambahan', isset($infoUsaha->penghasilan_tambahan) ? number_format($infoUsaha->penghasilan_tambahan, 0, ',', '.') : '') }}" 
                        required>
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="penghasilan_tambahan" value="{{ old('penghasilan_tambahan', $infoUsaha->penghasilan_tambahan ?? '') }}">
                </div>

                <!-- Pengeluaran Rumah Tangga -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Pengeluaran Rumah Tangga <span class="text-red-500">*</span>
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 20000000" 
                        value="{{ old('pengeluaran_rumah_tangga', isset($infoUsaha->pengeluaran_rumah_tangga) ? number_format($infoUsaha->pengeluaran_rumah_tangga, 0, ',', '.') : '') }}" 
                        required>
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="pengeluaran_rumah_tangga" value="{{ old('pengeluaran_rumah_tangga', $infoUsaha->pengeluaran_rumah_tangga ?? '') }}">
                </div>

                <!-- Angsuran Bank Lain -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Angsuran Bank Lain <span class="text-red-500">*</span>
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 100000000" 
                        value="{{ old('angsuran_bank_lain', isset($infoUsaha->angsuran_bank_lain) ? number_format($infoUsaha->angsuran_bank_lain, 0, ',', '.') : '') }}" 
                        required>
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="angsuran_bank_lain" value="{{ old('angsuran_bank_lain', $infoUsaha->angsuran_bank_lain ?? '') }}">
                </div>

                <!-- Angsuran BPR -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Angsuran BPR <span class="text-red-500">*</span>
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 20000000" 
                        value="{{ old('angsuran_bpr', isset($infoUsaha->angsuran_bpr) ? number_format($infoUsaha->angsuran_bpr, 0, ',', '.') : '') }}" 
                        required>
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="angsuran_bpr" value="{{ old('angsuran_bpr', $infoUsaha->angsuran_bpr ?? '') }}">
                </div>

                <!-- Deskripsi Usaha -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi Usaha <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi_usaha" rows="5" required placeholder="Masukkan deskripsi usaha"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB] whitespace-pre-line">{{ old('deskripsi_usaha', $infoUsaha->deskripsi_usaha ?? '') }}</textarea>
                </div>

                <!-- Kelengkapan Berkas -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kelengkapan Berkas
                    </label>
                    
                    @php
                        $rawBerkas = old('kelengkapan_berkas', $infoUsaha->kelengkapan_berkas ?? []);
                        if (is_string($rawBerkas)) {
                            $rawBerkas = json_decode($rawBerkas, true) ?? [];
                        }

                        $selectedBerkas = [];
                        $berkasLainnyaText = old('berkas_lainnya_detail', '');

                        foreach ($rawBerkas as $item) {
                            if (str_starts_with($item, 'Lainnya: ')) {
                                $selectedBerkas[] = 'yang_lain';
                                if (empty($berkasLainnyaText)) {
                                    $berkasLainnyaText = str_replace('Lainnya: ', '', $item);
                                }
                            } else {
                                $selectedBerkas[] = $item;
                            }
                        }
                    @endphp

                    <div class="space-y-3 text-sm text-gray-700">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kelengkapan_berkas[]" value="pembukuan" 
                                   {{ in_array('pembukuan', $selectedBerkas) ? 'checked' : '' }}
                                   class="accent-[#0082CB] w-4 h-4 rounded">
                            <span>Pembukuan</span>
                        </label>
                        
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kelengkapan_berkas[]" value="rekening" 
                                   {{ in_array('rekening', $selectedBerkas) ? 'checked' : '' }}
                                   class="accent-[#0082CB] w-4 h-4 rounded">
                            <span>Rekening</span>
                        </label>
                        
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kelengkapan_berkas[]" value="slip_gaji" 
                                   {{ in_array('slip_gaji', $selectedBerkas) ? 'checked' : '' }}
                                   class="accent-[#0082CB] w-4 h-4 rounded">
                            <span>Slip Gaji</span>
                        </label>
                        
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kelengkapan_berkas[]" value="ijin_usaha" 
                                   {{ in_array('ijin_usaha', $selectedBerkas) ? 'checked' : '' }}
                                   class="accent-[#0082CB] w-4 h-4 rounded">
                            <span>Ijin Usaha</span>
                        </label>
                        
                        <!-- OPSI YANG LAIN + INPUT TEKS -->
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="checkbox_lainnya" name="kelengkapan_berkas[]" value="yang_lain" 
                                   {{ in_array('yang_lain', $selectedBerkas) ? 'checked' : '' }}
                                   class="accent-[#0082CB] w-4 h-4 rounded shrink-0">
                            <label for="checkbox_lainnya" class="cursor-pointer whitespace-nowrap text-sm">Yang Lain:</label>
                            <input type="text" id="input_lainnya" name="berkas_lainnya_detail" placeholder=""
                                   value="{{ $berkasLainnyaText }}"
                                   class="w-full border-b border-gray-300 px-1 py-0.5 text-sm focus:outline-none focus:border-[#0082CB] transition placeholder-gray-400">
                        </div>
                    </div>
                </div>

            </div>

            <!-- TOMBOL AKSI NAVIGASI -->
            <div class="flex justify-between items-center pt-2">
                <button type="reset" class="text-[#0A3370] text-sm font-semibold hover:underline transition focus:outline-none">
                    Kosongkan Form
                </button>

                <div class="flex items-center gap-3">  
                    <a href="{{ $backRoute }}" class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
                        Kembali
                    </a>

                    <button type="submit" 
                            class="bg-[#0082CB] text-[#FFFFFF] border-2 border-[#0082CB] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#006FB0] hover:border-[#006FB0] transition shadow-md flex items-center justify-center gap-2">
                        Berikutnya
                    </button>
                </div>
            </div>
        </form>
    </main>

    <footer class="text-center text-xs text-gray-500 pb-6">
        &copy; 2026 BPR Adipura Santosa | Surakarta.
    </footer>

<script>
    const inputLainnya = document.getElementById('input_lainnya');
    const checkboxLainnya = document.getElementById('checkbox_lainnya');
    const formPraSurvei = document.getElementById('formPraSurvei');

    // Jika user mengetik, otomatis centang checkbox "Yang Lain" dan hilangkan border merahnya
    inputLainnya.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            checkboxLainnya.checked = true;
            this.style.borderColor = '';
        } else {
            checkboxLainnya.checked = false;
        }
    });

    formPraSurvei.addEventListener('submit', function(event) {
        // Ambil elemen input teks yang terlihat di layar untuk validasi border merah
        const omsetUsaha = formPraSurvei.querySelector('input.input-rupiah[value*="omset_usaha"]') || formPraSurvei.querySelectorAll('input.input-rupiah')[0];
        const biayaOperasional = formPraSurvei.querySelectorAll('input.input-rupiah')[1];
        const penghasilanTambahan = formPraSurvei.querySelectorAll('input.input-rupiah')[2];
        const pengeluaranRT = formPraSurvei.querySelectorAll('input.input-rupiah')[3];
        const angsuranBank = formPraSurvei.querySelectorAll('input.input-rupiah')[4];
        const angsuranBPR = formPraSurvei.querySelectorAll('input.input-rupiah')[5];
        const deskripsiUsaha = formPraSurvei.querySelector('textarea[name="deskripsi_usaha"]');

        let isValid = true;
        let errorMessage = 'Mohon lengkapi semua pertanyaan yang bertanda (*)';

        // Kumpulkan semua field wajib ke dalam array
        const requiredInputs = [omsetUsaha, biayaOperasional, penghasilanTambahan, pengeluaranRT, angsuranBank, angsuranBPR, deskripsiUsaha];

        // Reset semua border merah terlebih dahulu
        requiredInputs.forEach(el => {
            if (el) el.style.borderColor = '';
        });
        if (inputLainnya) inputLainnya.style.borderColor = '';

        // Tambahkan event listener real-time agar border merah hilang saat mulai diketik/diisi
        requiredInputs.forEach(el => {
            if (el) {
                el.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = '';
                    }
                });
                // Untuk textarea atau input teks biasa
                el.addEventListener('change', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = '';
                    }
                });
            }
        });

        // 1. Validasi field utama yang wajib diisi
        requiredInputs.forEach(el => {
            if (!el || !el.value.trim()) {
                isValid = false;
                if (el) el.style.borderColor = 'red';
            }
        });

        // 2. Validasi khusus: Jika checkbox "Yang Lain" dicentang, pastikan kotak teksnya tidak kosong
        if (checkboxLainnya && checkboxLainnya.checked && inputLainnya.value.trim() === '') {
            isValid = false;
            inputLainnya.style.borderColor = 'red';
            errorMessage = 'Mohon lengkapi semua pertanyaan yang bertanda (*)';
        }

        // Jika ada yang belum valid, cegah submit dan tampilkan SweetAlert
        if (!isValid) {
            event.preventDefault(); 
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: errorMessage,
                confirmButtonText: 'OK',
                confirmButtonColor: '#0082CB',
                heightAuto: false,
                customClass: {
                    popup: 'swal2-tight-popup',
                    confirmButton: 'swal2-tight-btn'
                }
            });
        }
    });
</script>

<style>
    .swal2-popup.swal2-tight-popup {
        font-size: 0.65rem !important;
        width: 21rem !important;
        padding: 1rem 1.2rem !important;
        border-radius: 0.85rem !important;
        background: #ffffff !important;
        box-shadow: 0 8px 16px -3px rgba(0, 0, 0, 0.1) !important;
    }

    .swal2-popup.swal2-tight-popup .swal2-icon {
        margin: 0.6rem auto -0.2rem !important; 
        transform: scale(0.85);
    }

    .swal2-popup.swal2-tight-popup .swal2-title {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        color: #1f2937 !important;
        margin: 0 0 0.15rem !important;
        padding-top: 0 !important;
    }

    .swal2-popup.swal2-tight-popup .swal2-html-container {
        font-size: 0.95rem !important;
        color: #4b5563 !important;
        margin: 0.15rem 0 0.8rem !important;
    }

    .swal2-popup.swal2-tight-popup .swal2-actions {
        margin: 0.3rem auto 0 !important;
    }

    .swal2-popup.swal2-tight-popup .swal2-tight-btn {
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        padding: 0.4rem 1.4rem !important;
        border-radius: 0.5rem !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1) !important;
    }
</style>
</body>
</html>