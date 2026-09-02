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
        <form id="formPraSurvei" action="{{ route('storeAlur15') }}" method="POST" class="space-y-6">
            @csrf 
            <input type="hidden" name="debitur_id" value="{{ $debitur->id ?? session('debitur_id') }}">
            <input type="hidden" name="urutan" id="input_urutan" value="{{ $urutan }}">

            <!-- DATA PINJAMAN (SLIK) -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 id="judulPinjaman" class="text-md font-bold text-[#0A3370] border-b pb-2 mb-2">DATA PINJAMAN (SLIK) {{ $urutan }}</h3>
            
                <!-- Nama LJK -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama LJK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_ljk" value="{{ old('nama_ljk', $pinjaman->nama_ljk ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Plafond -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Plafond <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="any" min="0" name="plafond" value="{{ old('plafond', isset($pinjaman) ? (float)$pinjaman->plafond : '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Outstanding -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Outstanding <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="any" min="0" name="outstanding" value="{{ old('outstanding', isset($pinjaman) ? (float)$pinjaman->outstanding : '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Kolekbilitas -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kolekbilitas <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kolekbilitas" value="{{ old('kolekbilitas', $pinjaman->kolekbilitas ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Angsuran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Angsuran <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="any" min="0" name="angsuran" value="{{ old('angsuran', isset($pinjaman) ? (float)$pinjaman->angsuran : '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Keterangan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keterangan" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>{{ old('keterangan', $pinjaman->keterangan ?? '') }}</textarea>
                </div>

                <!-- Jangka Waktu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Jangka Waktu <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jkw" value="{{ old('jkw', $pinjaman->jkw ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Jalan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Jalan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jalan" value="{{ old('jalan', $pinjaman->jalan ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]" required>
                </div>

                <!-- Bunga -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Bunga <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bunga" value="{{ old('bunga', $pinjaman->bunga ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0082CB]">
                </div>

                <!-- Apakah ada pinjaman lain -->
                <div id="containerOpsiLanjut" class="{{ $urutan >= 20 ? 'hidden' : '' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Apakah ada pinjaman lain <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 text-sm text-gray-700">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="apakah_ada_pinjaman_lain" value="YA" 
                                   {{ (old('apakah_ada_pinjaman_lain', $pinjaman->apakah_ada_pinjaman_lain ?? '') === 'YA') ? 'checked' : '' }} 
                                   class="accent-[#0082CB]">
                            <span>ADA</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="apakah_ada_pinjaman_lain" value="TIDAK ADA" 
                                   {{ (old('apakah_ada_pinjaman_lain', $pinjaman->apakah_ada_pinjaman_lain ?? '') === 'TIDAK ADA') ? 'checked' : '' }} 
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

        function keHalamanSebelumnya() {
            if (currentUrutan > 1) {
                window.location.href = "{{ route('z15-pinjaman') }}?urutan=" + (currentUrutan - 1);
            } else {
                window.location.href = "{{ route('z14-data-tambahan') }}";
            }
        }

        function prosesKosongkanForm() {
            const form = document.getElementById('formPraSurvei');
            form.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
            form.querySelectorAll('input[type="number"]').forEach(input => input.value = '');
            form.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
        }
    </script>
</body>
</html>