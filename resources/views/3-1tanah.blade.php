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
            <a href="/" class="inline-flex items-center justify-center gap-2 text-sm text-white font-medium px-4 py-1.5 rounded-full border-2 border-white hover:bg-white/10 transition"> 
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
        <form id="formPraSurvei" action="{{ route('storeStep3-1') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf 
            <input type="hidden" name="debitur_id" value="{{ $debiturId ?? session('debitur_id') }}">
            
            <!-- Urutan diambil secara dinamis dari Controller -->
            <input type="hidden" name="urutan" value="{{ $urutan ?? 1 }}">

            <!-- Jaminan Dynamic Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">
                    Jaminan {{ $urutan ?? 1 }}: Tanah Sawah / Tanah Pekarangan Kosong / Tanah Pekarangan + Bangunan
                </h3>
                    
                <!-- Kepemilikan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kepemilikan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="kepemilikan" name="kepemilikan" rows="2" placeholder="ex : HGB 1234 JT 24 november 2051 an Tri Hartanto (mertua) TO BCA diperoleh dari jual beli tanggal 17 Agustus 1976"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>{{ old('kepemilikan', $tanah->kepemilikan ?? '') }}</textarea>
                </div>

                <!-- Alamat Jaminan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat Jaminan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat" name="alamat" rows="1" placeholder="ex : Jl. Bhayangkara no 34 Serengan Solo"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>{{ old('alamat', $tanah->alamat ?? '') }}</textarea>
                </div>

                <!-- Share Location -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Share Location <span class="text-red-500">*</span>
                    </label>
                    <input type="url" name="share_location" value="{{ old('share_location', $tanah->share_location ?? '') }}" placeholder="ex : https://maps.app.goo.gl/6eNyKi1gtgXwXBo9A"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Luas Tanah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Luas Tanah (dalam m2) <span class="text-red-500">*</span></label>
                    <input type="number" name="luas_tanah" value="{{ old('luas_tanah', $tanah->luas_tanah ?? '') }}" placeholder="ex : 250"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Luas Bangunan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Luas Bangunan (dalam m2)</label>
                    <input type="number" name="luas_bangunan" value="{{ old('luas_bangunan', $tanah->luas_bangunan ?? '') }}" placeholder="ex : 100"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Spesifikasi Jaminan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Spesifikasi Jaminan <span class="text-red-500">*</span></label>
                    <textarea name="spesifikasi" rows="5" placeholder="ex : 
Lebar Jalan : 6 m, Aspal, jalan utama, hadap timur
Bentuk Jaminan : persegi (50x50)
Lingkungan sekitar : daerah niaga, zona merah
KT : 3 KM : 1 Dapur Gudang Listrik 1300VA Air PDAM Garasi 2 Mobil"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>{{ old('spesifikasi', $tanah->spesifikasi ?? '') }}</textarea>
                </div>

                <!-- Denah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Denah <span class="text-red-500">*</span></label>
                    <div id="container_file_denah" class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        <input type="file" id="file_denah" name="file_denah" accept=".pdf, .jpg, .jpeg, .png, .dwg" class="hidden" onchange="handleFileSelect(this)">
                        <button type="button" onclick="document.getElementById('file_denah').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload">Tambahkan file</span>
                        </button>

                        @if(isset($tanah->denah) && $tanah->denah)
                            <div id="file_preview" class="mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name" class="truncate font-medium">{{ basename($tanah->denah) }}</span>
                                <button type="button" onclick="removeFile()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @else
                            <div id="file_preview" class="hidden mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name" class="truncate font-medium"></span>
                                <button type="button" onclick="removeFile()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Harga Tanah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga Tanah (Rp /m2) <span class="text-red-500">*</span>
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 3500000" 
                        value="{{ old('harga_tanah', isset($tanah->harga_tanah) ? number_format($tanah->harga_tanah, 0, ',', '.') : '') }}" 
                        required>
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="harga_tanah" value="{{ old('harga_tanah', $tanah->harga_tanah ?? '') }}">
                </div>

                <!-- Harga Bangunan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga Bangunan (Rp /m2)
                    </label>
                    <!-- Input teks untuk tampilan berformat titik otomatis -->
                    <input type="text" 
                        class="input-rupiah w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" 
                        placeholder="ex : 1000000" 
                        value="{{ old('harga_bangunan', isset($tanah->harga_bangunan) ? number_format($tanah->harga_bangunan, 0, ',', '.') : '') }}">
                    
                    <!-- Input hidden untuk dikirim angka murninya ke database -->
                    <input type="hidden" name="harga_bangunan" value="{{ old('harga_bangunan', $tanah->harga_bangunan ?? '') }}">
                </div>

                <!-- Informasi Harga 1, 2, 3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Informasi Harga 1 <span class="text-red-500">*</span></label>
                    <textarea name="info_harga1" rows="5" placeholder="ex :
Transaksi Juni 2025 Rumah LT/LB 50m2/50m2 laku 270jt harga 5,4jt/m
100 meter kebarat dari jaminan, dijalan yang sama
pemilik Rudi, pedagang pakaian (0856 1234 5678) pembeli Tri Pedagang Es Teh (0856 5678 1234)
https://maps.app.goo.gl/6eNyKi1gtgXwXBo9A" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>{{ old('info_harga1', $tanah->info_harga1 ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Informasi Harga 2 <span class="text-red-500">*</span></label>
                    <textarea name="info_harga2" rows="5" placeholder="ex :
Transaksi Juni 2025 Rumah LT/LB 50m2/50m2 laku 270jt harga 5,4jt/m
100 meter kebarat dari jaminan, dijalan yang sama
pemilik Rudi, pedagang pakaian (0856 1234 5678) pembeli Tri Pedagang Es Teh (0856 5678 1234)
https://maps.app.goo.gl/6eNyKi1gtgXwXBo9A" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>{{ old('info_harga2', $tanah->info_harga2 ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Informasi Harga 3</label>
                    <textarea name="info_harga3" rows="5" placeholder="ex :
Transaksi Juni 2025 Rumah LT/LB 50m2/50m2 laku 270jt harga 5,4jt/m
100 meter kebarat dari jaminan, dijalan yang sama
pemilik Rudi, pedagang pakaian (0856 1234 5678) pembeli Tri Pedagang Es Teh (0856 5678 1234)
https://maps.app.goo.gl/6eNyKi1gtgXwXBo9A" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('info_harga3', $tanah->info_harga3 ?? '') }}</textarea>
                </div>

                <!-- Apakah Ada Jaminan Lain (Hanya muncul di Jaminan 1 & 2) -->
                @php
                    $currentUrutan = $urutan ?? 1;
                    $selectedJaminanLain = old('jaminan_lain_input', $tanah->jaminan_lain ?? '');
                @endphp

                @if($currentUrutan < 3)
                <div id="wrapper_jaminan_lain">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Apakah Ada Jaminan Lain <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 text-sm text-gray-700">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jaminan_lain_input" value="ADA" class="accent-[#0082CB]" {{ $selectedJaminanLain == 'ADA' ? 'checked' : '' }} required>
                            <span>ADA</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jaminan_lain_input" value="ADA SELAIN HM/HGB" class="accent-[#0082CB]" {{ $selectedJaminanLain == 'ADA SELAIN HM/HGB' ? 'checked' : '' }}>
                            <span>ADA SELAIN HM/HGB</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jaminan_lain_input" value="TIDAK ADA" class="accent-[#0082CB]" {{ $selectedJaminanLain == 'TIDAK ADA' ? 'checked' : '' }}>
                            <span>TIDAK ADA</span>
                        </label>
                    </div>
                </div>
                @endif
            </div>

            <!-- TOMBOL AKSI NAVIGASI -->
            <div class="flex justify-between items-center pt-2">
                <button type="button" onclick="clearForm()" class="text-[#0A3370] text-sm font-semibold hover:underline transition">
                    Kosongkan Form
                </button>

                <div class="flex items-center gap-3">  
                    <a href="{{ $backRoute }}" class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
                        Kembali
                    </a>

                    <button type="submit"
                            class="bg-[#0082CB] text-[#FFFFFF] border-2 border-[#0082CB] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#006FB0] transition">
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
        function handleFileSelect(input) {
            if (input.files && input.files[0]) {
                document.getElementById('file_name').textContent = input.files[0].name;
                document.getElementById('file_preview').classList.remove('hidden');
                document.getElementById('txt_btn_upload').textContent = 'Ganti file';
                
                const containerFile = document.getElementById('container_file_denah');
                if (containerFile) containerFile.style.border = '';
            }
        }

        function removeFile() {
            const input = document.getElementById('file_denah');
            input.value = '';
            document.getElementById('file_preview').classList.add('hidden');
            document.getElementById('txt_btn_upload').textContent = 'Tambahkan file';
        }

        // Fungsi untuk mengosongkan form secara total tanpa pop-up
        function clearForm() {
            const form = document.getElementById('formPraSurvei');
            form.reset();
            
            const inputs = form.querySelectorAll('input[type="text"], input[type="url"], input[type="number"], textarea');
            inputs.forEach(input => {
                if (input.name !== 'debitur_id' && input.name !== 'urutan') {
                    input.value = '';
                    input.style.borderColor = '';
                }
            });

            const radios = form.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
            });

            const wrapperJaminanLain = document.getElementById('wrapper_jaminan_lain');
            if (wrapperJaminanLain) wrapperJaminanLain.style.border = '';

            removeFile();
        }

        // Penyesuaian Validasi & Pop-up Submit
        const formPraSurvei = document.getElementById('formPraSurvei');
        
        formPraSurvei.querySelectorAll('[required]').forEach(field => {
            field.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });
            field.addEventListener('change', function() {
                if (this.value !== '') {
                    this.style.borderColor = '';
                }
            });
        });

        formPraSurvei.addEventListener('submit', function(event) {
            let isValid = true;
            let errorMessage = 'Mohon lengkapi semua pertanyaan yang bertanda (*)';

            // Reset semua border merah terlebih dahulu
            formPraSurvei.querySelectorAll('[required]').forEach(field => {
                field.style.borderColor = '';
            });

            const wrapperJaminanLain = document.getElementById('wrapper_jaminan_lain');
            if (wrapperJaminanLain) {
                wrapperJaminanLain.style.border = '';
                wrapperJaminanLain.style.padding = '';
            }

            const containerFile = document.getElementById('container_file_denah');
            if (containerFile) {
                containerFile.style.border = '';
                containerFile.style.padding = '';
            }

            // 1. Validasi Input Wajib (Required Fields)
            const requiredFields = formPraSurvei.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value || field.value.trim() === '') {
                    isValid = false;
                    field.style.borderColor = 'red';
                }
            });

            // 1.1 Validasi Khusus Share Loc (harus berupa link URL Google Maps / http / https)
            const shareLocInput = formPraSurvei.querySelector('input[name="share_loc"]') || document.getElementById('share_loc');
            if (shareLocInput) {
                // Hapus border merah seketika saat user mengetik
                shareLocInput.addEventListener('input', function() {
                    const val = this.value.trim();
                    if (val !== '' && (val.includes('http://') || val.includes('https://') || val.includes('maps'))) {
                        this.style.borderColor = '';
                    }
                });

                const valLoc = shareLocInput.value.trim();
                // Jika input tidak kosong tapi bukan link (tidak ada http/https atau kata maps) ATAU jika kosong tapi wajib
                if (valLoc !== '' && !valLoc.startsWith('http://') && !valLoc.startsWith('https://') && !valLoc.includes('maps')) {
                    isValid = false;
                    shareLocInput.style.borderColor = 'red';
                    errorMessage = 'Share loc harus diisi dengan link/URL Google Maps yang valid';
                } else if (valLoc === '' && shareLocInput.hasAttribute('required')) {
                    isValid = false;
                    shareLocInput.style.borderColor = 'red';
                }
            }

            // 2. Validasi File Upload (Denah) jika belum ada file baru maupun database lama
            const fileInput = document.getElementById('file_denah');
            const filePreview = document.getElementById('file_preview');
            const hasExistingFile = filePreview && !filePreview.classList.contains('hidden');
            if ((!fileInput.files || fileInput.files.length === 0) && !hasExistingFile) {
                isValid = false;
                if (containerFile) {
                    containerFile.style.border = '1px solid red';
                    containerFile.style.borderRadius = '4px';
                    containerFile.style.padding = '8px';
                }
            }

            // 3. Validasi Radio Button (Jaminan Lain) jika elemennya ada di halaman
            if (wrapperJaminanLain) {
                const selectedRadio = formPraSurvei.querySelector('input[name="jaminan_lain_input"]:checked');
                if (!selectedRadio) {
                    isValid = false;
                    wrapperJaminanLain.style.border = '1px solid red';
                    wrapperJaminanLain.style.borderRadius = '4px';
                    wrapperJaminanLain.style.padding = '8px';
                }
            }

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
            } else {
                // Biarkan form melakukan submit secara normal tanpa preventDefault
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