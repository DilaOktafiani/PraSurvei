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
        <form id="formPraSurvei" action="{{ route('storeAlur3') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf

            <!-- Input tersembunyi untuk debitur_id -->
            <input type="hidden" name="debitur_id" value="{{ session('debitur_id') ?? ($debitur->id ?? '') }}">

            <!-- KOTAK 1: 1. GAMBARAN PEKERJAAN DEBITUR -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">C. INFORMASI MENGENAI USAHA</h3>
                
                <div class="pt-2 pb-1">
                    <h4 class="text-base font-bold text-gray-700">1. Gambaran Pekerjaan Debitur</h4>
                </div>

                <!-- Gambaran Pekerjaan Debitur 1-->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Gambaran Pekerjaan Debitur 1<span class="text-red-500">*</span>
                    </label>
                    <textarea id="gambaran_pekerjaan_debitur" name="gambaran_pekerjaan_debitur" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('gambaran_pekerjaan_debitur', $infoUtama->gambaran_pekerjaan_debitur ?? '') }}</textarea>
                </div>

                <!-- Perhitungan Omset Usaha 1-->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Perhitungan Omset Usaha 1<span class="text-red-500">*</span></label>
                    <div class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        <input type="file" id="file_omset" name="perhitungan_omset_usaha" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" onchange="handleFileSelect(this, 'name_omset', 'preview_omset', 'btn_omset')" {{ isset($infoUtama->perhitungan_omset_usaha) && $infoUtama->perhitungan_omset_usaha ? '' : 'required' }}>
                        
                        <button type="button" onclick="document.getElementById('file_omset').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="btn_omset">{{ isset($infoUtama->perhitungan_omset_usaha) && $infoUtama->perhitungan_omset_usaha ? 'Ganti file' : 'Tambahkan file' }}</span>
                        </button>

                        <div id="preview_omset" class="{{ isset($infoUtama->perhitungan_omset_usaha) && $infoUtama->perhitungan_omset_usaha ? '' : 'hidden' }} mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                            <span id="name_omset" class="truncate font-medium">{{ isset($infoUtama->perhitungan_omset_usaha) ? basename($infoUtama->perhitungan_omset_usaha) : '' }}</span>
                            <button type="button" onclick="removeFile('file_omset', 'preview_omset', 'btn_omset')" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                        </div>
                    </div>
                </div>

                <!-- CONTAINER UNTUK USAHA TAMBAHAN (2 sampai 10) -->
                <div id="additional-businesses-container" class="space-y-6"></div>

                <!-- TOMBOL TAMBAH USAHA -->
                <div class="pt-2">
                    <button type="button" id="btn-tambah-usaha" onclick="tambahUsahaBaru()" 
                            class="bg-[#0082CB] text-[#FFFFFF] border-2 border-[#0082CB] px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#006FB0] hover:border-[#006FB0] transition shadow-md flex items-center justify-center gap-2">
                        <span>+ Tambah Usaha</span>
                    </button>
                </div>
            </div>

            <!-- KOTAK 2: 2. USAHA PENDUKUNG LAIN -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <div class="pb-1">
                    <h4 class="text-base font-bold text-gray-700">2. Usaha Pendukung Lain</h4>
                </div>

                <!-- Usaha Pendukung Lain -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Usaha Pendukung Lain <span class="text-red-500"></span>
                    </label>
                    <textarea id="usaha_pendukung" name="usaha_pendukung" rows="6"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('usaha_pendukung', $infoUtama->usaha_pendukung ?? '') }}</textarea>
                </div>

                <!-- Perhitungan Omset Usaha Pendukung 1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Perhitungan Omset Usaha Pendukung <span class="text-red-500"></span></label>
                    <div class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        
                        <input type="file" id="file_omset_pendukung" name="perhitungan_omset_pendukung" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" onchange="handleFileSelect(this, 'name_omset_pendukung', 'preview_omset_pendukung', 'btn_omset_pendukung')">
                        
                        <button type="button" onclick="document.getElementById('file_omset_pendukung').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <!-- Diubah dari $data menjadi $infoUtama -->
                            <span id="btn_omset_pendukung">
                                {{ isset($infoUtama->perhitungan_omset_pendukung) && $infoUtama->perhitungan_omset_pendukung ? 'Ganti file' : 'Tambahkan file' }}
                            </span>
                        </button>

                        <!-- Diubah dari $data menjadi $infoUtama -->
                        <div id="preview_omset_pendukung" class="{{ isset($infoUtama->perhitungan_omset_pendukung) && $infoUtama->perhitungan_omset_pendukung ? '' : 'hidden' }} mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                            <span id="name_omset_pendukung" class="truncate font-medium">{{ isset($infoUtama->perhitungan_omset_pendukung) ? basename($infoUtama->perhitungan_omset_pendukung) : '' }}</span>
                            <button type="button" onclick="removeFile('file_omset_pendukung', 'preview_omset_pendukung', 'btn_omset_pendukung')" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
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
                    <a href="{{ $backRoute ?? '#' }}" 
                            class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
                        Kembali
                    </a>
                    <button type="button" onclick="validateAndSubmit()" 
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
    // Fungsi untuk menangani pemilihan file
    function handleFileSelect(input, spanId, previewId, btnId) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const previewDiv = document.getElementById(previewId);
            const fileNameSpan = document.getElementById(spanId);
            const btnText = document.getElementById(btnId);

            // Validasi ukuran maksimal 10 MB
            if (input.files[0].size > 10 * 1024 * 1024) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ukuran File Terlalu Besar',
                    text: 'Ukuran file maksimal 10 MB.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0082CB',
                    heightAuto: false
                });

                input.value = '';
                if (previewDiv) previewDiv.classList.add('hidden');
                if (btnText) btnText.textContent = 'Tambahkan file';
                return;
            }

            if (fileNameSpan) fileNameSpan.textContent = fileName;
            if (previewDiv) previewDiv.classList.remove('hidden');
            if (btnText) btnText.textContent = 'Ganti file';
        }
    }

    // Fungsi untuk menghapus file yang dipilih
    function removeFile(inputId, previewId, btnId) {
        const input = document.getElementById(inputId);
        const previewDiv = document.getElementById(previewId);
        const btnText = document.getElementById(btnId);

        if (input) input.value = '';
        
        if (previewDiv) {
            const fileNameSpan = previewDiv.querySelector('span');
            if (fileNameSpan) fileNameSpan.textContent = '';
            previewDiv.classList.add('hidden');
        }
        
        if (btnText) btnText.textContent = 'Tambahkan file';
    }

    // Counter untuk usaha tambahan
    let usahaCount = 1;
    const maxUsaha = 10;

    // Fungsi untuk menambah usaha secara dinamis (ditambahkan parameter opsional untuk data lama)
    function tambahUsahaBaru(savedPekerjaan = '', savedFile = '') {
        if (usahaCount >= maxUsaha) {
            Swal.fire({
                icon: 'info',
                title: 'Batas Maksimal',
                text: 'Maksimal penambahan adalah hingga 10 usaha.',
                confirmButtonColor: '#0082CB',
                heightAuto: false
            });
            return;
        }

        usahaCount++;
        const container = document.getElementById('additional-businesses-container');

        const wrapper = document.createElement('div');
        wrapper.className = "bg-gray-50/50 rounded-lg border border-dashed border-gray-300 p-4 space-y-4 relative dynamic-usaha-item mt-4";
        wrapper.setAttribute('data-index', usahaCount);

        // Jika ada file lama, atur teks tombol dan tampilkan preview nama file-nya
        let btnTextLabel = 'Tambahkan file';
        let previewClass = 'hidden';
        if (savedFile) {
            // Mengambil nama file saja dari path storage (misal: 'informasi_usaha/abc.pdf' jadi 'abc.pdf')
            savedFile = savedFile.split('/').pop(); 
            btnTextLabel = 'Ganti file';
            previewClass = 'mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm';
        }

        wrapper.innerHTML = `
            <div class="flex items-center justify-between border-b pb-2 mb-2">
                <h4 class="text-base font-bold text-gray-700">Gambaran Pekerjaan Debitur ${usahaCount}</h4>
                <button type="button" onclick="hapusUsahaItem(this)" class="text-red-500 hover:text-red-700 text-xs font-semibold px-2.5 py-1 bg-red-50 rounded border border-red-200 transition">Hapus Usaha Ini</button>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Gambaran Pekerjaan Debitur ${usahaCount}
                </label>
                <textarea name="gambaran_pekerjaan_debitur_${usahaCount}" rows="6"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">${savedPekerjaan}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Perhitungan Omset Usaha ${usahaCount}</label>
                <div class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm bg-white">
                    <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                    <input type="file" id="file_omset_${usahaCount}" name="perhitungan_omset_usaha_${usahaCount}" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" onchange="handleFileSelect(this, 'name_omset_${usahaCount}', 'preview_omset_${usahaCount}', 'btn_omset_${usahaCount}')">
                    
                    <button type="button" onclick="document.getElementById('file_omset_${usahaCount}').click()" 
                            class="bg-white text-[#0082CB] border border-gray-300 px-4 py-2 rounded-md text-sm font-semibold hover:bg-[#006FB0] hover:border-[#006FB0] transition shadow-sm inline-flex items-center gap-2">
                        <span id="btn_omset_${usahaCount}">${btnTextLabel}</span>
                    </button>

                    <div id="preview_omset_${usahaCount}" class="${previewClass}">
                        <span id="name_omset_${usahaCount}" class="truncate font-medium">${savedFile}</span>
                        <button type="button" onclick="removeFile('file_omset_${usahaCount}', 'preview_omset_${usahaCount}', 'btn_omset_${usahaCount}')" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                    </div>
                </div>
            </div>
        `;

        container.appendChild(wrapper);

        if (usahaCount >= maxUsaha) {
            const btnTambah = document.getElementById('btn-tambah-usaha');
            if (btnTambah) btnTambah.style.display = 'none';
        }
    }

    // Fungsi untuk menghapus baris usaha dinamis
    function hapusUsahaItem(button) {
        const item = button.closest('.dynamic-usaha-item');
        if (item) {
            item.remove();
            usahaCount--;
            // Munculkan kembali tombol tambah jika jumlahnya di bawah 10
            const btnTambah = document.getElementById('btn-tambah-usaha');
            if (btnTambah) btnTambah.style.display = 'inline-flex';
        }
    }

    // Fungsi Validasi Utama saat tombol Berikutnya ditekan
    function validateAndSubmit() {
        const form = document.getElementById('formPraSurvei');
        let isValid = true;

        // Secara otomatis mengecek seluruh elemen di form yang memiliki atribut [required]
        const requiredInputs = form.querySelectorAll('[required]');

        requiredInputs.forEach(input => {
            if (input.type === 'file') {
                const container = input.closest('div');
                const previewDiv = container.querySelector('[id*="preview"]');
                const hasNewFile = input.files && input.files.length > 0;
                const hasOldFile = previewDiv && !previewDiv.classList.contains('hidden');

                // Jika file baru tidak dipilih dan tidak ada file lama (dari database), maka invalid
                if (!hasNewFile && !hasOldFile) {
                    isValid = false;
                }
            } else {
                // Untuk textarea / input teks biasa
                if (!input.value.trim()) {
                    isValid = false;
                }
            }
        });

        if (!isValid) {
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
        } else {
            form.submit();
        }
    }

    // Otomatis muat data lama (urutan 2-10) saat halaman dibuka kembali
    document.addEventListener("DOMContentLoaded", function () {
        const existingUsahaLainnya = @json($infoLainnya ?? []);

        if (existingUsahaLainnya.length > 0) {
            existingUsahaLainnya.forEach((item) => {
                // Panggil fungsi tambahUsahaBaru dengan membawa data dari database
                tambahUsahaBaru(item.gambaran_pekerjaan_debitur, item.perhitungan_omset_usaha);
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