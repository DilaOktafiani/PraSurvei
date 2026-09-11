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
                    <h2 class="text-2xl font-bold text-gray-800">Formulir Pra-Survei AO</h2>
                    <p class="text-gray-500 mt-1 text-sm">Silakan masukkan data awal calon nasabah hasil kunjungan lapangan secara akurat.</p>
                </div>
            </div>
            <p class="text-xs text-red-500 mt-4 font-medium flex items-center gap-1 border-t border-gray-100 pt-3">
                <span>*</span> Menunjukkan pertanyaan yang wajib diisi
            </p>
        </div>

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeStep6-1') }}" method="POST" class="space-y-6">
            @csrf 
            
            <!-- Hidden input untuk relasi Debitur (Didukung Object, Session, dan Old Input) -->
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? session('debitur_id') ?? old('debitur_id') }}">

            <!-- DATA SLIK -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">DATA SLIK</h3>
                <p class="text-xs text-gray-500 mt-0.5">Isikan Data Hasil SLIK OJK</p>

                <!-- Apakah Debitur Memiliki Pinjaman -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Apakah Debitur Memiliki Pinjaman <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 text-sm text-gray-700">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="apakah_debitur_memiliki_pinjaman" value="YA" {{ (old('apakah_debitur_memiliki_pinjaman', $dataSlik->apakah_debitur_memiliki_pinjaman ?? '') == 'YA') ? 'checked' : '' }} class="accent-[#0082CB]">
                            <span>YA</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="apakah_debitur_memiliki_pinjaman" value="TIDAK ADA" {{ (old('apakah_debitur_memiliki_pinjaman', $dataSlik->apakah_debitur_memiliki_pinjaman ?? '') == 'TIDAK ADA') ? 'checked' : '' }} class="accent-[#0082CB]">
                            <span>TIDAK ADA</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI NAVIGASI -->
            <div class="flex justify-between items-center pt-2">
                <button type="reset" class="text-[#0A3370] text-sm font-semibold hover:underline transition focus:outline-none">
                    Kosongkan Form
                </button>

                <div class="flex items-center gap-3">  
                    <a href="{{ route('5infousaha') }}" class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
                        Kembali
                    </a>

                    <button type="submit" class="bg-[#0082CB] text-[#FFFFFF] border-2 border-[#0082CB] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#006FB0] hover:border-[#006FB0] transition shadow-md flex items-center justify-center gap-2">
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
    const formPraSurvei = document.getElementById('formPraSurvei');
    
    // Tambahkan event listener untuk menghapus border merah secara real-time saat salah satu radio dipilih
    const radioPinjaman = formPraSurvei.querySelectorAll('input[name="apakah_debitur_memiliki_pinjaman"]');
    const containerPinjaman = formPraSurvei.querySelector('input[name="apakah_debitur_memiliki_pinjaman"]')?.closest('.mb-4, .form-group, div');

    radioPinjaman.forEach(radio => {
        radio.addEventListener('change', function() {
            if (containerPinjaman) {
                containerPinjaman.style.border = '';
                containerPinjaman.style.padding = '';
                containerPinjaman.style.borderRadius = '';
            }
        });
    });

    formPraSurvei.addEventListener('submit', function(event) {
        const selectedPinjaman = formPraSurvei.querySelector('input[name="apakah_debitur_memiliki_pinjaman"]:checked');
        let isValid = true;
        let errorMessage = 'Mohon lengkapi semua pertanyaan yang bertanda (*)';

        // Reset border merah container terlebih dahulu
        if (containerPinjaman) {
            containerPinjaman.style.border = '';
            containerPinjaman.style.padding = '';
            containerPinjaman.style.borderRadius = '';
        }

        // Validasi radio button "Apakah Debitur Memiliki Pinjaman"
        if (!selectedPinjaman) {
            isValid = false;
            if (containerPinjaman) {
                containerPinjaman.style.border = '1px solid red';
                containerPinjaman.style.borderRadius = '4px';
                containerPinjaman.style.padding = '8px';
            }
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