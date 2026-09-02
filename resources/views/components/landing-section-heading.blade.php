@props(['eyebrow', 'title', 'description' => null])

<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <p class="font-mono-tix text-xs uppercase tracking-widest text-[#4f46e5]">
        {{ $eyebrow }}
    </p>
    <h2 class="mt-3 font-display text-3xl md:text-4xl text-[#0f172a]">
        {{ $title }}
    </h2>
    @if ($description)
        <p class="mt-4 text-[#64748b] leading-relaxed max-w-2xl mx-auto">
            {{ $description }}
        </p>
    @endif
</div>
