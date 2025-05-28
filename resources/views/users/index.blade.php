@extends('layouts.app')

@section('content')
<section class="users-list-wrapper">
    <!-- Users Table -->
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Mobile No.</th>
                                    <th>Name</th>
                                    <th>State</th>
                                    <th>Register Date</th>
                                    <th>Account Balance</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user_mobile', name: 'user_mobile' },
            { data: 'name', name: 'name' },
            { data: 'state', name: 'state' },
            { data: 'register_date', name: 'register_date' },
            { data: 'account_balance', name: 'account_balance' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>


