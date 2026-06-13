<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if ($request->has('password') || $request->has('current_password')) {
            $request->validate([
                'current_password' => 'required|current_password',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user->update(['password' => Hash::make($request->password)]);

            return redirect()->route('user.profile')->with('success', 'Password updated successfully.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'card_nickname' => 'nullable|string|max:255',
            'card_last_four' => 'nullable|string|size:4',
            'card_expiry' => 'nullable|string|max:7',
        ]);

        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
