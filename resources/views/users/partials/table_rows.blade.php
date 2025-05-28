@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->user_mobile }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->state }}</td>
    <td>{{ \Carbon\Carbon::parse($user->register_date)->format('d/m/Y') }}</td>
    <td>{{ $user->account_balance }}</td>
    <td>
        <span class="btn btn-sm btn-primary">Deactive</span>
        <span class="btn btn-sm btn-primary">Scan Log</span>
        <span class="btn btn-sm btn-primary">Transactions</span>
    </td>
</tr>
@endforeach

@if($users->isEmpty())
<tr>
    <td colspan="7" class="text-center">No users found.</td>
</tr>
@endif
