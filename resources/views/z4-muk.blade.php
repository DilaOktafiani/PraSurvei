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
        <form id="formPraSurvei" action="{{ route('storeAlur4') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf

            <!-- Input tersembunyi untuk debitur_id -->
            <input type="hidden" name="debitur_id" value="{{ session('debitur_id') ?? ($debitur->id ?? '') }}">

            <!-- KOTAK 1: 1. CAPITAL -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">D. URAIAN SINGKAT MENGENAI 5 C</h3>
                
                <div class="pt-2 pb-1">
                    <h4 class="text-base font-bold text-gray-700">1. CAPITAL</h4>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Keterangan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="capital" name="capital" rows="3" placeholder="ex : Modal yang dimiliki debitur cukup antara lain berupa Rumah Tinggal, Tanah, dan Motor." required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('capital', $data->capital ?? '') }}</textarea>
                </div>
            </div>

            <!-- KOTAK 2: 2. COLLATERAL -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <div class="pb-1">
                    <h4 class="text-base font-bold text-gray-700">2. COLLATERAL</h4>
                </div>

                <!-- No.SHM -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        No.SHM <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="no_shm" value="{{ old('no_shm', $data->no_shm ?? '') }}" placeholder="ex : 522" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Luas -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Luas <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="luas" value="{{ old('luas', $data->luas ?? '') }}" placeholder="ex : 193 m2 " required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Nama Pemilik -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Pemilik <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pemilik" value="{{ old('pemilik', $data->pemilik ?? '') }}" placeholder="ex : Adi Sucipto" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Letak SHM -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Letak SHM <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="letak_shm" value="{{ old('letak_shm', $data->letak_shm ?? '') }}" placeholder="ex : Ds/Kel..Cemani Kec.Grogol Kab.Sukoharjo" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Ringkasan Penilaian Jaminan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ringkasan Penilaian Jaminan <span class="text-red-500">*</span>
                    </label>
                    <div id="container_file_ringkasan_penilaian_jaminan" class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        
                        <!-- Input File dengan required dinamis & data-has-file -->
                        <input type="file" id="file_ringkasan_penilaian_jaminan" name="ringkasan_penilaian_jaminan" 
                            accept=".pdf,.jpg,.jpeg,.png,.dwg,application/pdf,image/*" 
                            class="hidden" onchange="handleFileSelect(this)"
                            {{ isset($data->ringkasan_penilaian_jaminan) && $data->ringkasan_penilaian_jaminan ? '' : 'required' }}
                            data-has-file="{{ isset($data->ringkasan_penilaian_jaminan) && $data->ringkasan_penilaian_jaminan ? 'true' : 'false' }}">

                        <button type="button" onclick="document.getElementById('file_ringkasan_penilaian_jaminan').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload_ringkasan_penilaian_jaminan">
                                {{ isset($data->ringkasan_penilaian_jaminan) && $data->ringkasan_penilaian_jaminan ? 'Ganti file' : 'Tambahkan file' }}
                            </span>
                        </button>

                        @if(isset($data->ringkasan_penilaian_jaminan) && $data->ringkasan_penilaian_jaminan)
                            <div id="file_preview_ringkasan_penilaian_jaminan" class="mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_ringkasan_penilaian_jaminan" class="truncate font-medium">{{ basename($data->ringkasan_penilaian_jaminan) }}</span>
                                <button type="button" onclick="removeFileRingkasanPenilaianJaminan()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @else
                            <div id="file_preview_ringkasan_penilaian_jaminan" class="hidden mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_ringkasan_penilaian_jaminan" class="truncate font-medium"></span>
                                <button type="button" onclick="removeFileRingkasanPenilaianJaminan()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tanggal Ringkasan Penilaian Jaminan (TIDAK Wajib) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Ringkasan Penilaian Jaminan
                    </label>
                    <input type="text" name="tanggal" value="{{ old('tanggal', $debitur->tanggal ?? '') }}" placeholder="ex : 09 September 2026"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Informasi Harga Tanah 1 (Wajib) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Informasi Harga Tanah 1 <span class="text-red-500">*</span>
                    </label>
                    <textarea id="info_harga_tanah1" name="info_harga_tanah1" rows="5" placeholder="ex : 
Bp. Budiman selaku Ketua RT, menginformasikan bahwa harga tanah cepat laku di sekitar jaminan sebesar Rp3.500.000 (masuk Gang) sampai Rp5.000.000/m. (pinggir jalan utama)" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('info_harga_tanah1', $data->info_harga_tanah1 ?? '') }}</textarea>
                </div>

                <!-- Informasi Harga Tanah 2 (TIDAK Wajib) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Informasi Harga Tanah 2
                    </label>
                    <textarea id="info_harga_tanah2" name="info_harga_tanah2" rows="5" placeholder="ex : 
Bp. Budiman selaku Ketua RT, menginformasikan bahwa harga tanah cepat laku di sekitar jaminan sebesar Rp3.500.000 (masuk Gang) sampai Rp5.000.000/m. (pinggir jalan utama)"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('info_harga_tanah2', $data->info_harga_tanah2 ?? '') }}</textarea>
                </div>

                <!-- Informasi Harga Tanah 3 (TIDAK Wajib) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Informasi Harga Tanah 3
                    </label>
                    <textarea id="info_harga_tanah3" name="info_harga_tanah3" rows="5" placeholder="ex : 
Bp. Budiman selaku Ketua RT, menginformasikan bahwa harga tanah cepat laku di sekitar jaminan sebesar Rp3.500.000 (masuk Gang) sampai Rp5.000.000/m. (pinggir jalan utama)"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('info_harga_tanah3', $data->info_harga_tanah3 ?? '') }}</textarea>
                </div>

                <!-- Batas Objek Jaminan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Batas Objek Jaminan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="batas_objek_jaminan" name="batas_objek_jaminan" rows="6" placeholder=" ex : 
-   Depan       : Jalan
-   Belakang   : Rumah Debitur
-   Kanan       : Rumah Tetangga
-   Kiri            : Jalan" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('batas_objek_jaminan', $data->batas_objek_jaminan ?? '') }}</textarea>
                </div>

                <!-- Catatan Khusus Objek Jaminan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Catatan Khusus Objek Jaminan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="catatan_khusus" name="catatan_khusus" rows="6" placeholder=" ex : 
-	Jaminan memiliki akses jalan dengan lebar 4,5 meter yang bisa dilalui Mobil, lokasi strategis, berada ditengah kampung.
-	Bangunan rumah berdiri diatas 2 (dua) sertifikat,tetapi yang dihitung hanya sebatas luas bangunan yang berada dalam sertifikat jaminan" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('catatan_khusus', $data->catatan_khusus ?? '') }}</textarea>
                </div>
                
            </div>

            <!-- KOTAK 3: 3. CONDITION -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <div class="pb-1">
                    <h4 class="text-base font-bold text-gray-700">3. CONDITION</h4>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Keterangan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="condition" name="condition" rows="10" placeholder="ex : 
Dari hasil slik terlihat semua pinjaman online dan leasing dalam kondisi macet, itu dikarenakan saat itu debitur butuh dana untuk mengobati anaknya yang terkena penyakit Leukimia dan harus opname cukup lama di Rumah Sakit sehingga debitur mengabaikan kewajibannya serta mengembalikan unit mobil ke Leasing karena merasa tidak mampu untuk membayar angsuran." required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('condition', $data->condition ?? '') }}</textarea>
                </div>
            </div>

            <!-- KOTAK 4: 4. CAPACITY -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <div class="pb-1">
                    <h4 class="text-base font-bold text-gray-700">4. CAPACITY</h4>
                </div>

                <!-- Perhitungan Capacity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Perhitungan Capacity <span class="text-red-500">*</span>
                    </label>
                    <div id="container_file_capacity" class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung: PDF, drawing, atau image. Maks 10 MB.</p>
                        
                        <!-- Input File dengan required dinamis & data-has-file -->
                        <input type="file" id="file_capacity" name="capacity" 
                            accept=".pdf,.jpg,.jpeg,.png,.dwg,application/pdf,image/*" 
                            class="hidden" onchange="handleFileSelect(this)"
                            {{ isset($data->capacity) && $data->capacity ? '' : 'required' }}
                            data-has-file="{{ isset($data->capacity) && $data->capacity ? 'true' : 'false' }}">

                        <button type="button" onclick="document.getElementById('file_capacity').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload_capacity">
                                {{ isset($data->capacity) && $data->capacity ? 'Ganti file' : 'Tambahkan file' }}
                            </span>
                        </button>

                        @if(isset($data->capacity) && $data->capacity)
                            <div id="file_preview_capacity" class="mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_capacity" class="truncate font-medium">{{ basename($data->capacity) }}</span>
                                <button type="button" onclick="removeFileCapacity()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @else
                            <div id="file_preview_capacity" class="hidden mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name_capacity" class="truncate font-medium"></span>
                                <button type="button" onclick="removeFileCapacity()" class="text-gray-400 hover:text-red-500 transition ml-2">&#10005;</button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tanggungan Keluarga -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggungan Keluarga <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="keluarga" value="{{ old('keluarga', $data->keluarga ?? '') }}" placeholder="ex : 5 orang" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Tanggungan Anak -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggungan Anak <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="anak" value="{{ old('anak', $data->anak ?? '') }}" placeholder="ex : 4 orang" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Tanggungan Pendidikan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggungan Pendidikan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pendidikan" value="{{ old('pendidikan', $data->pendidikan ?? '') }}" placeholder="ex : 3 orang" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>
                
            </div>

            <!-- KOTAK 5: 5. CHARACTER -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <div class="pb-1">
                    <h4 class="text-base font-bold text-gray-700">5. CHARACTER</h4>
                </div>

                <!-- Internal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Internal <span class="text-red-500">*</span>
                    </label>
                    <textarea id="internal" name="internal" rows="5" placeholder="ex : 
- Dalam memberikan informasi debitur cukup terbuka dan kooperatif. Gaya hidup sederhana." required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('internal', $data->internal ?? '') }}</textarea>
                </div>

                <!-- Eksternal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Eksternal <span class="text-red-500">*</span>
                    </label>
                    <textarea id="eksternal" name="eksternal" rows="6" placeholder="ex : 
- Bp. Jumadi, Ketua RT, menginformasikan bahwa cadeb mempunyai karakter yang baik. Memiliki usaha Toko Kelontong dan Toko Petshop yang dikelola bersama suaminya. Selama ini tidak ada permasalahan di lingkungan." required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('eksternal', $data->eksternal ?? '') }}</textarea>
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
    // Fungsi untuk Preview File Upload (Universal untuk semua file upload)
    // Fungsi untuk Preview File Upload (Otomatis mendeteksi ID dari input)
    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            
            // Ambil bagian unik dari id input, misal "file_capacity" jadi "capacity"
            const fieldId = input.id.replace('file_', ''); 

            const previewDiv = document.getElementById('file_preview_' + fieldId);
            const fileNameSpan = document.getElementById('file_name_' + fieldId);
            const btnText = document.getElementById('txt_btn_upload_' + fieldId);

            if (fileNameSpan) fileNameSpan.textContent = fileName;
            if (previewDiv) previewDiv.classList.remove('hidden');
            if (btnText) btnText.textContent = 'Ganti file';
        }
    }

    // Fungsi untuk Menghapus File Upload (Universal untuk semua file upload)
    function removeFile(inputId, previewId, btnId) {
        const input = document.getElementById(inputId);
        const previewDiv = document.getElementById(previewId);
        const btnText = document.getElementById(btnId);

        if (input) input.value = '';
        if (previewDiv) previewDiv.classList.add('hidden');
        if (btnText) btnText.textContent = 'Tambahkan file';
    }

    // Validasi Form dengan SweetAlert saat Submit
    document.addEventListener('DOMContentLoaded', function () {
        const formPraSurvei = document.getElementById('formPraSurvei');

        if (formPraSurvei) {
            formPraSurvei.addEventListener('submit', function(event) {
                let isValid = true;

                // Cek semua input yang memiliki atribut required secara otomatis
                const requiredFields = formPraSurvei.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    // Khusus file
                    if (field.type === 'file') {
                        // Jika file baru belum dipilih DAN belum ada file lama yang tersimpan di server/preview
                        if (!field.files || field.files.length === 0) {
                            // Cek apakah elemen preview-nya sedang aktif (artinya sudah ada file lama dari database)
                            // Kita cek berdasarkan container terdekat atau atributnya jika perlu, 
                            // tapi standar HTML required menangkap input kosong jika belum di-upload.
                            // Catatan: Jika form mode edit dan file lama sudah ada, browser menganggap input file kosong 
                            // kecuali kita buat pengecualian untuk file yang sudah ada.
                            
                            // Untuk amannya, kita cek apakah elemen preview terlihat atau tidak:
                            let container = field.closest('div');
                            let hasExistingFile = container && container.querySelector('.bg-gray-50') && !container.querySelector('.bg-gray-50').classList.contains('hidden');
                            
                            if (!hasExistingFile) {
                                isValid = false;
                            }
                        }
                    }
                    // Input textarea/text/date dan lainnya
                    else {
                        if (!field.value.trim()) {
                            isValid = false;
                        }
                    }
                });

                // Jika ada field required yang belum diisi
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