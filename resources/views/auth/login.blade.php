<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - ITexpress</title>

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

    <!-- LOGO ITexpress (kiri atas, klik untuk ke beranda) -->
    <header class="px-6 md:px-10 pt-6">
        <a href="{{ route('home') }}" class="inline-block">
            <img src="{{ asset('img/itexpress-logo.png') }}" alt="ITexpress" class="h-14 md:h-16 w-auto">
        </a>
    </header>

    <main class="max-w-3xl mx-auto px-4 pt-10 pb-16">

        <!-- JUDUL -->
        <h1 class="font-display font-bold text-4xl md:text-5xl text-[#123c2f] text-center">
            Selamat Datang Kembali
        </h1>
        <p class="text-center text-[#675b43] text-lg mt-4 mb-10 leading-snug">
            Masuk ke akun Anda <br>
            Pastikan Email/No.Hp Anda Sudah Benar
        </p>

        <!-- KARTU FORM -->
        <div class="bg-white rounded-[48px] md:rounded-[64px] border border-[#efe6d2] px-6 md:px-10 py-10">

            {{-- Pesan error dari validasi Laravel --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL / NO HP -->
                <div>
                    <label for="email" class="font-display font-semibold text-xl text-[#123c2f] px-2">Email / No Hp</label>
                    {{-- name="email" dipertahankan seperti file lama supaya proses login tidak berubah --}}
                    <input id="email" type="text" name="email" value="{{ old('email') }}"
                        placeholder="contoh: anda@gmail.com"
                        class="w-full mt-2 h-14 px-6 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label for="password" class="font-display font-semibold text-xl text-[#123c2f] px-2">Password</label>
                    <div class="relative mt-2">
                        <input id="password" type="password" name="password" placeholder="Masukkan Password"
                            class="w-full h-14 pl-6 pr-14 rounded-[32px] bg-[#f0f6ff] border border-[#1a1a1a] text-sm placeholder-[#7a6a4f] outline-none focus:ring-2 focus:ring-[#003f9d]">

                        {{-- Tombol mata: klik untuk tampilkan / sembunyikan password --}}
                        <button type="button" onclick="togglePassword()" aria-label="Tampilkan password"
                            class="absolute right-5 top-1/2 -translate-y-1/2 text-[#1a1a1a]">
                            <svg id="eye-closed" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-7s4-7 9-7 9 4 9 7a6.978 6.978 0 01-1.673 4.546M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 6l-18-18" />
                            </svg>
                            <svg id="eye-open" class="w-6 h-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- INGAT SAYA + LUPA PASSWORD -->
                <div class="flex justify-between items-center px-2">
                    <label class="flex items-center gap-3 text-sm text-[#675b43]">
                        <input type="checkbox" name="remember" class="w-5 h-5 rounded accent-[#003f9d]">
                        ingat saya
                    </label>

                    <a href="{{ route('password.request') }}"
                        class="font-display font-semibold text-sm text-[#1a3cff] hover:underline">
                        Lupa Password?
                    </a>
                </div>

                <!-- TOMBOL MASUK -->
                <button type="submit"
                    class="w-full h-14 mt-6 bg-[#003f9d] hover:bg-[#003585] transition text-white font-display font-semibold rounded-full border border-[#e6c35c]">
                    Masuk ke akun
                </button>
            </form>

            <!-- KOTAK LINK DAFTAR -->
            <div class="mt-5 h-14 flex items-center justify-center rounded-full border border-gray-400 text-sm font-semibold text-black">
                <span>
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#0a6b0a] hover:underline">Daftar pelanggan sekarang</a>
                </span>
            </div>
        </div>
    </main>

    <script>
        // Tampilkan / sembunyikan password. Ikon mata ikut berganti.
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeClosed = document.getElementById('eye-closed');
            const eyeOpen = document.getElementById('eye-open');
            const show = password.type === 'password';

            password.type = show ? 'text' : 'password';
            eyeClosed.classList.toggle('hidden', show);
            eyeOpen.classList.toggle('hidden', !show);
        }
    </script>
</body>

</html>