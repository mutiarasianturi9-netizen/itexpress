<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

{{-- Footer biru tua agar senada dengan tema ITexpress (sebelumnya hijau) --}}
<footer class="bg-[#0b2a66] text-white py-16 font-sans">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

        <!-- Logo + deskripsi -->
        <div>
            {{-- Logo ditaruh di kotak putih supaya teks logo yang biru tua tetap terbaca --}}
            <div class="inline-block bg-white rounded-xl px-4 py-2 mb-4">
                <img src="{{ asset('img/itexpress-logo.png') }}" alt="ITexpress" class="h-10 w-auto">
            </div>

            <p class="text-sm leading-relaxed text-[#d7dfef]">
                Solusi lengkap HP &amp; laptop Anda. Layanan profesional, harga transparan, dan proses cepat.
            </p>
        </div>

        <!-- Kontak -->
        <div>
            <h3 class="text-[#a0b7da] text-lg mb-6 font-semibold">Hubungi Kami</h3>
            <p class="text-sm mb-2">0852-7074-7898</p>
            <p class="text-sm mb-2">itExpress@gmail.com</p>
            <p class="text-sm leading-relaxed">
                Jln. Jamin Ginting, Pajus <br>
                Kec. Selayang, Sumatera Utara
            </p>
        </div>

        <!-- Sosial media -->
        <div>
            <h3 class="text-[#a0b7da] text-lg mb-6 font-semibold">Ikuti Kami</h3>

            <div class="flex gap-4">
                <div class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-full hover:bg-[#a0b7da] hover:text-[#0b2a66] transition">
                    <i class="fab fa-instagram"></i>
                </div>

                <div class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-full hover:bg-[#a0b7da] hover:text-[#0b2a66] transition">
                    <i class="fab fa-facebook-f"></i>
                </div>
            </div>
        </div>

    </div>
</footer>