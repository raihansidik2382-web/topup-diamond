@props([
    'name' => 'Unknown Game',
    'image' => 'https://placehold.co/400x500/1e1b3a/ff4d2e?text=Game',
    'category' => 'Action',
    'url' => null,
])

@if ($url)
    <a href="{{ $url }}" class="block group relative rounded-xl overflow-hidden border border-white/5 bg-navy-dark transition-all duration-300 hover:scale-[1.03] hover:border-orange-accent/50 hover:shadow-lg hover:shadow-orange-accent/10">
@else
    <div class="group relative rounded-xl overflow-hidden border border-white/5 bg-navy-dark transition-all duration-300 hover:scale-[1.03] hover:border-orange-accent/50 hover:shadow-lg hover:shadow-orange-accent/10">
@endif
        <div class="aspect-[3/4] overflow-hidden">
            <img src="{{ $image }}"
                 alt="{{ $name }}"
                 class="size-full object-cover transition-transform duration-500 group-hover:scale-110"
                 loading="lazy">
        </div>

        <div class="absolute inset-0 bg-gradient-to-t from-navy-dark via-navy-dark/30 to-transparent pointer-events-none"></div>

        <div class="absolute bottom-0 left-0 right-0 p-3 pointer-events-none">
            <span class="text-[10px] font-semibold uppercase tracking-widest text-orange-accent">{{ $category }}</span>
            <h3 class="text-sm font-bold text-white uppercase tracking-wide mt-0.5 truncate">{{ $name }}</h3>
        </div>
@if ($url)
    </a>
@else
    </div>
@endif
