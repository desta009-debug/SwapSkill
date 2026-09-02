<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-[#0F172A] bg-white/80 backdrop-blur-md border border-[#E2E8F0] shadow-sm hover:bg-slate-50 hover:border-[#4F46E5]/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#4F46E5] focus-visible:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:pointer-events-none transition-all duration-200']) }}>
    {{ $slot }}
</button>
