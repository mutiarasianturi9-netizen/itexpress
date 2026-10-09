@include('layouts.header')

{{-- Halaman menu Layanan: semua kartu diambil dari database ($services dikirim oleh ServiceController@userServices) --}}
<main class="px-6 lg:px-10 pb-20">
    <div class="max-w-6xl mx-auto">

        <!-- ===================== JUDUL ===================== -->
        <section class="pt-6 pb-10 max-w-3xl">
            <span class="inline-block bg-white text-[#2a2a8c] text-sm font-semibold px-5 py-2 rounded-full shadow-sm">
                Pilih layanan yang kamu butuhkan
            </span>

            <h1 class="text-4xl lg:text-5xl font-bold text-[#123c2f] leading-tight mt-5">
                Layanan Service HP &amp; Laptop
            </h1>

            <p class="text-[#675b43] text-lg leading-8 mt-4">
                Klik salah satu layanan untuk melihat daftar teknisi lengkap beserta perkiraan biayanya.
            </p>
        </section>

        <!-- ===================== DAFTAR LAYANAN ===================== -->
        @if ($services->isEmpty())
            <div class="bg-white rounded-3xl p-10 text-center text-[#675b43]">
                Belum ada layanan yang tersedia saat ini.
            </div>
        @else
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    @php
                        // Pilih ilustrasi otomatis dari kata kunci pada nama layanan
                        $nama = strtolower($service->name);
                        if (str_contains($nama, 'baterai') || str_contains($nama, 'battery') || str_contains($nama, 'charger')) {
                            $gambar = 'ilustrasi-baterai.svg';
                        } elseif (str_contains($nama, 'laptop') || str_contains($nama, 'komputer')) {
                            $gambar = 'ilustrasi-laptop.svg';
                        } elseif (str_contains($nama, 'hp') || str_contains($nama, 'lcd') || str_contains($nama, 'layar')) {
                            $gambar = 'ilustrasi-hp.svg';
                        } else {
                            $gambar = 'ilustrasi-servis.svg';
                        }
                    @endphp

                    <article class="bg-white rounded-[32px] overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition flex flex-col">

                        {{-- Panel ilustrasi --}}
                        <div class="bg-[#dbe8fb] h-52 flex items-center justify-center">
                            <img src="{{ asset('img/' . $gambar) }}" alt="{{ $service->name }}" class="h-44 w-auto">
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <h2 class="text-2xl font-bold text-[#111]">{{ $service->name }}</h2>

                            <p class="text-[#675b43] text-base leading-7 mt-3 line-clamp-3">
                                {{ $service->description ?: 'Lihat daftar teknisi yang siap menangani layanan ini.' }}
                            </p>

                            {{-- mt-auto: tombol selalu di dasar kartu agar semua kartu sejajar --}}
                            <a href="{{ route('layanan.show', $service->id) }}"
                                class="mt-auto pt-6">
                                <span class="inline-flex items-center gap-3 bg-[#003f9d] hover:bg-[#003585] text-white font-semibold px-7 py-3 rounded-full transition">
                                    Lihat Teknisi
                                    <span aria-hidden="true">&rarr;</span>
                                </span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </section>
        @endif

    </div>
</main>

@include('layouts.footer')