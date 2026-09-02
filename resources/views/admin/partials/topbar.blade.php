<header class="bg-white border-b h-16 flex items-center justify-between px-8">

    <div>

        <h2 class="text-xl font-semibold">

            @yield('page-title','Dashboard')

        </h2>

    </div>

    <div class="flex items-center gap-4">

        <div class="text-right">

            <p class="font-semibold">

                {{ auth()->user()->name }}

            </p>

            <p class="text-xs text-slate-500">

                Administrator

            </p>

        </div>

        <img src="{{ auth()->user()->profile_photo_url }}" class="w-10 h-10 rounded-full object-cover">

    </div>

</header>