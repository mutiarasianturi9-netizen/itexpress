<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ITexpress - Solusi Lengkap HP & Laptop Anda</title>

    {{-- Font desain: Poppins (teks utama) + Space Mono (label kecil "Layanan Kami") --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    {{-- Tailwind lewat CDN (sama seperti sebelumnya) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Pasang font Poppins sebagai font default seluruh halaman
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        mono: ['"Space Mono"', 'monospace'],
                    },
                },
            },
        }
    </script>
</head>

{{-- Latar halaman biru sangat muda, sesuai desain (#f0f6ff) --}}
<body class="bg-[#f0f6ff] font-sans overflow-x-hidden text-[#111]">

    <!-- HEADER -->
    <header class="w-full px-6 lg:px-10 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between gap-6">

            <!-- LOGO ITexpress -->
            <div class="flex items-center gap-6 shrink-0">
                {{-- Panah kembali: tampil di semua halaman kecuali beranda --}}
                @unless (request()->routeIs('home'))
                    <a href="{{ route('home') }}" aria-label="Kembali ke beranda" class="text-[#123c2f] hover:opacity-70 transition">
                        <svg width="38" height="14" viewBox="0 0 42 16" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M41 8H1M1 8l7-7M1 8l7 7" />
                        </svg>
                    </a>
                @endunless

                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/itexpress-logo.png') }}" alt="ITexpress" class="h-12 w-auto">
                </a>
            </div>

            <div class="flex items-center gap-4">

                <!-- NAVIGASI berbentuk pill putih; menu aktif ditandai pill biru -->
                <nav class="bg-white rounded-full px-3 py-2 flex items-center gap-1 text-[13px] font-semibold text-[#3b2a1a] shadow-sm">
                    @php
                        // Daftar menu sesuai desain: Beranda, Tentang, Layanan, Ulasan, Kontak
                        $menus = [
                            ['label' => 'Beranda', 'route' => 'home',          'match' => 'home'],
                            ['label' => 'Tentang', 'route' => 'tentang',       'match' => 'tentang'],
                            ['label' => 'Layanan', 'route' => 'layanan.index', 'match' => 'layanan.*'],
                            ['label' => 'Ulasan',  'route' => 'ulasan',        'match' => 'ulasan'],
                            ['label' => 'Kontak',  'route' => 'kontak',        'match' => 'kontak'],
                        ];
                    @endphp

                    @foreach ($menus as $menu)
                        <a href="{{ route($menu['route']) }}"
                            class="px-4 py-1.5 rounded-full transition
                            {{ request()->routeIs($menu['match'])
                                ? 'bg-[#0b3f9d] text-white'
                                : 'hover:bg-[#e6eefb]' }}">
                            {{ $menu['label'] }}
                        </a>
                    @endforeach
                </nav>

                {{-- Tombol Login: hanya muncul untuk pengunjung yang belum login --}}
                @guest
                    <a href="{{ route('login') }}"
                        class="bg-[#003f9d] hover:bg-[#003585] text-white text-[13px] font-semibold px-6 py-3 rounded-full shadow-sm transition">
                        Login
                    </a>
                @endguest

                {{-- Dropdown user hanya muncul kalau sudah login (agar tetap bisa logout) --}}
                @auth
                    <x-user-dropdown />
                @endauth
            </div>
        </div>
    </header>

</body>

</html>