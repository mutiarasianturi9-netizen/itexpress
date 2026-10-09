@include('layouts.header')

<!-- FORM PEMESANAN -->
<section class="px-10 py-10 bg-[#f5f1ea] min-h-screen">

    <div class="grid grid-cols-[340px_1fr] gap-8 items-start">

        <!-- LEFT CARD -->
        <div class="bg-[#0e4d38] rounded-[40px] p-6 min-h-[760px] flex flex-col justify-between">

            <!-- TOP CONTENT -->
            <div>

                <!-- LABEL -->
                <p class="text-[#f2c14e] text-xs font-bold uppercase tracking-wide">
                    Teknisi Pilihan
                </p>

                <!-- PROFILE -->
                <div class="flex items-center gap-5 mt-10">

                    <!-- IMAGE -->
                    <div
                        class="w-[95px] h-[95px] bg-[#f2c14e] rounded-[22px] flex items-center justify-center flex-shrink-0 overflow-hidden">

                        <img src="{{ asset('img/teknisi/' . $technician->photo) }}"
                            alt="Teknisi"
                            class="w-full h-full object-cover">

                    </div>

                    <!-- NAME -->
                    <div>

                        <h2 class="text-white text-[20px] font-extrabold leading-tight">
                            {{ $technician->name }}
                        </h2>

                        <p class="text-[#cfcfcf] text-base mt-2">
                            {{ $technician->service->name }}
                        </p>

                        <p class="text-[#f2c14e] text-[15px] font-extrabold mt-3">
                            Rp {{ $technician->price_range }}
                        </p>

                    </div>

                </div>

                <!-- INFO BOX -->
                <div class="bg-[#2f654f] rounded-[25px] p-6 mt-10 space-y-5">

                    <div class="flex items-center gap-3">

                        <span class="text-[#f2c14e] text-lg">
                            ⌂
                        </span>

                        <p class="text-white text-base">
                            Alamat: {{ $technician->address }}
                        </p>

                    </div>

                    <div class="flex items-center gap-3">

                        <span class="text-[#f2c14e] text-lg">
                            ◔
                        </span>

                        <p class="text-white text-base">
                            Telepon: {{ $technician->phone }}
                        </p>

                    </div>

                    <div class="flex items-center gap-3">

                        <span class="text-[#f2c14e] text-lg">
                            ☐
                        </span>

                        <p class="text-white text-base">
                            Jadwal dikonfirmasi setelah form
                        </p>

                    </div>

                </div>

            </div>

            <!-- EXPERIENCE BOX -->
            <div class="bg-[#f2c14e] rounded-[25px] p-6 mt-10">

                <h3 class="text-[#123c2f] text-[26px] font-extrabold">
                    Pengalaman Teknisi
                </h3>

                <p class="text-[#123c2f] text-sm leading-6 mt-3">

                    Teknisi profesional dengan pengalaman dalam bidang
                    {{ $technician->service->name }}
                    dan siap menangani berbagai kebutuhan perbaikan rumah Anda.

                </p>

            </div>

        </div>

        <!-- RIGHT FORM -->
        <div class="bg-white border border-[#e6d7b4] rounded-[40px] p-8 min-h-[760px]">

            <!-- LABEL -->
            <p class="text-[#d1a742] text-xs font-bold uppercase tracking-wide">
                Form Pemesanan
            </p>

            <!-- TITLE -->
            <h1 class="text-[25px] leading-[60px] font-extrabold text-[#123c2f] mt-4 max-w-4xl">
                Ceritakan kerusakannya, teknisi menyiapkan alat yang tepat.
            </h1>

            <!-- SUCCESS -->
            @if(session('success'))

            <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-[18px] mt-6">

                Pesanan berhasil dipesan

            </div>

            @endif

            <!-- FORM -->
            <form action="{{ route('orders.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="mt-10 space-y-8"
                onsubmit="return validasiForm()">

                @csrf

                <!-- HIDDEN -->
                <input type="hidden"
                    name="technician_id"
                    value="{{ $technician->id }}">

                <input type="hidden"
                    name="service_id"
                    value="{{ $technician->service_id }}">

                <!-- ROW -->
                <div class="grid grid-cols-2 gap-6">

                    <!-- NAMA -->
                    <div>

                        <label class="block text-sm font-bold text-black mb-3">
                            Nama Anda
                        </label>

                        <input type="text"
                            name="customer_name"
                            placeholder="Masukkan nama Anda"
                            class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none">

                        <p id="error-name"
                            class="text-red-500 text-sm mt-2 hidden">

                            Nama wajib diisi

                        </p>

                    </div>

                    <!-- NO HP -->
                    <div>

                        <label class="block text-sm font-bold text-black mb-3">
                            No HP
                        </label>

                        <input type="text"
                            name="phone"
                            placeholder="Masukkan no hp"
                            class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none">

                        <p id="error-phone"
                            class="text-red-500 text-sm mt-2 hidden">

                            Nomor HP wajib diisi

                        </p>

                    </div>

                </div>

                <!-- ALAMAT -->
                <div class="space-y-6">

                    <!-- PROVINSI -->
                    <div>

                        <label class="block text-sm font-bold text-black mb-3">
                            Provinsi
                        </label>

                        <select
                            id="provinsi"
                            class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none">

                            <option value="">
                                Pilih Provinsi
                            </option>

                            <option value="Sumatera Utara">
                                Sumatera Utara
                            </option>

                            <option value="Sumatera Barat">
                                Sumatera Barat
                            </option>

                            <option value="DKI Jakarta">
                                DKI Jakarta
                            </option>

                            <option value="DI Yogyakarta">
                                DI Yogyakarta
                            </option>

                            <option value="Sulawesi Selatan">
                                Sulawesi Selatan
                            </option>

                            <option value="Jawa Barat">
                                Jawa Barat
                            </option>

                        </select>

                    </div>

                    <!-- KOTA -->
                    <div>

                        <label class="block text-sm font-bold text-black mb-3">
                            Kota / Kabupaten
                        </label>

                        <select
                            id="kota"
                            class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none">

                            <option value="">
                                Pilih Kota
                            </option>

                        </select>

                    </div>

                    <!-- DETAIL ALAMAT -->
                    <div>

                        <label class="block text-sm font-bold text-black mb-3">
                            Detail Alamat
                        </label>

                        <textarea
                            id="detailAlamat"
                            rows="4"
                            placeholder="Contoh: Jl Mawar No 10"
                            class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none resize-none"></textarea>

                    </div>

                    <!-- HIDDEN ADDRESS -->
                    <input type="hidden"
                        name="address"
                        id="address">

                    <p id="error-address"
                        class="text-red-500 text-sm mt-2 hidden">

                        Alamat wajib diisi

                    </p>

                </div>

                <!-- TANGGAL -->
                <div>

                    <label class="block text-sm font-bold text-black mb-3">
                        Tanggal perbaikan
                    </label>

                    <input type="date"
                        name="date"
                        class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none">

                    <p id="error-date"
                        class="text-red-500 text-sm mt-2 hidden">

                        Tanggal wajib diisi

                    </p>

                </div>

                <!-- KELUHAN -->
                <div>

                    <label class="block text-sm font-bold text-black mb-3">
                        Deskripsikan keluhan
                    </label>

                    <textarea rows="5"
                        name="problem"
                        placeholder="Tulis keluhan..."
                        class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none resize-none"></textarea>

                    <p id="error-problem"
                        class="text-red-500 text-sm mt-2 hidden">

                        Keluhan wajib diisi

                    </p>

                </div>

                <!-- FOTO -->
                <div>

                    <label
                        class="border-2 border-dashed border-[#e7d5ad] rounded-[22px] h-[120px] flex flex-col items-center justify-center cursor-pointer bg-[#faf7ef] hover:bg-[#fdf8ea] transition"
                        for="photo">

                        <span class="text-[#4f4f4f] font-semibold text-lg">
                            Upload foto kerusakan
                        </span>

                        <span id="file-name"
                            class="text-sm text-gray-500 mt-2">

                            Belum ada file dipilih

                        </span>

                    </label>

                    <input type="file"
                        id="photo"
                        name="photo"
                        accept="image/*"
                        class="hidden"
                        onchange="previewFileName(this)">

                    <p id="error-photo"
                        class="text-red-500 text-sm mt-3 text-center hidden">

                        Foto kerusakan wajib diupload

                    </p>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-[#f2c14e] hover:brightness-95 transition text-black font-extrabold text-lg h-[70px] rounded-full">

                    Kirim pemesanan

                </button>

            </form>

        </div>

    </div>

</section>

<script>

    // PREVIEW NAMA FILE
    function previewFileName(input) {

        const fileName =
            input.files[0]?.name || 'Belum ada file dipilih';

        document.getElementById('file-name')
            .innerText = fileName;

        if (input.files.length > 0) {

            document.getElementById('error-photo')
                .classList.add('hidden');
        }
    }

    // VALIDASI
    function validasiForm() {

        const nama =
            document.querySelector('[name="customer_name"]');

        const phone =
            document.querySelector('[name="phone"]');

        const address =
            document.querySelector('[name="address"]');

        const date =
            document.querySelector('[name="date"]');

        const problem =
            document.querySelector('[name="problem"]');

        const photo =
            document.querySelector('[name="photo"]');

        const provinsi =
            document.getElementById('provinsi').value;

        const kota =
            document.getElementById('kota').value;

        const detailAlamat =
            document.getElementById('detailAlamat').value;

        // GABUNGKAN ALAMAT
        document.getElementById('address').value =
            provinsi + ', ' + kota + ', ' + detailAlamat;

        let valid = true;

        // RESET ERROR
        document.querySelectorAll('.text-red-500')
            .forEach(el => el.classList.add('hidden'));

        // NAMA
        if (nama.value.trim() === '') {

            document.getElementById('error-name')
                .classList.remove('hidden');

            valid = false;
        }

        // PHONE
        if (phone.value.trim() === '') {

            document.getElementById('error-phone')
                .classList.remove('hidden');

            valid = false;
        }

        // ADDRESS
        if (
            provinsi === '' ||
            kota === '' ||
            detailAlamat.trim() === ''
        ) {

            document.getElementById('error-address')
                .classList.remove('hidden');

            valid = false;
        }

        // DATE
        if (date.value.trim() === '') {

            document.getElementById('error-date')
                .classList.remove('hidden');

            valid = false;
        }

        // PROBLEM
        if (problem.value.trim() === '') {

            document.getElementById('error-problem')
                .classList.remove('hidden');

            valid = false;
        }

        // PHOTO
        if (photo.files.length === 0) {

            document.getElementById('error-photo')
                .classList.remove('hidden');

            valid = false;
        }

        return valid;
    }

    // DATA PROVINSI DAN KOTA
    const dataKota = {

        "Sumatera Utara": [
            "Medan",
            "Binjai",
            "Pematangsiantar",
            "Tebing Tinggi",
            "Sibolga"
        ],

        "Sumatera Barat": [
            "Padang",
            "Bukittinggi",
            "Payakumbuh",
            "Solok",
            "Pariaman"
        ],

        "DKI Jakarta": [
            "Jakarta Selatan",
            "Jakarta Barat",
            "Jakarta Timur",
            "Jakarta Utara",
            "Jakarta Pusat"
        ],

        "DI Yogyakarta": [
            "Yogyakarta",
            "Sleman",
            "Bantul",
            "Kulon Progo",
            "Gunungkidul"
        ],

        "Sulawesi Selatan": [
            "Makassar",
            "Parepare",
            "Palopo",
            "Bone",
            "Bulukumba"
        ],

        "Jawa Barat": [
            "Bandung",
            "Bekasi",
            "Bogor",
            "Depok",
            "Cirebon"
        ]

    };

    // GANTI KOTA OTOMATIS
    document.getElementById('provinsi')
        .addEventListener('change', function () {

            const kota =
                document.getElementById('kota');

            kota.innerHTML =
                '<option value="">Pilih Kota</option>';

            const daftarKota =
                dataKota[this.value];

            if (daftarKota) {

                daftarKota.forEach(function(item) {

                    kota.innerHTML +=
                        `<option value="${item}">
                            ${item}
                        </option>`;

                });

            }

        });

</script>

@include('layouts.footer')