@include('superadmin.navigation')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<!-- CONTENT -->
<main class="flex-1 p-8 bg-[#f6f4ee] min-h-screen">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6">
            Admin Management
        </h1>

        <p class="text-gray-500">
            Kelola data admin KangPanggil
        </p>

    </div>

    <!-- STATISTIK -->
    <div class="mb-6 flex flex-wrap gap-4">

        <!-- TOTAL ADMIN -->
        <div class="flex min-w-[230px] items-center gap-4 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100">

                <i class="ti ti-user-shield text-3xl text-blue-600"></i>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Total Admin
                </p>

                <h2 class="text-3xl font-bold text-gray-800">
                    {{ $admins->count() }}
                </h2>

            </div>

        </div>

    </div>

    <!-- Search & Button -->
    <div class="mb-5">

        <div class="flex items-center gap-4">

            <!-- Search -->
            <div class="relative flex-1">

                <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input type="text" id="searchInput" placeholder="Cari Admin"
                    class="w-full rounded-2xl bg-white py-3 pl-11 pr-4 text-sm outline-none border border-gray-200"
                    onkeyup="cariAdmin()" />

            </div>

            <!-- Button -->
            <button onclick="bukaPopup()"
                class="flex items-center justify-center gap-2 rounded-xl bg-[#2d6e3e] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1a4a2a]">
                Tambah Admin
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
                        Nama Admin
                    </th>
                    <th class="px-5 py-4 text-left">
                        Status
                    </th>
                    <th class="px-5 py-4 text-left">
                        Terakhir Login
                    </th>
                    <th class="px-5 py-4 text-center">
                        Aksi
                    </th>

                </tr>
            </thead>

            <!-- DATA -->
            <tbody>

                @foreach ($admins as $admin)
                    <tr class="admin-row border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- NO -->
                        <td class="px-5 py-4 text-gray-700">
                            {{ $loop->iteration }}
                        </td>

                        <!-- NAMA -->
                        <td class="admin-name px-5 py-4 font-medium text-gray-800">
                            {{ $admin->name }}
                        </td>

                        <!-- STATUS -->
                        <td class="px-5 py-4">
                            <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                                {{ $admin->status ?? 'Aktif' }}
                            </span>
                        </td>

                        <!-- LOGIN -->
                        <td class="px-5 py-4 text-gray-600">
                            {{ $admin->created_at->diffForHumans() }}
                        </td>

                        <!-- AKSI -->
                        <td class="px-5 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('superadmin.admins.edit', $admin->id) }}"
                                    class="rounded-xl bg-yellow-400 px-4 py-2 text-sm font-semibold text-black transition hover:bg-yellow-500">

                                    Edit

                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('superadmin.admins.destroy', $admin->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus admin ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded-xl bg-red-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-600">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>

    </div>

</main>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-[420px] rounded-3xl p-8 shadow-2xl relative">

        <!-- CLOSE -->
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl">

            &times;

        </button>

        <!-- TITLE -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Tambah Admin
        </h2>

        <!-- FORM -->
        <form action="{{ route('superadmin.admins.store') }}" method="POST" class="space-y-5">

            @csrf

            <!-- NAME -->
            <div>

                <label class="block mb-2 text-gray-700 font-semibold">
                    Nama Admin
                </label>

                <input type="text" name="name" placeholder="Masukkan nama admin"
                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            <!-- EMAIL -->
            <div>

                <label class="block mb-2 text-gray-700 font-semibold">
                    Email
                </label>

                <input type="email" name="email" placeholder="Masukkan email"
                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            <!-- PASSWORD -->
            <div class="relative">

                <label class="block mb-2 text-gray-700 font-semibold">
                    Password
                </label>

                <input id="password" type="password" name="password" placeholder="Masukkan password"
                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-blue-500">

                <button type="button" onclick="togglePassword()" class="absolute right-4 top-[50px] text-gray-500">

                    👁️

                </button>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition">

                Simpan Admin

            </button>

        </form>

    </div>

</div>
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

    function cariAdmin() {

        let input = document
            .getElementById("searchInput")
            .value
            .toLowerCase();

        let rows = document.querySelectorAll(".admin-row");

        rows.forEach((row) => {

            let nama = row
                .querySelector(".admin-name")
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
<!-- SCRIPT -->
<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');
    }

    function togglePassword() {

        const password = document.getElementById('password');

        password.type = (password.type === 'password') ? 'text' : 'password';

    }
</script>
