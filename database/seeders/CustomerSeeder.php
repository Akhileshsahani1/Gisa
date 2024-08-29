<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Lead;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        $leads = Lead::whereNotIn('id', [52, 51])->get();

        foreach($leads as $key => $lead){

            Customer::create([
                'customer_type'         => $lead->lead_type,
                'salutation'            => $lead->salutation,
                'firstname'             => $lead->firstname,
                'lastname'              => $lead->lastname,
                'dialcode'              => $lead->dialcode,
                'phone'                 => $lead->phone,
                'whats_app_dialcode'    => $lead->whats_app_dialcode,
                'whats_app'             => $lead->whats_app,
                'email'                 => $lead->email,
                'gender'                => $lead->gender,
                'date_of_birth'         => $lead->date_of_birth,
                'date_of_anniversary'   => Carbon::now()->subYears('3')->format('Y-m-d'),
                'address'               => $faker->address,
                'gst_no'                => Str::upper(Str::random(15)),
                'pan_no'                => 'CCZPP'.$faker->numerify('####').'B',
                'source'                => 'Website',
                'pancard_file'          => null,
                'gst_file'              => null,
                'aadhar'                => null,
                'other'                 => null,
                'password'              => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ]);
           
        }
    }
}
