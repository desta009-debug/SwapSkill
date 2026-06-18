```blade
<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold">
                Kelola Skill
            </h1>

            <p class="text-gray-500 mt-2">
                Pilih skill yang kamu tawarkan dan skill yang ingin kamu pelajari.
            </p>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('skills.update') }}" method="POST">
            @csrf

            <div class="grid md:grid-cols-2 gap-8">

                {{-- OFFER --}}
                <div class="bg-white shadow rounded-lg p-6">

                    <h2 class="text-xl font-bold mb-4">
                        Skill yang Saya Tawarkan
                    </h2>

                    @foreach($skills as $skill)

                    <div class="border-b py-3">

                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="offers[]" value="{{ $skill->id }}" {{ in_array($skill->id,
                            $selectedOffers) ? 'checked' : '' }}
                            >

                            <span>
                                {{ $skill->name }}
                            </span>
                        </label>

                        <select name="offer_levels[{{ $skill->id }}]" class="mt-2 border rounded px-3 py-2 w-full">
                            <option value="">
                                Pilih Level
                            </option>

                            <option value="beginner" {{ ($selectedOfferLevels[$skill->id] ?? '') === 'beginner' ?
                                'selected' : '' }}
                                >
                                Beginner
                            </option>

                            <option value="intermediate" {{ ($selectedOfferLevels[$skill->id] ?? '') === 'intermediate'
                                ? 'selected' : '' }}
                                >
                                Intermediate
                            </option>

                            <option value="advanced" {{ ($selectedOfferLevels[$skill->id] ?? '') === 'advanced' ?
                                'selected' : '' }}
                                >
                                Advanced
                            </option>
                        </select>

                    </div>

                    @endforeach

                </div>

                {{-- WANT --}}
                <div class="bg-white shadow rounded-lg p-6">

                    <h2 class="text-xl font-bold mb-4">
                        Skill yang Ingin Dipelajari
                    </h2>

                    @foreach($skills as $skill)

                    <div class="border-b py-3">

                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="wants[]" value="{{ $skill->id }}" {{ in_array($skill->id,
                            $selectedWants) ? 'checked' : '' }}
                            >

                            <span>
                                {{ $skill->name }}
                            </span>
                        </label>

                        <select name="want_levels[{{ $skill->id }}]" class="mt-2 border rounded px-3 py-2 w-full">
                            <option value="">
                                Pilih Level
                            </option>

                            <option value="beginner" {{ ($selectedWantLevels[$skill->id] ?? '') === 'beginner' ?
                                'selected' : '' }}
                                >
                                Beginner
                            </option>

                            <option value="intermediate" {{ ($selectedWantLevels[$skill->id] ?? '') === 'intermediate' ?
                                'selected' : '' }}
                                >
                                Intermediate
                            </option>

                            <option value="advanced" {{ ($selectedWantLevels[$skill->id] ?? '') === 'advanced' ?
                                'selected' : '' }}
                                >
                                Advanced
                            </option>
                        </select>

                    </div>

                    @endforeach

                </div>

            </div>

            <div class="mt-8">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Simpan Skill
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
```