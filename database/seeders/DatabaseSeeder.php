<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeed::class);
        $this->call(CompanySeed::class);


        \App\Models\User::factory()->create([
            'name' => 'Prashant Chauhan',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password')
        ]);

        \App\Models\User::factory(39)->create();

        $admin = \App\Models\Administrator::factory()->create([
            'firstname' => 'Nurul',
            'lastname' => 'Hasan',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $admin->assignRole('Admin');

        $staff = \App\Models\Administrator::factory()->create([
            'firstname' => 'Staff',
            'lastname' => 'Person',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password')
        ]);

        $staff->assignRole('Staff');

        $claim = \App\Models\Administrator::factory()->create([
            'firstname' => 'Claim',
            'lastname' => 'Person',
            'email' => 'claim@gmail.com',
            'password' => Hash::make('password')
        ]);

        $claim->assignRole('Claim');

        $account = \App\Models\Administrator::factory()->create([
            'firstname' => 'Account',
            'lastname' => 'Person',
            'email' => 'account@gmail.com',
            'password' => Hash::make('password')
        ]);

        $account->assignRole('Account');

        $renewal = \App\Models\Administrator::factory()->create([
            'firstname' => 'Renewal',
            'lastname' => 'Person',
            'email' => 'renewal@gmail.com',
            'password' => Hash::make('password')
        ]);

        $renewal->assignRole('Renewal');

        $sales = \App\Models\Administrator::factory()->create([
            'firstname' => 'Sales',
            'lastname' => 'Person',
            'email' => 'sales@gmail.com',
            'password' => Hash::make('password')
        ]);

        $sales->assignRole('Sales');

        $serviceexecutive = \App\Models\Administrator::factory()->create([
            'firstname' => 'Service',
            'lastname' => 'Executive',
            'email' => 'Serviceexecutive@gmail.com',
            'password' => Hash::make('password')
        ]);

        $serviceexecutive->assignRole('Service Executive');

        // \App\Models\Administrator::factory(5)->create();

        $this->call(PolicySeeder::class);

        $this->call(PolicyTypeSeeder::class);

        $this->call(LeadSeeder::class);

        $this->call(CustomerSeeder::class);

        $this->call(InsuranceCompanySeeder::class);

        $this->call(AgencySeeder::class);

        $this->call(DropdownSeeder::class);
        $this->call(PermissionSeed::class);

       // $this->call(QuotationSeeder::class);

    }
}
