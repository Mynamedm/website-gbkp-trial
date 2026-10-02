{{-- Script carousel --}}
    @push('scripts')
    <script>
        let kategorialSlide = 0;
        const kategorialTotal = {{ count($kategorials) }};
        const kategorialTrack = document.getElementById('kategorialTrack');
        const kategorialDots = document.querySelectorAll('.kategorial-dot');
        const kategorialEl = document.getElementById('kategorialCarousel');

        function updateKategorialCarousel() {
            kategorialTrack.style.transform = `translateX(-${kategorialSlide * 100}%)`;

            kategorialDots.forEach((dot, index) => {
                if (index === kategorialSlide) {
                    dot.classList.remove('bg-slate-300', 'hover:bg-slate-400');
                    dot.classList.add('bg-blue-600');
                } else {
                    dot.classList.remove('bg-blue-600');
                    dot.classList.add('bg-slate-300', 'hover:bg-slate-400');
                }
            });
        }

        function kategorialNext() {
            kategorialSlide = (kategorialSlide + 1) % kategorialTotal;
            updateKategorialCarousel();
        }

        function kategorialPrev() {
            kategorialSlide = (kategorialSlide - 1 + kategorialTotal) % kategorialTotal;
            updateKategorialCarousel();
        }

        function kategorialGoTo(index) {
            kategorialSlide = index;
            updateKategorialCarousel();
        }

        let kategorialTouchStartX = 0;
        let kategorialTouchEndX = 0;

        kategorialEl.addEventListener('touchstart', function(e) {
            kategorialTouchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        kategorialEl.addEventListener('touchend', function(e) {
            kategorialTouchEndX = e.changedTouches[0].screenX;
            const diff = kategorialTouchStartX - kategorialTouchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) kategorialNext();
                else kategorialPrev();
            }
        }, { passive: true });

        updateKategorialCarousel();
    </script>
    @endpush
