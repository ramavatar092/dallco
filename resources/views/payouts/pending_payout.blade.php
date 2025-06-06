@extends('layouts.app')

@section('content')
<section class="pending-list-wrapper">
    <div class="pending-payouts-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pending Payouts</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="date" id="start_date" class="form-control" placeholder="Start Date">
                        </div>
                        <div class="col-md-3">
                            <input type="date" id="end_date" class="form-control" placeholder="End Date">
                        </div>
                        <div class="col-md-3">
                            <button id="filter" class="btn btn-primary">Filter</button>
                            <button id="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-bordered table-striped w-100'], true) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $.fn.dataTable.ext.errMode = 'throw';

        // Attach filter data before ajax request
        $('#pending-payout-table').on('preXhr.dt', function (e, settings, data) {
            data.start_date = $('#start_date').val();
            data.end_date = $('#end_date').val();
        });

        // Filter button
        $('#filter').on('click', function () {
            $('#pending-payout-table').DataTable().draw();
        });

        // Reset button
        $('#reset').on('click', function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#pending-payout-table').DataTable().draw();
        });
    </script>
@endpush
