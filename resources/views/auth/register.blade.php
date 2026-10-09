<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - ITexpress</title>

    {{-- Font desain: Poppins (judul & label) + Inter (placeholder & teks kecil) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    },
                },
            },
        }
    </script>
</head>

{{-- Halaman ini berdiri sendiri (tidak memakai x-guest-layout) supaya tampilannya persis desain --}}
<body class="bg-[#f0f6ff] font-sans text-[#111] min-h-screen">

    <!-- Tombol kembali (panah kiri atas) -->
    <a href="{{ route('home') }}" aria-label="Kembali ke beranda"
        class="absolute left-6 top-8 text-[#123c2f] hover:opacity-70 transition">
        <svg width="42" height="16" viewBox="0 0 42 16" fill="none" stroke="currentColor" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M41 8H1M1 8l7-7M1 8l7 7" />
        </svg>
    </a>

    <main class="max-w-3xl mx-auto px-4 pt-20 pb-16">

        <!-- JUDUL -->
        <h1 class="font-display font-bold text-4xl md:text-5xl text-[#123c2f] text-center">
            Buat akun pelanggan baru
        </h1>
        <p class="text-center text-[#675b43] text-lg mt-2 mb-10">
            Masukkan data diri anda dengan benar
        </p>

        <!-- KARTU FORM -->
        <div class="bg-white rounded-[48px] md:rounded-[64px] border border-[#efe6d2] px-6 md:px-10 py-10">

            {{-- Pesan error dari validasi Laravel --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- NAMA -->
                <div>
                    <label for="name" class="font-display font-semibold text-xl text-[#123c2f] px-2">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap"
                        class="w-full mt-2 h-14 px-6 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">
                </div>

                <!-- EMAIL (kiri) + NO HP (kanan) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="font-display font-semibold text-xl text-[#123c2f] px-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                            class="w-full mt-2 h-14 px-6 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">
                    </div>

                    <div>
                        <label for="phone" class="font-display font-semibold text-xl text-[#123c2f] px-2">No Hp</label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="No Hp"
                            class="w-full mt-2 h-14 px-6 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">
                    </div>
                </div>

                <!-- ALAMAT -->
                <div>
                    <label for="address" class="font-display font-semibold text-xl text-[#123c2f] px-2">Alamat</label>
                    <input id="address" type="text" name="address" value="{{ old('address') }}"
                        placeholder="Masukkan alamat lengkap"
                        class="w-full mt-2 h-14 px-6 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label for="password" class="font-display font-semibold text-xl text-[#123c2f] px-2">Password</label>
                    <div class="relative mt-2">
                        <input id="password" type="password" name="password" placeholder="Password"
                            class="w-full h-14 pl-6 pr-14 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">

                        {{-- Tombol mata: klik untuk tampilkan / sembunyikan password --}}
                        <button type="button" onclick="togglePassword('password', this)" aria-label="Tampilkan password"
                            class="absolute right-5 top-1/2 -translate-y-1/2 text-[#1a1a1a]">
                            <svg class="eye-closed w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-7s4-7 9-7 9 4 9 7a6.978 6.978 0 01-1.673 4.546M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 6l-18-18" />
                            </svg>
                            <svg class="eye-open w-6 h-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- KONFIRMASI PASSWORD -->
                <div>
                    <label for="password_confirmation" class="font-display font-semibold text-xl text-[#123c2f] px-2">Konfirmasi Password</label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Konfirmasi password"
                            class="w-full h-14 pl-6 pr-14 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">

                        <button type="button" onclick="togglePassword('password_confirmation', this)"
                            aria-label="Tampilkan konfirmasi password"
                            class="absolute right-5 top-1/2 -translate-y-1/2 text-[#1a1a1a]">
                            <svg class="eye-closed w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-7s4-7 9-7 9 4 9 7a6.978 6.978 0 01-1.673 4.546M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 6l-18-18" />
                            </svg>
                            <svg class="eye-open w-6 h-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- KOTAK INFO (hijau mint + ikon centang biru) -->
                <div class="flex items-start gap-4 bg-[#d9eee6] border border-[#2bb5a0] rounded-[28px] px-5 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 shrink-0 text-[#1e88e5]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                    </svg>
                    <p class="font-display font-semibold text-black text-base leading-snug">
                        Dengan akun ini, pelanggan bisa menggunakan jasa kami dalam perbaikan. Kamu Berhasil mendaftar
                    </p>
                </div>

                <!-- TOMBOL DAFTAR -->
                <button type="submit"
                    class="w-full h-14 bg-[#003f9d] hover:bg-[#003585] transition text-white font-display font-bold rounded-full border border-[#e6c35c]">
                    DAFTAR SEKARANG
                </button>
            </form>

            <!-- LINK KE LOGIN -->
            <p class="text-center text-sm font-semibold text-black mt-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-[#0a6b0a] hover:underline">Masuk disini</a>
            </p>
        </div>
    </main>

    <script>
        // Tampilkan / sembunyikan password. Ikon mata ikut berganti.
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const show = input.type === 'password';

            input.type = show ? 'text' : 'password';
            btn.querySelector('.eye-closed').classList.toggle('hidden', show);
            btn.querySelector('.eye-open').classList.toggle('hidden', !show);
        }
    </script>
</body>

</html>