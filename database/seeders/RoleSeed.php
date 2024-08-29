<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin', 'guard_name' => 'administrator']);

        Role::create(['name' => 'Staff', 'guard_name' => 'administrator']);        

        Role::create(['name' => 'Claim', 'guard_name' => 'administrator']);

        Role::create(['name' => 'Account', 'guard_name' => 'administrator']);   
        
        Role::create(['name' => 'Renewal', 'guard_name' => 'administrator']);

        Role::create(['name' => 'Sales', 'guard_name' => 'administrator']);

        Role::create(['name' => 'Service Executive', 'guard_name' => 'administrator']);
    }
}
