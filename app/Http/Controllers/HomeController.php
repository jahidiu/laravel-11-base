<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Base\App\Models\Event;
use Modules\Base\App\Models\EventBooking;
use Modules\Base\App\Models\Member;

class HomeController extends Controller
{
    use FileUploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('backend.pages.dashboard');
    }

    public function userProfile()
    {
        $data['user'] = User::find(auth()->user()->id);
        return view('backend.pages.update-user-profile', $data);
    }

    public function updateUserProfile(Request $request)
    {
        try {
            $user = Auth::user();

            // Base validation
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Password change validation (if old password is provided)
            if ($request->filled('old_password')) {
                $request->validate([
                    'old_password' => 'required',
                    'new_password' => 'required|string|min:8|confirmed',
                ]);

                // Check if old password matches
                if (!Hash::check($request->old_password, $user->password)) {
                    return back()->withErrors(['old_password' => 'Old password is incorrect.']);
                }

                // Set new password
                $user->password = Hash::make($request->new_password);
            }

            // Update basic fields
            $user->name = $validated['name'];
            $user->phone = $validated['phone'] ?? null;

            // Handle avatar
            if ($request->hasFile('avatar')) {
                $user->avatar = $this->uploadFile($request->file('avatar'), 'images');
            }

            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Update failed: ' . $th->getMessage());
        }
    }
}
