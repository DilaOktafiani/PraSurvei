<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kelengkapan Data - PT BPR Adipura Santosa</title>
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
                    <h2 class="text-2xl font-bold text-gray-800">Formulir Pra-Survei AO</h2>
                    <p class="text-gray-500 mt-1 text-sm">Silakan masukkan data awal calon nasabah hasil kunjungan lapangan secara akurat.</p>
                </div>
            </div>
        </div>

        <!-- NOTIFIKASI ERROR VALIDASI -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-bold">Terjadi kesalahan pengisian form:</p>
                        <ul class="list-disc list-inside text-sm text-red-600 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @php
            // Helper untuk mengambil data array dari database atau old input
            $getSavedArray = function($fieldName) use ($dataLengkap) {
                $val = old($fieldName, isset($dataLengkap->$fieldName) ? $dataLengkap->$fieldName : []);
                return is_array($val) ? $val : json_decode($val, true) ?? [];
            };

            $ktpValues = $getSavedArray('ktp');
            $slikValues = $getSavedArray('slik');
            $kkValues = $getSavedArray('kk');
            $suratNikahValues = $getSavedArray('surat_nikah');

            // Cek kustom value untuk Surat Nikah "Yang Lain"
            $standardSuratNikah = ['Surat Nikah Debitur', 'Surat Nikah Pemilik Jaminan', 'Surat Nikah Penjamin'];
            $customSuratNikah = '';
            foreach ($suratNikahValues as $val) {
                if (!in_array($val, $standardSuratNikah)) {
                    $customSuratNikah = $val;
                    break;
                }
            }
        @endphp

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeStep9') }}" method="POST" class="space-y-6">
            @csrf 
            
            <!-- HIDDEN INPUT DEBITUR ID -->
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? session('debitur_id') }}">

            <!-- KELENGKAPAN DATA -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-6">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">KELENGKAPAN DATA</h3>

                <!-- CARD 1: KTP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">KTP</label>
                    <div class="space-y-3 text-sm text-gray-700">
                        @foreach(['KTP Debitur', 'KTP Pasangan Debitur', 'KTP Pemilik Jaminan', 'KTP Pasangan Pemilik Jaminan', 'KTP Penjamin', 'KTP Pasangan Penjamin'] as $opt)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="ktp[]" value="{{ $opt }}" {{ in_array($opt, $ktpValues) ? 'checked' : '' }} class="accent-[#0082CB] w-4 h-4 rounded">
                                <span>{{ $opt }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- CARD 2: SLIK -->
                <div class="border-t border-gray-100 pt-5">
                    <label class="block text-sm font-medium text-gray-700 mb-3">SLIK</label>
                    <div class="space-y-3 text-sm text-gray-700">
                        @foreach(['SLIK Debitur', 'SLIK Pasangan Debitur', 'SLIK Pemilik Jaminan', 'SLIK Pasangan Pemilik Jaminan', 'SLIK Penjamin', 'SLIK Pasangan Penjamin'] as $opt)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="slik[]" value="{{ $opt }}" {{ in_array($opt, $slikValues) ? 'checked' : '' }} class="accent-[#0082CB] w-4 h-4 rounded">
                                <span>{{ $opt }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- CARD 3: KARTU KELUARGA -->
                <div class="border-t border-gray-100 pt-5">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Kartu Keluarga</label>
                    <div class="space-y-3 text-sm text-gray-700">
                        @foreach(['KK Debitur', 'KK Pemilik Jaminan', 'KK Penjamin'] as $opt)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="kk[]" value="{{ $opt }}" {{ in_array($opt, $kkValues) ? 'checked' : '' }} class="accent-[#0082CB] w-4 h-4 rounded">
                                <span>{{ $opt }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- CARD 4: SURAT NIKAH & BERKAS LAINNYA -->
                <div class="border-t border-gray-100 pt-5">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Surat Nikah</label>
                    <div class="space-y-3 text-sm text-gray-700">
                        @foreach($standardSuratNikah as $opt)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="surat_nikah_checkbox[]" value="{{ $opt }}" {{ in_array($opt, $suratNikahValues) ? 'checked' : '' }} class="accent-[#0082CB] w-4 h-4 rounded surat-nikah-opsi">
                                <span>{{ $opt }}</span>
                            </label>
                        @endforeach

                        <!-- Input Opsi Yang Lain -->
                        <div class="flex items-center gap-2 pt-1">
                            <input type="checkbox" id="checkbox_lainnya" value="Yang Lain" {{ !empty($customSuratNikah) ? 'checked' : '' }} class="accent-[#0082CB] w-4 h-4 rounded shrink-0">
                            <label for="checkbox_lainnya" class="cursor-pointer whitespace-nowrap text-sm text-gray-700">Yang Lain:</label>
                            <input type="text" id="input_lainnya" value="{{ $customSuratNikah }}" placeholder=""
                                   class="w-full border-b border-gray-300 px-1 py-0.5 text-sm focus:outline-none focus:border-[#0082CB] transition placeholder-gray-400">
                        </div>
                    </div>
                </div>
            </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Apakah Badan Usaha <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 text-sm text-gray-700">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="apakah_badan_usaha" value="YA" 
                                {{ (old('apakah_badan_usaha', $dataLengkap->apakah_badan_usaha ?? '') == 'YA') ? 'checked' : '' }} 
                                class="accent-[#0082CB]" required>
                            <span>YA</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="apakah_badan_usaha" value="TIDAK" 
                                {{ (old('apakah_badan_usaha', $dataLengkap->apakah_badan_usaha ?? '') == 'TIDAK') ? 'checked' : '' }} 
                                class="accent-[#0082CB]" required>
                            <span>TIDAK</span>
                        </label>
                    </div>
                </div>

            <!-- TOMBOL AKSI NAVIGASI -->
            <div class="flex justify-between items-center pt-2">
                <button type="reset" class="text-[#0A3370] text-sm font-semibold hover:underline transition focus:outline-none">
                    Kosongkan Form
                </button>
                <div class="flex items-center gap-3">  
                    <button type="button" onclick="window.history.back()" class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
                        Kembali
                    </button>
                    <button type="button" onclick="prepareAndSubmit()" class="bg-[#0082CB] text-[#FFFFFF] border-2 border-[#0082CB] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#006FB0] hover:border-[#006FB0] transition shadow-md flex items-center justify-center gap-2">
                        Berikutnya
                    </button>
                </div>
            </div>
        </form>
    </main>

    <footer class="text-center text-xs text-gray-500 pb-6">
        &copy; 2026 BPR Adipura Santosa | Surakarta.
    </footer>

    <!-- JAVASCRIPT UNTUK MENGGABUNGKAN INPUT LAINNYA KE DALAM ARRAY SURAT_NIKAH -->
    <script>
        const inputLainnya = document.getElementById('input_lainnya');
        const checkboxLainnya = document.getElementById('checkbox_lainnya');

        inputLainnya.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                checkboxLainnya.checked = true;
            } else {
                checkboxLainnya.checked = false;
            }
        });

        function prepareAndSubmit() {
            const form = document.getElementById('formPraSurvei');

            // Hapus hidden input dynamic sebelumnya agar tidak double saat klik berulang
            document.querySelectorAll('.dynamic-surat-nikah').forEach(el => el.remove());

            // 1. Masukkan checkbox surat nikah standar yang dicentang
            const checkedBoxes = document.querySelectorAll('.surat-nikah-opsi:checked');
            checkedBoxes.forEach(cb => {
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'surat_nikah[]';
                hiddenInput.value = cb.value;
                hiddenInput.className = 'dynamic-surat-nikah';
                form.appendChild(hiddenInput);
            });

            // 2. Jika input "Yang Lain" terisi dan dicentang, masukkan nilainya ke dalam array surat_nikah[]
            if (checkboxLainnya.checked && inputLainnya.value.trim() !== '') {
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'surat_nikah[]';
                hiddenInput.value = inputLainnya.value.trim();
                hiddenInput.className = 'dynamic-surat-nikah';
                form.appendChild(hiddenInput);
            }

            form.submit();
        }
    </script>
</body>
</html>