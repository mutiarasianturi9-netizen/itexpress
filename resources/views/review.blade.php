@include('layouts.header')

<!-- ULASAN SECTION -->
<section class="px-10 py-10 bg-[#fbf7ef] min-h-screen">

    <div class="grid grid-cols-[330px_1fr] gap-8 items-start">

        <!-- LEFT CARD -->
        <div class="bg-[#0e4d38] rounded-[40px] p-8 min-h-[540px] flex flex-col justify-between">

            <div>

                <!-- LABEL -->
                <p class="text-[#f2c14e] text-xs font-bold uppercase tracking-wide">
                    Ulasan Pelanggan
                </p>

                <!-- TITLE -->
                <h1 class="text-[43px] leading-[45px] font-extrabold text-white mt-6">
                    Kepercayaan dibangun dari pengalaman nyata
                </h1>

                <!-- DESC -->
                <p class="text-[#d4d4d4] text-base leading-8 mt-8">
                    Halaman review membantu calon pelanggan melihat layanan
                    kami agar bisa memakai teknisi dan kualitas dari teknisi
                    yang kami sediakan
                </p>
            </div>

            <!-- RATING -->
            <div class="mt-10">

                <div class="flex items-end gap-3">

                    <span class="text-[#f2c14e] text-[70px] font-extrabold leading-none">
                        4.8
                    </span>

                    <div class="mb-3">
                        <p class="text-[#f2c14e] text-[22px]">
                            ★★★★★
                        </p>

                        <p class="text-[#d4d4d4] text-sm mt-1">
                            dari 1.240 ulasan
                        </p>
                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT REVIEW -->
        <div class="space-y-6">

            @forelse ($reviews as $review)

                <div class="bg-white border border-[#ead8b1] rounded-[30px] p-8">

                    <div class="flex justify-between items-start gap-5">

                        <div>

                            <h3 class="text-[20px] font-extrabold text-[#1f1f1f]">

                                {{ $review->order->user->name ?? 'User' }}

                            </h3>

                            <p class="text-[#7c7567] text-sm mt-2">

                                {{ $review->created_at->format('d M Y') }}

                            </p>

                            <p class="text-[#7c7567] text-base mt-5 leading-7">

                                "{{ $review->comment }}"

                            </p>

                        </div>

                        <!-- BINTANG -->
                        <div class="text-[#f2c14e] text-xl flex-shrink-0">

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white border border-[#ead8b1] rounded-[30px] p-8">

                    <h1 class="text-xl font-bold text-[#123c2f]">
                        Belum ada ulasan
                    </h1>

                </div>

            @endforelse

        </div>
    </div>


</section>

@include('layouts.footer')
