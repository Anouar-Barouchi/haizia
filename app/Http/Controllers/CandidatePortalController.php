<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CandidatePortalController extends Controller
{
    public function setupForm(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            abort(401, 'This link is invalid or has expired.');
        }

        $candidate = Candidate::findOrFail($id);

        // If password is already set, redirect to login
        if ($candidate->password) {
            return redirect()->route('portal.login')->with('info', 'Your account is already set up. Please log in.');
        }

        return view('portal.setup', compact('candidate'));
    }

    public function setupSave(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            abort(401, 'This link is invalid or has expired.');
        }

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $candidate = Candidate::findOrFail($id);
        $candidate->password = Hash::make($request->password);
        $candidate->save();

        Auth::guard('candidate')->login($candidate);

        return redirect()->route('portal.dashboard')->with('success', 'تم إعداد كلمة المرور بنجاح!');
    }

    public function showLoginForm()
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('portal.dashboard');
        }

        return view('portal.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('candidate')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('portal.dashboard'));
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('candidate')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('portal.login');
    }

    public function dashboard()
    {
        $candidate = Auth::guard('candidate')->user();
        return view('portal.dashboard', compact('candidate'));
    }

    public function submitPhotos(Request $request)
    {
        $candidate = Auth::guard('candidate')->user();

        if ($candidate->competition_status !== 'started') {
            return back()->with('error', 'لا يمكنك رفع الصور في الوقت الحالي.');
        }

        $request->validate([
            'camera_brand' => 'required|string',
            'camera_model' => 'required|string',
            'camera_lenses' => 'nullable|string',
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|max:10240', // 10MB max per photo
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('competition_submissions', 'public');
                $photoPaths[] = $path;
            }
        }

        $candidate->update([
            'camera_brand' => $request->camera_brand,
            'camera_model' => $request->camera_model,
            'camera_lenses' => $request->camera_lenses,
            'competition_submissions' => $photoPaths,
            'competition_status' => 'submitted',
            'competition_submitted_at' => now(),
        ]);

        return redirect()->route('portal.dashboard')->with('success', 'تم رفع الصور والمعلومات بنجاح!');
    }
}
