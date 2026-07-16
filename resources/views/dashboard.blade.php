<x-app-layout>
    <div class="min-h-screen bg-linear-to-br from-slate-50 to-slate-100">
    @php
        $displayName = \Illuminate\Support\Str::before(Auth::user()->name, ' ');
    @endphp
        <!-- Hero Section with Profile Overview -->
        <section class="relative overflow-hidden border-b border-slate-200/80 bg-white">
            <div class="absolute inset-0 dot-grid opacity-30"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    <!-- Welcome Section -->
                    <div class="lg:col-span-2 space-y-4">
                        <div>
                            <h1 class="font-fraunces text-4xl md:text-5xl font-bold text-slate-900 leading-tight">
                                Welcome back, {{ $displayName }}!
                            </h1>
                            <p class="mt-2 text-lg text-slate-600">
                                Keep building your skills. You're on a roll! 🚀
                            </p>
                        </div>
                        <!-- Quick Stat Pills -->
                        <div class="flex flex-wrap gap-2 sm:gap-3 pt-4">
                            <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-full bg-emerald-50 border border-emerald-200">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                <span class="text-sm font-bold text-emerald-700">{{ $completedSwaps }} Swaps Completed</span>
                            </div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-200">
                                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                <span class="text-sm font-bold text-blue-700">{{ $acceptedRequests }} Active Matches</span>
                            </div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 border border-amber-200">
                                <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.5a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V7z" /></svg>
                                <span class="text-sm font-bold text-amber-700">{{ $pendingRequests }} Pending</span>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Completion Widget -->
                    <div class="bg-linear-to-br from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-200/50 shadow-sm">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Profile Status</p>
                                <h3 class="font-fraunces text-2xl font-bold text-slate-900">{{ Auth::user()->name }}</h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 mb-4">Skills Offered: {{ $offeredSkills->count() }} | Skills to Learn: {{ $wantedSkills->count() }}</p>
                        <a href="{{ route('profile.edit') }}" class="block w-full px-3 py-2 bg-indigo-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-indigo-700 transition-colors text-center">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Priority Section: Pending Requests -->
            <section class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="font-fraunces text-3xl font-bold text-slate-900">Requests Awaiting Your Response</h2>
                        <p class="mt-1 text-slate-600">{{ $pendingRequests }} pending request{{ $pendingRequests !== 1 ? 's' : '' }}</p>
                    </div>
                    @if($pendingRequests > 0)
                        <a href="{{ route('swaps.index') }}" class="px-4 py-2 text-sm font-bold text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-lg transition-colors">
                            View All →
                        </a>
                    @endif
                </div>

                @if($pendingRequests > 0)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <p class="text-center text-slate-600">Pending swap requests will appear here.</p>
                    </div>
                @else
                    <x-empty-state title="All caught up!" description="No pending requests. Browse new matches to start learning." variant="compact">
                        <x-slot:icon>
                            <svg class="w-7 h-7 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        </x-slot:icon>
                        <x-slot:primaryAction>
                            <a href="{{ route('matches.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-linear-to-r from-indigo-600 to-blue-600 text-white font-bold rounded-xl hover:brightness-110 transition-all shadow-lg shadow-indigo-600/30">
                                Browse Matches
                            </a>
                        </x-slot:primaryAction>
                    </x-empty-state>
                @endif
            </section>

            <!-- Secondary Grid: Stats & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Left Column: Statistics -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Statistics Section -->
                    <section>
                        <div class="mb-6">
                            <h2 class="font-fraunces text-2xl font-bold text-slate-900">Your Learning Journey</h2>
                            <p class="mt-1 text-slate-600">Key metrics and achievements</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Stat Card 1: Swaps Completed -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Total Swaps</p>
                                        <p class="font-fraunces text-4xl font-bold text-slate-900">{{ $completedSwaps }}</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-slate-600">Success Rate: {{ $successRate }}%</span>
                                </div>
                            </div>

                            <!-- Stat Card 2: Average Rating -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Your Rating</p>
                                        <div class="flex items-baseline gap-2">
                                            <p class="font-fraunces text-4xl font-bold text-slate-900">{{ round($user->received_ratings_avg_rating ?? 0, 1) }}</p>
                                            <p class="text-sm text-slate-500">/5.0</p>
                                        </div>
                                    </div>
                                    <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-amber-600">Based on {{ $user->received_ratings_count }} swap{{ $user->received_ratings_count !== 1 ? 's' : '' }}</span>
                                </div>
                            </div>

                            <!-- Stat Card 3: Skills Count -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Skills Offered</p>
                                        <p class="font-fraunces text-4xl font-bold text-slate-900">{{ $offeredSkills->count() }}</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v-1h8v1zm-10-2a4 4 0 00-4 4v1h2v-1a2 2 0 012-2h2v-2zM2 5a2 2 0 114 0 2 2 0 01-4 0z" /></svg>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-blue-600">{{ $wantedSkills->count() }} skills to learn</span>
                                </div>
                            </div>

                            <!-- Stat Card 4: Portfolio Views -->
                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Portfolio Items</p>
                                        <p class="font-fraunces text-4xl font-bold text-slate-900">{{ $totalPortfolios }}</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm4 2v4h8V8H6z" /></svg>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-indigo-600">{{ $totalPortfolioViews }} total views</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Recent Activity Section -->
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="font-fraunces text-2xl font-bold text-slate-900">Recent Activity</h2>
                                <p class="mt-1 text-slate-600">Community updates from recent interactions</p>
                            </div>
                        </div>

                        @if($recentActivities && count($recentActivities) > 0)
                            <div class="space-y-3">
                                @foreach($recentActivities->take(5) as $activity)
                                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start gap-3">
                                            <div class="shrink-0 w-10 h-10 rounded-full bg-linear-to-br from-indigo-400 to-blue-400 flex items-center justify-center flex-none">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-slate-900">{{ $activity['message'] }}</p>
                                                <p class="text-xs text-slate-500 mt-1">{{ $activity['occurred_at']->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <x-empty-state title="No recent activity" description="Community updates will appear here." variant="compact">
                                <x-slot:icon>
                                    <svg class="w-7 h-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </x-slot:icon>
                            </x-empty-state>
                        @endif
                    </section>
                </div>

                <!-- Right Sidebar: Quick Actions & Skill Summary -->
                <div class="space-y-8">
                    <!-- Quick Actions Widget -->
                    <section class="bg-linear-to-br from-indigo-600 to-blue-600 rounded-2xl p-6 shadow-lg shadow-indigo-600/20 text-white">
                        <h2 class="font-fraunces text-xl font-bold mb-6">Quick Actions</h2>
                        <div class="space-y-3">
                            <a href="{{ route('matches.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/10 transition-colors group">
                                <span class="font-medium">Browse Matches</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </a>
                            <a href="{{ route('skills.edit') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/10 transition-colors group">
                                <span class="font-medium">Manage Skills</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </a>
                            <a href="{{ route('portfolio.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/10 transition-colors group">
                                <span class="font-medium">Portfolio</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/10 transition-colors group">
                                <span class="font-medium">Edit Profile</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </div>
                    </section>

                    <!-- Skill Summary Widget -->
                    <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="font-fraunces text-xl font-bold text-slate-900">Skill Summary</h2>
                            <a href="{{ route('skills.edit') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Edit →</a>
                        </div>

                        @if($offeredSkills && count($offeredSkills) > 0)
                            <div class="space-y-4">
                                <!-- Offering Skills -->
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-600 mb-3">Skills You're Offering</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($offeredSkills->take(5) as $skill)
                                            @if($skill->skill)
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                                    {{ $skill->skill->name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Wanted Skills -->
                                @if($wantedSkills && count($wantedSkills) > 0)
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-slate-600 mb-3">Skills You Want to Learn</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($wantedSkills->take(5) as $skill)
                                                @if($skill->skill)
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                                        {{ $skill->skill->name }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <x-empty-state title="Add your first skill" description="Get started by adding skills you can offer or want to learn." variant="compact">
                                <x-slot:icon>
                                    <svg class="w-7 h-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6m0 0H0" /></svg>
                                </x-slot:icon>
                                <x-slot:primaryAction>
                                    <a href="{{ route('skills.edit') }}" class="text-xs text-indigo-600 hover:text-indigo-700 font-bold mt-2 inline-block">Get Started →</a>
                                </x-slot:primaryAction>
                            </x-empty-state>
                        @endif
                    </section>

                    <!-- Community Stats Widget -->
                    <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <h2 class="font-fraunces text-xl font-bold text-slate-900 mb-6">Community Pulse</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50">
                                <span class="text-sm text-slate-600">Total Community Members</span>
                                <span class="font-bold text-lg text-slate-900">{{ $communityStatistics['total_users'] }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50">
                                <span class="text-sm text-slate-600">Skills in Platform</span>
                                <span class="font-bold text-lg text-slate-900">{{ $communityStatistics['total_skills'] }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50">
                                <span class="text-sm text-slate-600">Completed Swaps</span>
                                <span class="font-bold text-lg text-slate-900">{{ $communityStatistics['completed_swaps'] }}</span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
