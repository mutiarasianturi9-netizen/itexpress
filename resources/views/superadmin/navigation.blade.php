<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Dashboard Super Admin</title>
</head>

<body class="bg-[#f5f1ea] font-sans">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-[#123c2f] text-white p-5">

            <!-- Logo -->
            <div class="flex items-center gap-4">

                <div class="w-[50px] h-[43px] bg-[#f6c453] rounded-[10px] flex items-center justify-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-[28px] h-auto">
                </div>

                <div>
                    <h1 class="text-[15px] font-bold text-[white]">
                        KangPanggil.in
                    </h1>

                    <p class="mt-2 text-[10px] tracking-normal text-[white] uppercase">
                        Teknisi Datang Ke Rumah
                    </p>
                    <p class="text-[10px] text-[#f6c453] font-bold tracking-[2px]">
                        Super Admin
                    </p>
                </div>

            </div>

            <!-- Menu -->
            <nav class="mt-5 space-y-2 text-sm">

                <!-- Active -->
                <a href="{{ route('superadmin.dashboard') }}"
                    class="mt-2 flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors
{{ request()->routeIs('superadmin.dashboard')
    ? 'text-[#123c2f] bg-[#f6c453] font-semibold'
    : 'text-gray-300 hover:text-white hover:bg-white/10' }}">Dashboard
                </a>

               <a href="{{ route('superadmin.admins.index') }}"
                    class="mt-2 flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors
{{ request()->routeIs('superadmin.admins.index')
    ? 'text-[#123c2f] bg-[#f6c453] font-semibold'
    : 'text-gray-300 hover:text-white hover:bg-white/10' }}">Admin
                    Management
                </a>

                <a
                    href="{{ route('superadmin.technicians') }}"class="mt-2 flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors
{{ request()->routeIs('superadmin.technicians')
    ? 'text-[#123c2f] bg-[#f6c453] font-semibold'
    : 'text-gray-300 hover:text-white hover:bg-white/10' }}">Teknisi
                    Management
                </a>

                <a href="{{ route('superadmin.services') }}"
                    class="mt-2 flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors
{{ request()->routeIs('superadmin.services')
    ? 'text-[#123c2f] bg-[#f6c453] font-semibold'
    : 'text-gray-300 hover:text-white hover:bg-white/10' }}">Layanan
                </a>

                <a href="{{ route('superadmin.transactions') }}"
                    class="mt-2 flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors
{{ request()->routeIs('superadmin.transactions')
    ? 'text-[#123c2f] bg-[#f6c453] font-semibold'
    : 'text-gray-300 hover:text-white hover:bg-white/10' }}">Monitoring
                    Transaksi
                </a>

                <a href="{{ route('superadmin.reports') }}"
                    class="mt-2 flex items-center gap-3 px-3 py-2.5 text-sm rounded-xl transition-colors
{{ request()->routeIs('superadmin.reports')
    ? 'text-[#123c2f] bg-[#f6c453] font-semibold'
    : 'text-gray-300 hover:text-white hover:bg-white/10' }}">Laporan
                    Sistem
                </a>

                <!-- PROFILE BAWAH -->
                <div class="relative mt-4 border-t border-white/10 pt-4">

                    <details class="group">

                        <!-- BUTTON -->
                        <summary
                            class="flex items-center justify-between list-none cursor-pointer px-3 py-3 rounded-2xl hover:bg-white/10 transition">

                            <div class="flex items-center gap-3">

                                <!-- FOTO / INISIAL -->
                                <div
                                    class="w-10 h-10 rounded-full bg-[#f6c453] text-[#123c2f] flex items-center justify-center font-bold uppercase">

                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                                </div>

                                <p class="text-xs text-gray-400">

                                    @if (auth()->user()->role_id == 1)
                                        Super Admin
                                    @elseif (auth()->user()->role_id == 2)
                                        Admin
                                    @else
                                        User
                                    @endif

                                </p>

                            </div>

                            <!-- ICON -->
                            <svg class="w-4 h-4 text-gray-400 group-open:rotate-180 transition" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>

                        </summary>

                        <!-- DROPDOWN -->
                        <div class="mt-2 bg-[#223b22] rounded-2xl p-2 border border-white/10 shadow-xl">

                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-3 text-sm text-gray-200 hover:bg-white/10 rounded-xl transition">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-red-300 hover:bg-red-500/10 rounded-xl transition">
                                    Logout
                                </button>

                            </form>

                        </div>

                    </details>

                </div>


            </nav>

        </aside>
