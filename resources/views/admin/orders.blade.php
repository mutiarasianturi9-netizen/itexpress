@include('admin.navigation')

<!-- MAIN -->
<main class="flex-1 bg-[#f6f1ea] p-6 overflow-auto">

    <!-- TITLE -->
    <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6">
        Silakan Cek Orderan
    </h1>

    <!-- STATS -->
    <div class="grid grid-cols-4 gap-4 mb-5">

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-500 text-sm">Selesai</p>
            <h2 class="text-4xl font-bold text-gray-700">{{ $completedOrders }}</h2>
            <p class="text-red-500 text-xs">Pesanan Selesai</p>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-500 text-sm">Menunggu</p>
            <h2 class="text-4xl font-bold text-gray-700">{{ $pendingOrders }}</h2>
            <p class="text-red-500 text-xs">Cepat Respon</p>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-500 text-sm">Proses</p>
            <h2 class="text-4xl font-bold text-gray-700">{{ $processOrders }}</h2>
            <p class="text-red-500 text-xs">Sedang Berlangsung</p>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-500 text-sm">Total Pesanan</p>
            <h2 class="text-4xl font-bold text-gray-700">{{ $totalOrders }}</h2>
            <p class="text-red-500 text-xs">Order Masuk</p>
        </div>

    </div>

    <!-- TABEL -->
    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-amber-100 flex items-center justify-between">

            <h2 class="font-bold text-brand-dark text-base">
                Data Order
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm border-collapse">

                <thead>
                    <tr class="bg-amber-50 text-gray-500 text-xs uppercase tracking-wide">

                        <th class="px-4 py-3 text-left font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left font-semibold">No Hp</th>
                        <th class="px-4 py-3 text-left font-semibold">Alamat</th>
                        <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                        <th class="px-4 py-3 text-left font-semibold">Foto</th>
                        <th class="px-4 py-3 text-left font-semibold">Layanan</th>
                        <th class="px-4 py-3 text-left font-semibold">Teknisi</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="px-4 py-4">{{ $order->customer_name }}</td>
                            <td class="px-4 py-4">{{ $order->phone }}</td>

                            <td class="px-4 py-4 max-w-[180px] truncate">
                                {{ $order->address }}
                            </td>

                            <td class="px-4 py-4">{{ $order->date }}</td>

                            <td class="px-4 py-4 max-w-[200px] truncate">
                                {{ $order->problem }}
                            </td>

                            <td class="px-4 py-4">
                                @if ($order->photo)
                                    <img src="{{ asset('img/orders/' . $order->photo) }}"
                                        class="w-14 h-14 object-cover rounded-lg">
                                @else
                                    -
                                @endif
                            </td>

                            <!-- LAYANAN -->
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    {{ $order->service->name ?? '-' }}
                                </span>
                            </td>

                            <!-- TEKNISI -->
                            <td class="px-4 py-4">
                                {{ $order->technician->name ?? '-' }}
                            </td>

                            <!-- STATUS -->
                            <td class="px-4 py-4">

                                @if ($order->status_id == 1)
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                        Menunggu
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
                            <!-- AKSI -->
                            <td class="px-4 py-3">

                                <div class="flex gap-2 flex-wrap">

                                    <!-- TERIMA -->
                                    <form action="{{ route('admin.orders.process', $order->id) }}" method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-xs">
                                            Terima
                                        </button>

                                    </form>

                                    <!-- SELESAI -->
                                    <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-xs">
                                            Selesai
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</main>
