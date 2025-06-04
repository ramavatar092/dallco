@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Create New Coupon</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('coupons.store') }}" method="POST">
            @csrf
            @include('coupons.partials._form')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        }).datepicker('setDate', new Date()); // Sets current date
    });
</script>
@endpush
