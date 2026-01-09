<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketLogSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = DB::table('tickets')->select('id', 'status', 'created_at')->get();

        $batch = [];

        foreach ($tickets as $ticket) {
            $logCount = rand(2, 4);
            $baseTime = now()->parse($ticket->created_at);

            // CREATED log (selalu ada)
            $batch[] = [
                'ticket_id'  => $ticket->id,
                'action'     => 'CREATED',
                'note'       => 'Ticket created',
                'created_at' => $baseTime,
            ];

            // UPDATED logs
            for ($i = 1; $i < $logCount - 1; $i++) {
                $batch[] = [
                    'ticket_id'  => $ticket->id,
                    'action'     => 'UPDATED',
                    'note'       => 'Ticket updated',
                    'created_at' => $baseTime->copy()->addMinutes($i * 10),
                ];
            }

            // CLOSED log jika ticket CLOSED
            if ($ticket->status === 'CLOSED') {
                $batch[] = [
                    'ticket_id'  => $ticket->id,
                    'action'     => 'CLOSED',
                    'note'       => 'Ticket closed',
                    'created_at' => $baseTime->copy()->addMinutes($logCount * 10),
                ];
            }

            if (count($batch) >= 500) {
                DB::table('ticket_logs')->insert($batch);
                $batch = [];
            }
        }

        if ($batch) {
            DB::table('ticket_logs')->insert($batch);
        }
    }
}
