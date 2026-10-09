@include('admin.navigation')

<!-- MAIN -->
<main class="flex-1 bg-[#f6f1ea] p-6 overflow-auto">

    <!-- TITLE -->
    <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6">
        Pesan Kontak User
    </h1>

    <!-- STATS -->
    <div class="grid grid-cols-3 gap-4 mb-6">

        <!-- TOTAL -->
        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-500 text-sm">
                Total Pesan
            </p>

            <h2 class="text-4xl font-bold text-gray-700">
                {{ $contacts->count() }}
            </h2>

            <p class="text-red-500 text-xs">
                Semua pesan user
            </p>
        </div>

        <!-- HARI INI -->
        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-500 text-sm">
                Hari Ini
            </p>

            <h2 class="text-4xl font-bold text-gray-700">
                {{ $contacts->where('created_at', '>=', now()->startOfDay())->count() }}
            </h2>

            <p class="text-red-500 text-xs">
                Pesan masuk hari ini
            </p>
        </div>

        <!-- EMAIL -->
        <div class="animate-fadeUp bg-white rounded-2xl border border-amber-300 p-6 shadow-sm">
            <p class="text-gray-500 text-sm">
                Kontak Aktif
            </p>

            <h2 class="text-4xl font-bold text-gray-700">
                {{ $contacts->count() }}
            </h2>

            <p class="text-red-500 text-xs">
                User menghubungi admin
            </p>
        </div>

    </div>

    <!-- TABEL -->
    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-amber-100 flex items-center justify-between">

            <h2 class="font-bold text-brand-dark text-base">
                Data Pesan User
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm border-collapse">

                <thead>

                    <tr class="bg-amber-50 text-gray-500 text-xs uppercase tracking-wide">

                        <th class="px-4 py-3 text-left font-semibold">
                            Nama
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            Email
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            Pesan
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            Tanggal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($contacts as $contact)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- NAMA -->
                            <td class="px-4 py-4 font-semibold text-[#123c2f]">
                                {{ $contact->name }}
                            </td>

                            <!-- EMAIL -->
                            <td class="px-4 py-4 text-gray-600">
                                {{ $contact->email }}
                            </td>

                            <!-- PESAN -->
                            <td class="px-4 py-4 max-w-[420px]">

                                <div class="bg-[#faf6ee] border border-[#ead8b1] rounded-xl px-4 py-3">

                                    <p class="text-gray-700 leading-7">
                                        {{ $contact->message }}
                                    </p>

                                </div>

                            </td>

                            <!-- TANGGAL -->
                            <td class="px-4 py-4 text-gray-500">
                                {{ $contact->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">

                                Belum ada pesan dari user

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>