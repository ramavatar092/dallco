@extends('layouts.app')

@section('content')
<section class="scan-logs-list-wrapper">
    <!-- Users Table -->
    <div class="scan-logs-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Scan Log</h5>
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
                    <div class="table table-striped table-fixed table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        // Add date filter to Yajra DataTable
        $.fn.dataTable.ext.errMode = 'throw';

        // Extend the ajax call to include date range
        $('#scan-log-table').on('preXhr.dt', function (e, settings, data) {
            data.start_date = $('#start_date').val();
            data.end_date = $('#end_date').val();
        });

        // Trigger redraw on filter button click
        $('#filter').on('click', function () {
            $('#scan-log-table').DataTable().draw();
        });

        // Reset filter and redraw
        $('#reset').on('click', function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#scan-log-table').DataTable().draw();
        });
    </script>
@endpush
