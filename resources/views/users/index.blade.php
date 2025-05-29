@extends('layouts.app')

@section('content')
<section class="users-list-wrapper">
    <!-- Users Table -->
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Lists</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        + New User
                    </a>
                </div>

                <div class="card-body">
<<<<<<< Updated upstream
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
    <tr>
        <th>{{ __('Id') }}</th>
        <th>{{ __('Mobile') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('State') }}</th>
        <th>{{ __('Register Date') }}</th>
        <th>{{ __('Account Balance') }}</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach($users as $key => $user)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $user->user_mobile }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->state }}</td>
            <td>{{ \Carbon\Carbon::parse($user->register_date)->format('d/m/Y') }}</td>
            <td>{{ $user->account_balance }}</td>
            <td class="d-flex gap-2 flex-wrap">
                <span class="btn btn-sm btn-primary me-1" data-id="{{ $user->id }}" data-status="{{ $user->status }}">
                    {{ $user->status ? 'Deactivate' : 'Activate' }}
                </span>
                <span class="btn btn-sm btn-primary me-1">
                     Scan Log
                </span>
                <span class="btn btn-sm btn-primary me-1">
                    Transactions
                </span>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

                        </table>
=======
                    <div class="table table-bordered table-striped table-fixed table-responsive">
                        {{ $dataTable->table() }}
>>>>>>> Stashed changes
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
