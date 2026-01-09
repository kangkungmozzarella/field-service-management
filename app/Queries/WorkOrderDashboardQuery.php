<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class WorkOrderDashboardQuery
{
    public static function base()
    {
        $lastProgressSub = DB::table('work_order_progresses as wop1')
            ->select('wop1.work_order_id', 'wop1.status', 'wop1.created_at')
            ->join(
                DB::raw('(SELECT work_order_id, MAX(created_at) as max_created
                          FROM work_order_progresses
                          GROUP BY work_order_id) as wop2'),
                function ($join) {
                    $join->on('wop1.work_order_id', '=', 'wop2.work_order_id')
                         ->on('wop1.created_at', '=', 'wop2.max_created');
                }
            );

        return DB::table('work_orders as wo')
            ->join('regions as r', 'r.id', '=', 'wo.region_id')
            ->leftJoin('tickets as t', 't.work_order_id', '=', 'wo.id')
            ->leftJoin('ticket_assignments as ta', 'ta.ticket_id', '=', 't.id')
            ->leftJoin('work_order_progresses as wop', 'wop.work_order_id', '=', 'wo.id')
            ->leftJoinSub($lastProgressSub, 'wop_last', function ($join) {
                $join->on('wop_last.work_order_id', '=', 'wo.id');
            })
            ->selectRaw('
                wo.id,
                wo.work_code,
                r.name as region,
                wop_last.status as last_status,
                wop_last.created_at as last_progress_at,
                COUNT(DISTINCT t.id) as total_tickets,
                SUM(t.status = "OPEN") as open_tickets,
                COUNT(wop.id) as total_progress,
                COUNT(DISTINCT ta.technician_id) as total_technicians
            ')
            ->groupBy(
                'wo.id',
                'wo.work_code',
                'r.name',
                'wop_last.status',
                'wop_last.created_at'
            );
    }
}
