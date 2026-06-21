<img
    src="{{ asset('images/logo.jpg') . '?v=' . filemtime(public_path('images/logo.jpg')) }}"
    alt="SwapSkill Logo"
    {{ $attributes->merge(['class' => 'h-10 w-10 rounded-2xl object-cover']) }}
>