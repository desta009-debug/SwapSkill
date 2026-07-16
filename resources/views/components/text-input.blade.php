@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border-[#E2E8F0] px-4 py-3 text-sm text-[#0F172A] shadow-sm outline-none transition focus:border-[#4F46E5] focus:ring-4 focus:ring-[#4F46E5]/20 disabled:cursor-not-allowed disabled:opacity-60 placeholder:text-slate-400']) }}>
