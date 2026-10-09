@include('layouts.header')

<main class="px-6 lg:px-10 pb-16">
    <div class="max-w-6xl mx-auto">

        <!-- ===================== HERO ===================== -->
        {{-- Banner biru keabu-abuan (#596d8e): teks di kiri, gambar laptop & HP di kanan --}}
        <section class="relative overflow-hidden bg-[#596d8e] min-h-[380px]">

            {{-- Gambar kanan, dibuat memudar ke kiri (mask) supaya menyatu dengan warna banner --}}
            <img src="{{ asset('img/hero-laptop.png') }}" alt="Laptop dan HP"
                class="absolute right-0 top-0 h-full w-[62%] object-cover object-left hidden md:block"
                style="-webkit-mask-image: linear-gradient(to right, transparent, #000 22%);
                       mask-image: linear-gradient(to right, transparent, #000 22%);">

            <div class="relative z-10 px-8 lg:px-14 py-14 max-w-xl">
                <h1 class="text-4xl lg:text-5xl font-semibold text-white leading-tight">
                    Solusi Lengkap Untuk
                    <span class="text-[#1a1a6e]">HP &amp; Laptop</span> Anda
                </h1>

                <p class="text-white text-base leading-relaxed mt-6 max-w-md">
                    Kami siap membantu mengatasi berbagai masalah pada perangkat Anda
                    dengan layanan profesional, harga transparan, dan proses cepat.
                </p>

                {{-- Tombol utama biru tua --}}
                <a href="{{ route('layanan.index') }}"
                    class="inline-flex items-center gap-4 mt-8 bg-[#003f9d] hover:bg-[#003585] text-white font-semibold px-8 py-4 rounded-xl shadow-lg transition">
                    Pesan Servis Sekarang
                    <span aria-hidden="true">&gt;</span>
                </a>
            </div>
        </section>

        <!-- ===================== STRIP KEUNGGULAN ===================== -->
        {{-- 4 keunggulan dipisah garis tipis vertikal --}}
        <section class="bg-[#d7dfef] border-y border-[#b8c3da] shadow-sm">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-[#a9b5d0]">
                @php
                    $keunggulan = [
                        ['judul' => 'Proses Cepat',        'isi' => 'Tidak perlu menunggu lama'],
                        ['judul' => 'Teknisi Berpengalaman', 'isi' => 'Ditangani oleh ahlinya'],
                        ['judul' => 'Garansi Servis',      'isi' => 'Jaminan kualitas pekerjaan'],
                        ['judul' => 'Harga Transparan',    'isi' => 'Tanpa biaya tersembunyi'],
                    ];
                @endphp

                @foreach ($keunggulan as $item)
                    <div class="px-6 py-4">
                        <h3 class="text-[#2a2a8c] font-semibold text-base">{{ $item['judul'] }}</h3>
                        <p class="text-[#2a2a8c] text-xs mt-1">{{ $item['isi'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ===================== LAYANAN KAMI ===================== -->
        <section class="pt-10 grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

            <!-- Kolom kiri: judul + deskripsi + tombol -->
            <div class="lg:pr-4">
                {{-- Label kecil bergaya mono dengan garis di sampingnya --}}
                <p class="font-mono text-[#2a2a8c] text-base flex items-center gap-3">
                    Layanan Kami
                    <span class="h-px w-10 bg-[#2a2a8c]"></span>
                </p>

                <h2 class="text-3xl font-bold text-black leading-tight mt-4">
                    Berbagai Layanan Service HP &amp; Laptop
                </h2>

                <p class="text-black text-base leading-relaxed mt-4">
                    Kami melayani berbagai kerusakan dan masalah pada perangkat Anda,
                    baik HP maupun laptop.
                </p>

                {{-- Tombol outline putih dengan border biru --}}
                <a href="{{ route('layanan.index') }}"
                    class="inline-flex items-center gap-3 mt-8 bg-white text-[#2a2a8c] font-semibold px-7 py-3 rounded-full border border-[#2a2a8c] shadow-md hover:bg-[#eef3ff] transition">
                    Lihat Semua Layanan
                    <span aria-hidden="true">&gt;</span>
                </a>
            </div>

            {{-- 3 kartu layanan (kolom kanan) --}}
            @php
                $layanan = [
                    [
                        'gambar' => 'layanan-lcd.png',
                        'judul'  => 'Ganti LCD',
                        'isi'    => 'Layar pecah? Kami siap menggantinya dengan layar original dan berkualitas.',
                    ],
                    [
                        'gambar' => 'layanan-laptop.png',
                        'judul'  => 'Perbaikan Laptop',
                        'isi'    => 'Mengatasi berbagai masalah laptop, seperti mati total, overheat, hingga kerusakan hardware & software.',
                    ],
                    [
                        'gambar' => 'layanan-baterai.png',
                        'judul'  => 'Ganti Baterai',
                        'isi'    => 'Baterai cepat drop? Kami menyediakan baterai original dan bergaransi.',
                    ],
                ];
            @endphp

            @foreach ($layanan as $item)
                <article class="bg-[#b4c6d9] rounded-2xl overflow-hidden shadow-md flex flex-col h-full">
                    <img src="{{ asset('img/' . $item['gambar']) }}" alt="{{ $item['judul'] }}"
                        class="w-full h-44 object-cover">

                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-black font-bold text-sm">{{ $item['judul'] }}</h3>
                        <p class="text-[#4a5a72] text-xs leading-relaxed mt-2 flex-1">{{ $item['isi'] }}</p>
                        <a href="{{ route('layanan.index') }}"
                            class="text-[#2a2a8c] font-bold text-xs mt-5 hover:underline">
                            Selengkapnya
                        </a>
                    </div>
                </article>
            @endforeach
        </section>

    </div>
</main>

@include('layouts.footer')