@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Coupon</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('coupons.update', [$coupon->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('coupons.partials._form')
        </form>
    </div>
</div>
@endsection
