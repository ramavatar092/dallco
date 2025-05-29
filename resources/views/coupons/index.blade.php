@extends('layouts.app')

@section('content')
<section class="users-list-wrapper">
    <!-- Coupons Table -->
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Coupon List</h5>
                    <a href="{{ route('coupons.create') }}" class="btn btn-primary">
                        + New Coupon
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="coupons-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Id') }}</th>
                                    <th>{{ __('Coupon Code') }}</th>
                                    <th>{{ __('Added Date') }}</th>
                                    <th>{{ __('Expiry Date') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $key => $coupon)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($coupon->coupon_date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($coupon->coupon_expiry)->format('d/m/Y') }}</td>
                                        <td>{{ $coupon->coupon_value }}</td>
                                        <td>
                                            <span class="badge bg-{{ $coupon->status ? 'success' : 'secondary' }} status-toggle"
                                                  style="cursor: pointer;"
                                                  data-id="{{ $coupon->id }}"
                                                  data-status="{{ $coupon->status }}">
                                                {{ $coupon->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="d-flex gap-2">
                                            <span class="btn btn-sm btn-secondary">
                                                Scan Log
                                            </span>

                                            <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>

                                            <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination can go here if needed --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#coupons-list-datatable').DataTable({
            paging: false,
            info: false,
            responsive: true
        });

        $('.status-toggle').on('click', function () {
            let couponId = $(this).data('id');
            $.ajax({
                url: '/coupons/' + couponId + '/toggle-status',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    location.reload();
                },
                error: function () {
                    alert('Failed to update status');
                }
            });
        });
    });
</script>
@endpush
