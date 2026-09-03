<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Credit Analys - PT BPR Adipura Santosa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
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
        <form id="formPraSurvei" action="{{ route('storeAlur3-1') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Luas Tanah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Luas Tanah (dalam m2) <span class="text-red-500">*</span></label>
                    <input type="number" name="luas_tanah" value="{{ old('luas_tanah', $tanah->luas_tanah ?? '') }}" placeholder="ex : 250"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
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
                    <textarea name="spesifikasi" rows="6" placeholder="ex : 
Lebar Jalan : 6 m, Aspal, jalan utama, hadap timur
Bentuk Jaminan : persegi (50x50)
Lingkungan sekitar : daerah niaga, zona merah
KT : 3 KM : 1 Dapur Gudang Listrik 1300VA Air PDAM Garasi 2 Mobil"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('spesifikasi', $tanah->spesifikasi ?? '') }}</textarea>
                </div>

                <!-- Denah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Denah <span class="text-red-500">*</span></label>
                    <div class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga Tanah (Rp /m2) <span class="text-red-500">*</span></label>
                    <input type="number" name="harga_tanah" value="{{ old('harga_tanah', $tanah->harga_tanah ?? '') }}" placeholder="ex : 3500000"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Harga Bangunan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga Bangunan (Rp /m2)</label>
                    <input type="number" name="harga_bangunan" value="{{ old('harga_bangunan', $tanah->harga_bangunan ?? '') }}" placeholder="ex : 1000000"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Informasi Harga 1, 2, 3 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Informasi Harga 1 <span class="text-red-500">*</span></label>
                    <textarea name="info_harga1" rows="6" placeholder="ex :
Transaksi Juni 2025 Rumah LT/LB 50m2/50m2 laku 270jt harga 5,4jt/m
100 meter kebarat dari jaminan, dijalan yang sama
pemilik Rudi, pedagang pakaian (0856 1234 5678) pembeli Tri Pedagang Es Teh (0856 5678 1234)
https://maps.app.goo.gl/6eNyKi1gtgXwXBo9A" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('info_harga1', $tanah->info_harga1 ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Informasi Harga 2 <span class="text-red-500">*</span></label>
                    <textarea name="info_harga2" rows="6" placeholder="ex :
Transaksi Juni 2025 Rumah LT/LB 50m2/50m2 laku 270jt harga 5,4jt/m
100 meter kebarat dari jaminan, dijalan yang sama
pemilik Rudi, pedagang pakaian (0856 1234 5678) pembeli Tri Pedagang Es Teh (0856 5678 1234)
https://maps.app.goo.gl/6eNyKi1gtgXwXBo9A" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('info_harga2', $tanah->info_harga2 ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Informasi Harga 3</label>
                    <textarea name="info_harga3" rows="6" placeholder="ex :
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
                    <a href="{{ $backRoute }}" 
                            class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
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
            
            // 1. Reset form standar (mengosongkan text, textarea, number, radio, dll)
            form.reset();

            // 2. Kosongkan paksa semua input teks, textarea, dan number agar bersih dari sisa value database/old
            const inputs = form.querySelectorAll('input[type="text"], input[type="url"], input[type="number"], textarea');
            inputs.forEach(input => {
                // Kecuali input hidden seperti debitur_id dan urutan agar tidak terhapus sistem
                if (input.name !== 'debitur_id' && input.name !== 'urutan') {
                    input.value = '';
                }
            });

            // 3. Bersihkan pilihan Radio Button (Jaminan Lain)
            const radios = form.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
            });

            // 4. Bersihkan komponen file upload dan pratinjaunya
            removeFile();
        }
    </script>
</body>
</html>