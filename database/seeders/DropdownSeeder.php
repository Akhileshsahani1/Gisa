<?php

namespace Database\Seeders;

use App\Models\DropdownValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DropdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DropdownValue::create([
            'type'       =>'lead-type',
            'value'      =>'Retail',
            'sort_order' =>1,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-type',
            'value'      =>'SME',
            'sort_order' =>2,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-type',
            'value'      =>'Corporate',
            'sort_order' =>3,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-status',
            'value'      =>'New',
            'sort_order' =>1,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-status',
            'value'      =>'Contacted',
            'sort_order' =>2,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-status',
            'value'      =>'Nurturing',
            'sort_order' =>3,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-status',
            'value'      =>'Qualified',
            'sort_order' =>4,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-status',
            'value'      =>'Unqualified',
            'sort_order' =>5,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-source',
            'value'      =>'Phone',
            'sort_order' =>1,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-source',
            'value'      =>'Whatsapp',
            'sort_order' =>2,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-source',
            'value'      =>'Email',
            'sort_order' =>3,
            'status'     =>1,
        ]);
        DropdownValue::create([
            'type'       =>'lead-source',
            'value'      =>'Meeting',
            'sort_order' =>4,
            'status'     =>1,
        ]);

        $ncbs = ['0%','20%','25%','35%','45%','50%'];
        foreach($ncbs as $k => $ncb){
          DropdownValue::create([
              'type'       => 'ncb',
              'value'      => $ncb,
              'sort_order' => $k+1,
              'status'     => 1
          ]);
          DropdownValue::create([
            'type'       => 'previous-ncb',
            'value'      => $ncb,
            'sort_order' => $k+1,
            'status'     => 1
        ]);
        }
    }
}
