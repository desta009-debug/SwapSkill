<x-app-layout>

    <div class="max-w-6xl mx-auto py-8">

        <h1 class="text-3xl font-bold mb-6">
            Riwayat Skill Swap
        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            @forelse($completedSwaps as $swap)

            <div class="border-b py-4">

                <h3 class="font-semibold text-lg">

                    @if(auth()->id() === $swap->sender_id)
                    {{ $swap->receiver->name }}
                    @else
                    {{ $swap->sender->name }}
                    @endif

                </h3>

                <p class="text-gray-600">
                    Status:
                    Completed
                </p>

                <p class="text-gray-500 text-sm">
                    Selesai:
                    {{ $swap->completed_at }}
                </p>

            </div>
            <form action="{{ route('ratings.store') }}" method="POST" class="mt-3">
                @csrf

                <input type="hidden" name="skill_swap_id" value="{{ $swap->id }}">

                <select name="rating" class="border rounded px-3 py-2">
                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>

                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Kirim Rating
                </button>
            </form>

            @empty

            <p class="text-gray-500">
                Belum ada riwayat skill swap.
            </p>

            @endforelse

        </div>

    </div>

</x-app-layout>