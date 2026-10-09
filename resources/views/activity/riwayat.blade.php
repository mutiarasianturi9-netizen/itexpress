@include ('activity.index')

@if ($orders->isEmpty())

    <div class="p-2">
        <h1 class="text-[#123c2f] text-2xl font-bold">
            Belum ada riwayat
        </h1>
    </div>
@else
    @foreach ($orders as $order)
        <div class="bg-[#fbf7ef] rounded-[22px] px-5 py-5 flex items-center gap-5 mb-4">

            <div class="bg-[#123c2f]/20 rounded-[22px] px-5 py-5 flex items-center gap-5 shadow-sm w-full">

                <!-- FOTO -->
                <div class="w-[150px] h-[150px] rounded-full overflow-hidden flex-shrink-0">

                    <img src="{{ asset('img/teknisi/' . $order->technician->photo) }}" alt="Teknisi"
                        class="w-full h-full object-cover">

                </div>

                <!-- ISI -->
                <div class="flex-1">

                    <h3 class="text-[20px] font-extrabold text-black">
                        {{ $order->technician->name }}
                    </h3>

                    <p class="text-[#757575] text-sm mt-1">
                        {{ $order->service->name }}
                    </p>

                    <button class="mt-3 bg-green-600 text-white text-sm font-bold px-8 py-2 rounded-full">

                        {{ $order->status->name }}

                    </button>
                    @if (!$order->review)
                        <button
                            onclick="document.getElementById('reviewModal{{ $order->id }}').classList.remove('hidden')"
                            class="mt-3 bg-[#123c2f] text-white px-5 py-2 rounded-full text-sm font-bold">

                            Berikan Ulasan

                        </button>
                    @else
                        <button
                            class="mt-3 bg-gray-400 text-white px-5 py-2 rounded-full text-sm font-bold cursor-not-allowed">

                            Sudah Diulas

                        </button>
                    @endif

                    <!-- MODAL -->
                    <div id="reviewModal{{ $order->id }}"
                        class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

                        <div class="bg-[#f5f1ea] w-[500px] rounded-[35px] p-10 relative">

                            <!-- CLOSE -->
                            <button
                                onclick="document.getElementById('reviewModal{{ $order->id }}').classList.add('hidden')"
                                class="absolute top-5 right-5 text-xl">

                                ✕

                            </button>

                            <h1 class="text-3xl font-bold text-center mb-8">
                                Beri Bintang & Ulasan
                            </h1>

                            <form action="{{ route('review.store') }}" method="POST">

                                @csrf

                                <input type="hidden" name="order_id" value="{{ $order->id }}">

                                <div class="flex flex-row-reverse justify-center gap-2 mb-10">

                                    <!-- 5 -->
                                    <input type="radio" name="rating" id="star5" value="5"
                                        class="peer/star5 hidden" />
                                    <label for="star5"
                                        class="text-5xl cursor-pointer text-gray-300
        hover:text-yellow-400
        peer-checked/star5:text-yellow-400">
                                        ★
                                    </label>

                                    <!-- 4 -->
                                    <input type="radio" name="rating" id="star4" value="4"
                                        class="peer/star4 hidden" />
                                    <label for="star4"
                                        class="text-5xl cursor-pointer text-gray-300
        hover:text-yellow-400
        peer-checked/star4:text-yellow-400
        peer-checked/star5:text-yellow-400">
                                        ★
                                    </label>

                                    <!-- 3 -->
                                    <input type="radio" name="rating" id="star3" value="3"
                                        class="peer/star3 hidden" />
                                    <label for="star3"
                                        class="text-5xl cursor-pointer text-gray-300
        hover:text-yellow-400
        peer-checked/star3:text-yellow-400
        peer-checked/star4:text-yellow-400
        peer-checked/star5:text-yellow-400">
                                        ★
                                    </label>

                                    <!-- 2 -->
                                    <input type="radio" name="rating" id="star2" value="2"
                                        class="peer/star2 hidden" />
                                    <label for="star2"
                                        class="text-5xl cursor-pointer text-gray-300
        hover:text-yellow-400
        peer-checked/star2:text-yellow-400
        peer-checked/star3:text-yellow-400
        peer-checked/star4:text-yellow-400
        peer-checked/star5:text-yellow-400">
                                        ★
                                    </label>

                                    <!-- 1 -->
                                    <input type="radio" name="rating" id="star1" value="1"
                                        class="peer/star1 hidden" />
                                    <label for="star1"
                                        class="text-5xl cursor-pointer text-gray-300
        hover:text-yellow-400
        peer-checked/star1:text-yellow-400
        peer-checked/star2:text-yellow-400
        peer-checked/star3:text-yellow-400
        peer-checked/star4:text-yellow-400
        peer-checked/star5:text-yellow-400">
                                        ★
                                    </label>

                                </div>

                                <!-- KOMENTAR -->
                                <div>

                                    <h2 class="text-2xl font-bold mb-4">
                                        Beri komentar
                                    </h2>

                                    <textarea name="comment" placeholder="Beri komentar"
                                        class="w-full bg-[#6f867d] text-white placeholder:text-white/70 rounded-full px-6 py-4 outline-none resize-none"></textarea>

                                </div>

                                <!-- BUTTON -->
                                <button type="submit"
                                    class="w-full mt-8 bg-[#123c2f] text-white py-3 rounded-full font-bold">

                                    Kirim Ulasan

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endforeach

@endif
