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

        <!-- TAMPILKAN PESAN ERROR JIKA VALIDASI GAGAL -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeAlur6') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Input tersembunyi untuk debitur_id (diambil dari session atau variabel controller) -->
            <input type="hidden" name="debitur_id" value="{{ session('debitur_id') ?? ($debitur->id ?? '') }}">

            <!-- Capacity -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">Capacity</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi Usaha <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi_usaha" rows="6" placeholder="" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('deskripsi_usaha', $capacity->deskripsi_usaha ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Informasi Penghasilan Utama Menurut Nasabah <span class="text-red-500">*</span>
                    </label>
                    <textarea name="informasi_penghasilan_utama" rows="6" placeholder="" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('informasi_penghasilan_utama', $capacity->informasi_penghasilan_utama ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Informasi Penghasilan Pendukung Menurut Nasabah
                    </label>
                    <textarea name="informasi_penghasilan_pendukung" rows="6" placeholder=""
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('informasi_penghasilan_pendukung', $capacity->informasi_penghasilan_pendukung ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Pengeluaran Rumah Tangga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="pengeluaran_rumah_tangga" value="{{ old('pengeluaran_rumah_tangga', $capacity->pengeluaran_rumah_tangga ?? '') }}" placeholder="ex : 2000000" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Angsuran Bank Lain <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="angsuran_bank_lain" value="{{ old('angsuran_bank_lain', $capacity->angsuran_bank_lain ?? '') }}" placeholder="ex : 1000000" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Angsuran BPR <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="angsuran_bpr" value="{{ old('angsuran_bpr', $capacity->angsuran_bpr ?? '') }}" placeholder="ex : 2000000" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Analisis Kapasitas oleh CA <span class="text-red-500">*</span>
                    </label>
                    <textarea name="analisis_kapasitas" rows="6" placeholder="" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('analisis_kapasitas', $capacity->analisis_kapasitas ?? '') }}</textarea>
                </div>

                <!-- Upload Mutasi Rekening -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Mutasi Rekening <span class="text-red-500">*</span></label>
                    <div class="w-full border border-gray-300 rounded-lg px-3 py-4 text-sm">
                        <p class="text-sm text-gray-500 mb-4">Upload 1 file yang didukung. Maks 10 MB.</p>
                        <input type="file" id="file_mutasi_rekening" name="file_mutasi_rekening" accept=".pdf, .jpg, .jpeg, .png" class="hidden" onchange="handleFileSelect(this)">
                        <button type="button" onclick="document.getElementById('file_mutasi_rekening').click()" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-semibold text-[#0082CB] hover:bg-sky-50 transition">
                            <span id="txt_btn_upload">Tambahkan file</span>
                        </button>

                        @if(isset($capacity->mutasi_rekening) && $capacity->mutasi_rekening)
                            <div id="file_preview" class="mt-3 flex items-center justify-between p-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-700 max-w-sm">
                                <span id="file_name" class="truncate font-medium">{{ basename($capacity->mutasi_rekening) }}</span>
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

                <!-- Kelengkapan Berkas -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kelengkapan Berkas
                    </label>
                    
                    @php
                        $rawBerkas = old('kelengkapan_berkas', $capacity->kelengkapan_berkas ?? []);
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
                <button type="reset" 
                        class="text-[#0A3370] text-sm font-semibold hover:underline transition focus:outline-none">
                    Kosongkan Form
                </button>
                <div class="flex items-center gap-3">  
                    <a href="{{ $backRoute }}" 
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

    <!-- SCRIPT JAVASCRIPT UNTUK PREVIEW FILE & SUBMIT -->
    <script>
        function handleFileSelect(input) {
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                const previewDiv = document.getElementById('file_preview');
                const fileNameSpan = document.getElementById('file_name');
                const btnText = document.getElementById('txt_btn_upload');

                fileNameSpan.textContent = fileName;
                previewDiv.classList.remove('hidden');
                btnText.textContent = 'Ganti file';
            }
        }

        function removeFile() {
            const input = document.getElementById('file_mutasi_rekening');
            const previewDiv = document.getElementById('file_preview');
            const fileNameSpan = document.getElementById('file_name');
            const btnText = document.getElementById('txt_btn_upload');

            input.value = '';
            fileNameSpan.textContent = '';
            previewDiv.classList.add('hidden');
            btnText.textContent = 'Tambahkan file';
        }

        function validateAndSubmit() {
            const form = document.getElementById('formPraSurvei');
            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity();
            }
        }
    </script>
</body>
</html>