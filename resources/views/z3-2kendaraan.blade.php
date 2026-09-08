<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Credit Analys - PT BPR Adipura Santosa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <h2 class="text-2xl font-bold text-gray-800">Form Credit Analys</h2>
                    <p class="text-gray-500 mt-1 text-sm">Silakan masukkan hasil analisis lapangan untuk penentuan kelayakan akhir nasabah.</p>
                </div>
            </div>
            <p class="text-xs text-red-500 mt-4 font-medium flex items-center gap-1 border-t border-gray-100 pt-3">
                <span>*</span> Menunjukkan pertanyaan yang wajib diisi
            </p>
        </div>

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeAlur3-2') }}" method="POST" class="space-y-6">
            @csrf <!-- Security Token Laravel -->
            
            <!-- INPUT HIDDEN UNTUK DEBITUR_ID -->
            <input type="hidden" name="debitur_id" value="{{ $debitur_id ?? old('debitur_id') }}">

            <!-- BLOK PUTIH 1: SPESIFIKASI JAMINAN KENDARAAN -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">JAMINAN KENDARAAN</h3>
                 
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Spesifikasi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="spesifikasi" id="spesifikasi" rows="4" placeholder="ex :&#10;Toyota Innova Zenix Hybrid 2026 AT AD1234UA Hitam Noka 12345678 Nosin 87654321 an. Bobby (Nama Orang Lain)&#10;apabila milik PT maka harus dilengkapi surat pelepasan"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB] transition">{{ $data->spesifikasi ?? old('spesifikasi') }}</textarea>
                </div>
            </div>

            <!-- BLOK PUTIH 2: STATUS KEPEMILIKAN -->
            @php
                $valStatus = $data->status_kepemilikan ?? old('status_kepemilikan');
                $isLainnya = !in_array($valStatus, ['miliksendiri', 'milikkeluarga', 'barangdagangan']) && !empty($valStatus);
            @endphp
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status Kepemilikan <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 text-sm text-gray-700">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status_kepemilikan" value="miliksendiri" {{ $valStatus == 'miliksendiri' ? 'checked' : '' }} class="accent-[#0082CB]">
                            <span>Milik Sendiri</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status_kepemilikan" value="milikkeluarga" {{ $valStatus == 'milikkeluarga' ? 'checked' : '' }} class="accent-[#0082CB]">
                            <span>Milik Keluarga</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status_kepemilikan" value="barangdagangan" {{ $valStatus == 'barangdagangan' ? 'checked' : '' }} class="accent-[#0082CB]">
                            <span>Barang Dagangan</span>
                        </label>
                        
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="status_kepemilikan" value="yang_lain" id="radio_lainnya" {{ $isLainnya ? 'checked' : '' }} class="accent-[#0082CB]">
                                <label for="radio_lainnya" class="cursor-pointer whitespace-nowrap text-sm">Yang Lain:</label>
                                <input type="text" id="input_lainnya" name="status_kepemilikan_lainnya" value="{{ $isLainnya ? $valStatus : old('status_kepemilikan_lainnya') }}" placeholder=""
                                       class="w-full border-b border-gray-300 px-1 py-0.5 text-sm focus:outline-none focus:border-[#0082CB] transition">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BLOK PUTIH 3: HARGA TAKSASI -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga Taksasi <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="harga_taksasi" id="harga_taksasi" value="{{ $data->harga_taksasi ?? old('harga_taksasi') }}" placeholder="ex : 100000000"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB] transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga Taksasi Sumber Lain
                    </label>
                    <input type="text" name="harga_taksasi_sumber_lain" id="harga_taksasi_sumber_lain" value="{{ $data->harga_taksasi_sumber_lain ?? old('harga_taksasi_sumber_lain') }}" placeholder="ex : 125000000 dari OLX"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB] transition">
                </div>
            </div>

            <!-- TOMBOL AKSI NAVIGASI -->
            <div class="flex justify-between items-center pt-2">
                <button type="reset" 
                        class="text-[#0A3370] text-sm font-semibold hover:underline transition focus:outline-none">
                    Kosongkan Form
                </button>
                <div class="flex items-center gap-3">  
                    <a href="{{ $backRoute }}" 
                            class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
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
    const radioLainnya = document.getElementById('radio_lainnya');
    const spesifikasi = document.getElementById('spesifikasi');
    const hargaTaksasi = document.getElementById('harga_taksasi');

    // Jika user mengetik, otomatis pilih radio "Yang Lain"
    inputLainnya.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            radioLainnya.checked = true;
        }
    });

    const formPraSurvei = document.getElementById('formPraSurvei');
    formPraSurvei.addEventListener('submit', function(event) {
        const selectedStatus = formPraSurvei.querySelector('input[name="status_kepemilikan"]:checked');
        let isValid = true;
        let errorMessage = 'Mohon lengkapi semua pertanyaan yang bertanda (*)';

        // 1. Validasi Spesifikasi (Wajib)
        if (!spesifikasi.value.trim()) {
            isValid = false;
        }
        // 2. Validasi Status Kepemilikan Radio terpilih (Wajib)
        else if (!selectedStatus) {
            isValid = false;
        }
        // 3. Validasi "Yang Lain" jika radio terpilih tapi input teks kosong
        else if (selectedStatus.value === 'yang_lain' && inputLainnya.value.trim() === '') {
            isValid = false;
        }
        // 4. Validasi Harga Taksasi (Wajib)
        else if (!hargaTaksasi.value.trim()) {
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Batalkan submit form agar popup muncul
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
        // Jika valid, biarkan form melakukan submit secara normal tanpa preventDefault()
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