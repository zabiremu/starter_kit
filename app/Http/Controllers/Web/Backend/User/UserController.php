<?php

namespace App\Http\Controllers\Web\Backend\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        // Render the user create page view located at 'backend.layout.user.create'.
        return view('backend.layout.settings.user.create');
    }

    public function create(StoreCreateUserRequest $request)
    {
        // Check if an ID is provided in the request
        if ($request->id) {
            // Update existing user information
            $user = User::findOrFail($request->id);
        } else {
            // Create new user information
            $user = new User();
        }
        // Save the user image provided in the request.
        // Parameters:
        // 1. $request->image: The uploaded user image file.
        // 2. 'user': The directory in which the image will be saved.
        // 3. 'user-picture': The filename to be used for the saved favicon image.
        // 4. $user->image: The existing favicon filename (if any) to be replaced.
        $image = saveImage($request->image, 'user-picture', 'user-profile', $user->image);

        // Assign values from the request to the user object
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        // Save new user image and get their paths
        $user->image = $image;
        // Save the changes or new record
        $user->save();

        // Redirect to the index page
        return redirect()->route('admin.profile.index');
    }
}
