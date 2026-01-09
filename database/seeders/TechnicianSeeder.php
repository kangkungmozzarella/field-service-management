<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $batch = [];

    for ($i = 1; $i <= 2000; $i++) {
        $batch[] = [
            'name' => 'Technician ' . $i,
            'code' => 'TECH-' . str_pad($i, 4, '0', STR_PAD_LEFT),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (count($batch) === 500) {
            DB::table('technicians')->insert($batch);
            $batch = [];
        }
    }

    if ($batch) {
        DB::table('technicians')->insert($batch);
    }
}

}
