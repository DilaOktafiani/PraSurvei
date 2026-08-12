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

        <!-- NOTIFIKASI ERROR -->
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

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeStep8-2') }}" method="POST" class="space-y-6">
            @csrf 

            <!-- Input tersembunyi untuk ID Debitur -->
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? session('debitur_id') }}">

            <!-- KONDISI -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">KONDISI</h3>
                <p class="text-xs text-gray-500 mt-0.5">Apabila take over maka harus melengkapi</p>

                <!-- Berkas Take Over -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Berkas Take Over
                    </label>
                    
                    @php
                        $savedValues = old('berkas_take_over', isset($kondisi->berkas_take_over) ? (is_array($kondisi->berkas_take_over) ? $kondisi->berkas_take_over : json_decode($kondisi->berkas_take_over, true)) : []);
                        
                        // Opsi standar yang ada checkbox-nya
                        $standardOptions = [
                            'Mutasi Pinjaman yang di TO',
                            'Slip Pembayaran Angsuran',
                            'Copy Sertifikat Terbaru'
                        ];

                        // Cari apakah ada nilai tersimpan yang bukan bagian dari opsi standar (artinya ini input teks "Yang Lain")
                        $customValue = '';
                        foreach ($savedValues as $val) {
                            if (!in_array($val, $standardOptions)) {
                                $customValue = $val;
                                break;
                            }
                        }
                    @endphp

                    <div class="space-y-3 text-sm text-gray-700">
                        <!-- Opsi 1 -->
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="berkas_take_over_checkbox[]" value="Mutasi Pinjaman yang di TO" 
                                {{ in_array('Mutasi Pinjaman yang di TO', $savedValues) ? 'checked' : '' }}
                                class="accent-[#0082CB] w-4 h-4 rounded checkbox-opsi">
                            <span>Mutasi Pinjaman yang di TO</span>
                        </label>
                        
                        <!-- Opsi 2 -->
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="berkas_take_over_checkbox[]" value="Slip Pembayaran Angsuran" 
                                {{ in_array('Slip Pembayaran Angsuran', $savedValues) ? 'checked' : '' }}
                                class="accent-[#0082CB] w-4 h-4 rounded checkbox-opsi">
                            <span>Slip Pembayaran Angsuran</span>
                        </label>
                        
                        <!-- Opsi 3 -->
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="berkas_take_over_checkbox[]" value="Copy Sertifikat Terbaru" 
                                {{ in_array('Copy Sertifikat Terbaru', $savedValues) ? 'checked' : '' }}
                                class="accent-[#0082CB] w-4 h-4 rounded checkbox-opsi">
                            <span>Copy Sertifikat Terbaru</span>
                        </label>
                        
                        <!-- OPSI YANG LAIN + INPUT TEKS -->
                        <div>
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="checkbox_lainnya" value="Yang Lain" 
                                    {{ !empty($customValue) ? 'checked' : '' }}
                                    class="accent-[#0082CB] w-4 h-4 rounded shrink-0">
                                <label for="checkbox_lainnya" class="cursor-pointer whitespace-nowrap text-sm">Yang Lain:</label>
                                <input type="text" id="input_lainnya" 
                                    value="{{ $customValue }}"
                                    placeholder=""
                                    class="w-full border-b border-gray-300 px-1 py-0.5 text-sm focus:outline-none focus:border-[#0082CB] transition placeholder-gray-400">
                            </div>
                        </div>
                    </div>
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

    <!-- SCRIPT UNTUK MENGGABUNGKAN INPUT KE DALAM ARRAY BERKAS_TAKE_OVER -->
    <script>
        const inputLainnya = document.getElementById('input_lainnya');
        const checkboxLainnya = document.getElementById('checkbox_lainnya');

        // Otomatis centang checkbox "Yang Lain" jika user mengetik
        inputLainnya.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                checkboxLainnya.checked = true;
            } else {
                checkboxLainnya.checked = false;
            }
        });

        function prepareAndSubmit() {
            const form = document.getElementById('formPraSurvei');
            
            // Hapus elemen hidden dynamic sebelumnya jika ada (untuk mencegah duplikasi saat klik berkali-kali)
            document.querySelectorAll('.dynamic-berkas').forEach(el => el.remove());

            // 1. Ambil semua checkbox standar yang dicentang
            const checkedBoxes = document.querySelectorAll('.checkbox-opsi:checked');
            checkedBoxes.forEach(cb => {
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'berkas_take_over[]';
                hiddenInput.value = cb.value;
                hiddenInput.className = 'dynamic-berkas';
                form.appendChild(hiddenInput);
            });

            // 2. Jika input teks "Yang Lain" terisi dan checkbox-nya aktif, masukkan teksnya sebagai bagian dari array
            if (checkboxLainnya.checked && inputLainnya.value.trim() !== '') {
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'berkas_take_over[]';
                hiddenInput.value = inputLainnya.value.trim();
                hiddenInput.className = 'dynamic-berkas';
                form.appendChild(hiddenInput);
            }

            // Submit form setelah data disiapkan
            form.submit();
        }
    </script>
</body>
</html>