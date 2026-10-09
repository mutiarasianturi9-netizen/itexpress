@include ('admin.navigation')

<!-- MAIN CONTENT -->
<main class="flex-1 p-8 overflow-auto">

    <!-- Header -->
    <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6">
        Selamat Datang Di Dashboard Admin
    </h1>

    <!-- Stat Cards -->
    <div class="grid grid-cols-3 gap-6 mb-8">

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-600 text-sm font-semibold mb-3">Total Pesanan</p>
            <p class="text-5xl font-bold text-[#1a2e1a]">{{ $totalOrders }}</p>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-600 text-sm font-semibold mb-3">Pesanan Masuk (Pending)</p>
            <p class="text-5xl font-bold text-[#1a2e1a]">{{ $pendingOrders }}</p>
        </div>

        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-600 text-sm font-semibold mb-3">Review Baru</p>
            <p class="text-5xl font-bold text-[#1a2e1a]">{{ $totalReviews }}</p>
        </div>

    </div>

    <!-- Order Table -->
    <h2 class="font-bold text-[#1a2e1a] text-base mb-2">Order</h2>

    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm mb-8 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-amber-50 text-gray-500 text-xs uppercase tracking-wide">

                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">No Hp</th>
                        <th class="px-4 py-3 text-left">Alamat</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Deskripsi</th>
                        <th class="px-4 py-3 text-left">Foto</th>
                        <th class="px-4 py-3 text-left">Layanan</th>
                        <th class="px-4 py-3 text-left">Teknisi</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>

                    </tr>
                </thead>

                <tbody>

                    @forelse ($orders as $order)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="px-4 py-3">
                                {{ $order->customer_name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $order->phone }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $order->address }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $order->date }}
                            </td>

                            <td class="px-4 py-3 max-w-[250px]">
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

                            <td class="px-4 py-4">
                                {{ $order->service->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $order->technician->name ?? '-' }}
                            </td>

                            <td class="px-4 py-4">

                                @switch($order->status_id)

                                    @case(1)
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                            Pending
                                        </span>
                                        @break

                                    @case(2)
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                                            Diproses
                                        </span>
                                        @break

                                    @case(3)
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                            Selesai
                                        </span>
                                        @break

                                @endswitch

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

                    @empty

                        <tr>
                            <td colspan="10" class="text-center py-6 text-gray-500">
                                Belum ada data order
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Reviews -->
    <h2 class="font-bold text-[#1a2e1a] text-base mb-4">Review Terbaru</h2>

    <div class="grid grid-cols-2 gap-4">

        @forelse ($reviews as $review)

            <div class="bg-white rounded-2xl border border-amber-100 p-5 shadow-sm">

                <div class="flex justify-between mb-3">

                    <div>
                        <p class="font-semibold text-sm">
                            {{ $review->order->user->name ?? 'User' }}
                        </p>

                        <p class="text-gray-400 text-xs">
                            {{ $review->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="text-amber-400">
                        ★ {{ $review->rating }}/5
                    </div>

                </div>

                <p class="text-gray-600 text-sm">
                    {{ $review->comment }}
                </p>

            </div>

        @empty

            <p class="text-gray-500">Belum ada review</p>

        @endforelse

    </div>

</main>