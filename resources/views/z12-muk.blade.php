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
        <form id="formPraSurvei" action="{{ route('storeAlur12') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf <!-- Security Token Laravel -->

            <!-- Hidden Input Debitur ID (Wajib agar terhubung dengan tabel debitur) -->
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? session('debitur_id') }}">

            <!-- DENAH JAMINAN -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">DENAH JAMINAN</h3>

                <!-- Denah Jaminan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Denah Jaminan <span class="text-red-500">*</span>
                    </label>
                    <div class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        
                        <!-- Input File -->
                        <input type="file" id="file_denah_jaminan" name="denah_jaminan" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" onchange="handleFileSelect(this)"
                            data-has-file="{{ isset($data->denah_jaminan) && $data->denah_jaminan ? 'true' : 'false' }}">

                        <!-- Tombol Pilih File -->
                        <button type="button" onclick="document.getElementById('file_denah_jaminan').click()" 
                            class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload">
                                {{ isset($data->denah_jaminan) && $data->denah_jaminan ? 'Ganti file' : 'Tambahkan file' }}
                            </span>
                        </button>

                        <!-- Preview File -->
                        <div id="file_preview" class="{{ isset($data->denah_jaminan) && $data->denah_jaminan ? '' : 'hidden' }} mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                            <span id="file_name" class="truncate font-medium">
                                {{ isset($data->denah_jaminan) && $data->denah_jaminan ? basename($data->denah_jaminan) : '' }}
                            </span>
                            <button type="button" onclick="removeFile()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                        </div>
                    </div>
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
    // =========================================================
    // HANDLE PILIH FILE
    // =========================================================
    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxSize = 10 * 1024 * 1024; // 10 MB

            // Validasi Ukuran
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ukuran File Terlalu Besar',
                    text: 'Ukuran file Denah Jaminan maksimal 10 MB.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0082CB',
                    heightAuto: false
                });
                input.value = '';
                return;
            }

            // Validasi Ekstensi
            const allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'dwg'];
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Format File Tidak Didukung',
                    text: 'Denah Jaminan hanya dapat berupa PDF, JPG, JPEG, PNG, atau DWG.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0082CB',
                    heightAuto: false
                });
                input.value = '';
                return;
            }

            // Tampilkan nama file di preview
            document.getElementById('file_name').textContent = fileName;

            // Munculkan kotak preview
            document.getElementById('file_preview').classList.remove('hidden');

            // Ubah teks tombol jadi "Ganti file"
            document.getElementById('txt_btn_upload').textContent = 'Ganti file';

            // Tandai bahwa file baru sudah dipilih
            input.setAttribute('data-has-file', 'true');
        }
    }

    // =========================================================
    // HAPUS FILE
    // =========================================================
    function removeFile() {
        const fileInput = document.getElementById('file_denah_jaminan');

        // Kosongkan nilai input file
        fileInput.value = '';
        fileInput.setAttribute('data-has-file', 'false');

        // Kosongkan nama file dan sembunyikan preview
        document.getElementById('file_name').textContent = '';
        document.getElementById('file_preview').classList.add('hidden');

        // Kembalikan teks tombol
        document.getElementById('txt_btn_upload').textContent = 'Tambahkan file';
    }

    // =========================================================
    // VALIDASI SAAT SUBMIT FORM
    // =========================================================
    const formPraSurvei = document.getElementById('formPraSurvei');

    if (formPraSurvei) {
        formPraSurvei.addEventListener('submit', function(event) {
            event.preventDefault();

            const fileInput = document.getElementById('file_denah_jaminan');
            const hasNewFile = fileInput.files && fileInput.files.length > 0;
            const hasOldFile = fileInput.getAttribute('data-has-file') === 'true';

            let isValid = true;

            // Jika belum ada file baru dan tidak ada file lama
            if (!hasNewFile && !hasOldFile) {
                isValid = false;
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Mohon upload Denah Jaminan terlebih dahulu.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0082CB',
                    heightAuto: false,
                    customClass: {
                        popup: 'swal2-tight-popup',
                        confirmButton: 'swal2-tight-btn'
                    }
                });
            }

            if (isValid) {
                formPraSurvei.submit();
            }
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