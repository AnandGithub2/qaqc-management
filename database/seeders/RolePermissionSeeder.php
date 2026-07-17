<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            'manage users',
            'manage companies',
            'manage products',
            'create samples',
            'assign tests',
            'enter test results',
            'approve samples',
            'generate coa',
            'view reports',

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission
            ]);

        }

        $admin = Role::findByName('Admin');
        $admin->givePermissionTo(Permission::all());

        $qa = Role::findByName('QA Manager');
        $qa->givePermissionTo([
            'approve samples',
            'generate coa',
            'view reports'
        ]);

        $lab = Role::findByName('Lab Technician');
        $lab->givePermissionTo([
            'assign tests',
            'enter test results'
        ]);

        $client = Role::findByName('Client');
        $client->givePermissionTo([
            'view reports'
        ]);
    }
}