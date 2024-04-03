<?php

namespace App\Http\Controllers\Web\Backend\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCreateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return DataTables::of($data)->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"> <a href="/" class="btn btn-inverse-danger btn-fw w-25"><i class="mdi mdi-delete-outline"></i></a>';
                    return $btn;
                })
                // ->addColumn('role', function ($data) {
                //     return $data->role == 1 ? 'admin' : ($data->role == 2 ? 'stuff' : 'user');;
                // })
                ->addColumn('image', function ($data) {
                    $img = isset($data->image)  ? asset($data->image) : 'https://api.dicebear.com/8.x/adventurer/svg?seed=' . $data->name . '';
                    return $btn = '<img src="' . $img . '" alt="' . $data->name . '" class="my-1"/>';
                })
                ->addColumn('status', function ($data) {
                    $status = $data->status == 1 ? '<label class="badge badge-success">Active</label>' : '<label class="badge badge-danger">In-active</label>';
                    return $status;
                })
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        return view('backend.layout.user.index');
    }
    public function create()
    {
        // Render the user create page view located at 'backend.layout.user.create'.
        return view('backend.layout.user.create');
    }

    public function store(StoreCreateUserRequest $request)
    {

        // Create new user information
        $user = new User();
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
        $user->password = Hash::make($request->password);
        // Save new user image and get their paths
        $user->image = $image;
        // Save the changes or new record
        $user->save();

        // Redirect to the index page
        return redirect()->route('users.create');
    }
}
