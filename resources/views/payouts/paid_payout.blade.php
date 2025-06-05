@extends('layouts.app')

@section('content')
<section class="payouts-list-wrapper">
    <!-- Payouts Table -->
    <div class="previous-payouts-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Previous Payouts</h5>
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

<!-- Import Modal -->
<div class="modal fade" id="paymentImportModal" tabindex="-1" aria-labelledby="paymentImportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('payment.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="paymentImportModalLabel">Payment Recoard Import</h5>
      </div>
      <div class="modal-body">
        <input type="file" name="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        // Add date filter to Yajra DataTable
        $.fn.dataTable.ext.errMode = 'throw';

        // Extend the ajax call to include date range
        $('#paid-payout-table').on('preXhr.dt', function (e, settings, data) {
            data.start_date = $('#start_date').val();
            data.end_date = $('#end_date').val();
        });

        // Trigger redraw on filter button click
        $('#filter').on('click', function () {
            $('#paid-payout-table').DataTable().draw();
        });

        // Reset filter and redraw
        $('#reset').on('click', function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#paid-payout-table').DataTable().draw();
        });
    </script>
@endpush
