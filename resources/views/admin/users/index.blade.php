@include('admin.navigation')

<!-- MAIN CONTENT -->
<main class="flex-1 p-8 overflow-auto">

    <!-- TITLE -->
    <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6">
        User Management
    </h1>

    <!-- TABEL -->
    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-amber-100 flex items-center justify-between">

            <h2 class="font-bold text-brand-dark text-base">
                Data User
            </h2>

            <p class="text-sm text-gray-500">
                Total User : {{ $users->count() }}
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-amber-50 text-gray-500 text-xs uppercase tracking-wide">

                        <th class="px-4 py-3 text-left font-semibold">
                            Nama
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            Email
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            No. HP
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            Alamat
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            Status
                        </th>

                        <th class="px-4 py-3 text-left font-semibold">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">

                    @forelse ($users as $user)

                        <tr class="hover:bg-amber-50/40 transition-colors">

                            <!-- NAMA -->
                            <td class="px-4 py-3 font-medium text-brand-dark">
                                {{ $loop->iteration }}. {{ $user->name }}
                            </td>

                            <!-- EMAIL -->
                            <td class="px-4 py-3 text-gray-600">
                                {{ $user->email }}
                            </td>

                            <!-- PHONE -->
                            <td class="px-4 py-3 text-gray-600">
                                {{ $user->phone ?? '-' }}
                            </td>

                            <!-- ADDRESS -->
                            <td class="px-4 py-3 text-gray-600">
                                {{ $user->address ?? '-' }}
                            </td>

                            <!-- STATUS -->
                            <td class="px-4 py-3">

                                @if($user->status == 'aktif')

                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-lg">
                                        Aktif
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-lg">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                            <!-- AKSI -->
                            <td class="px-4 py-3">

                                @if($user->status == 'aktif')

                                    <form
                                        action="{{ route('admin.users.disable', $user->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="bg-red-100 hover:bg-red-200 text-red-700 text-xs font-semibold px-4 py-2 rounded-lg transition">

                                            Nonaktifkan

                                        </button>

                                    </form>

                                @else

                                    <form
                                        action="{{ route('admin.users.enable', $user->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="bg-green-100 hover:bg-green-200 text-green-700 text-xs font-semibold px-4 py-2 rounded-lg transition">

                                            Aktifkan

                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">

                                Belum ada user

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>