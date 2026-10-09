@include('layouts.header')

<section class="px-10 py-10 bg-[#fbf7ef] min-h-screen">

    <div class="max-w-3xl">
        <h1 class="text-[42px] leading-[48px] font-extrabold text-[#123c2f]">
            Layanan teknisi untuk semua masalah rumah.
        </h1>

        <p class="text-[#7c6b4d] text-base mt-4 leading-7">
            Klik salah satu layanan untuk melihat daftar profil teknisi lengkap.
        </p>
    </div>

    <div class="mt-5 inline-block px-8 py-4 bg-white border border-[#123c2f] rounded-full">
        <p class="text-[#675b43] font-extrabold text-[20px]">
            Profil Teknisi Air
    </div>

    <div class="grid grid-cols-3 gap-6 mt-8">

        @foreach ($technicians as $technician)

        <div class="bg-[#123c2f]/20 rounded-[22px] px-5 py-5 flex items-center gap-5 shadow-sm">

            <div
                class="w-[1`50px] h-[150px] rounded-full bg-[#0e4d38] flex items-center justify-center flex-shrink-0 overflow-hidden">

                <img src="{{ asset('img/teknisi/' . $technician->photo) }}"
                    alt="Teknisi"
                    class="w-full h-full object-cover">
            </div>

            <div class="flex-1">

                <h3 class="py-1 text-[20px] font-extrabold text-black leading-tight">
                    {{ $technician->name }}
                </h3>

                <p class="text-[#757575] text-sm mt-1">
                    {{ $technician->service->name }},
                    {{ $technician->age }} Tahun,
                    {{ $technician->address }}
                </p>

                <p class="text-[#123c2f] text-[18px] font-extrabold mb-5">
                    Rp {{ $technician->price_range }}
                </p>

                <a href="{{ route('pemesanan', $technician->id) }}"
                    class="mt-4 bg-[#efc14c] text-black text-sm font-bold px-8 py-2 rounded-full hover:brightness-95 transition">

                    Pilih
                </a>

            </div>
        </div>

        @endforeach

    </div>

</section>

@include('layouts.footer')