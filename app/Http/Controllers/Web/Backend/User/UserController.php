<?php

namespace App\Http\Controllers\Web\Backend\User;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCreateUserRequest;
use App\Mail\SendUserEmail;
use App\Models\GeneralInformation;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return DataTables::of($data)->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->email !== "admin@gmail.com") {
                        $roles = $row->getRoleNames();
                        $btn = '<div class="d-flex">
                                    <button  onclick="edit(\'' . $row->id . '\', \'' . $roles[0] . '\')"  data-toggle="modal" data-target="#edit-roles" class="btn btn-inverse-info btn-fw me-3"><i class="mdi mdi-pencil"></i></button>
                                    <a href="' . route('users.destroy', $row->id) . '" class="btn btn-inverse-danger btn-fw w-25 delete-btn"><i class="mdi mdi-delete-outline"></i></a>
                                </div>';
                        return $btn;
                    } else {
                        return $btn = '';
                    }
                })
                ->addColumn('role', function ($data) {
                    $roles = $data->getRoleNames();
                    if (!empty($roles)) {
                        return $roles[0]; // Return the first role name
                    } else {
                        return 'No Role Assigned'; // Or any default value if user has no roles
                    }
                })
                ->addColumn('image', function ($data) {
                    $img = isset($data->image)  ? asset($data->image) : 'https://api.dicebear.com/8.x/adventurer/svg?seed=' . $data->name . '';
                    return $btn = '<img src="' . $img . '" alt="' . $data->name . '" class="my-1"/>';
                })
                ->addColumn('status', function ($data) {
                    if ($data->email !== "admin@gmail.com") {
                        $status = $data->status == 1 ? '<a  href="' . route('users.status', $data->id) . '" class="badge badge-outline-success status-btn" style="cursor:pointer;">Activate</a>' : '<a   href="' . route('users.status', $data->id) . '" class="badge badge-outline-danger status-btn" style="cursor:pointer;">inactive</a>';
                        return $status;
                    } else {
                        return $status = '';
                    }
                })
                ->rawColumns(['action', 'image', 'status', 'role'])
                ->make(true);
        }
        $roles = Role::all();
        return view('backend.layout.user.index', compact('roles'));
    }
    public function create()
    {
        //get all roles
        $roles = Role::all();
        // Render the user create page view located at 'backend.layout.user.create'.
        return view('backend.layout.user.create', compact('roles'));
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
        $user->assignRole($request->role);

        if ($user) {
            $genealInfo = GeneralInformation::first();
            $app_name = $genealInfo->app_title ?? 'Test';
            Mail::to($request->email)->send(new SendUserEmail($request->email, $request->password, $app_name, $request->name));
            // Redirect to the index page
            return redirect()->route('users.index')->with("success", "Created Successfully");
        } else {
            return redirect()->route('users.index')->with("error", "Data didn't save");
        }
    }
    public function status($id)
    {
        // find the user by ID
        $user = User::find($id);
        $user->status = $user->status == '0' ? '1' : '0';
        // Save the changes or new record
        $user->save();
        // Redirect to the index page
        return redirect()->route('users.index')->with("success", "Updated Successfully");
    }

    public function editAssignRole(Request $request)
    {


        // find the user by ID
        $user = User::find($request->id);
        if ($user->status === "1") {
            $role = Role::where('name', $request->role)->first();
            if ($user && $role) {
                $user->syncRoles([$role->id]); // Assign the role to the user
                // Alternatively, you can use $user->assignRole($role) method to assign the role
            }
            // Edit Assign Role
            $user->assignRole($request->name);
            // Redirect to the index page
            return redirect()->route('users.index')->with("success", "Updated Successfully");
        } else {
            return redirect()->route('users.index')->with("error", "You cannot update the status of an inactive user. Please activate the user first.");
        }
    }


    public function destroy($id)
    {
        // Find the user by ID
        $user = User::find($id);
        // Delete the user
        $user->delete();
        // Redirect to the index page
        return redirect()->route('users.index')->with("success", "Deleted Successfully");
    }
}
