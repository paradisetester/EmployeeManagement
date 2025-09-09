<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // return view('profile.show', compact('user'));
        return view('employee.viewprofile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate([
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $imageName = time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('images/profiles'), $imageName);
            $data['profile_image'] = $imageName;
        }
        
        $user->update($data);

        return redirect()->route('employee.show')->with('success', 'Profile updated successfully.');
    }
}