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
        <form id="formPraSurvei" action="{{ route('storeAlur9') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf 
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? session('debitur_id') }}">
            <input type="hidden" name="urutan" id="input_urutan" value="{{ $urutan }}">

            <!-- KOTAK 1 -->
            <!-- Lokasi dan Foto Tempat Usaha -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 id="judulPinjaman" class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">
                    LOKASI & FOTO TEMPAT USAHA {{ $urutan }}
                </h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Usaha <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $data->nama_usaha ?? '') }}" placeholder="ex : Warung Makan Ayam Geprek" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>
            </div>

            <!-- KOTAK 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">

                <!-- Gambar Google Maps -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Gambar Google Maps <span class="text-red-500">*</span>
                    </label>
                    <div id="container_file_google_maps" class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        
                        <input type="file" id="file_google_maps" name="google_maps" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" onchange="handleFileSelect(this)"
                            {{ isset($data->google_maps) && $data->google_maps ? '' : 'required' }}
                            data-has-file="{{ isset($data->google_maps) && $data->google_maps ? 'true' : 'false' }}">

                        <button type="button" onclick="document.getElementById('file_google_maps').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload_google_maps">
                                {{ isset($data->google_maps) && $data->google_maps ? 'Ganti file' : 'Tambahkan file' }}
                            </span>
                        </button>

                        @if(isset($data->google_maps) && $data->google_maps)
                            <div id="file_preview_google_maps" class="mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_google_maps" class="truncate font-medium">{{ basename($data->google_maps) }}</span>
                                <button type="button" onclick="removeFileGoogleMaps()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @else
                            <div id="file_preview_google_maps" class="hidden mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_google_maps" class="truncate font-medium"></span>
                                <button type="button" onclick="removeFileGoogleMaps()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- KOTAK 3 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <!-- Link Share Location -->
                <div>
                    <label for="share_location" class="block text-sm font-medium text-gray-700 mb-1">
                        Share Location <span class="text-red-500">*</span>
                    </label>
                    <p id="share_location_help" class="text-xs text-gray-500 mb-1.5">Wajib diisi link Google Maps</p>
                    
                    <input type="url" id="share_location" name="share_location" value="{{ old('share_location', $data->share_location ?? '') }}" placeholder="ex : https://maps.app.goo.gl/6eNyKi1gtgXwXBo9A"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" aria-describedby="share_location_help" required>
                </div>
            </div>

            <!-- KOTAK 4 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <!-- Kode QR Maps -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kode QR Maps <span class="text-red-500">*</span>
                    </label>
                    <div id="container_file_kode_qr" class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        
                        <!-- PERBAIKAN DI SINI: Ubah ke handleFileSelectKodeQr(this) -->
                        <input type="file" id="file_kode_qr" name="kode_qr" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" onchange="handleFileSelectKodeQr(this)"
                            {{ isset($data->kode_qr) && $data->kode_qr ? '' : 'required' }}
                            data-has-file="{{ isset($data->kode_qr) && $data->kode_qr ? 'true' : 'false' }}">

                        <button type="button" onclick="document.getElementById('file_kode_qr').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload_kode_qr">
                                {{ isset($data->kode_qr) && $data->kode_qr ? 'Ganti file' : 'Tambahkan file' }}
                            </span>
                        </button>

                        @if(isset($data->kode_qr) && $data->kode_qr)
                            <div id="file_preview_kode_qr" class="mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_kode_qr" class="truncate font-medium">{{ basename($data->kode_qr) }}</span>
                                <button type="button" onclick="removeFileKodeQr()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @else
                            <div id="file_preview_kode_qr" class="hidden mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_kode_qr" class="truncate font-medium"></span>
                                <button type="button" onclick="removeFileKodeQr()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- KOTAK 5 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <!-- Foto Usaha -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Foto Usaha <span class="text-red-500">*</span>
                    </label>
                    <div id="container_file_foto_usaha" class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload maksimal 50 file pendukung: PDF, drawing, atau image. Maks 10 MB per file.</p>
                        
                        <input type="file" id="file_foto_usaha" name="foto_usaha[]" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" multiple onchange="handleFileSelectFotoUsaha(this)"
                            {{ isset($data->foto_usaha) && $data->foto_usaha ? '' : 'required' }}
                            data-has-file="{{ isset($data->foto_usaha) && $data->foto_usaha ? 'true' : 'false' }}">

                        <!-- Tombol dengan teks "Tambahkan file" meskipun data sudah ada -->
                        <button type="button" onclick="document.getElementById('file_foto_usaha').click()" 
                            class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload_foto_usaha">
                                Tambahkan file
                            </span>
                        </button>

                        @if(isset($data->foto_usaha) && $data->foto_usaha)
                            <div id="file_preview_foto_usaha" class="mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-md">
                                <span id="file_name_foto_usaha" class="truncate font-medium">
                                    {{ is_array(json_decode($data->foto_usaha, true)) ? count(json_decode($data->foto_usaha, true)) . ' file dipilih' : basename($data->foto_usaha) }}
                                </span>
                                <button type="button" onclick="removeFileFotoUsaha()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @else
                            <div id="file_preview_foto_usaha" class="hidden mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-md">
                                <span id="file_name_foto_usaha" class="truncate font-medium"></span>
                                <button type="button" onclick="removeFileFotoUsaha()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- KOTAK 6 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <!-- Apakah ada Usaha Lain -->
                <div id="containerOpsiLanjut"
                    class="{{ $urutan >= 20 ? 'hidden' : '' }}">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Apakah ada Usaha Lain? <span class="text-red-500">*</span>
                    </label>

                    <div class="space-y-3 text-sm text-gray-700">

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio"
                                name="apakah_ada_usaha_lain"
                                value="YA"
                                {{ old('apakah_ada_usaha_lain', $data->apakah_ada_usaha_lain ?? '') === 'YA' ? 'checked' : '' }}
                                class="accent-[#0082CB]">
                            <span>YA</span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio"
                                name="apakah_ada_usaha_lain"
                                value="TIDAK ADA"
                                {{ old('apakah_ada_usaha_lain', $data->apakah_ada_usaha_lain ?? '') === 'TIDAK ADA' ? 'checked' : '' }}
                                class="accent-[#0082CB]">
                            <span>TIDAK ADA</span>
                        </label>

                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="flex justify-between items-center pt-2">
                <button type="button" class="text-[#0A3370] text-sm font-semibold hover:underline transition focus:outline-none" onclick="prosesKosongkanForm()">
                    Kosongkan Form
                </button>
                <div class="flex items-center gap-3">  
                    <button type="button" onclick="keHalamanSebelumnya()"
                            class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
                        Kembali
                    </button>
                    <button type="submit" 
                            class="bg-[#0082CB] text-[#FFFFFF] border-2 border-[#0082CB] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#006FB0] transition shadow-md flex items-center justify-center gap-2">
                        Berikutnya
                    </button>
                </div>
            </div>
        </form>
    </main>

    <!-- FOOTER -->
    <footer class="text-center text-xs text-gray-500 pb-6">
        &copy; 2026 BPR Adipura Santosa | Surakarta.
    </footer>

<script>
    const currentUrutan = {{ $urutan }};
    const maksimalHalaman = 10; // Maksimal 10 halaman usaha

    function keHalamanSebelumnya() {
        if (currentUrutan > 1) {
            window.location.href = "{{ route('z9-muk') }}?urutan=" + (currentUrutan - 1);
        } else {
            window.location.href = "{{ route('z8-muk') }}";
        }
    }

    // ==========================================
    // 1. GOOGLE MAPS FILE FUNCTIONS
    // ==========================================
    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxSize = 10 * 1024 * 1024; // 10 MB

            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file maksimal 10 MB.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0082CB',
                    heightAuto: false
                });
                input.value = '';
                return;
            }

            const fileName = file.name;
            document.getElementById('file_name_google_maps').textContent = fileName;
            document.getElementById('file_preview_google_maps').classList.remove('hidden');
            document.getElementById('txt_btn_upload_google_maps').textContent = 'Ganti file';
            input.setAttribute('data-has-file', 'true');
        }
    }

    function removeFileGoogleMaps() {
        const input = document.getElementById('file_google_maps');
        input.value = '';
        document.getElementById('file_preview_google_maps').classList.add('hidden');
        document.getElementById('txt_btn_upload_google_maps').textContent = 'Tambahkan file';
        input.setAttribute('data-has-file', 'false');
    }

    // ==========================================
    // 2. KODE QR FILE FUNCTIONS
    // ==========================================
    function handleFileSelectKodeQr(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxSize = 10 * 1024 * 1024; // 10 MB

            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file maksimal 10 MB.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0082CB',
                    heightAuto: false
                });
                input.value = '';
                return;
            }

            const fileName = file.name;
            document.getElementById('file_name_kode_qr').textContent = fileName;
            document.getElementById('file_preview_kode_qr').classList.remove('hidden');
            document.getElementById('txt_btn_upload_kode_qr').textContent = 'Ganti file';
            input.setAttribute('data-has-file', 'true');
        }
    }

    function removeFileKodeQr() {
        const input = document.getElementById('file_kode_qr');
        input.value = '';
        document.getElementById('file_preview_kode_qr').classList.add('hidden');
        document.getElementById('txt_btn_upload_kode_qr').textContent = 'Tambahkan file';
        input.setAttribute('data-has-file', 'false');
    }

    // ==========================================
    // 3. FOTO USAHA FILE FUNCTIONS (Multi-file max 50)
    // ==========================================
    let dtFotoUsaha = new DataTransfer();

    function handleFileSelectFotoUsaha(input) {
        if (input.files && input.files.length > 0) {
            const maxSize = 10 * 1024 * 1024; // 10 MB per file

            for (let i = 0; i < input.files.length; i++) {
                if (input.files[i].size > maxSize) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'File Terlalu Besar',
                        text: `File "${input.files[i].name}" melebihi ukuran maksimal 10 MB.`,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#0082CB',
                        heightAuto: false
                    });
                    return;
                }
                dtFotoUsaha.items.add(input.files[i]);
            }

            if (dtFotoUsaha.files.length > 50) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Total file tidak boleh lebih dari 50.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0082CB',
                    heightAuto: false
                });
                dtFotoUsaha = new DataTransfer(); // Reset
                input.value = '';
                return;
            }

            input.files = dtFotoUsaha.files;
            const fileCount = dtFotoUsaha.files.length;

            document.getElementById('file_name_foto_usaha').textContent = `${fileCount} file dipilih`;
            document.getElementById('file_preview_foto_usaha').classList.remove('hidden');
            input.setAttribute('data-has-file', 'true');
        }
    }

    function removeFileFotoUsaha() {
        const input = document.getElementById('file_foto_usaha');
        dtFotoUsaha = new DataTransfer();
        input.value = '';
        
        document.getElementById('file_preview_foto_usaha').classList.add('hidden');
        document.getElementById('txt_btn_upload_foto_usaha').textContent = 'Tambahkan file';
        input.setAttribute('data-has-file', 'false');
    }

    // ==========================================
    // 4. ATUR PILIHAN USAHA LAIN (1-9 MUNCUL, 10 HILANG)
    // ==========================================
    document.addEventListener("DOMContentLoaded", function() {
        const containerOpsiLanjut = document.getElementById('containerOpsiLanjut');

        if (containerOpsiLanjut) {
            if (currentUrutan >= maksimalHalaman) {
                containerOpsiLanjut.classList.add('hidden');
                containerOpsiLanjut.querySelectorAll('input[type="radio"]').forEach(radio => {
                    radio.checked = false;
                    radio.disabled = true;
                });
            } else {
                containerOpsiLanjut.classList.remove('hidden');
                containerOpsiLanjut.querySelectorAll('input[type="radio"]').forEach(radio => {
                    radio.disabled = false;
                });
            }
        }
    });

    // ==========================================
    // 5. VALIDASI SUBMIT FORM DENGAN SWEETALERT
    // ==========================================
    const formPraSurvei = document.getElementById('formPraSurvei') || document.querySelector('form');

    if (formPraSurvei) {
        formPraSurvei.addEventListener('submit', function(event) {
            let isValid = true;
            const requiredFields = formPraSurvei.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (field.type === 'file') {
                    const hasFileOnServer = field.getAttribute('data-has-file') === 'true';
                    const hasNewFileUploaded = field.files && field.files.length > 0;

                    if (!hasFileOnServer && !hasNewFileUploaded) {
                        isValid = false;
                    }
                } else if (field.type === 'radio') {
                    // Validasi radio khusus halaman 1-9
                    if (currentUrutan < maksimalHalaman) {
                        const radioGroup = formPraSurvei.querySelectorAll(`input[name="${field.name}"]`);
                        const isChecked = Array.from(radioGroup).some(r => r.checked);
                        if (!isChecked) {
                            isValid = false;
                        }
                    }
                } else {
                    if (!field.value || !field.value.trim()) {
                        isValid = false;
                    }
                }
            });

            // Validasi tambahan untuk radio "apakah_ada_usaha_lain" di halaman < 10
            if (currentUrutan < maksimalHalaman) {
                const radioUsahaLain = formPraSurvei.querySelectorAll('input[name="apakah_ada_usaha_lain"]');
                if (radioUsahaLain.length > 0) {
                    const selected = formPraSurvei.querySelector('input[name="apakah_ada_usaha_lain"]:checked');
                    if (!selected) {
                        isValid = false;
                    }
                }
            }

            if (!isValid) {
                event.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Mohon lengkapi semua pertanyaan yang bertanda (*)',
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