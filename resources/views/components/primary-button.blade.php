<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-[#4F46E5] to-[#4338CA] shadow-lg shadow-[#4F46E5]/30 hover:opacity-90 active:scale-[0.98] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#4F46E5] focus-visible:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:pointer-events-none transition-all duration-200']) }}>
    {{ $slot }}
</button>
