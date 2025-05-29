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
