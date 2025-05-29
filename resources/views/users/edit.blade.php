@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Edit User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @include('users.partials._form')
            </form>
        </div>
    </div>
</div>
@endsection
