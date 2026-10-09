@include('superadmin.navigation')

<main class="flex-1 p-8">

    <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6"> Laporan Sistem
    </h1>

    <div class="overflow-hidden rounded-2xl bg-white">

        <div class="flex justify-between bg-[#e9cf85] px-6 py-4 font-semibold">
            <p>Periode</p>
            <p>Total Transaksi</p>
        </div>

        @foreach ($laporan as $index => $data)
            @php
                $start = \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->startOfMonth()->format('d/m/Y');
                $end = \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->endOfMonth()->format('d/m/Y');
            @endphp

            <div class="flex justify-between px-6 py-5 border-b">

                <p>
                    {{ $index + 1 }}. {{ $start }} - {{ $end }}
                </p>

                <p class="font-bold text-blue-700">
                    {{ $data->total }} transaksi
                </p>

            </div>
        @endforeach

    </div>

</main>
