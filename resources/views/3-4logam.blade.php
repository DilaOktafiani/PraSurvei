<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pra-Survei - PT BPR Adipura Santosa</title>
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
                    <h2 class="text-2xl font-bold text-gray-800">Formulir Pra-Survei AO</h2>
                    <p class="text-gray-500 mt-1 text-sm">Silakan masukkan data awal calon nasabah hasil kunjungan lapangan secara akurat.</p>
                </div>
            </div>
            <p class="text-xs text-red-500 mt-4 font-medium flex items-center gap-1 border-t border-gray-100 pt-3">
                <span>*</span> Menunjukkan pertanyaan yang wajib diisi
            </p>
        </div>

        <!-- TAMPILKAN PESAN ERROR VALIDASI -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                <div class="flex items-center">
                    <div class="text-red-700 text-sm font-medium">
                        <p class="font-bold mb-1">Terjadi Kesalahan Pengisian Form:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- CEK DATA LAMA / OLD -->
        @php
            $valLogam = $data->jenis_logam ?? old('jenis_logam');
            $knownOptions = ['emas_antam', 'emas_non_antam', 'emas_lokal', 'emas_perhiasan'];
            $isLainnya = !in_array($valLogam, $knownOptions) && !empty($valLogam);
        @endphp

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeStep3-4') }}" method="POST" class="space-y-6">
            @csrf <!-- Security Token Laravel -->
            
            <!-- Hidden input untuk debitur_id agar data terkirim ke database -->
            <input type="hidden" name="debitur_id" value="{{ $debitur_id ?? old('debitur_id') }}">

            <!-- BLOK 1: JENIS LOGAM -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">LOGAM MULIA</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Logam <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 text-sm text-gray-700">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_logam" value="emas_antam" class="accent-[#0082CB]" {{ $valLogam == 'emas_antam' ? 'checked' : '' }}>
                            <span>Emas Batangan (Antam)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_logam" value="emas_non_antam" class="accent-[#0082CB]" {{ $valLogam == 'emas_non_antam' ? 'checked' : '' }}>
                            <span>Emas Batangan (Non Antam) contoh: UBS / SMG / Lotus Archi / Galeri 24</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_logam" value="emas_lokal" class="accent-[#0082CB]" {{ $valLogam == 'emas_lokal' ? 'checked' : '' }}>
                            <span>Emas Batangan (Lokal/LD)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_logam" value="emas_perhiasan" class="accent-[#0082CB]" {{ $valLogam == 'emas_perhiasan' ? 'checked' : '' }}>
                            <span>Emas Perhiasan</span>
                        </label>
                        
                        <!-- OPSI LAINNYA -->
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="jenis_logam" value="yang_lain" id="radio_lainnya" class="accent-[#0082CB]" {{ $isLainnya ? 'checked' : '' }}>
                                <label for="radio_lainnya" class="cursor-pointer whitespace-nowrap text-sm">Yang Lain:</label>
                                <!-- Ubah name menjadi jenis_logam_lain agar tidak bentrok dengan radio -->
                                <input type="text" id="jenis_logam_lain" name="jenis_logam_lain" value="{{ $isLainnya ? $valLogam : old('jenis_logam_lain') }}" placeholder=""
                                       class="w-full border-b border-gray-300 px-1 py-0.5 text-sm focus:outline-none focus:border-[#0082CB] transition">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BLOK 2: DETAIL BERAT & HARGA -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <!-- Berat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Berat (dalam gram) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="berat" id="berat" value="{{ $data->berat ?? old('berat') }}" placeholder="ex : 1000"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Harga Beli / Tahun Perolehan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga Beli / Tahun Perolehan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="harga_beli_tahun_perolehan" id="harga_beli_tahun_perolehan" value="{{ $data->harga_beli_tahun_perolehan ?? old('harga_beli_tahun_perolehan') }}" placeholder="ex : 900.000.000 / 2019"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Harga Saat Ini -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-sm font-medium text-gray-700">
                            Harga saat ini <span class="text-red-500">*</span>
                        </label>
                        
                        <!-- Link Acuan Harga -->
                        <a href="https://www.logammulia.com" target="_blank" rel="noopener noreferrer" 
                           class="text-xs text-[#0082CB] hover:underline font-medium flex items-center gap-1">
                            <span>Cek www.logammulia.com</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </a>
                    </div>
                    
                    <input type="text" name="harga_saatini" id="harga_saatini" value="{{ $data->harga_saatini ?? old('harga_saatini') }}" placeholder="Berdasarkan harga www.logammulia.com"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB] placeholder-gray-400">
                </div>
            </div>

            <!-- TOMBOL AKSI NAVIGASI -->
            <div class="flex justify-between items-center pt-2">
                <button type="reset" 
                        class="text-[#0A3370] text-sm font-semibold hover:underline transition focus:outline-none">
                    Kosongkan Form
                </button>

                <div class="flex items-center gap-3">  
                    <!-- Tombol Kembali -->
                    <button type="button" onclick="window.history.back()"
                            class="bg-transparent text-[#0A3370] border-2 border-[#0A3370] px-8 py-2 rounded-lg text-sm font-semibold hover:bg-[#0A3370] hover:text-white transition shadow-sm flex items-center justify-center gap-2">
                        Kembali
                    </button>

                    <!-- Tombol Submit / Berikutnya -->
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

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const inputLainnya = document.getElementById('jenis_logam_lain');
        const radioLainnya = document.getElementById('radio_lainnya');

        // Jika user mengetik di kolom "Yang Lain", otomatis centang radio button-nya
        inputLainnya.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                radioLainnya.checked = true;
            }
        });

        function validateAndSubmit() {
            const form = document.getElementById('formPraSurvei');
            const selectedLogam = form.querySelector('input[name="jenis_logam"]:checked');
            
            // 1. Validasi Radio terpilih
            if (!selectedLogam) {
                alert('Silakan pilih jenis logam mulia!');
                return;
            }

            // 2. Validasi Kolom "Yang Lain"
            if (selectedLogam.value === 'yang_lain' && inputLainnya.value.trim() === '') {
                alert('Silakan isi keterangan jenis logam mulia lainnya!');
                inputLainnya.focus();
                return;
            }

            form.submit();
        }
    </script>
</body>
</html>