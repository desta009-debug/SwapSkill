<aside class="w-72 bg-slate-900 text-white min-h-screen flex flex-col">

    <div class="px-6 py-6 border-b border-slate-700">

        <h1 class="text-2xl font-bold">
            SwapSkill
        </h1>

        <p class="text-slate-400 text-sm">
            Admin Panel
        </p>

    </div>

    <nav class="flex-1 py-6">

        <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-slate-800">

            📊 Dashboard

        </a>

        <a href="{{ route('admin.certificates.index') }}" class="block px-6 py-3 hover:bg-slate-800">

            📜 Certificate Verification

        </a>

        <a href="{{ route('admin.moderation.index') }}" class="block px-6 py-3 hover:bg-slate-800">

            🛡️ Moderation Logs

        </a>

        <a href="#" class="block px-6 py-3 text-slate-500 cursor-not-allowed">

            👥 User Management

        </a>

        <a href="#" class="block px-6 py-3 text-slate-500 cursor-not-allowed">

            💼 Portfolio

        </a>

        <a href="#" class="block px-6 py-3 text-slate-500 cursor-not-allowed">

            🔄 Skill Swaps

        </a>

        <a href="#" class="block px-6 py-3 text-slate-500 cursor-not-allowed">

            📈 Reports

        </a>

    </nav>

    <div class="border-t border-slate-700 p-6">

        <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white">

            ← Back to Application

        </a>

    </div>

</aside>