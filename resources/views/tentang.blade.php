@include('layouts.header')

{{-- Halaman Tentang: foto teknisi di kiri, kartu penjelasan di kanan (font Inter sesuai desain) --}}
<main class="px-6 lg:px-10 pb-20 font-['Inter']">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[2fr_3fr] gap-8 lg:gap-10 items-start">

        <!-- ===================== KOLOM KIRI: 2 FOTO ===================== -->
        {{-- lg:mt-16 menurunkan foto sedikit agar sejajar dengan desain --}}
        <div class="flex flex-col gap-10 lg:mt-16">
            <img src="{{ asset('img/tentang-1.jpg') }}" alt="Teknisi memperbaiki laptop"
                class="w-full aspect-[551/308] object-cover">

            <img src="{{ asset('img/tentang-2.jpg') }}" alt="Teknisi memeriksa komponen laptop"
                class="w-full aspect-[578/336] object-cover">
        </div>

        <!-- ===================== KOLOM KANAN ===================== -->
        <div>

            <!-- Kartu besar biru keabu-abuan -->
            <section class="bg-[#bacbdd] rounded-[40px] px-8 lg:px-11 py-8 shadow-[0_4px_8px_rgba(0,0,0,0.15)]">
                <h1 class="text-3xl lg:text-[40px] font-bold text-[#123c2f] leading-tight">
                    Masalah laptop? Perbaiki dengan mudah dan cepat.
                </h1>

                <p class="text-[#675b43] text-lg leading-8 mt-5">
                    Sistem ITexpress memudahkan pengguna menemukan layanan service laptop yang tepat
                    tanpa rasa khawatir. Dengan informasi teknisi yang lengkap, tombol pilih layanan
                    dengan cepat, serta fitur upload foto kerusakan, pengguna dapat menjelaskan masalah
                    laptop dan mengetahui perkiraan jenis pekerjaan serta biaya sebelum laptop diperbaiki.
                </p>
            </section>

            <!-- 4 kartu putih (2 x 2) -->
            @php
                $keunggulan = [
                    [
                        'judul' => 'Teknisi Terpercaya',
                        'isi'   => 'Temukan teknisi sesuai kebutuhan service laptop dengan melihat profil, keahlian, rating, dan perkiraan harga',
                    ],
                    [
                        'judul' => 'Service Lebih Aman',
                        'isi'   => 'Informasi teknisi dan detail perbaikan ditampilkan secara jelas agar pelanggan lebih nyaman saat menggunakan layanan.',
                    ],
                    [
                        'judul' => 'Pesan dengan Mudah',
                        'isi'   => 'Pilih jenis kerusakan, tentukan layanan yang dibutuhkan, lalu lakukan pemesanan dengan cepat.',
                    ],
                    [
                        'judul' => 'Solusi Masalah Laptop',
                        'isi'   => 'Melayani berbagai kerusakan laptop, mulai dari masalah software, keyboard, baterai, layar, hingga komponen lainnya.',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                @foreach ($keunggulan as $item)
                    <article class="bg-[#fdfeff] rounded-[32px] px-7 py-7 shadow-sm">
                        <h2 class="text-xl font-semibold text-[#111]">{{ $item['judul'] }}</h2>
                        <p class="text-[#675b43] text-sm leading-6 mt-3">{{ $item['isi'] }}</p>
                    </article>
                @endforeach
            </div>

        </div>
    </div>
</main>

@include('layouts.footer')