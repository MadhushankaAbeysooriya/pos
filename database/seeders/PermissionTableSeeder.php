<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'master-location-types-list',
            'master-location-types-create',
            'master-location-types-edit',
            'master-location-types-delete',

            'master-location-list',
            'master-location-create',
            'master-location-edit',
            'master-location-delete',

            'master-item-categories-list',
            'master-item-categories-create',
            'master-item-categories-edit',
            'master-item-categories-delete',

            'master-item-list',
            'master-item-create',
            'master-item-edit',
            'master-item-delete',
            'master-item-add-alternative-item',

            'master-brand-list',
            'master-brand-create',
            'master-brand-edit',
            'master-brand-delete',

            'master-measurement-list',
            'master-measurement-create',
            'master-measurement-edit',
            'master-measurement-delete',

            'master-supplier-list',
            'master-supplier-create',
            'master-supplier-edit',
            'master-supplier-delete',
        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate(['name' => $permission]);

        }
    }
}
