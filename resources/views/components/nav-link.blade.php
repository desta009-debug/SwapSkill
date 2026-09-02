@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-semibold leading-5 text-gray-900 focus:outline-none focus-visible:border-indigo-700 focus-visible:ring-0 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus-visible:text-gray-700 focus-visible:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
