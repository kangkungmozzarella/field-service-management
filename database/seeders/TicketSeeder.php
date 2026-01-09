<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $workOrderIds = DB::table('work_orders')->pluck('id')->toArray();

        $batch = [];
        $now = now();
        $ticketCounter = 1;

        foreach ($workOrderIds as $workOrderId) {
            $ticketCount = rand(4, 8); // rata-rata ±6 ticket

            for ($i = 0; $i < $ticketCount; $i++) {
                $batch[] = [
                    'work_order_id' => $workOrderId,
                    'ticket_code'   => 'TCK-' . str_pad($ticketCounter++, 7, '0', STR_PAD_LEFT),
                    'status'        => rand(1, 100) <= 70 ? 'OPEN' : 'CLOSED',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];

                if (count($batch) === 500) {
                    DB::table('tickets')->insert($batch);
                    $batch = [];
                }
            }
        }

        if ($batch) {
            DB::table('tickets')->insert($batch);
        }
    }
}
