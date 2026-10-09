@include('superadmin.navigation')

<main class="flex-1 p-7 bg-[#f8f5ef] min-h-screen">

    <div class="max-w-3xl mx-auto rounded-2xl bg-white p-8 shadow">

        <h1 class="mb-8 text-3xl font-bold text-[#6d5a28]">
            Edit Teknisi
        </h1>

        <form
            action="{{ route('superadmin.technicians.update', $technician->id) }}"
            method="POST"
            class="space-y-5"
        >

            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block font-semibold">
                    Nama Teknisi
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ $technician->name }}"
                    class="w-full rounded-xl border px-4 py-3"
                >
            </div>

            <div>
                <label class="mb-2 block font-semibold">
                    Umur
                </label>

                <input
                    type="number"
                    name="age"
                    value="{{ $technician->age }}"
                    class="w-full rounded-xl border px-4 py-3"
                >
            </div>

            <div>
                <label class="mb-2 block font-semibold">
                    No HP
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ $technician->phone }}"
                    class="w-full rounded-xl border px-4 py-3"
                >
            </div>

            <div>
                <label class="mb-2 block font-semibold">
                    Alamat
                </label>

                <textarea
                    name="address"
                    class="w-full rounded-xl border px-4 py-3"
                >{{ $technician->address }}</textarea>
            </div>

            <div>
                <label class="mb-2 block font-semibold">
                    Harga
                </label>

                <input
                    type="text"
                    name="price_range"
                    value="{{ $technician->price_range }}"
                    class="w-full rounded-xl border px-4 py-3"
                >
            </div>

            <div>
                <label class="mb-2 block font-semibold">
                    Foto
                </label>

                <input
                    type="text"
                    name="photo"
                    value="{{ $technician->photo }}"
                    class="w-full rounded-xl border px-4 py-3"
                >
            </div>

            <div>
                <label class="mb-2 block font-semibold">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border px-4 py-3"
                >

                    <option
                        value="1"
                        {{ $technician->status == 1 ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        {{ $technician->status == 0 ? 'selected' : '' }}
                    >
                        Tidak Aktif
                    </option>

                </select>
            </div>

            <div>
                <label class="mb-2 block font-semibold">
                    Layanan
                </label>

                <select
                    name="service_id"
                    class="w-full rounded-xl border px-4 py-3"
                >

                    @foreach($services as $service)

                        <option
                            value="{{ $service->id }}"
                            {{ $technician->service_id == $service->id ? 'selected' : '' }}
                        >
                            {{ $service->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="rounded-xl bg-green-700 px-6 py-3 text-white hover:bg-green-800"
                >
                    Update Teknisi
                </button>

                <a
                    href="{{ route('superadmin.technicians') }}"
                    class="rounded-xl bg-gray-500 px-6 py-3 text-white hover:bg-gray-600"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</main>