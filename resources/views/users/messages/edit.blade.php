@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Message</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('messages.update', $message->id ?? '') }}" method="POST">
            @csrf
            @method('PUT')
            @include('users.messages.partials._form')
        </form>
    </div>
</div>
@endsection
