@include('layouts.header')

{{-- Gulir halus saat tombol "Lihat Teknisi" ditekan --}}
<style>
    html {
        scroll-behavior: smooth;
    }
</style>

{{--
    Template bersama untuk SEMUA layanan.
    Data dari ServiceController@show:
      $service      = layanan yang dipilih (nama, deskripsi)
      $technicians  = teknisi aktif pada layanan itu
--}}
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

<main class="px-6 lg:px-10 pb-20">
    <div class="max-w-6xl mx-auto">

        <!-- ===================== HERO ===================== -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center pt-4 pb-16">

            <!-- Ilustrasi -->
            <div class="bg-[#dbe8fb] rounded-[40px] h-72 lg:h-80 flex items-center justify-center order-2 lg:order-1">
                <img src="{{ asset('img/' . $gambar) }}" alt="{{ $service->name }}" class="h-60 lg:h-72 w-auto">
            </div>

            <!-- Teks -->
            <div class="order-1 lg:order-2">
                <a href="{{ route('layanan.index') }}"
                    class="inline-flex items-center gap-2 text-[#2a2a8c] text-sm font-semibold hover:underline">
                    <span aria-hidden="true">&larr;</span> Semua layanan
                </a>

                <h1 class="text-4xl lg:text-5xl font-bold text-[#123c2f] leading-tight mt-4">
                    {{ $service->name }}
                </h1>

                <p class="text-[#675b43] text-lg leading-8 mt-4">
                    {{ $service->description ?: 'Pilih teknisi yang sesuai dengan kebutuhan perangkat Anda.' }}
                </p>

                {{-- Keunggulan singkat (sama seperti di beranda) --}}
                <div class="flex flex-wrap gap-3 mt-6">
                    @foreach (['Proses Cepat', 'Garansi Servis', 'Harga Transparan'] as $chip)
                        <span class="bg-[#d7dfef] text-[#2a2a8c] text-sm font-semibold px-4 py-2 rounded-full">
                            {{ $chip }}
                        </span>
                    @endforeach
                </div>

                <a href="#daftar-teknisi"
                    class="inline-flex items-center gap-3 mt-8 bg-[#003f9d] hover:bg-[#003585] text-white font-semibold px-8 py-4 rounded-xl shadow-lg transition">
                    Lihat Teknisi
                    <span aria-hidden="true">&darr;</span>
                </a>
            </div>
        </section>

        <!-- ===================== DAFTAR TEKNISI ===================== -->
        <section id="daftar-teknisi" class="scroll-mt-8">

            <div class="flex flex-wrap items-end justify-between gap-3 mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-[#2a2a8c]">Daftar Teknisi</h2>
                    <p class="text-[#675b43] mt-1">Pilih teknisi yang sesuai dengan kebutuhan Anda.</p>
                </div>

                <span class="bg-white text-[#2a2a8c] text-sm font-semibold px-4 py-2 rounded-full shadow-sm">
                    {{ $technicians->count() }} teknisi tersedia
                </span>
            </div>

            @if ($technicians->isEmpty())
                {{-- Tampilan kalau belum ada teknisi untuk layanan ini --}}
                <div class="bg-white rounded-3xl p-10 text-center">
                    <p class="text-[#675b43]">Belum ada teknisi yang tersedia untuk layanan ini.</p>
                    <a href="{{ route('layanan.index') }}"
                        class="inline-block mt-5 bg-[#003f9d] text-white font-semibold px-7 py-3 rounded-full">
                        Lihat layanan lain
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($technicians as $technician)
                        @php
                            // Foto dipakai hanya kalau filenya benar-benar ada, kalau tidak tampil inisial nama
                            $punyaFoto = $technician->photo && file_exists(public_path('img/teknisi/' . $technician->photo));
                            $inisial = strtoupper(
                                collect(explode(' ', trim($technician->name)))
                                    ->take(2)
                                    ->map(fn($kata) => mb_substr($kata, 0, 1))
                                    ->implode(''),
                            );
                        @endphp

                        {{-- h-full + flex-col: semua kartu sama tinggi, tombol selalu di dasar --}}
                        <article class="bg-white border border-[#d7dfef] rounded-[28px] p-6 flex flex-col items-center text-center h-full shadow-sm hover:shadow-lg hover:-translate-y-1 transition">

                            <!-- Foto / inisial -->
                            <div class="w-24 h-24 rounded-full overflow-hidden bg-[#dbe8fb] flex items-center justify-center ring-4 ring-[#eef4fd]">
                                @if ($punyaFoto)
                                    <img src="{{ asset('img/teknisi/' . $technician->photo) }}"
                                        alt="{{ $technician->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-[#003f9d] text-3xl font-bold">{{ $inisial }}</span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-[#111] mt-4">{{ $technician->name }}</h3>

                            <p class="text-[#6b7280] text-sm mt-1 leading-6">
                                @if ($technician->age)
                                    {{ $technician->age }} Tahun
                                    <span aria-hidden="true">&bull;</span>
                                @endif
                                {{ $technician->address }}
                            </p>

                            <div class="mt-5">
                                <p class="text-xs text-[#675b43] uppercase tracking-wide">Perkiraan biaya</p>
                                <p class="text-[#123c2f] text-lg font-bold mt-1">
                                    {{ $technician->price_range ? 'Rp ' . $technician->price_range : 'Hubungi teknisi' }}
                                </p>
                            </div>

                            {{-- mt-auto: dorong tombol ke dasar kartu --}}
                            <a href="{{ route('pemesanan', $technician->id) }}"
                                class="mt-auto pt-6 w-full">
                                <span class="block bg-[#003f9d] hover:bg-[#003585] text-white font-semibold py-3 rounded-full transition">
                                    Pesan
                                </span>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

    </div>
</main>

@include('layouts.footer')