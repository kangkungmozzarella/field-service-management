<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('regions')->insert([
        ['name' => 'West'],
        ['name' => 'East'],
        ['name' => 'North'],
        ['name' => 'South'],
        ['name' => 'Central'],
    ]);
}

}
