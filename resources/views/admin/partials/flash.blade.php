@if (session('success'))
<div x-data="{ show: true }" x-show="show" x-transition
    class="mb-6 flex items-start justify-between rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-800">
    <div>
        <h3 class="font-semibold">
            Success
        </h3>

        <p class="mt-1 text-sm">
            {{ session('success') }}
        </p>
    </div>

    <button type="button" @click="show = false" class="text-green-600 hover:text-green-800">
        ✕
    </button>
</div>
@endif

@if (session('error'))
<div x-data="{ show: true }" x-show="show" x-transition
    class="mb-6 flex items-start justify-between rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-800">
    <div>
        <h3 class="font-semibold">
            Error
        </h3>

        <p class="mt-1 text-sm">
            {{ session('error') }}
        </p>
    </div>

    <button type="button" @click="show = false" class="text-red-600 hover:text-red-800">
        ✕
    </button>
</div>
@endif