@extends('layouts.app')

@section('content')
<section class="payouts-list-wrapper">
    <!-- Payouts Table -->
    <div class="previous-payouts-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Previous Payout Lists</h5>
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
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
