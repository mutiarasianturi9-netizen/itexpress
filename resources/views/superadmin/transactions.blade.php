@include('superadmin.navigation')

<main class="flex-1 bg-[#f5f3ef] p-8">

    <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6"> Monitoring Transaksi
    </h1>


    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-[#D3D3D3] bg-white">

        <table class="w-full text-sm">

            <thead class="bg-[#f0d690] text-[#4e3d00]">
                    <tr>
                        <th class="px-6 py-5 text-left">Nama User</th>
                        <th class="px-6 py-5 text-left">Tanggal</th>
                        <th class="px-6 py-5 text-left">Teknisi</th>
                        <th class="px-6 py-5 text-left">Layanan</th>
                        <th class="px-6 py-5 text-left">Keluhan</th>
                        <th class="px-6 py-5 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($orders as $order)
                        <tr class="border-t hover:bg-[#faf7ef]">

                            <td class="px-6 py-5">
                                {{ $order->user->name ?? '-' }}
                            </td>

                            <td class="px-6 py-5">
                                {{ $order->date }}
                            </td>

                            <td class="px-6 py-5">
                                {{ $order->technician->name ?? '-' }}
                            </td>

                            <td class="px-6 py-5">
                                {{ $order->service->name ?? '-' }}
                            </td>

                            <td class="px-6 py-5">
                                {{ $order->problem }}
                            </td>

                            <td class="px-6 py-5">

                                @if ($order->status_id == 1)
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                        Pending
                                    </span>
                                @elseif ($order->status_id == 2)
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                                        Diproses
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                        Selesai
                                    </span>
                                @endif

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
    </div>

</main>
