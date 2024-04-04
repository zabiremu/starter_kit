<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Dashboard' => [
                'Dashboard Menu',
            ],
            'Users Registration' => [
                'Users Menu',
                'Users Create',
                'Users Edit',
                'Users Update',
                'Users Delete',
                'Users Status',
            ],
            'Settings' => [
                'Profile Settings',
                'Password Settings',
                'General Information',
                'Company Information',
                'Mail Settings',
            ],
            'Role' => [
                'Role Create',
                'Role Store',
                'Role Edit',
                'Role Update',
                'Role Status',
                'Role Delete',
            ],
            'Permissions' => [
                'Permissions Menu',
            ],
        ];

        // Loop through the permissions array and create each permission
        foreach ($permissions as $group => $groupPermissions) {
            foreach ($groupPermissions as $permission) {
                Permission::create(['name' => $permission, 'group_name' => $group]);
            }
        }

        $adminRole = Role::where('name', 'super-admin')->first();
        if ($adminRole) {
            // Get all permissions
            $allPermissions = Permission::pluck('name');

            // Sync all permissions to admin role
            $adminRole->syncPermissions($allPermissions);

            // Get the admin user
            $adminUser = User::where('email', 'admin@gmail.com')->first();

            if ($adminUser) {
                // Assign admin role to admin user
                $adminUser->assignRole($adminRole);
            } else {
                // Handle the case where admin user is not found
                echo "Admin user not found.";
            }
        } else {
            // Handle the case where admin role is not found
            echo "Admin role not found.";
        }
    }
}
