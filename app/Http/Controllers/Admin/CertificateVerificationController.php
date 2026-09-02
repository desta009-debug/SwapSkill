<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Services\CertificateVerificationService;
use Illuminate\Http\Request;

class CertificateVerificationController extends Controller
{
    public function __construct(
        protected CertificateVerificationService $service
    ) {}

    /**
     * Display a listing of certificates.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $status = $request->input('status', '');

        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');

        $query = Certification::query()
            ->with(['user', 'verifier']);

        // Search
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('organization', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Status
        if (in_array($status, ['pending', 'verified', 'rejected'])) {
            $query->where('verification_status', $status);
        }

        // Sorting
        switch ($sort) {

            case 'user':
                $query->join('users', 'users.id', '=', 'certifications.user_id')
                    ->orderBy('users.name', $direction)
                    ->select('certifications.*');
                break;

            case 'certificate':
                $query->orderBy('name', $direction);
                break;

            case 'organization':
                $query->orderBy('organization', $direction);
                break;

            case 'issue_date':
                $query->orderBy('issue_date', $direction);
                break;

            default:
                $query->latest();
                break;
        }

        $certifications = $query
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'pending' => Certification::where('verification_status', 'pending')->count(),
            'verified' => Certification::where('verification_status', 'verified')->count(),
            'rejected' => Certification::where('verification_status', 'rejected')->count(),
            'total' => Certification::count(),
        ];

        return view('admin.certificates.index', compact(
            'certifications',
            'search',
            'status',
            'stats',
            'sort',
            'direction'
        ));
    }

    /**
     * Detail sertifikat.
     */
    public function show(Certification $certification)
    {
        $certification->load(['user', 'verifier']);

        return view('admin.certificates.show', compact(
            'certification'
        ));
    }

    /**
     * Approve sertifikat.
     */
    public function approve(Certification $certification)
    {
        $this->service->approve($certification);

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate has been verified.');
    }

    /**
     * Reject sertifikat.
     */
    public function reject(
        Request $request,
        Certification $certification
    ) {
        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        $this->service->reject(
            $certification,
            $request->reason
        );

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate has been rejected.');
    }
}
