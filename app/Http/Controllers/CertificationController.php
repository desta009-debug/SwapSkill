<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'certificate_url' => 'nullable|url',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $certification = new Certification();
        $certification->user_id = Auth::id();
        $certification->name = $validated['name'];
        $certification->organization = $validated['organization'];
        $certification->issue_date = $validated['issue_date'];
        $certification->certificate_url = $validated['certificate_url'] ?? null;

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('certifications', 'public');
            $certification->image_path = $path;
        }

        $certification->save();

        return redirect()->route('user.show', Auth::id())->with('success', 'Certification added successfully!');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->user_id !== Auth::id()) {
            abort(403);
        }

        if ($certification->image_path) {
            Storage::disk('public')->delete($certification->image_path);
        }

        $certification->delete();

        return redirect()->route('user.show', Auth::id())->with('success', 'Certification deleted successfully!');
    }
}
