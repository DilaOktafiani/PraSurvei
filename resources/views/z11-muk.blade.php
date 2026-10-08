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
                    <h2 class="text-2xl font-bold text-gray-800">Form Memo Usulan Kredit (MUK)</h2>
                    <p class="text-gray-500 mt-1 text-sm">Silakan masukkan data di bawah ini untuk melengkapi Memo Usulan Kredit (MUK) nasabah.</p>
                </div>
            </div>
            <p class="text-xs text-red-500 mt-4 font-medium flex items-center gap-1 border-t border-gray-100 pt-3">
                <span>*</span> Menunjukkan pertanyaan yang wajib diisi
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-red-500 font-bold mr-2">&#9888;</div>
                    <h3 class="text-sm font-bold text-red-800">Ada beberapa kesalahan pada inputan Anda:</h3>
                </div>
                <ul class="mt-2 list-disc list-inside text-xs text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeAlur11') }}" method="POST" class="space-y-6" novalidate>
            @csrf

            <!-- Hidden Input Debitur ID -->
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? session('debitur_id') }}">

            <!-- SPESIFIKASI JAMINAN KREDIT -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">SPESIFIKASI JAMINAN KREDIT</h3>
                
                <!-- Sertifikat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Sertifikat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="sertifikat" rows="2" placeholder="ex : SHM/ SHGB/ ..." required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('sertifikat', $data->sertifikat ?? '') }}</textarea>
                </div>

                <!-- Nomor/ NIB -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nomor/ NIB <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nomor_nib" value="{{ old('nomor_nib', $data->nomor_nib ?? '') }}" placeholder="ex : 8633" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Luas Tanah ( P x L ) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Luas Tanah ( P x L ) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="luas_tanah" value="{{ old('luas_tanah', $data->luas_tanah ?? '') }}" placeholder="ex : 16,08 m x 12 m = 193 m2" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Luas Bangunan ( Px L ) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Luas Bangunan ( Px L ) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="luas_bangunan" value="{{ old('luas_bangunan', $data->luas_bangunan ?? '') }}" placeholder="ex : 10 m x 5 m = 50 m2" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Lebar Depan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lebar Depan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lebar_depan" value="{{ old('lebar_depan', $data->lebar_depan ?? '') }}" placeholder="ex : 13 m" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- PBG -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        PBG <span class="text-red-500">*</span>
                    </label>
                    <textarea name="pbg" rows="2" placeholder="ex : Ada/ Tidak Ada/ Dalam Proses/ ..." required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('pbg', $data->pbg ?? '') }}</textarea>
                </div>

                <!-- Orientasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Orientasi <span class="text-red-500"></span>
                    </label>
                    <input type="text" name="orientasi" value="{{ old('orientasi', $data->orientasi ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>
            </div>

            <!-- JUMLAH RUANGAN -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">JUMLAH RUANGAN</h3>
                
                <!-- Kamar Tidur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kamar Tidur
                    </label>
                    <input type="text" name="kamar_tidur" value="{{ old('kamar_tidur', $data->kamar_tidur ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Ruang Keluarga -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ruang Keluarga
                    </label>
                    <input type="text" name="ruang_keluarga" value="{{ old('ruang_keluarga', $data->ruang_keluarga ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Ruang Tamu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ruang Tamu
                    </label>
                    <input type="text" name="ruang_tamu" value="{{ old('ruang_tamu', $data->ruang_tamu ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Kamar Pembantu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kamar Pembantu
                    </label>
                    <input type="text" name="kamar_pembantu" value="{{ old('kamar_pembantu', $data->kamar_pembantu ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Gudang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Gudang
                    </label>
                    <input type="text" name="gudang" value="{{ old('gudang', $data->gudang ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Garasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Garasi
                    </label>
                    <input type="text" name="garasi" value="{{ old('garasi', $data->garasi ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Kamar Mandi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kamar Mandi
                    </label>
                    <input type="text" name="kamar_mandi" value="{{ old('kamar_mandi', $data->kamar_mandi ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Ruang Makan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ruang Makan
                    </label>
                    <input type="text" name="ruang_makan" value="{{ old('ruang_makan', $data->ruang_makan ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Dapur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Dapur
                    </label>
                    <input type="text" name="dapur" value="{{ old('dapur', $data->dapur ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Taman/ Pekarangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Taman/ Pekarangan
                    </label>
                    <input type="text" name="pekarangan" value="{{ old('pekarangan', $data->pekarangan ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Carport -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Carport
                    </label>
                    <input type="text" name="carport" value="{{ old('carport', $data->carport ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Ruangan Lain -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ruangan Lain
                    </label>
                    <input type="text" name="ruangan_lain" value="{{ old('ruangan_lain', $data->ruangan_lain ?? '') }}" placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Fasilitas Lainnya -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Fasilitas Lainnya
                    </label>
                    <textarea name="fasilitas_lain" rows="2" placeholder="ex : Kolam renang, ruang belajar, ruang gym, AC, dll"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('fasilitas_lain', $data->fasilitas_lain ?? '') }}</textarea>
                </div>

            </div>

            <!-- KONDISI -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">KONDISI</h3>

                <!-- Kondisi Bangunan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kondisi Bangunan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kondisi_bangunan" value="{{ old('kondisi_bangunan', $data->kondisi_bangunan ?? '') }}" placeholder="ex : Batu bata/ Plester/ Aci/ Sudah Cat/ ..." required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Kondisi Lantai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kondisi Lantai <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kondisi_lantai" value="{{ old('kondisi_lantai', $data->kondisi_lantai ?? '') }}" placeholder="ex : Tanah/ plester/ Keramik/ Granit/ ..." required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Kondisi Plafon -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kondisi Plafon <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kondisi_plafon" value="{{ old('kondisi_plafon', $data->kondisi_plafon ?? '') }}" placeholder="ex : Gypsum/ Tidak ada Plafon/ ..." required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Bahan Atap -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Bahan Atap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bahan_atap" value="{{ old('bahan_atap', $data->bahan_atap ?? '') }}" placeholder="ex : Genteng/ Asbes/ Alumunium/ Gavalum/ ..." required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Struktur Atap -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Struktur Atap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="struktur_atap" value="{{ old('struktur_atap', $data->struktur_atap ?? '') }}" placeholder="ex : Kayu/ Baja Ringan/ ..." required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Listrik -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Listrik <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="listrik" value="{{ old('listrik', $data->listrik ?? '') }}" placeholder="ex : 4400 VA" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Air -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Air <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="air" value="{{ old('air', $data->air ?? '') }}" placeholder="ex : PAM/ Air Tanah" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
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
    // Validasi form MUK
    const formPraSurvei = document.getElementById('formPraSurvei');

    if (formPraSurvei) {
        formPraSurvei.addEventListener('submit', function(event) {
            let isValid = true;

            const errorMessage = 'Mohon lengkapi semua pertanyaan yang bertanda (*)';

            // Semua input, textarea, dan select yang memiliki required
            const requiredFields = formPraSurvei.querySelectorAll(
                'input[required], textarea[required], select[required]'
            );

            // Validasi seluruh field required
            requiredFields.forEach(function(field) {
                if (field.type === 'file') {
                    // Validasi file
                    if (field.files.length === 0) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                } else {
                    // Validasi input, textarea, dan select
                    if (field.value.trim() === '') {
                        isValid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                }
            });

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

                // Fokus ke field pertama yang belum diisi
                const firstEmptyField = formPraSurvei.querySelector(
                    'input[required]:invalid, textarea[required]:invalid, select[required]:invalid'
                );

                if (firstEmptyField) {
                    firstEmptyField.focus();
                }

                return;
            }

            // Jika semua valid, form dilanjutkan
            formPraSurvei.submit();
        });
    }
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