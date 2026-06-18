{{-- Incoming Requests --}}
<div class="bg-white shadow rounded-lg p-6 mb-8">

    <h2 class="text-xl font-bold mb-6">
        Incoming Requests
    </h2>

    @forelse($incomingRequests as $swap)

    <div class="border-b py-4">

        <div class="flex justify-between items-center">

            <div>

                <h3 class="font-semibold text-lg">
                    {{ $swap->sender->name }}
                </h3>

                @if($swap->message)
                <p class="text-gray-600 mt-1">
                    {{ $swap->message }}
                </p>
                @endif

                <p class="mt-2">
                    Status:
                    <strong>
                        {{ ucfirst($swap->status) }}
                    </strong>
                </p>

            </div>

            <div class="flex gap-3 flex-wrap">

                @if($swap->status === 'pending')

                <form action="{{ route('swaps.accept', $swap) }}" method="POST">
                    @csrf

                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Accept
                    </button>
                </form>

                <form action="{{ route('swaps.reject', $swap) }}" method="POST">
                    @csrf

                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Reject
                    </button>
                </form>

                @endif

                @if($swap->status === 'accepted')

                @if($swap->sender->whatsapp_link)

                <a href="{{ $swap->sender->whatsapp_link }}" target="_blank"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Hubungi via WhatsApp
                </a>

                @endif

                <form action="{{ route('swaps.complete', $swap) }}" method="POST">
                    @csrf

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Selesaikan Swap
                    </button>
                </form>

                @endif

            </div>

        </div>
        @if($swap->status === 'accepted')

        @if($swap->receiver->whatsapp_link)

        <a href="{{ $swap->receiver->whatsapp_link }}" target="_blank"
            class="inline-block mt-3 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
            Hubungi via WhatsApp
        </a>

        @endif

        @endif

    </div>
    @if($swap->status === 'completed')

    <form action="{{ route('ratings.store') }}" method="POST">
        @csrf

        <input type="hidden" name="skill_swap_id" value="{{ $swap->id }}">

        <select name="rating" required>
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

    @endif

    @empty

    <p class="text-gray-500">
        Tidak ada incoming request.
    </p>

    @endforelse

</div>