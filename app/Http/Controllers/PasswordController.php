<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('Profile Folder.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        // Check if the current password matches the password in the database
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['errors' => ['current_password' => 'The current password is incorrect.']], 422);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->password =bcrypt($request->new_password);

        return response()->json(['success' => 'Password changed successfully.']);
    }
}
