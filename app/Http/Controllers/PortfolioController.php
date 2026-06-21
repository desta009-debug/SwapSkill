<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Services\ShowcaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PortfolioController extends Controller
{
    use AuthorizesRequests;

    private ShowcaseService $showcaseService;

    public function __construct(ShowcaseService $showcaseService)
    {
        $this->showcaseService = $showcaseService;
    }

    public function index(Request $request)
    {
        $query = Portfolio::with(['user', 'user.offeredSkills'])->where('status', 'published');

        // Search & Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('technologies', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('featured')) {
            $query->where('featured', true);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'most_viewed') {
            $query->orderByDesc('views_count');
        } elseif ($sort === 'highest_rated') {
            $query->join('users', 'portfolios.user_id', '=', 'users.id')
                  ->leftJoin('ratings', 'users.id', '=', 'ratings.user_id')
                  ->selectRaw('portfolios.*, AVG(ratings.rating) as avg_rating')
                  ->groupBy('portfolios.id')
                  ->orderByDesc('avg_rating');
        } else {
            $query->latest();
        }

        $portfolios = $query->paginate(12)->withQueryString();
        
        $categories = [
            'Web Development', 'Mobile Development', 'UI/UX Design', 
            'Graphic Design', 'Data Analytics', 'Artificial Intelligence', 
            'Cyber Security', 'Digital Marketing', 'Other'
        ];

        return view('portfolio.index', compact('portfolios', 'categories'));
    }

    public function create()
    {
        $categories = [
            'Web Development', 'Mobile Development', 'UI/UX Design', 
            'Graphic Design', 'Data Analytics', 'Artificial Intelligence', 
            'Cyber Security', 'Digital Marketing', 'Other'
        ];
        
        return view('portfolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
            'featured' => 'nullable|boolean',
        ]);

        $portfolio = new Portfolio();
        $portfolio->user_id = Auth::id();
        $portfolio->title = $validated['title'];
        $portfolio->category = $validated['category'];
        $portfolio->description = $validated['description'];
        
        // Convert comma-separated string to array
        if (!empty($validated['technologies'])) {
            $portfolio->technologies = array_map('trim', explode(',', $validated['technologies']));
        } else {
            $portfolio->technologies = [];
        }

        $portfolio->project_url = $validated['project_url'] ?? null;
        $portfolio->github_url = $validated['github_url'] ?? null;
        $portfolio->demo_url = $validated['demo_url'] ?? null;
        $portfolio->featured = $request->has('featured');
        $portfolio->status = 'published';

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('portfolios', 'public');
            $portfolio->thumbnail = $path;
        }

        $portfolio->save();

        return redirect()->route('portfolio.show', $portfolio)->with('success', 'Portfolio project created successfully!');
    }

    public function show(Portfolio $portfolio)
    {
        // Increment views
        $portfolio->increment('views_count');

        $portfolio->load(['user', 'user.skills', 'user.offeredSkills', 'user.wantedSkills']);
        $portfolio->user->loadAvg('receivedRatings', 'rating');

        $aiRecommendation = $this->showcaseService->generateRecommendation($portfolio, Auth::user());

        return view('portfolio.show', compact('portfolio', 'aiRecommendation'));
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $categories = [
            'Web Development', 'Mobile Development', 'UI/UX Design', 
            'Graphic Design', 'Data Analytics', 'Artificial Intelligence', 
            'Cyber Security', 'Digital Marketing', 'Other'
        ];

        return view('portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
            'featured' => 'nullable|boolean',
        ]);

        $portfolio->title = $validated['title'];
        $portfolio->category = $validated['category'];
        $portfolio->description = $validated['description'];
        
        if (!empty($validated['technologies'])) {
            $portfolio->technologies = array_map('trim', explode(',', $validated['technologies']));
        } else {
            $portfolio->technologies = [];
        }

        $portfolio->project_url = $validated['project_url'] ?? null;
        $portfolio->github_url = $validated['github_url'] ?? null;
        $portfolio->demo_url = $validated['demo_url'] ?? null;
        $portfolio->featured = $request->has('featured');

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($portfolio->thumbnail) {
                Storage::disk('public')->delete($portfolio->thumbnail);
            }
            $path = $request->file('thumbnail')->store('portfolios', 'public');
            $portfolio->thumbnail = $path;
        }

        $portfolio->save();

        return redirect()->route('portfolio.show', $portfolio)->with('success', 'Portfolio project updated successfully!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorize('delete', $portfolio);

        if ($portfolio->thumbnail) {
            Storage::disk('public')->delete($portfolio->thumbnail);
        }

        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio deleted successfully!');
    }
}
