@include ('layouts.header')
<section class="px-10 py-10 bg-[#fbf7ef] min-h-screen">

    <div class="max-w-2xl">
        <h1 class="text-[35px] leading-[45px] font-extrabold text-[#123c2f]">
            Teknisi Sedang Bekerja? Cek progresnya disini.
        </h1>
    </div>

    <!-- BUTTON -->
    <div class="mb-6 mt-5 flex gap-4">

        <!-- RIWAYAT -->
        <a href="{{ route('activity.riwayat') }}"
            class="px-6 py-3 rounded-full text-sm font-semibold shadow-sm transition
        {{ request()->routeIs('activity.riwayat')
            ? 'bg-[#f6c453] text-[#123c2f]'
            : 'bg-[#123c2f] text-white hover:bg-[#0f3328]' }}">
            Riwayat
        </a>

        <!-- DALAM PROSES -->
        <a href="{{ route('activity.dalam-proses') }}"
            class="px-6 py-3 rounded-full text-sm font-semibold shadow-sm transition
        {{ request()->routeIs('activity.dalam-proses')
            ? 'bg-[#f6c453] text-[#123c2f]'
            : 'bg-[#123c2f] text-white hover:bg-[#0f3328]' }}">
            Dalam Proses
        </a>

    </div>
