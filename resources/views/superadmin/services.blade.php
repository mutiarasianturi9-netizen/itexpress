@include('superadmin.navigation')

<!-- CONTENT -->
<main class="flex-1 p-8 bg-[#f8f5ef] min-h-screen">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6"> Layanan Management
        </h1>

        <p class="text-gray-500">
            Kelola data Layanan KangPanggil
        </p>

    </div>

    <!-- SUCCESS -->
    @if (session('success'))
        <div class="mb-5 rounded-2xl bg-green-100 px-5 py-4 text-green-700">

            {{ session('success') }}

        </div>
    @endif

    <!-- Search & Button -->
    <div class="mb-5">

        <div class="flex items-center gap-4">

            <!-- Search -->
            <div class="relative flex-1">

                <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input type="text" id="searchInput" placeholder="Cari Layanan"
                    class="w-full rounded-2xl bg-white py-3 pl-11 pr-4 text-sm outline-none border border-gray-200"
                    onkeyup="cariLayanan()" />

            </div>

            <!-- Button -->
            <button onclick="bukaPopup()"
                class="flex items-center justify-center gap-2 rounded-xl bg-[#2d6e3e] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1a4a2a]">
                Tambah Layanan
            </button>

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

                    <th class="px-5 py-4 text-left">
                        Nama Layanan
                    </th>

                    <th class="px-5 py-4 text-left">
                        Deskripsi
                    </th>

                    <th class="px-5 py-4 text-left">
                        Status
                    </th>

                    <th class="px-5 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <!-- Body -->
            <tbody id="tableBody">

                @foreach ($services as $service)
                    <tr class="border-t hover:bg-gray-50 service-row">

                        <td class="px-5 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-5 py-4 service-name">
                            {{ $service->name }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $service->description ?? '-' }}
                        </td>

                        <td class="px-5 py-4">

                            @if ($service->status)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Tidak Aktif
                                </span>
                            @endif

                        </td>

                        <!-- AKSI -->
                        <td class="px-5 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <!-- STATUS -->
                                <form action="{{ route('superadmin.services.toggle', $service->id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                        class="rounded-full {{ $service->status ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} px-4 py-1.5 text-xs font-semibold text-white transition">

                                        {{ $service->status ? 'Nonaktifkan' : 'Aktifkan' }}

                                    </button>

                                </form>

                                <!-- HAPUS -->
                                <form action="{{ route('superadmin.services.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded-full bg-red-500 px-4 py-1.5 text-xs font-semibold text-white hover:bg-red-600 transition">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</main>

</div>

<!-- POPUP -->
<div id="popup" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">

    <!-- Card -->
    <div class="w-full max-w-md rounded-3xl bg-white p-7 shadow-2xl">

        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">

            <h2 class="text-2xl font-bold text-gray-800">
                Tambah Layanan
            </h2>

            <button onclick="tutupPopup()" type="button" class="text-2xl text-gray-400 hover:text-red-500">
                <i class="ti ti-x"></i>
            </button>

        </div>

        <!-- FORM -->
        <form action="{{ route('superadmin.services.store') }}" method="POST">

            @csrf

            <!-- Nama -->
            <div class="mb-5">

                <label class="mb-2 block text-sm font-semibold text-gray-600">
                    Nama Layanan
                </label>

                <input type="text" name="name" required placeholder="Masukkan layanan"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm outline-none focus:border-blue-600" />

            </div>

            <!-- Deskripsi -->
            <div class="mb-5">

                <label class="mb-2 block text-sm font-semibold text-gray-600">
                    Deskripsi
                </label>

                <textarea name="description" rows="4" placeholder="Deskripsi layanan"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm outline-none focus:border-blue-600"></textarea>

            </div>

            <!-- Status -->
            <div class="mb-6">

                <label class="mb-2 block text-sm font-semibold text-gray-600">
                    Status
                </label>

                <select name="status"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm outline-none focus:border-blue-600">

                    <option value="1">
                        Aktif
                    </option>

                    <option value="0">
                        Tidak Aktif
                    </option>

                </select>

            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full rounded-2xl bg-[#0b4a3c] py-3 text-sm font-semibold text-white hover:bg-[#08352b]">
                Simpan Layanan
            </button>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>
    function bukaPopup() {

        document
            .getElementById("popup")
            .classList.remove("hidden");

        document
            .getElementById("popup")
            .classList.add("flex");

    }

    function tutupPopup() {

        document
            .getElementById("popup")
            .classList.remove("flex");

        document
            .getElementById("popup")
            .classList.add("hidden");

    }

    function cariLayanan() {

        let input = document
            .getElementById("searchInput")
            .value
            .toLowerCase();

        let rows = document.querySelectorAll(".service-row");

        rows.forEach((row) => {

            let nama = row
                .querySelector(".service-name")
                .innerText
                .toLowerCase();

            if (nama.includes(input)) {

                row.style.display = "";

            } else {

                row.style.display = "none";

            }

        });

    }
</script>

</body>

</html>
