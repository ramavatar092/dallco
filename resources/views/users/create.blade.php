@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Create New User</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('users.partials._form')
        </form>
    </div>
</div>
@endsection
