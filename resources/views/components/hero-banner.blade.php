@props(['title' => 'TopUp Game', 'subtitle' => 'Topup Game Terpercaya'])

<section class="relative overflow-hidden rounded-2xl bg-navy-dark min-h-[260px] md:min-h-[320px] flex items-center justify-center border border-orange-accent/10">
    <div class="absolute -top-16 md:-top-20 -right-16 md:-right-20 w-64 md:w-80 h-64 md:h-80 opacity-30"
         style="clip-path: polygon(100% 0, 0% 100%, 100% 100%); background: linear-gradient(135deg, #ff4d2e, transparent);">
    </div>

    <div class="absolute -bottom-16 md:-bottom-20 -left-16 md:-left-20 w-60 md:w-72 h-60 md:h-72 opacity-20"
         style="clip-path: polygon(0 0, 0% 100%, 100% 0); background: linear-gradient(45deg, #ff4d2e, transparent);">
    </div>

    <div class="absolute inset-0 opacity-[0.04]"
         style="background-image: radial-gradient(circle, #ff4d2e 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="absolute top-0 left-0 w-16 md:w-24 h-px bg-gradient-to-r from-transparent via-orange-accent to-transparent"></div>
    <div class="absolute top-0 left-0 h-16 md:h-24 w-px bg-gradient-to-b from-transparent via-orange-accent to-transparent"></div>
    <div class="absolute bottom-0 right-0 w-20 md:w-32 h-px bg-gradient-to-l from-transparent via-orange-accent to-transparent"></div>
    <div class="absolute bottom-0 right-0 h-20 md:h-32 w-px bg-gradient-to-t from-transparent via-orange-accent to-transparent"></div>

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
    </div>
</section>
