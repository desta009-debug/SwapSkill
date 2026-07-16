@props(['title', 'description' => null, 'variant' => 'default'])

@php
    $baseClasses = 'flex flex-col items-center justify-center p-12 text-center rounded-[24px] shadow-sm border border-[#E2E8F0] bg-white/80 backdrop-blur-xl relative overflow-hidden';
    $iconWrapperClasses = 'w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6';
    $iconClasses = 'w-10 h-10 text-slate-300';
    $titleClasses = 'font-fraunces text-2xl font-bold text-[#0F172A] mb-2';
    $descriptionClasses = 'text-[#64748B] max-w-md mx-auto font-medium';
    $ctaWrapperClasses = 'mt-8 flex flex-col sm:flex-row gap-4 justify-center';

    if ($variant === 'compact') {
        $baseClasses = 'p-8 rounded-xl border border-dashed border-[#E2E8F0] bg-white/50 text-center';
        $iconWrapperClasses = 'w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4';
        $iconClasses = 'w-7 h-7 text-slate-400';
        $titleClasses = 'font-fraunces text-xl font-bold text-[#0F172A] mb-2';
        $descriptionClasses = 'text-sm text-[#64748B] max-w-sm mx-auto';
    } elseif ($variant === 'large') {
        $baseClasses = 'p-16 rounded-[32px] shadow-lg border border-[#E2E8F0] bg-white/80 backdrop-blur-xl relative overflow-hidden';
        $iconWrapperClasses = 'w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6';
        $iconClasses = 'w-12 h-12 text-slate-300';
        $titleClasses = 'font-fraunces text-3xl font-bold text-[#0F172A] mb-3';
        $descriptionClasses = 'text-base text-[#64748B] max-w-lg mx-auto font-medium';
    }
@endphp

<div {{ $attributes->merge(['class' => $baseClasses]) }}>
    {{-- Decorative Background (only for default/large variants) --}}
    @if ($variant !== 'compact')
        <div class="absolute top-0 right-0 w-64 h-64 bg-slate-100 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
    @endif

    <div class="{{ $iconWrapperClasses }}" aria-hidden="true">
        {{ $icon }}
    </div>
    <h3 class="{{ $titleClasses }}">{{ $title }}</h3>
    @if ($description)
        <p class="{{ $descriptionClasses }}">{{ $description }}</p>
    @endif

    @if(isset($primaryAction) || isset($secondaryAction))
        <div class="{{ $ctaWrapperClasses }}">
            @isset($primaryAction)
                {{ $primaryAction }}
            @endisset
            @isset($secondaryAction)
                {{ $secondaryAction }}
            @endisset
        </div>
    @endif
</div>
