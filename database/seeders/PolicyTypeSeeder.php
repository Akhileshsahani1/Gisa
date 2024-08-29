<?php

namespace Database\Seeders;

use App\Models\PolicyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Two Wheeler Package Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Two Wheeler OD Only Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Two Wheeler Bundled Policy ( 1 Yr OD + 5 Yr TP )'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Two Wheeler LTD Policy ( 5 Yr OD + 5 Yr TP )' 
            
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Private Car Package Policy' 
            
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Private Car OD only Policy'
            
        ]);
        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Private Car Bundled Policy ( 1 Yr OD + 3 Yr TP)'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Private Car LTD Policy ( 3 Yr OD + 3 Yr TP)'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Two Wheeler Liability Only Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Private Car Liability Only Policy'
        ]);
        
        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Goods Carrying Vehicle Package Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Goods Carrying Vehicle Liability Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'MISD Package Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'MISD Liability Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Passenger Carrying Vehicle Package Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Passenger Carrying Vehicle Liability Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Taxi Package Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Taxi Liability Policy'
        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       => 'Road Transit Policy'

        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       =>'Motor Fire Policy'

        ]);

        PolicyType::create([
            'policy_id' => 1,
            'type'       =>'Motor Fire and Theft Policy'

        ]);



        // Non-motors-data start


        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Employee Compensation Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Single Transit Marine Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Marine Cargo Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Sales Turn Over Marine Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Bharat Griha Raksha'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Bharat Griha Raksha LTD'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Bharat Sookshma Udyam Suraksha Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Bharat Laghu Udyam Suraksha Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Machinery Breakdown Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Contractor Plant and Machinery Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Burglary Insurance Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Commercial Package Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Jewelers Comprehensive Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Carrier Legal Liability Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Public Liability Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Doctors Indemnity Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'LPG Trader Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'My Home All Risk Insurance Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Contractor All Risk Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Directors and Officers Liability Policy'

        ]);
        PolicyType::create([
            'policy_id' => 2,
            'type'       =>'Surety Bond Policy'

        ]);


        // Health  seeder start 


        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Individual Health Insurance Policy'

        ]);

        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Family Floater Health Insurance Policy'

        ]);

        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Group Health Insurance Policy'

        ]);

        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Individual Personal Accident Insurance Policy'

        ]);

        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Family Floater Personal Accident Insurance Policy'

        ]);

        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Critical Illness Insurance Policy'

        ]);

        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Health Top Up Insurance Policy'

        ]);

        PolicyType::create([
            'policy_id' => 3,
            'type'       =>'Group Personal Accident Insurance Policy'

        ]);
        

    }
}
