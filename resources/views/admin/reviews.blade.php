@include('admin.navigation')
<!-- MAIN -->
<main class="flex-1 bg-brand-cream p-8">

    <!-- TITLE -->
            <h1 class="text-3xl font-serif text-[#6d5a28] font-extrabold mb-6">
                Review
            </h1>

    <div class="grid grid-cols-2 gap-6">

        <!-- LEFT -->
        <div class="space-y-4">

            <!-- CARD -->
            @foreach ($reviews as $review)
                <div class="bg-white rounded-2xl p-4 shadow-sm mb-4">

                    <div class="flex items-start justify-between mb-4">

                        <div>
                            <h3 class="text-sm text-gray-700">

                                {{ $review->order->user->name ?? 'User' }},
                                {{ $review->created_at->format('d M') }}

                            </h3>
                        </div>

                        <div class="text-[#efbe4a] text-sm">

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor

                        </div>

                    </div>

                    <p class="text-gray-600 text-sm">
                        {{ $review->comment }}
                    </p>

                </div>
            @endforeach

            <!-- RIGHT -->
            <div class="bg-white border-2 border-[#efbe4a] rounded-2xl p-6 shadow-sm h-fit">

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Distribusi Bintang
                </h2>

                <!-- RATING -->
                <div class="text-center mb-6">

                    <h1 class="text-6xl font-bold text-black">
                        {{ number_format($averageRating, 1) }}
                    </h1>

                    <div class="text-[#efbe4a] text-3xl mt-2">
                        ★★★★★
                    </div>

                    <p class="text-gray-500 mt-2">
                        Dari {{ $totalReviews }} ulasan
                    </p>

                </div>

                <!-- PROGRESS -->
                <div class="space-y-3">

                    <!-- 5 -->
                    <div class="flex items-center gap-3">

                        <span class="text-sm w-4">5</span>

                        <div class="flex-1 bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-red-500 h-full rounded-full"
                                style="width: {{ $totalReviews ? ($fiveStar / $totalReviews) * 100 : 0 }}%">
                            </div>
                        </div>

                    </div>

                    <!-- 4 -->
                    <div class="flex items-center gap-3">

                        <span class="text-sm w-4">4</span>

                        <div class="flex-1 bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-red-500 h-full rounded-full"
                                style="width: {{ $totalReviews ? ($fourStar / $totalReviews) * 100 : 0 }}%">
                            </div>
                        </div>

                    </div>

                    <!-- 3 -->
                    <div class="flex items-center gap-3">

                        <span class="text-sm w-4">3</span>

                        <div class="flex-1 bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-red-500 h-full rounded-full"
                                style="width: {{ $totalReviews ? ($threeStar / $totalReviews) * 100 : 0 }}%">
                            </div>
                        </div>

                    </div>

                    <!-- 2 -->
                    <div class="flex items-center gap-3">

                        <span class="text-sm w-4">2</span>

                        <div class="flex-1 bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-red-500 h-full rounded-full"
                                style="width: {{ $totalReviews ? ($twoStar / $totalReviews) * 100 : 0 }}%">
                            </div>
                        </div>

                    </div>

                    <!-- 1 -->
                    <div class="flex items-center gap-3">

                        <span class="text-sm w-4">1</span>

                        <div class="flex-1 bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-red-500 h-full rounded-full"
                                style="width: {{ $totalReviews ? ($oneStar / $totalReviews) * 100 : 0 }}%">
                            </div>
                        </div>

                    </div>

                </div>

</main>

