<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
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

            'view reports'

        ];



        foreach($permissions as $permission)
        {

            Permission::firstOrCreate([
                'name'=>$permission
            ]);

        }


    }

}