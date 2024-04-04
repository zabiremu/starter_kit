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
                        $btn = '<div class="d-flex"> <button  onclick="edit(\'' . $row->id . '\', \'' . $row->name . '\')"  data-toggle="modal" data-target="#edit-roles" class="btn btn-inverse-info btn-fw me-3"><i class="mdi mdi-pencil"></i></button> <a href="' . route('roles.destroy', $row->id) . '" class="btn btn-inverse-danger btn-fw w-25 delete-btn"><i class="mdi mdi-delete-outline"></i></a></div>';

                        return $btn;
                    } else {
                        return $btn = '';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.layout.role&permissions.index');
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
        $role = Role::find($request->id);
        // Update the role properties
        $role->name = $request->name;
        // Save the changes
        $role->save();
        // Redirect to the index page
        return redirect()->route('roles.index')->with("success", "Updated Successfully");
    }

    public function destroy($id)
    {
        // Find the Role by ID
        $user = Role::find($id);
        // Delete the Role
        $user->delete();
        // Redirect to the index page
        return redirect()->route('roles.index')->with("success", "Deleted Successfully");
    }
}
