<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Queries\WorkOrderDashboardQuery;

class WorkOrderDashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $region;
    public $status;

    public function render()
    {
        $query = WorkOrderDashboardQuery::base();

        if ($this->region) {
            $query->where('r.id', $this->region);
        }

        if ($this->status) {
            $query->where('wop_last.status', $this->status);
        }

        return view('livewire.work-order-dashboard', [
            'workOrders' => $query->paginate(10),
        ]);
    }
}
