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

            'annual-demand-list',
            'annual-demand-create',
            'annual-demand-edit',
            'annual-demand-delete',

            'demand-from-location-list',
            'demand-from-location-create',
            'demand-from-location-edit',
            'demand-from-location-delete',
            'demand-from-location-create-reciept',

            'master-location-types-list',
            'master-location-types-create',
            'master-location-types-edit',
            'master-location-types-delete',

            'master-location-list',
            'master-location-create',
            'master-location-edit',
            'master-location-delete',

            'master-ration-categories-list',
            'master-ration-categories-create',
            'master-ration-categories-edit',
            'master-ration-categories-delete',

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

            'master-quarter-list',
            'master-quarter-create',
            'master-quarter-edit',
            'master-quarter-delete',

            'master-measurement-list',
            'master-measurement-create',
            'master-measurement-edit',
            'master-measurement-delete',

            'master-receipt-type-list',
            'master-receipt-type-create',
            'master-receipt-type-edit',
            'master-receipt-type-delete',

            'master-ration-date-list',
            'master-ration-date-create',
            'master-ration-date-edit',
            'master-ration-date-delete',

            'master-ration-time-list',
            'master-ration-time-create',
            'master-ration-time-edit',
            'master-ration-time-delete',

            'master-menu-list',
            'master-menu-create',
            'master-menu-edit',
            'master-menu-delete',

            'master-supplier-list',
            'master-supplier-create',
            'master-supplier-edit',
            'master-supplier-delete',

            'master-ration-type-list',
            'master-ration-type-create',
            'master-ration-type-edit',
            'master-ration-type-delete',

            'master-approved-unit-price-list',
            'master-approved-unit-price-create',
            'master-approved-unit-price-edit',
            'master-approved-unit-price-delete',


        ];
     
        foreach ($permissions as $permission) {

            Permission::firstOrCreate(['name' => $permission]);

        }
    }
}
