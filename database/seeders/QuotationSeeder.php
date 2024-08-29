<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Agency;
use App\Models\Customer;
use App\Models\InsuranceCompany;
use App\Models\Policy;
use App\Models\PolicyType;
use App\Models\Quotation;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = app(Generator::class);
        $policies   = Policy::get();

        foreach ($policies as $policy) {
            $policy_types = PolicyType::where('policy_id', $policy->id)->get();
            foreach ($policy_types as $type) {
                $buiness_type = $faker->randomElement(["New", "Roll Over", "Renewal"]);
                switch ($type->id) {
                    case 1:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            // 'business_type'                         => $buiness_type,
                            // 'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            // 'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            // 'registration_no'                       => $faker->numerify('CG04AX####'),
                            // 'new'                                   => $faker->randomElement(['Yes', 'No']),
                            // 'make'                                  => $faker->randomElement(['Bajaj', 'Hero Honda', 'TVS', 'Yamaha', 'Suzuki', 'Honda', 'KTM', 'Royal Enfield']),
                            // 'model'                                 => $faker->randomElement(['Pulsar 200 NS', 'Splendor', 'Apache', 'R15', 'Hayabusa', 'Activa', 'RC390', 'Bullet 350 CLassic']),
                            // 'cubic_capacity'                        => $faker->randomElement(['98', '100', '125', '150', '200', '220', '350', '390', '500', '1000']),
                            // 'year_of_manufacture'                   => $faker->randomElement(['2012', '2014', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023']),
                            // 'registration_date'                     => Carbon::now()->subYears(5)->format('Y-m-d'),
                            // 'engine_no'                             => $faker->numerify('JAPB###CS######'),
                            // 'chassis_no'                            => $faker->numerify('MA#EF#JCS########'),
                            // 'previous_policy_no'                    => $buiness_type == "New" ? null : $faker->numerify('211200/1/2024/####'),
                            // 'previous_policy_expiry_date'           => $buiness_type == "New" ? null : Carbon::now()->subYears(4)->format('Y-m-d'),
                            // 'previous_insurance_company_id'         => $buiness_type == "New" ? null : InsuranceCompany::inRandomOrder()->first()->id,
                            // 'previous_ncb'                          => $buiness_type == "New" ? null : $faker->randomElement(['20%', '25%', '35%', '45%', '50%']),
                            // 'claim'                                 => $buiness_type == "New" ? null : $faker->randomElement(['Yes', 'No']),
                            // 'policy_no'                             => $faker->numerify('211200/1/2024=5/####'),
                            // 'policy_start_date'                     => Carbon::now()->format('Y-m-d'),
                            // 'policy_expiry_date'                    => Carbon::now()->addYear(1)->format('Y-m-d'),
                            // 'financer_name'                         => $faker->randomElement(['Bajaj Auto Finance', 'Muthoot Finance', 'Hero Finance', 'Shriram Finance', 'HDFC', 'State Bank of India', 'ICICI Bank', 'Axis bank', 'UCO Bank']),
                            // 'insurance_company_id'                  => InsuranceCompany::inRandomOrder()->first()->id,
                            // 'agency_id'                             => Agency::inRandomOrder()->first()->id,
                            // 'idv'                                   => 100000,
                            // 'ncb'                                   => $faker->randomElement(['20%', '25%', '35%', '45%', '50%']),
                            // 'gross_od'                              => 5000,
                            // 'gross_tp'                              => 2399,
                            // 'gst_od'                                => 320,
                            // 'gst_tp'                                => 280,
                            // 'net_premium'                           => $faker->randomElement(['3180', '3240', '3320', '3460', '3530', '3698']),
                            // 'gross_premium'                         => $faker->randomElement(['3720', '3770', '3850', '3880', '3920', '3940']),
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 2:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 3:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 4:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 5:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 6:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 7:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 8:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 9:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 10:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 11:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 12:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 13:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 14:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 15:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 16:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 17:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 18:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 19:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 20:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 21:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 22:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 23:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 24:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 25:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 26:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 27:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 28:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 29:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 30:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 31:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 32:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 33:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 34:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 35:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 36:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 37:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 38:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 39:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 40:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 41:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 42:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 43:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 44:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 45:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 46:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 47:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 48:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 49:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    case 50:
                        Quotation::create([
                            'lead_id'                               => $type->id,
                            'customer_id'                           => $type->id,
                            'policy_id'                             => $policy->id,
                            'policy_type_id'                        => $type->id,
                            'sales_executive_id'                    => Administrator::inRandomOrder()->first()->id,
                            'service_executive_id'                  => Administrator::inRandomOrder()->first()->id,
                            'status'                                => 'Pending'
                        ]);
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
    }
}
