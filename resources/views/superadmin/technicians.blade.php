@include('superadmin.navigation')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<!-- MAIN -->
<main class="flex-1 min-h-screen overflow-y-auto bg-[#f8f5ef] p-7">

    <!-- ALERT -->
    @if (session('success'))
        <div class="mb-5 rounded-xl bg-green-100 px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6"> Teknisi Management
        </h1>

        <p class="text-gray-500">
            Kelola data teknisi KangPanggil
        </p>

    </div>

    <!-- STATISTIK -->
    <div class="mb-6 flex flex-wrap gap-4">

        <!-- TOTAL -->
        <div class="flex min-w-[230px] items-center gap-4 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-yellow-100">

                <i class="ti ti-users text-3xl text-yellow-600"></i>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Total Teknisi
                </p>

                <h2 class="text-3xl font-bold text-gray-800">
                    {{ $technicians->count() }}
                </h2>

            </div>

        </div>

    </div>

    <!-- TOOLBAR -->
    <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center">

        <!-- SEARCH -->
        <div class="relative flex-1">

            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

            <input type="text" id="searchInput" placeholder="Cari Teknisi..."
                class="w-full rounded-xl border border-gray-200 bg-white py-3 pl-11 pr-4 text-sm outline-none transition focus:border-green-700">

        </div>

        <!-- BUTTON -->
        <button onclick="bukaPopup()"
            class="flex items-center justify-center gap-2 rounded-xl bg-[#2d6e3e] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1a4a2a]">
            Tambah Teknisi
        </button>

    </div>

    <!-- POPUP -->
    <div id="popup" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 p-5">

        <div class="flex min-h-full items-center justify-center py-10">

            <!-- CARD -->
            <div class="w-full max-w-2xl rounded-3xl bg-white p-7 shadow-2xl">

                <!-- HEADER -->
                <div class="mb-6 flex items-center justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            Tambah Teknisi
                        </h2>

                        <p class="text-sm text-gray-500">
                            Isi data teknisi baru
                        </p>

                    </div>

                    <button onclick="tutupPopup()" type="button"
                        class="text-3xl text-gray-400 transition hover:text-red-500">
                        <i class="ti ti-x"></i>
                    </button>

                </div>

                <!-- FORM -->
                <form action="{{ route('superadmin.technicians.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">

                    @csrf

                    <!-- NAMA -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Teknisi
                        </label>

                        <input type="text" name="name" required placeholder="Masukkan nama teknisi"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-[#2d6e3e]">

                    </div>

                    <!-- GRID -->
                    <div class="grid gap-5 md:grid-cols-2">

                        <!-- UMUR -->
                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Umur
                            </label>

                            <input type="number" name="age" placeholder="Masukkan umur"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-[#2d6e3e]">

                        </div>

                        <!-- PHONE -->
                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                No HP
                            </label>

                            <input type="text" name="phone" required placeholder="08xxxxxxxx"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-[#2d6e3e]">

                        </div>

                    </div>

                    <!-- ALAMAT -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Alamat
                        </label>

                        <textarea name="address" rows="4" required placeholder="Masukkan alamat"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-[#2d6e3e]"></textarea>

                    </div>

                    <!-- GRID -->
                    <div class="grid gap-5 md:grid-cols-2">

                        <!-- HARGA -->
                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Harga
                            </label>

                            <input type="text" name="price_range" placeholder="Rp 100.000"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-[#2d6e3e]">

                        </div>

                        <!-- STATUS -->
                        <div>

                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Status
                            </label>

                            <select name="status"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-[#2d6e3e]">

                                <option value="1">
                                    Aktif
                                </option>

                                <option value="0">
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- FOTO -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Upload Foto
                        </label>

                        <input type="file" name="photo" class="w-full rounded-xl border border-gray-300 px-4 py-3">

                        <p class="mt-1 text-xs text-gray-400">
                            Upload ke folder public/img/teknisi
                        </p>

                    </div>

                    <!-- LAYANAN -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Layanan
                        </label>

                        <select name="service_id" required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-[#2d6e3e]">

                            <option value="">
                                -- Pilih Layanan --
                            </option>

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full rounded-xl bg-[#2d6e3e] py-4 text-sm font-bold text-white transition hover:bg-[#1a4a2a]">
                        Simpan Teknisi
                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-[#D3D3D3] bg-white">

        <table class="w-full text-sm">

            <!-- Head -->
            <thead class="bg-[#f0d690] text-[#4e3d00]">

                <tr>

                    <th class="px-5 py-4 text-left">
                        No
                    </th>

                    <th class="px-5 py-4 text-left ">
                        Foto
                    </th>

                    <th class="px-5 py-4 text-left ">
                        Nama Teknisi
                    </th>

                    <th class="px-5 py-4 text-left ">
                        No HP
                    </th>

                    <th class="px-5 py-4 text-left ">
                        Status
                    </th>

                    <th class="px-5 py-4 text-left ">
                        Layanan
                    </th>

                    <th class="px-5 py-4 text-left ">
                        Harga
                    </th>

                    <th class="px-5 py-4 text-left ">
                        Aksi
                    </th>

                </tr>

            </thead>

            <!-- BODY -->
            <tbody id="tableBody">

                @forelse($technicians as $technician)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-5 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <!-- FOTO -->
                        <td class="px-5 py-4">

                            @if ($technician->photo)
                                <img src="{{ asset('img/teknisi/' . $technician->photo) }}" alt="foto"
                                    class="h-14 w-14 rounded-full object-cover">
                            @else
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gray-200">

                                    <i class="ti ti-user text-2xl text-gray-500"></i>

                                </div>
                            @endif

                        </td>

                        <!-- NAMA -->
                        <td class="px-5 py-4 font-semibold text-gray-700">
                            {{ $technician->name }}
                        </td>

                        <!-- PHONE -->
                        <td class="px-5 py-4">
                            {{ $technician->phone }}
                        </td>

                        <!-- STATUS -->
                        <td class="px-5 py-4">

                            @if ($technician->status)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Tidak Aktif
                                </span>
                            @endif

                        </td>

                        <!-- LAYANAN -->
                        <td class="px-5 py-4">
                            {{ $technician->service->name ?? '-' }}
                        </td>

                        <!-- HARGA -->
                        <td class="px-5 py-4">
                            {{ $technician->price_range }}
                        </td>

                        <!-- AKSI -->
                        <td class="px-5 py-4">

                            <div class="flex gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('superadmin.technicians.edit', $technician->id) }}"
                                    class="rounded-lg bg-green-700 px-4 py-2 text-xs font-semibold text-white transition hover:bg-green-800">
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('superadmin.technicians.destroy', $technician->id) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus teknisi ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded-lg bg-red-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-red-700">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="px-5 py-10 text-center text-gray-400">
                            Belum ada data teknisi
                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</main>

<!-- SCRIPT -->
<script>
    function bukaPopup() {

        document
            .getElementById('popup')
            .classList.remove('hidden');

        document.body.style.overflow = 'hidden';
    }

    function tutupPopup() {

        document
            .getElementById('popup')
            .classList.add('hidden');

        document.body.style.overflow = 'auto';
    }

    // SEARCH TABLE
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function() {

        const filter = searchInput.value.toLowerCase();

        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {

            const text = row.innerText.toLowerCase();

            if (text.includes(filter)) {

                row.style.display = '';

            } else {

                row.style.display = 'none';
            }

        });

    });
</script>

</body>

</html>
