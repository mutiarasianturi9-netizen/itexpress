@include('superadmin.navigation')

<main class="flex-1 p-8 bg-[#f6f4ee] min-h-screen">

    <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-sm p-10">

        <h1 class="text-4xl font-serif text-[#6d5a28] mb-8">
            Edit Admin
        </h1>

        <form action="{{ route('superadmin.admins.update', $admin->id) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Nama</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $admin->name) }}"
                       class="w-full border border-gray-300 rounded-2xl px-4 py-3">
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $admin->email) }}"
                       class="w-full border border-gray-300 rounded-2xl px-4 py-3">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Password</label>
                <input type="password"
                       name="password"
                       placeholder="Kosongkan jika tidak diubah"
                       class="w-full border border-gray-300 rounded-2xl px-4 py-3">
            </div>

            <!-- STATUS -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Status</label>
                <select name="status"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3">

                    <option value="aktif" {{ $admin->status == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="nonaktif" {{ $admin->status == 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>
            </div>

            <!-- ROLE -->
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Role</label>
                <select name="role_id"
                        class="w-full border border-gray-300 rounded-2xl px-4 py-3">

                    <option value="1" {{ $admin->role_id == 1 ? 'selected' : '' }}>
                        Super Admin
                    </option>

                    <option value="2" {{ $admin->role_id == 2 ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="3" {{ $admin->role_id == 3 ? 'selected' : '' }}>
                        User
                    </option>

                </select>
            </div>

            <!-- BUTTON -->
            <div class="flex gap-4 pt-4">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-semibold">

                    Simpan
                </button>

                <a href="{{ route('superadmin.admins.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-2xl font-semibold">

                    Kembali
                </a>

            </div>

        </form>

    </div>

</main>