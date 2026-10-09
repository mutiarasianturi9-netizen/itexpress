@include('superadmin.navigation')

<main class="flex-1 p-6">

    <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6"> Selamat Datang Di Dashboard Super Admin
    </h1>

    <!-- CARD -->
    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-xs text-gray-500">Jumlah User</p>
            <h2 class="text-3xl font-bold">{{ $totalUsers }}</h2>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-xs text-gray-500">Jumlah Admin</p>
            <h2 class="text-3xl font-bold">{{ $totalAdmins }}</h2>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-xs text-gray-500">Jumlah Teknisi</p>
            <h2 class="text-3xl font-bold">{{ $totalTechnicians }}</h2>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-xs text-gray-500">Total Pesanan</p>
            <h2 class="text-3xl font-bold">{{ $totalOrders }}</h2>
        </div>

    </div>

    <!-- LAPORAN -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border">

        <h2 class="font-semibold text-lg mb-4">Laporan</h2>

        <table class="w-full text-sm">

            <thead>
                <tr class="border-b">
                    <th class="text-left py-3">Periode</th>
                    <th class="text-center py-3">Jumlah Transaksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($laporan as $index => $data)
                    @php
                        $start = \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->startOfMonth()->format('d/m/Y');
                        $end = \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->endOfMonth()->format('d/m/Y');
                    @endphp

                    <tr class="border-b">
                        <td class="py-3">
                            {{ $index + 1 }}. {{ $start }} - {{ $end }}
                        </td>

                        <td class="text-center font-bold text-blue-600">
                            {{ $data->total }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="2" class="py-3 text-center text-gray-500">
                            Tidak ada data laporan
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</main>
