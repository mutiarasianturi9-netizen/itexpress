@include ('activity.index')

@foreach ($orders as $order)
    @if ($order->status_id == 2)
        <!-- CARD -->
        <div class="bg-[#fbf7ef] rounded-[22px] px-5 py-5 flex items-center gap-5">

            <!-- BOX -->
            <div class="bg-[#123c2f]/20 rounded-[22px] px-5 py-5 flex items-center gap-5 shadow-sm">

                <!-- FOTO -->
                <div
                    class="w-[150px] h-[150px] rounded-full bg-[#0e4d38] flex items-center justify-center flex-shrink-0 overflow-hidden">

                    <img src="{{ asset('img/teknisi/' . $order->technician->photo) }}" alt="Teknisi"
                        class="w-full h-full object-cover">

                </div>

                <!-- ISI -->
                <div class="flex-1">

                    <h3 class="text-[20px] font-extrabold text-black leading-tight">
                        {{ $order->technician->name ?? 'Teknisi' }}
                    </h3>

                    <p class="text-[#757575] text-sm mt-1">
                        Teknisi {{ $order->service->name ?? '-' }}
                    </p>

                    <button class="mt-3 bg-green-600 text-white text-sm font-bold px-8 py-2 rounded-full">

                        {{ $order->status->name }}

                    </button>

                </div>

            </div>

        </div>
    @endif
@endforeach
