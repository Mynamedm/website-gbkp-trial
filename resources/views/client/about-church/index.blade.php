@extends('layouts.client.app')

@section('content')

    {{-- Carousel Container --}}
    <div id="aboutCarousel" class="relative overflow-hidden group">
        <div id="carouselTrack" class="flex transition-transform duration-500 ease-in-out">

            {{-- Slide 1: Hero (Full Width) --}}
            <div class="carousel-slide min-w-full">
                <section class="relative w-full h-[85vh] overflow-hidden">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1920&q=80"
                             alt="Gereja GBKP" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-transparent"></div>
                    </div>
                    <div class="relative h-full flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                            <div class="max-w-xl">
                                <span class="inline-block text-blue-300 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Tentang Kami</span>
                                <h1 class="font-display text-white text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-5">
                                    Gereja Batak Karo Protestan<br>Bandar Lampung
                                </h1>
                                <p class="text-white/70 text-[15px] leading-relaxed max-w-lg mb-8">
                                    Mengenal lebih dekat sejarah, visi, misi, dan pelayanan GBKP Bandar Lampung dalam melayani jemaat dan masyarakat.
                                </p>
                                <button onclick="nextSlide()" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white text-[13px] font-semibold px-5 py-2.5 rounded-full transition-all">
                                    Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Slide 2: Sejarah GBKP Mula-Mula di Indonesia --}}
            <div class="carousel-slide min-w-full">
                <section class="relative w-full h-[85vh] overflow-hidden bg-slate-50">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=1200&q=80"
                             alt="Sejarah GBKP Indonesia" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/95 to-white/30"></div>
                    </div>
                    <div class="relative h-full flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                            <div class="max-w-xl">
                                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Sejarah</span>
                                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold mb-5">Awal Mula GBKP di Indonesia</h2>
                                <p class="text-slate-600 text-[15px] leading-relaxed mb-4">
                                    Gereja Batak Karo Protestan (GBKP) merupakan salah satu gereja tertua di tanah Karo, Sumatera Utara. Sejarah GBKP bermula dari kedatangan misionaris Jerman dari Rheinische Missionsgesellschaft (RMG) pada pertengahan abad ke-19 di tanah Karo.
                                </p>
                                <p class="text-slate-600 text-[15px] leading-relaxed mb-4">
                                    Pada tahun 1890, Misionaris Ludwig Nommensen mulai menyampaikan Injil kepada masyarakat Batak Karo di daerah Kabanjahe. Bersama Tuanku Raja Meunting, Nommensen berhasil menanamkan iman Kristen di tengah suku Karo yang sebelumnya menganut kepercayaan animisme.
                                </p>
                                <p class="text-slate-600 text-[15px] leading-relaxed">
                                    Seiring berjalannya waktu, jemaat Kristen di tanah Karo terus bertumbuh. Pada tahun 1930, diresmikanlah induk gereja yang kemudian dikenal sebagai Gereja Batak Karo Protestan (GBKP) dengan pusat pemerintahan di Kabanjahe.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Slide 3: Sejarah GBKP Bandar Lampung --}}
            <div class="carousel-slide min-w-full">
                <section class="relative w-full h-[85vh] overflow-hidden bg-white">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1438032005730-c779502df39b?w=1200&q=80"
                             alt="Sejarah GBKP Bandar Lampung" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/95 to-white/30"></div>
                    </div>
                    <div class="relative h-full flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                            <div class="max-w-xl">
                                <span class="inline-block text-blue-600 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Sejarah Lokal</span>
                                <h2 class="font-display text-slate-800 text-2xl sm:text-3xl font-bold mb-5">Sejarah Berdirinya GBKP Bandar Lampung</h2>
                                <p class="text-slate-600 text-[15px] leading-relaxed mb-4">
                                    Gereja Batak Karo Protestan (GBKP) Bandar Lampung didirikan untuk melayani komunitas Batak Karo yang merantau dan menetap di wilayah Bandar Lampung dan sekitarnya. Pada awalnya, jemaat berkumpul secara sederhana di rumah-rumah warga untuk melaksanakan ibadah.
                                </p>
                                <p class="text-slate-600 text-[15px] leading-relaxed mb-4">
                                    Seiring bertambahnya jumlah jemaat yang merantau ke Lampung, kebutuhan akan wadah persekutuan rohani yang resmi semakin mendesak. Akhirnya, dengan berkat dan dukungan dari Resort GBKP di Sumatera Utara, jemaat GBKP Bandar Lampung resmi terbentuk.
                                </p>
                                <p class="text-slate-600 text-[15px] leading-relaxed">
                                    Sejak berdirinya, GBKP Bandar Lampung terus menjadi tempat beribadah dan persekutuan bagi jemaat Batak Karo di kota Bandar Lampung. Gereja ini tidak hanya melayani aspek rohani, tetapi juga menjadi pusat kebersamaan dan solidaritas sesama perantau.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Slide 4: Perkembangan GBKP Bandar Lampung --}}
            <div class="carousel-slide min-w-full">
                <section class="relative w-full h-[85vh] overflow-hidden bg-slate-900">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&q=80"
                             alt="Perkembangan GBKP" class="w-full h-full object-cover opacity-40">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900/40"></div>
                    </div>
                    <div class="relative h-full flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                            <div class="grid lg:grid-cols-2 gap-12 items-center">
                                <div>
                                    <span class="inline-block text-blue-300 text-[11px] font-semibold uppercase tracking-[0.18em] mb-3">Perkembangan</span>
                                    <h2 class="font-display text-white text-2xl sm:text-3xl font-bold mb-5">Perkembangan GBKP Bandar Lampung</h2>
                                    <p class="text-white/60 text-[15px] leading-relaxed mb-4">
                                        Dari sebuah persekutuan kecil di rumah-rumah warga, GBKP Bandar Lampung kini telah berkembang menjadi jemaat yang besar dan aktif dengan berbagai program pelayanan.
                                    </p>
                                    <p class="text-white/60 text-[15px] leading-relaxed">
                                        Dengan dipimpin oleh para gembala yang setia, jemaat terus bertumbuh dalam iman dan menjadi berkat bagi kota Bandar Lampung melalui pelayanan firman, persekutuan, dan kasih.
                                    </p>
                                </div>
                                <div class="space-y-4">
                                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center shrink-0">
                                                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="text-white/50 text-[12px]">Awal Berdiri</span>
                                                <p class="text-white text-[14px] font-medium">Persekutuan kecil di rumah warga</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center shrink-0">
                                                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 7.5h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="text-white/50 text-[12px]">Pertumbuhan</span>
                                                <p class="text-white text-[14px] font-medium">Pembangunan gedung gereja permanen</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center shrink-0">
                                                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="text-white/50 text-[12px]">Masa Kini</span>
                                                <p class="text-white text-[14px] font-medium">Jemaat aktif dengan 6 kategori pelayanan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>

        {{-- Navigation Arrows --}}
        <button id="prevBtn" onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-white shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-60 hover:!opacity-100">
            <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
        </button>
        <button id="nextBtn" onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 hover:bg-white shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 group-hover:opacity-60 hover:!opacity-100">
            <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
            </svg>
        </button>

        {{-- Dots --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2.5">
            <button onclick="goToSlide(0)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-blue-600 transition-all" data-slide="0"></button>
            <button onclick="goToSlide(1)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-slate-300 hover:bg-slate-400 transition-all" data-slide="1"></button>
            <button onclick="goToSlide(2)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-slate-300 hover:bg-slate-400 transition-all" data-slide="2"></button>
            <button onclick="goToSlide(3)" class="carousel-dot w-2.5 h-2.5 rounded-full bg-slate-300 hover:bg-slate-400 transition-all" data-slide="3"></button>
        </div>

        {{-- Slide Counter --}}
        <div class="absolute top-6 right-6 bg-black/30 backdrop-blur-sm text-white text-[12px] font-medium px-3 py-1.5 rounded-full z-10">
            <span id="currentSlide">1</span> / <span id="totalSlides">4</span>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentSlide = 0;
        const totalSlides = 4;
        const track = document.getElementById('carouselTrack');
        const dots = document.querySelectorAll('.carousel-dot');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            document.getElementById('currentSlide').textContent = currentSlide + 1;

            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.remove('bg-slate-300', 'hover:bg-slate-400');
                    dot.classList.add('bg-blue-600');
                } else {
                    dot.classList.remove('bg-blue-600');
                    dot.classList.add('bg-slate-300', 'hover:bg-slate-400');
                }
            });

        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') prevSlide();
            if (e.key === 'ArrowRight') nextSlide();
        });

        let touchStartX = 0;
        let touchEndX = 0;
        const carouselEl = document.getElementById('aboutCarousel');

        carouselEl.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        carouselEl.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) nextSlide();
                else prevSlide();
            }
        }, { passive: true });

        updateCarousel();
    </script>
    @endpush

@endsection
