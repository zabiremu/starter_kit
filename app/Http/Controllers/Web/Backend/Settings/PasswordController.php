<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        // Render the index page view located at 'backend.layout.settings.mailSettings.index'.
        return view('backend.layout.settings.password.index');
    }

    public function update(StoreUserPasswordRequest $request)
    {
        // Get the authenticated user
        $user = User::find(auth()->user()->id);
        // Verify the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('admin.password.index')->with("error", "Current password is incorrect");
        }
        // Hash the new password
        $user->password = Hash::make($request->new_password);
        // Save the updated user
        $user->save();
        return redirect()->route('admin.password.index')->with("success", "Password updated successfully");
    }
}
