<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-600">SwapSkill</p>
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Request Exchange
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Send a collaboration request to start a skill exchange.
                </p>
            </div>

            <a
                href="{{ route('matches.index') }}"
                class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
            >
                Back to Matches
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100 py-10">
        <div class="mx-auto max-w-6xl space-y-8 px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="grid gap-8 lg:grid-cols-2">
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Matched User</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $matchedUser->name }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $matchedUser->email }}
                            </p>

                            @if (!empty($matchedUser->phone))
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $matchedUser->phone }}
                                </p>
                            @endif
                        </div>

                        @if ($matchType === 'Mutual Match')
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Mutual Match
                            </span>
                        @else
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                Potential Match
                            </span>
                        @endif
                    </div>

                    <div class="space-y-6">
                        <div>
                            <div class="mb-3 flex items-center justify-between">
                                <p class="text-sm font-semibold text-indigo-600">
                                    Skills you can learn from them
                                </p>
                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                    {{ $skillsYouCanLearn->count() }} skills
                                </span>
                            </div>

                            @if ($skillsYouCanLearn->count())
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($skillsYouCanLearn as $skill)
                                        <span class="rounded-2xl border border-indigo-100 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700">
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-4">
                                    <p class="text-sm text-gray-500">
                                        No direct teaching match available yet.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="mb-3 flex items-center justify-between">
                                <p class="text-sm font-semibold text-pink-600">
                                    Skills you can offer to them
                                </p>
                                <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-700">
                                    {{ $skillsYouCanOffer->count() }} skills
                                </span>
                            </div>

                            @if ($skillsYouCanOffer->count())
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($skillsYouCanOffer as $skill)
                                        <span class="rounded-2xl border border-pink-100 bg-pink-50 px-4 py-2 text-sm font-medium text-pink-700">
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-4">
                                    <p class="text-sm text-gray-500">
                                        They do not currently request your offered skills.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-6">
                        <p class="text-sm font-medium text-indigo-600">Exchange Form</p>
                        <h3 class="text-2xl font-bold text-gray-900">Send Request</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            This is a demo request form to simulate the next step after finding a match.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('exchange.store', ['user' => $matchedUser->id]) }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="topic" class="mb-2 block text-sm font-semibold text-gray-700">
                                Exchange Topic
                            </label>
                            <input
                                type="text"
                                id="topic"
                                name="topic"
                                value="{{ old('topic') }}"
                                placeholder="Example: Canva for Excel basics"
                                class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                            >
                        </div>

                        <div>
                            <p class="mb-2 block text-sm font-semibold text-gray-700">Preferred Mode</p>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center gap-2 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
                                    <input type="radio" name="mode" value="online" {{ old('mode') === 'online' ? 'checked' : '' }}>
                                    <span>Online</span>
                                </label>

                                <label class="flex items-center gap-2 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
                                    <input type="radio" name="mode" value="offline" {{ old('mode') === 'offline' ? 'checked' : '' }}>
                                    <span>Offline</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="preferred_date" class="mb-2 block text-sm font-semibold text-gray-700">
                                Preferred Date
                            </label>
                            <input
                                type="date"
                                id="preferred_date"
                                name="preferred_date"
                                value="{{ old('preferred_date') }}"
                                class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                            >
                        </div>

                        <div>
                            <label for="note" class="mb-2 block text-sm font-semibold text-gray-700">
                                Note
                            </label>
                            <textarea
                                id="note"
                                name="note"
                                rows="4"
                                placeholder="Add a short note about what you want to exchange."
                                class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                            >{{ old('note') }}</textarea>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                            >
                                Send Request
                            </button>

                            <a
                                href="{{ route('matches.index') }}"
                                class="inline-flex items-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>