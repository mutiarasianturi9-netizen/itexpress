<x-app-layout>

    <div class="min-h-screen bg-[#fbf7ef] py-12 px-4">

        <!-- HEADER -->
        <div class="w-full max-w-5xl mx-auto flex justify-between items-center mb-8">

            <div class="flex items-center">

                <div
                    class="w-[50px] h-[43px] bg-[#123c2f] rounded-[10px] flex items-center justify-center">

                    <img src="{{ asset('img/logo.png') }}" class="w-[28px]">

                </div>

                <div class="ml-4">

                    <h1 class="text-[22px] font-bold text-[#17201a]">
                        KangPanggil.in
                    </h1>

                    <p class="text-[13px] text-[#f6c453] tracking-[3px]">
                        PROFILE AKUN ADMIN
                    </p>

                </div>

            </div>

            <a href="{{ route('home') }}"
                class="bg-[#f6c453] px-6 py-3 rounded-full text-sm font-semibold text-black">

                Kembali

            </a>

        </div>

        <!-- TITLE -->
        <div class="max-w-5xl mx-auto mb-10">

            <div class="bg-[#123c2f] text-white px-6 py-2 rounded-full inline-block text-sm">
                👤 Pengaturan Akun Admin
            </div>

            <h1 class="text-[42px] leading-[48px] font-extrabold text-[#123c2f] mt-6">
                Kelola profile akun Anda
            </h1>


        </div>

        <!-- CONTENT -->
        <div class="max-w-5xl mx-auto space-y-8">

            <!-- PROFILE -->
            <div class="bg-white rounded-[35px] p-8 shadow-lg border border-[#ead8b1]">

                <div class="mb-8">

                    <h2 class="text-[28px] font-extrabold text-[#123c2f]">
                        Informasi Profile
                    </h2>

                    <p class="text-[#6d6558] mt-2">
                        Update nama, email, dan data akun Anda
                    </p>

                </div>

                <div class="max-w-2xl">

                    @include('profile.partials.update-profile-information-form')

                </div>

            </div>

            <!-- PASSWORD -->
            <div class="bg-white rounded-[35px] p-8 shadow-lg border border-[#ead8b1]">

                <div class="mb-8">

                    <h2 class="text-[28px] font-extrabold text-[#123c2f]">
                        Ubah Password
                    </h2>

                    <p class="text-[#6d6558] mt-2">
                        Gunakan password yang aman agar akun tetap terlindungi
                    </p>

                </div>

                <div class="max-w-2xl">

                    @include('profile.partials.update-password-form')

                </div>

            </div>

            <!-- DELETE -->
            <div class="bg-white rounded-[35px] p-8 shadow-lg border border-red-200">

                <div class="mb-8">

                    <h2 class="text-[28px] font-extrabold text-red-700">
                        Hapus Akun
                    </h2>

                    <p class="text-[#6d6558] mt-2">
                        Setelah akun dihapus, semua data akan hilang permanen
                    </p>

                </div>

                <div class="max-w-2xl">

                    @include('profile.partials.delete-user-form')

                </div>

            </div>

        </div>

    </div>

</x-app-layout>