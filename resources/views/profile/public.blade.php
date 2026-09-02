<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                {{-- Left Sidebar: Profile Info, Achievements, Skills & Certifications --}}
                @include('profile.partials.profile-sidebar')

                {{-- Right Content: Portfolios --}}
                @include('profile.partials.portfolio-grid')
            </div>
        </div>
    </div>

    {{-- Modals --}}
    @include('profile.partials.add-certification-modal')
    @include('profile.partials.certificate-detail-modal')
</x-app-layout>