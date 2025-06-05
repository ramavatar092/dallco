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
@endpush
