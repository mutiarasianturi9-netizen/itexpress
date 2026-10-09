@include ('layouts.header')

<!-- KONTAK SECTION -->
<section class="px-10 py-10 bg-[#fbf7ef] min-h-screen">
    <!-- TITLE -->
    <h1 class="text-[43px] leading-[45px] font-extrabold text-[#123c2f] mt-5">
        Butuh bantuan memilih teknisi?
    </h1>

    <!-- DESC -->
    <p class="text-[#6d6558] text-lg leading-9 mt-5 max-w-[620px]">
        Tim KangPanggil.in siap membantu pelanggan yang bingung menentukan
        kategori layanan, estimasi, atau bantuan pemesanan.
    </p>

    <!-- FORM -->
    <div class="flex justify-center">
        <div class="mt-10 w-full max-w-xl bg-white rounded-[30px] p-8 shadow-lg">

            <!-- TITLE -->
            <h2 class="text-[35px] text-center font-extrabold text-[#123c2f]">
                Kirim Pesan
            </h2>

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mt-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('contact.store') }}" method="POST" class="mt-10 space-y-5">

                @csrf

                <!-- INPUT -->
                <input
                    type="text"
                    name="name"
                    placeholder="Nama lengkap"
                    value="{{ old('name', auth()->user()->name ?? '') }}"
                    class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none focus:ring-2 focus:ring-[#f2c14e]"
                >

                <input
                    type="text"
                    name="email"
                    placeholder="No HP / Email"
                    value="{{ old('email', auth()->user()->email ?? '') }}"
                    class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] focus:outline-none focus:ring-2 focus:ring-[#f2c14e]"
                >

                <!-- TEXTAREA -->
                <textarea
                    rows="5"
                    name="message"
                    placeholder="Tulis pesan Anda"
                    class="w-full px-6 py-5 rounded-[18px] border border-[#e7d5ad] bg-[#faf7ef] resize-none focus:outline-none focus:ring-2 focus:ring-[#f2c14e]"
                >{{ old('message') }}</textarea>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-[#0e4d38] hover:bg-[#0b3f2e] transition text-white font-bold py-5 rounded-full text-lg mt-4">

                    Kirim pesan
                </button>

            </form>

        </div>

    </div>

    <!-- BOTTOM INFO -->
    <div class="bg-[#0e4d38] rounded-[35px] mt-10 px-10 py-8">

        <div class="grid grid-cols-3 gap-10">

            <!-- ITEM 1 -->
            <div>
                <p class="text-[#f2c14e] text-[20] font-bold ">
                    Jam bantuan
                </p>

                <h3 class="text-white text-[20px] font-extrabold mt-2">
                    08.00 - 22.00 WIB
                </h3>
            </div>

            <!-- ITEM 2 -->
            <div>
                <p class="text-[#f2c14e] text-[20] font-bold text-sm">
                    Area awal
                </p>

                <h3 class="text-white text-[20px] font-extrabold mt-2">
                    Medan Petisah
                </h3>
            </div>

            <!-- ITEM 3 -->
            <div>
                <p class="text-[#f2c14e] text-[20] font-bold">
                    Respon
                </p>

                <h3 class="text-white text-[20px] font-extrabold mt-2">
                    Kurang dari 10 menit
                </h3>
            </div>

        </div>

    </div>

</section>

@include('layouts.footer')