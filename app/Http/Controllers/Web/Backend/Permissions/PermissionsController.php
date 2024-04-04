<?php

namespace App\Http\Controllers\Web\Backend\Permissions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        $permissions =
            Permission::select('group_name', DB::raw('GROUP_CONCAT(name) as names'), DB::raw('GROUP_CONCAT(id) as id'))
            ->groupBy('group_name')
            ->get();
        return view('backend.layout.role&permissions.permissions.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {



        $request->validate([
            'role_id' => ['required'],
        ]);

        $permissions = $request->permissions;
        $role = Role::find($request->role_id);

        if ($permissions && in_array('All', $permissions)) {
            // If "All" permissions are selected, retrieve all permissions associated with the role
            $permissions = Permission::pluck('name')->toArray();
            $role->syncPermissions($permissions);
            return redirect()->route('admin.permissions')->with('success', "Permissions created successfully");
        }

        // Check if role with provided ID exists
        if ($role) {
            // Sync the permissions with the role
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }
            return redirect()->route('admin.permissions')->with('success', "Permissions created successfully");
        } else {
            return redirect()->route('admin.permissions')->with('success', "Permissions created successfully");
        }
    }
    public function get_permissions(Request $request)
    {
        $roles = Role::where('id', $request->role_id)->first();

        $role = Role::where('name', $roles->name)->first();

        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found.'
            ]);
        }

        $permissions = $role->permissions()->pluck('name')->toArray();

        return response()->json([
            'success' => true,
            'permissions' => $permissions
        ]);
    }
}
