@props(['title', 'description' => null, 'variant' => 'default'])

@php
    $baseClasses = 'flex flex-col items-center justify-center p-12 text-center rounded-[24px] shadow-sm border border-slate-200/80 bg-white/80 backdrop-blur-xl relative overflow-hidden';
    $iconWrapperClasses = 'w-20 h-20 bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm border border-slate-200/50';
    $iconClasses = 'w-10 h-10 text-slate-400';
    $titleClasses = 'font-fraunces text-2xl font-bold text-slate-900 mb-2';
    $descriptionClasses = 'text-slate-600 max-w-md mx-auto font-medium leading-relaxed';
    $ctaWrapperClasses = 'mt-8 flex flex-col sm:flex-row gap-3 justify-center items-center';

    if ($variant === 'compact') {
        $baseClasses = 'p-8 rounded-xl border border-dashed border-slate-300 bg-slate-50/50 text-center';
        $iconWrapperClasses = 'w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center mx-auto mb-4 border border-slate-200/50';
        $iconClasses = 'w-7 h-7 text-slate-400';
        $titleClasses = 'font-fraunces text-lg font-bold text-slate-900 mb-1.5';
        $descriptionClasses = 'text-sm text-slate-500 max-w-sm mx-auto';
    } elseif ($variant === 'large') {
        $baseClasses = 'p-16 rounded-[32px] shadow-lg border border-slate-200/80 bg-gradient-to-b from-white to-slate-50/50 backdrop-blur-xl relative overflow-hidden';
        $iconWrapperClasses = 'w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-md border border-slate-200/70';
        $iconClasses = 'w-12 h-12 text-slate-400';
        $titleClasses = 'font-fraunces text-3xl font-bold text-slate-900 mb-3';
        $descriptionClasses = 'text-base text-slate-600 max-w-lg mx-auto font-medium leading-relaxed';
    }
@endphp

<div {{ $attributes->merge(['class' => $baseClasses]) }}>
    {{-- Decorative Background (only for default/large) --}}
    @if ($variant !== 'compact')
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-100/20 to-purple-100/20 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-blue-100/20 to-cyan-100/20 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
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
