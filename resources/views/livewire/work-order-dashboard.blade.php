<div>
    <h3 class="mb-3">Work Order Dashboard</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Work Code</th>
                <th>Region</th>
                <th>Last Status</th>
                <th>Total Tickets</th>
                <th>Open Tickets</th>
                <th>Total Progress</th>
                <th>Technicians</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workOrders as $wo)
                <tr>
                    <td>{{ $wo->work_code }}</td>
                    <td>{{ $wo->region }}</td>
                    <td>{{ $wo->last_status ?? '-' }}</td>
                    <td>{{ $wo->total_tickets }}</td>
                    <td>{{ $wo->open_tickets }}</td>
                    <td>{{ $wo->total_progress }}</td>
                    <td>{{ $wo->total_technicians }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $workOrders->links() }}
</div>
