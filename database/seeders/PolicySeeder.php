<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Policy::create([
            'name' => 'Motor'
        ]);

        Policy::create([
            'name' => 'Non Motor'
        ]);

        Policy::create([
            'name' => 'Health'
        ]);
    }
}
