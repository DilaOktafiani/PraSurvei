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

        <!-- FORM UTAMA -->
        <form id="formPraSurvei" action="{{ route('storeAlur1') }}" method="POST" class="space-y-6">
            @csrf

            <!-- KOTAK NOMOR REGISTER -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Nomor Register <span class="text-red-500">*</span>
                </label>
                <input type="text" name="no_register" value="{{ old('no_register', $debitur->no_register ?? '') }}" placeholder="Masukkan nomor register" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
            </div>

            <!-- KOTAK DATA DEBITUR -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">DATA DEBITUR</h3>
                <p class="text-xs text-gray-500 mt-0.5">Isikan data debitur secara rinci</p>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Debitur <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $debitur->nama ?? '') }}" placeholder="Sesuai KTP" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Temuan CA <span class="text-red-500">*</span>
                    </label>
                    <textarea name="temuan_ca" rows="6" placeholder="ex : diisi apabila ada perbedaan data yang ditemukan oleh CA dengan data AO" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('temuan_ca', $debitur->temuan_ca ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Plafon <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="plafon" value="{{ old('plafon', $debitur->plafon ?? '') }}" placeholder="ex : Rp1.000.000.000,-" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tujuan Penggunaan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="tujuan_penggunaan" rows="2" placeholder="ex : Take over BCA 300jt, tambah stok 500jt, membeli mobil 200jt" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">{{ old('tujuan_penggunaan', $debitur->tujuan_penggunaan ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Jangka Waktu <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jangka_waktu" value="{{ old('jangka_waktu', $debitur->jangka_waktu ?? '') }}" placeholder="ex : 36 Bulan" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Estimasi Kewajiban <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="estimasi_kewajiban" value="{{ old('estimasi_kewajiban', $debitur->estimasi_kewajiban ?? '') }}" placeholder="Total angsuran perbulan" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Tipe Fasilitas -->
                @php
                    $savedFasilitas = old('tipe_fasilitas', $debitur->tipe_fasilitas ?? []);
                    $standardOptions = [
                        'Angsuran Pokok + Bunga (Anuitas)',
                        'Angsuran Pokok + Bunga (Murni)',
                        'Non Angsuran Bayar Bunga Saja',
                        'Non Angsuran Rekening Kerja'
                    ];

                    $customFasilitas = '';
                    foreach($savedFasilitas as $sf) {
                        if (!in_array($sf, $standardOptions)) {
                            $customFasilitas = $sf;
                            break;
                        }
                    }
                @endphp
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Fasilitas <span class="text-red-500">*</span>
                    </label>
                    
                    <div class="space-y-3 text-sm text-gray-700">
                        @foreach($standardOptions as $option)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="tipe_fasilitas[]" value="{{ $option }}" 
                                    {{ in_array($option, $savedFasilitas) ? 'checked' : '' }}
                                    class="accent-[#0082CB] w-4 h-4 rounded shrink-0">
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                        
                        <div class="flex items-center gap-2 pt-1">
                            <input type="checkbox" id="checkbox_lainnya" name="tipe_fasilitas[]" value="Yang Lain" 
                                {{ !empty($customFasilitas) ? 'checked' : '' }}
                                class="accent-[#0082CB] w-4 h-4 rounded shrink-0">
                            <label class="whitespace-nowrap text-sm">Yang Lain:</label>
                            
                            <input type="text" id="input_lainnya" name="tipe_fasilitas_lain" 
                                value="{{ old('tipe_fasilitas_lain', $customFasilitas) }}" 
                                placeholder=""
                                class="w-full border-b border-gray-300 px-1 py-0.5 text-sm focus:outline-none focus:border-[#0082CB] transition placeholder-gray-400">
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
    const inputLainnya = document.getElementById('input_lainnya');
    const checkboxLainnya = document.getElementById('checkbox_lainnya');

    // Mengontrol status centang dan value secara dinamis
    inputLainnya.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            checkboxLainnya.checked = true; 
        } else {
            checkboxLainnya.checked = false; 
            checkboxLainnya.value = 'Yang Lain';
        }
    });

    function validateAndSubmit() {
        const formPraSurvei = document.getElementById('formPraSurvei');
        const requiredInputs = formPraSurvei.querySelectorAll('[required]');
        let isValid = true;

        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
            }
        });

        // Validasi khusus: Jika checkbox "Yang Lain" dicentang, pastikan kotak teksnya tidak kosong
        if (checkboxLainnya.checked && inputLainnya.value.trim() === '') {
            isValid = false;
        }

        // Mengecek apakah minimal ada 1 tipe fasilitas yang dicentang
        const checkedFasilitas = formPraSurvei.querySelectorAll('input[name="tipe_fasilitas[]"]:checked');
        if (checkedFasilitas.length === 0) {
            isValid = false;
        }

        if (!isValid) {
            alert('Pertanyaan dengan tanda (*) wajib untuk diisi!');
        } else {
            formPraSurvei.submit(); 
        }
    }
</script>
</body>
</html>