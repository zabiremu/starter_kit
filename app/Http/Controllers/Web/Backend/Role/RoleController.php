<?php

namespace App\Http\Controllers\Web\Backend\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreRoleController;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::get();
            return DataTables::of($data)->addIndexColumn()
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->name !== "super-admin" && $row->name !== "user") {
                        $btn = '<div class="d-flex"> <a href="' . route('users.destroy', $row->id) . '" class="btn btn-inverse-danger btn-fw w-25 delete-btn"><i class="mdi mdi-delete-outline"></i></a>';
                        return $btn;
                    } else {
                        return $btn = '';
                    }
                })
                ->addColumn('image', function ($data) {
                    $img = isset($data->image)  ? asset($data->image) : 'https://api.dicebear.com/8.x/adventurer/svg?seed=' . $data->name . '';
                    return $btn = '<img src="' . $img . '" alt="' . $data->name . '" class="my-1"/>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.layout.role.index');
    }
    public function create()
    {
        // Render the user create page view located at 'backend.layout.user.create'.
        return view('backend.layout.user.create');
    }

    public function store(StoreRoleController $request)
    {
        // create new roles
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        // Redirect to the index page
        return redirect()->route('roles.index')->with("success", "Created Successfully");
    }


    public function update(StoreRoleController $request)
    {
        // Find the role you want to edit
        $role = Role::findByName($request->old_role_name);
        // Update the role properties
        $role->name = $request->name;
        // Save the changes
        $role->save();
        // Redirect to the index page
        return redirect()->route('roles.index')->with("success", "Created Successfully");
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
