<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModerationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModerationController extends Controller
{
    public function index(Request $request)
    {
        $query = ModerationLog::with('user');

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('original_content', 'like', "%{$search}%")
                  ->orWhere('cleaned_content', 'like', "%{$search}%")
                  ->orWhere('matched_words', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Content Type Filter
        if ($request->filled('content_type')) {
            $query->where('content_type', $request->content_type);
        }

        $logs = $query->latest()->paginate(15)->withQueryString();

        // Statistics
        $totalLogs = ModerationLog::count();
        $contentTypeBreakdown = ModerationLog::select('content_type', DB::raw('count(*) as total'))
            ->groupBy('content_type')
            ->pluck('total', 'content_type')
            ->toArray();

        // Calculate most common prohibited words from JSON logs
        $allMatchedWords = ModerationLog::whereNotNull('matched_words')->pluck('matched_words');
        $wordCounts = [];

        foreach ($allMatchedWords as $wordsArray) {
            if (is_array($wordsArray)) {
                foreach ($wordsArray as $word) {
                    $wordLower = strtolower(trim($word));
                    if (!isset($wordCounts[$wordLower])) {
                        $wordCounts[$wordLower] = 0;
                    }
                    $wordCounts[$wordLower]++;
                }
            }
        }

        arsort($wordCounts);
        $topProhibitedWords = array_slice($wordCounts, 0, 5, true);

        $contentTypes = ModerationLog::distinct()->pluck('content_type')->toArray();

        return view('admin.moderation.index', compact(
            'logs',
            'totalLogs',
            'contentTypeBreakdown',
            'topProhibitedWords',
            'contentTypes'
        ));
    }
}
