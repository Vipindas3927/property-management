<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Region 1',
                'code'=> '1',
            ],
            [
                'name' => 'Region 2',
                'code'=> '2',
            ],
            [
                'name' => 'Region 3',
                'code'=> '3',
            ],
        ];
        Region::insert($data);
    }
}
