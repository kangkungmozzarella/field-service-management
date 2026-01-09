<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $ticketIds = DB::table('tickets')->pluck('id')->toArray();
        $technicianIds = DB::table('technicians')->pluck('id')->toArray();

        $batch = [];
        $now = now();

        foreach ($ticketIds as $ticketId) {
            $assignCount = rand(1, 3);

            // ambil teknisi unik
            $assignedTechs = array_rand(array_flip($technicianIds), $assignCount);

            foreach ((array) $assignedTechs as $technicianId) {
                $batch[] = [
                    'ticket_id'     => $ticketId,
                    'technician_id' => $technicianId,
                    'assigned_at'   => $now,
                ];

                if (count($batch) === 500) {
                    DB::table('ticket_assignments')->insert($batch);
                    $batch = [];
                }
            }
        }

        if ($batch) {
            DB::table('ticket_assignments')->insert($batch);
        }
    }
}
