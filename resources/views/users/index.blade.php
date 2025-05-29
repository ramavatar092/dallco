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
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Id') }}</th>
                                    <th>{{ __('Mobile No.') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('State') }}</th>
                                    <th>{{ __('Register Date') }}</th>
                                    <th>{{ __('Account Balance') }}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->user_mobile }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->state }}</td>
                                        <td>{{ $user->register_date }}</td>
                                        <td>{{ $user->account_balance }}</td>
                                        <td>
                                            <span class="btn btn-sm btn-primary">Deactivate</span>
                                            <span class="btn btn-sm btn-primary">Scan Log</span>
                                            <span class="btn btn-sm btn-primary">Transactions</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-primary me-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#users-list-datatable').DataTable();
    });
</script>
@endpush
