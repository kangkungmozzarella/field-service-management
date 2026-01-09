<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkOrderSeeder extends Seeder
{
    public function run(): void
    {
        $regionIds = DB::table('regions')->pluck('id')->toArray();

        $batch = [];
        $now = now();

        for ($i = 1; $i <= 10000; $i++) {
            $batch[] = [
                'work_code' => 'WO-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'region_id' => $regionIds[array_rand($regionIds)],
                'work_date' => $now->copy()->subDays(rand(0, 90))->toDateString(),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($batch) === 500) {
                DB::table('work_orders')->insert($batch);
                $batch = [];
            }
        }

        if ($batch) {
            DB::table('work_orders')->insert($batch);
        }
    }
}
