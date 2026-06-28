@props([
    'title' => 'TopUp Game',
    'subtitle' => 'Topup Game Terpercaya',
    'slides' => [],
])

@php
    $slideId = 'hero-slider-' . md5(serialize($slides));
@endphp

<section
    id="{{ $slideId }}"
    class="relative overflow-hidden rounded-2xl bg-navy-dark aspect-[16/7] md:aspect-[21/9] min-h-[220px] flex items-center justify-center border border-orange-accent/10"
>
    {{-- Slide backgrounds --}}
    @foreach ($slides as $i => $image)
        <div
            class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-700"
            style="background-image: url('{{ $image }}'); {{ $i > 0 ? 'opacity: 0;' : '' }}"
        ></div>
    @endforeach

    {{-- Dark overlay on top of slides --}}
    <div class="absolute inset-0 bg-gradient-to-r from-navy-dark/80 via-navy-dark/60 to-navy-dark/80 z-[1]"></div>

    {{-- Diagonal orange clip-path decoration --}}
    <div class="absolute -top-16 md:-top-20 -right-16 md:-right-20 w-64 md:w-80 h-64 md:h-80 opacity-30 z-[2]"
         style="clip-path: polygon(100% 0, 0% 100%, 100% 100%); background: linear-gradient(135deg, #ff4d2e, transparent);">
    </div>

    <div class="absolute -bottom-16 md:-bottom-20 -left-16 md:-left-20 w-60 md:w-72 h-60 md:h-72 opacity-20 z-[2]"
         style="clip-path: polygon(0 0, 0% 100%, 100% 0); background: linear-gradient(45deg, #ff4d2e, transparent);">
    </div>

    <div class="absolute inset-0 opacity-[0.04] z-[2]"
         style="background-image: radial-gradient(circle, #ff4d2e 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="absolute top-0 left-0 w-16 md:w-24 h-px z-[2] bg-gradient-to-r from-transparent via-orange-accent to-transparent"></div>
    <div class="absolute top-0 left-0 h-16 md:h-24 w-px z-[2] bg-gradient-to-b from-transparent via-orange-accent to-transparent"></div>
    <div class="absolute bottom-0 right-0 w-20 md:w-32 h-px z-[2] bg-gradient-to-l from-transparent via-orange-accent to-transparent"></div>
    <div class="absolute bottom-0 right-0 h-20 md:h-32 w-px z-[2] bg-gradient-to-t from-transparent via-orange-accent to-transparent"></div>

    {{-- Content --}}
    <div class="relative z-10 text-center px-4 md:px-6">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-orange-accent/30 text-orange-accent text-[10px] font-semibold uppercase tracking-[0.2em] mb-3 md:mb-6">
            <span class="size-1.5 rounded-full bg-orange-accent inline-block"></span>
            Platform Topup Game
        </div>

        <h1 class="text-3xl md:text-5xl lg:text-7xl font-black uppercase tracking-[0.05em] text-white leading-none px-2">
            {{ $title }}
        </h1>
        <div class="mt-2 h-px w-16 md:w-24 mx-auto bg-gradient-to-r from-transparent via-orange-accent to-transparent"></div>
        <p class="mt-3 md:mt-4 text-xs md:text-sm lg:text-base text-muted uppercase tracking-[0.15em] font-semibold">
            {{ $subtitle }}
        </p>

        {{-- Slide indicators --}}
        <div class="slide-dots mt-6 flex items-center justify-center gap-2">
            @foreach ($slides as $i => $image)
                <button
                    data-index="{{ $i }}"
                    class="size-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-orange-accent w-6' : 'bg-white/30 hover:bg-white/50' }}"
                ></button>
            @endforeach
        </div>
    </div>
</section>

@if (count($slides) > 1)
    <script>
        (function() {
            var container = document.getElementById('{{ $slideId }}');
            if (!container) return;
            var slides = container.querySelectorAll('.slide');
            var dots = container.querySelectorAll('.slide-dots button');
            var current = 0;
            var total = slides.length;

            function goTo(index) {
                slides.forEach(function(s, i) {
                    s.style.opacity = i === index ? '1' : '0';
                });
                dots.forEach(function(d, i) {
                    d.className = 'size-2 rounded-full transition-all duration-300 ' +
                        (i === index ? 'bg-orange-accent w-6' : 'bg-white/30 hover:bg-white/50');
                });
                current = index;
            }

            dots.forEach(function(dot) {
                dot.addEventListener('click', function() {
                    goTo(parseInt(this.getAttribute('data-index')));
                });
            });

            if (total > 1) {
                setInterval(function() {
                    goTo((current + 1) % total);
                }, 4500);
            }
        })();
    </script>
@endif
