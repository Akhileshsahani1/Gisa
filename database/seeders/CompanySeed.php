<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'company'           => 'GISA IMF PVT LTD.',
            'email'             => 'info@gisa.co.in',
            'dialcode'          => '+91',
            'phone'             => '8305490111',
            'whats_app_dialcode'=> '+91',
            'whats_app'         => '83 0549 0333',
            'address_line_1'    => '67/B, 3rd Floor Milestone Complex, New Rajendra nagar',  
            'address_line_2'    => 'Raipur (C.G)',             
            'city'              => 'Raipur',
            'zipcode'           => '492001',
            'state'             => 'Chattisgarh',
            'iso2'              => 'in',
            'gstin'             => '07AAMFN8512C1ZC',
            'logo'              => null,
        ]);
    }
}
