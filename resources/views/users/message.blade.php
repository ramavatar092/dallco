@extends('layouts.app')

@section('content')
<section class="users-list-wrapper">
    <!-- Users Table -->
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Message Lists</h5>
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
