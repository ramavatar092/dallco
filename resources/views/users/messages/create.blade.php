@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Create Message</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            @include('users.messages.partials._form')
        </form>
    </div>
</div>
@endsection
