<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'superadmin']);
        $roleFinance = Role::firstOrCreate(['name' => 'finance']);
        $roleOps = Role::firstOrCreate(['name' => 'operations']);

        $allPermission = [
            // User Permissions
            "view.users",
            "create.users",
            "edit.users",
            "delete.users",

            // Role Permissions
            "view.roles",
            "create.roles",
            "edit.roles",
            "delete.roles",

            // Permission Permissions
            "view.permissions",
            "create.permissions",
            "edit.permissions",
            "delete.permissions",

            // TODO : Add more permissions as needed
        ];

        foreach($allPermission as $permission){
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roleAdmin->syncPermissions($allPermission);

        $superadminUser = User::updateOrCreate([
            'email' => "superadmin@myvilla.com",
        ], [
            'name' => "Superadmin My Villa",
            'password' => Hash::make("password123"),
            'email_verified_at' => now(),
        ]);
        $superadminUser->assignRole($roleAdmin);

        $financeUser = User::firstOrCreate([
            'name' => "Finance My Villa",
            'email' => "finance@myvilla.com",
            "password" => Hash::make("password123"),
            "email_verified_at" => now(),
        ]);
        $financeUser->assignRole($roleFinance);

        $opsUser = User::firstOrCreate([
            'name' => "Operations My Villa",
            'email' => "operations@myvilla.com",
            "password" => Hash::make("password123"),
            "email_verified_at" => now(),
        ]);
        $opsUser->assignRole($roleOps);
    }
}
